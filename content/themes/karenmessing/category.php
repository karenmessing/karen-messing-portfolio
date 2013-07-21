<?php get_header(); ?>

<h1><?php single_cat_title(); ?></h1>

<?php foreach ($posts as $project): ?>
  <div class="images">
    <a href="#" class="navigation-arrow up back-to-top"></a>
    <section class="work-item">
      <p class="description">
        <a href="<?= get_permalink( $project ); ?>"><?= $project->post_title; ?></a>
      </p>
      <img src="<?= get_field('cover_image')['url']; ?>" />
    </div>
  </div>
<?php endforeach; ?>

<?php get_footer(); ?>