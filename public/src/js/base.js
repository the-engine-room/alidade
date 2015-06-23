$(document).ready(function(){
    

    $('.choice').click(function(){
        $('.choice-text').hide();
        
        
        var $target = $('#' + $(this).attr('id') + '-text');    
        
        $target.show('fast');
        
    });    
    
    
    if($('textarea[name="answer"]').length > 1){
        $('textarea[name="answer"]').each(function(i) {
                $(this).attr('name', 'answer-' + i);
        }); 
        
        alert('HEyyyyyyy');
    }
});