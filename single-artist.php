<?php
get_header();
?>

<main id="main-content" class="padding-top-mid">
  <div id="artist-image" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')"></div>
  <section id="<?php echo get_post_type(); ?>">
    <div class="container">
<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();

    $current_lang = qtranxf_getLanguage();
    $cv = get_post_meta($post->ID, '_igv_cv_pdf_' . $current_lang, true);
    $press = get_post_meta($post->ID, '_igv_press_pdf_' . $current_lang, true);
?>
      <article <?php post_class('grid-row justify-center'); ?> id="post-<?php the_ID(); ?>">
        <div class="grid-item item-s-12 item-m-10 item-l-8">
          <header id="single-header">
            <h1 class="font-size-basic"><?php the_title(); ?></h1>
            <?php
              if (!empty($cv) || !empty($press)) {
            ?>
              <div class="margin-top-tiny">
                <?php
                  if (!empty($cv) {
                ?>
                  <div><a href="<?php echo $cv; ?>" class="link-underline" target="_blank">CV</a></div>
                <?php
                  }
                  if (!empty($press) {
                ?>
                  <div><a href="<?php echo $press; ?>" class="link-underline" target="_blank"><?php
                    _e('[:en]Press[:es]Prensa[:]');
                  ?></a></div>
                <?php
                  }
                ?>
              </div>
            <?php
              }
            ?>
          </header>
          <?php
            if (!empty(get_the_content())) {
          ?>
            <div id="single-content" class="margin-top-small"><?php the_content(); ?></div>
          <?php
            }
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
