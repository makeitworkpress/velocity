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

        // Default title and description for the 404 page
        $this->properties->title            = $this->data['customize']['404_title'] ? $this->data['customize']['404_title'] : __('404 Error', 'velocity');
        $this->properties->description      = $this->data['customize']['404_description'] ? $this->data['customize']['404_description'] : __('The page you requested does not exist. Nothing could be shown here.', 'velocity');

    }

}