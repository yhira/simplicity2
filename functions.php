<?php
require_once(ABSPATH . 'wp-admin/includes/file.php');//WP_Filesystemの使用
//-----------------------------------
//Wordpressマルチ言語化の設定
global $locale;
//言語の最初の文字がenだったら全てen.moを呼び出す
//if (preg_match('/en/', $locale)) {
if (strpos($locale,'en') !== false) {
  $locale = 'en';
}
//Simplicityの多言語化
load_theme_textdomain( 'simplicity2', get_template_directory() . '/languages' );
//-----------------------------------
include 'lib/php-html-css-js-minifier.php'; //縮小化ライブラリ
include 'lib/customizer.php';//テーマカスタマイザー関係の関数
include 'lib/amp.php';       //AMP関係の関数
include 'lib/ad.php';        //広告関係の関数
include 'lib/sns.php';       //SNS関係の関数
include 'lib/admin.php';     //管理画面用の関数
include 'lib/utility.php';   //自作のユーティリティー関数
include 'lib/punycode.php';  //Punycode関係の関数
include 'lib/widget.php';    //ウイジェット関係の関数
include 'lib/widget-areas.php';//ウイジェットエリア関係の関数
include 'lib/custom-field.php';//カスタムフィールド関係の関数
include 'lib/auto-post-thumbnail.php'; //アイキャッチ自動設定関数
//include 'lib/external-link.php'; //外部リンク関係の関数
include 'lib/blog-card.php'; //ブログカード関係の関数
include 'lib/seo.php';       //SEO関係の関数
include 'lib/mobile.php';    //モバイル関係の関数
include 'lib/image.php';     //画像関係の関数
include 'lib/comment.php';   //コメント関係の関数
include 'lib/scripts.php';   //スクリプト関係の関数
include 'lib/speed-up.php';   //高速化関係の関数
include 'lib/qtags.php';     //クイックタグ関係の関数
//CFilteringプラグインとの連携
if ( version_compare( phpversion(), '5.3', '>=' ) ) {
  require_once 'lib/cfiltering.php';
}

//URLの正規表現
define('URL_REG', '/(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)/');

// アイキャッチ画像を有効化
add_theme_support('post-thumbnails');
//サムネイルサイズ
add_image_size('thumb100', 100, 100, true);
add_image_size('thumb150', 150, 150, true);
add_image_size('thumb320', 320, 180, true);
add_image_size('thumb320_raw', 320, 0, false);

//コンテンツの幅の指定
if ( ! isset( $content_width ) ) $content_width = 680;

//カテゴリー説明文でHTMLタグを使う
remove_filter( 'pre_term_description', 'wp_filter_kses' );

//ビジュアルエディターとテーマ表示のスタイルを合わせる
add_editor_style();

// RSS2 の feed リンクを出力
add_theme_support( 'automatic-feed-links' );

// カスタムメニューを有効化
add_theme_support( 'menus' );

// カスタムメニューの「場所」を設定
//register_nav_menu( 'header-navi', 'ヘッダーナビゲーション' );
register_nav_menus(
  array(
    'header-navi' => 'ヘッダーナビ',
    'footer-navi' => 'フッターナビ（サブメニュー不可）',
  )
);

//固定ページに抜粋を追加
add_post_type_support( 'page', 'excerpt' );

//カスタムヘッダー
add_theme_support( 'custom-header', $custom_header_defaults );

//テキストウィジェットでショートコードを使用する
add_filter('widget_text', 'do_shortcode');
add_filter('widget_text_pc_text', 'do_shortcode');
add_filter('widget_text_mobile_text', 'do_shortcode');
add_filter('widget_mobile_ad_text', 'do_shortcode');
add_filter('widget_classic_text', 'do_shortcode');
add_filter('widget_pc_ad_text', 'do_shortcode');
add_filter('widget_pc_double_ad1_text', 'do_shortcode');
add_filter('widget_pc_double_ad2_text', 'do_shortcode');

//generator を削除
remove_action('wp_head', 'wp_generator');
//EditURI を削除
remove_action('wp_head', 'rsd_link');
//wlwmanifest を削除
remove_action('wp_head', 'wlwmanifest_link');

//カスタム背景
$custom_background_defaults = array(
        'default-color' => 'ffffff',
);
add_theme_support( 'custom-background', $custom_background_defaults );

//ヘッダーに以下のようなタグが挿入されるWP4.4からの機能を解除
//<link rel='https://api.w.org/' href='http:/xxxx/wordpress/wp-json/' />
remove_action( 'wp_head', 'rest_output_link_wp_head' );


// // Webサイト全体の画像をResponsive images機能の対象から外す
// add_filter( 'wp_calculate_image_srcset', '__return_false' );

// //カスタマイズした値をCSSに反映させる
// function simplicity_customize_css(){
//   if ( is_external_custom_css_enable() && //カスタムCSSを外部ファイルに書き込む時
//        css_custum_to_css_file() ) {//外部ファイルに書き出しがうまくいったとき
//     echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/css/css-custom.css">';
//     //wp_enqueue_style( 'css-custom', get_template_directory_uri().'/css/css-custom.css' );
//   } else {//ヘッダーに埋め込む時
//     get_template_part('css-custom');
//   }
// }
// add_action( 'wp_head', 'simplicity_customize_css');

/*
  get_the_modified_time()の結果がget_the_time()より古い場合はget_the_time()を返す。
  同じ場合はnullをかえす。
  それ以外はget_the_modified_time()をかえす。
*/
function get_mtime($format) {
  $mtime = get_the_modified_time('Ymd');
  $ptime = get_the_time('Ymd');
  if ($ptime > $mtime) {
    return get_the_time($format);
  } elseif ($ptime === $mtime) {
    return null;
  } else {
    return get_the_modified_time($format);
  }
}

// 抜粋の長さを変更する
function custom_excerpt_length() {
  return intval(get_excerpt_length());
}
add_filter('excerpt_length', 'custom_excerpt_length');

// 文末文字を変更する
function custom_excerpt_more($more) {
  return get_excerpt_more();
}
add_filter('excerpt_more', 'custom_excerpt_more');

//本文抜粋を取得する関数
//使用方法：http://nelog.jp/get_the_custom_excerpt
if ( !function_exists( 'get_the_custom_excerpt' ) ):
function get_the_custom_excerpt($content, $length = 70, $is_card = false) {
  global $post;
  //「抜粋」を取得
  $description = $post->post_excerpt;
  //SEO設定のディスクリプション取得
  if (!$description) {
    $description = get_meta_description_blogcard_snippet($post->ID);
  }
  //SEO設定のディスクリプションがない場合は「All in One SEO Packの値」を取得
  if (!$description) {
    if (class_exists( 'All_in_One_SEO_Pack' )) {
      $aioseop_description = get_post_meta($post->ID, '_aioseop_description', true);
      if ($aioseop_description) {
        $description = $aioseop_description;
      }
    }
  }
  if (is_wordpress_excerpt() && $description ) {//Wordpress固有の抜粋文を使用するとき
    $description = htmlspecialchars($description);
    return  $description;
  } else {//Simplicity固有の抜粋文を使用するとき
    return get_content_excerpt($content, $length);
  }
}
endif;

//本文部分の冒頭を綺麗に抜粋する
if ( !function_exists( 'get_content_excerpt' ) ):
function get_content_excerpt($content, $length = 70){
  $content =  preg_replace('/<!--more-->.+/is', '', $content); //moreタグ以降削除
  $content =  strip_shortcodes($content);//ショートコード削除
  $content =  strip_tags($content);//タグの除去
  $content =  str_replace('&nbsp;', '', $content);//特殊文字の削除（今回はスペースのみ）
  $content =  preg_replace('/\[.+?\]/i', '', $content); //ショートコードを取り除く
  $content =  preg_replace(URL_REG, '', $content); //URLを取り除く
  // $content =  preg_replace('/\s/iu',"",$content); //余分な空白を削除
  $over    =  intval(mb_strlen($content)) > intval($length);
  $content =  mb_substr($content, 0, $length);//文字列を指定した長さで切り取る
  if ( get_excerpt_more() && $over ) {
    $content = $content.get_excerpt_more();
  }
  return $content;
}
endif;


