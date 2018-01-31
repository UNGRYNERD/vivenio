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
            $(this).addClass('open');

          });
          $(el).on('click', '.dropdown__options a', function(event) {
            event.stopPropagation();
            event.preventDefault();
            var dropValue = $(el).children('.dropdown__value');
            if ($(event.target).hasClass('button')) {
              dropValue.text($(el).find('input').val() || 0);
              $($(el).data('target')).val($(el).find('input').val() || 0);
            } else {
              dropValue.text($(this).text());
              $($(el).data('target')).val($(this).data('value'));
            }
            $(el).removeClass('open');

          });
        });

        if ($('#map').length) {
          var map = new google.maps.Map(document.getElementById('map'), {
            styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]
          });

          var bounds = new google.maps.LatLngBounds();
          var infowindow = new google.maps.InfoWindow();
          var data = '';
          if ($('.filters form').length) {
            data = $('.filters form').serialize() + '&';
          }
          data = data + 'action=get_all_properties';
          $.ajax({
            url: ungrynerd.ajaxurl,
            type: 'GET',
            dataType: 'json',
            data: data,
            success: function(data) {
              data.forEach(function(property, i) {
                console.log(property, i);
                var marker = new google.maps.Marker({
                  position: new google.maps.LatLng(property.lat, property.lng),
                  map: map,
                  icon: ungrynerd.path + '/dist/images/icon-marker.png'
                });

                bounds.extend(marker.position);

                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                  return function() {
                    infowindow.setContent(property.info);
                    infowindow.open(map, marker);
                  }
                })(marker, i));
              });
              map.fitBounds(bounds);
              map.setZoom(map.getZoom()-5);
            }
          });
        } //end map

        //calculate container width in properties
        function calculateWidths() {
          if($(window).width() > 1024){
            var padding = ($(window).width() - $('.header__wrapper').width())/2;
            var width = $('.prop-list').width() - padding;
            $('.filters').css('padding-left', padding);
            $('.prop-list__wrapper').css('width', width);
          }
        }

        calculateWidths();

        $(window).on('resize', function(event) {
          calculateWidths();
        });

        //links map and listing
        $('.prop-list__options a').on('click', function(event) {
          event.preventDefault();
          $('.filters form').attr('action', $(this).attr('href'));
          $('.filters form').submit();
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
