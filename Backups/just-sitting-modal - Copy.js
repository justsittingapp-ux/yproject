(function () {
  var modalEl = document.getElementById('justSittingScreenshotModal');
  if (!modalEl) return;
  var imgEl = document.getElementById('justSittingScreenshotModalImg');
  var titleEl = document.getElementById('justSittingScreenshotModalLabel');
  modalEl.addEventListener('show.bs.modal', function (event) {
    var t = event.relatedTarget;
    if (!t || !t.getAttribute) return;
    var src = t.getAttribute('data-img-src');
    var alt = t.getAttribute('data-img-alt') || '';
    if (imgEl) {
      imgEl.src = src;
      imgEl.alt = alt;
    }
    if (titleEl) titleEl.textContent = alt || 'Captură de ecran';
  });
  modalEl.addEventListener('hidden.bs.modal', function () {
    if (imgEl) imgEl.src = '';
  });
})();
