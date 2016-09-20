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
  if(is_single() &&
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
  $the_content = preg_replace('/ +style=[\'"][^\'"]*?[\'"]/i', '', $the_content);

  $the_content = preg_replace('/<img/i', '<amp-img layout="responsive"', $the_content);

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