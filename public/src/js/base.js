$(document).ready(function(){
    

    $('.choice').click(function(){
        $('.choice-text').hide();
        
        
        var $target = $('#' + $(this).attr('id') + '-text');    
        
        $target.show('fast');
        
    });    
    
});