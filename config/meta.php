<?php
/**
 * Contains the configurations for page, project and post meta
 * @since 1.0.0
 *
 * @author Michiel
 */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

// Retrieves the current registered adds, so we can add them as
$adverts    = ['' => __('Select Advert', 'velocity')];

if( isset($data['options']['adverts']) && is_array($data['options']['adverts']) ) {
    foreach( $data['options']['adverts'] as $advert ) {
        $adverts[$advert['id']] = $advert['name'];
    }
}

// Regular Meta Fields
$meta = [
    'id'        => 'velocity_post_meta',
    'title'     => __('Custom Fields', 'velocity'),
    'screen'    => ['page', 'post', 'projects'],
    'type'      => 'post',
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => [
        'general' => [
            'id'        => 'section_one',
            'title'     => __('Default Options', 'velocity'),
            'icon'      => 'settings',
            'tabs'      => false,
            'fields'    => [
                [
                    'columns'       => 'fourth',
                    'id'            => 'transparent_header',
                    'title'         => __('Transparent Header', 'velocity'),
                    'description'   => __('Makes the Header Transparent', 'velocity'),
                    'type'          => 'checkbox',
                    'single'        => true,
                    'style'         => 'switcher',
                    'options'       => [
                        'enable'    => ['label' => __('Enable Transparent Header', 'velocity')]
                    ]            
                ],
                [
                    'columns'       => 'fourth',
                    'id'            => 'fullwidth_content',
                    'title'         => __('Fullwidth Content', 'velocity'),
                    'description'   => __('Removes all the marges and whitespace from the content. Useful if you are using page builders to build your page.', 'velocity'),
                    'type'          => 'checkbox',
                    'single'        => true,
                    'style'         => 'switcher',
                    'options'       => [
                        'enable'    => ['label' => __('Enable Fullwidth Content', 'velocity')]
                    ]            
                ],                          
                [
                    'columns'       => 'fourth',
                    'id'            => 'title_color',
                    'title'         => __('Title Color', 'velocity'),
                    'description'   => __('The text color for the title and subtitle', 'velocity'),
                    'type'          => 'colorpicker',
                    'selector'      => '.main-header, .main-header h1, .main-header h2, .main-header h3, .main-header h4, .main-header h5, .main-header h6, .main-header .entry-meta, .main-header .entry-meta a'
                ], 
                [
                    'columns'       => 'fourth',
                    'id'            => 'overlay_color',
                    'title'         => __('Background Overlay', 'velocity'),
                    'description'   => __('The background color for the title section. Choose a transparent color to use it as an overlay.', 'velocity'),
                    'type'          => 'colorpicker',
                    'selector'      => ['selector' => '.main-header:after', 'property' => 'background-color']          
                ], 
                [
                    'id'            => 'subtitle',
                    'title'         => __('Subtitle', 'velocity'),
                    'description'   => __('The subtitle content for this post, appearing below the title.', 'velocity'),
                    'type'          => 'editor',  
                    'settings'      => ['textarea_rows' => 3]          
                ],
                [
                    'id'            => 'video',
                    'title'         => __('Video', 'velocity'),
                    'description'   => __('The url to the video. A video replaces the featured image in a post, but not in the archives. Youtube and Vimeo urls can also be used.', 'velocity'),
                    'type'          => 'input',              
                    'subtype'       => 'url',              
                ],                 
                [
                    'id'            => 'heading_adverts',
                    'title'         => __('Custom Adverts', 'velocity'),
                    'type'          => 'heading',          
                ],                                 
                [
                    'columns'       => 'third',
                    'id'            => 'advert_top',
                    'title'         => __('Above Content Advert', 'velocity'),
                    'description'   => __('You may select and advert here which shows just above the content. These ads can be added in the theme settings.', 'velocity'),
                    'type'          => 'select',
                    'options'       => $adverts            
                ],
                [
                    'columns'       => 'third',
                    'id'            => 'advert_right',
                    'title'         => __('Right to Content Advert', 'velocity'),
                    'description'   => __('You may and advert here which floats to the right of the content. This is suitable for adverts that are 120px in width. These ads can be added in the theme settings.', 'velocity'),
                    'type'          => 'select',
                    'options'       => $adverts            
                ],  
                [
                    'columns'       => 'third',
                    'id'            => 'advert_bottom',
                    'title'         => __('Below Content Advert', 'velocity'),
                    'description'   => __('You may select an advert here which is shown at the bottom of the content. These ads can be added in the theme settings.', 'velocity'),
                    'type'          => 'select',
                    'options'       => $adverts            
                ], 
                [
                    'id'            => 'heading_disable',
                    'title'         => __('Disable Sections', 'velocity'),
                    'type'          => 'heading',          
                ],                 
                [
                    'columns'       => 'third',
                    'id'            => 'disable_title',
                    'title'         => __('Disable Title Section', 'velocity'),
                    'description'   => __('Removes the title section with the title and featured image.', 'velocity'),
                    'type'          => 'checkbox',
                    'single'        => true,
                    'style'         => 'switcher switcher-disable',
                    'options'       => [
                        'enable'    => ['label' => __('Disable Title Section', 'velocity')]
                    ]            
                ], 
                [
                    'columns'       => 'third',
                    'id'            => 'disable_meta',
                    'title'         => __('Disable Entry Meta Sections', 'velocity'),
                    'description'   => __('Removes the entry meta sections with information such as post tags, sharing buttons and author information.', 'velocity'),
                    'type'          => 'checkbox',
                    'single'        => true,
                    'style'         => 'switcher switcher-disable',
                    'options'       => [
                        'enable'    => ['label' => __('Disable Entry Meta', 'velocity')]
                    ]            
                ], 
                [
                    'columns'       => 'third',
                    'id'            => 'disable_footer',
                    'title'         => __('Disable Content Footer Section', 'velocity'),
                    'description'   => __('Removes the content footer section, containing related posts and comments.', 'velocity'),
                    'type'          => 'checkbox',
                    'single'        => true,
                    'style'         => 'switcher switcher-disable',
                    'options'       => [
                        'enable'    => ['label' => __('Disable Content Footer', 'velocity')]
                    ]            
                ],                                                                                         
            ]
        ]
    ]
];