//CSS、JSファイルに編集時間をバージョンとして付加する（ファイル編集後のブラウザキャッシュ対策）
if ( !function_exists( 'add_file_ver_to_css_js' ) ):
function add_file_ver_to_css_js( $src ) {
  //サーバー内のファイルの場合
  if (includes_site_url($src)) {
    //Wordpressのバージョンを除去する場合
    // if ( strpos( $src, 'ver=' ) )
    //   $src = remove_query_arg( 'ver', $src );
    //クエリーを削除したファイルURLを取得
    $removed_src = preg_replace('{\?.*}i', '', $src);
    //URLをパスに変換
    $stylesheet_file = url_to_local( $removed_src );
    if (file_exists($stylesheet_file)) {
      //ファイルの編集時間バージョンを追加
      $src = add_query_arg( 'fver', date('Ymdhis', filemtime($stylesheet_file)), $src );
    }
  }
  return $src;
}
endif;
add_filter( 'style_loader_src', 'add_file_ver_to_css_js', 9999 );
add_filter( 'script_loader_src', 'add_file_ver_to_css_js', 9999 );


// //外部ファイルのURLに付加されるver=を取り除く
// if ( !function_exists( 'add_file_ver_to_css_js' ) ):
// function add_file_ver_to_css_js( $src ) {
//   // _v($src);
//   // _v(site_url());
//   // _v(strpos( $src, site_url() ));
//   //サーバー内のファイルの場合
//   if (strpos( $src, site_url() ) !== false) {
//     //Wordpressのバージョンを除去する場合
//     // if ( strpos( $src, 'ver=' ) )
//     //   $src = remove_query_arg( 'ver', $src );
//     //クエリーを削除したファイルURLを取得
//     $removed_src = preg_replace('{\?.+$}i', '', $src);
//     //URLをパスに変換
//     $stylesheet_file = str_replace(site_url('/'), ABSPATH, $removed_src );
//     //ファイルの編集時間バージョンを追加
//     $src = add_query_arg( 'fver', date('Ymdhis', filemtime($stylesheet_file)), $src );
//   }
//   return $src;
// }
// endif;
// add_filter( 'style_loader_src', 'add_file_ver_to_css_js', 9999 );
// add_filter( 'script_loader_src', 'add_file_ver_to_css_js', 9999 );

//セルフピンバック禁止
function sp_no_self_ping( &$links ) {
    $home = home_url();
    foreach ( $links as $l => $link )
        if ( 0 === strpos( $link, $home ) )
            unset($links[$l]);
}
add_action( 'pre_ping', 'sp_no_self_ping' );

//ファビコンタグを表示
function the_favicon_tag(){
  if (is_favicon_enable()) {
    echo '<link rel="shortcut icon" type="image/x-icon" href="'.get_the_favicon_url().'" />'."\n";
  }
}

//アップルタッチアイコンを表示
function the_apple_touch_icon_tag(){
  if ( is_apple_touch_icon_enable() && is_mobile() ) {
    if ( get_apple_touch_icon_url() ) {
      echo '<link rel="apple-touch-icon-precomposed" href="'.get_apple_touch_icon_url().'" />'."\n";
    } else {
      echo '<link rel="apple-touch-icon-precomposed" href="'.get_stylesheet_directory_uri().'/images/apple-touch-icon.png" />'."\n";
    }
  }
}

//ファビコン表示(フロント)
function blog_favicon() {
  the_favicon_tag();
}
add_action('wp_head', 'blog_favicon');

//ファビコン表示(管理画面)
function admin_favicon() {
  the_favicon_tag();
}
add_action('admin_head', 'admin_favicon');

//iframeのレスポンシブ対応
if ( !function_exists( 'wrap_iframe_in_div' ) ):
function wrap_iframe_in_div($the_content) {
  if ( is_singular() ) {
    //YouTube動画にラッパーを装着
    $the_content = preg_replace('/<iframe[^>]+?youtube\.com[^<]+?<\/iframe>/is', '<div class="video-container"><div class="video">${0}</div></div>', $the_content);
    //Instagram動画にラッパーを装着
    $the_content = preg_replace('/<iframe[^>]+?instagram\.com[^<]+?<\/iframe>/is', '<div class="instagram-container"><div class="instagram">${0}</div></div>', $the_content);
    //Facebook埋め込みにラッパーを装着
    //$the_content = preg_replace('/<iframe[^>]+?www\.facebook\.com[^<]+?<\/iframe>/is', '<div class="facebook-container"><div class="facebook">${0}</div></div>', $the_content);
  }
  return $the_content;
}
endif;
add_filter('the_content','wrap_iframe_in_div');

//pixivの埋め込みの大きさ変換
if ( !function_exists( 'Simplicity_pixiv_embed_changer' ) ):
function Simplicity_pixiv_embed_changer($the_content){
  if ( is_mobile() && strstr($the_content, 'http://source.pixiv.net/source/embed.js') )  {
    $patterns = array();
    $patterns[0] = '/data-size="large"/';
    $patterns[1] = '/data-size="medium"/';
    //$patterns[2] = '/data-border="off"/';
    $replacements = array();
    $replacements[0] = 'data-size="small"';
    $replacements[1] = 'data-size="small"';
    //$replacements[2] = 'data-border="on"';
    $the_content = preg_replace($patterns, $replacements, $the_content);
  }
  elseif ( strstr($the_content, 'http://source.pixiv.net/source/embed.js') )  {
    // $patterns = array();
    // $patterns[0] = '/data-size="small"/';
    // $patterns[1] = '/data-size="medium"/';
    // //$patterns[2] = '/data-border="off"/';
    // $replacements = array();
    // $replacements[0] = 'data-size="large"';
    // $replacements[1] = 'data-size="large"';
    // //$replacements[2] = 'data-border="on"';
    // $the_content = preg_replace($patterns, $replacements, $the_content);
  }
  return $the_content;
}
endif;
add_filter('the_content','Simplicity_pixiv_embed_changer');

//サイト概要の取得
if ( !function_exists( 'get_the_description' ) ):
function get_the_description(){
  global $post;

  //抜粋を取得
  $desc = trim(strip_tags( $post->post_excerpt ));
  //投稿・固定ページにメタディスクリプションが設定してあれば取得
  if (get_meta_description_singular_page()) {
    $desc = get_meta_description_singular_page();
  }
  //SEO設定のディスクリプションがない場合は「All in One SEO Packの値」を取得
  if (!$desc) {
    if (class_exists( 'All_in_One_SEO_Pack' )) {
      $aioseop_description = get_post_meta($post->ID, '_aioseop_description', true);
      if ($aioseop_description) {
        $desc = $aioseop_description;
      }
    }
  }
  if ( !$desc ) {//投稿で抜粋が設定されていない場合は、110文字の冒頭の抽出分
    $desc = strip_shortcodes(get_the_custom_excerpt( $post->post_content, 150 ));
    $desc = mb_substr(str_replace(array("\r\n", "\r", "\n"), '', strip_tags($desc)), 0, 120);

  }
  $desc = htmlspecialchars($desc);
  return $desc;
}
endif;

//投稿・固定ページのメタキーワードの取得
if ( !function_exists( 'get_the_keywores' ) ):
function get_the_keywores(){
  global $post;
  $keywords = get_meta_keywords_singular_page();
  if (!$keywords) {
    $categories = get_the_category($post->ID);
    $category_names = array();
    foreach($categories as $category):
      array_push( $category_names, $category -> cat_name);
    endforeach ;
    $keywords = implode(',', $category_names);
  }
  return $keywords;
}
endif;

//最新記事の投稿IDを取得する
if ( !function_exists( 'get_the_latest_ID' ) ):
function get_the_latest_ID() {
  global $wpdb;
  $row = $wpdb->get_row("SELECT ID FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' ORDER BY post_date DESC");
  return !empty( $row ) ? $row->ID : 0;
}
endif;

