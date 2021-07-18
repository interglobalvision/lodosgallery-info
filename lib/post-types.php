<?php
// Menu icons for Custom Post Types
// https://developer.wordpress.org/resource/dashicons/
function add_menu_icons_styles(){
?>

<style>
  #menu-posts-exhibition .dashicons-admin-post:before {
    content: '\f128';
  }
  #menu-posts-fair .dashicons-admin-post:before {
    content: '\f128';
  }
  #menu-posts-publication .dashicons-admin-post:before {
    content: '\f330';
  }
  #menu-posts-artist .dashicons-admin-post:before {
    content: '\f110';
  }
</style>

<?php
}
add_action( 'admin_head', 'add_menu_icons_styles' );


//Exhibition
add_action( 'init', 'register_cpt_exhibition' );

function register_cpt_exhibition() {

  $labels = array(
    'name' => _x( 'Exhibitions', 'exhibition' ),
    'singular_name' => _x( 'Exhibition', 'exhibition' ),
    'add_new' => _x( 'Add New', 'exhibition' ),
    'add_new_item' => _x( 'Add New Exhibition', 'exhibition' ),
    'edit_item' => _x( 'Edit Exhibition', 'exhibition' ),
    'new_item' => _x( 'New Exhibition', 'exhibition' ),
    'view_item' => _x( 'View Exhibition', 'exhibition' ),
    'search_items' => _x( 'Search Exhibitions', 'exhibition' ),
    'not_found' => _x( 'No exhibitions found', 'exhibition' ),
    'not_found_in_trash' => _x( 'No exhibitions found in Trash', 'exhibition' ),
    'parent_item_colon' => _x( 'Parent Exhibition:', 'exhibition' ),
    'menu_name' => _x( 'Exhibitions', 'exhibition' ),
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => false,

    'supports' => array( 'title', 'editor', 'thumbnail' ),

    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,

    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'has_archive' => true,
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'capability_type' => 'post'
  );

  register_post_type( 'exhibition', $args );
}

//Fair
add_action( 'init', 'register_cpt_fair' );

function register_cpt_fair() {

  $labels = array(
    'name' => _x( 'Fairs', 'fair' ),
    'singular_name' => _x( 'Fair', 'fair' ),
    'add_new' => _x( 'Add New', 'fair' ),
    'add_new_item' => _x( 'Add New Fair', 'fair' ),
    'edit_item' => _x( 'Edit Fair', 'fair' ),
    'new_item' => _x( 'New Fair', 'fair' ),
    'view_item' => _x( 'View Fair', 'fair' ),
    'search_items' => _x( 'Search Fairs', 'fair' ),
    'not_found' => _x( 'No fairs found', 'fair' ),
    'not_found_in_trash' => _x( 'No fairs found in Trash', 'fair' ),
    'parent_item_colon' => _x( 'Parent Fair:', 'fair' ),
    'menu_name' => _x( 'Fairs', 'fair' ),
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => false,

    'supports' => array( 'title', 'editor', 'thumbnail' ),

    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,

    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'has_archive' => true,
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'capability_type' => 'post'
  );

  register_post_type( 'fair', $args );
}

//Publication
add_action( 'init', 'register_cpt_publication' );

function register_cpt_publication() {

  $labels = array(
    'name' => _x( 'Publications', 'publication' ),
    'singular_name' => _x( 'Publication', 'publication' ),
    'add_new' => _x( 'Add New', 'publication' ),
    'add_new_item' => _x( 'Add New Publication', 'publication' ),
    'edit_item' => _x( 'Edit Publication', 'publication' ),
    'new_item' => _x( 'New Publication', 'publication' ),
    'view_item' => _x( 'View Publication', 'publication' ),
    'search_items' => _x( 'Search Publications', 'publication' ),
    'not_found' => _x( 'No publications found', 'publication' ),
    'not_found_in_trash' => _x( 'No publications found in Trash', 'publication' ),
    'parent_item_colon' => _x( 'Parent Publication:', 'publication' ),
    'menu_name' => _x( 'Publications', 'publication' ),
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => false,

    'supports' => array( 'title', 'editor', 'thumbnail' ),

    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,

    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'has_archive' => true,
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'capability_type' => 'post'
  );

  register_post_type( 'publication', $args );
}

//Artist
add_action( 'init', 'register_cpt_artist' );

function register_cpt_artist() {

  $labels = array(
    'name' => _x( 'Artists', 'artist' ),
    'singular_name' => _x( 'Artist', 'artist' ),
    'add_new' => _x( 'Add New', 'artist' ),
    'add_new_item' => _x( 'Add New Artist', 'artist' ),
    'edit_item' => _x( 'Edit Artist', 'artist' ),
    'new_item' => _x( 'New Artist', 'artist' ),
    'view_item' => _x( 'View Artist', 'artist' ),
    'search_items' => _x( 'Search Artists', 'artist' ),
    'not_found' => _x( 'No artists found', 'artist' ),
    'not_found_in_trash' => _x( 'No artists found in Trash', 'artist' ),
    'parent_item_colon' => _x( 'Parent Artist:', 'artist' ),
    'menu_name' => _x( 'Artists', 'artist' ),
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => false,

    'supports' => array( 'title', 'editor', 'thumbnail' ),

    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,

    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'has_archive' => 'artists',
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'capability_type' => 'post'
  );

  register_post_type( 'artist', $args );
}
