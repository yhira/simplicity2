<?php
//CFilteringプラグインと連携して精度の高い関連記事を表示する
//https://technote.space/cfiltering
if ( !function_exists( 'coordinate_with_cfiltering_plugin' ) ):
function coordinate_with_cfiltering_plugin() {
  if (function_exists('cf_get_posts')) {
    $posts = cf_get_posts();
    if (count($posts) > 0) {
      $pre_get_posts = function ($query) use (&$pre_get_posts, $posts) {
        $num = $query->query_vars['posts_per_page'];
        $query->set('p', -1);
        $the_posts = function () use (&$the_posts, $posts, $num) {
          remove_action('the_posts', $the_posts);
          return array_slice($posts, 0, $num);
        };
        add_action('the_posts', $the_posts);
        remove_action('pre_get_posts', $pre_get_posts);
      };
      add_action('pre_get_posts', $pre_get_posts);
      return;
    }
  }
}
endif;
add_action('get_template_part_related-entries', 'coordinate_with_cfiltering_plugin');