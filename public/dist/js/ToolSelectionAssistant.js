
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

  /** homepage scrollytelling **/
  $(window).on('scroll', function() {
    /** detect scroll position and attach slide id **/
    var WY = $(window).scrollTop();
    var WH = $(window).height();
    var third = WH/3;

    /** have the header appear when we scrolled at least 100px **/
    if(WY > 100 && $('#homepage-header:not(:visible)') ) {
      $('#homepage-header').addClass('affix affix-top').fadeTo(350, 1);
    }

    if(doYouSee($('#slide-2'))) {
      $('#slide-2 .contents').addClass('showtime').removeClass('ninjad');
    }


    if(doYouSee($('#slide-3')) && slides.slide3 == false) {
      $('#slide-3 .contents').addClass('showtime').removeClass('ninjad');
      $('#animate-logo-1').fadeTo(500, 0);
      $('#spyglass-animate').fadeTo(1000, 1, function(){
        /** animate the icons **/
        $('.app-icon#app-icon-msg').stop(true, true).animate(
          {
            top: '320px',
            left: '60px',
            height: '100px',
            width: '100px',
            overflow: 'hidden',
            backgroundSize: '100% 100%'
          },
          800
        );
        $('.app-icon#app-icon-map').stop(true, true).animate(
          {
            top: '340px',
            left: '240px',
            height: '100px',
            width: '100px',
            overflow: 'hidden',
            backgroundSize: '100% 100%'
          },
          800
        );
        $('.app-icon#app-icon-dbm').stop(true, true).animate(
          {
            top: '360px',
            left: '430px',
            height: '100px',
            width: '100px',
            overflow: 'hidden',
            backgroundSize: '100% 100%'
          },
          800
        );
        /** animate the steps **/
        $('#step1icon, .text-step-1').stop(true, true).delay(800).animate({ opacity: 1 }, 800);
        $('#step2icon, #arrow1, .text-step-2').stop(true, true).delay(1200).animate({ opacity: 1 }, 800);
        $('#step3icon, #arrow2, .text-step-3').stop(true, true).delay(1600).animate({ opacity: 1 }, 800);
        /** animate the papers **/
        $('.paper#paper-1').stop(true, true).animate({ top: '450px', opacity: 1 }, 800);
        $('.paper#paper-2').stop(true, true).animate({ top: '470px', opacity: 1 }, 800);
        $('.paper#paper-3').stop(true, true).animate({ top: '490px', opacity: 1 }, 800, 'swing', function(){
          /** animate the checkrows **/
          $('.paper .checkrow').each(function(i, e){
            setTimeout(function(){
               $(e).stop(true, true).animate({
                opacity: 1,
                marginLeft: '0px'
              }, 400);
            }, 200 + ( i * 200 ));
          });
        });
      });
      slides.slide3 = true;
    }

    if(doYouSee($('#slide-4')) && slides.slide4 == false) {
      $('#slide-4 .contents').addClass('showtime').removeClass('ninjad');
      /** fadeout the magnifyin glass and the checkboxes, zoom in the central paper **/
      $('.paper .checkrow').stop(true, true).animate({opacity: 0}, 200, 'swing', function(){ $('.paper .checkrow').remove()});
      $('.paper#paper-1, .paper#paper-3').stop(true, true).animate({opacity: 0}, 400, 'swing', function(){ $('.paper#paper-1, .paper#paper-3').remove()});
      $('#spyglass-animate').fadeTo(600, 0);

      $('.paper#paper-2').stop(true, true).delay(200).animate({
        width:  '400px',
        height: '485px',
        top:    '120px',
        left:   '150px'
      },
      800,
      'swing',
      function(){
        $('.paper#paper-2 .paper-contents').addClass('showtime').removeClass('ninjad');
      });


      slides.slide4 = true;
    }

    if(doYouSee($('.carousel'))){
      $('.alidade-container, .background').css({ position: "absolute", top: '300vh', bottom: '0px', "z-index": 0 });
    }
  });


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
      console.log(pointerPosition);
      $('.pointer ~ .point').offset({left : pointerPosition});
    });

    $('#slide-sidebar').css({ 'min-height': $('#slide-content').outerHeight() + 50 });

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

    // enable bootstrap tooltips
    $('[data-toggle="tooltip"]').tooltip();
});

;
