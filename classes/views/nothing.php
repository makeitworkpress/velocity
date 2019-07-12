<?php
/**
 * Prepares the variables that are used in our 404 template
 */
namespace Views;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Nothing extends Template {

    /**
     * Prepare our variables for public display
     */
    protected function populate() {

        $custom = $this->data['customize'];

        // Default title and description for the 404 page
        $this->properties->title            = isset($custom['404_title']) && $custom['404_title'] ? $custom['404_title'] : __('404 Error', 'velocity');
        $this->properties->description      = isset($custom['404_description']) && $custom['404_description'] ? $custom['404_description'] : __('The page you requested does not exist. Nothing could be shown here.', 'velocity');

    }

}