<?php 
/**
 * Displays a rating component
 * The rating components allows unauthorized visitors to rate a post
 * The variable $rating is defined by the classes/components/components.php file and filled by classes/components/rating.php
 */
?>
<div class="rating-component single-meta entry-rating" itemprop="aggregateRating" itemscope="itemscope" itemtype="http://schema.org/AggregateRating">
    <meta itemprop="reviewCount" content="<?php echo $rating['rating']['count']; ?>" />
    <meta itemprop="ratingValue" content="<?php echo $rating['rating']['value']; ?>" />
    <i class="icon-thumbs-o-up"></i>
    <a href="#" class="stars-rating" data-id="<?php echo $rating['id']; ?>">
        <span class="stars-rate">
            <i class="icon-star-o"></i>
            <i class="icon-star-o"></i>
            <i class="icon-star-o"></i>
            <i class="icon-star-o"></i>
            <i class="icon-star-o"></i>
        </span>
        <span class="stars-current-rating">
            <?php 
                // Full Stars
                for($i = 1; $i <= $rating['stars']['full']; $i++) {
                    echo '<i class="icon-star"></i>';
                }
                // Half Stars
                for($i = 1; $i <= $rating['stars']['half']; $i++) {
                    echo '<i class="icon-star-half-o"></i>';
                }
                // Empty Stars
                for($i = 1; $i <= $rating['stars']['empty']; $i++) {
                    echo '<i class="icon-star-o"></i>';
                }
            ?>
        </span>
    </a>    
</div>                        