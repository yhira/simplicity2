<?php //ブログカード関係の関数

//はてな oEmbed対応
wp_oembed_add_provider('http://*', 'http://hatenablog.com/oembed');
//oembed無効
add_filter( 'embed_oembed_discover', '__return_false' );
//Embeds
remove_action( 'parse_query', 'wp_oembed_parse_query' );
remove_action( 'wp_head', 'wp_oembed_remove_discovery_links' );
remove_action( 'wp_head', 'wp_oembed_remove_host_js' );

//内部URLからブログをカードタグの取得
if ( !function_exists( 'url_to_blog_card_tag' ) ):
function url_to_blog_card_tag($url){
  if ( !$url ) return;
  $url = strip_tags($url);//URL
  $id = url_to_postid( $url );//IDを取得（URLから投稿ID変換）
  if ( !$id ) return;//IDを取得できない場合はループを飛ばす

  global $post;
  $post_data = get_post($id);
  setup_postdata($post_data);
  $exce = $post_data->post_excerpt;

  $title = $post_data->post_title;//タイトルの取得
  $date = mysql2date('Y-m-d H:i', $post_data->post_date);//投稿日の取得
  $excerpt = get_content_excerpt($post_data->post_content, get_excerpt_length());//抜粋の取得
  if ( is_wordpress_excerpt() && $exce ) {//Wordpress固有の抜粋のとき
    $excerpt = $exce;
  }
  //新しいタブで開く場合
  $target = is_blog_card_target_blank() ? ' target="_blank"' : '';
  //$hatebu_url = preg_replace('/^https?:\/\//i', '', $url);
  //はてブを表示する場合
  $hatebu_tag = is_blog_card_hatena_visible() ? '<div class="blog-card-hatebu"><a href="//b.hatena.ne.jp/entry/'.$url.'"'.$target.'><img src="//b.hatena.ne.jp/entry/image/'.$url.'" alt="はてブ数" /></a></div>' : '';
  //サイトロゴを表示する場合
  $favicon_tag = '';
  if ( is_favicon_enable() && get_the_favicon_url() ) {//ファビコンが有効か確認

    //GoogleファビコンAPIを利用する
    ////www.google.com/s2/favicons?domain=nelog.jp
    $favicon_tag = '<span class="blog-card-favicon"><img src="//www.google.com/s2/favicons?domain='.get_this_site_domain().'" class="blog-card-favicon-img" alt="ファビコン" /></span>';
  }
  $site_logo_tag = is_blog_card_site_logo_visible() ? '<div class="blog-card-site">'.$favicon_tag.'<a href="'.home_url().'"'.$target.'>'.get_this_site_domain().'</a></div>' : '';
  $date_tag = '';
  if ( is_blog_card_date_visible() ) {
    $date_tag = '<div class="blog-card-date">'.$date.'</div>';
  }
  //サムネイルの取得（要100×100のサムネイル設定）
  $thumbnail = get_the_post_thumbnail($id, 'thumb100', array('class' => 'blog-card-thumb-image', 'alt' => $title));
  if ( !$thumbnail ) {//サムネイルが存在しない場合
    $thumbnail = '<img src="'.get_template_directory_uri().'/images/no-image.png" alt="'.$title.'" class="blog-card-thumb-image" />';
  }
  //取得した情報からブログカードのHTMLタグを作成
  $tag = '<div class="blog-card internal-blog-card"><div class="blog-card-thumbnail"><a href="'.$url.'" class="blog-card-thumbnail-link"'.$target.'>'.$thumbnail.'</a></div><div class="blog-card-content"><div class="blog-card-title"><a href="'.$url.'" class="blog-card-title-link"'.$target.'>'.$title.'</a></div><div class="blog-card-excerpt">'.$excerpt.'</div></div><div class="blog-card-footer">'.$site_logo_tag.$hatebu_tag.$date_tag.'</div></div>';

  return $tag;
}
endif;

//本文中のURLをブログカードタグに変更する
if ( !function_exists( 'url_to_blog_card' ) ):
function url_to_blog_card($the_content) {
  if ( true /*is_singular()*/ ) {//投稿ページもしくは固定ページのとき（この条件分岐は変更）
    //1行にURLのみが期待されている行（URL）を全て$mに取得

    /*$res = preg_match_all('/^(<p>)?(<a.+?>)?https?:\/\/'.preg_quote(get_this_site_domain()).'\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+(<\/a>)?(<\/p>)?(<br ? \/>)?$/im', $the_content,$m);*/
    $res = preg_match_all('{^(<p>)?(<a.+?>)?'.preg_quote(site_url()).'/?[-_.!~*\'()a-zA-Z0-9;/?:\@&=+\$,%#]+(</a>)?(</p>)?(<br ?/?>)?}im', $the_content,$m);    //マッチしたURL一つ一つをループしてカードを作成
    //var_dump($res);
    foreach ($m[0] as $match) {
      $url = strip_tags($match);//URL
      $tag = url_to_blog_card_tag($url);
      if ( !$tag ) continue;//IDを取得できない場合はループを飛ばす

      //本文中のURLをブログカードタグで置換
      $the_content = preg_replace('{'.preg_quote($match).'}', $tag , $the_content, 1);
      wp_reset_postdata();

    }
  }
  return $the_content;//置換後のコンテンツを返す
}
endif;
if ( is_blog_card_enable() ) {
  add_filter('the_content', 'url_to_blog_card', 9999999);//本文表示をフック
  add_filter('widget_text', 'url_to_blog_card', 9999999);//テキストウィジェットをフック
  //add_filter('comment_text', 'url_to_blog_card', 9999999);//コメントをフック
}

