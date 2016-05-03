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
    // //$wp_filesystemオブジェクトのメソッドとして呼び出す
    // $html = $wp_filesystem->get_contents($query);
    // $dom = new DOMDocument('1.0', 'UTF-8');
    // $dom->preserveWhiteSpace = false;
    // $dom->loadHTML($html);
    // $xpath = new DOMXPath($dom);
    // $result = $xpath->query('//em[@id = "cnt"]')->item(0);
    // return isset($result->nodeValue) ? intval($result->nodeValue) : 0;

  }
  return 0;
}
