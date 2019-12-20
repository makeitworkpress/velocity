<?php
/**
 * Prepares the variables that are used in our projects component template
 */
namespace Components;
use WP_Query as WP_Query;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Projects extends Components {  

    /**
     * Contains our query, useful to check if any projects are found
     * @access Public
     */
    public $query = null;    

    /**
     * The basic attributes for our class
     * 
     * @return Void
     */
    public function init() {
        
        // Our attributes
        $this->defaults = [
            'details'       => __('Details', 'velocity'),         // Show a details link     
            'exclude'       => [],                                // The post ids to exclude
            'include'       => [],                                // The post ids to include  
            'infinite'      => true,                              // Whether to allow or disallow infinite scrolling                                                        
            'nothing'       => __('Oops! No projects are found.', 'velocity'),      // The text shown when no posts are found
            'number'        => 12,      // the number of posts to query
            'order'         => 'date',                            // How to order the posts
            'orderby'       => 'DESC',                            // How to order the posts
            'paged'         => get_query_var('paged') ? get_query_var('paged') : 1, // The current page we're looking at
            'preview'       => __('Preview', 'velocity'),         // Show a preview link
            'summary'       => false,                             // Whether to include the summary or not  
            'type'          => [],                                // The categories to query posts from
            'query'         => NULL,                              // Pass a custom WP_Query object
            'url'           => true                               // Whether to include the custom url to the project 
        ];

        // Our default variable
        $this->vars = ['pages' => 1, 'projects' => []];

    }

    /**
     * Automatically returns the right title based on the template we're looking at
     * 
     * @return Void
     */
    public function populate() {

        if( isset($this->atts['query']) && $this->atts['query'] instanceof WP_Query ) {
            $this->query = $this->atts['query'];
        } else {

            // Default arguments
            $args  = [
                'fields'            => 'ids',
                'order'             => $this->atts['order'],
                'orderby'           => $this->atts['orderby'],
                'paged'             => $this->atts['paged'],
                'post__in'          => $this->atts['include'],
                'post__not_in'      => $this->atts['exclude'],            
                'posts_per_page'    => $this->atts['number'],
                'post_type'         => 'projects',
            ];

            // Load certain categories
            if( $this->atts['categories'] ) {
                $args['tax_query']  = [
                    ['taxonomy' => 'project_type', 'terms' => $this->atts['categories']]
                ];          
            }

            $this->query = new WP_Query( $args );
        }
        
        // Used for intinite scrolling
        $this->vars['infinite'] = $this->atts['infinite'] ? 'infinite' : 'none';
        $this->vars['pages']    = $this->query->max_num_pages;
        
        foreach( $this->query->posts as $post ) {

            $post       = is_numeric($post) ? $post : $post->ID;
            $preview    = '';
            $meta       = ['post' => get_post_meta($post, 'velocity_post_meta', true), 'project' => get_post_meta($post, 'velocity_project_meta', true)];

            // Adds preview data
            if( $this->atts['preview'] ) {
                if($meta['post']['video']) {
                    $preview .= "video:{src:" . $meta['post']['video'] . "}";
                } elseif($meta['project']['images']) {
                    $images     = array_filter(explode(',', $meta['project']['images']));
                    $preview   .= "images:";
                    foreach( $images as $image ) {
                        $image      = wp_get_attachment_image_src($image, '1920');
                        $preview    .= "{src:" . $image[0] . ",height:" . $image[2] . ",width:" . $image[1] . "},";
                    }
                }
            }

            // Fill our projects
            $this->vars['projects'][$post] = [
                'details'       => $this->atts['details'],
                'image'         => has_post_thumbnail($post) ? get_the_post_thumbnail($post, 'portfolio', ['itemprop' => 'image']) : false,
                'link'          => esc_url( get_the_permalink($post) ),
                'preview'       => $this->atts['preview'],
                'previewData'   => rtrim($preview, ','),
                'title'         => esc_html( get_the_title($post) ),
                'summary'       => $this->atts['summary'] && $meta['project']['summary'] ? esc_html($meta['project']['summary']) : '',
                'url'           => $this->atts['url'] && $meta['project']['url_text'] && $meta['project']['url_link'] ? esc_url($meta['project']['url_link']) : false,
                'urlText'       => $meta['project']['url_text'] ? esc_html($meta['project']['url_text']) : '',
            ];

        }

        // Enqueue the slider script
        $preview = $this->atts['preview'];
        add_action('wp_enqueue_scripts', function() use($preview) {
            if( ! wp_script_is('tinyslider') && $preview ) {
                wp_enqueue_script('tinyslider');
            }  
        }, 30); 

    }

}