<?php
/**
 * This template displays post-meta
 * The variable $meta is defined by the classes/components/components.php file and filled by classes/components/meta.php
 */ ?>

<aside class="meta-component entry-meta">

    <?php if( $meta['author'] ) { ?>
        <div class="single-meta entry-author" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person">
            <figure class="author-avatar">
                <?php echo $meta['avatar'] ?>                           
            </figure>  
            <span itemprop="name"><?php echo $meta['author']; ?></span>
        </div> 
    <?php } ?>

    <?php if( $meta['date'] ) { ?>
        <time class="single-meta entry-time" datetime="<?php echo $meta['dateTime']; ?>"  itemprop="datePublished">
            <i class="icon-calendar-o"></i>
            <?php echo $meta['date'] ; ?>
        </time>
    <?php } ?>    

    <?php if( $meta['category'] ) { ?>
        <div class="single-meta entry-category" itemprop="genre">
            <i class="icon-folder-o"></i>
            <?php echo $meta['category'] ; ?>
        </div>
    <?php } ?>

    <?php if ( $meta['tags'] ) {  ?>
        <div class="single-meta entry-tags">
            <i class="icon-tags"></i>
            <span itemprop="keywords"><?php echo $meta['tags'] ; ?></span>
        </div>
    <?php } ?>

    <?php if ( $meta['type'] ) {  ?>
        <div class="single-meta entry-type" itemprop="genre">
            <i class="icon-folder-o"></i>
            <?php echo $meta['type'] ; ?>
        </div>
    <?php } ?>

    <?php if ( $meta['url'] ) {  ?>
        <a class="single-meta entry-url" href="<?php echo $meta['url'] ; ?>" target="_blank" rel="external">
            <i class="icon-chain"></i>
            <?php echo $meta['urlText'] ; ?>
        </a>
    <?php } ?>        

    <?php if ( $meta['rating'] ) { 
        $meta['rating']->render(); 
    } ?>       

</aside> 