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