/**
 * The JavaScript for setting-up the slider
 */
var Slider = {
    instance: null,
    init: function() {
        
        if( typeof tns !== 'undefined' ) {
            this.instance = tns({container: '.entry-slider', controls: false, lazyload: true, lazyloadSelector: '.lazy'});
        } 
           
    }
};

module.exports = Slider;