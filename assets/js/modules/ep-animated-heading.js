/**
 * Start animated heading widget script
 */

;
(function ($, elementor) {

  'use strict';

  var widgetAnimatedHeading = function ($scope, $) {

    var $heading = $scope.find('.bdt-heading > *'),
      $animatedHeading = $heading.find('.bdt-animated-heading'),
      $settings = $animatedHeading.data('settings');

    if (!$heading.length) {
      return;
    }

    function kill() {
      var splitTextTimeline = gsap.timeline(),
        mySplitText = new SplitText($quote, {
          type: "chars, words, lines"
        });
      splitTextTimeline.clear().time(0);
      mySplitText.revert();
    }

    if ($settings.layout === 'animated') {
      elementorFrontend.waypoint($heading, function () {
        $($animatedHeading).Morphext($settings);
      }, {
        offset: 'bottom-in-view',
      });
    } else if ($settings.layout === 'typed') {
      elementorFrontend.waypoint($heading, function () {
        var animateSelector = $($animatedHeading).attr('id');
        var typed = new Typed('#' + animateSelector, $settings);
      }, {
        offset: 'bottom-in-view',
      });
    } else if ($settings.layout === 'split_text') {

      var $quote = $($heading);

      var splitTextTimeline = gsap.timeline(),
        mySplitText = new SplitText($quote, {
          type: "chars, words, lines"
        });


      gsap.set($quote, {
        perspective: $settings.anim_perspective //400
      });


      elementorFrontend.waypoint($heading, function () {
        kill();
        mySplitText.split({
          type: 'chars, words, lines'
        });
        var stringType = '';
        if ('lines' == $settings.animation_on) {
          stringType = mySplitText.lines;
        } else if ('chars' == $settings.animation_on) {
          stringType = mySplitText.chars;
        } else {
          stringType = mySplitText.words;
        }
        splitTextTimeline.staggerFrom(stringType, 0.5, {
          opacity: 0, //0
          scale: $settings.anim_scale, //0
          y: $settings.anim_rotation_y, //80
          rotationX: $settings.anim_rotation_x, //180
          transformOrigin: $settings.anim_transform_origin, //0% 50% -50  
          // ease:Back.easeOut, //back
        }, $settings.anim_duration);
      }, {

        offset: 'bottom-in-view',
        // offset: '100%',
        triggerOnce: ($settings.anim_repeat) // == 'false' ? false : true 
      });

    } else if ($settings.layout === 'text_bg') {
      elementorFrontend.waypoint($heading, function () {
        var $selector = $($heading).find('span');

        gsap.to($selector, {
          scrollTrigger: {
            trigger: $selector,
            start: "bottom center+=50%",
            end: "bottom center",
            scrub: true,
          },
          backgroundSize: '100% 200%',
        });

      }, {
        offset: '60%'
      });
    }

    $($heading).animate({
      easing: 'slow',
      opacity: 1,
    }, 500);


  };


  jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/bdt-animated-heading.default', widgetAnimatedHeading);
  });

}(jQuery, window.elementorFrontend));

/**
 * End animated heading widget script
 */