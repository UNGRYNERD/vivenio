/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages
        $('.header__menu__toggle').on('click', function(event) {
          event.preventDefault();
          $('.header__menu').toggleClass('visible');
        });

        $(window).on('scroll', function(event) {
          if (window.scrollY>0) {
            $('body').addClass('scrolled');
          } else {
            $('body').removeClass('scrolled');
          }
        });

        $('.dropdown').each(function(index, el) {
          $(el).on('click', function(event) {
            event.stopPropagation();
            event.preventDefault();
            $(this).toggleClass('open');
          });
          $(el).on('click', '.dropdown__options a', function(event) {
            event.preventDefault();
            console.log(event.target.innerHTML);
            $(el).children('.dropdown__value').text($(this).text());
          });
        });
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after pa ge specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
        var slides = $('.slides');
        slides.owlCarousel({
          items: 1,
          dots: false,
          nav: true,
          loop: true,
        });
        slides.on('translate.owl.carousel',function(e){
          $('.owl-item video').each(function(){
            $(this).get(0).pause();
          });
        });
        slides.on('translated.owl.carousel',function(e){
          if ($('.owl-item.active video').length) {
            $('.owl-item.active video').get(0).play();
          }
        });

        function calculateDropdownHeight() {
          $('.slides .dropdown').each(function(index, el) {
            var calculatedHeight = $('.slides').height() - $(el).height() - $(el).offset().top - 10;
            $(el).children('.dropdown__options').css('max-height', calculatedHeight + 'px');
          });
        }
        calculateDropdownHeight();
        $(window).on('resize', function() {
          calculateDropdownHeight();
        });

        var featured = $('.featured__slides');
        featured.owlCarousel({
          items: 1,
          dots: false,
          nav: true,
          loop: true,
        });

        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map,
          icon: ungrynerd.path + '/dist/images/icon-marker.png'
        });

        var contentString = $('.map-info')[0].outerHTML;

        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });
        marker.addListener('click', function() {
          infowindow.open(map, marker);
        });

      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
