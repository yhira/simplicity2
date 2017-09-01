<?php //ウイジェットエリア用の関数

/////////////////////////////////////
// ウィジェットエリアの指定
/////////////////////////////////////

register_sidebars(1,
  array(
  'name' => __( 'サイドバーウイジェット', 'simplicity2' ),
  'id' => 'sidebar-1',
  'description' => __( 'サイドバーのウィジットエリアです。', 'simplicity2' ),
  'before_widget' => '<aside id="%1$s" class="widget %2$s">',
  'after_widget' => '</aside>',
  'before_title'  => '<h3 class="widget_title sidebar_widget_title">',
  'after_title'   => '</h3>',
));

register_sidebars(1,
  array(
  'name' => __( 'スクロール追従領域', 'simplicity2' ),
  'id' => 'sidebar-scroll',
  'description' => __( 'サイドバーで下にスクロールすると追いかけてくるエリアです。※モバイルでは表示されません。（ここにGoogle AdSenseを貼るのはポリシー違反です。）', 'simplicity2' ),
  'before_widget' => '<aside id="%1$s" class="widget %2$s">',
  'after_widget' => '</aside>',
  'before_title' => '<h3 class="widget_title sidebar_widget_title">',
  'after_title' => '</h3>',
));

register_sidebars(1,
  array(
  'name' => __( '広告 336x280', 'simplicity2' ),
  'id' => 'adsense-336',
  'description' => __( '「テキスト」ウィジェットを用いて、336×280pxの広告を入力してください。主にパソコン向け。（※「広告」ウィジェットは使用しないでください）', 'simplicity2' ),
  'before_widget' => '',
  'after_widget' => '',
  'before_title' => '<div class="widget-ad">',
  'after_title' => '</div>',
));

register_sidebars(1,
  array(
  'name' => __( '広告 300x250', 'simplicity2' ),
  'id' => 'adsense-300',
  'description' => __( '「テキスト」ウィジェットを用いて、300×250pxの広告を入力してください。主にモバイル向け。コードはAMP広告にも使用されます。（※「広告」ウィジェットは使用しないでください）', 'simplicity2' ),
  'before_widget' => '',
  'after_widget' => '',
  'before_title' => '<div class="widget-ad">',
  'after_title' => '</div>',
));

if ( is_ads_performance_visible() ):
  if ( !is_ads_custum_ad_space() ) {//ビッグバナーのとき
    $adw_name = __( '広告 728×90', 'simplicity2' );
    $adw_desc = __( '広告が2つしか表示されていないPC表示ページのトップにビッグバナーを表示します。「テキスト」ウィジェットを用いて728×90のビッグバナー入力推奨です。完全レスポンシブのときは設定しても表示されません。（デフォルト状態をなるべくシンプルにするためカスタマイザーから設定しないと、このウイジェット設定は表示されません。）', 'simplicity2' );
  } else {//カスタム広告の時
    $adw_name = __( '広告 custum 680×150など', 'simplicity2' );
    $adw_desc = __( '広告が2つしか表示されていないPC表示ページのトップにカスタムサイズ広告を表示します。「テキスト」ウィジェットを用いて680×150等の入力推奨です。完全レスポンシブのときは設定しても表示されません。（デフォルト状態をなるべくシンプルにするためカスタマイザーから設定しないと、このウイジェット設定は表示されません。）', 'simplicity2' );
  }
  register_sidebars(1,
    array(
    'name' => $adw_name,
    'id' => 'adsense-728',
    'description' => $adw_desc,
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<div class="widget-ad">',
    'after_title' => '</div>',
  ));

  register_sidebars(1,
    array(
    'name' => __( '広告 320x100', 'simplicity2' ),
    'id' => 'adsense-320',
    'description' => __( '広告が2つしか表示されていないモバイルページのトップにラージモバイルバナーを表示します。「テキスト」ウィジェットを用いて320×100のラージモバイルバナー入力推奨です。完全レスポンシブのときは設定しても表示されません。（デフォルト状態をなるべくシンプルにするためカスタマイザーから設定しないと、このウイジェット設定は表示されません。）', 'simplicity2' ),
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<div class="widget-ad">',
    'after_title' => '</div>',
  ));
endif;

