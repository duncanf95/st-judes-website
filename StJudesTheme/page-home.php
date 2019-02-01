<?php get_header(); ?>



<div class = "row">



    <div class="col-xs-12">
          <div id="stjudes-carousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators
            <ol class="carousel-indicators">
              <li data-target="#stjudes-carousel" data-slide-to="0" class="active"></li>
            </ol> -->

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
              <?php
              $args_cat = array('include' => 'memes' );
              $categories = get_categories($args_cat);
              $count = 0;

              foreach($categories as $category){
                  $args = array(
                    'type' => 'post',
                    'posts_per_page' => 1,
                    'category_in' => $category->term_id,
                    'category_not_in' => array(10)
                  );

                  $lastblog = new WP_Query($args);

                  if($lastblog -> have_posts() ){



                      while($lastblog -> have_posts() ){ $lastblog -> the_post();?>
                        <div class="item <?php if($count > 0){echo 'active';};?>">
                          <?php the_post_thumbnail('full');?></div>
                          <div class="carousel-caption">
                            <?php the_title(sprintf('<h1 class="entrytitle"><a href="%s">',esc_url(get_permalink()) ),'</a></h1>'); ?>
                          </div>
                        </div>
                      <?php  };
                    };
                    wp_reset_postdata();
                    $count++;
                    echo get_the_ID();
                };//end for each
                    ?>


            </div>
          </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#stjudes-carousel" role="button" data-slide="prev">
              <span class="icon-prev" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#stjudes-carousel" role="button" data-slide="next">
              <span class="icon-next" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>



<!--<div class = "row">

    <div class="col-xs-12 col-sm-8">

    <?php// if( have_posts() ){

      //  while(have_posts() ){ the_post();?>

            <?php //get_template_part('content',get_post_format()); ?>


        <?php// };
    //  }; ?>
    </div>-->

<div class = "col-xs-12 col-sm-4">
      <?php get_sidebar(); ?>
</div>



<?php get_footer(); ?>
