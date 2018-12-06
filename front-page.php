<?php
get_header();
?>

<main id="main-content">
  <section id="posts">


<?php
$home_image = null;

if (have_posts()) {
  while (have_posts()) {
    the_post();

    $default_image = get_post_meta($post->ID, '_igv_home_image_id', true);

    if (!empty($default_image)) {
      $home_image = $default_image;
    }

    // Query Arguments
    $args = array(
      'post_type' => array('exhibition', 'fair'),
      'nopaging' => true,
      'order' => 'DESC',
      'orderby' => 'meta_value_num',
      'meta_key' => '_igv_exhibition_end',
      'meta_query' => array(
        'relation' => 'AND',
        array(
          'key' => '_igv_exhibition_start',
          'value' => time(),
          'compare' => '<='
        ),
        array(
          'key' => '_igv_exhibition_end',
          'value' => time(),
          'compare' => '>='
        )
      )
    );

    // The Query
    $current = new WP_Query( $args );

    // The Loop
    if ( $current->have_posts() ) {
      while ( $current->have_posts() ) {
        $current->the_post();

        $artists = get_post_meta($post->ID, '_igv_exhibition_artist', true);
        $title = get_post_meta($post->ID, '_igv_exhibition_title', true);

        if (!empty($artists) || !empty($title)) {
          $group = get_post_meta($post->ID, '_igv_exhibition_group', true);

          echo '<div id="home-text-holder" class="container grid-row align-items-center"><h2 class="grid-item font-size-basic"><a href="' . get_the_permalink() . '">';
          if (!empty($group)) {
            echo !empty($title) ? $title . '<br>' : '';
            list_artists($artists);
          } else {
            list_artists($artists);
            echo !empty($artists) ? '<br>' : '';
            echo !empty($title) ? $title : '';
          }
          echo '</a></h2></div>';
        }

        $exhibition_image = get_post_meta($post->ID, '_igv_exhibition_home_image_id', true);

        if (!empty($exhibition_image)) {
          $home_image = $exhibition_image;
        }
      }
    }

    /* Restore original Post Data */
    wp_reset_postdata();
?>

  <div id="home-image-holder" class="container grid-row align-items-center justify-center">
    <?php echo $home_image !== null ? wp_get_attachment_image($home_image, 'full') : ''; ?>
  </div>

<?php
  }
}
?>

  </section>
</main>

<?php
get_footer();
?>
