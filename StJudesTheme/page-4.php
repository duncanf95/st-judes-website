<?php get_header(); ?>

    <?php if( have_posts() ){

        while(have_posts() ){ the_post(); ?>



            <small>Posted: <?php the_time(); ?>, on <?php the_date(); ?></small>
            <p><?php the_content(); ?></p>
            <h3><?php the_title(); ?></h3>
            <hr>

        <?php };
      }; ?>



<?php get_footer(); ?>
