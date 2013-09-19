<?php
// Template Name: Misc. work page
// Default page post. Used for the 'categories'.
get_header();
?>

<h1><?= $post->post_title; ?></h1>

<a href="#" class="navigation-arrow mask-icon arrow-up back-to-top"></a>

<?php while (has_sub_field('projects')): ?>
  <article class="work-item">
    <p class="description">
      <?php $link = get_sub_field('link'); ?>
      <?php if ($link): ?>
        <a href="//<?= $link; ?>">
      <?php endif; ?>
      
      <?= the_sub_field('title'); ?>
      
      <?php if ($link): ?>
        </a>
      <?php endif; ?>
    </p>
  
    <ul class="images">
      <li><img src="<?php the_sub_field('image'); ?>"></li>
    </ul>
  </article>
<?php endwhile; ?>

<?php include(theme\INCLUDE_PATH . '/nav-arrows.php'); ?>

<?php get_footer(); ?>