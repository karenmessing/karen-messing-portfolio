<?php get_header(); ?>

<h1><?php single_cat_title(); ?></h1>

<?php $i = 0; ?>
<?php foreach ($posts as $project): ?>
  <div class="images">
    <?php if ($i++ == 0): ?>
      <a href="#" class="navigation-arrow mask-icon arrow-up back-to-top"></a>
    <?php endif; ?>
    
    <section class="work-item">
      <p class="description">
        <?php if (get_field('project_link', $project->ID)): ?>
          <?php $title = get_field('project_link', $project->ID); ?>
          <a href="//<?= $title; ?>"><?= $title; ?></a>
        <?php else: ?>
          <?php $title = $project->post_title; ?>
          <a href="<?= get_permalink($project); ?>"><?= $title; ?></a>
        <?php endif; ?>
      </p>
      
      <?php if (get_field('category_page_images', $project->ID)): ?>
        <?php while (has_sub_field('category_page_images', $project->ID)): ?>
          <img src="<?= get_sub_field('image', $project->ID)['url']; ?>" />
        <?php endwhile; ?>
      <?php else: ?>
        <img src="<?= get_field('cover_image', $project->ID)['url']; ?>" />
      <?php endif; ?>
    </section>
  </div>
<?php endforeach; ?>

<?php get_footer(); ?>