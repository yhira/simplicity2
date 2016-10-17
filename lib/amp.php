<?php

//AMP判別関数
if ( !function_exists( 'is_amp' ) ):
function is_amp(){
  global $post;
  //var_dump(is_single());
  //bbPressがインストールされていて、トピックの時は除外
  if (function_exists('bbp_is_topic')) {
    if (bbp_is_topic()) {
      return false;
    }
  }
  //AMPチェック
  $is_amp = false;
  if ( empty($_GET['amp']) ) {
    return false;
  }
  $content = $post->post_content;

  // ampのパラメーターが1かつ記事の中に<script>タグが入っていない
  // かつsingleページのみ$is_ampをtrueにする
  if(is_amp_enable() && //AMPがカスタマイザーの有効化されているか
     is_single() &&
     $_GET['amp'] === '1'
    ){
    $is_amp = true;
  }
  return $is_amp;
}
endif;

//AMP用にコンテンツを変換する
if ( !function_exists( 'convert_content_for_amp' ) ):
function convert_content_for_amp($the_content){
  if ( !is_amp() ) {
    return $the_content;
  }

  //C2A0文字コード（UTF-8の半角スペース）を通常の半角スペースに置換
  $the_content = str_replace('\xc2\xa0', ' ', $the_content);

  //style属性を取り除く
  $the_content = preg_replace('/ +style=["][^"]*?["]/i', '', $the_content);
  $the_content = preg_replace('/ +style=[\'][^\']*?[\']/i', '', $the_content);

  //target属性を取り除く
  $the_content = preg_replace('/ +target=["][^"]*?["]/i', '', $the_content);
  $the_content = preg_replace('/ +target=[\'][^\']*?[\']/i', '', $the_content);

  //onclick属性を取り除く
  $the_content = preg_replace('/ +onclick=["][^"]*?["]/i', '', $the_content);
  $the_content = preg_replace('/ +onclick=[\'][^\']*?[\']/i', '', $the_content);

  //FONTタグを取り除く
  $the_content = preg_replace('/<font[^>]+?>/i', '', $the_content);
  $the_content = preg_replace('/<\/font>/i', '', $the_content);

  //カエレバ・ヨメレバのAmazon商品画像にwidthとhightを追加する
  $the_content = preg_replace('/ src="http:\/\/ecx.images-amazon.com/i', ' width="75" height="75" sizes="(max-width: 75px) 75vw, 75px" src="http://ecx.images-amazon.com', $the_content);
  //カエレバ・ヨメレバのAmazon商品画像にwidthとhightを追加する（SSL用）
  $the_content = preg_replace('/ src="https:\/\/images-fe.ssl-images-amazon.com/i', ' width="75" height="75" sizes="(max-width: 75px) 75vw, 75px" src="https://images-fe.ssl-images-amazon.com', $the_content);
  //カエレバ・ヨメレバの楽天商品画像にwidthとhightを追加する
  $the_content = preg_replace('/ src="http:\/\/thumbnail.image.rakuten.co.jp/i', ' width="75" height="75" sizes="(max-width: 75px) 75vw, 75px" src="http://thumbnail.image.rakuten.co.jp', $the_content);
  //カエレバ・ヨメレバのYahoo!ショッピング商品画像にwidthとhightを追加する
  $the_content = preg_replace('/ src="http:\/\/item.shopping.c.yimg.jp/i', ' width="75" height="75" sizes="(max-width: 75px) 75vw, 75px" src="http://item.shopping.c.yimg.jp', $the_content);

  //画像タグをAMP用に置換
  $the_content = preg_replace('/<img/i', '<amp-img', $the_content);

  // Twitterをamp-twitterに置換する（埋め込みコード）
  $pattern = '/<blockquote class="twitter-tweet".*?>.+?<a href="https:\/\/twitter.com\/.*?\/status\/(.*?)">.+?<\/blockquote>.*?<script async src="\/\/platform.twitter.com\/widgets.js" charset="utf-8"><\/script>/is';
  $append = '<p><amp-twitter width=592 height=472 layout="responsive" data-tweetid="$1"></amp-twitter></p>';
  $the_content = preg_replace($pattern, $append, $the_content);

  // vineをamp-vineに置換する
  $pattern = '/<iframe[^>]+?src="https:\/\/vine.co\/v\/(.+?)\/embed\/simple".+?><\/iframe>/is';
  $append = '<p><amp-vine data-vineid="$1" width="592" height="592" layout="responsive"></amp-vine></p>';
  $the_content = preg_replace($pattern, $append, $the_content);

  // Instagramをamp-instagramに置換する
  $pattern = '/<blockquote class="instagram-media".+?"https:\/\/www.instagram.com\/p\/(.+?)\/".+?<\/blockquote>/is';
  $append = '<p><amp-instagram layout="responsive" data-shortcode="$1" width="592" height="592" ></amp-instagram></p>';
  $the_content = preg_replace($pattern, $append, $the_content);

  // YouTubeを置換する（埋め込みコード）
  $pattern = '/<iframe.+?src="https:\/\/www.youtube.com\/embed\/(.+?)(\?feature=oembed)?".*?><\/iframe>/is';
  $append = '<amp-youtube layout="responsive" data-videoid="$1" width="800" height="450"></amp-youtube>';
  $the_content = preg_replace($pattern, $append, $the_content);

  // iframeをamp-iframeに置換する
  $pattern = '/<iframe/i';
  $append = '<amp-iframe layout="responsive"';
  $the_content = preg_replace($pattern, $append, $the_content);
  $pattern = '/<\/iframe>/i';
  $append = '</amp-iframe>';
  $the_content = preg_replace($pattern, $append, $the_content);

  //スクリプトを除去する
  $pattern = '/<script.+?<\/script>/is';
  $append = '';
  $the_content = preg_replace($pattern, $append, $the_content);

  return $the_content;
}
endif;
add_filter('the_content','convert_content_for_amp', 999999999);