//WordPress の投稿スラッグを自動的に生成する
if ( !function_exists( 'auto_post_slug' ) ):
function auto_post_slug( $slug, $post_ID, $post_status, $post_type ) {
  $type = utf8_uri_encode( $post_type );
  // if ( empty( $post_ID ) ){//IDがまだ指定されていないとき
  //   $slug = $type . '-' . strval(get_the_latest_ID() + 1); //最新記事のIDに＋1
  // } else
  if ( preg_match( '/(%[0-9a-f]{2})+/', $slug ) &&
     ( $post_type == 'post' || $post_type == 'page') ) {//投稿もしくは固定ページのときのみ実行する
    $slug = $type . '-' . $post_ID;
  }
  return $slug;
}
endif;
if ( !is_japanese_slug_enable()) {
  add_filter( 'wp_unique_post_slug', 'auto_post_slug', 10, 4  );
}
// header('Content-Type: text/plain; charset=utf-8');
// for ( $i = 0; $i < 3; $i++ ) { $my_post = array( 'post_title' => 'あいう', 'post_content' => "かきく + " . date( 'r' ), 'post_status' => 'publish', 'post_author' => 1, 'post_category' => array( 1 ) ); $my_post2 = $my_post; $my_post2['post_title'] = 'ABCDEFG'; $my_id = wp_insert_post( $my_post ); $my_id2 = wp_insert_post( $my_post2 ); $my_slug = get_post( $my_id )->post_name; $my_slug2 = get_post( $my_id2 )->post_name; echo "<div>id: $my_id = slug: $my_slug</div>"; echo "<div>id2: $my_id2 = slug2: $my_slug2</div>"; }

//投稿ページ以外ではhentryクラスを削除する関数
function remove_hentry( $classes ) {
  if ( !is_single() ) {
    $classes = array_diff($classes, array('hentry'));
  }
  //これらのクラスが含まれたページではhentryを削除する
  $ng_classes = array('type-forum', 'type-topic');//ここに追加していく
  $is_include = false;
  foreach ($ng_classes as $ng_class) {
    //NGのクラス名が含まれていないか調べる
    if ( in_array($ng_class, $classes) ) {
      $is_include = true;
    }
  }
  //含まれていたらhentryを削除する
  if ($is_include) {
    $classes = array_diff($classes, array('hentry'));
  }
  return $classes;
}
add_filter('post_class', 'remove_hentry');

//functions.phpが有るローカルパスを取得
function get_simplicity_local_dir(){
  return str_replace('\\','/', dirname(__FILE__));//置換しているのはWindows環境対策
}

//子テーマ内に指定のファイルがあるかどうか調べる
//ファイルがあった場合は子テーマ内ファイルのローカルパスを（true）
//ファイルが存在しなかった場合はfalseを返す
function file_exists_in_child_theme($filename){
  $dir = get_simplicity_local_dir();
  $theme_dir_uri = get_template_directory_uri();//親テーマのディレクトリURIを取得
  $child_theme_dir_uri = get_stylesheet_directory_uri();//子テーマのディレクトリURIの取得
  if ($theme_dir_uri == $child_theme_dir_uri) return;//同一の場合は子テーマが存在しないのでfalseを返す
  preg_match('/[^\/]+$/i', $theme_dir_uri, $m);//親テーマのディレクトリ名のみ取得
  $theme_dir_name = $m[0];
  preg_match('/[^\/]+$/i', $child_theme_dir_uri, $m);//子テーマのディレクトリ名のみ取得
  $child_theme_dir_name = $m[0];
  $path = preg_replace('/'.$theme_dir_name.'$/i', $child_theme_dir_name, $dir, 1);//文末のディレクトリ名だけ置換
  $path = $path.'/'.$filename;//ローカルパスの作成
  if ( file_exists($path) ) {
    return $path;//ファイルが存在していたらファイルのローカルパスを返す
  }
}

//スキンファイルリストの並べ替え用の関数
function skin_files_comp($a, $b) {
  $f1 = (float)$a['priority'];
  $f2 = (float)$b['priority'];
  //優先度（priority）で比較する
  if ($f1 == $f2) {
      return 0;
  }
  return ($f1 < $f2) ? -1 : 1;
}

//フォルダ以下のファイルをすべて取得
if ( !function_exists( 'get_file_list' ) ):
function get_file_list($dir) {
  $list = array();
  $files = scandir($dir);
  foreach($files as $file){
    if($file == '.' || $file == '..'){
      continue;
    } else if (is_file($dir . $file)){
      $list[] = $dir . $file;
    } else if( is_dir($dir . $file) ) {
        //$list[] = $dir;
      $list = array_merge($list, get_file_list($dir . $file . DIRECTORY_SEPARATOR));
    }
  }
  return $list;
}
endif;

//スキンとなるファイルの取得
if ( !function_exists( 'get_skin_files' ) ):
function get_skin_files(){
  define( 'FS_METHOD', 'direct' );

  $parent = true;
  // 子テーマで 親skins の取得有無の設定
  if(function_exists('include_parent_skins')){
    $parent = include_parent_skins();
  }

  $files  = array();
  $child_files  = array();
  $parent_files  = array();

  //子skinsフォルダ内を検索
  $dir = get_stylesheet_directory().'/skins/';
  if(is_child_theme() && file_exists($dir)){
    $child_files = get_file_list($dir);
  }

  //親skinsフォルダ内を検索
  if ( $parent || !is_child_theme() ){//排除フラグが立っていないときと親テーマのときは取得
    $dir = get_template_directory().'/skins/';
    $parent_files = get_file_list($dir);
  }

  //親テーマと子テーマのファイル配列をマージ
  $files = array_merge( $child_files, $parent_files );

  //置換DIR
  $this_dir = str_replace('\\', '/', dirname(__FILE__));
  $this_ary = explode('/', $this_dir);
  array_pop($this_ary);
  $search = implode ('/',$this_ary);

  //置換URI
  $uri_dir = get_template_directory_uri();
  $uri_ary = explode('/', $uri_dir);
  array_pop($uri_ary);
  $replace = implode ('/',$uri_ary);

  $results = array();
  foreach($files as $pathname){
    $pathname = str_replace('\\', '/', $pathname);

    if (preg_match('/([a-zA-Z0-9\-_]+).style\.css$/i', $pathname, $matches)){//フォルダ名の正規表現が[a-zA-Z\-_]+のとき
      $dir_name = strip_tags($matches[1]);
      if ( WP_Filesystem() ) {//WP_Filesystemの初期化
        global $wp_filesystem;//$wp_filesystemオブジェクトの呼び出し
        $css = $wp_filesystem->get_contents($pathname);//$wp_filesystemオブジェクトのメソッドとして呼び出す
        if (preg_match('/Name: *(.+)/i', $css, $matches)) {//CSSファイルの中にName:の記述があるとき
          if (preg_match('/Priority: *(.+)/i', $css, $m)) {//優先度（順番）が設定されている場合は順番取得
            $priority = floatval($m[1]);
          } else {
            $priority = 9999;
          }
          $name = trim(strip_tags($matches[1]));
          if ( is_parts_skin_file($pathname) )//パーツスキンの場合
            $name = '[P] '.$name;

          $file_path = str_replace($search, $replace , $pathname);
          $file_path = remove_protocol($file_path);
          //返り値の設定
          $results[] = array(
            'name' => $name,
            'dir' => $dir_name,
            'priority' => $priority,
            'path' => $file_path,
          );
        }
      }
    }
  }
  uasort($results, 'skin_files_comp');//スキンを優先度順に並び替え

  return $results;
}
endif;

//WP_Queryの引数を取得
if ( !function_exists( 'get_related_wp_query_args' ) ):
function get_related_wp_query_args(){
  global $post;
  if ( is_related_entry_association_category() ) {
    //カテゴリ情報から関連記事をランダムに呼び出す
    $categories = get_the_category($post->ID);
    $category_IDs = array();
    foreach($categories as $category):
      array_push( $category_IDs, $category -> cat_ID);
    endforeach ;
    if ( empty($category_IDs) ) return;
    return $args = array(
      'post__not_in' => array($post -> ID),
      'posts_per_page'=> intval(get_related_entry_count()),
      'category__in' => $category_IDs,
      'orderby' => 'rand',
    );
  } else {
    //タグ情報から関連記事をランダムに呼び出す
    $tags = wp_get_post_tags($post->ID);
    $tag_IDs = array();
    foreach($tags as $tag):
      array_push( $tag_IDs, $tag -> term_id);
    endforeach ;
    if ( empty($tag_IDs) ) return;
    return $args = array(
      'post__not_in' => array($post -> ID),
      'posts_per_page'=> intval(get_related_entry_count()),
      'tag__in' => $tag_IDs,
      'orderby' => 'rand',
    );
  }
}
endif;

//アップロード可能なファイルの設定
function my_upload_mimes($mimes = array()) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'my_upload_mimes');

//投稿ページと固定ページを一覧リストに表示する
function post_page_all( $query ) {
  if ( is_admin() || ! $query->is_main_query() )
    return;

  if ( $query->is_home() ) {
    $query->set( 'post_type', array( 'post', 'page' ) );
    return;
  }
}
if ( is_page_include_in_list() ) {//固定ページをリスト表示する設定のとき
  add_action( 'pre_get_posts', 'post_page_all' );
}

