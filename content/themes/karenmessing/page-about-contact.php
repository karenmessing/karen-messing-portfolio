<?php get_header(); ?>

<h1>About</h1>

<div class="about-content">
  <?php the_field('about_details'); ?>
</div>

<aside class="contact-details">
  <h2>Contact</h2>
  
  <ul>
    <?php while (has_sub_field('contact_details')): ?>
      <li>
        <?php if (get_sub_field('method_uri')): ?>
          <a href="<?php the_sub_field('method_uri');?>"><?php the_sub_field('method_title'); ?></a>
        <?php else: ?>
          <?php the_sub_field('method_title'); ?>
        <?php endif; ?>
      </li>
    <?php endwhile; ?>
  </ul>
</aside>

about

<?php get_footer(); ?>