/* WebServicers admin workspace interactions. */
(function () {
  'use strict';

  var root = document.documentElement;
  var body = document.body;

  /* ---------- theme toggle (persisted) ---------- */
  var themeBtn = document.getElementById('themeToggle');
  if (themeBtn) {
    themeBtn.addEventListener('click', function () {
      var next = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
      root.setAttribute('data-theme', next);
      try { localStorage.setItem('ws-theme', next); } catch (e) {}
    });
  }

  /* ---------- sidebar: desktop collapse + mobile drawer ---------- */
  var collapseBtn = document.getElementById('sidebarCollapse');
  if (collapseBtn) {
    if (localStorage.getItem('ws-side') === 'collapsed' && window.innerWidth > 1024) {
      body.classList.add('side-collapsed');
    }
    collapseBtn.addEventListener('click', function () {
      if (window.innerWidth <= 1024) {
        body.classList.remove('side-open');
        return;
      }
      body.classList.toggle('side-collapsed');
      try { localStorage.setItem('ws-side', body.classList.contains('side-collapsed') ? 'collapsed' : 'open'); } catch (e) {}
    });
  }

  var mobileMenu = document.getElementById('mobileMenu');
  var scrim = document.getElementById('sidebarScrim');
  if (mobileMenu) {
    mobileMenu.addEventListener('click', function () { body.classList.toggle('side-open'); });
  }
  if (scrim) {
    scrim.addEventListener('click', function () { body.classList.remove('side-open'); });
  }

  /* ---------- submenu expand / collapse ---------- */
  document.querySelectorAll('[data-submenu]').forEach(function (button) {
    button.addEventListener('click', function () {
      button.parentElement.classList.toggle('is-open');
    });
  });

  /* ---------- modals ---------- */
  document.querySelectorAll('[data-open-modal]').forEach(function (trigger) {
    trigger.addEventListener('click', function () {
      var modal = document.getElementById(trigger.getAttribute('data-open-modal'));
      if (!modal) return;
      modal.hidden = false;
      var first = modal.querySelector('input, select, textarea');
      if (first) first.focus();
    });
  });

  function closeModal(modal) { modal.hidden = true; }

  document.querySelectorAll('.modal-backdrop').forEach(function (modal) {
    modal.addEventListener('click', function (event) {
      if (event.target === modal) closeModal(modal);
    });
    modal.querySelectorAll('[data-close-modal]').forEach(function (button) {
      button.addEventListener('click', function () { closeModal(modal); });
    });
  });

  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
      document.querySelectorAll('.modal-backdrop:not([hidden])').forEach(closeModal);
      body.classList.remove('side-open');
    }
    // ⌘K / Ctrl+K focuses the topbar search
    if ((event.metaKey || event.ctrlKey) && event.key.toLowerCase() === 'k') {
      var search = document.querySelector('.topsearch input');
      if (search) { event.preventDefault(); search.focus(); search.select(); }
    }
  });

  /* ---------- destructive confirmations ---------- */
  document.querySelectorAll('form[data-confirm]').forEach(function (form) {
    form.addEventListener('submit', function (event) {
      if (!window.confirm(form.getAttribute('data-confirm'))) {
        event.preventDefault();
      }
    });
  });

  /* ---------- pair-style textareas: grow with content ---------- */
  document.querySelectorAll('textarea[data-grow]').forEach(function (area) {
    var fit = function () {
      area.style.height = 'auto';
      area.style.height = Math.min(area.scrollHeight + 2, 400) + 'px';
    };
    area.addEventListener('input', fit);
    fit();
  });
})();
