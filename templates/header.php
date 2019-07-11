<?php 
    /**
     * Displays the header of the site
     */

    // The class located in classes/templates/header.php defines all variables below
    $header = new Views\Header(); 
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
    	<title><?php wp_title(); ?></title>  
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <?php wp_head(); ?>   
        <link rel="profile" href="http://gmpg.org/xfn/11">
	</head>
    <body <?php body_class(); ?>  itemscope="itemscope" itemtype="http://schema.org/WebPage">
        <header class="header <?php echo $header->properties->classes; ?>" id="header" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
            <?php 
                /**
                 * Displays the header logo's, if defined at in the customizer settings
                 */
                if( $header->properties->logo || $header->properties->transparentLogo ) { 
            ?>
                <a class="logo" href="<?php echo $header->properties->url; ?>" title="<?php echo $header->properties->title; ?>" rel="home" itemscope="itemscope" itemtype="http://schema.org/<?php echo $header->properties->logoScheme; ?>">
                    <?php if( $header->properties->logo ) { echo $header->properties->logo; } ?>
                    <?php if( $header->properties->transparentLogo ) { echo $header->properties->transparentLogo; } ?>  
                    <meta itemprop="name" content="<?php echo $header->properties->title; ?>" />
                </a>
            <?php 
                } 
            ?>
            <nav class="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
                <div class="navigation-menu">
                <?php wp_nav_menu( ['container' => false, 'theme_location' => 'header'] ); ?>  
                    <?php 
                        /**
                         * Displays our social sharing buttons
                         */
                        if($header->properties->social) { 
                            $header->properties->social->render();
                        }
                    ?>  
                </div>                
                <a href="#" class="hamburger-menu"><i class="icon-navicon"></i></a>                                           	
            </nav><!-- .navigation --> 


        </header><!-- #header -->               	
        <main class="content" id="content" <?php echo $header->properties->mainScheme; ?> >