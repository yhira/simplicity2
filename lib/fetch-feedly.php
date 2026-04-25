<?php //feedlyカウントの非同期取得用
//外部のphpからWordpress のAPIを扱う
require_once('../../../../wp-load.php');
//SNS用カウント取得関数の呼び出し
require_once('sns.php');

//URLパラメーターの検証（SSRF防止）
if (!isset($_GET['url']) || !filter_var($_GET['url'], FILTER_VALIDATE_URL)) {
  echo '0';
  exit;
}
$url = esc_url_raw($_GET['url']);
//http/httpsスキームのみ許可
if (!preg_match('/^https?:\/\//', $url)) {
  echo '0';
  exit;
}
//プライベートIPアドレスへのリクエストをブロック
$host = parse_url($url, PHP_URL_HOST);
if ($host) {
  $ip = gethostbyname($host);
  if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
    echo '0';
    exit;
  }
}
echo fetch_feedly_count($url);
