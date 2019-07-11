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

        // If we query the type taxonoy, we show posts
        if( isset($wp_query->query['type']) ) {
            $postType = 'projects';
        }


        // The archive description and categories
        if( $custom[$postType . '_archive_description'] ) {
            $this->properties->description      = term_description();
        }

        // Categories
        if( $custom[$postType . '_archive_categories'] ) {
            $this->properties->categoriesTitle  = $custom[$postType . '_archive_categories_text'];
            $this->properties->categories       = $postType == 'post' ? get_categories() : get_terms(['taxonomy' => 'type']);
            $this->properties->categoryActive   = isset( get_queried_object()->name ) ? get_queried_object()->name : '';          
        }         
        

        if( $postType == 'projects' ) {
            $this->properties->posts        = new Components\Projects( [
                'details'       => $custom['projects_archive_details'],                                                        
                'nothing'       => $custom['projects_archive_nothing'], 
                'preview'       => $custom['projects_archive_preview'], 
                'summary'       => $custom['projects_archive_summary'],                             
                'query'         => $wp_query,                       
                'url'           => $custom['projects_archive_url']                                           
            ] );
        } else {             

            $args = [
                'excerpt'       => $custom['post_archive_excerpt'],
                'nothing'       => $custom['post_archive_nothing'],
                'pagination'    => true,
                'query'         => $wp_query,
                'readmore'      => $custom['post_archive_read_more'],
                'stack'         => $custom['post_archive_title_image'],
                'style'         => $custom['post_archive_style']
            ];

            // Add our meta data
            foreach( ['author', 'date', 'category', 'tags', 'rating'] as $meta ) {
                if( $custom['post_archive_' . $meta . '_position'] == 'title' ) {
                    $args['titlemeta'][]    = $meta;
                } elseif( $custom['post_archive_' . $meta . '_position'] == 'top' ) {
                    $args['topmeta'][]      = $meta;
                } elseif( $custom['post_archive_' . $meta . '_position'] == 'bottom' ) {
                    $args['bottommeta'][]   = $meta;
                }
            }

            $this->properties->posts        = new Components\Posts( $args );

        }

    }

}