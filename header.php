<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php wp_title('|',true,'right'); bloginfo('name'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

<?php
get_template_part('partials/globie');
get_template_part('partials/seo');
?>

  <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
  <link rel="icon" href="<?php bloginfo('stylesheet_directory'); ?>/dist/img/favicon.png">
  <link rel="shortcut" href="<?php bloginfo('stylesheet_directory'); ?>/dist/img/favicon.ico">
  <link rel="apple-touch-icon" href="<?php bloginfo('stylesheet_directory'); ?>/dist/img/favicon-touch.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('stylesheet_directory'); ?>/dist/img/favicon.png">

<?php if (is_singular() && pings_open(get_queried_object())) { ?>
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<?php } ?>

  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!--[if lt IE 9]><p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]-->

<section id="main-container">

  <header id="header">
    <div class="container padding-top-tiny grid-row justify-between">
      <div class="grid-row">
        <h1 class="u-visuallyhidden"><?php bloginfo('name'); ?></h1>
        <div id="header-menu" class="grid-item">
          <?php
            wp_nav_menu( array(
              'menu' => 'main'
            ) );

            $current_lang = qtranxf_getLanguage();
          ?>
          <form id="mailchimp-form" novalidate="true">
            <input id="mailchimp-email" type="email" name="EMAIL" placeholder="<?php _e('[:en]Subscribe[:es]Suscríbete[:]'); ?>" class="input-<?php echo $current_lang; ?>">
            <button id="mailchimp-submit" type="submit"><?php _e('[:en]Submit[:es]Enviar[:]'); ?></button>
          </form>
          <?php echo qtranxf_generateLanguageSelectCode('text'); ?>
        </div>
      </div>
      <div id="mailchimp-response" class="grid-item">&nbsp;</div>
    </div>
  </header>
