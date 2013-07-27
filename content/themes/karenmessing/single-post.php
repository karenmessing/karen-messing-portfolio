<?php get_header(); ?>

<h1 class="project-title"><?php echo $post->post_title; ?></h1>

<div class="description">
  <?php the_field('project_description'); ?>
  
  <?php if (get_field('project_link')): ?>
    <?php $link = get_field('project_link'); ?>
    <a href="//<?php echo $link; ?>"><?php echo $link; ?></a>
  <?php endif; ?>
</div>

<?php if (get_field('images')): ?>
  <ul class="images">
    <li><a href="#" class="navigation-arrow mask-icon arrow-up back-to-top"></a></li>
    <?php while (has_sub_field('images')): ?>
      <li class="image">
        <img src="<?= get_sub_field('image')['url']; ?>" />
      </li>
    <?php endwhile; ?>
  </ul>
<?php endif; ?>

<section class="work-nav">
  <div class="navigation-arrow-wrap">
    <a href="#" class="navigation-arrow mask-icon arrow-left"></a>
  </div>
  <div class="navigation-arrow-wrap">
    <a href="#" class="navigation-arrow mask-icon arrow-right"></a>
  </div>
</section>

<?php get_footer(); ?>