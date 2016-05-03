<?php

//ローカルのテスト環境かどうか
function is_local_test(){
  $host = $_SERVER['SERVER_NAME'];
  if ( $host == 'localhost' || $host == '127.0.0.1' ) {
    return true;
  }
}

//ページのURLを取得（ページャーの2ページ目なども取得できる）
function get_this_page_url(){
  return (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
}

//サイトのドメインを取得
function get_this_site_domain(){
  // //ドメイン情報を$results[1]に取得する
  preg_match( '/https?:\/\/(.+?)\//i', admin_url(), $results );
  return $results[1];
}

//ログインユーザー名と表示名が同じか
function is_login_name_and_display_name_same(){
  return get_the_author_meta('user_login') == get_the_author_meta('display_name');
}
