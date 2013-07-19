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
          <img src="<?= wp_get_attachment_image_src( get_field('cover_image', $work->ID)['id'], 'large' )[0]; ?>" />
          <span class="block-title-wrap">
            <span class="block-title"><?php echo $work->post_title; ?></span>
          </span>
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
        <a href="<?php echo get_category_link($category->cat_ID); ?>">
          <span class="block-title-wrap">
            <span class="block-title"><?php echo $category->name; ?></span>
          </span>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>

<?php get_footer(); ?>