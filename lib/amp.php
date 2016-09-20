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

if ( !function_exists( 'remove_inline_style_attributes' ) ):
function remove_inline_style_attributes($the_content){
  if ( !is_amp() ) {
    return $the_content;
  }
  return preg_replace('/ +style=[\'"][^\'"]*?[\'"]/i', '', $the_content);
}
endif;
add_filter('the_content','remove_inline_style_attributes');