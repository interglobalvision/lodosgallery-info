<?php

// Custom functions (like special queries, etc)

function list_artists($artists, $single = false) {
  if (!empty($artists)) {
    $artist_count = count($artists);
    $a = 1;

    if ($artist_count >= 8 && !$single) {
      echo 'group show';
    } else {
      foreach ($artists as $artist) {
        echo '<span>';
        echo $artist;
        echo $a < $artist_count ? ', ' : '';
        echo '</span>';
        $a++;
      }
    }
  }
}
