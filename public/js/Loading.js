window.addEventListener('beforeunload', function () {
    Notiflix.Loading.hourglass("Loading");

});

    // إزالة التحميل عند تحميل الصفحة الجديدة
    window.addEventListener('load', function () {
        Notiflix.Loading.remove();
    });