<?php //外部リンク用のデータベースの作成など
//テスト的機能、他の方法でキャッシュ化は実現したので削除しても良い


//データベースのグローバル変数
// テーブルアップデート用テーブルバージョンの指定
global $g_external_link_table_version;
$g_external_link_table_version = "1.0";
//テーブル名
global $g_external_link_table_name;
$g_external_link_table_name = 'sp_external_links';

// require_once('OpenGraph.php');
// $graph = OpenGraph::fetch('http://www.yahoo.co.jp/');
// echo '<pre>';
// var_dump($graph);
// echo '</pre>';
// // var_dump($graph->schema);
// // foreach ($graph as $key => $value) {
// // echo '<pre>';
// //     echo "$key => $value";
// // echo '</pre>';
//

//Wordpressテーマが有効化したとき
//参考：http://goo.gl/7yhwup
function wordpress_theme_activate() {
    global $pagenow;
    if(is_admin() && $pagenow == "themes.php" && isset($_GET["activated"]))
        do_action("wordpress_theme_activate");
}
add_action("init", "wordpress_theme_activate");

//テーマを有効化した時に実行される関数
function wordpress_theme_activated() {
  //以下にテーマが有効化された時のコード
  create_external_links_table();
}
//add_action("wordpress_theme_activate", "wordpress_theme_activated");


function create_external_links_table() {
  global $wpdb;
  global $g_external_link_table_version;
  global $g_external_link_table_name;

  $sql = "";
  $charset_collate = "";

  // 接頭辞の追加（socal_count_cache）
  $table_name = $wpdb->prefix . $g_external_link_table_name;

  // charsetを指定する
  if ( !empty($wpdb->charset) )
    $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset} ";

  // 照合順序を指定する（ある場合。通常デフォルトのutf8_general_ci）
  if ( !empty($wpdb->collate) )
    $charset_collate .= "COLLATE {$wpdb->collate}";

  // SQL文でテーブルを作る
  $sql = "
    CREATE TABLE {$table_name} (
         url VARCHAR(255)  NOT NULL,
         day datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
         site_name text,
         title text,
         description text,
         image_width int DEFAULT 0,
         image_height int DEFAULT 0,
         PRIMARY KEY  (url)
    ) {$charset_collate};";//長いURLだとどうするか問題

  //dbDeltaを呼び出すのに必要
  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  dbDelta( $sql );

  update_option( 'external_link_table_version', $g_external_link_table_version );
}

function delete_external_links_table() {
  global $wpdb;
  global $g_external_link_table_name;

  $table_name = $wpdb->prefix . $g_external_link_table_name;

  $wpdb->query("DROP TABLE IF EXISTS $table_name");

  delete_option( "external_link_table_version" );
}
//add_action("switch_theme", "delete_external_links_table");