<?php
get_header();
?>

<main id="main-content">
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
?>

        <article <?php post_class('grid-row'); ?> id="post-<?php the_ID(); ?>">
          <div class="grid-item item-s-12 margin-bottom-basic">
            <?php the_content(); ?>
          </div>
          <?php
            if (!empty($email) || !empty($phone) || !empty($hours)) {
          ?>
          <div class="grid-item item-s-12 item-m-4 item-l-3 margin-bottom-basic">
            <?php
              echo !empty($email) ? '<div class="margin-bottom-tiny"><a href="mailto:' . $email . '">' . $email . '</a></div>' : '' ;
              echo !empty($phone) ? '<div class="margin-bottom-tiny"><a href="tel:' . $phone . '">' . $phone . '</a></div>' : '' ;
              echo !empty($hours) ? apply_filters('the_content', $hours) : '';
            ?>
          </div>
          <?php
            }

            if (!empty($map_embed)) {
          ?>
          <div class="grid-item item-s-12 item-m-4 offset-l-2 margin-bottom-basic" id="map-holder">
            <?php echo $map_embed; ?>
          </div>
          <?php
            }

            if (!empty($address)) {
          ?>
          <div class="grid-item item-s-12 item-m-4 item-l-3 margin-bottom-basic">
          <?php
            echo !empty($map_link) ? '<a href="' . $map_link . '">' : '';
            echo apply_filters('the_content', $address);
            echo !empty($map_link) ? '</a>' : '';
          ?>
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
