<?php get_header(); ?>

<?php 	$args_cat = array(
    'include' => '7'
  );

  $categories = get_categories($args_cat);
  foreach($categories as $category):

    $args = array(
      'type' => 'post',
      'posts_per_page' => 40,
      'category__in' => $category->term_id,
      'category__not_in' => array('all'),
    );

    $lastBlog = new WP_Query( $args );

    if( $lastBlog->have_posts() ):

    $count = 0;

      while( $lastBlog->have_posts() ): $lastBlog->the_post();


      if($count == 0)
      {
        echo '<div class="row">';
        $count ++;
      }
           get_template_part('content','food');

      if($count == 4)
      {
        $count = 0;
        echo'</div>';
      }

       endwhile;

    endif;



    wp_reset_postdata();

  endforeach ?>
</div>
</div>


<?php get_footer(); ?>
