<?php //投稿・個別ページにカスタムフィールドを設置する

///////////////////////////////////////
// カスタムボックスの追加
///////////////////////////////////////
add_action('admin_menu', 'add_custom_boxes');
function add_custom_boxes(){
  //コメントボックス
  add_meta_box( 'comment_setting_in_page',__( 'コメントの設定', 'simplicity2' ), 'view_comment_custom_box', 'post', 'side' );
  //広告ボックス
  add_meta_box( 'ad_setting_in_page',__( '広告の設定', 'simplicity2' ), 'view_ad_custom_box', 'post', 'side' );
  add_meta_box( 'ad_setting_in_page',__( '広告の設定', 'simplicity2' ), 'view_ad_custom_box', 'page', 'side' );
  add_meta_box( 'ad_setting_in_page',__( '広告の設定', 'simplicity2' ), 'view_ad_custom_box', 'topic', 'side' );
  add_meta_box( 'ad_setting_in_page',__( '広告の設定', 'simplicity2' ), 'view_ad_custom_box', 'custom_post_type', 'side' );
  //SEOボックス
  add_meta_box( 'seo_setting_in_page',__( 'SEO設定', 'simplicity2' ), 'view_seo_custom_box', 'post', 'normal', 'high' );
  add_meta_box( 'seo_setting_in_page',__( 'SEO設定', 'simplicity2' ), 'view_seo_custom_box', 'page', 'normal', 'high' );
  add_meta_box( 'seo_setting_in_page',__( 'SEO設定', 'simplicity2' ), 'view_seo_custom_box', 'topic', 'normal', 'high' );
  add_meta_box( 'seo_setting_in_page',__( 'SEO設定', 'simplicity2' ), 'view_seo_custom_box', 'custom_post_type', 'normal', 'high' );
  //ページ設定
  add_meta_box( 'page_setting_in_page',__( 'ページ設定', 'simplicity2' ), 'view_page_custom_box', 'post', 'side' );
  add_meta_box( 'page_setting_in_page',__( 'ページ設定', 'simplicity2' ), 'view_page_custom_box', 'page', 'side' );
  add_meta_box( 'page_setting_in_page',__( 'ページ設定', 'simplicity2' ), 'view_page_custom_box', 'topic', 'side' );
  add_meta_box( 'page_setting_in_page',__( 'ページ設定', 'simplicity2' ), 'view_page_custom_box', 'custom_post_type', 'side' );
  if (is_amp_enable()) {
    //AMP設定
    add_meta_box( 'amp_setting_in_page',__( 'AMP設定', 'simplicity2' ), 'view_amp_custom_box', 'post', 'side' );
    add_meta_box( 'amp_setting_in_page',__( 'AMP設定', 'simplicity2' ), 'view_amp_custom_box', 'page', 'side' );
  }

  //更新タイプ
  add_meta_box( 'update_type_setting_in_page', __( '更新日の変更', 'simplicity2' ), 'view_update_type_custom_box', 'post', 'side' );
  add_meta_box( 'update_type_setting_in_page', __( '更新日の変更', 'simplicity2' ), 'view_update_type_custom_box', 'page', 'side' );
  //add_meta_box( 'update_type_setting_in_page', __( '更新日の変更', 'simplicity2' ), 'view_update_type_custom_box', 'custom_post_type', 'side' );

}

///////////////////////////////////////
// コメント設定
///////////////////////////////////////
function view_comment_custom_box(){
  $is_comment_form_freeze = get_post_meta(get_the_ID(),'is_comment_form_freeze', true);
  $comment_form_freeze_message = get_post_meta(get_the_ID(),'comment_form_freeze_message', true);

  echo '<label><input type="checkbox" name="is_comment_form_freeze"';
  if( $is_comment_form_freeze ){echo " checked";}
  echo '>'.__( 'コメントの凍結', 'simplicity2' ).'</label>';
  echo '<p class="howto">'.__( 'コメントフォームを非表示にし以降は書き込めないようにします。', 'simplicity2' ).'</p>';

  echo '<label>'.__( '凍結時のメッセージ', 'simplicity2' ).'</label>';
  echo '<input type="text" name="comment_form_freeze_message"';
  if( $comment_form_freeze_message ){echo ' value="'.$comment_form_freeze_message.'"';}
  echo ' style="width: 100%">';
  echo '<p class="howto">'.__( 'コメント凍結時に表示するメッセージです。未入力の場合はデフォルトのものが表示されます。', 'simplicity2' ).'</p>';
}

