<?php //画像関係の関数


//画像タグにLazyLoad用の属性などを追加
function add_image_tag_placeholders( $content ) {
  if ( is_amp() ) {
    return $content;
  }
  //プレビューやフィードモバイルなどで遅延させない
  if( is_feed() || is_preview() || is_mobile() || is_admin() )
      return $content;

  //既に適用させているところは処理しない
  if ( false !== strpos( $content, 'data-original' ) )
      return $content;

  //画像正規表現で置換
  $content = preg_replace(
      '#<img([^>]+?)src=[\'"]?([^\'"\s>]+)[\'"]?([^>]*?) ?/?>#',//IMGタグの正規表現
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
    '/<a([^>]+?(\.jpe?g|\.png|\.gif)[\'\"][^>]*?)>([\s\w\W\d]+?)<\/a>/i',//Aタグの正規表現
    '<a${1} data-lightbox="image-set">${3}</a>',//置換する
    $content );//投稿本文（置換する文章）

  return $content;
}
if ( is_lightbox_enable() ) {
  add_filter( 'the_content', 'add_lightbox_property', 9 );
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
    '/<a([^>]+?('.$img_reg.'|'.$youtube_reg.'|'.$viemo_reg.'|'.$google_map_reg.')[\'\"][^>]*?)>([\s\w\W\d]+?)<\/a>/i',//Aタグの正規表現
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

//画像が出てきたらキャプション表示用のラッパーを装着
if ( !function_exists( 'wrap_hover_image' ) ):
function wrap_hover_image($the_content) {
  if ( is_singular() ) {
    // //余計なpタグを取り除く
    $res = preg_match_all('/<p>.+?<\/p>/is', $the_content, $m);
    if ($res) {//pタグがある場合

      foreach ($m[0] as $match) {
        //imgタグがある場合pタグを取り除く
        $img_res = preg_match('/<img/is', $match, $imgs);
        if ( $img_res ) {
          $no_p = str_replace('<p>', '', $match);
          $no_p = str_replace('</p>', '', $no_p);

          //var_dump(htmlspecialchars($no_p));

          $the_content = str_replace($match, '<div class="imgs-wrap">'.$no_p.'</div>', $the_content);
        }

      }
    }

/*
    $hover_image_admin_class = null;
    if ( is_user_logged_in() ) {
      $hover_image_admin_class = ' hover-image-admin';
    }
    //
    $res = preg_match_all('/<img.+?alt=[\'"]([^\'"]+?)[\'"].+?>/is', $the_content, $m);
    if ($res) {//

      foreach ($m[0] as $match) {
        //var_dump(htmlspecialchars($match));
        //
        $the_content = preg_replace(
          '{'.preg_quote($match).'}',
          '<div class="hover-image'.$hover_image_admin_class.'">'.$match.'<div class="details"><span class="info">${1}</span></div></div>',
            $the_content);
      }

    }
*/


    $hover_image_admin_class = null;
    if ( is_user_logged_in() ) {
      $hover_image_admin_class = ' hover-image-admin';
    }
    //$the_content = preg_replace('/<\/?p>/i', '', $the_content);
    //Alt属性値のある画像タグをラッパー付きのタグで置換する

    $the_content = preg_replace(
      '/(<p>)?(((<a[^>]+?>)?<img.+?alt=[\'"]([^\'"]+?)[\'"].+?>)(<\/a>)?)(<\/p>)?/i',
      '<div class="hover-image'.$hover_image_admin_class.'">${2}<div class="details"><span class="info">${5}</span></div></div>',
      $the_content);
  }
  return $the_content;
}
endif;
if ( !is_mobile() ) {
  if (
    //管理者（ログインユーザー）のみにキャプション表示
    ( is_alt_caption_type_ac_admin() && is_user_logged_in() ) ||
    //全てのユーザーにキャプションを表示
    ( is_alt_caption_type_ac_all() )
  ) {
    add_filter('the_content','wrap_hover_image', 9999);
  }
}

if ( !function_exists( 'get_site_screenshot_url' ) ):
function get_site_screenshot_url($url){
  $mshot = 'https://s0.wordpress.com/mshots/v1/';
  //$mshot = 'http://s.wordpress.com/mshots/v1/';
  //$mshot = 'http://capture.heartrails.com/100x100/shorten?';
  return $mshot.urlencode($url).'?w=100&h=100';
}
endif;
