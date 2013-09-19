<section class="work-nav">
  <?php
  $merged = array_merge(get_field('selected_works', 'options'), get_posts(array(
    'post_type' => 'page',
    'meta_key' => '_wp_page_template',
    'meta_value' => 'misc-work-template.php'
  )));
    
  $current = $post->post_name;
  $count = count($merged);
  
  # Find the post that matches the current post.
  foreach ($merged as $key => $project) {
    if ($project->post_name === $current) {
      if ($key === 0) {
        $previous = $merged[$count - 1];
        $next = $merged[$key + 1];
      } else {
        $previous = $merged[$key - 1];
        $next = $key === $count - 1 ? $merged[0] : $merged[$key + 1];
      }
      
      if ($previous->post_type === 'post') {
        $previous = "work/{$previous->post_name}";
      } else {
        $previous = $previous->post_name;
      }
      
      if ($next->post_type === 'post') {
        $next = "work/{$next->post_name}";
      } else {
        $next = $next->post_name;
      }
    }
  }
  ?>
  <div class="navigation-arrow-wrap">
    <?= '<a href="/' . $previous . '" class="navigation-arrow mask-icon arrow-left"></a>'; ?>
  </div>
  
  <div class="navigation-arrow-wrap">
    <?= '<a href="/' . $next . '" class="navigation-arrow mask-icon arrow-right"></a>'; ?>
  </div>
</section>