add_action('save_post', 'save_comment_custom_data');
function save_comment_custom_data(){
  $id = get_the_ID();
  //コメント凍結
  $is_comment_form_freeze = null;
  if ( isset( $_POST['is_comment_form_freeze'] ) ){
    $is_comment_form_freeze = $_POST['is_comment_form_freeze'];
  }
  $is_comment_form_freeze_key = 'is_comment_form_freeze';
  add_post_meta($id, $is_comment_form_freeze_key, $is_comment_form_freeze, true);
  update_post_meta($id, $is_comment_form_freeze_key, $is_comment_form_freeze);
  //コメント凍結メッセージ
  if ( isset( $_POST['comment_form_freeze_message'] ) ){
    $comment_form_freeze_message = $_POST['comment_form_freeze_message'];
    $comment_form_freeze_message_key = 'comment_form_freeze_message';
    add_post_meta($id, $comment_form_freeze_message_key, $comment_form_freeze_message, true);
    update_post_meta($id, $comment_form_freeze_message_key, $comment_form_freeze_message);
  }
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
  $is_ads_removed_in_page = get_post_meta(get_the_ID(),'is_ads_removed_in_page', true);

  echo '<label><input type="checkbox" name="is_ads_removed_in_page"';
  if( $is_ads_removed_in_page ){echo " checked";}
  echo '>'.__( '広告の除外', 'simplicity2' ).'</label>';
  echo '<p class="howto">'.__( 'ページ上の広告（AdSenseなど）をページ上から取り除きます。テーマカスタマイザーの「広告」項目からカテゴリごとの設定も行えます。', 'simplicity2' ).'</p>';
}

