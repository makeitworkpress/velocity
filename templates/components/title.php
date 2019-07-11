<?php 
/**
 * Contains the header for single content in pages and projects
 * The variable $title is defined by the classes/components/components.php file and filled by classes/components/title.php
 */
?>

<header class="title-component main-header entry-header <?php echo $title['class']; ?>" <?php echo $title['background']; ?>>

    <?php if( $title['slides'] ) { ?>
        <ul class="entry-slider">
            <?php foreach( $title['slides'] as $slide ) { ?>
                <li><figure class="entry-image"><?php echo $slide; ?></figure></li>
            <?php } ?>
        </ul> 
    <?php } ?>

    <?php if( $title['image'] ) { ?>
        <figure class="entry-image">
            <?php echo $title['image']; ?>
        </figure>
    <?php } ?>

    <?php if( $title['video'] ) { ?>
        <div class="entry-video">
            <?php echo $title['video']; ?>
        </div>
    <?php } ?> 

    <?php if( $title['scroll'] ) { ?>
        <a class="scroll-down" href="#content-section"></a> 
    <?php } ?>       
    
    <div class="container">

        <?php if( $title['meta'] ) { $title['meta']->render(); } ?>

        <h1 class="entry-title main-title" itemprop="name headline"><?php echo $title['title']; ?></h1>
        
        <?php if( $title['subtitle'] ) { ?>
            <div class="subtitle">
                <?php echo $title['subtitle']; ?>
            </div>
        <?php } ?> 

        <?php if( $title['summary'] ) { ?>
            <div class="summary" itemprop="description">
                <?php echo $title['summary']; ?>
            </div>
        <?php } ?>                         
        
    </div><!-- .container -->
    
</header><!-- .entry-header -->