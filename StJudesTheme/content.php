<article id="post-<?php the_ID(); ?>" <?php post_class();?>>

<header class="entry-header">
    <div class="col-md-8">
      <?php the_title(sprintf('<h1 class="entrytitle"><a href="%s">',esc_url(get_permalink()) ),'</a></h1>'); ?>
    </div>
    <div class="col-xs-6">
      <div class="thumbnail-img"><?php the_post_thumbnail('thumbnail');?></div>
      <small>Posted: <?php the_time(); ?>, on <?php the_date(); ?></small>
    </div>
</header>
<div class="row">
    <div class="col-xs-6">
      <p><?php the_content(); ?></p>
    </div>
</div>
<hr>
</article>
