/**
 * The JavaScript for enabling user ratings
 */
var Rating = {
    parser: new DOMParser,
    init: function() {
        
        // Rate the stars
        document.querySelectorAll('.stars-rate i').forEach( function(el) {
            el.addEventListener('mouseover', function(event) {

                var prevEls,
                    nextEls;

                if( el === null ) {
                    return;
                }

                el.classList.add('icon-star');
                el.classList.remove('icon-star-o');

                // Fill previous stars
                prevEls = Rating.prevAll(el);

                prevEls.forEach( function(star) {
                    star.classList.add('icon-star');
                    star.classList.remove('icon-star-o');
                });

                // Empty next stars
                nextEls = Rating.nextAll(el);

                nextEls.forEach( function(star) {
                    star.classList.add('icon-star-o');
                    star.classList.remove('icon-star');
                });            
            
            
            } );
        });
        
        // Click the rating 
        document.querySelectorAll('.stars-rating').forEach( function(el) {
            
            el.addEventListener('click', function(event) {
                
                event.preventDefault();

                var id      = this.dataset.id;
                    rating  = this.querySelectorAll('.stars-rate .icon-star').length;
                    request = new XMLHttpRequest();

                // Remove the rated class
                this.previousElementSibling.classList.remove('rated');

                // Post Request
                request.open('POST', velocity.ajax);
                request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                request.onload = function() {
                    if( request.status >= 200 && request.status < 400 ) {
                        var newRating = Rating.parser.parseFromString(request.response,'text/html').lastChild.lastChild.firstChild.getElementsByClassName('stars-current-rating')[0];
                        el.getElementsByClassName('stars-current-rating')[0].remove();
                        el.appendChild( newRating );
                        el.previousElementSibling.classList.add('rated');

                    }
                };
                request.send(encodeURI('action=addRating&id=' + id + '&nonce=' + velocity.nonce + '&rating=' + rating));               

            });

        } ); 
    },
    // Returns previous siblings
    prevAll: function(el) {
        var siblings = [];
	    while (el = el.previousElementSibling) { 
            siblings.push(el); 
        }
	    return siblings;
    },
    // Returns next siblings
    nextAll: function(el) {
        var siblings = [];
	    while (el = el.nextElementSibling) { 
            siblings.push(el); 
        }
	    return siblings;
    }    

}

module.exports = Rating;