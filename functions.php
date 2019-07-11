<?php
/**
 * Contains the major functions for this theme
 */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

/**
 * Registers the autoloading for theme classes
 */
spl_autoload_register( function($classname) {

    
    $class      = str_replace( '\\', DIRECTORY_SEPARATOR, str_replace( '_', '-', strtolower($classname) ) );
    $classes    = dirname(__FILE__) .  DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR .  $class . '.php';
    
    $vendor     = str_replace( 'makeitworkpress' . DIRECTORY_SEPARATOR, '', $class );
    $vendor     = 'makeitworkpress' . DIRECTORY_SEPARATOR . preg_replace( '/\//', '/src/', $vendor, 1 ); // Replace the first slash for the src folder
    $vendors    = dirname(__FILE__) .  DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . $vendor . '.php';

    if( file_exists($classes) ) {
        require_once( $classes );
    } elseif( file_exists($vendors) ) {
        require_once( $vendors );    
    }
   
} );

/**
 * Boot our theme
 */
$theme = Velocity::instance();