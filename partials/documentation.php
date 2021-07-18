<?php
$current_lang = qtranxf_getLanguage();
$documentation = get_post_meta($post->ID, '_igv_documentation_group', true);

if (!empty($documentation)) {
  $total = count($documentation);
  $count = 1;
?>
<div id="documentation" class="margin-top-basic">
  <?php
    foreach ($documentation as $item) {
      $is_caption = empty($item['image_id']) && empty($item['vimeo_id']);
      $is_last = $count === $total || (empty($documentation[$count]['image_id']) && empty($documentation[$count]['vimeo_id']));

      echo '<div class="documentation-item ';
      if (!$is_caption) {
        echo !$is_last ? 'documentation-scroll documentation-next' : 'documentation-scroll documentation-top';
      } else {
        echo 'documentation-caption';
      }
      echo ' margin-bottom-basic text-align-center';
      echo '">';

      if (!empty($item['image_id'])) {
        echo wp_get_attachment_image($item['image_id'], 'full');
      } else if (!empty($item['vimeo_id'])) {
  ?>
  <div class="u-video-embed-container">
    <iframe src="https://player.vimeo.com/video/<?php echo $item['vimeo_id']; ?>?color=ffffff&title=0&byline=0&portrait=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
  </div>
  <?php
      }

      $caption = null;

      if ($current_lang === 'en') {
        if (!empty($item['caption'])) {
          $caption = $item['caption'];
        } else if (!empty($item['caption_es'])) {
          $caption = $item['caption_es'];
        }
      } else {
        if (!empty($item['caption_es'])) {
          $caption = $item['caption_es'];
        } else if (!empty($item['caption'])) {
          $caption = $item['caption'];
        }
      }

      echo !empty($caption) ? '<div class="documentation-caption">' . apply_filters('the_caption', $caption) . '</div>' : '';

      echo '</div>';

      $count++;
    }
  ?>
</div>
<?php
}
?>
