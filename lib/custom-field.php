<?php //投稿・個別ページにカスタムフィールドを設置する

///////////////////////////////////////
// カスタムボックスの追加
///////////////////////////////////////
add_action('admin_menu', 'add_custom_boxes');
function add_custom_boxes(){
  //コメントボックス
  add_meta_box( 'comment_setting_in_page','コメントの設定', 'view_comment_custom_box', 'post', 'side' );
  //広告ボックス
  add_meta_box( 'ad_setting_in_page','広告の設定', 'view_ad_custom_box', 'post', 'side' );
  add_meta_box( 'ad_setting_in_page','広告の設定', 'view_ad_custom_box', 'page', 'side' );
  add_meta_box( 'ad_setting_in_page','広告の設定', 'view_ad_custom_box', 'topic', 'side' );
  //SEOボックス
  add_meta_box( 'seo_setting_in_page','SEO設定', 'view_seo_custom_box', 'post', 'side' );
  add_meta_box( 'seo_setting_in_page','SEO設定', 'view_seo_custom_box', 'page', 'side' );
  add_meta_box( 'seo_setting_in_page','SEO設定', 'view_seo_custom_box', 'topic', 'side' );
  //ページ設定
  add_meta_box( 'page_setting_in_page','ページ設定', 'view_page_custom_box', 'post', 'side' );
  add_meta_box( 'page_setting_in_page','ページ設定', 'view_page_custom_box', 'page', 'side' );
  add_meta_box( 'page_setting_in_page','ページ設定', 'view_page_custom_box', 'topic', 'side' );

}

///////////////////////////////////////
// コメント設定
///////////////////////////////////////
function view_comment_custom_box(){
  global $post;

  $is_comment_form_freeze = get_post_meta(get_the_ID(),'is_comment_form_freeze', true);
  $comment_form_freeze_message = get_post_meta(get_the_ID(),'comment_form_freeze_message', true);

  echo '<label><input type="checkbox" name="is_comment_form_freeze"';
  if( $is_comment_form_freeze ){echo " checked";}
  echo '>コメントの凍結</label>';
  echo '<p class="howto">コメントフォームを非表示にし以降は書き込めないようにします。</p>';

  echo '<label>凍結時のメッセージ</label>';
  echo '<input type="text" name="comment_form_freeze_message"';
  if( $comment_form_freeze_message ){echo ' value="'.$comment_form_freeze_message.'"';}
  echo ' style="width: 100%">';
  echo '<p class="howto">コメント凍結時に表示するメッセージです。未入力の場合はデフォルトのものが表示されます。</p>';
}

add_action('save_post', 'save_comment_custom_data');
function save_comment_custom_data(){
  $id = get_the_ID();
  //コメント凍結
  $is_comment_form_freeze = null;
  if ( isset( $_POST['is_comment_form_freeze'] ) )
    $is_comment_form_freeze = $_POST['is_comment_form_freeze'];
  $is_comment_form_freeze_key = 'is_comment_form_freeze';
  add_post_meta($id, $is_comment_form_freeze_key, $is_comment_form_freeze, true);
  update_post_meta($id, $is_comment_form_freeze_key, $is_comment_form_freeze);
  //コメント凍結メッセージ
  $comment_form_freeze_message = null;
  if ( isset( $_POST['comment_form_freeze_message'] ) )
    $comment_form_freeze_message = $_POST['comment_form_freeze_message'];
  $comment_form_freeze_message_key = 'comment_form_freeze_message';
  add_post_meta($id, $comment_form_freeze_message_key, $comment_form_freeze_message, true);
  update_post_meta($id, $comment_form_freeze_message_key, $comment_form_freeze_message);
}

//コメント欄を凍結するか
function is_comment_form_freeze(){
  return get_post_meta(get_the_ID(), 'is_comment_form_freeze', true);
}

//コメント凍結時のメッセージ
function get_comment_form_freeze_message(){
  return get_post_meta(get_the_ID(), 'comment_form_freeze_message', true);
}

///////////////////////////////////////
// AdSenseの設定
///////////////////////////////////////
function view_ad_custom_box(){
  global $post;

  $is_ads_removed_in_page = get_post_meta(get_the_ID(),'is_ads_removed_in_page', true);

  echo '<label><input type="checkbox" name="is_ads_removed_in_page"';
  if( $is_ads_removed_in_page ){echo " checked";}
  echo '>広告の除外</label>';
  echo '<p class="howto">ページ上の広告（AdSenseなど）をページ上から取り除きます。テーマカスタマイザーの「広告」項目からカテゴリごとの設定も行えます。</p>';
}

add_action('save_post', 'save_ad_custom_data');
function save_ad_custom_data(){
  $id = get_the_ID();
  //広告の除外
  $is_ads_removed_in_page = null;
  if ( isset( $_POST['is_ads_removed_in_page'] ) )
    $is_ads_removed_in_page = $_POST['is_ads_removed_in_page'];
  $is_ads_removed_in_page_key = 'is_ads_removed_in_page';
  add_post_meta($id, $is_ads_removed_in_page_key, $is_ads_removed_in_page, true);
  update_post_meta($id, $is_ads_removed_in_page_key, $is_ads_removed_in_page);
}

//広告を除外しているか
function is_ads_removed_in_page(){
  return get_post_meta(get_the_ID(), 'is_ads_removed_in_page', true);
}

