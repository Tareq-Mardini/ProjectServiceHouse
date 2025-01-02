// العناصر
const deleteAccountBtn = document.getElementById('deleteAccountBtn');
const deleteAccountModal = document.getElementById('deleteAccountModal');
const closeModal = document.querySelector('.close'); // زر الإغلاق
const cancelBtn = document.getElementById('cancelBtn'); // زر الإلغاء

// إظهار الـ Modal عند الضغط على زر "Delete My Account"
deleteAccountBtn.onclick = function () {
    deleteAccountModal.style.display = 'block';
};

// إخفاء الـ Modal عند الضغط على زر الإغلاق (X)
if (closeModal) {
    closeModal.onclick = function () {
        deleteAccountModal.style.display = 'none';
    };
}

// إخفاء الـ Modal عند الضغط على زر "Cancel"
if (cancelBtn) {
    cancelBtn.onclick = function () {
        deleteAccountModal.style.display = 'none';
    };
}

// إخفاء الـ Modal عند الضغط خارج المحتوى
window.onclick = function (event) {
    if (event.target == deleteAccountModal) {
        deleteAccountModal.style.display = 'none';
    }
};
