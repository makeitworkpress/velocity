<?php
/**
 * Displays a social sharing item
 * The variable $share is defined by the classes/components/components.php file and filled by classes/components/share.php
 */
?>
<div class="share-component <?php echo $share['class']; ?>">
    <?php if( $share['title'] ) { ?>
        <h4><?php echo $share['title']; ?></h4>
    <?php } ?>
    <?php foreach( $share['networks'] as $class => $network ) { ?>
        <a class="<?php echo $class; ?>" href="<?php echo $network['url']; ?>" target="_blank" title="<?php echo $network['title']; ?>" rel="nofollow" > 
            <i class="icon-<?php echo $network['icon']; ?>"></i>    
        </a>    
    <?php } ?>                            
</div>