//アップデートチェックの初期化
if ( is_auto_update_enable() ) {//テーマのオートアップデート機能が有効のとき
  require 'theme-update-checker.php'; //ライブラリのパス
  $example_update_checker = new ThemeUpdateChecker(
    'simplicity2', //テーマフォルダ名
    'https://raw.githubusercontent.com/yhira/simplicity2/master/update-info2.json' //JSONファイルのURL
  );
}

// functions.phpに追加(子テーマのでも可)
function my_comment_form_defaults($defaults){
    $defaults['comment_field'] = '<p class="comment-form-comment"><textarea id="comment" class="expanding" name="comment" cols="45" rows="8" aria-required="true" placeholder=""></textarea></p>';
    return $defaults;
}
add_filter( "comment_form_defaults", "my_comment_form_defaults");

//本文から必要のないものを取り除くフック
if ( !function_exists( 'remove_unnecessary_sentences' ) ):
function remove_unnecessary_sentences($the_content) {
  if ( is_singular() ) {
    //border属性は不要
    $the_content = str_replace(' border="0"', '', $the_content);
    $the_content = str_replace(" border='0'", '', $the_content);
  }
  return $the_content;
}
endif;
add_filter('the_content','remove_unnecessary_sentences');

//本文から必要のないものを取り除くフック
if ( !function_exists( 'scrollable_responsive_table' ) ):
function scrollable_responsive_table($the_content) {
  $the_content = preg_replace('/<table/i', '<div class="scrollable-table"><table', $the_content);
  $the_content = preg_replace('/<\/table>/i', '</table></div>', $the_content);
  return $the_content;
}
endif;
if (is_scrollable_table_enable()) {
  add_filter('the_content','scrollable_responsive_table');
}


//カスタムフィールドのショートコードをロケーションURIに置換
function replace_directory_uri($code){
  $code = str_replace('[template_directory_uri]', get_template_directory_uri(), $code);
  $code = str_replace('[stylesheet_directory_uri]', get_stylesheet_directory_uri(), $code);
  $code = str_replace('<?php echo template_directory_uri(); ?>', get_template_directory_uri(), $code);
  $code = str_replace('<?php echo get_stylesheet_directory_uri(); ?>', get_stylesheet_directory_uri(), $code);
  return $code;
}

/*
//現在採用してない
//画像が出てきたらキャプション表示用のラッパーを装着
function wrap_images_for_hover($the_content) {
  if ( is_singular() ) {
    //Alt属性値のある画像タグをラッパー付きのタグで置換する
    $the_content = preg_replace(
      '/(<img.+?alt=[\'"]([^\'"]+?)[\'"].+?>)/i',
      '<a class="hover-image">${1}<div class="details"><span class="info">${2}</span></div></a>',
      $the_content);
    //$the_content = preg_replace('/<\/?p>/i', '', $the_content);
  }
  return $the_content;
}
if ( is_alt_hover_effect_enable() ) {
  add_filter('the_content','wrap_images_for_hover',100);
}
*/

//ブロックエディターの有効化/無効化
if (!is_admin_block_editor_enable()) {
  add_filter('gutenberg_can_edit_post_type', '__return_false');
  add_filter('use_block_editor_for_post', '__return_false');
}

//Simplicityのビジュアルエディタースタイル
function simplicity_theme_add_editor_styles() {
  add_editor_style( 'css/admin-editor.css' );
}
if ( is_admin_editor_enable() ) {
  add_action( 'admin_init', 'simplicity_theme_add_editor_styles' );
}

//テーマカスタマイザーのファイルを外部ファイルに書き出す
function css_custum_to_css_file(){
  if ( WP_Filesystem() ) {//WP_Filesystemの初期化
    global $wp_filesystem;//$wp_filesystemオブジェクトの呼び出し

    //カスタマイザーのカスタムCSSを取得
    ob_start();//バッファリング
    get_template_part('css-custom');//カスタムテンプレートの呼び出し
    $css_settings = ob_get_clean();
    $css_settings = str_replace('<style type="text/css">', '', $css_settings);
    $css_settings = str_replace('</style>', '', $css_settings);
    //var_dump($css_settings);

    //CSSの縮小化
    $css_settings = minify_css($css_settings);

    $wp_filesystem->put_contents(
      get_simplicity_local_dir().'/css/css-custom.css',
      $css_settings,
      0644
    );
    return true;
  }
}

//パーツスキンファイルが存在しているか
function is_parts_skin_file($skin_file){
  if ( get_pearts_base_skin($skin_file) ) {
    return true;
  }
}

//パーツスキンファイルを取得（ないときは空を返す）
function get_pearts_base_skin($skin_file = null){
  if ( !$skin_file )
    $skin_file = get_skin_file();
  //var_dump($skin_file);
  if ( $skin_file ) {
    $path_arr = explode('/', $skin_file);
    //配列を逆順に並び替え
    $reversed_path_arr = array_reverse($path_arr);
    //スキンのフォルダ名を取得
    $skin_dir_name = $reversed_path_arr[1];
    if ( preg_match('/^_/', $skin_dir_name, $m) ) {
      return $skin_file;
    }
  }
}

//スキンフォルダ内のJavaScriptファイルのURLを取得
function get_skins_js_uri(){
  $path_parts = pathinfo( get_skin_file() );
  if ( isset( $path_parts["dirname"] ) ) {
    return $path_parts["dirname"] . '/javascript.js';
  }
}

//スキンフォルダ内のJavaScriptファイルのローカルパスを取得
function get_skins_js_local_dir(){
  if ( get_skins_js_uri() ) {
    $dir = get_skins_js_uri();
    $stylesheet_directory_uri = get_stylesheet_directory_uri();
    $template_directory_uri = get_template_directory_uri();
    // $stylesheet_directory_uri = remove_protocol(get_stylesheet_directory_uri());
    // $template_directory_uri = remove_protocol(get_template_directory_uri());
    if( strpos( $dir , $stylesheet_directory_uri ) !== false ){
      $dir = str_replace( $stylesheet_directory_uri, get_stylesheet_directory(), $dir );
    } else {
      $dir = str_replace( $template_directory_uri, get_template_directory(), $dir );
    }
    // if( strpos( $dir , get_stylesheet_directory_uri() ) !== false ){
    //   $dir = str_replace( get_stylesheet_directory_uri(), get_stylesheet_directory(), $dir );
    // } else {
    //   $dir = str_replace( get_template_directory_uri(), get_template_directory(), $dir );
    // }
    // header('Content-Type: text/plain; charset=utf-8');
    // var_dump($dir);
    return str_replace( '\\', '/', $dir);
  }
}

//Wordpressテーマフォルダのローカルパスを取得
function get_theme_local_dir(){
  $dir = get_simplicity_local_dir();
  $dir_arr = explode('/', $dir);
  array_pop($dir_arr);//Simplicityディレクトリを取り除く
  $theme_dir = implode('/', $dir_arr);
  return $theme_dir;
}

//Wordpressテーマフォルダのパスを取得
function get_theme_dir(){
  $dir = get_stylesheet_directory_uri();
  $dir_arr = explode('/', $dir);
  array_pop($dir_arr);//Simplicityディレクトリを取り除く
  $theme_dir = implode('/', $dir_arr);
  return $theme_dir;
}

