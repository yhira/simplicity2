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


  //カエレバ・ヨメレバの商品画像にwidthとhightを追加する
  $the_content = preg_replace('/ src="http:\/\/ecx.images-amazon.com/i', ' width="75" height="75" sizes="(max-width: 75px) 75vw, 75px" src="http://ecx.images-amazon.com', $the_content);
  //カエレバ・ヨメレバの商品画像にwidthとhightを追加する（SSL用）
  $the_content = preg_replace('/ src="https:\/\/images-fe.ssl-images-amazon.com/i', ' width="75" height="75" sizes="(max-width: 75px) 75vw, 75px" src="https://images-fe.ssl-images-amazon.com', $the_content);

  //画像タグをAMP用に置換
  $the_content = preg_replace('/<img/i', '<amp-img layout="responsive"', $the_content);

  // Twitterをamp-twitterに置換する（自動埋め込み）
  $pattern = '/<p>https:\/\/twitter.com\/.*\/status\/(.*).*<\/p>/i';
  $append = '<p><amp-twitter width=592 height=472 layout="responsive" data-tweetid="$1"></amp-twitter></p>';
  $the_content = preg_replace($pattern, $append, $the_content);

  // Twitterをamp-twitterに置換する（埋め込みコード）
  $pattern = '/<blockquote class="twitter-tweet".*>.*<a href="https:\/\/twitter.com\/.*\/status\/(.*).*<\/blockquote>.*<script async src="\/\/platform.twitter.com\/widgets.js" charset="utf-8"><\/script>/i';
  $append = '<p><amp-twitter width=592 height=472 layout="responsive" data-tweetid="$1"></amp-twitter></p>';
  $the_content = preg_replace($pattern, $append, $the_content);

  // vineをamp-vineに置換する
  $pattern = '/<div class=\'embed-container\'><iframe width=\'100%\' src=\'https:\/\/vine.co\/v\/(.*)\/embed\/simple\'.*<\/div>/i';
  $append = '<div class=\'embed-container\'><amp-vine data-vineid="$1" width="592" height="592" layout="responsive"></amp-vine></div>';
  $the_content = preg_replace($pattern, $append, $the_content);

  // Instagramをamp-instagramに置換する
  $pattern = '/<div class=\'embed-container\'><iframe src=\'\/\/instagram.com\/p\/(.*)\/embed\/\'.*<\/iframe><\/div>/i';
  $append = '<div class=\'embed-container\'><amp-instagram layout="responsive" data-shortcode="$1" width="592" height="716" ></amp-instagram></div>';
  $the_content = preg_replace($pattern, $append, $the_content);

  // YouTubeを置換する（自動埋め込み）
  $pattern = '/<div class="youtube">.*https:\/\/youtu.be\/(.*).*<\/div>/i';
  $append = '<div class="youtube"><amp-youtube layout="responsive" data-videoid="$1" width="592" height="363"></amp-youtube></div>';
  $the_content = preg_replace($pattern, $append, $the_content);

  // YouTubeを置換する（埋め込みコード）
  $pattern = '/<div class="youtube">.*<iframe width="853" height="480" src="https:\/\/www.youtube.com\/embed\/(.*)" frameborder="0" allowfullscreen><\/iframe>.*<\/div>/i';
  $append = '<div class="youtube"><amp-youtube layout="responsive" data-videoid="$1" width="592" height="363"></amp-youtube></div>';
  $the_content = preg_replace($pattern, $append, $the_content);

  // iframeをamp-iframeに置換する
  $pattern = '/<iframe/i';
  $append = '<amp-iframe layout="responsive"';
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