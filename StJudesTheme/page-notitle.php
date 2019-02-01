<?php

/*
Template Name: Page No Title
*/

get_header();
?>

    <?php if( have_posts() ){

        while(have_posts() ){ the_post(); ?>


            <h3><?php the_title(); ?></h3>
            <small>Posted: <?php the_time(); ?>, on <?php the_date(); ?></small>
            <p><?php the_content(); ?></p>
            <hr>

        <?php };
      }; ?>



<?php get_footer(); ?>
