<?php //ウイジェット用の関数

//新着・人気記事ウィジェット
require_once('widgets/new-popular.php');

//新着記事ウィジェット
require_once('widgets/new-entries.php');

//人気記事（Popular Posts）ウイジェット
require_once('widgets/popular-ranking.php');

//SNSフォローボタン
require_once('widgets/sns-follow-buttons.php');

//モバイル用テキストウイジェット
require_once('widgets/mobile-text.php');

//パソコン用テキストウイジェット
require_once('widgets/pc-text.php');

//Facebookページ「いいね！」ウイジェット
require_once('widgets/facebook-page-like.php');

//モバイル用広告ウイジェット
require_once('widgets/mobile-ad.php');

//パソコン用広告ウイジェット
require_once('widgets/pc-ad.php');

//パソコン用ダブルレクタングル広告ウイジェット
require_once('widgets/pc-double-ads.php');

//最近のコメントウイジェット
require_once('widgets/recent-comments.php');

//Facebook保存ボタンウイジェット
require_once('widgets/facebook-save-button.php');

//クラシックテキストウイジェット
require_once('widgets/classic-text.php');

//集計単位の文字列取得
function get_range_tag($range){
  switch ($range) {
    case 'daily':
      return '<div class="wpp-range">'.__( '（集計単位：1日）', 'simplicity2' ).'</div>';
      break;
    case 'weekly':
      return '<div class="wpp-range">'.__( '（集計単位：1週間）', 'simplicity2' ).'</div>';
      break;
    case 'monthly':
      return '<div class="wpp-range">'.__( '（集計単位：1ヶ月）', 'simplicity2' ).'</div>';
      break;
    default:
       return '<div class="wpp-range">'.__( '（集計単位：全期間）', 'simplicity2' ).'</div>';
  }
}

function get_popular_posts_ranking_style($slelctor){
  return '<style scoped>
'.$slelctor.' {
  counter-reset: wpp-ranking;
}

'.$slelctor.' ul li{
  position: relative;
}

'.$slelctor.' ul li:before {
  background: none repeat scroll 0 0 #666;
  color: #fff;
  content: counter(wpp-ranking, decimal);
  counter-increment: wpp-ranking;
  font-size: 75%;
  left: 0;
  top: 3px;
  line-height: 1;
  padding: 4px 7px;
  position: absolute;
  z-index: 1;
  opacity: 0.9;
  border-radius: 2px;
  font-family: Arial;
}
</style>';
}

//！でウィジェットのタイトルを隠せるように
add_filter('widget_title', 'widget_title_hidable');
if ( !function_exists( 'widget_title_hidable' ) ):
function widget_title_hidable($title){
  //ウィジェットタイトルの最初の一文字が！のとき
  if (strpos($title, '!') === 0) {
    return null;
  }
  return $title;
}
endif;