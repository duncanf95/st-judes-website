<?php //include('dbconnect.php'); ?>
<!doctype html>
<html>
    <head>

        <meta charset="utf-8">
        <title>St Jude's</title>
        <?php wp_head(); ?>
        <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
        <link rel="stylesheet" href= <?php echo '"'.get_template_directory_uri().'/css/stjudes.css"';?>
        <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
        <script src=<?php echo '"'.get_template_directory_uri().'/js/stjudes.js"';?>></script>

    </head>

    <?php

        if(is_home()){

            $stjudes_classes = array( 'stjudes-class', 'myclass' );

        }
        else{

            $stjudes_classes = array( 'no-stjudes-class');

        }

     ?>


    <body <?php body_class($stjudes_classes); ?>>

      <div id="fb-root"></div>
      <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>




        <div data-role= "page" id = "somepage">
          <div class = "row">
          <div class="col-xs-6 col-sm-3">
          </div>
          <div class = "col-xs-12 col-sm-6">

              <?php

                wp_nav_menu(

                  array(
                  'theme_location' => 'secondary',
                  'container' => true,
                  'menu_class' => 'nav navbar-nav navbar-left'

                  )
                );

              ?>

          </div>
        <div class "col-xs-6 col-sm-3">
        </div>
      </div>


          <div data-role="panel" id="mypanel">
            <ul data-role = "listview" data-inset="true">
            <?php

              wp_nav_menu(

                array(
                'theme_location' => 'secondary',
                'container' => true,
                'menu_class' => 'nav navbar-nav navbar-right'

                )
              );

            ?>

          </ul>

          </div>

          <div data-role="header" data-position="fixed">
	           <img src="http://localhost/stjudes/wp-content/uploads/2017/03/stjudes.png" class="header-image">
	            <a href= "#mypanel" id="reveal" class="ui-btn ui-icon-bars ui-btn-icon-notext ui-corner-all" data-ajax="false"></a>
          </div>



            <div data-role="main" class="ui-content">