//if ( is_responsive_enable() ):
//  register_sidebars(1,
//    array(
//    'name'=> __( '広告 レスポンシブ', 'simplicity2' ),
//    'id' => 'adsense-responsive',
//    'description' => __( 'レスポンシブ広告設置用のウイジェットです。', 'simplicity2' ),
//    'before_widget' => '',
//    'after_widget' => '',
//    'before_title' => '<div class="widget-ad">',
//    'after_title' => '</div>',
//  ));
//endif;

register_sidebars(1,
  array(
  'name' => __( '投稿パンくずリスト上', 'simplicity2' ),
  'id' => 'widget-over-breadcrumbs',
  'description' => __( '投稿のパンくずリスト上に表示されるウイジェット。設定しないと表示されません。', 'simplicity2' ),
  'before_widget' => '<div id="%1$s" class="widget-over-breadcrumbs %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<div class="widget-over-breadcrumbs-title main-widget-label">',
  'after_title' => '</div>',
));
register_sidebars(1,
  array(
  'name' => __( '投稿タイトル上', 'simplicity2' ),
  'id' => 'widget-over-articletitle',
  'description' => __( '投稿タイトル上に表示されるウイジェット。設定しないと表示されません。', 'simplicity2' ),
  'before_widget' => '<div id="%1$s" class="widget-over-articletitle %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<div class="widget-over-article-title main-widget-label">',
  'after_title' => '</div>',
));

register_sidebars(1,
  array(
  'name' => __( '投稿本文上', 'simplicity2' ),
  'id' => 'widget-over-article',
  'description' => __( '投稿本文上に表示されるウイジェット。設定しないと表示されません。', 'simplicity2' ),
  'before_widget' => '<div id="%1$s" class="widget-over-article %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<div class="widget-over-article-title main-widget-label">',
  'after_title' => '</div>',
));

register_sidebars(1,
  array(
  'name' => __( '投稿本文中', 'simplicity2' ),
  'id' => 'widget-in-article',
  'description' => __( '投稿本文中に表示されるウイジェット。文中最初のH2タグの手前に表示されます。広告が表示されている場合は、広告の下に表示されます。設定しないと表示されません。', 'simplicity2' ),
  'before_widget' => '<div id="%1$s" class="widget-in-article %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<div class="widget-in-article-title main-widget-label">',
  'after_title' => '</div>',
));

register_sidebars(1,
  array(
  'name' => __( '投稿本文下', 'simplicity2' ),
  'id' => 'widget-under-article',
  'description' => __( '投稿本文下に表示されるウイジェット。設定しないと表示されません。', 'simplicity2' ),
  'before_widget' => '<div id="%1$s" class="widget-under-article %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<div class="widget-under-article-title main-widget-label">',
  'after_title' => '</div>',
));

register_sidebars(1,
  array(
  'name' => __( '投稿SNSボタン上', 'simplicity2' ),
  'id' => 'widget-over-sns-buttons',
  'description' => __( '投稿のメインカラムの一番下となるSNSボタンの上に表示されるウイジェット。広告を表示している場合は、広告の下になります。設定しないと表示されません。', 'simplicity2' ),
  'before_widget' => '<div id="%1$s" class="widget-over-sns-buttons %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<div class="widget-over-sns-buttons-title main-widget-label">',
  'after_title' => '</div>',
));

register_sidebars(1,
  array(
  'name' => __( '投稿SNSボタン下', 'simplicity2' ),
  'id' => 'widget-under-sns-buttons',
  'description' => __( '投稿のメインカラムの一番下となるSNSボタンの下に表示されるウイジェット。設定しないと表示されません。', 'simplicity2' ),
  'before_widget' => '<div id="%1$s" class="widget-under-sns-buttons %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<div class="widget-under-sns-buttons-title main-widget-label">',
  'after_title' => '</div>',
));

register_sidebars(1,
  array(
  'name' => __( '投稿関連記事下', 'simplicity2' ),
  'id' => 'widget-under-related-entries',
  'description' => __( '関連記事の下（広告を表示している場合はその下）に表示されるウイジェット。設定しないと表示されません。', 'simplicity2' ),
  'before_widget' => '<div id="%1$s" class="widget-under-related-entries %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<div class="widget-under-related-entries-title main-widget-label">',
  'after_title' => '</div>',
));

