<?php
/**
 * Prepares the variables that are used in our posts component template
 */
namespace Components;
use WP_Query as WP_Query;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Posts extends Components {  

    /**
     * Contains our query, useful to check if any posts are found
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
            'bottommeta'  => [],                                // Meta components shown below excerpt. Accepts 'author', category', 'date', 'rating' or 'tags'
            'categories'  => [],                                // The categories to query posts from
            'excerpt'     => false,                             // Whether to include the excerpt or not        
            'exclude'     => [],                                // The post ids to exclude
            'include'     => [],                                // The post ids to include    
            'image'       => true,                              // Whether to include the featured image or not                               
            'logo'        => '',                                // The logo used for microdata                            
            'nothing'     => __('Oops! Nothing is found here.', 'velocity'),      // The text shown when no posts are found
            'number'      => get_option('posts_per_page'),      // the number of posts to query
            'order'       => 'date',                            // How to order the posts
            'orderby'     => 'DESC',                            // How to order the posts
            'paged'       => get_query_var('paged') ? get_query_var('paged') : 1,
            'pagination'  => false,                              // Whether to show pagination or not
            'query'       => NULL,                              // Pass a custom WP_Query object
            'readmore'    => __('Read more &rsaquo;', 'velocity'),          // Whether to include a read more link or not. If set to a string, uses that text
            'titlemeta'   => [],                                // Meta components shown above title. Accepts 'author', category', 'date', 'rating' or 'tags' 
            'topmeta'     => [],                              // Meta components shown above excerpt.  Accepts 'author', category', 'date', 'rating' or 'tags'
            'stack'       => false,                             // Whether the title should stack on the featured image or not
            'style'       => 'list',                            // The style, either list or grid
            'tags'        => [],                                // The tags to query the posts from
            'type'        => 'post'                             // The post type to query
        ];

    }

    /**
     * Queries our posts and set the variables
     * 
     * @return Void
     */
    public function populate() {

        // Retrieve our posts
        if( isset($this->atts['query']) && $this->atts['query'] instanceof WP_Query ) {
            $this->query = $this->atts['query'];
        } else {

            // Default arguments
            $args  = [
                'category__in'      => $this->atts['categories'],
                'ep_integrate'      => true, // Integrate ElasticPress if possible
                'order'             => $this->atts['order'],
                'orderby'           => $this->atts['orderby'],
                'paged'             => $this->atts['paged'],
                'post__in'          => $this->atts['include'],
                'post__not_in'      => $this->atts['exclude'],            
                'posts_per_page'    => $this->atts['number'],
                'post_type'         => $this->atts['type'],
                'tag__in'           => $this->atts['tags']
            ];

            // Custom tax query for projects
            if( $this->atts['type'] == 'projects' && $this->atts['categories'] ) {
                $args['tax_query'] = [['taxonomy' => 'type', 'terms'=> $this->atts['categories']]];
            }

            $this->query = new WP_Query( $args );
        }

        // Formats our posts variables
        $this->vars = [
            'blogName'      => get_bloginfo('name'),
            'blogUrl'       => get_bloginfo('url'),                  
            'class'         => $this->atts['style'],
            'logo'          => $this->atts['logo'],
            'more'          => $this->atts['readmore'] ? $this->atts['readmore'] : false, 
            'nothing'       => $this->atts['nothing'] ? $this->atts['nothing'] : false, 
            'posts'         => []
        ];

        // Stack the title on top of the image
        if( $this->atts['stack'] ) {
            $this->vars['class'] .= ' stack-title';  
        }
        
        // Image sizes depends on the display style
        $imageSize = $this->atts['style'] == 'list' ? '768' : '320';

        foreach( $this->query->posts as $post ) {

            $this->vars['posts'][$post->ID] = [
                'author'        => get_the_author_meta('display_name', $post->post_author),          
                'bottomMeta'    => $this->atts['bottommeta'] ? new Meta(['data' => $this->atts['bottommeta'], 'post' => $post]) : false,
                'excerpt'       => $this->atts['excerpt'] ? $this->excerpt($post) : false,
                'image'         => $this->atts['image'] && has_post_thumbnail($post) ? get_the_post_thumbnail( $post, $imageSize ) : false, 
                'imageUrl'      => $this->atts['image'] && has_post_thumbnail($post) ? get_the_post_thumbnail_url( $post, $imageSize ) : false,
                'modified'      => get_the_modified_date('c', $post->ID ),
                'published'     => get_the_date('c', $post->ID ),
                'link'          => esc_url( get_permalink($post) ),   
                'title'         => esc_html( get_the_title($post) ), 
                'titleMeta'     => $this->atts['titlemeta'] ? new Meta(['data' => $this->atts['titlemeta'], 'post' => $post]) : false,
                'topMeta'       => $this->atts['topmeta'] ? new Meta(['data' => $this->atts['topmeta'], 'post' => $post]) : false 
            ];

        }

        // Set our pagination
        if( $this->atts['pagination'] && $this->query->max_num_pages > 1 ) {
            $this->vars['pagination'] = paginate_links( [
                'base'          => str_replace(999999999, '%#%', get_pagenum_link(999999999)),
                'current'       => $this->atts['paged'],
                'next_text'     => '&rsaquo;', 
                'prev_text'     => '&lsaquo;',
                'total'         => $this->query->max_num_pages                      
            ] ); 
        } else {
            $this->vars['pagination'] = false;
        } 

    }

    /**
     * Generates a custom excerpt for our post. Based upon wp_trim_excerpt;
     * 
     * @param WP_Post $post The WP_Post object
     */
    private function excerpt( $post = null ) {

        $raw_excerpt    = '';
        $text           = '';

        // Should be an instance of WP_Post
        if( isset($post->post_content) ) {
            $text = strip_shortcodes( $post->post_content );
            $text = apply_filters( 'the_content', $text );
            $text = str_replace(']]>', ']]&gt;', $text);

            $excerpt_length = apply_filters( 'excerpt_length', 55 );
            $excerpt_more   = apply_filters( 'excerpt_more', ' ' . '[&hellip;]' );
            $text           = wp_trim_words( $text, $excerpt_length, $excerpt_more ); 

        }
        
        return apply_filters( 'wp_trim_excerpt', $text, $raw_excerpt );

    }

}