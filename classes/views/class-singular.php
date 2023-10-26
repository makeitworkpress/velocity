<?php
/**
 * Prepares the variables that are used in our single template
 */
namespace Views;
use Components as Components;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Singular extends Template {

    /**
     * Prepare our variables for public display
     */
    protected function populate() {

        // Our post variable is set
        global $post;
        $custom                         = $this->data['customize'];
        $meta                           = $this->data['meta']['post'];

        /**
         * Title
         */
        $this->properties->id           = $post->ID;
        $this->properties->title        = isset($meta['disable_title']) && $meta['disable_title'] ? false : new Components\Title(['data' => $this->data]);

        /**
         * Main Content
         */

        // Author information
        $this->properties->authorAvatar = $post->post_type == 'post' && isset($custom['post_author_information']) && ($custom['post_author_information'] == 'avatar' || $custom['post_author_information'] == 'both') ? new Components\Author(['display' => 'avatar']) : false;
        $this->properties->author       = $post->post_type == 'post' && isset($custom['post_author_information']) && ($custom['post_author_information'] == 'biography' || $custom['post_author_information'] == 'both') ? new Components\Author() : false;


        // The post content
        $this->properties->content      = apply_filters( 'the_content', $post->post_content );

        // Enlarge first paragraph
        $this->properties->classes      = $post->post_type == 'post' && isset($custom['post_introduction']) && $custom['post_introduction'] ? 'enlarge-paragraph' : '';

        // Fullwidth template
        $this->properties->classes     .= isset($meta['fullwidth_content']) && $meta['fullwidth_content'] ? ' fullwidth-content' : '';

        // Readable content width (768px) for posts and projects
        $this->properties->classes     .= $post->post_type == 'post' || $post->post_type == 'projects' ? ' readable-width' : '';

        // Microschemes
        $this->properties->schema       = $post->post_type == 'post' ? 'itemprop="blogPost" itemscope="itemscope" itemtype="http://schema.org/BlogPosting"' : 'itemscope="itemscope" itemtype="http://schema.org/CreativeWork"';
        $this->properties->textSchema   = $post->post_type == 'post' ? 'articleBody' : 'text';
        $this->properties->type         = $post->post_type;
        $this->properties->blogSchema   = [
            'author'        => get_the_author_meta('display_name', $post->post_author),  
            'logo'          => isset($custom['logo']) && $custom['logo'] ? wp_get_attachment_url( $custom['logo'] ) : '',      
            'name'          => get_bloginfo('name'),        
            'image'         => get_the_post_thumbnail_url( $post->ID, '1920' ),
            'link'          => esc_url( get_permalink($post) ),   
            'modified'      => get_the_modified_date('c', $post->ID ),
            'published'     => get_the_date('c', $post->ID ),
            'url'           => get_bloginfo('url')
                  
        ];

        // Adverts
        $this->properties->headerAdvert     = isset($meta['advert_top']) && $meta['advert_top'] ? $this->getAdvert($meta['advert_top']) : false;
        $this->properties->floatingAdvert   = isset($meta['advert_right']) && $meta['advert_right'] ? $this->getAdvert($meta['advert_right']) : false;
        $this->properties->footerAdvert     = isset($meta['advert_bottom']) && $meta['advert_bottom'] ? $this->getAdvert($meta['advert_bottom']) : false;

        // Social Sharing
        $this->properties->topShare     = $post->post_type == 'post' && isset($custom['post_share_position']) && ($custom['post_share_position'] == 'top' || $custom['post_share_position'] == 'both') ? new Components\Share(['title' => $custom['post_share_title']]) : false;
        $this->properties->bottomShare  = $post->post_type == 'post' && isset($custom['post_share_position']) && ($custom['post_share_position'] == 'bottom' || $custom['post_share_position'] == 'both')  ? new Components\Share(['title' => $custom['post_share_title']]) : false;
        $this->properties->floatShare   = $post->post_type == 'post' && isset($custom['post_share_position']) && ($custom['post_share_position'] == 'left' || $custom['post_share_position'] == 'right') ? new Components\Share(['position' => $custom['post_share_position']]) : false;

        // Entry Meta
        if( isset($meta['disable_meta']) && $meta['disable_meta'] ) {

            $this->properties->meta = false;

        } else {

            $this->properties->meta = true;

            if( $post->post_type == 'post' ) {
                foreach( ['author', 'date', 'category', 'tags', 'comments', 'rating'] as $type ) {
                    if( isset($custom['post_' . $type . '_position']) &&  ($custom['post_' . $type . '_position'] == 'top' || $custom['post_' . $type . '_position'] == 'both') ) {
                        $topMeta[] = $type;
                    } 

                    if( isset($custom['post_' . $type . '_position']) &&  ($custom['post_' . $type . '_position'] == 'bottom' || $custom['post_' . $type . '_position'] == 'both') ) {
                        $bottomMeta[] = $type;    
                    } 

                }
            }

            // Entry Meta for projects
            if( $post->post_type == 'projects' ) {
                $topMeta[] = 'url';               
                if( isset($custom['projects_author']) && $custom['projects_author'] ) {
                    $topMeta[] = 'author';   
                } 
                if( isset($custom['projects_category']) && $custom['projects_category'] ) {
                    $topMeta[] = 'type';
                }                                   
            }

            $this->properties->topMeta = isset($topMeta) ? new Components\Meta(['data' => $topMeta]) : false;
            $this->properties->bottomMeta = isset($bottomMeta) ? new Components\Meta(['data' => $bottomMeta]) : false;            
            
        }

        /**
         * Footer Content
         */

        // The footer is disabled by default, unless we have content
        $this->properties->footer = false; 

        if( isset($meta['disable_footer']) && $meta['disable_footer'] ) {
            return;
        } else {

            // Post Pagination
            if( isset($custom[$post->post_type . '_pagination']) && in_array($post->post_type, ['post', 'projects']) && $custom[$post->post_type . '_pagination'] ) {
                $this->properties->footer       = true;
                $this->properties->pagination   = new Components\Pagination([
                    'next' => $custom[$post->post_type . '_pagination_next'], 
                    'prev' => $custom[$post->post_type . '_pagination_previous']
                ]);
            } else {
                $this->properties->pagination = false;
            }

            // Related posts
            if( isset($custom[$post->post_type . '_related']) && in_array($post->post_type, ['post', 'projects']) && $custom[$post->post_type . '_related'] ) {

                $args = [
                    'exclude'   => [$post->ID],
                    'number'    => 3,
                    'orderby'   => 'rand'
                ];

                // Uses ElasticPress to find Related Posts if installed
                if( function_exists('ep_find_related') ) {
                    $posts              = ep_find_related( $post->ID, 3 );
                    $related            = [];
                    foreach( $posts as $object ) {
                        $related[]      = $object->ID;
                    }
                    $args['include']    = $related;

                // Else, use tags and categories
                } else {

                    if( $post->post_type == 'post' ) {
                        $args['categories'] = wp_get_post_categories( $post->ID, ['fields' => 'ids'] ); 
                        $args['readmore']   = false; 
                        $args['stack']      = true; 
                        $args['style']      = 'grid'; 
                        $args['tags']       = wp_get_post_tags( $post->ID, ['fields' => 'ids'] );
                        $this->properties->related          = new Components\Posts( $args );
                    } elseif( $post->post_type == 'projects' ) {
                        $args['infinite']   = false;
                        $args['type']       = wp_get_post_terms( $post->ID, 'type', ['fields' => 'ids'] );
                        $this->properties->related          = new Components\Projects( $args );
                    }

                    // Our related component
                    $this->properties->relatedTitle     = $custom[$post->post_type . '_related_title'];

                    // If we have no posts, we don't display
                    if( ! $this->properties->related->query->posts ) {
                        $this->properties->related      = false;
                    } else {
                        $this->properties->footer       = true;
                    }

                }

            } else {
                $this->properties->related  = false;
            }
            
            // Comments
            if( $post->comment_status == 'open' ) {
                $this->properties->comments  = new Components\Comments(['post' => $post->ID]);
                $this->properties->footer    = true;
            } else {
                $this->properties->comments  = false;
            }

        }

    }

    /**
     * Retrieves the correct advert based on the id
     * 
     * @param   Int/String  $id     The id for the advert, as defined in the theme options
     * @return  String      $code   The value of the code field of the advert
     */
    private function getAdvert( $id ) {
        
        $code = '';

        // Search for the advert in our options
        foreach( $this->data['options']['adverts'] as $advert ) {
            if( $advert['id'] == $id && $advert['code'] ) {
                $code = html_entity_decode($advert['code']);
            }
        } 
        
        return $code;

    }

}