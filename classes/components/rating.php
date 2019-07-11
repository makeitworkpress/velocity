<?php
/**
 * Prepares the variables that are used in our share component template
 */
namespace Components;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Rating extends Components {  

    /**
     * The basic attributes for our class
     * 
     * @return Void
     */
    public function init() {
        
        // Our attributes
        $this->defaults = [
            'post'      => 0,   // The post ID to retrieve our values from
            'rating'    => ['count' => 0, 'value' => 0]    // The rating value.  May be used in ajax contexts to save a query
        ];

    }

    /**
     * Automatically returns the right title based on the template we're looking at
     * 
     * @return Void
     */
    public function populate() {

        // Our rating and id
        $this->vars['id']       = intval($this->atts['post']);
        $this->vars['rating']   = $this->atts['rating'];

        // Grabs the rating from the post meta
        if( $this->atts['post'] ) {
            $meta             = get_post_meta( $this->atts['post'], 'velocity_rating', true );
            
            if( isset($meta['count']) ) {
                $this->vars['rating']['count'] = intval($meta['count']);
            }

            if( isset($meta['value']) ) {
                $this->vars['rating']['value'] = floatval($meta['value']);
            }

        }

        // Calculate the amount of stars we need
        $this->vars['stars']    = ['empty' => 0, 'full' => 0, 'half' => 0];

        $whole      = floor($this->vars['rating']['value']);
        $fraction   = $this->vars['rating']['value'] - $whole;

        // Determine the amount of empty stars
        if( $this->vars['rating']['value'] <= 4.25) {
            if($fraction <= 0.25) {
                $this->vars['stars']['empty'] = floor(5 - $whole);
            } else {
                $this->vars['stars']['empty'] = floor(5 - $whole) - 1;
            }
        }

        // And the other stars
        $this->vars['stars']['full'] = $fraction >= 0.75 ? $whole + 1 : $whole;
        $this->vars['stars']['half'] = $fraction < 0.75 && $fraction > 0.25 ? 1 : 0;         

    }

}