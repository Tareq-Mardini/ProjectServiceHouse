// Create Falling Stars Effect
const fallingStarsContainer = document.querySelector('.falling-stars');
// Function to create stars with random properties
function createFallingStars() {
    const numberOfStars = 50; // Number of falling stars
    for (let i = 0; i < numberOfStars; i++) {
        const star = document.createElement('div');
        const size = Math.random() * 3 + 1; // Random size between 1 and 4px
        const leftPosition = Math.random() * 100; // Random position across the width
        const delay = Math.random() * 4; // Increase delay for slower fall

        // Set properties for each star
        star.style.width = `${size}px`;
        star.style.height = `${size}px`;
        star.style.left = `${leftPosition}%`;
        star.style.animationDelay = `${delay}s`;
        // Append star to container
        fallingStarsContainer.appendChild(star);
    }
}
// Initialize falling stars
createFallingStars();