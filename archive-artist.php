<?php
get_header();
?>

<main id="main-content" class="padding-top-mid margin-bottom-mid">
  <section id="page">
    <div class="container">
      <div class="grid-row">

<?php
if (have_posts()) {
?>
        <article <?php post_class('grid-item item-s-12'); ?> id="post-<?php the_ID(); ?>">
          <div id="page-content">
            <ul>
<?php
  while (have_posts()) {
    the_post();
?>
              <li style="margin-bottom: 1em;">
                <a href="<?php the_permalink(); ?>" class="artist-hover"><?php the_title(); ?></a>
                <div class="artist-image" style="background-image: url('<?php echo get_the_post_thumbnail_url($post, 'archive-thumb'); ?>')"></div>
              </li>
<?php
  }
?>
            </ul>
          </div>
        </article>
<?php
}
?>

      </div>
    </div>
  </section>

</main>

<?php
get_footer();
?>
