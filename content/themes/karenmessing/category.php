<?php get_header(); ?>

<?php foreach ($posts as $project): ?>
  <?php echo $project->post_title; ?>
<?php endforeach; ?>

<?php get_footer(); ?>