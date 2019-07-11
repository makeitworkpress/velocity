<?php
/**
 * Displays a projects grid. Can be used in ajax calls.
 * This template is closely tied to the class plassed in classes/components/projects.php. 
 * 
 * The variable $projects is defined by the classes/components/components.php file and filled by classes/components/projects.php
 */
?>

<div class="projects-component projects-load-<?php echo $projects['infinite']; ?>" data-pages="<?php echo $projects['pages']; ?>">

    <?php if( ! $projects['projects'] ) { ?>
        <p><?php echo $projects['nothing']; ?></p>
    <?php } ?>

    <?php foreach( $projects['projects'] as $id => $project ) { ?>

        <article <?php post_class('project-item', $id); ?> id="project-<?php echo $id; ?>" itemscope="itemscope" itemtype="http://schema.org/CreativeWork">

            <?php  if( $project['image'] ) { ?>
                <figure class="entry-image"> 
                    <?php echo $project['image']; ?> 
                </figure>
            <?php } ?>

            <div class="project-content">

                <header class="entry-header">
                    <h2 class="entry-title" itemprop="name headline">
                        <a href="<?php echo $project['link']; ?>" itemprop="url" rel="bookmark"><?php echo $project['title']; ?></a>
                    </h2>
                </header>
                
                <?php  if( $project['summary'] ) { ?>
                    <div class="entry-content" itemprop="description">
                        <?php echo $project['summary']; ?>
                    </div> 
                <?php } ?>

                <footer class="entry-footer">

                    <?php if( $project['details'] ) { ?>
                        <a href="<?php echo $project['link']; ?>" itemprop="url" rel="bookmark">
                            <?php echo $project['details']; ?> &rsaquo;
                        </a>
                    <?php } ?>

                    <?php if( $project['previewData'] ) { ?>
                        <a class="preview" href="<?php echo $project['link']; ?>" data-preview="<?php echo $project['previewData']; ?>">
                            <i class="icon-eye"></i><?php echo $project['preview']; ?>
                        </a>
                    <?php } ?>

                    <?php if( $project['url'] ) { ?>
                        <a href="<?php echo $project['url']; ?>" target="_blank" rel="external">
                            <i class="icon-link"></i><?php echo $project['urlText']; ?>
                        </a>
                    <?php } ?>                    

                </footer>  

            </div>

        </article><!-- .portfolio-content -->

    <?php } ?>

</div><!-- .projects -->