// Are we viewing projects? Quick and dirty for now
$projects = [
    'id'        => 'velocity_project_meta',
    'title'     => __('Project Custom Fields', 'velocity'),
    'screen'    => ['projects'],
    'type'      => 'post',
    'context'   => 'normal',
    'priority'  => 'high',
    'sections'  => [
        'projects' => [
            'id'        => 'section_two',
            'title'     => __('Project Options', 'velocity'),
            'icon'      => 'camera_enhance',
            'tabs'      => false,
            'fields'    => [
                [
                    'columns'       => 'third',
                    'id'            => 'summary',
                    'title'         => __('Project Summary', 'velocity'),
                    'description'   => __('The summary for the project, also appearing in the projects template.', 'velocity'),
                    'type'          => 'textarea',
                    'rows'          => 2,            
                ],  
                [
                    'columns'       => 'third',
                    'id'            => 'url_text',
                    'title'         => __('Project Url Text', 'velocity'),
                    'description'   => __('The optional text that is shown for the project url', 'velocity'),
                    'type'          => 'input',        
                ], 
                [
                    'columns'       => 'third',
                    'id'            => 'url_link',
                    'title'         => __('Project Url', 'velocity'),
                    'description'   => __('The optional url to the project.', 'velocity'),
                    'type'          => 'input',        
                    'subtype'       => 'url',        
                ],   
                [
                    'id'            => 'images',
                    'title'         => __('Project Images', 'velocity'),
                    'description'   => __('The portfolio images for the project, shown at the beginning of the project. The featured image is used in the projects shortcode.', 'velocity'),
                    'multiple'      => true,
                    'type'          => 'media',              
                    'subtype'       => 'image',              
                ]                                                                                         
            ]
        ]
    ]
];