add_action('save_post', 'save_ad_custom_data');
function save_ad_custom_data(){
  $id = get_the_ID();
  //広告の除外
  $is_ads_removed_in_page = null;
  if ( isset( $_POST['is_ads_removed_in_page'] ) ){
    $is_ads_removed_in_page = $_POST['is_ads_removed_in_page'];
  }
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
//SEO設定の文字カウント
if ( !function_exists( 'seo_settings_admin_script' ) ):
function seo_settings_admin_script() {?>
<script type="text/javascript">
jQuery(document).ready(function($){
  //in_selの文字数をカウントしてout_selに出力する
  function count_characters(in_sel, out_sel) {
    var val = $(in_sel).val();
    if ( val ) {
      $(out_sel).html(val.length);
    }
  }
  //SEOタイトルの文字数取得
  $("#seo-title").bind("keydown keyup keypress change",function(){
    count_characters("#seo-title", ".seo-title-count");
  });
  count_characters("#seo-title", ".seo-title-count");

  //SEOメタディスクリプションの文字数取得
  $("#meta-description").bind("keydown keyup keypress change",function(){
    count_characters("#meta-description", ".meta-description-count");
  });
  count_characters("#meta-description", ".meta-description-count");

  //Wordpressタイトルの文字数
  $('#titlewrap').after('<div style="position:absolute;top:-23px;right:0;color:#666;background-color:#f7f7f7;padding:1px 2px;border-radius:5px;border:1px solid #ccc;"><?php _e( '文字数', 'simplicity2' ); ?>:<span class="wp-title-count" style="margin-left:5px;">0</span></div>');
  $('#title').bind("keydown keyup keypress change",function(){
    count_characters('#title', '.wp-title-count');
  });
  count_characters('#title', '.wp-title-count');
});
</script><?php
}
endif;
add_action( 'admin_head-post-new.php', 'seo_settings_admin_script' );
add_action( 'admin_head-post.php', 'seo_settings_admin_script' );
add_action( 'admin_head-page-new.php', 'seo_settings_admin_script' );
add_action( 'admin_head-page.php', 'seo_settings_admin_script' );
add_action( 'admin_head-topic-new.php', 'seo_settings_admin_script' );
add_action( 'admin_head-topic.php', 'seo_settings_admin_script' );
add_action( 'admin_head-custom-post-type-new.php', 'seo_settings_admin_script' );
add_action( 'admin_head-custom-post-type.php', 'seo_settings_admin_script' );
//add_action('admin_print_scripts', 'seo_settings_admin_script');

function view_seo_custom_box(){
  $seo_title = get_post_meta(get_the_ID(),'seo_title', true);
  $seo_title = htmlspecialchars($seo_title);
  $meta_description = get_post_meta(get_the_ID(),'meta_description', true);
  $meta_description = htmlspecialchars($meta_description);
  $meta_keywords = get_post_meta(get_the_ID(),'meta_keywords', true);
  $meta_keywords = htmlspecialchars($meta_keywords);
  $is_noindex = get_post_meta(get_the_ID(),'is_noindex', true);
  $is_nofollow = get_post_meta(get_the_ID(),'is_nofollow', true);

  //タイトル
  echo '<label style="font-weight:bold;margin-bottom:5px;">'.__( 'SEOタイトル', 'simplicity2' ).'<span style="margin-left:10px;background-color:#f7f7f7;padding:1px 2px;border-radius:5px;border:1px solid #ccc;font-weight:normal;">'.__( '文字数', 'simplicity2' ).':<span class="seo-title-count" style="margin-left:5px;">0</span></span></label>';
  echo '<input id="seo-title" type="text" style="width:100%" placeholder="'.__( 'タイトルを入力してください。', 'simplicity2' ).'" name="seo_title" value="'.$seo_title.'" />';
  echo '<p class="howto" style="margin-top:0;">'.__( '検索エンジンに表示させたいタイトルを入力してください。記事のタイトルより、こちらに入力したテキストが優先的にタイトルタグ(&lt;title&gt;)に挿入されます。一般的に日本語の場合は、32文字以内が最適とされています。（※ページやインデックスの見出し部分には「記事のタイトル」が利用されます）', 'simplicity2' ).'</p>';


  //メタディスクリプション
  echo '<label style="font-weight:bold;margin-bottom:5px;">'.__( 'メタディスクリプション', 'simplicity2' ).'<span style="margin-left:10px;background-color:#f7f7f7;padding:1px 2px;border-radius:5px;border:1px solid #ccc;font-weight:normal;">'.__( '文字数', 'simplicity2' ).':<span class="meta-description-count" style="margin-left:5px;">0</span></span></label>';
  echo '<textarea id="meta-description" style="width:100%" placeholder="'.__( '記事の説明文を入力してください。', 'simplicity2' ).'" name="meta_description" rows="3">'.$meta_description.'</textarea>';
  echo '<p class="howto" style="margin-top:0;">'.__( '記事の説明を入力してください。日本語では、およそ120文字前後の入力をおすすめします。スマホではそのうちの約50文字が表示されます。こちらに入力したメタディスクリプションはブログカードのスニペット（抜粋文部分）にも利用されます。こちらに入力しない場合は、「抜粋」に入力したものがメタディスクリプションとして挿入されます。', 'simplicity2' ).'</p>';

  //メタキーワード
  echo '<label style="font-weight:bold;margin-bottom:5px;">'.__( 'メタキーワード', 'simplicity2' ).'</label>';
  echo '<input type="text" style="width:100%" placeholder="'.__( '記事の関連キーワードを半角カンマ区切りで入力してください。', 'simplicity2' ).'" name="meta_keywords" value="'.$meta_keywords.'" />';
  echo '<p class="howto" style="margin-top:0;">'.__( '記事に関連するキーワードを,（カンマ）区切りで入力してください。入力しない場合は、カテゴリ名などから自動で設定されます。', 'simplicity2' ).'</p>';

  //noindex
  echo '<label><input type="checkbox" name="is_noindex"';
  if( $is_noindex ){echo " checked";}
  echo '>'.__( 'インデックスしない（noindex）', 'simplicity2' ).'</label>';
  echo '<p class="howto" style="margin-top:0;">'.__( 'このページが検索エンジンにインデックスされないようにメタタグを設定します。', 'simplicity2' ).'</p>';

  //nofollow
  echo '<label><input type="checkbox" name="is_nofollow"';
  if( $is_nofollow ){echo " checked";}
  echo '>'.__( 'リンクをフォローしない（nofollow）', 'simplicity2' ).'</label>';
  echo '<p class="howto" style="margin-top:0;">'.__( '検索エンジンがこのページ上のリンクをフォローしないようにメタタグを設定します。', 'simplicity2' ).'</p>';

  //SEO設定ページへのリンク
  echo '<p><a href="https://wp-simplicity.com/singular-seo-settings/" target="_blank">'.__( 'SEO項目の設定方法', 'simplicity2' ).'</a></p>';
}

add_action('save_post', 'save_seo_custom_data');
function save_seo_custom_data(){
  $id = get_the_ID();
  //タイトル
  $seo_title = null;
  if ( isset( $_POST['seo_title'] ) ){
    $seo_title = $_POST['seo_title'];
    $seo_title_key = 'seo_title';
    add_post_meta($id, $seo_title_key, $seo_title, true);
    update_post_meta($id, $seo_title_key, $seo_title);
  }
  //メタディスクリプション
  $meta_description = null;
  if ( isset( $_POST['meta_description'] ) ){
    $meta_description = $_POST['meta_description'];
    $meta_description_key = 'meta_description';
    add_post_meta($id, $meta_description_key, $meta_description, true);
    update_post_meta($id, $meta_description_key, $meta_description);
  }
  //メタキーワード
  $meta_keywords = null;
  if ( isset( $_POST['meta_keywords'] ) ){
    $meta_keywords = $_POST['meta_keywords'];
    $meta_keywords_key = 'meta_keywords';
    add_post_meta($id, $meta_keywords_key, $meta_keywords, true);
    update_post_meta($id, $meta_keywords_key, $meta_keywords);
  }
  //noindex
  $is_noindex = null;
  if ( isset( $_POST['is_noindex'] ) ){
    $is_noindex = $_POST['is_noindex'];
  }
  $is_noindex_key = 'is_noindex';
  add_post_meta($id, $is_noindex_key, $is_noindex, true);
  update_post_meta($id, $is_noindex_key, $is_noindex);

  //nofollow
  $is_nofollow = null;
  if ( isset( $_POST['is_nofollow'] ) ){
    $is_nofollow = $_POST['is_nofollow'];
  }
  $is_nofollow_key = 'is_nofollow';
  add_post_meta($id, $is_nofollow_key, $is_nofollow, true);
  update_post_meta($id, $is_nofollow_key, $is_nofollow);
}

//SEO向けのタイトルを取得
function get_seo_title_singular_page(){
  return trim(get_post_meta(get_the_ID(), 'seo_title', true));
}

//メタディスクリプションを取得
function get_meta_description_singular_page(){
  return trim(get_post_meta(get_the_ID(), 'meta_description', true));
}

//メタディスクリプションを取得
function get_meta_description_blogcard_snippet($id){
  return trim(get_post_meta($id, 'meta_description', true));
}

//メタキーワードを取得
function get_meta_keywords_singular_page(){
  return trim(strip_tags(get_post_meta(get_the_ID(), 'meta_keywords', true)));
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
  $page_type = get_post_meta(get_the_ID(),'page_type', true);

  //ページタイプ
  echo '<label>'.__( 'ページタイプ', 'simplicity2' ).'</label><br>';
  echo '<select name="page_type">';
  //デフォルト
  echo '<option value="default"';
  if( $page_type == 'default' ){echo ' selected';}
  echo '>'.__( 'デフォルト', 'simplicity2' ).'</option>';
  //1カラム（狭い）
  echo '<option value="column1_narrow"';
  if( $page_type == 'column1_narrow' ){echo ' selected';}
  echo '>'.__( '1カラム（狭い）', 'simplicity2' ).'</option>';
  //1カラム（広い）
  echo '<option value="column1_wide"';
  if( $page_type == 'column1_wide' ){echo ' selected';}
  echo '>'.__( '1カラム（広い）', 'simplicity2' ).'</option>';
  //本文のみ（狭い）
  echo '<option value="content_only_narrow"';
  if( $page_type == 'content_only_narrow' ){echo ' selected';}
  echo '>'.__( '本文のみ（狭い）', 'simplicity2' ).'</option>';
  //本文のみ（広い）
  echo '<option value="content_only_wide"';
  if( $page_type == 'content_only_wide' ){echo ' selected';}
  echo '>'.__( '本文のみ（広い）', 'simplicity2' ).'</option>';
  echo '</select>';
  echo '<p class="howto">'.__( 'このページの表示状態を設定します。「本文のみ」表示はランディングページ（LP）などにどうぞ。', 'simplicity2' ).'</p>';

}

add_action('save_post', 'save_page_custom_data');
function save_page_custom_data(){
  $id = get_the_ID();
  //ページタイプ
  if ( isset( $_POST['page_type'] ) ){
    $page_type = $_POST['page_type'];
    $page_type_key = 'page_type';
    add_post_meta($id, $page_type_key, $page_type, true);
    update_post_meta($id, $page_type_key, $page_type);
  }
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


///////////////////////////////////////
// AMP設定
///////////////////////////////////////
function view_amp_custom_box(){
  //$is_noamp = '';
  $is_noamp = get_post_meta(get_the_ID(),'is_noamp', true);
  // //初期値が空文字のとき「AMPを有効にする」のデフォルト値をonにする（無効にする場合のnullの場合は何もしない）
  // if ($is_noamp === '') {
  //   $is_noamp = 'on';
  // }
  //var_dump($is_noamp);

  //AMP
  echo '<label><input type="checkbox" name="is_noamp"';
  if( $is_noamp ){echo " checked";}
  echo '>'.__( 'AMPページを生成しない', 'simplicity2' ).'</label>';
  echo '<p class="howto" style="margin-top:0;">'.__( 'AMPページを生成せず、通常ページのみとします。アフィリエイトのコンバージョンページ、スクリプト動作が必要なページ等ではチェックすることをおすすめします。<a href="https://wp-simplicity.com/no-amp-page-settings/" target="_blank">機能説明</a>', 'simplicity2' ).'</p>';

}

add_action('save_post', 'save_amp_custom_data');
function save_amp_custom_data(){
  $id = get_the_ID();

  //AMPを有効化するか
  $is_noamp = null;
  if ( isset( $_POST['is_noamp'] ) ){
    $is_noamp = $_POST['is_noamp'];
  }
  $is_noamp_key = 'is_noamp';
  add_post_meta($id, $is_noamp_key, $is_noamp, true);
  update_post_meta($id, $is_noamp_key, $is_noamp);
}


//投稿のAMPページが生成に設定されているか
function is_amp_page_enable(){
  return !get_post_meta(get_the_ID(), 'is_noamp', true);
}

/*管理画面が開いたときに実行*/
//add_action( 'admin_menu', 'add_update_level_custom_box' );

/* カスタムフィールドを投稿画面に追加 */
// function add_update_level_custom_box() {
//     //ページ編集画面にカスタムメタボックスを追加
//     add_meta_box( 'update_level', '更新レベル', 'html_update_level_custom_box', 'post', 'side', 'high' );
//}

/* 投稿画面に表示するフォームのHTMLソース */
function view_update_type_custom_box() {
    $the_post = isset($_GET['post']) ? $_GET['post'] : null;
    $update_level = get_post_meta( $the_post, 'update_level' );
    $level = $update_level ? $update_level[0] : null;
    echo '<div style="padding-top: 3px; overflow: hidden;">';
    echo '<div style="width: 100px; float: left;"><input name="update_level" type="radio" value="high" ';
    if( $level=="" || $level=="high" ) echo ' checked="checked"';
    echo ' />'.__( '変更する', 'simplicity2' ).'</div><div style=""><input name="update_level" type="radio" value="low" ';
    if( $level=="low" ) echo ' checked="checked"';
    echo '/>'.__( '変更しない', 'simplicity2' ).'<br /></div>';
    echo '<p class="howto" style="margin-top:1em;">'.__( '更新日時を変更するかどうかを設定します。誤字修正などで更新日を変更したくない場合は「変更しない」にチェックを入れてください。', 'simplicity2' ).'</p>';
    echo '</div>';
}


/*更新ボタンが押されたときに実行*/
add_action( 'save_post', 'save_update_type_custom_data' );
/* 設定したカスタムフィールドの値をDBに書き込む記述 */
function save_update_type_custom_data( $post_id ) {
    $mydata = isset($_POST['update_level']) ? $_POST['update_level'] : null;
    if( "" == get_post_meta( $post_id, 'update_level' )) {
        /* update_levelというキーでデータが保存されていなかった場合、新しく保存 */
        add_post_meta( $post_id, 'update_level', $mydata, true ) ;
    } elseif( $mydata != get_post_meta( $post_id, 'update_level' )) {
        /* update_levelというキーのデータと、現在のデータが不一致の場合、更新 */
        update_post_meta( $post_id, 'update_level', $mydata ) ;
    } elseif( "" == $mydata ) {
        /* 現在のデータが無い場合、update_levelというキーの値を削除 */
        delete_post_meta( $post_id, 'update_level' ) ;
    }
}

/* 「更新」以外は更新日時を変更しない */
function simplicity_insert_post_data( $data, $postarr ){
  //$update_level = $_POST ? $_POST['update_level'] : null;
  $mydata = isset($_POST['update_level']) ? $_POST['update_level'] : null;
  if( $mydata == "low" ){
    unset( $data["post_modified"] );
    unset( $data["post_modified_gmt"] );
  }
  return $data;
}
add_filter( 'wp_insert_post_data', 'simplicity_insert_post_data', 10, 2 );