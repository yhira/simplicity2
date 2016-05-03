<?php //画像関係の関数


//画像タグにLazyLoad用の属性などを追加
function add_image_tag_placeholders( $content ) {
    //プレビューやフィードモバイルなどで遅延させない
    if( is_feed() || is_preview() || is_mobile() )
        return $content;

    //既に適用させているところは処理しない
    if ( false !== strpos( $content, 'data-original' ) )
        return $content;

    //画像正規表現で置換
    $content = preg_replace(
        '#<img([^>]+?)src=[\'"]?([^\'"\s>]+)[\'"]?([^>]*)>#',//IMGタグの正規表現
        sprintf( '<img${1}src="%s" data-original="${2}"${3} data-lazy="true"><noscript><img${1}src="${2}"${3}></noscript>', get_template_directory_uri().'/images/1x1.trans.gif' ),//置換するIMGタグ（JavaScriptがオフのとき用のnoscriptタグも追加）
        $content );//投稿本文（置換する文章）

    return $content;
}
if ( is_lazy_load_enable() ) {//Lazy Loadが有効の場合のみ
  add_filter( 'the_content', 'add_image_tag_placeholders', 99 );
  //add_filter( 'post_thumbnail_html', 'add_image_tag_placeholders', 99 );
  add_filter( 'get_avatar', 'add_image_tag_placeholders', 11 );
}

//Lightboxのようなギャラリー系のjQueryプラグインが動作しているか
function is_lightbox_plugin_exist($content){
  //lity
  if ( false !== strpos( $content, 'data-lity="' ) )
    return true;
  //Lightbox
  if ( false !== strpos( $content, 'data-lightbox="image-set"' ) )
    return true;

  return false;
}


//画像リンクのAタグをLightboxに対応するように付け替え
function add_lightbox_property( $content ) {
  //プレビューやフィードで表示しない
  if( is_feed() || is_mobile() )
    return $content;

  //既に適用させているところは処理しない
  //if ( false !== strpos( $content, 'data-lightbox="image-set"' ) )
  if ( is_lightbox_plugin_exist($content) )
    return $content;

  //Aタグを正規表現で置換
  $content = preg_replace(
    '/<a([^>]+?(\.jpe?g|\.png|\.gif)[\'\"][^>]*?)>\s*(<img[^>]+?>)\s*<\/a>/i',//Aタグの正規表現
    '<a${1} data-lightbox="image-set">${3}</a>',//置換する
    $content );//投稿本文（置換する文章）

  return $content;
}
if ( is_lightbox_enable() ) {
  add_filter( 'the_content', 'add_lightbox_property', 11 );
}

//画像リンクのAタグをlityに対応するように付け替え
//http://sorgalla.com/lity/
function add_lity_property( $content ) {
  //プレビューやフィードで表示しない
  if( is_feed() || is_mobile() )
    return $content;

  //既に適用させているところは処理しない
  if ( is_lightbox_plugin_exist($content) )
    return $content;

  //画像用の正規表現
  $img_reg = '\.jpe?g|\.png|\.gif|\.gif';
  //YouTube用の正規表現
  $youtube_reg = '\/\/www\.youtube\.com\/watch\?v=[^"]+';
  //Viemo用の正規表現
  $viemo_reg = '\/\/vimeo\.com\/[^"]+';
  //Googleマップ用の正規表現
  $google_map_reg = '\\/\/[mapsw]+\.google\.[^\/]+?\/maps\?q=[^"]+';
  //Aタグを正規表現で置換
  $content = preg_replace(
    '/<a([^>]+?('.$img_reg.'|'.$youtube_reg.'|'.$viemo_reg.'|'.$google_map_reg.')[\'\"][^>]*?)>\s*(.+?)\s*<\/a>/i',//Aタグの正規表現
    '<a${1} data-lity="">${3}</a>',//置換する
    $content );//投稿本文（置換する文章）
  return $content;
}
if ( is_lity_enable() ) {
  add_filter( 'the_content', 'add_lity_property', 11 );
}


//thickboxを呼び出さない
function deregister_thickbox_files() {
  wp_dequeue_style( 'thickbox' );
  wp_dequeue_script( 'thickbox' );
}

add_action( 'wp_enqueue_scripts', 'deregister_thickbox_files' );
