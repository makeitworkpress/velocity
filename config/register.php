<?php
/**
 * Contains the configurations for the registration of custom posts, menus, image sizes and so fort
 * @since 1.0.0
 *
 * @author Michiel Tramper
 */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

// Default registrations 
$register = [
    'imageSizes' => [
        [ 'name' => 'tiny', 'width' => 50, 'height' => 50, 'crop' => true ], 
        [ 'name' => 'tiny-2x', 'width' => 100, 'height' => 100, 'crop' => true ], 
        [ 'name' => 'portfolio-tiny', 'width' => 320, 'height' => 320, 'crop' => true ], 
        [ 'name' => 'portfolio-small', 'width' => 480, 'height' => 384, 'crop' => true ], 
        [ 'name' => 'portfolio', 'width' => 600, 'height' => 480, 'crop' => true ], 
        [ 'name' => 'portfolio-2x', 'width' => 1200, 'height' => 960, 'crop' => true ],
        [ 'name' => '320', 'width' => 320, 'height' => 432, 'crop' => true ], 
        [ 'name' => '320-2x', 'width' => 640, 'height' => 864, 'crop' => true ], 
        [ 'name' => '480', 'width' => 480, 'height' => 432, 'crop' => true ], 
        [ 'name' => '480-2x', 'width' => 960, 'height' => 864, 'crop' => true ], 
        [ 'name' => '768', 'width' => 768, 'height' => 432, 'crop' => true ], 
        [ 'name' => '1024', 'width' => 1024, 'height' => 576, 'crop' => true ], 
        [ 'name' => '1366', 'width' => 1366, 'height' => 768, 'crop' => true ], 
        [ 'name' => '1600', 'width' => 1600, 'height' => 900, 'crop' => true ], 
        [ 'name' => '1920', 'width' => 1920, 'height' => 1080, 'crop' => true ], 
        [ 'name' => '2560', 'width' => 2560, 'height' => 1440, 'crop' => true ], 
        [ 'name' => '3840', 'width' => 3840, 'height' => 2160, 'crop' => true ] 
    ],
    'menus' => [
        'header'  => __( 'Header Navigation Menu', 'velocity' ),
        'footer'  => __( 'Footer  Navigation Menu', 'velocity' )
    ],
    'postTypes' => [
        [
            'name'      => 'projects',
            'plural'    => __( 'Projects', 'velocity' ),
            'singular'  => __( 'Project', 'velocity' ),
            'args'      => [
                'menu_icon'     => 'dashicons-images-alt', 
                'has_archive'   => true, 
                'show_in_rest'  => true,
                'supports'      => ['author', 'editor', 'thumbnail', 'title']
            ],
            'slug'      => 'projects'
        ]                         
    ],
    'taxonomies' => [
        [
            'name'          => 'project_type',
            'object'        => 'projects',
            'plural'        => __( 'Project Types', 'velocity' ),
            'singular'      => __( 'Project Type', 'velocity' ),
            'args'          => [
                'rewrite'           => ['hierarchical' => true, 'slug' => 'projects-type'],
                'show_in_rest'      => true,
                'show_ui'           => true,
                'show_admin_column' => true
            ]
        ]
    ]         
];