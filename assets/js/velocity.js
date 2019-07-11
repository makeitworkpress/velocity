(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
/**
 * Loads our JavaScript modules and initializes them
 * This file is formatted into velocity.js and velocity.min.js by the npm scripts.
 */
var Velocity = {
    modules: {
        header: require('./modules/header'),
        paralax: require('./modules/parallax'),
        projects: require('./modules/projects'),
        rating: require('./modules/rating'),
        scroll: require('./modules/scroll'),
        slider: require('./modules/slider')
    },
    init: function() {
        for( var key in this.modules ) {
            this.modules[key].init();
        }
    }
};

/**
  * Fires after our Dom content has loaded
  */
document.addEventListener("DOMContentLoaded", function() {
    'use strict';
    Velocity.init();
});
},{"./modules/header":2,"./modules/parallax":3,"./modules/projects":4,"./modules/rating":5,"./modules/scroll":6,"./modules/slider":7}],2:[function(require,module,exports){
/**
 * The JavaScript for regulating our header
 */
var Header = {
    hamburgerMenu: document.getElementsByClassName('hamburger-menu'),
    header: document.getElementById('header'),
    headerMenu: document.getElementsByClassName('navigation-menu'),
    headroom: document.getElementsByClassName('header-headroom'),
    position: window.scrollY,
    up: false,
    init: function() {

        if( header.length == 0 ) {
            return;
        }

        this.scroll();
        this.hamburger();
    },

    // Handles scroll related events
    scroll: function() {
        window.addEventListener('scroll', function() {

            // Remove header-top class if it's not on the top
            if( window.scrollY > 50 ) {
                this.document.getElementById('header').classList.remove('header-top');
            } else {
                this.document.getElementById('header').classList.add('header-top');
            }

            // Apply headroom navigation
            if( Header.headroom.length > 0 ) {
                if( window.scrollY > Header.position && ! Header.up ) {
                    Header.up = ! Header.up;
                    Header.header.style.height = 0;
                    Header.header.style.opacity = 0;
                    Header.header.style.zIndex = -1;
                } else if( window.scrollY < Header.position && Header.up ) {
                    Header.up = ! Header.up;
                    Header.header.style.height = '84px';
                    Header.header.style.opacity = 1;
                    Header.header.style.zIndex = 999;
                }
                Header.position = window.scrollY;
            } 

        }); 
    },
    // Handles the hamburger menu
    hamburger: function() {

        if( Header.hamburgerMenu.length > 0 && Header.headerMenu.length > 0 ) {

            Header.hamburgerMenu[0].addEventListener('click', function(event) {
                event.preventDefault();

                var icon = Header.hamburgerMenu[0].getElementsByTagName('i')[0];

                icon.classList.toggle('icon-navicon');
                icon.classList.toggle('icon-times');

                // This is actually some vanilla js for some slideToggle based effect.
                if( Header.headerMenu[0].clientHeight == 0 ) {
                    Header.headerMenu[0].style.display  = 'block';
                    Header.headerMenu[0].style.height   = 0;

                    setTimeout(function () { 
                        var height = Header.headerMenu[0].clientHeight;
                        for ( var i = 0; i < Header.headerMenu[0].children.length; i++) {
                            height += Header.headerMenu[0].children[i].clientHeight;

                            if( Header.headerMenu[0].children[i].classList.contains('social-component') ) {
                                height += 42;
                            }
                        }
                        Header.headerMenu[0].style.height = height + 'px';
                        Header.headerMenu[0].style.opacity = 1; 
                    }, 0);

                } else {
                    Header.headerMenu[0].style.height = 0; 
                    Header.headerMenu[0].style.opacity = 0;

                    // Set display to none after the transition has eended.
                    Header.headerMenu[0].addEventListener('transitionend', function() {
                        this.style.display = 'none';  
                    }, {once: true});
                }               

            });

        }

    }
};

module.exports = Header;
},{}],3:[function(require,module,exports){
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
},{}],4:[function(require,module,exports){
/**
 * The JavaScript for loading projects and project previews
 * @note The projects element only works correctly now if there is a maximum of one element per page
 */
var Projects = {
    loading: false,
    modal: '',
    parser: new DOMParser(),
    page: 1,
    projects: document.querySelector('.projects-component'),
    url: window.location.href,
    slider: null,
    init: function() {     
        this.load();
        this.preview();
    },

    // Loads new projects
    load: function() {

        // Return to base
        if( this.projects == null ) {
            return;
        }

        // Load all our images at once
        if( typeof wpOptimizeLazyLoad !== 'undefined' ) {
            wpOptimizeLazyLoad.loadAll();
        }         

        // Only projects with infinite scroll load infinite
        if( ! this.projects.classList.contains('projects-load-infinite') ) {
            return;
        }   

        window.addEventListener('scroll', function() {

            // If we're loading, we always return
            if( Projects.loading ) {
                return;
            }

            if( window.scrollY + window.innerHeight > document.querySelector('body').clientHeight - 280 ) {

                // Continue to our next page
                Projects.page++;

                // We've maxed our pages
                if( Projects.page > Projects.projects.dataset.pages ) {
                    return;
                }                
                
                // We are loading. We can only reload once the previous request is done
                Projects.loading = true;

                var request = new XMLHttpRequest();
                request.open('GET', Projects.url + '?paged=' + Projects.page, true);
                request.onload = function(data) {

                    if( request.status >= 200 && request.status < 400 ) {
                        var loadedProjects = Projects.parser.parseFromString(request.response, 'text/html').querySelectorAll(".project-item");

                        for( var i = 0; i < loadedProjects.length; i++ ) {
                            Projects.projects.appendChild(loadedProjects[i]);
                        }

                        // Reinitialize our lazyload
                        if( typeof wpOptimizeLazyLoad !== 'undefined' ) {
                            wpOptimizeLazyLoad.update();
                        }
                        
                        // Reinitialize our click handlers
                        Projects.preview();

                        // Once we're done, we are finished loading
                        Projects.loading = false;

                    }

                };                    
                request.send();                
            }

        });

    },

    // Loads a (slider) pop-up when hitting preview
    preview: function() {

        // Return to base
        if( this.projects == null ) {
            return;
        }

        // Open the modal
        this.projects.querySelectorAll('.preview').forEach( function(el) {

            el.addEventListener('click', function(event) {
                event.preventDefault();

                // Safetynet to destroy existing modals might they exist
                var modals = document.getElementsByClassName('modal');

                for( var i = 0; i < modals.length; i++ ) {
                    modals[i].remove();
                }

                // Set-up videos or images
                if( this.dataset.preview.indexOf('video') !== -1 ) {

                    // Convert the video into the right embed
                    var src = this.dataset.preview.match(/video:{src:(.*?)}/)[1];

                    if( src.indexOf('youtube.com/watch?v=') !== -1 || src.indexOf('youtu.be') !== -1 ) {
                        src = new URL(src);

                        if( src.search ) {
                            src = 'https://www.youtube.com/embed/' + src.search.replace('?v=', '');
                        } else {
                            src = 'https://www.youtube.com/embed' + src.pathname;        
                        }
                    } else if( src.indexOf('vimeo.com') !== -1 ) {
                        src = new URL(src);
                        src = 'https://player.vimeo.com/video' + src.pathname;
                    }

                    Projects.modal = '<div class="entry-video"><div class="wp-video"><iframe src="' + src + '" height="1080" width="1920"></iframe></div></div>';

                } else if( this.dataset.preview.indexOf('images') !== -1 ) {
                    
                    var images = this.dataset.preview.replace('images:', '').split('{');

                    Projects.modal = '<ul class="entry-slider">';

                    images.forEach( function(image) {
                        if( image ) {
                            Projects.modal += '<li><figure class="entry-image"><img src="' + image.match(/src:(.*?),/)[1] + '" height="' + image.match(/.*?height:(.*?),/)[1] + '" width="' + image.match(/.*?width:(.*?)}/)[1] + '" /></figure></li>';
                        }
                    });

                    Projects.modal += '</ul>';
                   
                }

                // If we have a modal, append it
                if( Projects.modal ) {
                    Projects.modal = Projects.parser.parseFromString('<div class="modal">' + Projects.modal + '<a class="modal-close"><i class="icon-close"></i></a></div>', 'text/html');
                    Projects.modal = Projects.modal.lastChild.lastChild.firstChild; // Strips the html and body tag so it returns the correct modal.
                    
                    // Add the modal to the end of the body tag
                    Projects.modal.style.opacity = 0;
                    document.getElementsByTagName('body')[0].appendChild(Projects.modal); 
                    
                    // After a small wait, transition in our opacity
                    setTimeout( function() {
                        Projects.modal.style.opacity = 1;
                    }, 100); 
                    
                    // Initialize our slider for image based previews
                    if( typeof tns !== 'undefined' && typeof images !== 'undefined' ) {
                        Projects.slider = tns({container: '.entry-slider', controls: false});
                    }                    

                }

                // Close the modal
                document.querySelectorAll('.modal-close').forEach( function(el) {
                    el.addEventListener('click', function(event) {
                        event.preventDefault();

                        // Reset to opacity back to zero
                        el.parentElement.style.opacity = 0;

                        // Remove the modal after the transition has finished
                        el.parentElement.addEventListener('transitionend', function() {

                            if( Projects.slider !== null ) {
                                Projects.slider.destroy();
                            }

                            this.remove();

                        });
                        
                    });
                });                
                
            });
           
        });


    }

};

module.exports = Projects;
},{}],5:[function(require,module,exports){
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
},{}],6:[function(require,module,exports){
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
},{}],7:[function(require,module,exports){
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
},{}]},{},[1]);
