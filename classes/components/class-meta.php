<?php
/**
 * Prepares the variables that are used in our meta component template
 */
namespace Components;
use WP_Post as WP_post;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Meta extends Components {  

    /**
     * The basic attributes for our class
     * 
     * @return Void
     */
    public function init() {
        
        // Our attributes
        $this->defaults = ['data' => [], 'post' => null];

        // Our default variable
        $this->vars = [
            'author'    => false,
            'avatar'    => false,
            'category'  => false,
            'comments'  => false,
            'date'      => false,
            'rating'    => false,
            'tags'      => false,
            'type'      => false,
            'url'       => false,
        ];

    }

    /**
     * Automatically returns the right title based on the template we're looking at
     * 
     * @return Void
     */
    public function populate() {

        // Retrieve the post information
        if( $this->atts['post'] && $this->atts['post'] instanceof WP_Post ) {
            $post = $this->atts['post'];
        } else {
            global $post;
        }

        // Enable modules
        foreach( $this->atts['data'] as $meta ) {
            if( in_array($meta, array_keys($this->vars)) ) {
                $this->vars[$meta] = true;
            }
        }

        // Custom data
        if( $this->vars['author'] ) {
            $this->vars['author']   = sprintf( __('By %s', 'velocity'), get_the_author_meta('display_name', $post->post_author) );
            $this->vars['avatar']   = get_avatar( $post->post_author, apply_filters('velocity_projects_avatar_size', 28) );
        }
        
        if( $this->vars['category'] ) {
            $this->vars['category'] = get_the_term_list( $post->ID, 'category', '', ', ', '' ); // Retrieves categories seperated by comma    
        }

        if( $this->vars['comments'] && comments_open( $post->ID ) ) {
            $this->vars['comments'] = [
                'link'      => get_comments_link($post->ID), 
                'number'    => get_comments_number($post->ID), 
                'title'     => __('Leave a comment', 'velocity') 
            ];   
        } else {
            $this->vars['comments'] = false;    
        }       
        
        if( $this->vars['date'] ) {
            $this->vars['dateTime'] = get_the_date('c', $post->ID );
            $this->vars['date']     = get_the_date( get_option('date_format'), $post->ID );
        }

        // Displaying the rating
        if( $this->vars['rating'] ) {
            $this->vars['rating']   = new Rating(['post' => $post->ID]);   
        } 
        
        // Displaying the tags
        if( $this->vars['tags'] ) {
            $this->vars['tags']     = get_the_term_list( $post->ID, 'post_tag', '', ', ', '' );            
        }
        
        // Displaying project types
        if( $this->vars['type'] ) {
            $this->vars['type']     = get_the_term_list( $post->ID, 'project_type', '', ', ', '' );         // Retrieves the project types seperated by comma    
        }
        
        // Displaying project urls
        if( $this->vars['url'] ) {
            $meta = get_post_meta($post->ID, 'velocity_project_meta', true);
            if( $meta['url_text'] && $meta['url_link'] ) {
                $this->vars['url']      = esc_url($meta['url_link']);
                $this->vars['urlText']  = esc_html($meta['url_text']);
            } else {
                $this->vars['url']      = false;
            }
        }        

    }

}