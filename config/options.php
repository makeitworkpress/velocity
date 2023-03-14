<?php
/**
 * Contains the configurations for the options screen
 * @since 1.0.0
 *
 * @author Michiel Tramper
 */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

$options = [
    'capability'    => 'manage_options',
    'class'         => 'tabs-left',
    'id'            => 'velocity_options',
    'location'      => 'menu', 
    'menu_icon'     => 'dashicons-admin-generic',
    'menu_title'    => __('Velocity', 'velocity'),
    'menu_position' => 99,
    'title'         => __('Velocity Settings', 'velocity'),
    'sections'      => [
        'general'   => [
            'icon'          => 'settings',
            'id'            => 'general',
            'title'         => __('General Settings', 'velocity'),
            'description'   => __('General theme settings can be found here. Are you looking for lay-out related settings? These are located in the customizer.', 'velocity'),
            'fields'        => [
                [
                    'columns'       => 'half',
                    'description'   => __('Add the tracking identifier for Google Analytics here. It looks like this: UA-12345678-1. By default, it anonymizes visitor IPs.', 'velocity'),
                    'id'            => 'tracking',
                    'title'         => __('Google Analytics Tracking ID', 'velocity'),
                    'type'          => 'input'
                ],
                [
                    'columns'       => 'half',
                    'default'       => '',
                    'description'   => __('This determines what microdata is used, so that your website is resembling a person or organization.', 'velocity'),
                    'id'            => 'scheme',
                    'options'       => [
                        'organization' => __('Organization', 'velocity'),
                        'person'       => __('Person', 'velocity')
                    ],
                    'title'         => __('Microscheme for Website Representation', 'velocity'),
                    'type'          => 'select'
                ],
                [
                    'default'       => '',
                    'description'   => __('If set-up, adds a viglink script to the footer of this website.', 'velocity'),
                    'id'            => 'viglink',
                    'title'         => __('Viglink Key', 'velocity'),
                    'type'          => 'input'
                ]                                                                 
            ]      
        ],
        'optimize'   => [
            'icon'      => 'check_circle',
            'id'        => 'optimizations',
            'title'     => __('Optimizations', 'velocity'),
            'fields'    => [ 
                [
                    'default'       => '',
                    'description'   => __('Improve the loading performance for this theme by enabling optimalizations.', 'velocity'),
                    'id'            => 'optimize',
                    'options'       => [
                        'defer_CSS'                 => ['label' => __('Defer CSS', 'velocity')],
                        'defer_JS'                  => ['label' => __('Defer Javascript Loading', 'velocity')],
                        'disable_comments'          => ['label' => __('Disable Comments', 'velocity')],
                        'disable_block_styling'     => ['label' => __('Disable Block Styling', 'velocity')],
                        'disable_embed'             => ['label' => __('Disable Embed Scripts', 'velocity')],
                        'disable_emoji'             => ['label' => __('Disable Emoji', 'velocity')],
                        'disable_feeds'             => ['label' => __('Disable Feeds', 'velocity')],
                        'disable_heartbeat'         => ['label' => __('Disable Heartbeat', 'velocity')],
                        'slow_heartbeat'            => ['label' => __('Slow Down Heartbeat Script', 'velocity')],
                        'jquery_to_footer'          => ['label' => __('Move the jQuery Script to Footer', 'velocity')],
                        'disable_jquery'            => ['label' => __('Disable jQuery', 'velocity')],
                        'disable_jquery_migrate'    => ['label' => __('Disable jQuery Migrate', 'velocity')],
                        'disable_RSD'               => ['label' => __('Disable RSD', 'velocity')],
                        'disable_shortlinks'        => ['label' => __('Disable WordPress Shortlinks', 'velocity')],  
                        'disable_theme_editor'      => ['label' => __('Disable Theme Editor', 'velocity')],                     
                        'disable_version_numbers'   => ['label' => __('Remove WordPress Version Numbers from Scripts', 'velocity')],            
                        'disable_WLW_manifest'      => ['label' => __('Disable the WLW Manifest', 'velocity')],
                        'disable_WP_version'        => ['label' => __('Remove the WordPress Version from Front-end', 'velocity')],            
                        'disable_XMLRPC'            => ['label' => __('Disable XMLRPC', 'velocity')],
                        'limit_comments_JS'         => ['label' => __('Enqueue Comment JavaScript only on Comments', 'velocity')],
                        'remove_comments_style'     => ['label' => __('Remove Additional Styling for Comments', 'velocity')],
                        'limit_revisions'           => ['label' => __('Limit Post Revisions to 5', 'velocity')],
                    ],
                    'title'         => __('Theme Optimalizations', 'velocity'),
                    'type'          => 'checkbox'
                ],                                                                           
            ]      
        ],
        'ads'   => [
            'icon'      => 'attach_money',
            'id'        => 'adverts_section',
            'title'     => __('Adverts', 'velocity'),
            'fields'    => [ 
                [
                    'description'   => __('Add custom adverts which may be included in a post using shortcodes. Use [adsense id="1"] where the number is the ID of the ad.', 'velocity'),
                    'id'            => 'adverts',
                    'title'         => __('Adverts', 'velocity'),
                    'type'          => 'repeatable',
                    'fields'        => [
                        [
                            'columns'   => 'fourth',
                            'id'        => 'name',
                            'title'     => __('Advert Name', 'velocity'),
                            'type'      => 'input',
                        ],                        
                        [
                            'class'     => 'medium-text',
                            'columns'   => 'fourth',
                            'id'        => 'id',
                            'title'     => __('Advert ID', 'velocity'),
                            'type'      => 'input',
                            'subtype'   => 'number',
                            'min'       => 0,
                            'step'      => 1
                        ], 
                        [
                            'columns'   => 'half',
                            'id'        => 'code',
                            'title'     => __('Advert Script', 'velocity'),
                            'type'      => 'code'
                        ],                                                  
                    ]
                ],                                                                           
            ]      
        ]                
    ]     
];