<?php
get_header();
?>

<main id="main-content" class="padding-top-mid margin-bottom-mid">
  <section id="page">
    <div class="container">
      <div class="grid-row">

<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();
?>

        <article <?php post_class('grid-item item-s-12'); ?> id="post-<?php the_ID(); ?>">
          <div id="page-content">
            <?php the_content(); ?>
          </div>
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
