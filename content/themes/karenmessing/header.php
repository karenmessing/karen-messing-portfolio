<?php
$km = getApp();
use theme\helpers\Assets as Assets;
use theme\helpers\Security as Security;

Security::forceLogin();
?>
<!doctype html>

<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  
  <?php
  $title = get_bloginfo('title');
  $desc = get_bloginfo('description');
  ?>
  
  <title><?php echo $title; ?></title>
  <meta name="description" content="<?php echo $desc; ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  
  <link rel="stylesheet" href="<?php Assets::css('style'); ?>">
  
  <!--[if lt IE 9]>
    <script src="<?php Assets::js('libs/html5shiv'); ?>"></script>
  <![endif]-->
    
  <script src="<?php Assets::js('libs/modernizr'); ?>"></script>
    
  <?php /* ?>
  <style class="custom-category-css"></style>
  
  <script>
    window.km = window.km || {}; // Global namespace.
    window.km.config = {}; // Config data.
    window.km.bootstrapped = {}; // Bootstrapped data.
  </script>
  
  <script data-main="<?php echo Assets::js('main'); ?>" src="<?php Assets::js('libs/require'); ?>"></script>
  <?php */ ?>

  <?php wp_head(); ?>
</head>

<body <?php body_class('page-' . $post->post_name); ?>>
  <div class="container">
    <header class="global-header <?php if ($post->post_name === 'about') { echo 'mobile-only'; } ?>">
      <a href="/" class="global-logo"><?php echo $title; ?></a>
      <nav class="global-navigation"><?php wp_nav_menu('container=null'); ?></nav>
    </header>
    <div class="site-content">