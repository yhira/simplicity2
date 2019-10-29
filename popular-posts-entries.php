<?php //グローバル変数の呼び出し
global $g_widget_mode;//ウィジェットモード（全て表示するか、カテゴリ別に表示するか）
global $g_entry_count;//エントリー数
global $g_is_pages_include; //固定ページの表示
global $g_is_views_visible;//閲覧数を表示するかどうか
global $g_range;//集計期間
global $g_widget_item;//このテンプレートを利用するウイジェットアイテム
global $g_exclude_ids;//除外ID
global $g_exclude_category_ids;//除外カテゴリID
// $exclude_category_ids = '';
// if (!empty($g_exclude_category_ids)) {
//   $exclude_category_ids = ','.minusize_number_in_array($g_exclude_category_ids);
// }
// var_dump($exclude_category_ids);
//「Simplicity同カテゴリーの人気エントリー」ウイジェットを使用している時だけカテゴリを絞る
$now_id = null;
$post_type = $g_is_pages_include ? null : 'post_type="post"&';
//var_dump($g_is_views_visible);
//var_dump($g_is_pages_include);
//var_dump($g_widget_mode);
if ($g_widget_item == 'SimplicityPopularPostsCategoryWidgetItem' &&
    $g_widget_mode == 'category')://ウィジェットモードが「カテゴリ別表示」のとき
  if ( is_single() ) {//投稿ページでは全カテゴリー取得
    $categories = get_the_category();
    $category_IDs = array();
    foreach($categories as $category):
      array_push( $category_IDs, $category -> cat_ID);
    endforeach ;
    $now_id = implode(",", $category_IDs);
  } elseif ( is_category() ) {//カテゴリページではトップカテゴリーのみ取得
    $categories = get_the_category();
    $cat_now = $categories[0];
    $now_id = $cat_now->cat_ID;
  }
endif;
//var_dump($g_exclude_category_ids);
$exclude_category_ids = minusize_number_in_array($g_exclude_category_ids);
if ($now_id) {
  if ($exclude_category_ids) {
    $now_id = $now_id.','.$exclude_category_ids;
  }
} else {
  $now_id = $exclude_category_ids;
}
//var_dump($now_id);
//デバッグ用
//echo 'IDs:'.$now_id.'<br />';
//echo 'RANGE:'.$g_range;

//Wordpress Popular Postsがインストールされているとき
if ( is_wpp_enable() ):
  $args = '
  limit='.$g_entry_count.'&
  range='.$g_range.'&
  order_by=views&
  thumbnail_width=75&
  thumbnail_height=75&
  cat="'.$now_id.'"&
  pid="'.$g_exclude_ids.'"&
  post_start="<div class="popular-post"><ul>"&
  post_end="</ul></div>"&'.
  $post_type.
  'stats_comments=0&
  stats_views='.($g_is_views_visible ? 1 : 0).'';
  wpp_get_mostpopular($args);
endif;
//グローバル変数のリセット
$g_widget_mode = null;
$g_entry_count = null;
$g_entry_type = null;
$g_is_pages_include = null;
$g_is_views_visible = null;
$g_range = null;
$g_widget_item = null;
$g_exclude_ids = null; ?>
<div class="clear"></div>

