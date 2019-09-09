<?php
/**
 * Prepares the variables that are used in our title component template. This component is used in single titles
 */
namespace Components;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Title extends Components {  

    /**
     * The basic attributes for our class
     * 
     * @return Void
     */
    public function init() {
        
        // Our attributes
        $this->defaults = [
            'data' => ['customize' => [], 'meta' => ['post' => [], 'project' => []], 'options' => []] // Should contain the data object with custom options, customizer settings and post meta
        ];

        // Our default variable
        $this->vars = [
            'background'    => '',
            'class'         => '',
            'meta'          => false,
            'image'         => false,
            'scroll'        => false,
            'slides'        => [],
            'subtitle'      => false,
            'summary'       => false,
            'title'         => false,
            'video'         => false
        ];

    }

    /**
     * Automatically returns the right title based on the template we're looking at
     * 
     * @return Void
     */
    public function populate() {

        $custom = $this->atts['data']['customize'];

        /**
         *  Archives
         */
        if( is_archive() || is_home() ) {

   

            global $wp_query;

            /**
             * Retrieve the possible post type
             */
            $type = isset($wp_query->query['post_type']) ? $wp_query->query['post_type'] : 'post';

            // If we can query the type taxonomy, we also are viewing projects
            if( isset($wp_query->query['type']) ) {
                $type = 'projects';
            }            

            /**
             * Actual Titles
             */
            if ( is_day() ) { 
                $this->vars['title']            = sprintf( __( 'Daily Archives: <span>%s</span>', 'velocity' ), get_the_date() ); 
            } elseif( is_month() ) {
                $this->vars['title']            = sprintf( __( 'Monthly Archives: <span>%s</span>', 'velocity' ), get_the_date('F Y') );
            } elseif( is_year() ) {
                $this->vars['title']            = sprintf( __( 'Yearly Archives: <span>%s</span>', 'velocity' ), get_the_date('Y') ); 
            } elseif( is_author() ) {
                $author                         = get_the_author_meta( 'display_name', get_query_var('author') ); 
                if( $custom['post_archive_author_title'] ) {
                    $this->vars['title']        = str_replace( '{author}', '<span>' . $author . '</span>', $custom['post_archive_author_title']) ;
                } else {
                    $this->vars['title']        = sprintf( __( 'Posts written by: %s', 'velocity' ),  '<span>' . $author . '</span>' );
                }
            } elseif ( is_tax()|| is_category() || is_tag() ) {
                if( $custom[$type . '_archive_dynamic_title'] ) {
                    $this->vars['title']        = str_replace( '{term}', '<span>' . single_term_title( '', false ) . '</span>', $custom[$type . '_archive_dynamic_title']) ;
                } else {
                    $this->vars['title']        = single_term_title( '', false ); 
                }   
            } else {
                $dynamic                        = isset(get_queried_object()->labels->name) ? get_queried_object()->labels->name : __( 'Post Archives', 'velocity' );
                $this->vars['title']            = isset($custom[$type . '_archive_title']) && $custom[$type . '_archive_title'] ? str_replace('{type}', $dynamic, $custom[$type . '_archive_title']) : $dynamic;
            }

        }

        /** 
         * Search Page
         */
        if( is_search() ) {
            global $wp_query;
            $results    = $wp_query->found_posts;
            $term       = get_search_query();

            if( $custom['post_archive_search_title'] ) {
                $this->vars['title'] = str_replace(['{results}', '{search}'], ['<span>' . $results . '</span>', '<span>' . $term  . '</span>'], $custom['post_archive_search_title']);    
            } else {
                if( $results == 1 ) {
                    $this->vars['title'] = sprintf( __('%1$s result for: %2$s', 'velocity'), '<span>' . $results . '</span>', '<span>' . $term  . '</span>' ); 
                } else {
                    $this->vars['title'] = sprintf( __('%1$s results for: %2$s', 'velocity'), '<span>' . $results . '</span>', '<span>' . $term  . '</span>' ); 
                }
            }

        }

        /**
         * Singular Pages
         */
        if( is_singular() ) {
            
            global $post;

            $meta       = $this->atts['data']['meta']['post'];
            $options    = $this->atts['data']['options'];

            // Our post title
            $this->vars['title'] = $post->post_title;

            /**
             * Single Posts
             */
            if( $post->post_type == 'post' ) {

                // Our title entry-meta
                foreach( ['author', 'date', 'category', 'tags', 'rating'] as $type ) {
                    if( isset($custom['post_' . $type . '_position']) && $custom['post_' . $type . '_position'] == 'title') {
                        $enabled[] = $type;
                    }
                } 
                
                if( isset($enabled) ) {
                    $this->vars['meta'] = new Meta(['data' => $enabled]);
                }

            } 
            
            /**
             * Portfolio Projects
             */
            if( $post->post_type == 'projects' ) {

                // The Project Images
                $project = $this->atts['data']['meta']['project'];

                if( $project['images'] ) {

                    $images = array_filter(explode(',', $project['images']));
                    $size   = isset($custom['projects_images']) && $custom['projects_images'] == 'full' ? '1920' : '1024';

                    foreach( $images as $image ) {
                        $this->vars['slides'][] = wp_get_attachment_image( intval($image), $size, false, ['itemprop' => 'image'] );    
                    }

                    // Enqueue the slider script
                    add_action('wp_enqueue_scripts', function() {      
                        if( ! wp_script_is('tinyslider') ) {  
                            wp_enqueue_script('tinyslider');
                        }  
                    }, 30);               

                }

                // This class determines the correct display of our project images according to the width settings (either full or container)
                $this->vars['class'] .= isset($custom['projects_images']) ? 'image-' . $custom['projects_images'] : 'image-container';

                // Allows the display of a summary
                if( isset($custom['projects_summary']) && $custom['projects_summary'] ) {
                    $this->vars['summary'] = $project['summary'];
                }

            }


            /**
             * Our post background, featured image or video, as supported by posts or pages
             */
            if( in_array($post->post_type, ['post', 'page']) ) {

                // Parallax effect
                if( isset($custom[$post->post_type . '_featured_parallax']) && $custom[$post->post_type . '_featured_parallax'] ) {
                    $this->vars['class'] .= 'image-parallax';
                }                

                // Scrolling button
                if( isset($custom[$post->post_type . '_featured_scroll']) && $custom[$post->post_type . '_featured_scroll'] ) {
                    $this->vars['scroll'] = true;
                }

                // Default Image
                if( isset($custom[$post->post_type . '_featured_image']) && $custom[$post->post_type . '_featured_image'] == 'title' && has_post_thumbnail($post) ) {
                    $this->vars['image'] = get_the_post_thumbnail( $post, '1024', ['itemprop' => 'image'] );
                }  
                
                // Background Image
                if( isset($custom[$post->post_type . '_featured_image']) && $custom[$post->post_type . '_featured_image'] == 'background' && has_post_thumbnail($post) ) {

                    // Background images are styled differently (providing we don't have a video)
                    if( ! $meta['video'] ) {
                        $this->vars['class']       .= ' image-background';
                    }

                    if( isset($options['optimalizations']['lazyLoad']) && $options['optimize']['lazyLoad'] ) {
                        $this->vars['background']   = 'data-bg="url(' . get_the_post_thumbnail_url($post, '1920') . ')"';
                        $this->vars['class']       .= ' lazy';

                    // If we don't use lazy load, we add custom CSS defining our image at WP_Head. Hence, we load the appropriate image for each resolution
                    } else {

                        add_action('wp_head', function() use($post, $meta) {

                            // Background Images are ignored when a video is shown
                            if( $meta['video'] ) {
                                return;
                            }

                            $style      = '';
                
                            foreach(['3840', '2560', '1920', '1600', '1366', '1024', '768', '480', '480-2x', '320', '320-2x'] as $size) {
                                
                                $image[$size] = get_the_post_thumbnail_url( $post, $size );
                                
                                // Add normal queries
                                if( ! strpos($size, '-2x') && $image[$size]  ) {
                                    $style .= '@media screen and (max-width: ' . $size . 'px) {
                                        .main-header {
                                            background-image: url("' . $image[$size] . '");
                                        }
                                    }';
                                }

                            }
                
                            /**
                             * Retina images
                             */

                            // Retina images: 4K
                            if( $image['3840'] ) {
                                $style .= '@media screen and (max-width: 1920px) and (-webkit-min-device-pixel-ratio: 1.5) { 
                                    .main-header {
                                        background-image: url("' . $image['3840'] . '");
                                    }
                                }
                                @media screen and (max-width: 1600px) and (-webkit-min-device-pixel-ratio: 1.5) { 
                                    .main-header {
                                        background-image: url("' . $image['3840'] . '");
                                    }
                                }';
                            }
                
                            // Retina images: WQHD
                            if( $image['2560'] ) {
                                $style .= ' @media screen and (max-width: 1366px) and (-webkit-min-device-pixel-ratio: 1.5) {
                                    .main-header {
                                        background-image: url("' . $image['2560'] . '");
                                    }
                                }';                    
                            }                
                            
                            // Retina images: FHD
                            if( $image['1920'] ) {
                                $style .= '@media screen and (max-width: 1024px) and (-webkit-min-device-pixel-ratio: 1.5) {
                                    .main-header {
                                        background-image: url("' . $image['1920'] . '");
                                    }
                                }';                    
                            }
                                        
                            // Retina images: rest
                            $style .= '@media screen and (max-width: 768px) and (-webkit-min-device-pixel-ratio: 1.5) {
                                .main-header {
                                    background-image: url("' . $image['1600'] . '");
                                }
                            }
                            @media screen and (max-width: 480px) and (-webkit-min-device-pixel-ratio: 1.5) {
                                .main-header {
                                    background-image: url("' . $image['480-2x'] . '");
                                }
                            }
                            @media screen and (max-width: 320px) and (-webkit-min-device-pixel-ratio: 1.5) {
                                .main-header {
                                    background-image: url("' . $image['320-2x'] . '");
                                }
                            }'; 

                            // Output our styles
                            if($style) {
                                echo '<style type="text/css">' . $style . '</style>';
                            };

                        } );

                    }

                }

            }

            /**
             * Global title attributes
             */

            // The video counts for all post types and resets our existing images
            if( isset($meta['video']) && $meta['video'] ) {
                $this->vars['background']   = '';
                $this->vars['image']        = false;
                $this->vars['slides']       = [];
                $this->vars['scroll']       = false;

                // Portfolio may have full-width video's
                if( $post->post_type == 'projects' && $custom['projects_images'] == 'full') {
                    $height = 1080;
                    $width  = 1920;
                } else {
                    $height = 576;
                    $width  = 1024;
                }

                // Youtube and vimeo video's
                if( preg_match('#^https?://(?:www\.)?(?:youtube\.com/watch|youtu\.be/)#', $meta['video']) || preg_match('#^https?://(.+\.)?vimeo\.com/.*#', $meta['video']) ) {

                    // Format the url into the embedding urls
                    if( strpos($meta['video'], 'youtube.com/watch?v=') !== false || strpos($meta['video'], 'youtu.be') !== false ) {
                        $video                  = parse_url($meta['video']);
                        $meta['video']          = isset($video['query']) ? 'https://www.youtube.com/embed/' . str_replace('v=', '', $video['query']) : 'https://www.youtube.com/embed' . $video['path'];  
                    }

                    if( strpos($meta['video'], 'vimeo.com') !== false ) {
                        $meta['video']          = 'https://player.vimeo.com/video' . parse_url($meta['video'])['path'];
                    } 
                    
                    $src                        = isset($options['optimalizations']['lazyLoad']) && $options['optimalizations']['lazyLoad'] ? ' class="lazy" data-src="' . $meta['video'] . '"' : ' src="' . $meta['video'] . '"'; 
                    $this->vars['video']        = '<div class="wp-video" itemprop="video" itemscope="itemscope" itemtype="http://schema.org/VideoObject"><iframe width="' . $width . '" height="' . $height . '"' . $src . ' frameborder="0" allowfullscreen="true"></iframe></div>';
                
                // Regular video's
                } else {
                    $this->vars['video']        = wp_video_shortcode( ['height' => $height, 'src' => $meta['video'], 'width' => $width] );
                }

            }

            // If we have an overlay color, we add extra styling to the head
            if( isset($meta['overlay_color']) && $meta['overlay_color'] ) {
                add_filter( 'wp_custom_fields_css_properties', function($properties, $field) {
                    if( $field['id'] == 'overlay_color' ) {
                        $properties .= 'content:"";';
                    }
                    return $properties;
                }, 10, 2 );
            }

            // Add our offset class
            if( isset($custom[$post->post_type . '_featured_offset']) && $custom[$post->post_type . '_featured_offset'] ) {
                $this->vars['class']       .= ' image-offset';
            }
            
            // Subtitle
            if( isset($meta['subtitle']) && $meta['subtitle'] ) {
                $this->vars['subtitle']     = wpautop(do_shortcode($meta['subtitle']) );
            }



        }

    }


}