//本文中のURLショートコードをブログカードタグに変更する
if ( !function_exists( 'url_shortcode_to_blog_card' ) ):
function url_shortcode_to_blog_card($the_content) {
  if ( true /*is_singular()*/ ) {//投稿ページもしくは固定ページのとき
    //1行にURLのみが期待されている行（URL）を全て$mに取得
    $res = preg_match_all('/\[https?:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+\]/im', $the_content, $m);
    foreach ($m[0] as $match) {
    //マッチしたURL一つ一つをループしてカードを作成
      $url = strip_tags($match);//URL
      $url = preg_replace('/[\[\]]/', '', $url);//[と]の除去
      $url = str_replace('?', '%3F', $url);//?をエンコード

      //取得した内部URLからブログカードのHTMLタグを作成
      $tag = url_to_blog_card_tag($url);//外部ブログカードタグに変換
      //URLをブログカードに変換
      if ( !$tag ) {//取得したURLが外部URLだった場合
        $tag = url_to_external_blog_card($url);//外部ブログカードタグに変換
      }
      if ( $tag ) {//内部・外部ブログカードどちらかでタグを作成できた場合
        //本文中のURLをブログカードタグで置換
        $the_content = preg_replace('{'.preg_quote($match).'}', $tag , $the_content, 1);
      }
    }
  }
  return $the_content;//置換後のコンテンツを返す
}
endif;
add_filter('the_content', 'url_shortcode_to_blog_card' ,9999999);//本文表示をフック
add_filter('widget_text', 'url_shortcode_to_blog_card' ,9999999);//テキストウィジェットをフック
//add_filter('comment_text', 'url_shortcode_to_blog_card', 9999999);//コメントをフック

//外部URLからブログをカードタグの取得
if ( !function_exists( 'url_to_external_blog_card_tag' ) ):
function url_to_external_blog_card_tag($url){
  $url = strip_tags($url);//URL

  //サイトの内部リンクは処理しない場合
  if ( strpos( $url, get_this_site_domain() ) ) {
    $id = url_to_postid( $url );//IDを取得（URLから投稿ID変換
    if ( $id ) {//IDを取得できる場合はループを飛ばす
      return;
    }//IDが取得できない場合は外部リンクとして処理する
  }

  $tag = '';
  if ( is_blog_card_external_hatena() ) {
    //取得した情報からはてなブログカードのHTMLタグを作成
    $tag = '<'.'iframe '.'class="blog-card external-blog-card" src="//hatenablog-parts.com/embed?url='.$url.'"></'.'iframe'.'>';
  } elseif ( is_blog_card_external_embedly() ) {
    //取得した情報からEmbedlyブログカードのHTMLタグを作成
    $tag = '<a class="embedly-card" href="'.$url.'">'.$url.'</a><script async src="//cdn.embedly.com/widgets/platform.js" charset="UTF-8"></script>';
  }

  return $tag;
}
endif;

//本文中の外部URLをはてなブログカードタグに変更する
if ( !function_exists( 'url_to_external_blog_card' ) ):
function url_to_external_blog_card($the_content) {
  if ( is_singular() ) {//投稿ページもしくは固定ページのとき
    //1行にURLのみが期待されている行（URL）を全て$mに取得
    $res = preg_match_all('/^(<p>)?(<a.+?>)?https?:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+(<\/a>)?(<\/p>)?(<br ? \/>)?$/im', $the_content,$m);
    //マッチしたURL一つ一つをループしてカードを作成
    foreach ($m[0] as $match) {
      $url = strip_tags($match);//URL

      $tag = url_to_external_blog_card_tag($url);

      if ( !$tag ) continue;

      //本文中のURLをブログカードタグで置換
      $the_content = preg_replace('{'.preg_quote($match).'}', $tag , $the_content, 1);
    }
  }
  return $the_content;//置換後のコンテンツを返す
}
endif;
if ( is_blog_card_external_enable() ) {//外部リンクブログカードが有効のとき
  add_filter('the_content','url_to_external_blog_card', 9999999);//本文表示をフック
  add_filter('widget_text', 'url_to_external_blog_card', 9999999);//テキストウィジェットをフック
  //add_filter('comment_text', 'url_to_external_blog_card', 9999999);//コメントをフック
}
