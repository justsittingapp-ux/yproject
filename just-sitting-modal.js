(function () {
  var modalEl = document.getElementById('justSittingScreenshotModal');
  if (!modalEl) return;

  var imgEl    = document.getElementById('justSittingScreenshotModalImg');
  var titleEl  = document.getElementById('justSittingScreenshotModalLabel');
  var btnPrev  = document.getElementById('jsModalPrev');
  var btnNext  = document.getElementById('jsModalNext');

  /* Construim lista tuturor trigger-elor în ordinea lor din DOM */
  var triggers = Array.prototype.slice.call(
    document.querySelectorAll('[data-bs-target="#justSittingScreenshotModal"]')
  );

  var currentIndex = 0;

  function showSlide(index) {
    if (!triggers.length) return;
    /* Wrap-around */
    currentIndex = (index + triggers.length) % triggers.length;
    var t   = triggers[currentIndex];
    var src = t.getAttribute('data-img-src');
    var alt = t.getAttribute('data-img-alt') || '';

    if (imgEl) {
      imgEl.src = '';          /* forțăm re-render pentru tranziție */
      imgEl.alt = alt;
      imgEl.src = src;
    }
    if (titleEl) titleEl.textContent = (currentIndex + 1) + ' / ' + triggers.length;

    /* Ascundem săgețile dacă există o singură imagine */
    if (btnPrev) btnPrev.style.display = triggers.length > 1 ? '' : 'none';
    if (btnNext) btnNext.style.display = triggers.length > 1 ? '' : 'none';
  }

  /* Deschidem modalul cu imaginea corectă */
  modalEl.addEventListener('show.bs.modal', function (event) {
    var t = event.relatedTarget;
    if (!t) return;
    var idx = triggers.indexOf(t);
    showSlide(idx >= 0 ? idx : 0);
  });

  /* Curățăm imaginea la închidere */
  modalEl.addEventListener('hidden.bs.modal', function () {
    if (imgEl) imgEl.src = '';
  });

  /* Butoane de navigare */
  if (btnPrev) {
    btnPrev.addEventListener('click', function () { showSlide(currentIndex - 1); });
  }
  if (btnNext) {
    btnNext.addEventListener('click', function () { showSlide(currentIndex + 1); });
  }

  /* Navigare cu tastatura (← →) când modalul e deschis */
  document.addEventListener('keydown', function (e) {
    if (!modalEl.classList.contains('show')) return;
    if (e.key === 'ArrowLeft')  showSlide(currentIndex - 1);
    if (e.key === 'ArrowRight') showSlide(currentIndex + 1);
  });

  /* ── Swipe touch ── */
  var touchStartX = 0;
  var touchStartY = 0;
  var SWIPE_THRESHOLD = 50; /* pixeli minimi pentru a recunoaște swipe-ul */

  modalEl.addEventListener('touchstart', function (e) {
    touchStartX = e.changedTouches[0].clientX;
    touchStartY = e.changedTouches[0].clientY;
  }, { passive: true });

  modalEl.addEventListener('touchend', function (e) {
    if (!modalEl.classList.contains('show')) return;
    var dx = e.changedTouches[0].clientX - touchStartX;
    var dy = e.changedTouches[0].clientY - touchStartY;

    /* Ignorăm dacă mișcarea verticală e mai mare (scroll) */
    if (Math.abs(dy) > Math.abs(dx)) return;

    if (dx < -SWIPE_THRESHOLD) showSlide(currentIndex + 1); /* swipe stânga → următoarea */
    if (dx >  SWIPE_THRESHOLD) showSlide(currentIndex - 1); /* swipe dreapta → anterioara */
  }, { passive: true });

})();
