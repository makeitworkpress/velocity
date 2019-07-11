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