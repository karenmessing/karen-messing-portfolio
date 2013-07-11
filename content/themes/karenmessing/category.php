<?php get_header(); ?>

<h1><?php single_cat_title(); ?></h1>

<?php foreach ($posts as $project): ?>
  <?php echo $project->post_title; ?>
<?php endforeach; ?>

<?php get_footer(); ?>