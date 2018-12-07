<?php
get_header();
?>

<main id="main-content" class="padding-top-mid margin-bottom-mid">
  <section id="page">
    <div class="container">

<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();

    $address = get_post_meta($post->ID, '_igv_about_address', true);
    $phone = get_post_meta($post->ID, '_igv_about_phone', true);
    $email = get_post_meta($post->ID, '_igv_about_email', true);
    $hours = get_post_meta($post->ID, '_igv_about_hours', true);
    $map_link = get_post_meta($post->ID, '_igv_about_map_link', true);
    $map_embed = get_post_meta($post->ID, '_igv_about_map_embed', true);
    $etc = get_post_meta($post->ID, '_igv_about_etc', true);
?>

        <article <?php post_class('grid-row'); ?> id="post-<?php the_ID(); ?>">
          <div class="grid-item item-s-12 margin-bottom-basic">
            <?php the_content(); ?>
          </div>
          <?php
            if (!empty($email) || !empty($phone) || !empty($hours) || !empty($address) || !empty($etc)) {
          ?>
          <div class="grid-item item-s-12 item-m-4 item-l-3 margin-bottom-basic">
            <?php
              if (!empty($address)) {
                echo '<div class="margin-bottom-tiny">';
                echo !empty($map_link) ? '<a href="' . $map_link . '">' : '';
                echo apply_filters('the_content', $address);
                echo !empty($map_link) ? '</a>' : '';
                echo '</div>';
              }
              echo !empty($hours) ? '<div class="margin-bottom-tiny">' . apply_filters('the_content', $hours) . '</div>' : '';
              echo !empty($email) ? '<div class="margin-bottom-tiny"><a href="mailto:' . $email . '">' . $email . '</a></div>' : '' ;
              echo !empty($phone) ? '<div class="margin-bottom-tiny"><a href="tel:' . $phone . '">' . $phone . '</a></div>' : '' ;
              echo !empty($etc) ? '<div class="margin-bottom-tiny">' . apply_filters('the_content', $etc) . '</div>' : '';
            ?>
          </div>
          <?php
            }

            if (!empty($map_embed)) {
          ?>
          <div class="grid-item item-s-12 item-m-8 item-l-6 margin-bottom-basic" id="map-holder">
            <?php echo $map_embed; ?>
          </div>
          <?php
            }
          ?>
        </article>

<?php
  }
}
?>

      </div>
    </div>
  </section>

</main>

<?php
get_footer();
?>
