<?php get_header(); ?>

<h1><?php single_cat_title(); ?></h1>

<?php $i = 0;
foreach ($posts as $project): ?>
  <div class="images">
    <?php if ( $i++ == 0 ): ?>
    <a href="#" class="navigation-arrow up back-to-top"></a>
    <?php endif; ?>
    <section class="work-item">
      <p class="description">
        <a href="<?= get_permalink( $project ); ?>"><?= $project->post_title; ?></a>
      </p>
      <img src="<?= get_field('cover_image', $project->ID)['url']; ?>" />
    </section>
  </div>
<?php endforeach; ?>

<?php get_footer(); ?>