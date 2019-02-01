<?php

function stjudes_script_enqueue(){
  //css
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.7', 'all');
    wp_enqueue_style('customstyle', get_template_directory_uri() .'/css/stjudes.css', array('total-parent-css','reaction_buttons_css'), '1.0.0', 'all');
  //javascript
    //wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.js', array(), '3.3.7', 'all');
    wp_enqueue_script('customjs', get_template_directory_uri() . '/js/stjudes.js', array(), '1.0.0');
    wp_enqueue_script('jquery', get_template_directory_uri() . '/js/stjudes.js', array(), '1.0.0');

    //wp_enqueue_script('jquery');
}

add_action('wp_enqueue_scripts', 'stjudes_script_enqueue');



function stjudes_theme_setup() {

    add_theme_support('menus');

    register_nav_menu('primary', 'Primary header nav menu');
    register_nav_menu('Third', 'Primary header nav menu');
    register_nav_menu('secondary', 'Primary footer nav menu');

}

add_action('init', 'stjudes_theme_setup');

add_theme_support('custom-background');
add_theme_support('custom-header');
add_theme_support('post-thumbnails');
add_theme_support('post-formats',array('aside','image','video'));

/* side bar */

function st_judes_widget_setup()
{
  register_sidebar(array(
    'name' => 'sidebar',
    'id' => 'sidebar-1',
    'class' => 'custom',
    'description' => 'standard sidebar',
    'before_widget' => '<aside id="%1$s" class="widget%2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h1 clas"widget-title">',
    'after_title' => '</h1>',
  ));
}

add_action('widgets_init','st_judes_widget_setup');


?>
