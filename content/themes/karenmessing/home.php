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
        <a href="<?php echo get_permalink($work->ID); ?>" style="background-image: url(<?= wp_get_attachment_image_src( get_field('cover_image', $work->ID)['id'], 'large' )[0]; ?>)">
          <span class="block-title-wrap">
            <span class="block-title"><?php echo $work->post_title; ?></span>
          </span>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>

<ul class="grid work-categories">
  <?php
  $cat_pages = get_posts(array(
    'post_type' => 'page',
    'meta_key' => '_wp_page_template',
    'meta_value' => 'misc-work-template.php'
  ));
  
  foreach ($cat_pages as $cat_page):
  ?>  
    <li class="grid-block <?= $cat_page->post_name; ?>">
      <a href="/<?= $cat_page->post_name; ?>">
        <span class="block-title-wrap">
          <span class="block-title"><?= $cat_page->post_title; ?></span>
        </span>
      </a>
    </li>
  <?php endforeach; ?>
</ul>

<?php get_footer(); ?>