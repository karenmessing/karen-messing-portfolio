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
    <li><a href="#" class="navigation-arrow mask-icon arrow-up back-to-top hide-phone"></a></li>
    <?php while (has_sub_field('images')): ?>
      <li class="image">
        <img src="<?= get_sub_field('image')['url']; ?>" />
      </li>
    <?php endwhile; ?>
  </ul>
<?php endif; ?>

<div class="navigation-arrow-wrap-phone phone-only">
  <a href="#" class="navigation-arrow mask-icon arrow-up back-to-top"></a>
</div>
<section class="work-nav">
  <div class="navigation-arrow-wrap">
    <?php previous_post_link(); ?>
  </div>
  
  <div class="navigation-arrow-wrap">
    <?php next_post_link(); ?>
  </div>
</section>

<?php get_footer(); ?>