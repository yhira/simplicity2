<?php

//AMP判別関数
if ( !function_exists( 'is_amp' ) ):
function is_amp(){
  global $post;
  //var_dump(is_single());
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
     $_GET['amp'] === '1' &&
     strpos($content,'<script>') === false
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
  //style属性を取り除く
  $the_content = preg_replace('/ +style=["][^"]*?["]/i', '', $the_content);
  $the_content = preg_replace('/ +style=[\'][^\']*?[\']/i', '', $the_content);

  //target属性を取り除く
  $the_content = preg_replace('/ +target=["][^"]*?["]/i', '', $the_content);
  $the_content = preg_replace('/ +target=[\'][^\']*?[\']/i', '', $the_content);

  //onclick属性を取り除く
  $the_content = preg_replace('/ +onclick=["][^"]*?["]/i', '', $the_content);
  $the_content = preg_replace('/ +onclick=[\'][^\']*?[\']/i', '', $the_content);

  //カエレバ・ヨメレバの商品画像にwidthとhightを追加する
  $the_content = preg_replace('/ src="http:\/\/ecx.images-amazon.com/i', ' width="75" height="75" sizes="(max-width: 75px) 75vw, 75px" src="http://ecx.images-amazon.com', $the_content);
  //カエレバ・ヨメレバの商品画像にwidthとhightを追加する（SSL用）
  $the_content = preg_replace('/ src="https:\/\/images-fe.ssl-images-amazon.com/i', ' width="75" height="75" sizes="(max-width: 75px) 75vw, 75px" src="https://images-fe.ssl-images-amazon.com', $the_content);

  //画像タグをAMP用に置換
  $the_content = preg_replace('/<img/i', '<amp-img layout="responsive"', $the_content);

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
  $pattern = '/<iframe.+?src="https:\/\/www.youtube.com\/embed\/(.+?)".*?><\/iframe>/is';
  $append = '<amp-youtube layout="responsive" data-videoid="$1" width="800" height="450"></amp-youtube>';
  $the_content = preg_replace($pattern, $append, $the_content);

  // iframeをamp-iframeに置換する
  $pattern = '/<iframe/i';
  $append = '<amp-iframe layout="responsive"';
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
if ( !function_exists( 'get_amp_adsense_code' ) ):
function get_amp_adsense_code(){
  $adsense_code = null;
  if ( is_active_sidebar( 'adsense-300' ) ) {
    ob_start();
    dynamic_sidebar('adsense-300');
    $ad300 = ob_get_clean();
    preg_match('/data-ad-client="(ca-pub-[^"]+?)"/i', $ad300, $m);
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