register_sidebars(1,
  array(
  'name' => __( '固定ページ本文上', 'simplicity2' ),
  'id' => 'widget-over-page-article',
  'description' => __( '固定ページ本文上に表示されるウイジェット。設定しないと表示されません。', 'simplicity2' ),
  'before_widget' => '<div id="%1$s" class="widget-over-page-article %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<div class="widget-over-page-article-title main-widget-label">',
  'after_title' => '</div>',
));

register_sidebars(1,
  array(
  'name' => __( '固定ページ本文中', 'simplicity2' ),
  'id' => 'widget-in-page-article',
  'description' => __( '固定ページ本文中に表示されるウイジェット。文中最初のH2タグの手前に表示されます。広告が表示されている場合は、広告の下に表示されます。設定しないと表示されません。', 'simplicity2' ),
  'before_widget' => '<div id="%1$s" class="widget-in-page-article %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<div class="widget-in-page-article-title main-widget-label">',
  'after_title' => '</div>',
));

register_sidebars(1,
  array(
  'name' => __( '固定ページ本文下', 'simplicity2' ),
  'id' => 'widget-under-page-article',
  'description' => __( '固定ページ本文下に表示されるウイジェット。設定しないと表示されません。', 'simplicity2' ),
  'before_widget' => '<div id="%1$s" class="widget-under-page-article %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<div class="widget-under-page-article-title main-widget-label">',
  'after_title' => '</div>',
));

register_sidebars(1,
  array(
  'name' => __( '固定ページSNSボタン上', 'simplicity2' ),
  'id' => 'widget-over-page-sns-buttons',
  'description' => __( '固定ページのメインカラムの一番下となるSNSボタンの上に表示されるウイジェット。広告を表示している場合は、広告の下になります。設定しないと表示されません。', 'simplicity2' ),
  'before_widget' => '<div id="%1$s" class="widget-over-page-sns-buttons %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<div class="widget-over-page-sns-buttons-title main-widget-label">',
  'after_title' => '</div>',
));

register_sidebars(1,
  array(
  'name' => __( '固定ページSNSボタン下', 'simplicity2' ),
  'id' => 'widget-under-page-sns-buttons',
  'description' => __( '固定ページのメインカラムの一番下となるSNSボタンの下に表示されるウイジェット。設定しないと表示されません。', 'simplicity2' ),
  'before_widget' => '<div id="%1$s" class="widget-under-page-sns-buttons %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<div class="widget-under-page-sns-buttons-title main-widget-label">',
  'after_title' => '</div>',
));

register_sidebars(1,
  array(
  'name' => __( 'インデックスリストトップ', 'simplicity2' ),
  'id' => 'widget-index-top',
  'description' => __( 'インデックスリストのトップに表示されるウイジェット。広告が表示されているときは広告の下に表示されます。設定しないと表示されません。', 'simplicity2' ),
  'before_widget' => '<aside id="%1$s" class="widget-index-top %2$s">',
  'after_widget' => '</aside>',
  'before_title' => '<div class="widget-index-top-title main-widget-label">',
  'after_title' => '</div>',
));

register_sidebars(1,
  array(
  'name' => __( 'インデックスリストミドル', 'simplicity2' ),
  'id' => 'widget-index-middle',
  'description' => __( 'インデックスリストの3つ目下に表示されるウイジェット。「一覧リストのスタイル」が「サムネイルカード」の時のみの機能です。広告が表示されているときは広告の下に表示されます。設定しないと表示されません。', 'simplicity2' ),
  'before_widget' => '<aside id="%1$s" class="widget-index-middle %2$s">',
  'after_widget' => '</aside>',
  'before_title' => '<div class="widget-index-middle-title main-widget-label">',
  'after_title' => '</div>',
));

register_sidebars(1,
  array(
  'name' => __( 'インデックスリストボトム', 'simplicity2' ),
  'id' => 'widget-index-bottom',
  'description' => __( 'インデックスリストのボトムに表示されるウイジェット。広告が表示されているときは広告の下に表示されます。設定しないと表示されません。', 'simplicity2' ),
  'before_widget' => '<aside id="%1$s" class="widget-index-bottom %2$s">',
  'after_widget' => '</aside>',
  'before_title' => '<div class="widget-index-bottom-title main-widget-label">',
  'after_title' => '</div>',
));

register_sidebars(1,
  array(
  'name' => __( 'フッター左', 'simplicity2' ),
  'id' => 'footer-left',
  'description' => __( 'フッター左側のウィジットエリアです。', 'simplicity2' ),
  'before_widget' => '<aside id="%1$s" class="widget %2$s">',
  'after_widget' => '</aside>',
  'before_title' => '<h3 class="footer_widget_title">',
  'after_title' => '</h3>',
));

