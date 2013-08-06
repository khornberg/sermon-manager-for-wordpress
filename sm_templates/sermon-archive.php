<?php
/**
 * The template for displaying Sermon Archive pages.
 */
?>

<div id="sermon-manager">
<?php if ( have_posts() ) : ?>

	<?php do_action( 'sm_archive_before' ); ?>
	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<?php
			/* 
			 * If you want to overload this in a child theme then include a file
			 * called sermon-loop-archive.php in the /sm_templates directory of 
			 * of your child theme and that will be used instead.
			 */
			get_template_part( 'sermon', 'loop-archive' );
		?>

	<?php endwhile; ?>

	<?php do_action( 'sm_archive_after' ); ?>

<?php endif; ?>

</div>