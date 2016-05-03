<!-- ページリンク -->
<?php
$args = array(
  'before' => '<div class="page-link">',
  'after' => '</div>',
  'link_before' => '<span>',
  'link_after' => '</span>',
);
wp_link_pages($args); ?>