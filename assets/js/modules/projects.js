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