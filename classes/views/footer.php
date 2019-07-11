<?php
/**
 * Prepares the variables that are used in our footer template
 */
namespace Views;
use Components as Components;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Footer extends Template {

    /**
     * Prepare our variables for public display
     */
    protected function populate() {

        $custom                         = $this->data['customize'];

        // Footer Contents
        $this->properties->copyright    = str_replace('{date}', date('Y'), $custom['footer_copyright']);
        $this->properties->social       = $custom['social_position'] == 'footer' || $custom['social_position'] == 'both' ? new Components\Social(['custom' => $custom]) : false;

    }

}           