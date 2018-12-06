<?php
get_header();
?>

<main id="main-content">
  <section id="posts">
    <div class="container">
      <div class="grid-row">

<?php
if (have_posts()) {

  $current_count = 0;
  $upcoming_count = 0;
  $current_time = time();

  // Query Arguments
  $args = array(
    'post_type' => array('exhibition'),
    'nopaging' => true,
    'order' => 'DESC',
    'orderby' => 'meta_value_num',
    'meta_key' => '_igv_exhibition_end',
    'meta_query' => array(
      'relation' => 'AND',
      array(
        'key' => '_igv_exhibition_start',
        'value' => $current_time,
        'compare' => '<='
      ),
      array(
        'key' => '_igv_exhibition_end',
        'value' => $current_time,
        'compare' => '>='
      )
    )
  );

  // The Query
  $current = new WP_Query( $args );

  // The Loop
  if ( $current->have_posts() ) {

    $current_count = $current->post_count;

?>
        <div class="grid-item item-s-12 <?php echo $current_count < 2 ? 'item-m-6' : ''; ?> no-gutter margin-bottom-basic">
          <div class="grid-row">
            <h2 class="grid-item margin-bottom-small">
              <?php _e('[:en]Currently on view[:es]Actualmente[:]'); ?>
            </h2>
          </div>
          <div class="grid-row">
<?php
    $classes = $current_count < 2 ? 'grid-item item-s-12 item-m-8 item-xl-6 margin-bottom-small' : 'grid-item item-s-12 item-m-4 item-xl-3 margin-bottom-small';

    while ( $current->have_posts() ) {
      $current->the_post();

      $artists = get_post_meta($post->ID, '_igv_exhibition_artist', true);
      $title = get_post_meta($post->ID, '_igv_exhibition_title', true);
      $group = get_post_meta($post->ID, '_igv_exhibition_group', true);
      $dates = get_post_meta($post->ID, '_igv_exhibition_dates', true);
?>

            <article <?php post_class($classes); ?> id="post-<?php the_ID(); ?>">

              <a href="<?php the_permalink() ?>" class="u-inline-block">
                <?php the_post_thumbnail('archive-thumb'); ?>
                <?php
                  if (!empty($artists) || !empty($title)) {
                    echo '<h3 class="font-size-basic">';
                    if (!empty($group)) {
                      echo !empty($title) ? $title . '<br>' : '';
                      list_artists($artists);
                    } else {
                      list_artists($artists);
                      echo !empty($artists) ? '<br>' : '';
                      echo !empty($title) ? $title : '';
                    }
                    echo '</h3>';

                    echo !empty($dates) ? '<div><span>' . $dates . '</span></div>' : '';
                  }
                ?>
              </a>

            </article>

<?php
    }
?>
          </div>
        </div>
<?php
  }

  wp_reset_postdata();

  // Query Arguments
  $args = array(
    'post_type' => array('exhibition'),
    'nopaging' => true,
    'order' => 'DESC',
    'orderby' => 'meta_value_num',
    'meta_key' => '_igv_exhibition_start',
    'meta_query' => array(
      array(
        'key' => '_igv_exhibition_start',
        'value' => $current_time,
        'compare' => '>'
      )
    )
  );

  // The Query
  $upcoming = new WP_Query( $args );

  // The Loop
  if ( $upcoming->have_posts() ) {

    $upcoming_count = $upcoming->post_count;
?>
        <div class="grid-item item-s-12 <?php echo ($current_count < 2) && ($upcoming_count < 4) ? 'item-m-6' : ''; ?> no-gutter margin-bottom-basic">
          <div class="grid-row">
            <h2 class="grid-item margin-bottom-small">
              <?php _e('[:en]Upcoming[:es]Próximamente[:]'); ?>
            </h2>
          </div>
          <div class="grid-row">
<?php
    $classes = ($current_count < 2) && ($upcoming_count < 4) ? 'grid-item item-s-12 item-m-6 margin-bottom-small' : 'grid-item item-s-12 item-m-3 margin-bottom-small';

    while ( $upcoming->have_posts() ) {
      $upcoming->the_post();

      $artists = get_post_meta($post->ID, '_igv_exhibition_artist', true);
      $title = get_post_meta($post->ID, '_igv_exhibition_title', true);
      $group = get_post_meta($post->ID, '_igv_exhibition_group', true);
      $dates = get_post_meta($post->ID, '_igv_exhibition_dates', true);
?>

            <article <?php post_class($classes); ?> id="post-<?php the_ID(); ?>">

              <a href="<?php the_permalink() ?>" class="u-inline-block">
                <?php the_post_thumbnail('archive-thumb'); ?>
                <?php
                  if (!empty($artists) || !empty($title)) {
                    echo '<h3 class="font-size-basic">';
                    if (!empty($group)) {
                      echo !empty($title) ? $title . '<br>' : '';
                      list_artists($artists);
                    } else {
                      list_artists($artists);
                      echo !empty($artists) ? '<br>' : '';
                      echo !empty($title) ? $title : '';
                    }
                    echo '</h3>';

                    echo !empty($dates) ? '<div><span>' . $dates . '</span></div>' : '';
                  }
                ?>
              </a>

            </article>

<?php
    }
?>
          </div>
        </div>
<?php
  }

  wp_reset_postdata();

  // Query Arguments
  $args = array(
    'post_type' => array('exhibition'),
    'nopaging' => true,
    'order' => 'DESC',
    'orderby' => 'meta_value_num',
    'meta_key' => '_igv_exhibition_end',
    'meta_query' => array(
      array(
        'key' => '_igv_exhibition_end',
        'value' => $current_time,
        'compare' => '<'
      )
    )
  );

  // The Query
  $past = new WP_Query( $args );

  $year = 0;

  // The Loop
  if ( $past->have_posts() ) {
    $past_count = $past->post_count;
?>
        <div class="grid-item item-s-12 no-gutter">
<?php
    while ( $past->have_posts() ) {
      $past->the_post();

      $current_post_num = $past->current_post + 1;

      $artists = get_post_meta($post->ID, '_igv_exhibition_artist', true);
      $title = get_post_meta($post->ID, '_igv_exhibition_title', true);
      $group = get_post_meta($post->ID, '_igv_exhibition_group', true);
      $dates = get_post_meta($post->ID, '_igv_exhibition_dates', true);
      $start = get_post_meta($post->ID, '_igv_exhibition_start', true);
      $expo_year = date('Y', $start);

      if ($year !== $expo_year) {
        $year = $expo_year;
?>
          <?php echo $current_post_num !== 1 ? '</div></div>' : ''; ?>
          <div class="margin-bottom-basic">
            <div class="grid-row">
              <h2 class="grid-item margin-bottom-small">
                <?php echo $year; ?>
              </h2>
            </div>
            <div class="grid-row">
<?php
      }
?>
              <article <?php post_class('grid-item item-s-12 item-m-4 item-xl-3 margin-bottom-small'); ?> id="post-<?php the_ID(); ?>">

                <a href="<?php the_permalink() ?>" class="u-inline-block">
                  <?php the_post_thumbnail('archive-thumb'); ?>
                  <?php
                    if (!empty($artists) || !empty($title)) {
                      echo '<h3 class="font-size-basic">';
                      if (!empty($group)) {
                        echo !empty($title) ? $title . '<br>' : '';
                        list_artists($artists);
                      } else {
                        list_artists($artists);
                        echo !empty($artists) ? '<br>' : '';
                        echo !empty($title) ? $title : '';
                      }
                      echo '</h3>';

                      echo !empty($dates) ? '<div><span>' . $dates . '</span></div>' : '';
                    }
                  ?>
                </a>

              </article>
            <?php echo $past_count === $current_post_num ? '</div></div>' : ''; ?>
<?php
    }
?>
        </div>
<?php
  }

  wp_reset_postdata();
}
?>

      </div>
    </div>
  </section>

</main>

<?php
get_footer();
?>
