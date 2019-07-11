/**
 * The JavaScript for regulating the parallax effects in background-images
 */
var Parallax = {
    target: document.getElementsByClassName('image-parallax'),
    init: function() {

        if( Parallax.target.length > 0 ) {
            
            // image-parallax
            window.addEventListener('scroll', function() {
                Parallax.target[0].style.backgroundPosition = '50%' + (50 - (window.scrollY/7)) + "%";
            });
        }
        
    }
};

module.exports = Parallax;