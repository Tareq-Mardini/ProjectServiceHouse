let currentMediaIndex = 0;
const mediaItems = document.querySelectorAll('.media-container iframe, .media-container img');

function showMedia(index) {
    mediaItems.forEach((item, i) => {
        item.classList.toggle('active', i === index);
    });
}

function nextMedia() {
    currentMediaIndex = (currentMediaIndex + 1) % mediaItems.length;
    showMedia(currentMediaIndex);
}

function prevMedia() {
    currentMediaIndex = (currentMediaIndex - 1 + mediaItems.length) % mediaItems.length;
    showMedia(currentMediaIndex);
}