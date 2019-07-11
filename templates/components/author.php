<?php
/**
 * Loads our author
 * The variable $author is defined by the classes/components/components.php file and filled by classes/components/author.php
 */
?>

<aside class="author-component entry-author author-display-<?php echo $author['display']; ?>" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person">
    <figure class="author-avatar vcard">
        <a class="url fn" href="<?php echo $author['url']; ?>" title="<?php printf( __('View all posts by %s', 'velocity'), $author['name'] ); ?>" rel="author">
            <?php echo $author['avatar'];  ?>
        </a>
        <meta itemprop="name" content="<?php echo $author; ?>" />                        
    </figure><!-- #author-avatar -->
    <?php if( $author['display'] == 'biography' ) { ?>
        <div class="author-biography"> 
            <h4 class="author-name" itemprop="name">
                <?php echo $author['name']; ?>
            </h4> 
            <p class="author-biography" itemprop="text">
                <?php echo $author['description']; ?>        
            </p>   
        </div>        
    <?php } ?>
</aside>