<?php
/**
 * This class adds custom shortcodes which can be used throughout the velocity theme
 * @since 1.0.0
 *
 * @author Michiel Tramper
 */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Velocity_Shortcodes {
    
    /**
     * Constructor for adding the shortcodes.
     */
    public function __construct() {


        // Retrieve our shortcode methods
        $methods = get_class_methods($this);

        foreach( $methods as $shortcode ) {

            // Skip our constructor, obviously.
            if( $shortcode == '__construct' ) {
                continue;
            }

            if( method_exists($this, $shortcode) ) {
                add_shortcode($shortcode, array($this, $shortcode), 10, 1);
            }

        }
    }

    /**
     * Shortcode that renders a button
     *
     * @param   array       $atts   The shortcode attributes
     * @return  string      $output The column HTML
     */    
	public function button( $atts) {

        // Attributes
		$atts = shortcode_atts(
            [
                "align"     => 'middle',
                "color"     => '',
                "label"     => '',
                "url"       => '',
                "target"    => '_self'
            ], 
            $atts
       );

       // The html
       $output  = '<a class="button ' . $atts['color'] . ' ' . $atts['align'] . '" href="' . $atts['url'] . '" title="' . $atts['label'] . '" target="' . $atts['target'] . '">';
       $output .=       $atts['label'];
       $output .= '</a>';

       return $output;
       
	}    
    
    /**
     * Shortcode that renders a column
     *
     * @param array $atts The shortcode attributes
     * @param string $content The shortcode content
     */
	function column( $atts, $content ) {
	    $atts = shortcode_atts( ["type" => 'half'], $atts );
        
        return '<div class="column ' . $atts['type'] . '">' . do_shortcode($content) . '</div>';
       
	}

    /**
     * Shortcode that renders a list of latest posts 
     *
     * @param array $atts The shortcode attributes
     * @return string $output The output generated
     */
	public function posts($atts) {

		$atts = shortcode_atts( [
            'bottommeta'  => '',                                // Meta components shown below excerpt. Accepts 'author', category', 'date', 'rating' or 'tags'
            'categories'  => '',                                // The categories to query posts from
            'excerpt'     => false,                             // Whether to include the excerpt or not        
            'exclude'     => '',                                // The post ids to exclude
            'include'     => '',                                // The post ids to include    
            'image'       => true,                              // Whether to include the featured image or not                               
            'nothing'     => __('Oops! Nothing is found here.', 'velocity'),      // The text shown when no posts are found
            'number'      => get_option('posts_per_page'),      // the number of posts to query
            'order'       => 'date',                            // How to order the posts
            'orderby'     => 'DESC',                            // How to order the posts
            'paged'       => get_query_var('paged') ? get_query_var('paged') : 1,
            'pagination'  => false,                              // Whether to show pagination or not
            'readmore'    => __('Read more &rsaquo;', 'velocity'),          // Whether to include a read more link or not. If set to a string, uses that text
            'titlemeta'   => '',                                // Meta components shown above title. Accepts 'author', category', 'date', 'rating' or 'tags' 
            'topmeta'     => '',                                // Meta components shown above excerpt.  Accepts 'author', category', 'date', 'rating' or 'tags'
            'stack'       => false,                             // Whether the title should stack on the featured image or not
            'style'       => 'list',                            // The style, either list or grid
            'tags'        => '',                                // The tags to query the posts from
            'type'        => 'post'                             // The post type to query
        ], $atts );
         
        // Format some of our attributes
        foreach( ['bottommeta', 'categories', 'exclude', 'include', 'tags',  'titlemeta', 'topmeta'] as $key ) { 
            if( ! is_array($atts[$key]) && $atts[$key] ) {
                $atts[$key] = explode(',', $atts[$key]);
            }
        }
        
        
        // Load our news component
        $posts = new Components\Posts($atts);
        
		// Return this string
        return $posts->render( true );
        
    }
    
    /**
     * Displays a selection of portfolio posts
     * 
     * @param array     $atts       The attributes for the portfolio posts
     * @return string   $output     The rendered output for the portfolio
     */
    public function projects( $atts ) {
		$atts = shortcode_atts( [
            'details'       => __('Details', 'velocity'),         // Show a details link      
            'exclude'       => [],                                // The post ids to exclude
            'include'       => [],                                // The post ids to include  
            'infinite'      => false,                              // Whether to allow or disallow infinite scrolling                                                          
            'nothing'       => __('Oops! No projects are found.', 'velocity'),      // The text shown when no posts are found
            'number'        => get_option('posts_per_page'),      // the number of posts to query
            'order'         => 'date',                            // How to order the posts
            'orderby'       => 'DESC',                              // How to order the posts
            'paged'         => get_query_var('paged') ? get_query_var('paged') : 1, // The current page we're looking at
            'preview'       => __('Preview', 'velocity'),         // Show a preview link
            'summary'       => false,                             // Whether to include the summary or not  
            'type'          => [],                                // The type to query projects from
            'url'           => true                                // Whether to include the custom url to the project 
        ], $atts );
         
        // Format some of our attributes
        foreach( ['exclude', 'include'] as $key ) {
            if( ! is_array($atts[$key]) && $atts[$key] ) {
                $atts[$key] = explode(',', $atts[$key]);
            }
        }
        
        // Load our news component
        $projects = new Components\Projects($atts);
        
		// Return this string
        return $projects->render( true );

    }
    
    /**
     * Github Gists 
     *
     * @param array $atts The shortcode attributes     
     */
	public function gist( $atts ) {
       $atts = shortcode_atts( ['url' => ''], $atts);
	   return '<script src="' . $atts['url'] . '.js"></script>';
	}

    /**
     * Tag Cloud
     *
     * @param array $atts The shortcode attributes     
     */
	public function topics($atts) {
        
        $atts = shortcode_atts( ['smallest' => 19, 'largest' => 19, 'unit' => 'px', 'echo' => false], $atts );
        
        return '<div class="tag-cloud">' . wp_tag_cloud($atts) . '</div>';
	}    

    /**
     * Displays an adsence add code
     *
     * @param array $atts The shortcode attributes     
     */
    public function adsense( $atts ) {

        $atts = shortcode_atts( [
            'class' => 'responsive', // Accepts responsive, large-rectangle, medium-rectangle, skyscraper for different behaviours and an additional float
            "id"    => 0             // Selects the add from the group options
        ], $atts); 
        
        $options    = get_option('velocity_options');
        $output     = '';

        if( ! isset($options['adverts']) ) {
            return $output;
        }

        // Match the advert
        foreach( $options['adverts'] as $advert ) {
            if($advert['id'] == $atts['id'] && $advert['code']) {
                $output = '<div class="advert ' . $atts['class'] . '">' . html_entity_decode($advert['code']) . '</div>';
            }
        }
        
        return $output;

    }
    
}