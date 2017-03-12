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
  add_meta_box( 'seo_setting_in_page','SEO設定', 'view_seo_custom_box', 'post', 'normal', 'high' );
  add_meta_box( 'seo_setting_in_page','SEO設定', 'view_seo_custom_box', 'page', 'normal', 'high' );
  add_meta_box( 'seo_setting_in_page','SEO設定', 'view_seo_custom_box', 'topic', 'normal', 'high' );
  //ページ設定
  add_meta_box( 'page_setting_in_page','ページ設定', 'view_page_custom_box', 'post', 'side' );
  add_meta_box( 'page_setting_in_page','ページ設定', 'view_page_custom_box', 'page', 'side' );
  add_meta_box( 'page_setting_in_page','ページ設定', 'view_page_custom_box', 'topic', 'side' );
  if (is_amp_enable()) {
    //AMP設定
    add_meta_box( 'amp_setting_in_page','AMP設定', 'view_amp_custom_box', 'post', 'side' );
  }

  //更新タイプ
  add_meta_box( 'update_type_setting_in_page', '更新日の変更', 'view_update_type_custom_box', 'post', 'side' );
  add_meta_box( 'update_type_setting_in_page', '更新日の変更', 'view_update_type_custom_box', 'page', 'side' );
  //add_meta_box( 'update_type_setting_in_page', '更新日の変更', 'view_update_type_custom_box', 'custom_post_type', 'side' );

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

  $seo_title = get_post_meta(get_the_ID(),'seo_title', true);
  $seo_title = htmlspecialchars($seo_title);
  $meta_description = get_post_meta(get_the_ID(),'meta_description', true);
  $meta_description = htmlspecialchars($meta_description);
  $meta_keywords = get_post_meta(get_the_ID(),'meta_keywords', true);
  $meta_keywords = htmlspecialchars($meta_keywords);
  $is_noindex = get_post_meta(get_the_ID(),'is_noindex', true);
  $is_nofollow = get_post_meta(get_the_ID(),'is_nofollow', true);

  //タイトル
  echo '<label style="font-weight:bold;margin-bottom:5px;">SEOタイトル</label>';
  echo '<input type="text" style="width:100%" placeholder="タイトルを入力してください。" name="seo_title" value="'.$seo_title.'" />';
  echo '<p class="howto" style="margin-top:0;">検索エンジンに表示させたいタイトルを入力してください。記事のタイトルより、こちらに入力したテキストが優先的にタイトルタグ(&lt;title&gt;)に挿入されます。一般的に日本語の場合は、32文字以内が最適とされています。（※ページやインデックスの見出し部分には「記事のタイトル」が利用されます）</p>';


  //メタディスクリプション
  echo '<label style="font-weight:bold;margin-bottom:5px;">メタディスクリプション</label>';
  echo '<textarea style="width:100%" placeholder="記事の説明文を入力してください。" name="meta_description" rows="3">'.$meta_description.'</textarea>';
  echo '<p class="howto" style="margin-top:0;">記事の説明を入力してください。日本語では、およそ120文字前後の入力をおすすめします。スマホではそのうちの約50文字が表示されます。こちらに入力したメタディスクリプションはブログカードのスニペット（抜粋文部分）にも利用されます。こちらに入力しない場合は、「抜粋」に入力したものがメタディスクリプションとして挿入されます。</p>';

  //メタキーワード
  echo '<label style="font-weight:bold;margin-bottom:5px;">メタキーワード</label>';
  echo '<input type="text" style="width:100%" placeholder="記事の関連キーワードを半角カンマ区切りで入力してください。" name="meta_keywords" value="'.$meta_keywords.'" />';
  echo '<p class="howto" style="margin-top:0;">記事に関連するキーワードを,（カンマ）区切りで入力してください。入力しない場合は、カテゴリ名などから自動で設定されます。</p>';

  //noindex
  echo '<label><input type="checkbox" name="is_noindex"';
  if( $is_noindex ){echo " checked";}
  echo '>インデックスしない（noindex）</label>';
  echo '<p class="howto" style="margin-top:0;">このページが検索エンジンにインデックスされないようにメタタグを設定します。</p>';

  //nofollow
  echo '<label><input type="checkbox" name="is_nofollow"';
  if( $is_nofollow ){echo " checked";}
  echo '>リンクをフォローしない（nofollow）</label>';
  echo '<p class="howto" style="margin-top:0;">検索エンジンがこのページ上のリンクをフォローしないようにメタタグを設定します。</p>';

  //SEO設定ページへのリンク
  echo '<p><a href="https://wp-simplicity.com/singular-seo-settings/" target="_blank">SEO項目の設定方法</a></p>';
}

add_action('save_post', 'save_seo_custom_data');
function save_seo_custom_data(){
  $id = get_the_ID();
  //タイトル
  $seo_title = null;
  if ( isset( $_POST['seo_title'] ) )
    $seo_title = $_POST['seo_title'];
  $seo_title_key = 'seo_title';
  add_post_meta($id, $seo_title_key, $seo_title, true);
  update_post_meta($id, $seo_title_key, $seo_title);
  //メタディスクリプション
  $meta_description = null;
  if ( isset( $_POST['meta_description'] ) )
    $meta_description = $_POST['meta_description'];
  $meta_description_key = 'meta_description';
  add_post_meta($id, $meta_description_key, $meta_description, true);
  update_post_meta($id, $meta_description_key, $meta_description);
  //メタキーワード
  $meta_keywords = null;
  if ( isset( $_POST['meta_keywords'] ) )
    $meta_keywords = $_POST['meta_keywords'];
  $meta_keywords_key = 'meta_keywords';
  add_post_meta($id, $meta_keywords_key, $meta_keywords, true);
  update_post_meta($id, $meta_keywords_key, $meta_keywords);
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


///////////////////////////////////////
// AMP設定
///////////////////////////////////////
function view_amp_custom_box(){
  global $post;

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
  echo '>AMPページを生成しない</label>';
  echo '<p class="howto" style="margin-top:0;">AMPページを生成せず、通常ページのみとします。アフィリエイトのコンバージョンページ、スクリプト動作が必要なページ等ではチェックすることをおすすめします。<a href="https://wp-simplicity.com/no-amp-page-settings/" target="_blank">機能説明</a></p>';

}

add_action('save_post', 'save_amp_custom_data');
function save_amp_custom_data(){
  $id = get_the_ID();

  //AMPを有効化するか
  $is_noamp = null;
  if ( isset( $_POST['is_noamp'] ) )
    $is_noamp = $_POST['is_noamp'];
  $is_noamp_key = 'is_noamp';
  add_post_meta($id, $is_noamp_key, $is_noamp, true);
  update_post_meta($id, $is_noamp_key, $is_noamp);
}


//投稿のAMPページが生成に設定されているか
function is_amp_single_page_enable(){
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
    echo ' />変更する</div><div style=""><input name="update_level" type="radio" value="low" ';
    if( $level=="low" ) echo ' checked="checked"';
    echo '/>変更しない<br /></div>';
    echo '<p class="howto" style="margin-top:1em;">更新日時を変更するかどうかを設定します。誤字修正などで更新日を変更したくない場合は「変更しない」にチェックを入れてください。</p>';
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