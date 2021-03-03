"use strict";

jQuery(document).ready(function ($) {
    var firstLoad = true;
    animateTitle();

    TweenMax.from("#wave-1", 8, { morphSVG: "#wave-2" });

    var scrollController = new ScrollMagic.Controller();
    $('.trigger').each(function () {
        var apparition = TweenMax.fromTo(this, 1, { y: 100, autoAlpha: 0 }, { y: 0, autoAlpha: 1 });
        var scene = new ScrollMagic.Scene({
            triggerElement: this,
            triggerHook: 1,
            reverse: false
        }).setTween(apparition).addTo(scrollController);
    });

    var Headerscene = new ScrollMagic.Scene({
        triggerElement: '#header-trigger',
        triggerHook: 0
    }).setTween('#header', .5, { y: -80 }).addTo(scrollController);

    scrollController.scrollTo(function (newpos) {
        TweenMax.to(window, 1, { scrollTo: { y: newpos } });
    });
    $(document).on('click', "a[href^='#']", function (e) {
        var id = $(this).attr('href');
        if ($(id).length > 0) {
            e.preventDefault();
            scrollController.scrollTo(id);
        }
    });
    $('.split').each(function () {
        var splittedText = new SplitText(this, { type: "lines, chars" });
        var chars = splittedText.chars;
        var tl = new TimelineMax();
        chars.forEach(function (val, index) {
            tl.from(val, 1, { left: 200, autoAlpha: 0 }, index * .05);
        });
        var scene = new ScrollMagic.Scene({
            triggerElement: this,
            triggerHook: 1,
            reverse: false
        }).setTween(tl).addTo(scrollController);
    });

    $('.next').on('click', function () {
        if (!$('.brands').hasClass('second')) {
            $('.brands').addClass('second');
            $('span.current').text('2');
            animateTitle();
            waveMorphHeader();
        } else {
            $('.brands').removeClass('second');
            $('span.current').text('1');
            animateTitle();
            waveMorphHeader();
        }
    });

    $('.goto').on('click', function () {
        $('html, body').animate({
            scrollTop: $("#presentation").offset().top
        }, 1000);
    });

    $('.brand').hover(function () {
        $('.brand').removeClass('active');
        $(this).addClass('active');
        var imgBrand = $('.brand-img').find('img');
        imgBrand.attr('src', $(this).data('src'));
        imgBrand.data('hover', $(this).data('srchover'));
        imgBrand.data('src', $(this).data('src'));
        setTimeout(function () {
            imgBrand.attr('src', imgBrand.data('hover'));
        }, 1000);
    });

    var currentPosition = 0;

    function hideName(position, products, id, nb) {
        if (position >= currentPosition * nb) {

            TweenMax.to('.name-product', 0.5, { x: -200, autoAlpha: 0, onComplete: displayName, onCompleteParams: [position, products, id, currentPosition, nb] });
            TweenMax.to('.title-product', 0.5, { x: -200, autoAlpha: 0, onComplete: displayName, onCompleteParams: [position, products, id, currentPosition, nb] });
            TweenMax.to('.content-product', 0.5, { x: -200, autoAlpha: 0, onComplete: displayName, onCompleteParams: [position, products, id, currentPosition, nb] });
        } else {
            TweenMax.to('.name-product', .5, { x: 200, autoAlpha: 0, onComplete: displayName, onCompleteParams: [position, products, id, currentPosition, nb] });
            TweenMax.to('.title-product', .5, { x: 200, autoAlpha: 0, onComplete: displayName, onCompleteParams: [position, products, id, currentPosition, nb] });
            TweenMax.to('.content-product', .5, { x: 200, autoAlpha: 0, onComplete: displayName, onCompleteParams: [position, products, id, currentPosition, nb] });
        }
    }
    function displayName(position, products, id, current, nb) {
        $('.name-product').text(products[id][position]);
        if (position >= current * nb) {
            TweenMax.fromTo('.name-product', .5, { x: 200, autoAlpha: 0 }, { x: 0, autoAlpha: 1 });
            TweenMax.fromTo('.title-product', .5, { x: 200, autoAlpha: 0 }, { x: 0, autoAlpha: 1 });
            TweenMax.fromTo('.content-product', .5, { x: 200, autoAlpha: 0 }, { x: 0, autoAlpha: 1 });
        } else {
            TweenMax.fromTo('.name-product', .5, { x: -200, autoAlpha: 0 }, { x: 0, autoAlpha: 1 });
            TweenMax.fromTo('.title-product', .5, { x: -200, autoAlpha: 0 }, { x: 0, autoAlpha: 1 });
            TweenMax.fromTo('.content-product', .5, { x: -200, autoAlpha: 0 }, { x: 0, autoAlpha: 1 });
        }
    }
    var id = 'jus';
    var nbElement = 10;
    var imageCarousel = new Dragdealer('image-carousel-jus', {
        steps: nbElement + 1,
        speed: 0.3,
        loose: true,
        requestAnimationFrame: true,
        dragStopCallback: function dragStopCallback(x, y) {
            var position = x * nbElement;
            hideName(position, products, id, nbElement);
            currentPosition = x;
        }
    });

    var products = {};
    var gammes = {
        ajvar: "Ajvar",
        jus: "Jus de fruits"
    };
    var gammesDescription = {
        ajvar: "Une préparation à base de poivrons grillés et cuits lentement au chaudron. Incontournable pour assurer le succès d’un apéro ou d’un pique-nique !",
        jus: "Des fruits entiers compotés au chaudron avec du jus de raisin blanc. 100% fruits, 100% gourmands ! Plus de 10 saveurs en 20cl ou 70cl !",
        fruitsmiel: "Une combinaison inédite avec 60% de fruits et 40% de miel. Un équilibre parfait pour un plaisir intense !",
        fruits: "Des fruits entiers au sirop à déguster en nappage de desserts gourmands ou tout simplement avec du fromage blanc. Un délicat assemblage de savoir-faire, gourmandise et innovation!",
        conf: "Des confitures élaborées à partir de fruits sélectionnés manuellement. Les plus gourmandes contiennent jusqu’à 80% de fruit !"
    };
    products = {
        ajvar: ['Poivrons grillés & tomates', 'Poivrons grillés', 'Poivrons grillés & piments chili'],
        jus: ['Abricot', 'Cassis', 'Coing', 'Mûres sauvage', 'Tomate et céleri', 'Orange', 'Pomme', 'Framboise', 'Cranberry sauvage', 'MIRTILLE SAUVAGE', 'Poire']
    };
    function removeSlider(carousel) {
        if (carousel != $('.showing').attr('id')) {
            TweenMax.to(".showing", .5, { x: '500%', onComplete: loadSlider, onCompleteParams: [carousel] });
        }
    }

    function loadSlider(carousel) {
        var loadedSlider = $('.showing').attr('id');
        $('.carousel').removeClass('showing');
        TweenMax.to("#" + loadedSlider, .5, { clearProps: "all" });
        TweenMax.from('#' + carousel, .5, { x: '500%', onStart: function onStart() {
                $('#' + carousel).addClass('showing');
            }, onComplete: function onComplete() {
                TweenMax.set('#' + carousel, { clearProps: "all" });
                nbElement = $('#' + carousel).find('.item').length;
                currentPosition = 0;
                $('.name-product').text(products[id][0]);
                imageCarousel = new Dragdealer(carousel, {
                    steps: nbElement,
                    speed: 0.3,
                    loose: true,
                    requestAnimationFrame: true,
                    dragStopCallback: function dragStopCallback(x, y) {
                        var position = x * (nbElement - 1);
                        hideName(position, products, id, nbElement);
                        currentPosition = x;
                    }

                });
                $('.title-product').text(gammes[id]);
                $('.content-product').text(gammesDescription[id]);
            } });
    }

    $('.slider-nav').on('click', function (e) {
        e.preventDefault();
        $('.slider-nav').removeClass('active');
        $(this).addClass('active');
        id = $(this).data('carousel');
        var carousel = 'image-carousel-' + $(this).data('carousel');
        removeSlider(carousel);
    });

    var anim = null;
    $('#right-nav').hover(function () {
        anim = setInterval(function () {
            imageCarousel.setStep(imageCarousel.getStep()[0] + 1, 1);
        }, 200);
    }, function () {

        hideName(imageCarousel.getStep()[0] - 1, products, id, nbElement);
        clearInterval(anim);
        anim = null;
    });
    $('#left-nav').hover(function () {
        anim = setInterval(function () {
            imageCarousel.setStep(imageCarousel.getStep()[0] - 1, 1);
        }, 200);
    }, function () {

        hideName(imageCarousel.getStep()[0] - 1, products, id, nbElement);
        clearInterval(anim);
        anim = null;
    });
    var step = 1;
    $('.item img').on('click', function () {
        step = $(this).data('step');
        imageCarousel.setStep(step, 1);
        hideName(step - 1, products, id, nbElement);
    });

    function animateTitle() {
        if (!$('.brands').hasClass('second')) {
            TweenMax.fromTo('#grannys-title', 5, { x: '100%' }, { x: '-20%', onComplete: next });
        } else {
            TweenMax.fromTo('#sipsap-title', 5, { x: '100%' }, { x: '-0%' });
        }
    }

    function next() {
        if (firstLoad) {
            $('.brands').addClass('second');

            $('span.current').text('2');
            animateTitle();
            waveMorphHeader();
            firstLoad = false;
        }
    }

    function waveMorphHeader() {
        if (!$('.brands').hasClass('second')) {
            TweenMax.to("#wave-1", 8, { morphSVG: "#wave-1" });
        } else {
            TweenMax.to("#wave-1", 8, { morphSVG: "#wave-2" });
        }
    }

    var gwt = TweenMax.to('#wave-GT1', 15, { morphSVG: '#wave-GT2' });

    var waveGScene = new ScrollMagic.Scene({
        triggerElement: ".grannysHero",
        duration: '100%'
    }).setTween(gwt).addTo(scrollController);

    var gwb = TweenMax.to('#wave-GB1', 15, { morphSVG: '#wave-GB2' });

    var waveGScene = new ScrollMagic.Scene({
        triggerElement: ".grannysHero",
        duration: '150%'
    }).setTween(gwb).addTo(scrollController);

    var st = TweenMax.to('#wave-ST1', 15, { morphSVG: '#wave-ST2' });

    var waveSScene = new ScrollMagic.Scene({
        triggerElement: ".sipsapHero",
        duration: '100%'
    }).setTween(st).addTo(scrollController);

    var sb = TweenMax.to('#wave-SB1', 15, { morphSVG: '#wave-SB2' });

    var waveSScene = new ScrollMagic.Scene({
        triggerElement: ".sipsapHero",
        duration: '150%'
    }).setTween(sb).addTo(scrollController);
});