//統一パーツスキンとなるファイルの取得
function get_parts_skin_file_uri(){
  //define( 'FS_METHOD', 'direct' );
  define( 'MERGED_CSS', '_merged_.css' );

  $skin_file = get_pearts_base_skin();
  if ( !$skin_file ) return;//パーツスキンじゃないときは
  $skin_arr = explode('/', $skin_file);
  array_pop($skin_arr);//CSSファイル名の除去
  $skin_dir = implode('/', $skin_arr);
  //var_dump(get_theme_local_dir());
  $theme_dir = get_theme_dir();
  //$theme_dir = remove_protocol(get_theme_dir());
  //スキンファイルをローカルパスに変換
  $skin_local_file = str_replace(
    //get_theme_dir(),
    $theme_dir,
    get_theme_local_dir(),
    $skin_file
  );
  //URLをローカルパスに変換
  $skin_local_dir = str_replace(
    //get_theme_dir(),
    $theme_dir,
    get_theme_local_dir(),
    $skin_dir
  );
  //ディレクトリ内の全てのCSSファイルを取得
  //var_dump($skin_local_dir);
  $all_files = get_file_list($skin_local_dir.'/');
  //var_dump($all_files);

  //利用するパーツスキンファイルを取得
  $skin_pearts_local_files = array();
  foreach($all_files as $pathname){
    $pathname = str_replace('\\', '/', $pathname);

    if (preg_match('/\.css$/i', $pathname, $matches)){//フォルダ名の正規表現が[a-zA-Z\-_]+のとき
      //結合ファイルの時は読み込まない
      if (preg_match('/\/_merged_\.css$/i', $pathname, $m)) continue;
      //スキンのstyle.cssは先頭にするため読み込まない
      if ( !preg_match('/\/style\.css$/i', $pathname, $m) ) {
        $skin_pearts_local_files[] = $pathname;
      }

    }
  }
  //文字列順に並び替え
  sort($skin_pearts_local_files, SORT_STRING);
  //先頭にstyle.cssを追加
  $skin_pearts_local_files = array_merge(
    array($skin_local_file),
    $skin_pearts_local_files
  );
  //var_dump($skin_pearts_local_files);

  //パーツスキンファイルを開いて全てまとめる
  $merged_css_text = '';
  foreach($skin_pearts_local_files as $pathname){
    if ( WP_Filesystem() ) {//WP_Filesystemの初期化
      global $wp_filesystem;//$wp_filesystemオブジェクトの呼び出し
      //コメントで位置を表示するためのファイル名取得
      $comment_file_name = str_replace($skin_local_dir.'/', '', $pathname);
      $css = $wp_filesystem->get_contents($pathname);//ファイルの読み込み
      $merged_css_text .=
        "/****************************\r\n".
        "** File：".$comment_file_name."\r\n".
        "****************************/\r\n".
        $css."\r\n";//CSSの結合
    }
  }
  //var_dump($merged_css_text);

  $merged_css_file = $skin_local_dir.'/'.MERGED_CSS;
  if ( WP_Filesystem() ) {//WP_Filesystemの初期化
    global $wp_filesystem;//$wp_filesystemオブジェクトの呼び出し
    $wp_filesystem->put_contents(
      $merged_css_file,
      $merged_css_text,
      0644
    );
  }
  if ( !file_exists($merged_css_file) ) return;//ファイルが存在しないときnull
  return str_replace(
           get_theme_local_dir(),
           get_theme_dir(),
           $merged_css_file);//成功した時はファイルパスを渡す
}

//レスポンシブなページネーションを作成する
if ( !function_exists( 'responsive_pagination' ) ):
function responsive_pagination($pages = '', $range = 4){
  $showitems = ($range * 2)+1;

  global $paged;
  if(empty($paged)) $paged = 1;

  //ページ情報の取得
  if($pages == '') {
    global $wp_query;
    $pages = $wp_query->max_num_pages;
    if(!$pages){
      $pages = 1;
    }
  }

  if(1 != $pages) {
    echo '<ul class="pagination" role="menubar" aria-label="Pagination">';
    //先頭へ
    echo '<li class="first"><a href="'.get_pagenum_link(1).'"><span>First</span></a></li>';
    //1つ戻る
    echo '<li class="previous"><a href="'.get_pagenum_link($paged - 1).'"><span>Previous</span></a></li>';
    //番号つきページ送りボタン
    for ($i=1; $i <= $pages; $i++)     {
      if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) ))       {
        echo ($paged == $i)? '<li class="current"><span>'.$i.'</span></li>':'<li><a href="'.get_pagenum_link($i).'" class="inactive" >'.$i.'</a></li>';
      }
    }
    //1つ進む
    if ( $pages == $paged ) {
      $next_page_num = $paged;
    } else {
      $next_page_num = $paged + 1;
    }


    echo '<li class="next"><a href="'.get_pagenum_link($next_page_num).'"><span>Next</span></a></li>';
    //最後尾へ
    echo '<li class="last"><a href="'.get_pagenum_link($pages).'"><span>Last</span></a></li>';
    echo '</ul>';
  }
}
endif;

//インデックスページで最初のエントリーかどうか
//グローバル変数を使うので注意
//グローバル変数（$g_list_index）は、list.phpのみで指定されています
function is_list_index_first(){
  global $g_list_index;
  return ($g_list_index == 0) && is_home() && !is_paged();
}

//エントリーカードスタイルを利用する設定の場合
function is_entry_card_style(){
  return is_list_style_entry_cards() || is_list_style_large_card_just_for_first() || is_list_style_body_just_for_first();
}

//bodyタグに追加するクラス名
if ( !function_exists( 'body_class_names' ) ):
function body_class_names($classes) {
  if (!is_singular()) {
    return $classes;
  }
  if ( is_page_type_default() ) {
    //デフォルトは何もしない
  } elseif ( is_page_type_column1_narrow() ) {
    $classes[] = 'page-type-column1 page-type-narrow';
  } elseif ( is_page_type_column1_wide() ) {
    $classes[] = 'page-type-column1 page-type-wide';
  } elseif ( is_page_type_content_only_narrow() ) {
    $classes[] = 'page-type-content-only page-type-narrow';
  } elseif ( is_page_type_content_only_wide() ) {
    $classes[] = 'page-type-content-only page-type-wide';
  }
  return $classes;
}
endif;
add_filter('body_class', 'body_class_names');

//子テーマを利用しているか
function is_child_theme_enable(){
  return get_template_directory_uri() != get_stylesheet_directory_uri();
}

//ヘッダーでユニバーサルアナリティクスコードの呼び出し
function add_universal_analytics_code(){
  get_template_part('analytics-universal');
}
if ( is_analytics_universal() ) {
  add_action('wp_head', 'add_universal_analytics_code', 11);
}

//HTML5で警告が出てしまう部分をできるだけ修正する
if ( !function_exists( 'simplicity_html5_fix' ) ):
function simplicity_html5_fix($the_content){
  //</div>に</p></div>が追加されてしまう
  //http://tenman.info/labo/snip/archives/5197
  $the_content = str_replace( '</p></div>','</div>', $the_content );
  //Alt属性がないIMGタグにalt=""を追加する
  $the_content = preg_replace('/<img((?![^>]*alt=)[^>]*)>/i', '<img alt=""${1}>', $the_content);
  return $the_content;
}
endif;
add_filter('the_content', 'simplicity_html5_fix');
add_filter('widget_text', 'simplicity_html5_fix');
add_filter('widget_text_pc_text', 'simplicity_html5_fix');
add_filter('widget_classic_text', 'simplicity_html5_fix');
add_filter('widget_text_mobile_text', 'simplicity_html5_fix');

//現在のカテゴリをカンマ区切りテキストで取得する
if ( !function_exists( 'get_category_ids' ) ):
function get_category_ids(){
  if ( is_single() ) {//投稿ページでは全カテゴリー取得
    $categories = get_the_category();
    $category_IDs = array();
    foreach($categories as $category):
      array_push( $category_IDs, $category -> cat_ID);
    endforeach ;
    return $category_IDs;
  } elseif ( is_category() ) {//カテゴリページではトップカテゴリーのみ取得
    $categories = get_the_category();
    $cat_now = $categories[0];
    return array( $cat_now->cat_ID );
  }
  return null;
}
endif;

//モバイルで1ページに表示する最大投稿数を設定する
if ( !function_exists( 'set_posts_per_page_mobile' ) ):
function set_posts_per_page_mobile( $query ) {
  if ( is_mobile() && !is_admin() && $query->is_main_query() ) {
      $query->set( 'posts_per_page', get_posts_per_page_mobile() );
  }
}
endif;
add_action( 'pre_get_posts', 'set_posts_per_page_mobile' );

//Facebookの埋め込みの不要なスクリプトを除去する
if ( !function_exists( 'remove_facebook_embed_scripts' ) ):
function remove_facebook_embed_scripts($the_content){
  //埋め込みタグのスクリプトを空文字に置換する
  $the_content = preg_replace('/<div id="fb-root"><\/div><script>.+?connect\.facebook\.net.+?<\/script>/i', '', $the_content);
  return $the_content;
}
endif;
add_filter('the_content', 'remove_facebook_embed_scripts');

// //テーブルのレスポンシブ
// if ( !function_exists( 'wrap_table_elements' ) ):
// function wrap_table_elements($the_content){
//   //埋め込みタグのスクリプトを空文字に置換する
//   $the_content = str_replace('<table', '<div class="table-wrap"><table', $the_content);
//   $the_content = str_replace('</table>', '</table></div>', $the_content);
//   return $the_content;
// }
// endif;
// add_filter('the_content', 'wrap_table_elements');

