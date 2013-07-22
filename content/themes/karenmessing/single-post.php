<?php get_header(); ?>

<h1 class="project-title"><?php echo $post->post_title; ?></h1>

<div class="description">
  <?php the_field('project_description'); ?>
</div>

<?php if (get_field('images')): ?>
  <ul class="images">
    <li><a href="#" class="navigation-arrow up back-to-top"></a></li>
    <?php while (has_sub_field('images')): ?>
      <li class="image">
        <img src="<?= get_sub_field('image')['url']; ?>" />
      </li>
    <?php endwhile; ?>
  </ul>
<?php endif; ?>

<section class="work-nav">
  <a href="#" class="navigation-arrow left"></a>
  <a href="#" class="navigation-arrow right"></a>
</section>

<?php get_footer(); ?>