//テンプレートの中身をAMP化する
if ( !function_exists( 'get_template_part_amp' ) ):
function get_template_part_amp($template_name){
  ob_start();//バッファリング
  get_template_part($template_name);//テンプレートの呼び出し
  $template = ob_get_clean();//テンプレート内容を変数に代入
  $template = convert_content_for_amp($template);
  echo $template;
}
endif;

//AMP用のAdSenseコードを取得する
if ( !function_exists( 'generate_amp_adsense_code' ) ):
function generate_amp_adsense_code(){
  $adsense_code = null;
  if ( is_active_sidebar( 'adsense-300' ) ) {
    $ad300 = get_amp_adsense_code();
    ob_start();
    dynamic_sidebar('adsense-300');
    $ad300 .= ob_get_clean();
    //var_dump(htmlspecialchars($ad300));
    preg_match('/data-ad-client="(ca-pub-[^"]+?)"/i', $ad300, $m);
    if (empty($m[1])) return;
    $data_ad_client = $m[1];
    if (!$data_ad_client) return;
    preg_match('/data-ad-slot="([^"]+?)"/i', $ad300, $m);
    $data_ad_slot = $m[1];
    if (!$data_ad_slot) return;
    $adsense_code = '<amp-ad width="300" height="250" type="adsense" data-ad-client="'.$data_ad_client.'" data-ad-slot="'.$data_ad_slot.'"></amp-ad>';
    //var_dump(htmlspecialchars($adsense_code));
  }
  return $adsense_code;
}
endif;

//最初のH2の手前に広告を挿入（最初のH2を置換）
if ( !function_exists( 'add_ads_before_1st_h2_in_amp' ) ):
function add_ads_before_1st_h2_in_amp($the_content) {
  if ( is_amp() ) {//AMPの時のみ有効
    //広告（AdSense）タグを記入
    ob_start();//バッファリング
    get_template_part('ad-amp');//広告貼り付け用に作成したテンプレート
    $ad_template = ob_get_clean();
    $h2result = get_h2_included_in_body( $the_content );//本文にH2タグが含まれていれば取得
    if ( $h2result ) {//H2見出しが本文中にある場合のみ
      //最初のH2の手前に広告を挿入（最初のH2を置換）
      $count = 1;
      $the_content = preg_replace(H2_REG, $ad_template.$h2result, $the_content, $count);
    }
  }
  return $the_content;
}
endif;
add_filter('the_content','add_ads_before_1st_h2_in_amp');

//AMP用のURLを取得する
if ( !function_exists( 'get_amp_permalink' ) ):
function get_amp_permalink(){
  $permalink = get_permalink();
  //URLの中に?が存在しているか
  if (strpos($permalink,'?') !== false) {
    $amp_permalink = $permalink.'&amp;amp=1';
  } else {
    $amp_permalink = $permalink.'?amp=1';
  }
  return $amp_permalink;
}
endif;

//画像URLから幅と高さを取得する（同サーバー内ファイルURLのみ）
function get_image_width_and_height($image_url){
  $wp_upload_dir = wp_upload_dir();
  $uploads_dir = $wp_upload_dir['basedir'];
  $uploads_url = $wp_upload_dir['baseurl'];
  $image_file = str_replace($uploads_url, $uploads_dir, $image_url);
  $imagesize = getimagesize($image_file);
  if ($imagesize) {
    $res = array();
    $res['width'] = $imagesize[0];
    $res['height'] = $imagesize[1];
    return $res;
  }
}