//ページが分割ページか
function is_page_multi(){
  global $numpages;
  return $numpages != 1;
}

//分割ページの何ページ目か
function get_multi_page_number() {
  $paged = (get_query_var('page')) ? get_query_var('page') : 1;
  return $paged;
}

// //レンダリングをブロックするスクリプトリソースを遅れて読み込む
// if ( !function_exists( 'add_defer_to_enqueue_script' ) ):
// function add_defer_to_enqueue_script( $url ) {
//     if (  FALSE === strpos( $url, '.js' ) ) return $url;
//     //if ( strpos( $url, 'jquery.js' ) ) return $url;
//     return "$url' defer='defer";
// }
// endif;
// add_filter( 'clean_url', 'add_defer_to_enqueue_script', 11, 1 );

//エントリーカード全体をリンク化する
if ( !function_exists( 'get_template_part_card' ) ):
function get_template_part_card($template_name){
  ob_start();//バッファリング
  get_template_part($template_name);//テンプレートの呼び出し
  $template = ob_get_clean();//テンプレート内容を変数に代入
  //エントリーカードをカード化する場合はaタグを削除して全体をa.hover-cardで囲む
  $template = wrap_entry_card($template);
  echo $template;
}
endif;

//文字列内のaタグを削除して全体をa.hover-cardで囲む
if ( !function_exists( 'wrap_entry_card' ) ):
function wrap_entry_card($template, $url = null, $is_target_blank = false, $is_nofollow = false, $additional_classes = null){
  if ( is_wraped_entry_card() ) {
    $template = preg_replace('/<a [^>]+?>/i', '', $template);
    $template = str_replace('</a>', '', $template);

    $class = null;
    if ( !$url ) {
      //$class = ' hover-blog-card';
      $url = get_the_permalink();
    }

    $target = null;
    if ( $is_target_blank ) {
      $target = ' target="_blank"';
    }

    //コメント内でブログカード呼び出しが行われた際はnofollowをつける
    $nofollow = $is_nofollow ? ' rel="nofollow"' : null;

    //$blog_card_hover_class = $is_blog_card ? ' hover-blog-card' : null;

    //var_dump($template);
    //$template = '<a class="hover-card" href="'.$url.'"'.$target.'><object>'.$template.'</object></a>';
    $template = '<a class="hover-card'.$additional_classes.'" href="'.$url.'"'.$target.$nofollow.'>'.$template.'</a>';
    //$template = '<span>'.$template.'</span>';
  }
  return $template;
}
endif;

// function category_classize($cat_id) {
//   return 'category-'.$cat_id;
// };

// function get_category_id_classes(){
//   if ( is_single() ) {
//     $cat_ids = get_category_ids();
//     $cat_ids = array_map('category_classize', $cat_ids);
//     if ( $cat_ids ) {
//       return implode(' ', $cat_ids);
//     }
//   }
// }

//カテゴリIDクラスをbodyクラスに含める
if ( !function_exists( 'add_category_id_classes_to_body_classes' ) ):
function add_category_id_classes_to_body_classes($classes) {
  global $post;
  if ( is_single() ) {
    foreach((get_the_category($post->ID)) as $category)
      $classes[] = 'categoryid-'.$category->cat_ID;
  }
  return $classes;
}
endif;
add_filter('body_class', 'add_category_id_classes_to_body_classes');

// //カテゴリスラッグクラスをbodyクラスに含める
// function add_category_slug_classes_to_body_classes($classes) {
//   global $post;
//   foreach((get_the_category($post->ID)) as $category)
//      $classes[] = $category->category_nicename;
//   return $classes;
// }
// add_filter('body_class', 'add_category_slug_classes_to_body_classes');

//Wordpress管理画面でJavaScriptファイルも編集できるようにする wp4.4以降
if ( !function_exists( 'add_js_to_wp_theme_editor_filetypes' ) ):
function add_js_to_wp_theme_editor_filetypes($default_types){
  $default_types[] = 'js';
  return $default_types;
}
endif;
add_filter('wp_theme_editor_filetypes', 'add_js_to_wp_theme_editor_filetypes');

//サイトアドレスが含まれているか
if ( !function_exists( 'includes_site_url' ) ):
function includes_site_url($url){
  //URLにサイトアドレスが含まれていない場合
  if (strpos($url, site_url()) === false) {
    return false;
  } else {
    return true;
  }
}
endif;

//内部URLをローカルパスに変更
if ( !function_exists( 'url_to_local' ) ):
function url_to_local($url){
  //URLにサイトアドレスが含まれていない場合
  if (!includes_site_url($url)) {
    return false;
  }
  $path = str_replace(content_url(), WP_CONTENT_DIR, $url);
  $path = str_replace('\\', '/', $path);
  return $path;
}
endif;

//images/no-image.pngを使用するimgタグに出力するサイズ関係の属性
if ( !function_exists( 'get_noimage_sizes_attr' ) ):
function get_noimage_sizes_attr($image = null){
  if (!$image) {
    $image = get_template_directory_uri().'/images/no-image.png';
  }
  $sizes = ' srcset="'.$image.' 100w" width="100" height="100" sizes="(max-width: 100px) 100vw, 100px"';
  return $sizes;
}
endif;


//特定のプラグインを除外してREST APIを無効にする
if ( !function_exists( 'simplicity_deny_restapi_except_plugins' ) ):
function simplicity_deny_restapi_except_plugins( $result, $wp_rest_server, $request ){
    $namespaces = $request->get_route();

    //oembedの除外
    if( strpos( $namespaces, 'oembed/' ) === 1 ){
        return $result;
    }
    //Jetpackの除外
    if( strpos( $namespaces, 'jetpack/' ) === 1 ){
        return $result;
    }
    //Contact Form7の除外
    if( strpos( $namespaces, 'contact-form-7/' ) === 1 ){
        return $result;
    }

    return new WP_Error( 'rest_disabled', __( 'The REST API on this site has been disabled.', 'simplicity2' ), array( 'status' => rest_authorization_required_code() ) );
}
endif;
if (!is_rest_api_enable() && (get_wordpress_version() >= 4.7)) {
  add_filter( 'rest_pre_dispatch', 'simplicity_deny_restapi_except_plugins', 10, 3 );
}

//Wordpressのバージョンを少数で取得する
function get_wordpress_version(){
  return floatval(get_bloginfo('version'));
}


