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
        <?php
          $uri = get_sub_field('method_uri');
          $title = get_sub_field('method_title');
          $blank = false;
          
          if ($uri === 'blank' && $title === 'blank') {
            $blank = true;
            $title = '&nbsp;';
          }
        ?>
        
        <li <?php if ($blank) { echo 'class="blank"'; } ?>>
          <?php if ($blank || !get_sub_field('method_uri')): ?>
            <?php echo $title; ?>
          <?php else: ?>  
            <a href="<?php echo $uri; ?>"><?php echo $title; ?></a>
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