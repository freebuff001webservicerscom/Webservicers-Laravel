/* WebServicers — front page interactions
   Mobile menu, dropdown navigation, sticky header shadow, reveal on scroll. */
(function () {
  'use strict';

  var body = document.body;
  var menuToggle = document.querySelector('.menu-toggle');
  var nav = document.getElementById('primary-nav');
  var header = document.querySelector('.site-header');
  var menus = Array.prototype.slice.call(document.querySelectorAll('.has-menu'));
  var mobileBreakpoint = 900;

  function isMobile() {
    return window.innerWidth <= mobileBreakpoint;
  }

  function closeMenus(except) {
    menus.forEach(function (menu) {
      if (menu === except) {
        return;
      }
      menu.classList.remove('open');
      var trigger = menu.querySelector('.nav-link[aria-expanded]');
      if (trigger) {
        trigger.setAttribute('aria-expanded', 'false');
      }
    });
  }

  /* Mobile menu toggle */
  if (menuToggle && nav) {
    menuToggle.addEventListener('click', function () {
      var open = body.classList.toggle('nav-open');
      menuToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
      menuToggle.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
      if (!open) {
        closeMenus(null);
      }
    });

    // Close the mobile menu after tapping an in-page link.
    nav.addEventListener('click', function (event) {
      var link = event.target.closest('a[href^="#"]');
      if (link && isMobile() && body.classList.contains('nav-open')) {
        body.classList.remove('nav-open');
        menuToggle.setAttribute('aria-expanded', 'false');
        menuToggle.setAttribute('aria-label', 'Open menu');
        closeMenus(null);
      }
    });
  }

  /* Dropdown triggers (click support for touch devices + keyboard) */
  menus.forEach(function (menu) {
    var trigger = menu.querySelector('.nav-link[aria-expanded]');
    if (!trigger) {
      return;
    }

    trigger.addEventListener('click', function (event) {
      event.preventDefault();
      var willOpen = !menu.classList.contains('open');
      closeMenus(menu);
      menu.classList.toggle('open', willOpen);
      trigger.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
    });
  });

  /* Close dropdowns on outside click or Escape */
  document.addEventListener('click', function (event) {
    if (!event.target.closest('.has-menu')) {
      closeMenus(null);
    }
  });

  document.addEventListener('keydown', function (event) {
    if (event.key !== 'Escape') {
      return;
    }
    closeMenus(null);
    if (body.classList.contains('nav-open')) {
      body.classList.remove('nav-open');
      if (menuToggle) {
        menuToggle.setAttribute('aria-expanded', 'false');
        menuToggle.setAttribute('aria-label', 'Open menu');
      }
    }
  });

  /* Reset state when switching between mobile and desktop layouts */
  var wasMobile = isMobile();
  window.addEventListener('resize', function () {
    var nowMobile = isMobile();
    if (nowMobile !== wasMobile) {
      wasMobile = nowMobile;
      closeMenus(null);
      body.classList.remove('nav-open');
      if (menuToggle) {
        menuToggle.setAttribute('aria-expanded', 'false');
        menuToggle.setAttribute('aria-label', 'Open menu');
      }
    }
  });

  /* Sticky header shadow */
  if (header) {
    var onScroll = function () {
      header.classList.toggle('scrolled', window.scrollY > 8);
    };
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
  }

  /* Reveal on scroll */
  var revealTargets = document.querySelectorAll('[data-reveal]');
  if ('IntersectionObserver' in window && revealTargets.length) {
    var observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add('revealed');
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.15, rootMargin: '0px 0px -40px 0px' }
    );
    revealTargets.forEach(function (target) {
      observer.observe(target);
    });
  } else {
    revealTargets.forEach(function (target) {
      target.classList.add('revealed');
    });
  }
})();

/* Contact form: no backend yet — submitting explains that instead of
   pretending to send anything (mirrors the reference site's auth.js). */
(function () {
  'use strict';

  var forms = document.querySelectorAll('.contact-form');
  if (!forms.length) return;

  Array.prototype.forEach.call(forms, function (form) {
    form.addEventListener('submit', function (event) {
      event.preventDefault();
      var feedback = form.querySelector('.contact-feedback');
      if (!feedback) return;
      feedback.hidden = false;
      feedback.textContent = form.getAttribute('data-feedback') ||
        'This is a preview of the contact form — it is not connected yet.';
    });
  });
})();