///////////////////////////////////////
// SEO設定
///////////////////////////////////////
function view_seo_custom_box(){
  global $post;

  $is_noindex = get_post_meta(get_the_ID(),'is_noindex', true);
  $is_nofollow = get_post_meta(get_the_ID(),'is_nofollow', true);

  //noindex
  echo '<label><input type="checkbox" name="is_noindex"';
  if( $is_noindex ){echo " checked";}
  echo '>インデックスしない（noindex）</label>';
  echo '<p class="howto">このページが検索エンジンにインデックスされないようにメタタグを設定します。</p>';

  //nofollow
  echo '<label><input type="checkbox" name="is_nofollow"';
  if( $is_nofollow ){echo " checked";}
  echo '>リンクをフォローしない（nofollow）</label>';
  echo '<p class="howto">検索エンジンがこのページ上のリンクをフォローしないようにメタタグを設定します。</p>';
}

add_action('save_post', 'save_seo_custom_data');
function save_seo_custom_data(){
  $id = get_the_ID();
  //noindex
  $is_noindex = null;
  if ( isset( $_POST['is_noindex'] ) )
    $is_noindex = $_POST['is_noindex'];
  $is_noindex_key = 'is_noindex';
  add_post_meta($id, $is_noindex_key, $is_noindex, true);
  update_post_meta($id, $is_noindex_key, $is_noindex);
  //nofollow
  $is_nofollow = null;
  if ( isset( $_POST['is_nofollow'] ) )
    $is_nofollow = $_POST['is_nofollow'];
  $is_nofollow_key = 'is_nofollow';
  add_post_meta($id, $is_nofollow_key, $is_nofollow, true);
  update_post_meta($id, $is_nofollow_key, $is_nofollow);
}

//noindexか
function is_noindex_singular_page(){
  return get_post_meta(get_the_ID(), 'is_noindex', true);
}

//nofollowか
function is_nofollow_singular_page(){
  return get_post_meta(get_the_ID(), 'is_nofollow', true);
}

//noindex、nofollowメタタグの取得
function get_meta_robots_tag(){
  if ( is_noindex_singular_page() && is_nofollow_singular_page()) {
    return '<meta name="robots" content="noindex,nofollow">'.PHP_EOL;
  } elseif ( is_noindex_singular_page() ) {
    return '<meta name="robots" content="noindex">'.PHP_EOL;
  } elseif ( is_nofollow_singular_page() ) {
    return '<meta name="robots" content="nofollow">'.PHP_EOL;
  }
}

///////////////////////////////////////
// ページ設定
///////////////////////////////////////
function view_page_custom_box(){
  global $post;

  $page_type = get_post_meta(get_the_ID(),'page_type', true);

  //ページタイプ
  echo '<label>ページタイプ</label><br>';
  echo '<select name="page_type">';
  //デフォルト
  echo '<option value="default"';
  if( $page_type == 'default' ){echo ' selected';}
  echo '>デフォルト</option>';
  //1カラム（狭い）
  echo '<option value="column1_narrow"';
  if( $page_type == 'column1_narrow' ){echo ' selected';}
  echo '>1カラム（狭い）</option>';
  //1カラム（広い）
  echo '<option value="column1_wide"';
  if( $page_type == 'column1_wide' ){echo ' selected';}
  echo '>1カラム（広い）</option>';
  //本文のみ（狭い）
  echo '<option value="content_only_narrow"';
  if( $page_type == 'content_only_narrow' ){echo ' selected';}
  echo '>本文のみ（狭い）</option>';
  //本文のみ（広い）
  echo '<option value="content_only_wide"';
  if( $page_type == 'content_only_wide' ){echo ' selected';}
  echo '>本文のみ（広い）</option>';
  echo '</select>';
  echo '<p class="howto">このページの表示状態を設定します。「本文のみ」表示はランディングページ（LP）などにどうぞ。</p>';

}

add_action('save_post', 'save_page_custom_data');
function save_page_custom_data(){
  $id = get_the_ID();
  //ページタイプ
  $page_type = null;
  if ( isset( $_POST['page_type'] ) )
    $page_type = $_POST['page_type'];
  $page_type_key = 'page_type';
  add_post_meta($id, $page_type_key, $page_type, true);
  update_post_meta($id, $page_type_key, $page_type);
}


//ページタイプの取得
function get_page_type(){
  return get_post_meta(get_the_ID(), 'page_type', true);
}

//ページタイプはデフォルトか
function is_page_type_default(){
  return get_page_type() == 'default';
}

//ページタイプは狭い1カラムか
function is_page_type_column1_narrow(){
  return get_page_type() == 'column1_narrow';
}

//ページタイプは広い1カラムか
function is_page_type_column1_wide(){
  return get_page_type() == 'column1_wide';
}

//ページタイプは狭い本文のみか
function is_page_type_content_only_narrow(){
  return get_page_type() == 'content_only_narrow';
}

//ページタイプは広い本文のみか
function is_page_type_content_only_wide(){
  return get_page_type() == 'content_only_wide';
}

//ページタイプの表示幅は狭いか
function is_page_type_narrow(){
  return is_page_type_column1_narrow() || is_page_type_content_only_narrow();
}

//ページタイプの表示幅は広いか
function is_page_type_wide(){
  return is_page_type_column1_wide() || is_page_type_content_only_wide();
}

//ページタイプは1カラムか
function is_page_type_column1(){
  return is_page_type_column1_narrow() || is_page_type_column1_wide();
}

//ページタイプは本文のみか
function is_page_type_content_only(){
  return is_page_type_content_only_narrow() || is_page_type_content_only_wide();
}

function get_main_column_width(){
  if ( is_sidebar_width_336() ) {
    return 1106;
  }
  return 1070;
}