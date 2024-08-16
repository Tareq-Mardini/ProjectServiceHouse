<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<form action="{{ route('Store.account.client') }}" method="POST">
    @csrf

    <!-- حقل البريد الإلكتروني -->
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>

    <!-- حقل كلمة المرور -->
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
    </div>

    <!-- حقل الاسم -->
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
    </div>

    <!-- حقل رقم الهاتف -->
    <div>
        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" required>
    </div>

    <!-- حقل العنوان -->
    <div>
        <label for="arab-countries">Select a Country:</label>
        <input required list="countries" id="arab-countries" name="address" placeholder="Start typing...">
        <datalist id="countries">
            <!-- قائمة الدول -->
            <option value="Algeria">
            <option value="Bahrain">
            <option value="Comoros">
            <option value="Djibouti">
            <option value="Egypt">
            <option value="Iraq">
            <option value="Jordan">
            <option value="Kuwait">
            <option value="Lebanon">
            <option value="Libya">
            <option value="Mauritania">
            <option value="Morocco">
            <option value="Oman">
            <option value="Palestine">
            <option value="Qatar">
            <option value="Saudi Arabia">
            <option value="Somalia">
            <option value="South Sudan">
            <option value="Sudan">
            <option value="Syria">
            <option value="Tunisia">
            <option value="United Arab Emirates">
            <option value="Yemen">
        </datalist>
    </div>

    <!-- حقل الجنس -->
    <div>
        <label for="gender">Gender:</label>
        <select id="gender" name="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
    </div>

    <!-- حقل تاريخ الميلاد -->
    <div>
        <label for="date_of_birth">Date of birth:</label>
        <input type="date" id="date_of_birth" name="date_of_birth" required>
    </div>

    <!-- زر الإرسال -->
    <div>
        <button type="submit">Submit</button>
    </div>
</form>
</body>
</html>