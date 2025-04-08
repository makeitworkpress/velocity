<?php
/**
 * Contains the configurations for enqueued scripts
 * @since 1.0.0
 *
 * @author Michiel
 */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

$enqueue = [
    ['handle' => 'velocity', 'src' => get_template_directory_uri() . '/assets/css/velocity.min.css'],    
    ['handle' => 'tinyslider', 'src' => get_template_directory_uri() . '/assets/js/vendor/tinyslider.min.js', 'action' => 'register'],
    [
        'handle'    => 'velocity', 
        'src'       => get_template_directory_uri() . '/assets/js/velocity.min.js', 
        'name'      => 'velocity', 
        'localize'  => ['ajax' => admin_url( 'admin-ajax.php' ), 'nonce' => wp_create_nonce("bananapie")]
    ]
];