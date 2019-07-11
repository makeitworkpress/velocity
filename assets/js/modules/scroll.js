/**
 * The JavaScript for enabling scrolling to a destination
 */
var Scroll = {
    anchor: document.querySelectorAll('.scroll-down'),
    count: 0,
    destination: 0,
    duration: 1000,
    parameter: window.pageYOffset,
    timestamp: window.performance.now(),
    init: function() { 
        
        this.anchor.forEach( function(el) {
            el.addEventListener('click', function(event) {
                event.preventDefault();

                // Fade-out
                el.style.opacity = 0;
                setTimeout( function() {
                    el.style.display = 'none';
                }, 1000);

                Scroll.scroll(el.attributes.href.value);

            });   
        });

    },
    // Takes a whole scroll
    scroll: function( destination ) {
        Scroll.destination = window.pageYOffset + document.querySelector(destination).offsetTop;
        Scroll.parameter   = (window.pageYOffset - Scroll.destination)/2;
        window.requestAnimationFrame(Scroll.step);
    },
    // Takes a scrolling step
    step: function( newTimestamp ) {

		var tsDiff = newTimestamp - Scroll.timestamp;

		if(tsDiff > 100) {
			tsDiff = 30;
		}

		Scroll.count += Math.PI / (Scroll.duration/tsDiff);

		// As soon as we cross over Pi, we're about where we need to be
		if( Scroll.count >= Math.PI ) {
			return;
		}

		var moveStep = Math.round(Scroll.destination + Scroll.parameter + Scroll.parameter * Math.cos(Scroll.count));
        
        window.scrollTo(0, moveStep);
		Scroll.timestamp = newTimestamp;
        window.requestAnimationFrame(Scroll.step);
    }
};

module.exports = Scroll;