//投稿内容をSSL対応する
if ( !function_exists( 'chagne_http_to_https' ) ):
function chagne_site_url_html_to_https($the_content){
  //httpとhttpsURLの取得
  if (strpos(site_url(), 'https://') !== false) {
    $http_url = str_replace('https://', 'http://', site_url());
    $https_url = site_url();
  } else {
    $http_url = site_url();
    $https_url = str_replace('http://', 'https://', site_url());
  }
  //投稿本文の内部リンクを置換
  $the_content = str_replace($http_url, $https_url, $the_content);

  //AmazonアソシエイトのSSL対応
  $search  = 'http://ecx.images-amazon.com';
  $replace = 'https://images-fe.ssl-images-amazon.com';
  $the_content = str_replace($search, $replace, $the_content);
  $search  = 'http://ir-jp.amazon-adsystem.com';
  $replace = 'https://ir-jp.amazon-adsystem.com';
  $the_content = str_replace($search, $replace, $the_content);


  //バリューコマースのSSL対応
  $search  = 'http://ck.jp.ap.valuecommerce.com';
  $replace = 'https://ck.jp.ap.valuecommerce.com';
  $the_content = str_replace($search, $replace, $the_content);
  $search  = 'http://ad.jp.ap.valuecommerce.com';
  $replace = 'https://ad.jp.ap.valuecommerce.com';
  $the_content = str_replace($search, $replace, $the_content);

  //もしもアフィリエイトのSSL対応
  $search  = 'http://c.af.moshimo.com';
  $replace = 'https://af.moshimo.com';
  $the_content = str_replace($search, $replace, $the_content);
  $search  = 'http://i.af.moshimo.com';
  $replace = 'https://i.moshimo.com';
  $the_content = str_replace($search, $replace, $the_content);
  $search  = 'http://image.moshimo.com';
  $replace = 'https://image.moshimo.com';
  $the_content = str_replace($search, $replace, $the_content);

  //A8.netのSSL対応
  $search  = 'http://px.a8.net';
  $replace = 'https://px.a8.net';
  $the_content = str_replace($search, $replace, $the_content);
  // $search  = 'http://www14.a8.net/0.gif';
  // $replace = 'https://www14.a8.net/0.gif';
  // $the_content = str_replace($search, $replace, $the_content);
  // $search  = 'http://www16.a8.net/0.gif';
  // $replace = 'https://www16.a8.net/0.gif';
  // $the_content = str_replace($search, $replace, $the_content);
  $search  = '{http://www(\d+).a8.net/0.gif}';
  $replace = "https://www$1.a8.net/0.gif";
  $the_content = preg_replace($search, $replace, $the_content);

  //アクセストレードのSSL対応
  $search  = 'http://h.accesstrade.net';
  $replace = 'https://h.accesstrade.net';
  $the_content = str_replace($search, $replace, $the_content);

  //はてなブログカードのSSL対応
  $search  = 'http://hatenablog.com/embed?url=';
  $replace = 'https://hatenablog-parts.com/embed?url=';
  $the_content = str_replace($search, $replace, $the_content);

  //はてブ数画像のSSL対応
  $search  = 'http://b.hatena.ne.jp/entry/image/';
  $replace = 'https://b.hatena.ne.jp/entry/image/';
  $the_content = str_replace($search, $replace, $the_content);

  //楽天商品画像のSSL対応
  $search  = 'http://hbb.afl.rakuten.co.jp';
  $replace = 'https://hbb.afl.rakuten.co.jp';
  $the_content = str_replace($search, $replace, $the_content);

  //リンクシェアのSSL対応
  $search  = 'http://ad.linksynergy.com';
  $replace = 'https://ad.linksynergy.com';
  $the_content = str_replace($search, $replace, $the_content);

  //Google検索ボックスのSSL対応
  $search  = 'http://www.google.co.jp/cse';
  $replace = 'https://www.google.co.jp/cse';
  $the_content = str_replace($search, $replace, $the_content);
  $search  = 'http://www.google.co.jp/coop/cse/brand';
  $replace = 'https://www.google.co.jp/coop/cse/brand';
  $the_content = str_replace($search, $replace, $the_content);

  //ここに新しい置換条件を追加していく

  // //のSSL対応
  // $search  = '';
  // $replace = '';
  // $the_content = str_replace($search, $replace, $the_content);

  return $the_content;
}
endif;
if (is_easy_ssl_enable()) {
  add_filter('the_content', 'chagne_site_url_html_to_https', 1);
  add_filter('widget_text', 'chagne_site_url_html_to_https', 1);
  add_filter('widget_text_pc_text', 'chagne_site_url_html_to_https', 1);
  add_filter('widget_classic_text', 'chagne_site_url_html_to_https', 1);
  add_filter('widget_text_mobile_text', 'chagne_site_url_html_to_https', 1);
  add_filter('comment_text', 'chagne_site_url_html_to_https', 1);
}

//コメントが許可されているか
if ( !function_exists( 'is_comment_open' ) ):
function is_comment_open(){
  global $post;
  if ( isset($post->comment_status) ) {
    return $post->comment_status == 'open';
  }
  return false;
}
endif;

//ビジュアルエディターでrel="noopener noreferrer"自動付加の解除
if ( !function_exists( 'tinymce_allow_unsafe_link_target' ) ):
function tinymce_allow_unsafe_link_target( $mce_init ) {
 $mce_init['allow_unsafe_link_target']=true;
 return $mce_init;
}
endif;
if (!is_rel_noopener_noreferrer_enable()) {
  add_filter('tiny_mce_before_init','tinymce_allow_unsafe_link_target');
}


//本文からnoopener noreferrerを取り除く
if ( !function_exists( 'remove_noopener_and_noreferrer' ) ):
function remove_noopener_and_noreferrer($the_content){
  $the_content = str_replace(' rel="nofollow noopener noreferrer"', ' rel="nofollow"', $the_content);
  $the_content = str_replace(' rel="noopener noreferrer"', '', $the_content);
  return $the_content;
}
endif;
if (!is_rel_noopener_noreferrer_enable()) {
  add_filter('the_content', 'remove_noopener_and_noreferrer', 999999);
}

//アーカイブタイトルの取得
if ( !function_exists( 'get_archive_chapter_title' ) ):
function get_archive_chapter_title(){
  $chapter_title = null;
  if( is_category() ) {//カテゴリページの場合
    $chapter_title .= single_cat_title( '', false );
  } elseif( is_tag() ) {//タグページの場合
    $chapter_title .= single_tag_title( '', false );
  } elseif( is_tax() ) {//タクソノミページの場合
    $chapter_title .= single_term_title( '', false );
  } elseif (is_day()) {
    //年月日のフォーマットを取得
    $chapter_title .= get_the_time( get_theme_text_ymd_format() );
  } elseif (is_month()) {
    //年と月のフォーマットを取得
    $chapter_title .= get_the_time( get_theme_text_ym_format() );
  } elseif (is_year()) {
    //年のフォーマットを取得
    $chapter_title .= get_the_time( get_theme_text_y_format() );
  } elseif (is_author()) {//著書ページの場合
    $chapter_title .= esc_html(get_queried_object()->display_name);
  } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
    $chapter_title .= 'Archives';
  } else {
    $chapter_title .= 'Archives';
  }
  return $chapter_title;
}
endif;

//アーカイブ見出しの取得
if ( !function_exists( 'get_archive_chapter_text' ) ):
function get_archive_chapter_text(){
  $chapter_text = null;
  //アーカイブタイトル前
  $chapter_text .= '<span class="archive-title-pb">'.__( '「', 'simplicity2' ).'</span><span class="archive-title-text">';
  //アーカイブタイトルの取得
  $chapter_text .= get_archive_chapter_title();
  //アーカイブタイトル後
  $chapter_text .= '</span><span class="archive-title-pa">'.__( '」', 'simplicity2' ).'</span><span class="archive-title-list-text">'.get_theme_text_list().'</span>';
  //返り値として返す
  return $chapter_text;
}
endif;

//Gistのembed対応
wp_embed_register_handler( 'gist', '/https?:\/\/gist\.github\.com\/([a-z0-9]+)\/([a-z0-9]+)(#file=.*)?/i', 'wp_embed_register_handler_for_gist' );
if ( !function_exists( 'wp_embed_register_handler_for_gist' ) ):
function wp_embed_register_handler_for_gist( $matches, $attr, $url, $rawattr ) {
  $embed = sprintf(
    '<script src="https://gist.github.com/%1$s/%2$s.js"></script>',
    esc_attr( $matches[1] ),
    esc_attr( $matches[2] )
    );
  return apply_filters( 'embed_gist', $embed, $matches, $attr, $url, $rawattr );
}
endif;

//ウィジェット設定エリアの幅を広げる
add_action('admin_head', 'wide_widget_setting_area');
if ( !function_exists( 'wide_widget_setting_area' ) ):
function wide_widget_setting_area(){
  global $current_screen;
  if ( $current_screen->id == 'widgets' )
  {
  ?>
	<style type="text/css">
	.widget.open{
	  margin-left: -116px;
	  z-index: 100;
	}

	#sub-accordion-section-sidebar-widgets-sidebar .widget.open,
	#wp_inactive_widgets .widget.open{
	  margin-left: 0;
	}

	</style>
  <?php
  }
}
endif;

