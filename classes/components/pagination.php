<?php
/**
 * Prepares the variables that are used in our posts pagination component template
 */
namespace Components;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Pagination extends Components {  

    /**
     * The basic attributes for our class
     * 
     * @return Void
     */
    public function init() {
        
        // Our attributes
        $this->defaults = [
            'next' => __('Next Post', 'velocity'),
            'prev' => __('Previous Post', 'velocity'),
        ];

        // Our default variable
        $this->vars = ['next' => '', 'prev' => ''];

    }

    /**
     * Automatically returns the right title based on the template we're looking at
     * 
     * @return Void
     */
    public function populate() {

        $this->vars = [
            'next'  => get_next_post_link( '%link', '<span>' . $this->atts['next'] . ' &rsaquo;</span> %title' ),
            'prev'  => get_previous_post_link( '%link', '<span> &lsaquo; ' . $this->atts['prev'] . '</span> %title' )
        ];
    }

}