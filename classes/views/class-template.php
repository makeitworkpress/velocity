<?php
/**
 * The default set-up for a views class, used in templates
 */
namespace Views;
use Reflectionclass as Reflectionclass;
use stdClass as stdClass;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

abstract class Template {

    /**
     * Contains our template properties ment for public display
     * @access Public
     */
    public $properties;

    /**
     * Contains our custom data
     * @access Protected
     */
    protected $data = [];    

    /**
     * Constructor
     */
    public function __construct() {

        // What are we looking at
        $template         = strtolower( (new ReflectionClass($this))->getShortName() ) ;        

        /**
         * Load some data into our templates
         */
        $this->data = apply_filters( 'velocity_template_data', [
            'customize' => get_theme_mod('velocity_customizer'),
            'meta'      => ['project' => [], 'post' => []],
            'options'   => $template == 'header' || $template == 'singular' ? get_option('velocity_options') : [], // Options are only used in header or singular
        ] );
        
        // Post specific data. We want to save these queries only to the singular post template themselves, as they are not used always
        global $post;

        if( isset($post->ID) && is_singular() ) {
            $this->data['meta']['post']     = get_post_meta( $post->ID, 'velocity_post_meta', true);   
        }

        // Executes only if the Singular class is instanciated.
        if( isset($post->post_type) && $post->post_type == 'projects' && $template == 'singular' ) {
            $this->data['meta']['project']  = get_post_meta( $post->ID, 'velocity_project_meta', true);   
        }

        
        /**
         * Populates the properties variable (through the child classes)
         */
        $this->properties = new stdClass();
        $this->populate();


        /**
         * Makes all our properties filterable for devs
         */
        $this->properties = apply_filters('velocity_' . $template . '_propertes', $this->properties);

    }

    /**
     * Retrieves the template default header
     */
    public function header() {

        get_template_part('templates/header');

    } 
    
    /**
     * Retrieves the template default footer
     */
    public function footer() {
        
        get_template_part('templates/footer');

    }     

    /**
     * Children may use this function to populate this class with variables.
     */
    abstract protected function populate();

}