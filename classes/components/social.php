<?php
/**
 * Prepares the variables that are used in our social component template
 */
namespace Components;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Social extends Components {  

    /**
     * The basic attributes for our class
     * 
     * @return Void
     */
    public function init() {
        
        // Our attributes
        $this->defaults = [
            'custom' => [] // Contains the customizer data for retrieving our networks
        ];

        // Our default variable
        $this->vars = [
            'platforms' => []
        ];

    }

    /**
     * Automatically returns the right title based on the template we're looking at
     * 
     * @return Void
     */
    public function populate() {

        foreach( ['email', 'telephone', 'whatsapp', 'facebook', 'instagram', 'twitter', 'linkedin', 'youtube', 'vimeo', 'pinterest', 'github', 'reddit', 'behance', 'dribbble'] as $network ) {

            if( ! isset($this->atts['custom'][$network]) || ! $this->atts['custom'][$network] ) {
                continue;
            }

            // Some networks have a different format
            $prefix = false;
            if( in_array($network, ['telephone', 'whatsapp']) ) {
                $prefix = 'tel:';
            } elseif( $network == 'email' ) {
                $prefix = 'mailto:';
            } 

            // Build our network
            $this->vars['platforms'][$network] = [
                'name'  => ucwords( str_replace('-', ' ', $network) ),
                'url'   => $prefix ? esc_attr( $prefix . $this->atts['custom'][$network] ) : esc_url( $this->atts['custom'][$network] )
            ];

        }

    }

}