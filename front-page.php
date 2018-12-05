<?php
get_header();
?>

<main id="main-content">
  <section id="posts">
    <div class="container">

<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();
?>

      <div class="grid-row"></div>

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
