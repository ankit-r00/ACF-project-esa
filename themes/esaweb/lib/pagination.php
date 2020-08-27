<div class="post-pagination">
  <?php
  global $wp_query;

  if ( $wp_query->max_num_pages > 1 ) {
    $big = 99999999;
    echo paginate_links(array(
      'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
      'format' => '/page/%#%',
      'total' => $wp_query->max_num_pages,
      'current' => max(1, get_query_var('paged')),
      'show_all' => false,
      'end_size' => 2,
      'mid_size' => 3,
      'prev_next' => true,
      'prev_text' => '<i class="fas fa-chevron-left"></i> <sapn>Prev</sapn>',
      'next_text' => '<span>Next</span> <i class="fas fa-chevron-right"></i>',
      'type' => 'list'
    ));

  }
  ?>

</div> <!-- post-pagination -->
