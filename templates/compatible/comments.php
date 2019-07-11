<?php 
/**
 * Displays our comments in a WordPress compatible way
 */
?>
<div class="comments">

	<?php if( post_password_required() ) { ?>
        <p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'velocity' ); ?></p>
	<?php } else { ?>

		<?php comment_form(); ?> 

		<?php if( have_comments() ) { ?>

			<h3 class="comments-title">
				<?php
					printf( 
						_n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'velocity' ),
						number_format_i18n( get_comments_number() ), 
						'<a href="#comments-title">' . get_the_title() . '</a>' 
					);
				?>
			</h3>
			<ol class="commentlist">
				<?php
					wp_list_comments();
				?>
			</ol>
			<?php if ( get_comment_pages_count() > 1 && get_option('page_comments') ) {  ?>
				<nav class="navigation">
					<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'velocity' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'velocity' ) ); ?></div>
				</nav>
			<?php } ?>	
		<?php } // if have_comments ?>
	<?php } ?>

</div><!-- #comments -->