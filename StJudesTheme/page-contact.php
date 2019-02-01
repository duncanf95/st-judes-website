<?php get_header(); ?>

<div class="stjudescarousel">
	<?php if( have_posts() ){

			while(have_posts() ){ the_post();?>

					<?php echo '<div>'; get_template_part('content',get_post_format()); echo '</div>'; ?>


			<?php };
		}; ?>
</div>
	<div class="col-xs-12 col-sm-4">
		<?php get_sidebar(); ?>
	</div>


<?php get_footer(); ?>
