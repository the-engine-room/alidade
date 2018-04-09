var homepage = (function() {
    'use strict';
    
    var config = {
        selectors: {
            header: '#homepage-header',
            logo: '.logo',
            spyglass: '.spyglass',
            paper1: '#paper-1',
            paper2: '#paper-2',
            paper3: '#paper-3',
            appIconMsg: '#app-icon-msg',
            appIconMap: '#app-icon-map',
            appIconDbm: '#app-icon-dbm',
            checkrows1: '#paper-1 .checkrow',
            checkrows2: '#paper-2 .checkrow',
            checkrows3: '#paper-3 .checkrow',
            paperContent: '.paper-contents',
            textStep1: '.text-step-1',
            textStep2: '.text-step-2',
            textStep3: '.text-step-3',
        },
    };

    var app = {
        timelines: {
            index: 0,
            nextIndex: 0,
            direction: 'still',
            header: new TimelineMax().to(config.selectors.header, 0.5, {opacity: 1}).pause(),
            steps: new TimelineMax()
                .to(config.selectors.textStep1, 0.2, {ease: Power1.easeIn, opacity: 1})
                .to(config.selectors.textStep2, 0.2, {ease: Power1.easeIn, opacity: 1})
                .to(config.selectors.textStep3, 0.2, {ease: Power1.easeIn, opacity: 1})
                .pause(),
            checkrows: new TimelineMax()
                .to(config.selectors.checkrows1, 0.2, {ease: Power1.easeIn, opacity: 1, x: 0})
                .to(config.selectors.checkrows2, 0.2, {ease: Power1.easeIn, opacity: 1, x: 0})
                .to(config.selectors.checkrows3, 0.2, {ease: Power1.easeIn, opacity: 1, x: 0})
                .pause(),
            paper: new TimelineMax()
                .to(config.selectors.paperContent, 0.5, {ease: Power1.easeOut, opacity: 1, x: 0, y: 5})
                .pause(),
            main: new TimelineMax()
                .to(config.selectors.logo, 0.5, {opacity: 0}, "slide3")
                .to(config.selectors.spyglass, 0.5, {opacity: 1}, "slide3")
                .to(config.selectors.paper1, 0.5, {opacity: 1, x: 0, y: -160}, "slide3")
                .to(config.selectors.appIconMap, 0.5, {x: -80, y: +240}, "slide3")
                .to(config.selectors.paper2, 0.5, { opacity: 1, x: 0, y: -140, scale: 1 }, "slide3")
                .to(config.selectors.appIconMsg, 0.5, {x: 0, y: +200}, "slide3")
                .to(config.selectors.paper3, 0.5, {opacity: 1, x: 0, y: -120}, "slide3")

                .to(config.selectors.appIconDbm, 0.5, {x: +90, y: +160, onComplete: function(){
                    if (app.timelines.index !== 3){
                        app.timelines.main.pause();
                    }
                    app.timelines.steps.play();
                    app.timelines.checkrows.play();
                }, onReverseComplete: function(){
                    app.timelines.steps.reverse();
                    app.timelines.checkrows.reverse();
                }}, "slide3")

                .to(config.selectors.paper2, 0.5, {opacity: 1, x: 0, y: -400, scale: 2.5}, "slide4")
                .to(config.selectors.spyglass, 0.5, {opacity: 0}, "slide4")
                .to(config.selectors.paper1, 0.5, {opacity: 0, x: 0, y: -160}, "slide4")
                .to(config.selectors.appIconMap, 0.5, {opacity: 0, x: -90, y: +100}, "slide4")
                .to(config.selectors.appIconMsg, 0.5, {opacity: 0, x: 0, y: +50}, "slide4")
                .to(config.selectors.paper3, 0.5, {opacity: 0, x: 0, y: -120}, "slide4")
                .to(config.selectors.appIconDbm, 0.5, {opacity: 0, x: +90, y: 0, onReverseComplete: function(){
                    if (app.timelines.index !== 3){
                        app.timelines.main.pause();
                    }
                    app.timelines.steps.play();
                    app.timelines.checkrows.play();
                    app.timelines.paper.reverse();
                }, onComplete: function(){
                    app.timelines.main.pause();

                    app.timelines.steps.reverse();
                    app.timelines.checkrows.reverse();
                    setTimeout(function(){
                        app.timelines.paper.play();
                    }, 500);
                }}, "slide4")
                .pause()
        },
        init: function() {
            $('#fullpage').fullpage({
                hybrid: true,
                responsiveWidth: 1025,
                onLeave: function(index, nextIndex, direction){
                    app.timelines.index = index;
                    app.timelines.nextIndex = nextIndex;
                    app.timelines.direction = direction;
                    app.header(index, nextIndex, direction);
                    app.paper(index, nextIndex, direction);
                }
            });
        },
        header: function(index, nextIndex, direction){
            if (index === 1){
                app.timelines.header.play();
            }
            
            if (index === 2 && direction === 'up') {
                app.timelines.header.reverse();
            }
        },
        paper: function(index, nextIndex, direction) {

            if ((nextIndex === 3 && direction === 'down') || (nextIndex === 4 && direction === 'down')){
                app.timelines.main.play();
            }

            if ((index === 4 && direction === 'up') || (index === 3 && direction === 'up')){
                app.timelines.main.reverse();
            } 

        }
    };

    
    return {
        init: app.init
    };
}());

(function () {
    if(document.querySelector('body').classList.contains('homepage') && $(window).width() >= 1024) {
        homepage.init();
    }
})();