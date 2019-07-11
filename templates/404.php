<?php 
/**  
 * The template for a 404 page 
 */ 
$nothing = new Views\Nothing(); 
$nothing->header(); ?>

<article class="post-not-found" itemscope="itemscope" itemtype="http://www.schema.org/CreativeWork">
    <header class="entry-header main-header">
        <div class="container">
            <h1 class="entry-title main-title" itemprop="headline"><?php echo $nothing->properties->title; ?></h1>
        </div>
    </header>
    <div class="entry-content main-content" itemprop="description">
        <div class="container">
            <p><?php echo $nothing->properties->description; ?></p>
        </div>
    </div>
</article>

<?php $nothing->footer(); ?>