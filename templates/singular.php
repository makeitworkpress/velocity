<?php 
/**
 * The template for a single blogpost, page or project 
 */ 
$singular = new Views\Singular();

$singular->header(); ?>

	
<article id="post-<?php echo $singular->properties->id; ?>" <?php post_class($singular->properties->classes, $singular->properties->id); ?> <?php echo $singular->properties->scheme; ?>>
            
    <?php  if ( has_post_thumbnail($singular->properties->id) ) { ?>

        <meta itemprop="image" content="<?php echo get_the_post_thumbnail_url( $singular->properties->id, '1920' ); ?>" />

    <?php } ?> 

    <?php if($singular->properties->title) {
        $singular->properties->title->render(); 
    } ?>
            
    <div class="main-content" id="content-section">
        
        <div class="container">
            
            <?php if( $singular->properties->headerAdvert ) { ?>
            
                <div class="advert top-advert"><?php echo $singular->properties->headerAdvert; ?></div>
            
            <?php } ?> 

            <?php if( $singular->properties->meta ) { ?>             
            
                <?php if( $singular->properties->topMeta ) { 
                    $singular->properties->topMeta->render(); 
                } ?> 

                <?php if( $singular->properties->topShare ) {
                    $singular->properties->topShare->render();  
                } ?>             

                <?php if( $singular->properties->authorAvatar ) { 
                    $singular->properties->authorAvatar->render(); 
                } ?>

            <?php } ?>  

            <?php do_action('velocity_before_content'); ?>
            
            <div class="entry-content" itemprop="<?php echo $singular->properties->textScheme; ?>">
                <?php echo $singular->properties->content; ?>    
            </div>

            <?php do_action('velocity_after_content'); ?>

            <?php if( $singular->properties->floatingAdvert ) { ?>
            
                <div class="advert floating-advert"><?php echo $singular->properties->floatingAdvert; ?></div>
        
            <?php } ?>                

            <?php if( $singular->properties->footerAdvert ) { ?>
                
                <div class="advert footer-advert"><?php echo $singular->properties->footerAdvert; ?></div>
            
            <?php } ?>

            <?php if( $singular->properties->meta ) { ?>                        

                <?php if( $singular->properties->bottomShare ) {
                    $singular->properties->bottomShare->render();  
                } ?>

                <?php if( $singular->properties->bottomMeta ) { 
                    $singular->properties->bottomMeta->render(); 
                } ?>

                <?php if( $singular->properties->author ) { 
                    $singular->properties->author->render(); 
                } ?>  

                <?php if( $singular->properties->floatShare ) {
                    $singular->properties->floatShare->render();  
                } ?>    

            <?php } ?>                                                           
          
        </div><!-- .container -->

    </div><!-- .main-content -->

    <?php if( $singular->properties->footer ) { ?>

        <footer class="entry-footer main-footer">

            <div class="container">

                <?php if( $singular->properties->pagination ) {
                    $singular->properties->pagination->render();  
                } ?>            
                
                <?php if( $singular->properties->related ) { ?>
                    <aside class="related-posts">
                        <?php if( $singular->properties->relatedTitle ) { ?> 
                            <h2><?php echo $singular->properties->relatedTitle; ?></h2>
                        <?php } ?>
                        <?php $singular->properties->related->render(); ?>   
                    </aside>
                <?php } ?>

                <?php if( $singular->properties->comments ) {
                    $singular->properties->comments->render();  
                } ?>         
                
            </div><!-- .container -->
            
        </footer><!-- .main-footer -->

    <?php } ?>

</article>

<?php $singular->footer(); ?>