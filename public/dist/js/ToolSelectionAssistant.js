function doYouSee(selector){
  var y = $(selector).position().top;
  var windowY = $(window).scrollTop();
  return y > windowY  && y < windowY + $(window).height();
}
function headerFade(){
  if($('#homepage-header:not(:visible)')){

  }
}


$(document).ready(function(){

  var slides = {
    slide1: false,
    slide2: false,
    slide3: false,
    slide4: false

  }

    /** Homepage quotes **/
    $('.quoter').click(function(e){
      e.preventDefault();
      var target = $(this).data('target');
      // Hide all quotes
      $('.quote').removeClass('show').addClass('hidden');
      // Show Clicked Quote
      $(target).removeClass('hidden').addClass('show');
      // tweak scaling of avatars
      $('.quoter').removeClass('active');
      $(this).addClass('active');
      // set the pointer
      var activeOffset = $('.quoter.active').offset();
      var pointerPosition = (activeOffset.left + ($('.quoter.active').width()/2)) - ($('.pointer ~ .point').width()/2) - 10;
      //console.log(pointerPosition);
      $('.pointer ~ .point').offset({left : pointerPosition});
    });

    $('#slide-sidebar').css({ 'min-height': $('#slide-content').outerHeight() + 50 });

    /** warn of data loss **/
    if( $('#slide-page').length > 0 ){
      /** what have you clicked? **/
      $(window).click(function(ev){
        var target = ev.target;
      //  console.log($(target));
        //return false;
        /** if i'm clicking stuff outside of the tool execute onbefroeunload warning **/
        window.onbeforeunload = function (e) {
          e = e || window.event;
          var y = e.pageY || e.clientY;
          if( y < 0 || ( $(target).parents('#slide-page').length == 0 && $(target).parents('#projects-page').length == 0 && $(target).parents('#loginForm').length == 0)){
            return "Leaving now will result in loosing any unsaved progress.";
          }
        }
      });
    }

    /** Set arrowheads for the sidebar **/
    $('.step ul li a').each(function(){
        if($(this).height() > 30) {
            $(this).addClass('taller');
        }
    });

    /** Manage the Selection on 1.3 **/
    if( $('input[name="extra"]').length > 0 && $('input[name="extra"]').val() == 'no') {
      $('.picks').addClass('hide');
    }
    $('.picker').click(function(e){
        e.preventDefault();
        $('.picks, .13-buttons').addClass('hide');
        $($(this).data('target')).removeClass('hide');
        $('input[name="extra"]').val($(this).data('target'));
    });

    $('.welcome').modal('show');
    $('.register-from-modal').click(function(){
      $('.welcome').modal('hide');
    });

    $('.choice').click(function(){
        $('.choice-text').hide();
        var $target = $('#' + $(this).attr('id') + '-text');
        $target.show('fast');
    });


    if($('textarea[name="answer"]').length > 1){
        $('textarea[name="answer"]').each(function(i) {
                $(this).attr('name', 'answer[' + i + ']');
        });
    }

    /** check checkboxes on checkbox pages **/
    if( $('input[type="checkbox"]').length > 0 ){
      var selection = $('#extra-holder').val().split(';');
      for( i = 0; i < selection.length; i++ ){
        $('input[type="checkbox"]#r-' + selection[i]).prop('checked', true);;
      }
    }

    /** display/hide textareas in slide 4.2 depending on slide 4.1 **/
    if( $('#preselected').length > 0 ){
      // get selected options
      var selection = $('#preselected').val().split(';');
      $('.answer-wrapper').addClass('hide');
      for (i = 0; i <= selection.length; i++){
        var v = selection[i];
        if(v == 1 || v == 4){
          $('.answer-1').removeClass('hide').addClass('show');
        }
        else if (v == 5 || v == 6) {
          $('.answer-4').removeClass('hide').addClass('show');
        }
        else if ( v == 2) {
          $('.answer-2').removeClass('hide').addClass('show');
        }
        else if ( v == 3) {
          $('.answer-3').removeClass('hide').addClass('show');
        }
      }
    }

    /** delete projects **/
    $('.project-deleter').click(function(){
      var confirmText = 'Are you sure? This will delete all the answers and documents associated with this project permanently.';
      var deleter = $(this);
      var progBar = deleter.next('a');
      if(confirm(confirmText)){
        var project = $(this).data('delete');
        $.post('/ajax/delete_project', {project: project}, function(response){
          if(response.code == 200){
            progBar.remove();
            deleter.remove();
          }
        }, 'json');
      }
    });

    /** project name save **/
    $('.ajx.project-name').submit(function(e){
        e.preventDefault();
        var theForm = $(this);
        var vals = {
            project: $(this).children('#project').val(),
            title:   $(this).children().children('#title').val()
        };

        $.getJSON(
                  $(this).attr('action'),
                  vals,
                  function(data){
                    if(data.code === 'danger') {
                        theForm.prepend(data.message);
                    }
                    else{
                        theForm.parent('div').append('<h4>' + data.message + '</h4>');
                        theForm.remove();
                    }
                  }
                  );

        return false;
    });

    /** Save answers when navigating to the projects page **/
    $('#projects-page').click(function(e){
        e.preventDefault();
        var data = $('form#mainForm').serialize();
        var destination = $(this).attr('href');
        $.post(
            '/ajax/continuity',
            data,
            function(response){
              window.location.href = destination;
            },
            'json'
        );
    });

    /** save answers in modals **/
    $('.saveAnswer').submit(function(e){
        e.preventDefault();
        var vals = { slide: null, answer: [] };
        vals.slide = $(this).find('#slide').val();

        if($('.answer').length > 0 ) {
            $('.answer').each( function(index) {
                vals.answer[index] = $(this).val();
            });
        }
        else {
            vals.answer = $(this).find('#answer').val();
        }


        $.post(
            '/ajax/save_answer',
            vals,
            function(response){
                if(response.code === 'success') {
                    // hide modal
                    $('.editPrevAnswer').modal('toggle');
                    // refresh content box
                    // check if the answers are an array
                    if(typeof vals.answer == 'object'){
                        var r = '<ul>';
                        vals.answer.forEach(function(i){
                            r = r + '<li>' + i + '</li>';
                        });
                        r = r + '</ul>';
                        $('#answerBox').html(r);
                    }
                    else {
                        $('#answerBox').html(vals.answer);
                    }

                }
                else {
                    $('.editAnswer .modal-body').prepend(
                        '<div class="alert alert-danger"><i class="fa fa-times"></i> ' + response.message + '</div>'
                    );
                }
            },
            'json'
        );
    });

    $('#slide-sidebar a').click(function(e){
      e.preventDefault();
      var data = $('form').serialize();
      var clickedUrl = $(this).attr('href').split('/');
      var pieces = {
        'nextSlide' : clickedUrl[3],
        'hash'      : clickedUrl[4],
      }

      var destination = '/project/slide/' + pieces.nextSlide + '/' + pieces.hash ;
      $.post('/project/slide/' + pieces.nextSlide , data, function(response){
        window.location.href = destination;
      });
    });

    $('#editProfile').click(function(e){
      e.preventDefault();
      $('#editProfileForm alert').remove();
      var data = $('#editProfileForm').serialize();
      $.post('/ajax/edit_profile', data, function(response){
        if(response.code == 'success'){
          var holder = $('#editProfileForm').parent();
          $('#editProfileForm').remove();
          $(holder).append('<div class="alert alert-success">' + response.message + ' <strong>Applying new user credentials...</strong></div>');
          setTimeout(function(){ $('#user-forms').modal('hide'); }, 1950);
          setTimeout(function(){ location.reload(); }, 2000);
        }
        else {
          $('#editProfile').before('<div class="alert alert-danger">' + response.message + '</div>');
        }
      },
      'json'
    );

    });


    $('#login').click(function(e){
      e.preventDefault();
      $('#loginForm alert').remove();
      var data = $('#loginForm').serialize();
      $.post('/ajax/login', data, function(response){
        if(response.code == 'success'){
          var holder = $('#loginForm').parent();
          $('#loginForm').remove();
          $(holder).append('<div class="alert alert-success">' + response.message + '<strong>Reloading credentials...</strong></div>');
          // hide modal after 1 second.
          setTimeout(function(){ $('#user-forms').modal('hide'); }, 1950);
          setTimeout(function(){ location.href= "/user/projects"; }, 2000);
        }
        else {
          $('#login').before('<div class="alert alert-danger">' + response.message + '</div>');
        }
      },
      'json'
      );
    });

    // **** UNUSED ****
    /*
    $('.ajx.tsa-tooltip').each(function(){
        var theUrlPieces = $(this).attr('href').split('/');
        var Slide = theUrlPieces[theUrlPieces.length - 1];
        var Holder = $(this).parent();

        $.getJSON(
                    '/ajax/getprojectslide',
                    {
                        project: $('input[name="current_project"]').val(),
                        slide: Slide
                    },
                    function(response){

                        if (response.code == 'danger') {
                            Holder.append('No data found.');
                        }

                        else {
                            Holder.append(
                                "<div class=\"tsa-tooltip-wrap\">" +
                                "<p>" + response.answer + " " + response.choice + "</p>" +
                                "<p><em>" + response.extra + "</em></p>" +
                                "</div>"
                            );
                        }
                    }
                );

    });
    */

    // Load previous slide answers to check them out
    $('.prev-slide-loader').click(function(e){
        // prevent usual behaviour
        e.preventDefault();
        // empty previously loaded answer (might not be the first click, ya know?)
        $('.prev-slide-loader').next().empty();
        var Holder = $('.prev-slide-loader').next();
        // load answer
        $.getJSON(
            '/ajax/getprojectslide',
            {
                project:    $(this).data('project'),
                slide:      $(this).data('slide')
            },
            function(response){

                if (response.code == 'danger') {
                    Holder.append('No data found.');
                }

                else {
                    Holder.append(
                        "<div class=\"tsa-tooltip-wrap\">" +
                        "<p>" + response.answer + " " + response.choice + "</p>" +
                        "<p><em>" + response.extra + "</em></p>" +
                        "</div>"
                    );
                }
            }
        );
        // display answer

        return false;
    });

    $('#extra15-2').click(function(){
        if($(this).is(':checked')) {
            $('.checkboxcheck').show();
        }
        else {
            $('.checkboxcheck').hide();
        }
    });

    // Save slide contents (manager)
    $('#save-form').click(function(e){
        var theForm = $($(this).data('form'));

        var data = {
            'title'         : theForm.children().children('#title').val(),
            'description'   : $('.textarea').summernote('code'),
            'step'          : theForm.children('#step').val(),
            'position'      : theForm.children('#position').val()
        }

        $.post(
                '/ajax/save_slide',
                data,
                function(response){
                    theForm.prepend('<div class="alert alert-' + response.code + '"><i class="fa fa-' + response.icon + '"></i> ' + response.message + '</div>');
                },
                'json'
        );

        e.preventDefault();
        return false;
    });


    // Save slide contents (manager)
    $('#save-page-form').click(function(e){
        var theForm = $($(this).data('form'));

        var data = {
            'title'         : theForm.children().children('#title').val(),
            'contents'      : $('.textarea').summernote('code'),
            'url'           : theForm.children().children('#url').val(),
            'id'            : theForm.find('#page').val()
        }

        $.post(
                '/ajax/save_page',
                data,
                function(response){
                    theForm.prepend('<div class="alert alert-' + response.code + '"><i class="fa fa-' + response.icon + '"></i> ' + response.message + '</div>');
                },
                'json'
        );

        e.preventDefault();
        return false;
    });

    // launch WYSIWYG editor
    if ($('.textarea').length > 0 ) {
        $('.textarea').summernote();
    }

    // affix nav for report
    $('.toc').affix({
        offset: {
            top: 100,
            bottom: function () {
                return (this.bottom = $('footer').outerHeight(true))
            }
        }
    });


});

;

;
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