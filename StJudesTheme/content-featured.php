<article id="post-<?php the_ID(); ?>" <?php post_class();?>>

  <div class="row">
    <div class="col-md-8">
      <?php the_post_thumbnail('full');?>
    </div>

<div class="row">
    <div class="col-md-4" >
      <p style= "float: left;"><?php the_content(); ?></p>
    </div>
</div>
</div>
<hr>
</article>
