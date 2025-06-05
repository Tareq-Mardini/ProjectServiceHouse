document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("deleteAccountModal");
    const openBtn = document.getElementById("deleteAccountBtn");
    const closeBtn = modal.querySelector(".close");
    const cancelBtn = document.getElementById("cancelBtn");

    openBtn.addEventListener("click", function () {
        modal.style.display = "block";
        setTimeout(() => {
            modal.classList.add("show");
        }, 10);
    });

    function closeModal() {
        modal.classList.remove("show");
        setTimeout(() => {
            modal.style.display = "none";
        }, 500);
    }

    closeBtn.addEventListener("click", closeModal);
    cancelBtn.addEventListener("click", closeModal);

    window.addEventListener("click", function (event) {
        if (event.target === modal) {
            closeModal();
        }
    });
});
