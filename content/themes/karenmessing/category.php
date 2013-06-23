<?php get_header(); ?>

<h2><?php single_cat_title(); ?></h2>

<?php foreach ($posts as $project): ?>
  <?php echo $project->post_title; ?>
<?php endforeach; ?>

<?php get_footer(); ?>