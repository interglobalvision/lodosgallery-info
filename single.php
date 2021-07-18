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
          ?>
          <?php get_template_part('partials/documentation'); ?>
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
