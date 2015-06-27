$(document).ready(function(){
    

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
        }
        console.log(vals);
        
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
});