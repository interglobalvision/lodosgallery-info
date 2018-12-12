<?php
get_header();
?>

<main id="main-content" class="padding-top-mid">
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
      <article <?php post_class('grid-row justify-center'); ?> id="post-<?php the_ID(); ?>">
        <div class="grid-item item-s-12 item-m-10 item-l-8">
          <header id="single-header">
            <?php
              if (!empty($artists) || !empty($title)) {
                echo '<h1 class="font-size-basic">';
                echo !empty($title) ? '<em>' . $title . '</em>': '';
                echo !empty($title) && !empty($artists) ? '<br>' : '';
                list_artists($artists, true);
                echo '</h1>';
              }

              echo !empty($dates) ? '<div class="margin-top-tiny"><span>' . $dates . '</span></div>' : '';

              if (!empty($pdf)) {
                echo '<div class="margin-top-tiny"><a href="' . $pdf . '" class="link-underline" target="_blank">';
                _e('[:en]Press Release[:es]Comunicado de prensa[:]');
                echo '</a></div>';
              }
            ?>
          </header>
          <?php
            echo !empty($content) ? '<div id="single-content" class="margin-top-small">' . $content . '</div>' : '';

            if (!empty($documentation)) {
              $total = count($documentation);
              $count = 1;
          ?>
          <div id="documentation" class="margin-top-basic">
            <?php
              foreach ($documentation as $item) {
                echo '<div class="documentation-item margin-bottom-basic text-align-center ';
                echo $count < $total ? 'documentation-next' : 'documentation-top';
                echo '">';

                if (!empty($item['image_id'])) {
                  echo wp_get_attachment_image($item['image_id'], 'documentation');
                } else if (!empty($item['vimeo_id'])) {
                  echo $item['vimeo_id'];
                }


                echo !empty($item['caption']) ? '<div class="documentation-caption">' . apply_filters('the_caption', $item['caption']) . '</div>' : '';

                echo '</div>';

                $count++;
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
