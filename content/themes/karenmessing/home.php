<?php
get_header();

# Get the selected works.
$selected_works = get_field('selected_works', 'options');

# Get the available categories.
$args = array('hide_empty' => null);
$categories = get_categories($args);
?>

<?php if ($selected_works): ?>
  <ul class="grid featured-work">
    <?php foreach ($selected_works as $work): ?>
      <li class="grid-block <?php echo $work->post_name; ?>">
        <a href="<?php echo get_permalink($work->ID); ?>">
          <?php echo $work->post_title; ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>

<?php if ($categories): ?>
  <ul class="grid work-categories">
    <?php foreach ($categories as $category): ?>
      <?php if ($category->slug === 'uncategorized') continue; ?>
      
      <li class="grid-block <?php echo $category->slug; ?>">
        <a href="<?php echo get_category_link($category->cat_ID); ?>"><?php echo $category->slug; ?></a>
      </li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>

<?php get_footer(); ?>