//Jetpackとの競合対応
remove_action( 'init', 'wpcom_youtube_embed_crazy_url_init' );
//YouTube動画表示の高速化
add_filter('embed_oembed_html', 'youtube_embed_oembed_html', 1, 3);
if ( !function_exists( 'youtube_embed_oembed_html' ) ):
function youtube_embed_oembed_html ($cache, $url, $attr) {
  if (is_amp()) {
    return $cache;
  }

  // data-youtubeチェック
  if (strpos($cache, 'data-youtube')) {
    preg_match( '/(?<=data-youtube=")(.+?)(?=")/', $cache, $match_cache);
    $MATCH_CACHE = $match_cache[0];
  };

  //* YouTubeキャッシュが空のときYouTubeビデオとプレイリストのためにこれらを作成する ( video_id, title, picprefix and etc for schema.org )
  if (empty($MATCH_CACHE)) {

    // YouTubeキャッシュを無視する
    if (!strpos($cache, 'youtube')) {
      return $cache;
    }

    // curlの存在確認
    if (!function_exists('curl_version')) {
      return $cache;
    }

    // 古いデータの除去
    $cache = preg_replace('/data-picprefix=\\"(.+?)\\"/s', "", $cache);
    // プレイリストIDがある場合
    if( preg_match_all( '/videoseries|list=/i', $cache, $m )){
      // プレイリストIDの抽出
      preg_match( '/(?<=list=)(.+?)(?=")/', $cache, $list );
      // ビデオIDの取得
      $json = json_decode(file_get_contents('https://www.youtube.com/oembed?url=http://www.youtube.com/playlist?list='.$list[1]), true);
      // ビデオIDの抽出
      preg_match( '/(?<=vi\/)(.+?)(?=\/)/', $json['thumbnail_url'], $video_id );
    } else {
      preg_match( '/(?<=embed\/)(.+?)(?=\?)/', $cache, $video_id );
    }

    // もしビデオIDないまだ空ならおそらくYouTubeがオフライン
    if (!$video_id[0]) {
      return $cache;
    }

    $ch = curl_init();
    $headers = array(
      'Accept-language: en',
      'User-Agent: Mozilla/5.0 (iPad; CPU OS 7_0_4 like Mac OS X) AppleWebKit/537.51.1 (KHTML, like Gecko) Version/7.0 Mobile/11B554a Safari',
    );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_URL, "https://www.youtube.com/oembed?url=http://www.youtube.com/watch?v=" . $video_id[0] . "&format=json");

    $data = curl_exec($ch);

    $info = curl_getinfo($ch);
    curl_close($ch);

    if ($info['http_code'] != 200){
      return $cache;
    }

    // YouTubeからデータが取得できなかった場合
    if (empty($data)) {
      return $cache;
    }

    // コード処理
    $data = str_replace("\\U",'\\u', $data);
    $json =  json_decode($data,JSON_UNESCAPED_SLASHES);


    // JSONが無効な場合
    if (empty($json)) {
      return $cache;
    }

    $youtube_cache  = array();
    $youtube_cache['title'] = htmlentities( $json['title'], ENT_QUOTES, 'UTF-8' );
    $youtube_cache['video_id'] = $video_id[0];


    $youtube_cache = base64_encode(json_encode($youtube_cache));

    if(isset($attr['discover']) && $attr['discover'] == 1){
      unset($attr['discover']);
    }

    $cachekey   = '_oembed_' . md5( $url . serialize( $attr ) );
    // $cache変数のアップデート
    $cache      = str_replace('src', ' data-youtube="'.$youtube_cache.'" src', $cache);

    // 新しいキャッシュを保存
    update_post_meta( get_the_ID(), $cachekey, $cache );

    $MATCH_CACHE = $youtube_cache;
  }

  $json   = json_decode(base64_decode($MATCH_CACHE), true);

  $youtube   = preg_replace("/data-youtube=\"(.+?)\"/", "", $cache);
  $youtube   = htmlentities(str_replace( '=oembed','=oembed&autoplay=1&rel=0', $youtube ));

  $thumb_url  = "https://i.ytimg.com/vi/{$json['video_id']}/hqdefault.jpg";

  $wrap_start = '<div class="video-container">';
  $wrap_end   = '</div>';

  //タグの生成
  $html = $wrap_start . "<div class='video-click video' data-iframe='$youtube' style='position:relative;background: url($thumb_url) no-repeat scroll center center / cover' ><div class='video-title-grad'><div class='video-title-text'>{$json['title']}</div></div><div class='video-play'></div></div>" . $wrap_end;

  return apply_filters('youtube_embed_html', $html);

};
endif;

//クリックしたときにiframe読み込む
add_filter( 'wp_footer', 'youtube_embed_oembed_script' );
if ( !function_exists( 'youtube_embed_oembed_script' ) ):
function youtube_embed_oembed_script(){
  ?>
  <script>
    (function(){
        var f = document.querySelectorAll(".video-click");
        for (var i = 0; i < f.length; ++i) {
        f[i].onclick = function () {
          var iframe = this.getAttribute("data-iframe");
          this.parentElement.innerHTML = '<div class="video">' + iframe + '</div>';
        }
        }
    })();
  </script>
  <?php
}
endif;

//強制付与されるnoreferrer削除
add_filter( 'wp_targeted_link_rel', 'wp_targeted_link_rel_custom', 10, 2 );
if ( !function_exists( 'wp_targeted_link_rel_custom' ) ):
function wp_targeted_link_rel_custom( $rel_value, $link_html ){
  // if( false === strpos( $link_html, home_url() ) ){
  //   $rel_value = 'noopener';
  // }
  $rel_value = str_replace(' noreferrer', '', $rel_value);
  return $rel_value;
}
endif;

/**
 * ボックスメニューのカスタマイズ
 * @author: わいひら
 * @link: https://nelog.jp/box-menu
 * @license: http://www.gnu.org/licenses/gpl-2.0.html GPL v2 or later
 */

//ボックスメニューショートコード
add_shortcode('box_menu', 'get_box_menu_tag');
if ( !function_exists( 'get_box_menu_tag' ) ):
function get_box_menu_tag($atts){
  extract(shortcode_atts(array(
    'name' => '', // メニュー名
    'class' => null,
  ), $atts, 'box_menu'));

  //デフォルトアイコンフォント（Font Awesome4）
  $def_icon_classes = 'fa fa-star'; //Font Awesome5を利用する場合は変更する

  if (is_admin()) {
    return;
  }

  $tag = null;
  $menu_items = wp_get_nav_menu_items($name); // name: カスタムメニューの名前
  if (!$menu_items) {
    return;
  }

  foreach ($menu_items as $menu):

    $url = $menu->url;
    $title = $menu->title;
    $title_tag = '<div class="box-menu-label">'.$title.'</div>';
    $description_tag = '<div class="box-menu-description">'.$menu->description.'</div>';
    $attr_title = $menu->attr_title;
    $classes = implode(' ', $menu->classes);
    $icon_tag = '<div class="'.esc_attr($def_icon_classes).'" aria-hidden="true"></div>';
    //画像URLの場合
    if (preg_match('/(https?)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)\.(jpg|jpeg|gif|png)/', $attr_title)) {
      $img_url = $attr_title;
      $icon_tag = '<img src="'.esc_url($img_url).'" alt="'.esc_attr($title).'" />';
    } //アイコンフォントの場合
    elseif (preg_match('/fa.? fa-[a-z\-]+/', $classes)) {
      $icon_tag = '<div class="'.esc_attr($classes).'" aria-hidden="true"></div>';
    }
    $icon_tag = '<div class="box-menu-icon">'.$icon_tag.'</div>';

    $tag .= '<a class="box-menu" href="'.esc_url($url).'">'.
      $icon_tag.
      $title_tag.
      $description_tag.
    '</a>';
  endforeach;
  $add_class = null;
  if ($class) {
    $add_class = ' '.$class;
  }
  //ラッパーで囲む
  $tag = '<div class="box-menus'.$add_class.'">'.$tag.'</div>';

  return apply_filters('get_box_menu_tag', $tag);
}
endif;

//キャンペーン（指定期間中のみ表示）
add_shortcode('campaign', 'campaign_shortcode');
if ( !function_exists( 'campaign_shortcode' ) ):
function campaign_shortcode( $atts, $content = null ) {
  extract( shortcode_atts( array(
    'from' => null, //いつから（開始日時）
    'to' => null, //いつまで（終了日時）
    'class' => null, //拡張クラス
  ), $atts, 'campaign' ) );

  //内容がない場合は何も表示しない
  if (!$content) return null;
  //現在の日時を取得
  $now = date_i18n('U');

  //いつから（開始日時）
  $from_time = strtotime($from);
  if (!$from_time) {
    $from_time = strtotime('-1 day');
  };

  //いつまで（終了日時）
  $to_time = strtotime($to);
  if (!$to_time) {
    $to_time = strtotime('+1 day');
  };

  //拡張クラス
  if ($class) {
    $class = ' '.$class;
  }

  $tag = null;
  if (($from_time < $now) && ($to_time > $now)) {
    $tag = '<div class="campaign'.esc_attr($class).'">'.
      // date_i18n('開始日時：Y年m月d日 H時i分s秒', $from_time).'<br>'.
      // date_i18n('終了日時：Y年m月d日 H時i分s秒', $to_time).'<br>'.
      $content.
    '</div>';
  }

  return $tag;
}
endif;
