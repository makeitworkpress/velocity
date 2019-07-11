<?php 
    /**
     * Displays the footer of the site
     */

    // The class located in classes/templates/header.php defines all variables below
    $footer = new Views\Footer(); 
?>       
        
        </main><!-- #main -->
        <footer class="footer" id="footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">

            <?php if($footer->properties->copyright) { ?>
                <div class="copyright">
                    <?php echo $footer->properties->copyright; ?>
                </div>       
            <?php } ?>

            <nav class="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
                <?php wp_nav_menu( ['container' => false, 'theme_location' => 'footer'] ); ?>                                                             	
            </nav><!-- .navigation -->                     

            <?php 
                /**
                 * Displays our social sharing buttons
                 */
                if($footer->properties->social) { 
                    $footer->properties->social->render();
                }
            ?>

        </footer>
        <?php wp_footer(); ?>              
    </body>
</html> 