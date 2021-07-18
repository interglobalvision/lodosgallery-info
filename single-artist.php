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
?>
      <article <?php post_class('grid-row justify-center'); ?> id="post-<?php the_ID(); ?>">
        <div class="grid-item item-s-12 item-m-10 item-l-8">
          <header id="single-header">
            <h1 class="font-size-basic"><?php the_title(); ?></h1>
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
