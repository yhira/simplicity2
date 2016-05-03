<!--ページャー-->
<div class="pager">
  <?php global $wp_rewrite;
  $paginate_base = get_pagenum_link(1);
  if(strpos($paginate_base, '?') || ! $wp_rewrite->using_permalinks()){
    $paginate_format = '';
    $paginate_base = add_query_arg('paged','%#%');
  }
  else{
    $paginate_format = (substr($paginate_base,-1,1) == '/' ? '' : '/') .
    user_trailingslashit('page/%#%/','paged');;
    $paginate_base .= '%_%';
  }

  if ( is_mobile() &&
       !is_page_cache_enable() ) {
    $mid_size = 1;
  } if ( is_page_cache_enable() ) {//ページキャッシュモードの時
    $mid_size = 2;
  } else {
    $mid_size = 3;
  }

  echo paginate_links(array(
    'base' => $paginate_base,
    'format' => $paginate_format,
    'total' => $wp_query->max_num_pages,
    'mid_size' => $mid_size,
    'current' => ($paged ? $paged : 1),
    'prev_text' => '<span class="fa fa-caret-left fa-fx"></span>&#160;',
    'next_text' => '&#160;<span class="fa fa-caret-right fa-fx"></span>',
  )); ?>
</div><!-- /.pager -->