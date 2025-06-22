from flask import Flask, jsonify
import pandas as pd
import mysql.connector
from sklearn.metrics.pairwise import cosine_similarity
from scipy.sparse import csr_matrix
import numpy as np

app = Flask(__name__)

DB_CONFIG = {
    'host': '127.0.0.1',
    'user': 'root',
    'password': '',
    'database': 'Service_House'
}

def get_db_connection():
    try:
        return mysql.connector.connect(**DB_CONFIG)
    except mysql.connector.Error as err:
        app.logger.error(f"Database connection failed: {err}")
        raise

def load_data():
    try:
        conn = get_db_connection()
        query = "SELECT client_id, service_id FROM client_service_views"
        df = pd.read_sql(query, conn)
        return df
    except Exception as e:
        app.logger.error(f"Failed to load data: {e}")
        raise
    finally:
        if 'conn' in locals() and conn.is_connected():
            conn.close()

def build_user_item_matrix(df):
    # Binary matrix: 1 if viewed, 0 otherwise
    df['viewed'] = 1
    user_service_matrix = df.pivot_table(index='client_id', columns='service_id', values='viewed', fill_value=0)
    return user_service_matrix

@app.route('/recommend/<int:client_id>', methods=['GET'])
def recommend(client_id):
    try:
        df = load_data()
        if df.empty:
            return jsonify({"error": "No data available"}), 404

        df['service_id'] = df['service_id'].astype(str)
        df['viewed'] = 1
        user_item = df.pivot_table(index='client_id', columns='service_id', values='viewed', fill_value=0)

        if client_id not in user_item.index:
            return jsonify({"message": "Client not found", "recommendations": []}), 200

        # Compute similarity
        matrix = csr_matrix(user_item.values)
        similarity = cosine_similarity(matrix)

        user_idx = user_item.index.get_loc(client_id)
        sim_scores = list(enumerate(similarity[user_idx]))
        sim_scores = sorted(sim_scores, key=lambda x: x[1], reverse=True)

        # Top 5 similar users (excluding self)
        top_similar_users = [i for i, score in sim_scores if i != user_idx and score > 0][:5]

        if not top_similar_users:
            return jsonify({
                "client_id": client_id,
                "recommendations": [],
                "message": "No similar users found. No recommendations available."
            }), 200

        similar_user_ids = [user_item.index[i] for i in top_similar_users]

        client_services = set(df[df['client_id'] == client_id]['service_id'])

        similar_views = df[df['client_id'].isin(similar_user_ids)].copy()
        similar_views = similar_views[~similar_views['service_id'].isin(client_services)]

        if similar_views.empty:
            return jsonify({
                "client_id": client_id,
                "recommendations": [],
                "message": "Similar users found, but no new services to recommend."
            }), 200

        service_series = pd.Series(similar_views['service_id'])
        recommended_services = service_series.value_counts().head(5).index.tolist()

        recommendations = []
        for sid in recommended_services:
            try:
                recommendations.append(int(sid))
            except ValueError:
                recommendations.append(sid)

        response = {
            "client_id": client_id,
            "recommendations": recommendations
        }

        if not recommendations:
            response["message"] = "No new services to recommend."
        elif len(recommendations) < 5:
            response["message"] = f"Only {len(recommendations)} new service(s) found."

        return jsonify(response)

    except Exception as e:
        app.logger.error(f"Recommendation failed: {e}")
        return jsonify({"error": "Internal server error"}), 500

if __name__ == '__main__':
    app.run(port=5000, debug=True)