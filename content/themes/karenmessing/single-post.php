<?php get_header(); ?>

<h1 class="project-title"><?php echo $post->post_title; ?></h1>

<div class="project-description">
  <?php the_field('project_description'); ?>
</div>

<?php if (get_field('images')): ?>
  <ul class="images">
    <?php while (has_sub_field('images')): ?>
      <li class="image">
        <img src="<?= get_sub_field('image')['url']; ?>" />
      </li>
    <?php endwhile; ?>
  </ul>
<?php endif; ?>

<?php get_footer(); ?>