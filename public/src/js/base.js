$(document).ready(function(){
    
    /** Set arrowheads for the sidebar **/
    $('.step ul li a').each(function(){
        if($(this).height() > 30) {
            $(this).addClass('taller');
        }
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
        var vals = {
            slide:  $(this).find('#slide').val(),
            answer: $(this).find('#answer').val()
        };
        
        $.post(
            '/ajax/save_answer',
            vals,
            function(response){
                if(response.code === 'success') {
                    // hide modal
                    $('.editPrevAnswer').modal('toggle');
                    // refresh content box
                    $('#answerBox').html(vals.answer);
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