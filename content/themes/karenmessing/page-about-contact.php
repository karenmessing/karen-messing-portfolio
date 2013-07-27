<?php get_header(); ?>

<div class="about-content column">
  <h2>About</h2>
  <section>
    <?php the_field('about_details'); ?>
  </section>
</div>

<aside class="contact-details column">
  <h2>Contact</h2>
  
  <section>
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
  </section>
</aside>

<?php if (get_field('photo')): ?>
  <img class="about-image" src="<?php the_field('photo'); ?>">
<?php endif; ?>

<?php get_footer(); ?>