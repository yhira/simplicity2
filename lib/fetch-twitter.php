<?php //Pocketカウントの非同期取得用
//外部のphpからWordpress のAPIを扱う
require_once('../../../../wp-load.php');
// //WP_Filesystemの使用
// require_once('../../../../wp-admin/includes/file.php');
//SNS用カウント取得関数の呼び出し
require_once('sns.php');

//URLパラメーターの取得
$url = $_GET['url'];
echo fetch_twitter_count($url);
