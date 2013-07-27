<?php get_header(); ?>

<h1><?php single_cat_title(); ?></h1>

<?php $i = 0; ?>
<?php foreach ($posts as $project): ?>
  <div class="images">
    <?php if ($i++ == 0): ?>
      <a href="#" class="navigation-arrow up back-to-top"></a>
    <?php endif; ?>
    
    <section class="work-item">
      <p class="description">
        <?php
          if (get_field('project_link', $project->ID)) {
            $title = get_field('project_link', $project->ID);
          } else {
            $title = $project->post_title;
          }
        ?>
        
        <a href="<?= get_permalink( $project ); ?>"><?= $title; ?></a>
      </p>
      
      <img src="<?= get_field('cover_image', $project->ID)['url']; ?>" />
    </section>
  </div>
<?php endforeach; ?>

<?php get_footer(); ?>