register_sidebars(1,
  array(
  'id' => 'footer-center',
  'name' => __( 'フッター中', 'simplicity2' ),
  'description' => __( 'フッター中間のウィジットエリアです。', 'simplicity2' ),
  'before_widget' => '<aside id="%1$s" class="widget %2$s">',
  'after_widget' => '</aside>',
  'before_title' => '<h3 class="footer_widget_title">',
  'after_title' => '</h3>',
));

register_sidebars(1,
  array(
  'name' => __( 'フッター右', 'simplicity2' ),
  'id' => 'footer-right',
  'description' => __( 'フッター右側フッター中のウィジットエリアです。', 'simplicity2' ),
  'before_widget' => '<aside id="%1$s" class="widget %2$s">',
  'after_widget' => '</aside>',
  'before_title' => '<h3 class="footer_widget_title">',
  'after_title' => '</h3>',
));

register_sidebars(1,
  array(
  'name' => __( '404ページ', 'simplicity2' ),
  'id' => '404-page',
  'description' => __( '404ページをカスタマイズするためのウィジットエリアです。', 'simplicity2' ),
  'before_widget' => '<div id="%1$s" class="widget %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<div class="404_widget_title">',
  'after_title' => '</div>',
));

//カスタムヘッダー
$custom_header_defaults = array(
 'random-default' => false,
 'width' => (is_sidebar_width_336() ? 1106 : 1070),//サイドバーの幅によって変更
 'height' => intval(get_header_height()),
 'flex-height' => false,
 'flex-width' => false,
 'default-text-color' => '',
 'header-text' => false,
 'uploads' => true,
);

/////////////////////////////////////
// 投稿本文中にウィジェットを表示する
/////////////////////////////////////
if ( !function_exists( 'add_widget_before_1st_h2' ) ):
function add_widget_before_1st_h2($the_content) {
  if ( is_amp() ) {
    return $the_content;
  }
  if ( is_single() && //投稿ページのとき、固定ページも表示する場合はis_singular()にする
       is_active_sidebar( 'widget-in-article' ) //ウィジェットが設定されているとき
  ) {
    //広告（AdSense）タグを記入
    ob_start();//バッファリング
    echo '<div id="widget-in-article" class="widgets">';
    dynamic_sidebar( 'widget-in-article' );;//本文中ウィジェットの表示
    echo '</div>';
    $ad_template = ob_get_clean();
    $h2result = get_h2_included_in_body( $the_content );//本文にH2タグが含まれていれば取得
    if ( $h2result ) {//H2見出しが本文中にある場合のみ
      //最初のH2の手前に広告を挿入（最初のH2を置換）
      $count = 1;
      $the_content = preg_replace(H2_REG, $ad_template.$h2result, $the_content, 1);
    }
  }
  return $the_content;
}
endif;
add_filter('the_content','add_widget_before_1st_h2');


/////////////////////////////////////
// 固定ページ本文中にウィジェットを表示する
/////////////////////////////////////
if ( !function_exists( 'add_widget_before_1st_h2_in_page' ) ):
function add_widget_before_1st_h2_in_page($the_content) {
  if ( is_amp() ) {
    return $the_content;
  }
  if ( is_page() && //投稿ページのとき、固定ページも表示する場合はis_singular()にする
       is_active_sidebar( 'widget-in-page-article' ) //ウィジェットが設定されているとき
  ) {
    //広告（AdSense）タグを記入
    ob_start();//バッファリング
    echo '<div id="widget-in-page-article" class="widgets">';
    dynamic_sidebar( 'widget-in-page-article' );;//本文中ウィジェットの表示
    echo '</div>';
    $ad_template = ob_get_clean();
    $h2result = get_h2_included_in_body( $the_content );//本文にH2タグが含まれていれば取得
    if ( $h2result ) {//H2見出しが本文中にある場合のみ
      //最初のH2の手前に広告を挿入（最初のH2を置換）
      $count = 1;
      $the_content = preg_replace(H2_REG, $ad_template.$h2result, $the_content, 1);
    }
  }
  return $the_content;
}
endif;
add_filter('the_content','add_widget_before_1st_h2_in_page');