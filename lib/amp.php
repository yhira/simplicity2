<?php

//AMP判別関数
function is_amp(){
  global $post;

  //AMPチェック
  $is_amp = false;
  $content = $post->post_content;
  if ( empty($_GET['amp']) ) {
    return false;
  }

  // ampのパラメーターが1かつ記事の中に<script>タグが入っていない
  // かつsingleページのみ$is_ampをtrueにする
  if(is_single() &&
     $_GET['amp'] === '1' &&
     strpos($content,'<script>') === false){
    $is_amp = true;
  }
  return $is_amp;
}