<?php //SNS関係の関数

//はてブするときに使用するエンコードしたURL
function get_encoded_url($url){
  return urlencode(mb_convert_encoding($url, "UTF-8"));
}

//はてブするときに使用するエンコードしたタイトル
function get_encoded_title($title){
  return urlencode(mb_convert_encoding($title, "UTF-8"));
}

//はてブURL
function get_hatebu_url($url){
  $u = preg_replace('/https?:\/\//', '', $url);
  return 'http://b.hatena.ne.jp/entry/'.$u;
}

//Twitter IDを含めるURLパラメータを取得
function get_twitter_via_param(){
  if ( is_twitter_id_include() && get_twitter_follow_id() ) {
    return '&amp;via='.get_twitter_follow_id();
  }
}

//ツイート後にフォローを促すパラメータを取得
function get_twitter_related_param(){
  if ( is_twitter_related_follow_enable() && get_twitter_follow_id() ) {
    return '&amp;related='.get_twitter_follow_id();//.':フォロー用の説明文';
  }
}

//feedlyの購読者数取得
function fetch_feedly_count(){
  $feed_url = rawurlencode( get_bloginfo( 'rss2_url' ) );
  $res = '0';
  $subscribers = wp_remote_get( "http://cloud.feedly.com/v3/feeds/feed%2F$feed_url" );
  if (!is_wp_error( $subscribers ) && $subscribers["response"]["code"] === 200) {
    $subscribers = json_decode( $subscribers['body'] );
    if ( $subscribers ) {
      $subscribers = $subscribers->subscribers;
      set_transient( 'feedly_subscribers', $subscribers, 60 * 60 * 12 );
      $res = ($subscribers ? $subscribers : '0');
    }
  }
  return $res;
}

//不具合対策用のfeedlyの購読者数取得の別名
function get_feedly_count(){
  return fetch_feedly_count();
}

//Google＋カウントの取得
function fetch_google_plus_count($url) {
  $query = 'https://apis.google.com/_/+1/fastbutton?url=' . urlencode( $url );
  //URL（クエリ）先の情報を取得
  $result = wp_remote_get($query);
  // 正規表現でカウント数のところだけを抽出
  preg_match( '/\[2,([0-9.]+),\[/', $result["body"], $count );
  // 共有数を表示
  return isset($count[1]) ? intval($count[1]) : 0;
}

//Pocketカウントの取得
function fetch_pocket_count($url) {
  if ( WP_Filesystem() ) {//WP_Filesystemの初期化
    global $wp_filesystem;//$wp_filesystemオブジェクトの呼び出し
    $query = 'http://widgets.getpocket.com/v1/button?v=1&count=horizontal&url=' . $url;
    //URL（クエリ）先の情報を取得
    $result = wp_remote_get($query);
    //var_dump($result["body"]);
    // 正規表現でカウント数のところだけを抽出
    preg_match( '/<em id="cnt">([0-9.]+)<\/em>/i', $result["body"], $count );
    // 共有数を表示
    return isset($count[1]) ? intval($count[1]) : 0;
  }
  return 0;
}

//count.jsoonからTwitterのツイート数を取得
function fetch_twitter_count($url){
  $url = rawurlencode( $url );
  $subscribers = wp_remote_get( "//jsoon.digitiminimi.com/twitter/count.json?url=$url" );
  $res = '0';
  if (!is_wp_error( $subscribers ) && $subscribers["response"]["code"] === 200) {
       $body = $subscribers['body'];
    $json = json_decode( $body );
    $res = ($json->{"count"} ? $json->{"count"} : '0');
  }
  return $res;
}

//SNS Count Cacheプラグインはインストールされているか
function scc_exists(){
  return function_exists('scc_get_share_twitter');
}

//ツイート数取得関数が存在しているか
function scc_twitter_exists(){
  return function_exists('scc_get_share_twitter');
}

//Facebookシェア数取得関数が存在しているか
function scc_facebook_exists(){
  return function_exists('scc_get_share_facebook');
}

//Google＋シェア数取得関数が存在しているか
function scc_gplus_exists(){
  return function_exists('scc_get_share_gplus');
}

//はてブ数取得関数が存在しているか
function scc_hatebu_exists(){
  return function_exists('scc_get_share_hatebu');
}

//Pocketストック数取得関数が存在しているか
function scc_pocket_exists(){
  return function_exists('scc_get_share_pocket');
}

//トータルシェア数取得関数が存在しているか
function scc_total_exists(){
  return function_exists('scc_get_share_total');
}

//feedly購読者数取得関数が存在しているか
function scc_feedly_exists(){
  return function_exists('scc_get_follow_feedly');
}