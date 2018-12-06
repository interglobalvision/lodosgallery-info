<?php
get_header();
?>

<main id="main-content">
  <section id="<?php echo get_post_type(); ?>">
    <div class="container">

<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();

    $artists = get_post_meta($post->ID, '_igv_exhibition_artist', true);
    $title = get_post_meta($post->ID, '_igv_exhibition_title', true);
    $group = get_post_meta($post->ID, '_igv_exhibition_group', true);
    $dates = get_post_meta($post->ID, '_igv_exhibition_dates', true);

    $current_lang = qtranxf_getLanguage();
    $pdf = get_post_meta($post->ID, '_igv_exhibition_pdf_' . $current_lang, true);
    $content = get_the_content();

    $documentation = get_post_meta($post->ID, '_igv_documentation_group', true);
?>
      <article <?php post_class('grid-row justify-center margin-bottom-mid'); ?> id="post-<?php the_ID(); ?>">
        <div class="grid-item item-s-12 item-m-10 item-l-8">
          <header id="single-header">
            <?php
              if (!empty($artists) || !empty($title)) {
                echo '<h1 class="font-size-basic">';
                if (!empty($group)) {
                  echo !empty($title) ? $title . '<br>' : '';
                  list_artists($artists);
                } else {
                  list_artists($artists);
                  echo !empty($artists) ? '<br>' : '';
                  echo !empty($title) ? $title : '';
                }
                echo '</h1>';
              }

              echo !empty($dates) ? '<div><span>' . $dates . '</span></div>' : '';

              if (!empty($pdf)) {
                echo '<div><a href="' . $pdf . '" class="link-underline">';
                _e('[:en]Press Release[:es]Comunicado de prensa[:]');
                echo '</a></div>';
              }
            ?>
          </header>
          <?php
            echo !empty($content) ? '<div id="single-content" class="margin-top-small">' . $content . '</div>' : '';

            if (!empty($documentation)) {
          ?>
          <div id="documentation" class="margin-top-basic">
            <?php
              foreach ($documentation as $item) {
                echo '<div class="documentation-item margin-bottom-small">';

                if (!empty($item['image_id'])) {
                  echo wp_get_attachment_image($item['image_id'], 'full');
                } else if (!empty($item['vimeo_id'])) {
                  echo $item['vimeo_id'];
                }


                echo !empty($item['caption']) ? '<div class="documentation-caption">' . apply_filters('the_caption', $item['caption']) . '</div>' : '';

                echo '</div>';
              }
            ?>
          </div>
          <?php
            }
          ?>
        </div>
      </article>
<?php
  }
}
?>

    </div>
  </section>
</main>

<?php
get_footer();
?>
