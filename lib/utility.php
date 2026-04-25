<?php

//ローカルのテスト環境かどうか
if ( !function_exists( 'is_local_test' ) ) {
function is_local_test(){
  //WP-CLIやCron環境ではSERVER_NAMEが未定義の場合がある
  $host = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '';
  if ( $host == 'localhost' || $host == '127.0.0.1' ) {
    return true;
  }
}
}


//ページのURLを取得（ページャーの2ページ目なども取得できる）
if ( !function_exists( 'get_this_page_url' ) ) {
function get_this_page_url(){
  //WP-CLIやCron環境ではHTTP_HOST等が未定義の場合がある
  $host = isset($_SERVER["HTTP_HOST"]) ? $_SERVER["HTTP_HOST"] : '';
  $uri = isset($_SERVER["REQUEST_URI"]) ? $_SERVER["REQUEST_URI"] : '';
  return (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $host . $uri;
}
}


//サイトのドメインを取得
if ( !function_exists( 'get_this_site_domain' ) ) {
function get_this_site_domain(){
  // //ドメイン情報を$results[1]に取得する
  preg_match( '/https?:\/\/(.+?)\//i', admin_url(), $results );
  return $results[1];
}
}


//ログインユーザー名と表示名が同じか
if ( !function_exists( 'is_login_name_and_display_name_same' ) ) {
function is_login_name_and_display_name_same(){
  return get_the_author_meta('user_login') == get_the_author_meta('display_name');
}
}


//URLからドメインを取得
if ( !function_exists( 'get_domain_name' ) ):
function get_domain_name($url){
  if (empty($url)) return;
  return parse_url($url, PHP_URL_HOST);
}
endif;

//フォルダごとファイルを全て削除
if ( !function_exists( 'remove_directory' ) ) {
function remove_directory($dir) {
  //ディレクトリが存在しないときは何もしない
  if ( !file_exists($dir) ) {
    return ;
  }
  //ディレクトリが存在する時はすべて削除する
  if ($handle = opendir("$dir")) {
    while (false !== ($item = readdir($handle))) {
      if ($item != "." && $item != "..") {
        if (is_dir("$dir/$item")) {
          remove_directory("$dir/$item");
        } else {
          unlink("$dir/$item");
        }
      }
    }
  closedir($handle);
  rmdir($dir);
  }
}
}


//拡張子のみを取得する
if ( !function_exists( 'get_extention' ) ):
function get_extention($filename){
  return preg_replace('/^.*\.([^.]+)$/D', '$1', $filename);
}
endif;

//ファイル名のみを取得する
if ( !function_exists( 'get_basename' ) ):
function get_basename($filename){
  $p = pathinfo($filename);
  return basename ( $filename, ".{$p['extension']}" );
}
endif;

if ( !function_exists( 'is_bbpress_page' ) ):
function is_bbpress_page(){
  if (function_exists('bbp_is_topic')) {
    if (bbp_is_topic() ||
        bbp_is_forum() ||
        bbp_is_forum_archive() ||
        bbp_is_single_forum() ||
        bbp_is_forum_edit() ||
        bbp_is_single_topic() ||
        bbp_is_topic_archive() ||
        bbp_is_topic_edit() ||
        bbp_is_topic_tag() ||
        bbp_is_topic_tag_edit() ||
        bbp_is_reply()||
        bbp_is_reply_edit() ||
        bbp_is_single_reply() ||
        bbp_is_favorites() ||
        bbp_is_subscriptions()) {
      return true;
    }
  }
}
endif;

//配列内の数値をマイナスにする
if ( !function_exists( 'minusize_number_in_array' ) ) {
function minusize_number_in_array($number_array){
  if (empty($number_array)) {
    return null;
  }
  $number_array = str_replace(' ', '', $number_array);
  $numbers = explode(',', $number_array);
  foreach($numbers as &$value){
    $value = intval($value) * -1;
  }
  return implode(',', $numbers);
}
}


//ブログカード用のURLデコード
if ( !function_exists( 'ampersand_urldecode' ) ):
function ampersand_urldecode($url){
  //$url = urldecode($url);//urlエンコードされている場合に元に戻す（?が&amp;になっている時など）
  $url = str_replace('&amp;', '&', $url);
  $url = str_replace('#038;', '&', $url);
  return $url;
}
endif;