<?php
/**
 * Prepares the variables that are used in our header template
 */
namespace Views;
use Components as Components;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Header extends Template {

    /**
     * Prepare our variables for public display
     */
    protected function populate() {

        $custom                             = $this->data['customize'];
        
        // Header classes
        $this->properties->classes          = '';

        if( isset($custom['header_fixed']) && $custom['header_fixed'] ) {
            $this->properties->classes     .= 'header-fixed header-top';
        }

        if( isset($custom['header_headroom'] ) && $custom['header_headroom'] ) {
            $this->properties->classes     .= ' header-headroom';
        }

        if( isset($this->data['meta']['post']['transparent_header']) && $this->data['meta']['post']['transparent_header'] ) {
            $this->properties->classes     .= ' header-transparent';    
        }

        // We also offset our header if we've offset our images
        if( is_singular() ) {
            global $post;
            if( isset($custom[$post->post_type . '_featured_offset']) && $custom[$post->post_type . '_featured_offset'] ) {
                $this->properties->classes     .= ' header-offset';    
            }        
        }        
    
        // Social icons
        $this->properties->social           = isset($custom['social_position']) && ($custom['social_position'] == 'header' || $custom['social_position'] == 'both') ? new Components\Social(['custom' => $custom]) : false;

        // The logo
        $this->properties->logoScheme       = $this->data['options']['scheme'];
        $this->properties->logo             = isset($custom['logo']) && $custom['logo'] ? wp_get_attachment_image( $custom['logo'], 'full', false, ['class' => 'standard-logo', 'itemprop' => 'image'] ) : '';
        $this->properties->transparentLogo  = isset($custom['logo_transparent']) && $custom['logo_transparent'] ? wp_get_attachment_image( $custom['logo_transparent'], 'full', false, ['class' => 'alternative-logo'] ) : '';
 
        $this->properties->title            = esc_attr( get_bloginfo('name') );
        $this->properties->url              = esc_url( get_bloginfo('url') );       

        
        // Main Microschemes
        $this->properties->mainScheme       = is_singular('post') || is_archive() || is_search() ? 'itemscope="itemscope" itemtype="http://schema.org/Blog"' : 'itemprop="mainContentOfPage"'; 
    
    }

}