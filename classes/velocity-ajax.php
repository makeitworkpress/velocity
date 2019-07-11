<?php
/**
 * Registers ajax actions executed by this theme
 */
use Components as Components;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Velocity_Ajax {
    
    /**
     * Class constructor
     */
    public function __construct() {
        
        // Automatically adds methods added to this class
        $actions = get_class_methods($this); 
        
        foreach($actions as $action) {
            if( $action != '__construct' && method_exists($this, $action) ) {
                add_action( 'wp_ajax_' . $action, array($this, $action) );
                add_action( 'wp_ajax_nopriv_' . $action, array($this, $action) );                
            }
        }
        
    }
    
    /**
     * Adds a rating to a post
     */
    public function addRating() {
        
        // Check nonce
        if( ! wp_verify_nonce( $_POST['nonce'], "bananapie") ) {
            wp_send_json_error();
        } 
          
        // Check if user input is numerical
        if( ! is_numeric($_POST['rating']) || ! is_numeric($_POST['id']) ) {
            wp_send_json_error();
        }

        $rating = intval($_POST['rating']);
        $id     = intval($_POST['id']); 
        
        // The post doesn't exist
        if( get_post_status($id) === false ) {
            wp_send_json_error();
        }
        
        // Proceed if the rating is numeric, and between 0 and 5
        if( $rating <= 5 && $rating > 0 ) {

            $current = get_post_meta( $id, 'velocity_rating', true );
            $new     = [];
            
            // Also count the amount of ratings
            if( isset($current['count']) && $current['count'] ) {
                $new['count'] = intval($current['count']) + 1;
            } else {
                $new['count'] = 1;
            }
            
            if( isset($current['value']) && $current['value'] ) {
                $new['value'] = ($current['value']*$current['count'] + $rating) / $new['count'];    
            } else {
                $new['value'] = $rating;
            }
            
            update_post_meta( $id, 'velocity_rating', $new);
            
            $component = new Components\Rating( ['rating' => $new] );
                     
            wp_send_json_success( $component->render(false) );
        
        } else {
            wp_send_json_error();    
        }

    }
    
}
