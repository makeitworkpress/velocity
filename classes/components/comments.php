<?php
/**
 * Prepares the variables that are used in our comments component template
 */
namespace Components;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Comments extends Components {  

    /**
     * The basic attributes for our class
     * 
     * @return Void
     */
    public function init() {
        
        // Our attributes
        $this->defaults = ['template' => ''];

    }

    /**
     * Automatically returns the right title based on the template we're looking at
     * 
     * @return Void
     */
    public function populate() {

        if( $this->atts['template'] ) {
            $this->vars['file'] = $this->atts['template'];
        }  else {
            $this->vars['file'] = '/templates/compatible/comments.php';
        }

    }

}