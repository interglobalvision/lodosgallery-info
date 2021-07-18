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
              <li>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
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
