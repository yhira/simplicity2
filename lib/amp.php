<?php

//AMP判別関数
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