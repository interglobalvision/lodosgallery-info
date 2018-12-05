<?php

// Custom functions (like special queries, etc)

function list_artists($artists) {
  if (!empty($artists)) {
    $artist_count = count($artists);
    $a = 1;

    if ($artist_count <= 8) {
      foreach ($artists as $artist) {
        echo $artist;
        echo $a < $artist_count ? ', ' : '';
        $a++;
      }
    } else {
      echo 'group show';
    }
  }
}
