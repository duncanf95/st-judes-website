<article id="post-<?php the_ID(); ?>" <?php post_class();?>>

    <div class="col-md-3">
      <?php the_post_thumbnail('thumbnail');?>
      <p><?php the_content(); ?></p>
    </div>

</article>
