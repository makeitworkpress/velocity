<?php
/**
 * Prepares the variables that are used in our share component template
 */
namespace Components;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Share extends Components {  

    /**
     * The basic attributes for our class
     * 
     * @return Void
     */
    public function init() {
        
        // Our attributes
        $this->defaults = [
            'title'     => __('Share Post', 'velocity'),
            'position'  => 'default' // Accepts left (fixed to the left), right (fixed to the right) or default (in content).
        ];

        // Our default variable
        $this->vars = [
            'class'     => '',
            'networks'  => []
        ];

    }

    /**
     * Automatically returns the right title based on the template we're looking at
     * 
     * @return Void
     */
    public function populate() {

        global $post; 

        // Variables required in urls
        $image                  = has_post_thumbnail($post->ID) ? urlencode( wp_get_attachment_image_url(get_post_thumbnail_id($post->ID), 'hd') ) : '';
        $source                 = get_bloginfo('name');
        $title                  = urlencode( get_the_title($post->ID) );
        $url                    = urlencode( get_permalink($post->ID) );

        // Position class
        $this->vars['class']    = 'position-' . $this->atts['position'];
        $this->vars['title']    = $this->atts['position'] == 'default' ? $this->atts['title'] : '';

        // Our Networks
        $this->vars['networks'] = apply_filters( 'velocity_sharing_networks', [
            'twitter'       => ['icon' => 'twitter', 'title' => __('Share on Twitter', 'velocity'), 'url' => 'https://twitter.com/share?url=' . $url . '&text=' . $title ],
            'facebook'      => ['icon' => 'facebook', 'title' => __('Share on Facebook', 'velocity'), 'url' => 'https://www.facebook.com/sharer.php?u=' . $url ],
            'pinterest'     => ['icon' => 'pinterest', 'title' => __('Save on Pinterest', 'velocity'), 'url' => 'https://pinterest.com/pin/create/button/?url=' . $url . '&description=' . $title . '&media=' . $image ],
            'linkedin'      => ['icon' => 'linkedin', 'title' => __('Share on LinkedIn', 'velocity'), 'url' => 'http://www.linkedin.com/shareArticle?mini=true&url=' . $url . '&title=' . $title. '&source=' . $source  ],
            'reddit'        => ['icon' => 'reddit-alien', 'title' => __('Share on Reddit', 'velocity'), 'url' => 'http://www.reddit.com/submit?url=' . $url . '&title=' . $title ],
            'pocket'        => ['icon' => 'get-pocket', 'title' => __('Save to Pocket', 'velocity'), 'url' => 'https://getpocket.com/edit.php?url=' . $url],
        ], $url, $title );

    }

}