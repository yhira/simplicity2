<?php //モバイル関係の関数

//タブレットをモバイルとしないモバイル判定関数
if ( !function_exists( 'is_mobile' ) ):
//スマホ表示分岐
function is_mobile(){
  if ( is_page_cache_enable() ) {
    return false;
  }
  if ( is_tablet_mobile() ) {
    return wp_is_mobile();
  }
  if (!isset($_SERVER['HTTP_USER_AGENT'])) {
    return false;
  }
  $useragents = array(
    'iPhone', // iPhone
    'iPod', // iPod touch
    'Android.*Mobile', // 1.5+ Android *** Only mobile
    'Windows.*Phone', // *** Windows Phone
    'dream', // Pre 1.5 Android
    'CUPCAKE', // 1.5+ Android
    'blackberry9500', // Storm
    'blackberry9530', // Storm
    'blackberry9520', // Storm v2
    'blackberry9550', // Storm v2
    'blackberry9800', // Torch
    'webOS', // Palm Pre Experimental
    'incognito', // Other iPhone browser
    'webmate' ,// Other iPhone browser
    'Mobile.*Firefox', // Firefox OS
    'Opera Mini', // Opera Mini Browser
    'BB10', // BlackBerry 10
  );
  $pattern = '/'.implode('|', $useragents).'/i';
  return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}
endif;

//Android Chromeで&nbsp;が・に表示される不具合対策
function replace_nbsp_to_ensp($the_content) {
  if ( is_singular() ) {
    $the_content = str_replace('&nbsp;', '&ensp;', $the_content);
  }
  return $the_content;
}
add_filter('the_content','replace_nbsp_to_ensp');

//iOSかどうかを判定する
//https://net-viz.info/archives/409/
function is_ios() {
  $is_ipad = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPad');
  global $is_iphone;
  if ($is_iphone || $is_ipad) {
    return true;
  }
}
