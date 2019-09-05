<?php
/**
 * Displays our posts components
 * The variable $posts is defined by the classes/components/components.php file and filled by classes/components/posts.php
 */

// Return if we do not have any post
if( ! $posts['posts'] ) {
    return;
} ?>

<div class="posts-component <?php echo $posts['class']; ?>" itemscope="itemscope" itemtype="http://schema.org/Blog">

    <?php if( ! $posts['posts'] ) { ?>
        <p><?php echo $posts['nothing']; ?></p>
    <?php } ?>

    <?php foreach( $posts['posts'] as $id => $post ) { ?>
        <article <?php post_class('post-item', $id); ?> itemprop="blogPost" itemscope="itemscope" itemtype="http://schema.org/BlogPosting">

            <span class="structured-data hidden" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person">
                <meta itemprop="name" content="<?php the_author(); ?>">
            </span>

            <span class="structured-data hidden" itemprop="publisher" itemscope="itemscope" itemtype="http://schema.org/Organization">
                <span itemprop="logo"itemscope="itemscope" itemtype="http://schema.org/ImageObject">
                    <?php if( strpos($posts['logo'], '.svg') ) { ?>
                        <meta itemprop="contentUrl" content="<?php echo $posts['logo']; ?>" />
                        <meta itemprop="url" content="<?php echo $posts['blogUrl']; ?>" />
                    <?php } else { ?>
                        <meta itemprop="url" content="<?php echo $posts['logo']; ?>" />
                    <?php } ?>
                </span>
                <meta itemprop="name" content="<?php echo $posts['blogName']; ?>" />
            </span>                    

            <meta itemprop="mainEntityOfPage" content="<?php echo $post['link']; ?>" />
            <meta itemprop="datePublished" content="<?php echo $post['published']; ?>" />
            <meta itemprop="dateModified" content="<?php echo $post['modified']; ?>" />   
      
            
            <header class="entry-header">
                <?php if( $post['image'] ) { ?>
                    <figure class="entry-image">
                        <a href="<?php echo $post['link']; ?>" rel="bookmark">
                            <?php echo $post['image']; ?>
                        </a>
                    </figure>
                <?php } ?>  
                <div class="post-title">
                    <?php if( $post['titleMeta'] ) { ?>
                        <?php $post['titleMeta']->render(); ?>  
                    <?php } ?>                               
                    <h3 class="entry-title" itemprop="name headline">
                        <a href="<?php echo $post['link']; ?>" title="<?php echo $post['title']; ?>" itemprop="url"><?php echo $post['title']; ?></a>
                    </h3> 
                </div>             
            </header>

            <?php if( $post['topMeta'] ) { ?>
                <?php $post['topMeta']->render(); ?>  
            <?php } ?>            

            <?php if( $post['excerpt'] ) { ?>
                <div class="entry-content" itemprop="description">
                    <?php echo $post['excerpt']; ?>
                </div>
            <?php } ?>

            <?php if( $posts['more'] || $post['bottomMeta'] ) { ?>
                <footer class="entry-footer">
                    <?php if( $post['bottomMeta'] ) { ?>
                        <?php $post['bottomMeta']->render(); ?>  
                    <?php } ?>
                    <?php if( $posts['more'] ) { ?>
                        <a class="continue-reading" href="<?php echo $post['link']; ?>" rel="bookmark"><?php echo $posts['more']; ?></a>
                    <?php } ?>
                </footer>
            <?php } ?>

        </article><!-- .news-item -->
    <?php } ?>

    <?php if( $posts['pagination'] ) { ?>

        <nav class="pagination">
            <?php echo $posts['pagination']; ?>
        </nav>

    <?php } ?>
</div>