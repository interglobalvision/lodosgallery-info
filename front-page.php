<?php
get_header();
?>

<main id="main-content" class="padding-top-mid margin-bottom-mid">
  <section id="posts">


<?php
$home_image = null;

if (have_posts()) {
  while (have_posts()) {
    the_post();

    $home_post = get_post_meta($post->ID, '_igv_home_post', true);
    $default_image = get_post_meta($post->ID, '_igv_home_image_id', true);
    $default_text = get_post_meta($post->ID, '_igv_home_text', true);
    $overlay_color = get_post_meta($post->ID, '_igv_home_overlay_color', true);
    $home_link = null;

    if (!empty($default_image)) {
      $home_image = $default_image;
    }

    if (!empty($home_post)) {

      $artists = get_post_meta($home_post, '_igv_exhibition_artist', true);
      $title = get_post_meta($home_post, '_igv_exhibition_title', true);
      $dates = get_post_meta($home_post, '_igv_exhibition_dates', true);
      $home_link = get_the_permalink($home_post);

      if (!empty($artists) || !empty($title)) {
        $group = get_post_meta($home_post, '_igv_exhibition_group', true);

        echo '<div id="home-text-holder" class="container grid-row align-items-center"><a href="' . $home_link . '" class="home-hover grid-item font-size-basic"><h2>';
        if (!empty($group)) {
          echo !empty($title) ? $title . '<br>' : '';
          list_artists($artists);
        } else {
          list_artists($artists);
          echo !empty($artists) ? '<br>' : '';
          echo !empty($title) ? $title : '';
        }
        echo '</h2>';
        echo !empty($dates) ? '<div><span>' . $dates . '</span></div>' : '';
        echo '</a></div>';
      }

      $exhibition_image = get_post_meta($home_post, '_igv_exhibition_home_image_id', true);

      if (!empty($exhibition_image)) {
        $home_image = $exhibition_image;
      }
    } elseif (!empty($default_text)) {
      echo '<div id="home-text-holder" class="container grid-row align-items-center"><div class="home-hover grid-item font-size-basic">';
      echo apply_filters('the_content', $default_text);
      echo '</div></div>';
    }

?>

  <div id="home-image-holder" class="container grid-row align-items-center justify-center">
    <?php echo !empty($home_link) ? '<a href="' . $home_link . '" class="home-hover">' : '<div class="home-hover">'; ?>
      <?php echo $home_image !== null ? wp_get_attachment_image($home_image, 'full') : ''; ?>
      <?php echo !empty($overlay_color) ? '<div id="home-image-overlay" style="background-color: ' . $overlay_color . '"></div>' : ''; ?>
    <?php echo !empty($home_link) ? '</a>' : '</div>'; ?>
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
