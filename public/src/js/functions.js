function parallax(selector, speed) {
    var parallaxElement = $(selector);
    
    parallaxElement.css({ 'background-position': '50% ' +  ( ($(window).scrollTop() * speed) -200)  + 'px'});
    
}