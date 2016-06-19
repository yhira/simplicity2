<?php //feedlyカウントの非同期取得用
//外部のphpからWordpress のAPIを扱う
require_once('../../../../wp-load.php');
//SNS用カウント取得関数の呼び出し
require_once('sns.php');

//URLパラメーターの取得
$url = $_GET['url'];
echo fetch_feedly_count($url);
