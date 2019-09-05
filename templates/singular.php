<?php 
/**
 * The template for a single blogpost, page or project 
 */ 
$singular = new Views\Singular();

$header = $singular->header(); ?>

	
<article id="post-<?php echo $singular->properties->id; ?>" <?php post_class($singular->properties->classes, $singular->properties->id); ?> <?php echo $singular->properties->schema; ?>>
            
    <?php  if ( has_post_thumbnail($singular->properties->id) ) { ?>

        <meta itemprop="image" content="<?php echo $singular->properties->blogSchema['image']; ?>" />

    <?php } ?> 

    <?php if($singular->properties->type == 'post') { ?>

        <span class="structured-data hidden" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person">
                <meta itemprop="name" content="<?php echo $singular->properties->blogSchema['author']; ?>">
        </span>

        <span class="structured-data hidden" itemprop="publisher" itemscope="itemscope" itemtype="http://schema.org/Organization">
            <span itemprop="logo"itemscope="itemscope" itemtype="http://schema.org/ImageObject">
                <?php if( strpos($singular->properties->blogSchema['logo'], '.svg') ) { ?>
                    <meta itemprop="contentUrl" content="<?php echo $singular->properties->blogSchema['logo']; ?>" />
                    <meta itemprop="url" content="<?php echo $singular->properties->blogSchema['url']; ?>" />
                <?php } else { ?>
                    <meta itemprop="url" content="<?php echo $singular->properties->blogSchema['logo']; ?>" />
                <?php } ?>
            </span>
            <meta itemprop="name" content="<?php echo $singular->properties->blogSchema['name']; ?>" />
        </span>                    

        <meta itemprop="mainEntityOfPage" content="<?php echo $singular->properties->blogSchema['url']; ?>" />
        <meta itemprop="datePublished" content="<?php echo $singular->properties->blogSchema['published']; ?>" />
        <meta itemprop="dateModified" content="<?php echo $singular->properties->blogSchema['modified']; ?>" />   

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
            
            <div class="entry-content" itemprop="<?php echo $singular->properties->textSchema; ?>">
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