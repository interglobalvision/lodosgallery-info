<?php

// Custom functions (like special queries, etc)

function list_artists($artists, $single = false) {
  if (!empty($artists)) {
    $artist_count = count($artists);
    $a = 1;

    if ($artist_count >= 8 && !$single) {
      _e('[:en]group show[:es]exposición colectiva[:]');
    } else {
      foreach ($artists as $artist) {
        echo $artist;
        echo $a < $artist_count ? ', ' : '';
        $a++;
      }
    }
  }
}
