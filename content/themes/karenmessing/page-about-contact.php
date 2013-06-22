<?php get_header(); ?>

<div class="about-content">
  <h2>About</h2>
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