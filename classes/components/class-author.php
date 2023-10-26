<?php
/**
 * Prepares the variables that are used in our author component template
 */
namespace Components;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Author extends Components {  

    /**
     * The basic attributes for our class
     * 
     * @return Void
     */
    public function init() {
        
        // Our attributes
        $this->defaults = [
            'display' => 'biography' // Accepts either biography for a full biography or avatar for just an author avatar
        ];

    }

    /**
     * Automatically returns the right title based on the template we're looking at
     * 
     * @return Void
     */
    public function populate() {

        global $post;

        $this->vars = [
            'avatar'        => get_avatar($post->post_author, apply_filters('velocity_post_avatar_size', 112)),
            'description'   => get_the_author_meta( 'description', $post->post_author ),
            'display'       => $this->atts['display'],
            'name'          => get_the_author_meta('display_name', $post->post_author),
            'url'           => esc_url( get_author_posts_url($post->post_author) )
        ];


    }

}