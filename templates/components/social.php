<?php
/**
 * Displays the links to social networks
 * The variable $social is defined by the classes/components/components.php file and filled by classes/components/social.php
 */
if( ! $social['platforms'] ) {
    return;
} ?>

<ul class="social-component">
    <?php foreach( $social['platforms'] as $platform => $network ) { ?>
        <li>
            <a class="<?php echo $platform; ?>" href="<?php echo $network['url']; ?>" title="<?php echo $network['name']; ?>" rel="author external" target="_blank">
                <i class="icon-<?php echo $platform; ?>"></i> 
            </a>
        </li>    
    <?php } ?>                   
</ul>   