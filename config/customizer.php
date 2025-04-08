<?php
/**
 * Contains the configurations for the customizer settings
 * @since 1.0.0
 *
 * @author Michiel
 */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

$customizer = [
    'description'   => __('Customizer settings for the Velocity theme.', 'velocity'),
    'id'            => 'velocity_customizer',
    'title'         => __('Velocity', 'velocity'), 
    'sections'      => [
        [
            'id'            => 'title_tagline',
            'priority'      => 2,
            'title'         => __('Site Identity', 'velocity'), 
            'fields'        => [
                [
                    'default'       => '',
                    'id'            => 'logo',
                    'title'         => __('Logo Image', 'velocity'),
                    'type'          => 'media',
                ],             
                [
                    'default'       => '',
                    'id'            => 'logo_transparent',
                    'title'         => __('Transparent Logo Image', 'velocity'),
                    'description'   => __('This logo is used if a transparent header is enabled at post, page or project level.', 'velocity'),
                    'type'          => 'media',
                ]                
            ]          
        ],
        [
            'id'            => 'velocity_layout',
            'title'         => __('Layout', 'velocity'),
            'fields'    => [
                [
                    'default'       => '',
                    'id'            => 'layout_header',
                    'title'         => __('Header', 'velocity'),
                    'type'          => 'heading',
                    'choices'       => [
                        'header_fixed', 
                        'header_headroom'
                    ]                    
                ],              
                [
                    'default'       => '',
                    'id'            => 'header_fixed',
                    'title'         => __('Fixed Header', 'velocity'),
                    'type'          => 'checkbox'
                ],                 
                [
                    'default'       => '',
                    'id'            => 'header_headroom',
                    'title'         => __('Collapse Fixed Header', 'velocity'),
                    'description'   => __('The header will collapse when scrolling down.', 'velocity'),
                    'type'          => 'checkbox'
                ],                                               
                [
                    'default'       => '',
                    'id'            => 'layout_pages',
                    'title'         => __('Pages', 'velocity'),
                    'type'          => 'heading',
                    'choices'       => [
                        'page_featured_image', 
                        'page_featured_parallax',
                        'page_featured_offset',
                        'page_featured_scroll'
                    ]                      
                ],
                [
                    'choices'       => [
                        'background'    => __('As a Background of the Title Section', 'velocity'),
                        'title'         => __('As an Image above the Main Title', 'velocity'),
                    ],
                    'default'       => '',
                    'id'            => 'page_featured_image',
                    'title'         => __('Featured Image Display', 'velocity'),
                    'description'   => __('How do you want to display the featured image?', 'velocity'),
                    'type'          => 'select',
                ],
                [
                    'default'       => '',
                    'id'            => 'page_featured_parallax',
                    'title'         => __('Apply Parallax Effect', 'velocity'),
                    'description'   => __('Applies parallax effect to the image. Only applies when the image display is set-up as background image.', 'velocity'),
                    'type'          => 'checkbox'
                ],                 
                [
                    'default'       => '',
                    'id'            => 'page_featured_offset',
                    'title'         => __('Offset Featured Background Image', 'velocity'),
                    'description'   => __('Creates some extra whitespace around the Featured Image.', 'velocity'),
                    'type'          => 'checkbox'
                ],
                [
                    'default'       => '',
                    'id'            => 'page_featured_scroll',
                    'title'         => __('Show Scrolling Mouse', 'velocity'),
                    'description'   => __('Creates an animated mouse scroll button at the bottom of the Featured Image.', 'velocity'),
                    'type'          => 'checkbox'
                ],                                                               
                [
                    'default'       => '',
                    'id'            => 'layout_posts',
                    'title'         => __('Posts', 'velocity'),
                    'type'          => 'heading',
                    'choices'       => [
                        'post_featured_image', 
                        'post_featured_parallax',
                        'post_featured_offset',
                        'post_featured_scroll',
                        'post_author_position',
                        'post_author_information',
                        'post_date_position',
                        'post_category_position',
                        'post_comments_position',
                        'post_tags_position',
                        'post_rating_position',
                        'post_introduction',
                        'post_share_position',
                        'post_share_title',
                        'post_pagination',
                        'post_pagination_previous',
                        'post_pagination_next',
                        'post_related',
                        'post_related_title'
                    ]    
                ],
                [
                    'choices'       => [
                        'background'    => __('As a Background of the Title Section', 'velocity'),
                        'title'         => __('As an Image above the Main Title', 'velocity'),
                    ],
                    'default'       => '',
                    'id'            => 'post_featured_image',
                    'title'         => __('Featured Image Display', 'velocity'),
                    'description'   => __('How do you want to display the featured image?', 'velocity'),
                    'type'          => 'select',
                ],
                [
                    'default'       => '',
                    'id'            => 'post_featured_parallax',
                    'title'         => __('Apply Parallax Effect', 'velocity'),
                    'description'   => __('Applies parallax effect to the image. Only applies when the image display is set-up as background image.', 'velocity'),
                    'type'          => 'checkbox'
                ],                                
                [
                    'default'       => '',
                    'id'            => 'post_featured_offset',
                    'title'         => __('Offset Featured Background Image', 'velocity'),
                    'description'   => __('Creates some extra Whitespace around the Featured Image.', 'velocity'),
                    'type'          => 'checkbox'
                ], 
                [
                    'default'       => '',
                    'id'            => 'post_featured_scroll',
                    'title'         => __('Show Scrolling Mouse', 'velocity'),
                    'description'   => __('Creates an animated mouse scroll button at the bottom of the Featured Image.', 'velocity'),
                    'type'          => 'checkbox'
                ],                                
                [
                    'choices'       => [
                        ''          => __('Hide Author', 'velocity'),
                        'title'     => __('Above the Title', 'velocity'),
                        'top'       => __('At the Top of Content', 'velocity'),
                        'bottom'    => __('At the Bottom of Content', 'velocity'),
                        'both'      => __('At the Top and Bottom of Content', 'velocity'),
                    ],
                    'default'       => '',
                    'id'            => 'post_author_position',
                    'title'         => __('Display Post Author', 'velocity'),
                    'description'   => __('Where do you want to display your post author?', 'velocity'),
                    'type'          => 'select',
                ],
                [
                    'choices'       => [
                        ''          => __('No author information', 'velocity'),
                        'avatar'    => __('As an Avatar to the left of Content', 'velocity'),
                        'biography' => __('As a Biography at the Bottom of Content', 'velocity'),
                        'both'      => __('Both an Avatar and Biography', 'velocity'),
                    ],
                    'default'       => '',
                    'id'            => 'post_author_information',
                    'title'         => __('Post Author Information', 'velocity'),
                    'description'   => __('How do you want to display additional post author information?', 'velocity'),
                    'type'          => 'select',
                ],                                
                [
                    'choices'       => [
                        ''          => __('Hide Date', 'velocity'),
                        'title'     => __('Above the Title', 'velocity'),
                        'top'       => __('At the Top of Content', 'velocity'),
                        'bottom'    => __('At the Bottom of Content', 'velocity'),
                        'both'      => __('At the Top and Bottom of Content', 'velocity'),
                    ],
                    'default'       => 'title',
                    'id'            => 'post_date_position',
                    'title'         => __('Display Post Date', 'velocity'),
                    'description'   => __('Where do you want to display your post date?', 'velocity'),
                    'type'          => 'select',
                ],                
                [
                    'choices'       => [
                        ''          => __('Hide Category', 'velocity'),
                        'title'     => __('Above the Title', 'velocity'),
                        'top'       => __('At the Top of Content', 'velocity'),
                        'bottom'    => __('At the Bottom of Content', 'velocity'),
                        'both'      => __('At the Top and Bottom', 'velocity'),
                    ],
                    'default'       => '',
                    'id'            => 'post_category_position',
                    'title'         => __('Display Post Category', 'velocity'),
                    'description'   => __('Where do you want to display your post category?', 'velocity'),
                    'type'          => 'select',
                ],
                [
                    'choices'       => [
                        ''          => __('Hide Comments', 'velocity'),
                        'title'     => __('Above the Title', 'velocity'),
                        'top'       => __('At the Top of Content', 'velocity'),
                        'bottom'    => __('At the Bottom of Content', 'velocity'),
                        'both'      => __('At the Top and Bottom', 'velocity'),
                    ],
                    'default'       => '',
                    'id'            => 'post_comments_position',
                    'title'         => __('Display Post Comments', 'velocity'),
                    'description'   => __('Where do you want to display your post comments indicator?', 'velocity'),
                    'type'          => 'select',
                ],                
                [
                    'choices'       => [
                        ''          => __('Hide Tags', 'velocity'),
                        'title'     => __('Above the Title', 'velocity'),
                        'top'       => __('At the Top of Content', 'velocity'),
                        'bottom'    => __('At the Bottom of Content', 'velocity'),
                        'both'      => __('At the Top and Bottom', 'velocity'),
                    ],
                    'default'       => '',
                    'id'            => 'post_tags_position',
                    'title'         => __('Display Post Tags', 'velocity'),
                    'description'   => __('Where do you want to display your post tags?', 'velocity'),
                    'type'          => 'select',
                ],                                
                [
                    'choices'       => [
                        ''          => __('Hide Rating', 'velocity'),
                        'title'     => __('Above the Title', 'velocity'),
                        'top'       => __('At the Top of Content', 'velocity'),
                        'both'      => __('At the Top and Bottom', 'velocity'),
                    ],
                    'default'       => 'top',
                    'id'            => 'post_rating_position',
                    'title'         => __('Display Post Rating', 'velocity'),
                    'description'   => __('Where do you want to display your post ratings? This also enables people to rate posts.', 'velocity'),
                    'type'          => 'select',
                ], 
                [
                    'default'       => '',
                    'id'            => 'post_introduction',
                    'title'         => __('Enlarge First Paragraph', 'velocity'),
                    'description'   => __('Enlarges the first paragraph of the content.', 'velocity'),
                    'type'          => 'checkbox'
                ],                
                [
                    'choices'       => [
                        ''          => __('Hide Sharing Buttons', 'velocity'),
                        'top'       => __('At the Top of Content', 'velocity'),
                        'bottom'    => __('At the Bottom of Content', 'velocity'),
                        'both'      => __('At the Top and Bottom', 'velocity'),
                        'left'      => __('Floating to the Left', 'velocity'),
                        'right'     => __('Floating to the Right', 'velocity'),
                    ],
                    'default'       => '',
                    'id'            => 'post_share_position',
                    'title'         => __('Display Sharing Buttons', 'velocity'),
                    'description'   => __('Where do you want to display your social media sharing buttons?', 'velocity'),
                    'type'          => 'select',
                ], 
                [
                    'default'       => '',
                    'id'            => 'post_share_title',
                    'title'         => __('Title Above Sharing Buttons', 'velocity'),
                    'description'   => __('The title above sharing buttons. The title will not display for buttons floating to the left or right.', 'velocity'),
                    'type'          => 'text'
                ],                
                [
                    'default'       => '',
                    'id'            => 'post_pagination',
                    'title'         => __('Display Previous and Next Posts', 'velocity'),
                    'type'          => 'checkbox'
                ],
                [
                    'default'       => '',
                    'id'            => 'post_pagination_previous',
                    'title'         => __('Previous Post Text', 'velocity'),
                    'description'   => __('The text above the title for the previous post. Leave empty to remove.', 'velocity'),
                    'type'          => 'text'
                ],
                [
                    'default'       => '',
                    'id'            => 'post_pagination_next',
                    'title'         => __('Next Post Text', 'velocity'),
                    'description'   => __('The text above the title for the next post. Leave empty to remove.', 'velocity'),
                    'type'          => 'text'
                ],                                 
                [
                    'default'       => '',
                    'id'            => 'post_related',
                    'title'         => __('Display Related Posts', 'velocity'),
                    'type'          => 'checkbox'
                ],
                [
                    'default'       => '',
                    'id'            => 'post_related_title',
                    'title'         => __('Title Above Related Posts', 'velocity'),
                    'type'          => 'text'
                ],                                                                                  
                [
                    'default'       => '',
                    'id'            => 'layout_post_archive',
                    'title'         => __('Post Archives', 'velocity'),
                    'type'          => 'heading',
                    'choices'       => [
                        'post_archive_title', 
                        'post_archive_dynamic_title',
                        'post_archive_author_title',
                        'post_archive_search_title',
                        'post_archive_description',
                        'post_archive_categories',
                        'post_archive_categories_text',
                        'post_archive_style',
                        'post_archive_title_image',
                        'post_archive_author_position',
                        'post_archive_date_position',
                        'post_archive_category_position',
                        'post_archive_comments_position',
                        'post_archive_tags_position',
                        'post_archive_rating_position',
                        'post_archive_excerpt',
                        'excerpt_length',
                        'post_archive_read_more',
                        'post_archive_nothing'
                    ] 
                ],
                
                [
                    'default'       => '',
                    'id'            => 'post_archive_title',
                    'title'         => __('Default Archive Title', 'velocity'),
                    'description'   => __('A custom title for the archive. You may use {type} to display the label for the post type displayed.', 'velocity'),
                    'type'          => 'text'
                ],
                [
                    'default'       => '',
                    'id'            => 'post_archive_dynamic_title',
                    'title'         => __('Dynamic Archive Title', 'velocity'),
                    'description'   => __('A custom title when a tag or category is viewed. You may use {term} to display the specific term.', 'velocity'),
                    'type'          => 'text'
                ],
                [
                    'default'       => '',
                    'id'            => 'post_archive_author_title',
                    'title'         => __('Author Archive Title', 'velocity'),
                    'description'   => __('A custom title when an author category is viewed. You may use {author} to display the specific author.', 'velocity'),
                    'type'          => 'text'
                ],                
                [
                    'default'       => '',
                    'id'            => 'post_archive_search_title',
                    'title'         => __('Search Archive Title', 'velocity'),
                    'description'   => __('A custom title for the search page. You may use the {search} tag to display the searchterm or {results} tag to display the number of results.', 'velocity'),
                    'type'          => 'text'
                ],                                                  
                [
                    'default'       => '',
                    'id'            => 'post_archive_description',
                    'title'         => __('Display Category Descriptions', 'velocity'),
                    'type'          => 'checkbox'
                ],                
                [
                    'default'       => '',
                    'id'            => 'post_archive_categories',
                    'title'         => __('Display Post Categories', 'velocity'),
                    'type'          => 'checkbox'
                ], 
                [
                    'default'       => '',
                    'id'            => 'post_archive_categories_text',
                    'title'         => __('Text Above Post Categories', 'velocity'),
                    'type'          => 'text'
                ],                                  
                [
                    'choices'       => [
                        'list'     => __('List', 'velocity'),
                        'grid'      => __('Grid', 'velocity')
                    ],
                    'default'       => 'list',
                    'id'            => 'post_archive_style',
                    'title'         => __('Posts Display Style', 'velocity'),
                    'description'   => __('Either display a grid or a list of posts.', 'velocity'),
                    'type'          => 'select',
                ],
                [
                    'default'       => '',
                    'id'            => 'post_archive_title_image',
                    'title'         => __('Title Over Image', 'velocity'),
                    'description'   => __('Moves the title on top the Featured Image, providing a post has one.', 'velocity'),
                    'type'          => 'checkbox'
                ],                 
                [
                    'choices'       => [
                        ''          => __('Hide Author', 'velocity'),
                        'title'     => __('Above the Title', 'velocity'),
                        'top'       => __('Above the Excerpt', 'velocity'),
                        'bottom'    => __('Below the Excerpt', 'velocity')
                    ],
                    'default'       => '',
                    'id'            => 'post_archive_author_position',
                    'title'         => __('Display Post Author in Post Archive', 'velocity'),
                    'description'   => __('Where do you want to display your post author?', 'velocity'),
                    'type'          => 'select',
                ],                               
                [
                    'choices'       => [
                        ''          => __('Hide Date', 'velocity'),
                        'title'     => __('Above the Title', 'velocity'),
                        'top'       => __('Above the Excerpt', 'velocity'),
                        'bottom'    => __('Below the Excerpt', 'velocity')
                    ],
                    'default'       => '',
                    'id'            => 'post_archive_date_position',
                    'title'         => __('Display Post Date in Post Archive', 'velocity'),
                    'description'   => __('Where do you want to display your post date?', 'velocity'),
                    'type'          => 'select',
                ],                
                [
                    'choices'       => [
                        ''          => __('Hide Category', 'velocity'),
                        'title'     => __('Above the Title', 'velocity'),
                        'top'       => __('Above the Excerpt', 'velocity'),
                        'bottom'    => __('Below the Excerpt', 'velocity')
                    ],
                    'default'       => '',
                    'id'            => 'post_archive_category_position',
                    'title'         => __('Display Post Category in Post Archive', 'velocity'),
                    'description'   => __('Where do you want to display your post category?', 'velocity'),
                    'type'          => 'select',
                ],
                [
                    'choices'       => [
                        ''          => __('Hide Comments', 'velocity'),
                        'title'     => __('Above the Title', 'velocity'),
                        'top'       => __('Above the Excerpt', 'velocity'),
                        'bottom'    => __('Below the Excerpt', 'velocity')
                    ],
                    'default'       => '',
                    'id'            => 'post_archive_comments_position',
                    'title'         => __('Display Post Comments in Post Archive', 'velocity'),
                    'description'   => __('Where do you want to display your post comments indicator?', 'velocity'),
                    'type'          => 'select',
                ],                
                [
                    'choices'       => [
                        ''          => __('Hide Tags', 'velocity'),
                        'title'     => __('Above the Title', 'velocity'),
                        'top'       => __('Above the Excerpt', 'velocity'),
                        'bottom'    => __('Below the Excerpt', 'velocity')
                    ],
                    'default'       => '',
                    'id'            => 'post_archive_tags_position',
                    'title'         => __('Display Post Tags in Post Archive', 'velocity'),
                    'description'   => __('Where do you want to display your post tags?', 'velocity'),
                    'type'          => 'select',
                ],                                
                [
                    'choices'       => [
                        ''          => __('Hide Rating', 'velocity'),
                        'title'     => __('Above the Title', 'velocity'),
                        'top'       => __('Above the Excerpt', 'velocity'),
                        'bottom'    => __('Below the Excerpt', 'velocity')
                    ],
                    'default'       => '',
                    'id'            => 'post_archive_rating_position',
                    'title'         => __('Display Post Rating in Post Archive', 'velocity'),
                    'description'   => __('Where do you want to display your post ratings? This also enables people to rate posts.', 'velocity'),
                    'type'          => 'select',
                ],
                [
                    'default'       => '',
                    'id'            => 'post_archive_excerpt',
                    'title'         => __('Show Post Excerpt', 'velocity'),
                    'type'          => 'checkbox'
                ],                
                [
                    'default'       => 200,
                    'id'            => 'excerpt_length',
                    'title'         => __('Custom Excerpt Length', 'velocity'),
                    'type'          => 'number'
                ],                  
                [
                    'default'       => __('Read more', 'velocity'),
                    'selector'      => ['selector' => '.post .continue-reading', 'html' => true],
                    'id'            => 'post_archive_read_more',
                    'title'         => __('Read More Text', 'velocity'),
                    'description'   => __('The text shown for the read more message. Leave empty to remove.', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'text'
                ], 
                [
                    'default'       => __('Oops! Nothing is found here.', 'velocity'),
                    'id'            => 'post_archive_nothing',
                    'title'         => __('No Posts Found Text', 'velocity'),
                    'description'   => __('The text shown when no posts are found.', 'velocity'),
                    'type'          => 'textarea'
                ],                                                                                              
                [
                    'default'       => '',
                    'id'            => 'layout_projects',
                    'title'         => __('Projects', 'velocity'),
                    'type'          => 'heading',
                    'choices'       => [
                        'projects_images', 
                        'projects_featured_offset',
                        'projects_category',
                        'projects_author',
                        'projects_summary',
                        'projects_pagination',
                        'projects_pagination_previous',
                        'projects_pagination_next',
                        'projects_related',
                        'projects_related_title'
                    ]
                ],
                [
                    'choices'       => [
                        'full'          => __('As Wide as the Whole Screen', 'velocity'),
                        'container'     => __('As Wide as the Content Container', 'velocity'),
                    ],
                    'default'       => 'full',
                    'id'            => 'projects_images',
                    'title'         => __('Project Images Display', 'velocity'),
                    'description'   => __('How do you want to display the images or video?', 'velocity'),
                    'type'          => 'select',
                ],                
                [
                    'default'       => '',
                    'id'            => 'projects_featured_offset',
                    'title'         => __('Offset Portfolio Images', 'velocity'),
                    'description'   => __('Creates some extra Whitespace around the Portfolio Images or Video.', 'velocity'),
                    'type'          => 'checkbox'
                ],
                [
                    'default'       => '',
                    'id'            => 'projects_category',
                    'title'         => __('Display Project Category', 'velocity'),
                    'type'          => 'checkbox'
                ],                                               
                [
                    'default'       => '',
                    'id'            => 'projects_author',
                    'title'         => __('Display Project Author', 'velocity'),
                    'type'          => 'checkbox'
                ],
                [
                    'default'       => '',
                    'id'            => 'projects_summary',
                    'title'         => __('Display Project Summary', 'velocity'),
                    'type'          => 'checkbox'
                ],                                
                [
                    'default'       => '',
                    'id'            => 'projects_pagination',
                    'title'         => __('Display Previous and Next Projects', 'velocity'),
                    'type'          => 'checkbox'
                ],
                [
                    'default'       => '',
                    'id'            => 'projects_pagination_previous',
                    'title'         => __('Previous Project Text', 'velocity'),
                    'description'   => __('The text above the title for the previous project. Leave empty to remove.', 'velocity'),
                    'type'          => 'text'
                ],
                [
                    'default'       => '',
                    'id'            => 'projects_pagination_next',
                    'title'         => __('Next Project Text', 'velocity'),
                    'description'   => __('The text above the title for the next project. Leave empty to remove.', 'velocity'),
                    'type'          => 'text'
                ], 
                [
                    'default'       => '',
                    'id'            => 'projects_related',
                    'title'         => __('Display Related Projects', 'velocity'),
                    'type'          => 'checkbox'
                ],
                [
                    'default'       => '',
                    'id'            => 'projects_related_title',
                    'title'         => __('Title Above Related Projects', 'velocity'),
                    'type'          => 'text'
                ], 
                [
                    'default'       => '',
                    'id'            => 'layout_projects_archive',
                    'title'         => __('Projects Archives', 'velocity'),
                    'type'          => 'heading',
                    'choices'       => [
                        'projects_archive_title', 
                        'projects_archive_dynamic_title',
                        'projects_archive_description',
                        'projects_archive_categories',
                        'projects_archive_categories_text',
                        'projects_archive_details',
                        'projects_archive_preview',
                        'projects_archive_summary',
                        'projects_archive_nothing',
                        'projects_archive_url'
                    ]
                ],
                [
                    'default'       => '',
                    'id'            => 'projects_archive_title',
                    'title'         => __('Default Archive Title', 'velocity'),
                    'description'   => __('A custom title for the projects archive. You may use {type} to display the label for the post type displayed.', 'velocity'),
                    'type'          => 'text'
                ],
                [
                    'default'       => '',
                    'id'            => 'projects_archive_dynamic_title',
                    'title'         => __('Dynamic Archive Title', 'velocity'),
                    'description'   => __('A custom title when a project type viewed. You may use {term} to display the specific term.', 'velocity'),
                    'type'          => 'text'
                ],
                [
                    'default'       => '',
                    'id'            => 'projects_archive_description',
                    'title'         => __('Display Project Type Descriptions', 'velocity'),
                    'type'          => 'checkbox'
                ],                
                [
                    'default'       => '',
                    'id'            => 'projects_archive_categories',
                    'title'         => __('Display Project Types', 'velocity'),
                    'type'          => 'checkbox'
                ], 
                [
                    'default'       => '',
                    'id'            => 'projects_archive_categories_text',
                    'title'         => __('Text Above Project Types', 'velocity'),
                    'type'          => 'text'
                ],                
                [
                    'default'       => '',
                    'id'            => 'projects_archive_details',
                    'title'         => __('Projects Details Text', 'velocity'),
                    'description'   => __('The text used to display the permalink to the project. Leave empty to remove.', 'velocity'),
                    'type'          => 'text'
                ],
                [
                    'default'       => '',
                    'id'            => 'projects_archive_preview',
                    'title'         => __('Projects Preview Text', 'velocity'),
                    'description'   => __('The text used to display a preview link, which opens a pop-up with the project video or images. Leave empty to remove.', 'velocity'),
                    'type'          => 'text'
                ],
                [
                    'id'            => 'projects_archive_summary',
                    'title'         => __('Enable Projects Summary', 'velocity'),
                    'description'   => __('Whether to show the project summary or noy.', 'velocity'),
                    'type'          => 'checkbox'
                ],
                [
                    'default'       => '',
                    'id'            => 'projects_archive_nothing',
                    'title'         => __('No Projects Found Text', 'velocity'),
                    'description'   => __('The text that is shown when no projects are found.', 'velocity'),
                    'type'          => 'text'
                ],                
                [
                    'id'            => 'projects_archive_url',
                    'title'         => __('Enable Projects Url', 'velocity'),
                    'description'   => __('Whether to show the url to a project or noy.', 'velocity'),
                    'type'          => 'checkbox'
                ],                                                                                                                                  
                [
                    'default'       => '',
                    'id'            => 'layout_404',
                    'title'         => __('404 Page', 'velocity'),
                    'type'          => 'heading',
                    'choices'       => [
                        '404_title', 
                        '404_description'
                    ]
                ],
                [
                    'default'       => __('404 Error', 'velocity'),
                    'id'            => '404_title',
                    'title'         => __('404 Page Title', 'velocity'),
                    'description'   => __('The title shown at the 404 page.', 'velocity'),
                    'type'          => 'text'
                ],
                [
                    'default'       => __('The page you requested does not exist. Nothing could be shown here.', 'velocity'),
                    'id'            => '404_description',
                    'title'         => __('404 Page Description', 'velocity'),
                    'description'   => __('The description shown at the 404 page.', 'velocity'),
                    'type'          => 'textarea'
                ],                                                                                                                                                                                                                           
                [
                    'default'       => '',
                    'id'            => 'layout_footer',
                    'title'         => __('Footer', 'velocity'),
                    'type'          => 'heading',
                    'choices'       => [
                        'footer_copyright'
                    ]
                ], 
                [
                    'default'       => '©{date}',
                    'selector'      => ['selector' => '.copyright', 'html' => true],
                    'id'            => 'footer_copyright',
                    'title'         => __('Copyright Message', 'velocity'),
                    'description'   => __('The copyright message shown on the left opf the footer. Use {date} tag for a dynamic date.', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'textarea'
                ]                                                                                                                     
            ]
        ],         
        [
            'id'            => 'velocity_colors',
            'title'         => __('Colors', 'velocity'),
            'fields'    => [ 
                [
                    'default'       => '',
                    'id'            => 'general_colors_heading',
                    'title'         => __('General Colors', 'velocity'),
                    'type'          => 'heading',
                    'choices'       => [
                        'body_font_color', 
                        'body_heading_color',
                        'body_link_color',
                        'body_link_hover_color',
                        'body_button_background_color',
                        'body_button_color'
                    ]
                ], 
                [
                    'default'       => '',
                    'selector'      => 'body, .pagination-component a',
                    'id'            => 'body_font_color',
                    'title'         => __('General Font Color', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],                  
                [
                    'default'       => '',
                    'selector'      => 'h1, h2, h3, h4, h5, h6, .posts-component .entry-title a, .projects-component .entry-title a',
                    'id'            => 'body_heading_color',
                    'title'         => __('General Heading Color', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'default'       => '',
                    'selector'      => 'a, .pagination-component a span, .entry-rating a',
                    'id'            => 'body_link_color',
                    'title'         => __('General Link Color', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'default'       => '',
                    'selector'      => 'a:hover, .pagination-component a:hover span, .posts-component.grid .post-title a:hover, .entry-rating a:hover, .entry-meta a:hover',
                    'id'            => 'body_link_hover_color',
                    'title'         => __('General Link Hover Color', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'default'       => '',
                    'selector'      => [
                        'selector' => '.button, .tag-cloud a, .categories a, .wp-block-file .wp-block-file__button, .wp-block-button__link', 
                        'property' => 'background-color'
                    ],
                    'id'            => 'body_button_background_color',
                    'title'         => __('Button Background Color', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ], 
                [
                    'default'       => '',
                    'selector'      => '.button, .button:hover, .tag-cloud a, .categories a, .wp-block-file .wp-block-file__button, .wp-block-button__link',
                    'id'            => 'body_button_color',
                    'title'         => __('Button Text Color', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],                               
                [
                    'default'       => '',
                    'id'            => 'header_colors_heading',
                    'title'         => __('Header Colors', 'velocity'),
                    'type'          => 'heading',
                    'choices'       => [
                        'header_background_color', 
                        'header_link_color', 
                        'header_link_hover_color', 
                        'header_link_hover_background_color', 
                        'header_transparent_link_color', 
                        'header_transparent_link_hover_color', 
                        'header_transparent_link_hover_background_color', 
                        'header_hamburger_color', 
                        'header_transparent_hamburger_color', 
                        'header_submenu_color'
                    ]
                ],
                [
                    'default'       => '',
                    'selector'      => ['selector' => '.header', 'property' => 'background-color'],
                    'id'            => 'header_background_color',
                    'title'         => __('Header Background Color', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],                                  
                [
                    'default'       => '',
                    'selector'      => '.header .navigation-menu .menu a',
                    'id'            => 'header_link_color',
                    'title'         => __('Navigation Link Color', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'default'       => '',
                    'selector'      => '.header .navigation-menu .menu a:hover, .header .navigation-menu .menu .current-menu-item > a',
                    'id'            => 'header_link_hover_color',
                    'title'         => __('Navigation Hover & Active Color', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'default'       => '',
                    'selector'      => ['selector' => '.header .navigation-menu .menu a:hover, .header .navigation-menu .menu .current-menu-item > a', 'property' => 'background-color'],
                    'id'            => 'header_link_hover_background_color',
                    'title'         => __('Navigation Hover & Active Background Color', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],                
                [
                    'default'       => '',
                    'selector'      => '.header-transparent .navigation-menu .menu  a',
                    'id'            => 'header_transparent_link_color',
                    'title'         => __('Transparent Navigation Color', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'default'       => '',
                    'selector'      => '.header-transparent .navigation-menu .menu a:hover, .header-transparent .navigation-menu .menu .current-menu-item > a',
                    'id'            => 'header_transparent_link_hover_color',
                    'title'         => __('Transparent Navigation Hover & Active Color', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'default'       => '',
                    'selector'      => ['selector' => '.header-transparent .navigation-menu .menu a:hover, .header-transparent .navigation-menu .menu .current-menu-item > a', 'property' => 'background-color'],
                    'id'            => 'header_transparent_link_hover_background_color',
                    'title'         => __('Transparent Navigation Hover & Active Background Color', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'default'       => '',
                    'selector'      => '.header .hamburger-menu',
                    'id'            => 'header_hamburger_color',
                    'title'         => __('Navigation Hamburger Menu Color', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'default'       => '',
                    'selector'      => '.header-transparent.header-top .hamburger-menu',
                    'id'            => 'header_transparent_hamburger_color',
                    'title'         => __('Transparent Navigation Hamburger Menu Color', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'default'       => '',
                    'selector'      => '.header .navigation-menu .menu .sub-menu a',
                    'id'            => 'header_submenu_color',
                    'title'         => __('Navigation Dropdown Menu Color', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],                                                                                                   
                [
                    'default'       => '',
                    'id'            => 'content_colors_heading',
                    'title'         => __('Content Colors', 'velocity'),
                    'type'          => 'heading',
                    'choices'       => [
                        'content_title_background_color', 
                        'content_main_background_color', 
                        'content_blockquotes_color', 
                        'content_meta_color', 
                        'content_footer_background_color'
                    ]
                ],
                [
                    'default'       => '',
                    'selector'      => ['selector' => '.main-header', 'property' => 'background-color'],
                    'id'            => 'content_title_background_color',
                    'title'         => __('Main Title Background Color', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'default'       => '',
                    'selector'      => ['selector' => '.main-content', 'property' => 'background-color'],
                    'id'            => 'content_main_background_color',
                    'title'         => __('Main Content Background Color', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ], 
                [
                    'default'       => '',
                    'selector'      => 'blockquote',
                    'id'            => 'content_blockquotes_color',
                    'title'         => __('Blockquotes Font Color', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ], 
                [
                    'default'       => '',
                    'selector'      => '.entry-meta, .entry-meta a, .comment-metadata, .comment-metadata a, .author-biography',
                    'id'            => 'content_meta_color',
                    'title'         => __('Post Meta Font Color', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],                               
                [
                    'default'       => '',
                    'selector'      => ['selector' => '.main-footer', 'property' => 'background-color'],
                    'id'            => 'content_footer_background_color',
                    'title'         => __('Content Footer Background Color', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ], 
                [
                    'default'       => '',
                    'id'            => 'project_colors_heading',
                    'title'         => __('Single Project Colors', 'velocity'),
                    'type'          => 'heading',
                    'choices'       => [
                        'project_slider_color', 
                        'project_slider_button_color'
                    ]
                ],
                [
                    'default'       => '',
                    'selector'      => ['selector' => '.tns-outer', 'property' => 'background-color'],
                    'id'            => 'project_slider_color',
                    'title'         => __('Project Slider Background Color', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'default'       => '',
                    'selector'      => ['selector' => '.tns-nav button.tns-nav-active', 'property' => 'background-color'],
                    'id'            => 'project_slider_button_color',
                    'title'         => __('Project Slider Active Button Color', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],                                                 
                [
                    'default'       => '',
                    'id'            => 'projects_colors_heading',
                    'title'         => __('Projects Grid Colors', 'velocity'),
                    'type'          => 'heading',
                    'choices'       => [
                        'projects_overlay_color', 
                        'projects_overlay_text_color', 
                        'projects_overlay_color_secondary', 
                        'projects_overlay_color_tertiary'
                    ]
                ],
                [
                    'default'       => '',
                    'selector'      => ['selector' => '.project-content', 'property' => 'background-color'],
                    'id'            => 'projects_overlay_color',
                    'title'         => __('Default Overlay Background Color', 'velocity'),
                    'description'   => __('The overlay color is the background color that appears when hovering a project.', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ], 
                [
                    'default'       => '',
                    'selector'      => '.project-content, .project-content a, .project-content h2',
                    'id'            => 'projects_overlay_text_color',
                    'title'         => __('Default Overlay Text Color', 'velocity'),
                    'description'   => __('The color for the text that appear in the overlay.', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'default'       => '',
                    'selector'      => ['selector' => '.projects-component .projects:nth-child(2n) .project-content', 'property' => 'background-color'],
                    'id'            => 'projects_overlay_color_secondary',
                    'title'         => __('Secondary Overlay Background Color', 'velocity'),
                    'description'   => __('The secondary color is the background color that appears for every second project in row.', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ], 
                [
                    'default'       => '',
                    'selector'      => ['selector' => '.projects-component .projects:nth-child(3n) .project-content', 'property' => 'background-color'],
                    'id'            => 'projects_overlay_color_tertiary',
                    'title'         => __('Tertiary Overlay Background Color', 'velocity'),
                    'description'   => __('The tertiary color is the background color that appears for every third project in row.', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],                                                                                                                                 
                [
                    'default'       => '',
                    'id'            => 'footer_colors_heading',
                    'title'         => __('Footer Colors', 'velocity'),
                    'type'          => 'heading',
                    'choices'       => [
                        'footer_background_color_unique', 
                        'footer_font_color',
                        'footer_link_color',
                        'footer_link_hover_color'
                    ]
                ],
                [
                    'default'       => '',
                    'selector'      => ['selector' => '.footer', 'property' => 'background-color'],
                    'id'            => 'footer_background_color_unique',
                    'title'         => __('Footer Background Color', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],                 
                [
                    'default'       => '',
                    'selector'      => '.footer',
                    'id'            => 'footer_font_color',
                    'title'         => __('Footer Font Color', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],                  
                [
                    'default'       => '',
                    'selector'      => '.footer a',
                    'id'            => 'footer_link_color',
                    'title'         => __('Footer Link Color', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'default'       => '',
                    'selector'      => '.footer a:hover',
                    'id'            => 'footer_link_hover_color',
                    'title'         => __('Footer Link Hover Color', 'velocity'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ]                                                                                                                 
            ]
        ], 
        [
            'id'            => 'velocity_typography',
            'title'         => __('Typography', 'velocity'),
            'fields'    => [
                [
                    'default'       => '',
                    'id'            => 'general_typography_heading',
                    'title'         => __('General Typography', 'velocity'),
                    'type'          => 'heading',
                    'choices'       => [
                        'body_typography', 
                        'heading_typography', 
                        'header_typography', 
                        'footer_typography'
                    ]
                ],                
                [
                    'default'       => '',
                    'selector'      => 'body',
                    'id'            => 'body_typography',
                    'title'         => __('General Font', 'velocity'),
                    'type'          => 'typography'
                ],
                [
                    'default'       => '',
                    'selector'      => 'h1, h2, h3, h4, h5, h6, .comment-author',
                    'id'            => 'heading_typography',
                    'title'         => __('Headings Font', 'velocity'),
                    'description'   => __('The default font for the headings. Be aware that this will affect all headings.', 'velocity'),
                    'type'          => 'typography'
                ],
                [
                    'default'       => '',
                    'selector'      => '.header, .navigation-menu .menu a',
                    'id'            => 'header_typography',
                    'title'         => __('Header & Navigation Menu Font', 'velocity'),
                    'type'          => 'typography'
                ], 
                [
                    'default'       => '',
                    'selector'      => '.footer',
                    'id'            => 'footer_typography',
                    'title'         => __('Footer Font', 'velocity'),
                    'type'          => 'typography'
                ],                               
                [
                    'default'       => '',
                    'id'            => 'content_typography_heading',
                    'title'         => __('Content Typography', 'velocity'),
                    'type'          => 'heading',
                    'choices'       => [
                        'content_title_typography', 
                        'content_subtitle_typography', 
                        'content_main_typography', 
                        'conent_meta_typography', 
                        'content_blockquotes_typography'
                    ]
                ],
                [
                    'default'       => '',
                    'selector'      => '.main-title',
                    'id'            => 'content_title_typography',
                    'title'         => __('Main Title Font', 'velocity'),
                    'description'   => __('The font settings for the main title in pages and posts.', 'velocity'),
                    'type'          => 'typography'
                ], 
                [
                    'default'       => '',
                    'selector'      => '.subtitle',
                    'id'            => 'content_subtitle_typography',
                    'title'         => __('Subtitle Font', 'velocity'),
                    'description'   => __('The font settings for the subtitle in pages and posts.', 'velocity'),
                    'type'          => 'typography'
                ],                 
                [
                    'default'       => '',
                    'selector'      => '.main-content',
                    'id'            => 'content_main_typography',
                    'title'         => __('Main Content Font', 'velocity'),
                    'description'   => __('The font settings for the main content of pages and posts.', 'velocity'),
                    'type'          => 'typography'
                ],
                [
                    'default'       => '',
                    'selector'      => '.entry-meta, .comment-metadata',
                    'id'            => 'conent_meta_typography',
                    'title'         => __('Entry Meta Font', 'velocity'),
                    'description'   => __('The font settings meta information such as post tags and the post date.', 'velocity'),
                    'type'          => 'typography'
                ],
                [
                    'default'       => '',
                    'selector'      => 'blockquote',
                    'id'            => 'content_blockquotes_typography',
                    'title'         => __('Blockquotes Font', 'velocity'),
                    'description'   => __('The font settings for blockquotes inside the main content.', 'velocity'),
                    'type'          => 'typography'
                ]                                                                                                                    
            ]
        ],               
        [
            'id'            => 'velocity_social',
            'title'         => __('Social Media', 'velocity'),
            'fields'    => [  
                [
                    'choices'       => [
                        'header'    => __('Header', 'velocity'),
                        'footer'    => __('Footer', 'velocity'),
                        'both'      => __('Both', 'velocity'),
                    ],
                    'default'       => 'footer',
                    'id'            => 'social_position',
                    'title'         => __('Social Media Buttons Position', 'velocity'),
                    'type'          => 'select',
                ],                                     
                [
                    'default'       => '',
                    'id'            => 'email',
                    'title'         => __('Email Address', 'velocity'),
                    'type'          => 'email',
                ],
                [
                    'default'       => '',
                    'id'            => 'telephone',
                    'title'         => __('Telephone Number', 'velocity'),
                    'type'          => 'tel',
                ],                                               
                [
                    'default'       => '',
                    'id'            => 'whatsapp',
                    'title'         => __('Whatsapp Number', 'velocity'),
                    'type'          => 'tel',
                ],                         
                [
                    'default'       => '',
                    'id'            => 'facebook',
                    'title'         => __('Facebook Profile Url', 'velocity'),
                    'type'          => 'url',
                ],                
                [
                    'default'       => '',
                    'id'            => 'instagram',
                    'title'         => __('Instagram Profile Url', 'velocity'),
                    'type'          => 'url',
                ],                
                [
                    'default'       => '',
                    'id'            => 'twitter',
                    'title'         => __('Twitter Profile Url', 'velocity'),
                    'type'          => 'url',
                ],                
                [
                    'default'       => '',
                    'id'            => 'linkedin',
                    'title'         => __('LinkedIn Profile Url', 'velocity'),
                    'type'          => 'url',
                ],
                [
                    'default'       => '',
                    'id'            => 'youtube',
                    'title'         => __('Youtube Channel Url', 'velocity'),
                    'type'          => 'url',
                ],
                [
                    'default'       => '',
                    'id'            => 'vimeo',
                    'title'         => __('Vimeo Channel Url', 'velocity'),
                    'type'          => 'url',
                ],                                                 
                [
                    'default'       => '',
                    'id'            => 'pinterest',
                    'title'         => __('Pinterest Profile Url', 'velocity'),
                    'type'          => 'url',
                ],
                [
                    'default'       => '',
                    'id'            => 'github',
                    'title'         => __('Github Profile Url', 'velocity'),
                    'type'          => 'url',
                ],                                  
                [
                    'default'       => '',
                    'id'            => 'reddit',
                    'title'         => __('Reddit Profile Url', 'velocity'),
                    'type'          => 'url',
                ],
                [
                    'default'       => '',
                    'id'            => 'behance',
                    'title'         => __('Behance Profile Url', 'velocity'),
                    'type'          => 'url',
                ],
                [
                    'default'       => '',
                    'id'            => 'dribbble',
                    'title'         => __('Dribble Profile Url', 'velocity'),
                    'type'          => 'url',
                ]            
            ]              
        ],         
    ]   
];