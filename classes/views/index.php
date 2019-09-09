<?php
/**
 * Prepares the variables that are used in our header template
 */
namespace Views;
use Components as Components;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Index extends Template {

    /**
     * Prepare our variables for public display
     */
    protected function populate() {

        // Easify our customizer data
        $custom                                 = $this->data['customize'];

        // The archive title
        $this->properties->title                = new Components\Title(['data' => $this->data]);      

        // The posts grid
        global $wp_query;
        $postType                               = isset($wp_query->query['post_type']) ? $wp_query->query['post_type'] : 'post';

        // If we query the type taxonomy, we show projects
        if( isset($wp_query->query['type']) ) {
            $postType = 'projects';
        }


        // The archive description and categories
        if( isset($custom[$postType . '_archive_description']) && $custom[$postType . '_archive_description'] ) {
            $this->properties->description      = term_description();
        } else {
            $this->properties->description      = false;
        }

        // Categories
        if( isset($custom[$postType . '_archive_categories']) && $custom[$postType . '_archive_categories'] ) {
            $this->properties->categoriesTitle  = $custom[$postType . '_archive_categories_text'];
            $this->properties->categories       = $postType == 'post' ? get_categories() : get_terms(['taxonomy' => 'type']);
            $this->properties->categoryActive   = isset( get_queried_object()->name ) ? get_queried_object()->name : '';          
        } else {
            $this->properties->categories       = false;   
        }         
        

        if( $postType == 'projects' ) {
            $this->properties->posts        = new Components\Projects( [
                'details'       => isset($custom['projects_archive_details']) && $custom['projects_archive_details'] ? $custom['projects_archive_details'] : '',                                                        
                'nothing'       => isset($custom['projects_archive_details']) && $custom['projects_archive_details'] ? $custom['projects_archive_nothing'] : __('No Projects Found!', 'velocity'), 
                'preview'       => isset($custom['projects_archive_details']) && $custom['projects_archive_details'] ? $custom['projects_archive_preview'] : '', 
                'summary'       => isset($custom['projects_archive_summary']) && $custom['projects_archive_summary'] ? true : false,                             
                'query'         => $wp_query,                       
                'url'           => isset($custom['projects_archive_url']) && $custom['projects_archive_url'] ? true : false                                          
            ] );
        } else {   

            $args = [
                'excerpt'       => isset($custom['post_archive_excerpt']) && $custom['post_archive_excerpt'] ? $custom['post_archive_excerpt'] : false,
                'logo'          => isset($custom['logo']) && $custom['logo'] ? wp_get_attachment_url( $custom['logo'] ) : '',
                'nothing'       => isset($custom['post_archive_nothing']) && $custom['post_archive_nothing'] ? $custom['post_archive_nothing'] : __('Oops! Nothing is found here.', 'velocity'),
                'pagination'    => true,
                'query'         => $wp_query,
                'readmore'      => isset($custom['post_archive_read_more']) && $custom['post_archive_read_more'] ? $custom['post_archive_read_more'] : false,
                'stack'         => isset($custom['post_archive_title_image']) && $custom['post_archive_title_image'] ? true : false,
                'style'         => isset($custom['post_archive_style']) && $custom['post_archive_style'] ? $custom['post_archive_style'] : 'list'
            ];

            // Add our meta data
            foreach( ['author', 'date', 'category', 'tags', 'comments', 'rating'] as $meta ) {
                if( isset($custom['post_archive_' . $meta . '_position']) && $custom['post_archive_' . $meta . '_position'] == 'title' ) {
                    $args['titlemeta'][]    = $meta;
                } elseif( isset($custom['post_archive_' . $meta . '_position']) && $custom['post_archive_' . $meta . '_position'] == 'top' ) {
                    $args['topmeta'][]      = $meta;
                } elseif( isset($custom['post_archive_' . $meta . '_position']) && $custom['post_archive_' . $meta . '_position'] == 'bottom' ) {
                    $args['bottommeta'][]   = $meta;
                }
            }

            $this->properties->posts        = new Components\Posts( $args );

        }

    }

}