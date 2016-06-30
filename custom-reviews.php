<?php
/**
* Plugin Name: Whitehardt Reveiws
* Plugin URI: https://www.whitehardt.com/services/internet-marketing/
* Description: A custom review plugin created for Ken Nunn
* Version: 1.0
* Author: Whitehardt
* Author URI: https://www.whitehardt.com/
* License: WH21
*/

function wh_init_reviews() {
  // This function will set up the custom post type of Reviews
  $labels = array(
    'name'               => _x( 'Reviews', 'post type general name' ),
    'singular_name'      => _x( 'Review', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'review' ),
    'add_new_item'       => __( 'Add New Review' ),
    'edit_item'          => __( 'Edit Review' ),
    'new_item'           => __( 'New Review' ),
    'all_items'          => __( 'All Reviews' ),
    'view_item'          => __( 'View Review' ),
    'search_items'       => __( 'Search Reviews' ),
    'not_found'          => __( 'No reviews found' ),
    'not_found_in_trash' => __( 'No reviews found in the Trash' ),
    'parent_item_colon'  => '',
    'menu_name'          => 'Reviews'
  );

  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our reviews and review specific data',
    'menu_icon'     => 'dashicons-testimonial',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
    'has_archive'   => true,
  );

  register_post_type( 'reviews', $args );
}

add_action('init', 'wh_init_reviews');

function wh_populate_reviews() {
  // This function performs a query and spits out the reviews on screen

  // Check which page we are one in the loop
  $paged = (get_query_var( 'paged' )) ? get_query_var('paged') : 1;

  // Arguments for the WP_Query
  $args = array(
    "posts_per_page" => 20,
    "post_type" => "reviews",
    "post_status" => "publish",
    "order" => "DESC",
    "paged" => $paged
  );

  // Run The Query
  $wh_reviews_list = new WP_Query($args);

  // Start looping through the query and output the information and styling
  $content = '<div class="row">';
  $location;
  while ($wh_reviews_list->have_posts()) : $wh_reviews_list->the_post();

    $content .= '
    <div class="custom-review col-lg-12 col-md-12 col-sm-12">
      <div class="col-lg-2 col-md-3 col-sm-12">
        <div class="custom-review-icon col-lg-12 col-md-12 col-sm-3 col-xs-3">
          <img class="custom-review-image" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjY0cHgiIGhlaWdodD0iNjRweCIgdmlld0JveD0iMCAwIDEyMy45NjEgMTIzLjk2MSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMTIzLjk2MSAxMjMuOTYxOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CjxnPgoJPHBhdGggZD0iTTQ5LjgsMjkuMDMyYzMuMS0xLjMsNC40LTUsMy04bC00LjktMTAuM2MtMS40LTIuODk5LTQuOC00LjItNy44LTIuODk5Yy04LjUsMy42LTE1LjgsOC4zLTIxLjYsMTQgICBDMTEuNCwyOC41MzIsNi42LDM2LjIzMiw0LDQ0LjczMmMtMi42LDguNjAxLTQsMjAuMy00LDM1LjJ2MzAuN2MwLDMuMywyLjcsNiw2LDZoMzkuM2MzLjMsMCw2LTIuNyw2LTZ2LTM5LjNjMC0zLjMwMS0yLjctNi02LTYgICBIMjYuNWMwLjItMTAuMTAxLDIuNi0xOC4yLDctMjQuMzAxQzM3LjEsMzYuMTMzLDQyLjUsMzIuMTMzLDQ5LjgsMjkuMDMyeiIgZmlsbD0iI0ZGRkZGRiIvPgoJPHBhdGggZD0iTTEyMC40LDI5LjAzMmMzLjEtMS4zLDQuMzk5LTUsMy04bC00LjktMTAuMTk5Yy0xLjQtMi45LTQuOC00LjItNy44LTIuOWMtOC40LDMuNi0xNS42MDEsOC4zLTIxLjUsMTMuOSAgIGMtNy4xMDEsNi44LTEyLDE0LjUtMTQuNjAxLDIzYy0yLjYsOC4zOTktMy44OTksMjAuMS0zLjg5OSwzNS4xdjMwLjdjMCwzLjMsMi43LDYsNiw2SDExNmMzLjMsMCw2LTIuNyw2LTZ2LTM5LjMgICBjMC0zLjMwMS0yLjctNi02LTZIOTcuMWMwLjItMTAuMTAxLDIuNjAxLTE4LjIsNy0yNC4zMDFDMTA3LjcsMzYuMTMzLDExMy4xLDMyLjEzMywxMjAuNCwyOS4wMzJ6IiBmaWxsPSIjRkZGRkZGIi8+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" />
          <div class="custom-review-icon-featured">
            <p>VERIFIED</p>
          </div>
        </div>
      </div>
    ';

    $content .= '<div class="reviewer-details-container col-lg-10 col-md-9 col-sm-12 col-xs-12">';
    $content .= '<h3 class="custom-review-title col-lg-12">' . get_field('title') . '</h3>';

    // Keeps the city from being displayed if it is absent
    if(get_field('city')) {
      $location = '<h6 class="custom-review-location">' . get_field('city') . ', ' . get_field('state') . '</h6>';
    }else {
      $location = '<h6 class="custom-review-location">' . get_field('state') . '</h6>';
    }

    $content .= '<div class="col-lg-12"><h6 class="custom-review-date">' . get_field('date') . ' | </h6> ' . $location . '</div>';
    $content .=
    '<div class="col-lg-12">' .
      '<p class="custom-review-name">' . get_field('name'). '</p>' .
      '<div class="custom-review-rating-container">';
      for ($j=0; $j < get_field('rating'); $j++) {
        $content .= '<img class="custom-review-rating-icon" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUzLjg2NyA1My44NjciIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUzLjg2NyA1My44Njc7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojRUZDRTRBOyIgcG9pbnRzPSIyNi45MzQsMS4zMTggMzUuMjU2LDE4LjE4MiA1My44NjcsMjAuODg3IDQwLjQsMzQuMDEzIDQzLjU3OSw1Mi41NDkgMjYuOTM0LDQzLjc5OCAgIDEwLjI4OCw1Mi41NDkgMTMuNDY3LDM0LjAxMyAwLDIwLjg4NyAxOC42MTEsMTguMTgyICIvPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" />';
      }
    $content .= '</div></div>';
    $content .= '</div>';
    $content .= '<p class="custom-review-response col-lg-12">' . get_field('response') . '</p>';
    $content .= '</div>';
  endwhile;

  $content .= '</div>';
  // return $content;

  // Pagination for the custom reviews
  $big = 999999999; // need an unlikely integer
  $content .= paginate_links(array(
  	'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ))),
  	'format' => '?paged=%#%',
  	'current' => max(1, get_query_var('paged')),
  	'total' => $wh_reviews_list->max_num_pages
  ));

  return $content;
  wp_reset_query();
}

add_shortcode('wh_reviews', 'wh_populate_reviews');

function werklinks() {
  return wp_list_pages("title_li=&child_of=8&depth=1&echo=0");
}
add_shortcode('werk', 'werklinks');

// Inject the stylesheets into the loop
function wh_review_styles() {
  wp_register_style('prefix-style', plugins_url('style.css', __FILE__));
  wp_enqueue_style('prefix-style');
}

add_action('wp_enqueue_scripts', 'wh_review_styles');
