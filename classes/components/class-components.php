<?php
/**
 * This interface is the contract for how our components are formed
 */
namespace Components;
use ReflectionClass as ReflectionClass;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

abstract class Components {

    /**
     * Contains the merged attributes
     * @access protected
     */
    protected $atts = [];

    /**
     * Contains the component name
     * @access private
     */
    private $component = NULL;    

    /**
     * Contains the default attributes
     * Must be declared in init of a child class, so that arguments are automatically merged
     * @access protected
     */
    protected $defaults = [];    

    /**
     * Contains our template variables
     * @access protected
     */
    protected $vars; 

    /** 
     * Constructor.
     * @param Array     $args       The custom component arguments
     * @param Boolean   $init       Whether to initialize the components defaults or not
     * @param Boolean   $populate   Whether to populate the components vars or not
     * 
     * @return Void
     */
    final public function __construct( $args = [] ) {    
        
        // Retrieve our class name, which is also used to load the template
        $this->component    = strtolower( (new ReflectionClass($this))->getShortName() ) . '.php';

        // Initialize a component with the default properties. This function should just populate $defaults in child components.
        $this->init(); 

        // Parse the arguments
        $this->atts       = wp_parse_args( $args, $this->defaults );
        
        // Populate the component with properties
        $this->populate();

    }    
    
    /**
     * Initializes our component
     */        
    abstract public function init();

    /**
     * Populates our component variables with data
     * This function should populate $this->vars so that the template has data to show.
     */    
    abstract public function populate();
    
    /**
     * Renders the component by retrieving it's template file
     *
     * @param   Boolean $return     If the component should be echoed or returned.     
     * @return  String              String of template output if $return is set to true
     */      
    public function render( $return = false ) {

        // The name of our component
        $component = str_replace('.php', '', $this->component);

        // Set custom values for the given component
        ${$component} = apply_filters( 'velocity_' . $component . '_properties', $this->vars );

        // The component is not set
        if( ! $this->component ) {
            return;
        }

        // The component does not exist
        if( ! file_exists(get_template_directory() . '/templates/components/' . $this->component) ) {
            return;
        }        

        if( $return ) {
            ob_start();
        }        
        
        require( get_template_directory() . '/templates/components/' . $this->component );

        if( $return ) {
            return ob_get_clean();
        }

    }   

}