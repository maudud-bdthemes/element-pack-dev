(function ($, elementor) {

    'use strict';

    $(window).on('elementor/frontend/init', function () {
        var ModuleHandler = elementorModules.frontend.handlers.Base,
            RippleClickEffect;

        RippleClickEffect = ModuleHandler.extend({

            bindEvents: function () {
                this.run();
            },
            onElementChange: debounce(function (prop) {
                if (prop.indexOf('section_ripple_click_effect_') !== -1) {
                    this.run();
                }
            }, 400),
            settings: function (key) {
                return this.getElementSettings('section_ripple_click_effect_' + key);
            },            
            run: function () {             
                var  $element = this.$element;          

                if (this.settings('on') !== 'yes') {
                    return;
                }
                
                document.querySelectorAll('.ep-ripple-click-effect-for-widgets, .ep-ripple-click-effect-for-buttons a, .ep-ripple-click-effect-for-buttons button, .ep-ripple-click-effect-for-images img, .ep-ripple-click-effect-for-both a, .ep-ripple-click-effect-for-both button, .ep-ripple-click-effect-for-both img').forEach(function(el) {
                    el.PaperRipple = new PaperRipple();

                    if ('A' == el.tagName) {
                        el.style.position = 'relative';
                    }

                    if ('IMG' == el.tagName) {
                        el.parentElement.appendChild(el.PaperRipple.$);
                    } else {
                        el.appendChild(el.PaperRipple.$);
                    }
            
                    el.addEventListener('mousedown', function(ev) {
                        this.PaperRipple.downAction(ev);
                    });
            
                    el.addEventListener('mouseup', function() {
                        this.PaperRipple.upAction();
                    });
                });                
            }
        });

        elementorFrontend.hooks.addAction('frontend/element_ready/section', function ($scope) {
            elementorFrontend.elementsHandler.addHandler(RippleClickEffect, {
                $element: $scope
            });
        });

        elementorFrontend.hooks.addAction('frontend/element_ready/container', function ($scope) {
            elementorFrontend.elementsHandler.addHandler(RippleClickEffect, {
                $element: $scope
            });
        });

    });

}(jQuery, window.elementorFrontend));