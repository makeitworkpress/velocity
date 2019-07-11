<?php 
/**
 * Displays the default archive
 * 
 * The variables displayed in this template are initialized by the class located in classes/templates/index.php
 * Components are also initialized in that place
 */
$index = new Views\Index();
$index->header(); ?>

            <section class="index-archive">
    
                <?php $index->properties->title->render(); ?>

                <div class="main-content" id="main-content">
                    
                    <div class="container">

                        <?php if( $index->properties->description ) { ?>
                            <p class="description" itemprop="description">
                                <?php echo $index->properties->description; ?>
                            </p>
                        <?php } ?>

                        <?php if( $index->properties->categories ) { ?>
                            <div class="categories-list">
                                <?php if( $index->properties->categoriesTitle ) { ?>
                                    <p><?php echo $index->properties->categoriesTitle; ?></p>
                                <?php } ?> 
                                <ul class="categories">
                                    <?php foreach( $index->properties->categories as $term ) { ?>
                                        <li>
                                    <a class="category-term<?php if( $term->name == $index->properties->categoryActive) { ?> active<?php } ?>" href="<?php echo esc_url(get_category_link($term->term_id)); ?>" rel="tag">
                                                <?php echo  $term->name; ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } ?> 
                                                 
                        <?php $index->properties->posts->render(); ?>  
                    </div>


                </div><!-- .main-content -->

            </section>

<?php
    $index->footer();
?>