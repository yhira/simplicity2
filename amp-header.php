<!DOCTYPE html>
<html amp>
<head>
<meta charset="utf-8">
<link rel="canonical" href="<?php the_permalink() ?>" />
<meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
<?php get_template_part('header-title-tag'); ?>
<?php if ( is_facebook_ogp_enable() ) //Facebook OGPタグ挿入がオンのとき
get_template_part('header-ogp');//Facebook OGP用のタグテンプレート?>
<?php if ( is_twitter_cards_enable() ) //Twitterカードタグ挿入がオンのとき
get_template_part('header-twitter-card');//Twitterカード用のタグテンプレート?>
<script async src="https://cdn.ampproject.org/v0.js"></script>
<?php
//広告（AdSense）タグを記入
ob_start();//バッファリング
get_template_part('ad-amp');//広告貼り付け用に作成したテンプレート
$ad_template = ob_get_clean();
while(have_posts()): the_post();
  //$the_content = convert_content_for_amp(get_the_content()).$ad_template;
  //以下の処理はthe_contentで取得しないとプラグインやフックなどの処理後のHTMLが取得できなかったので（get_the_contentではダメだった）
  ob_start();//バッファリング
  the_content();//広告貼り付け用に作成したテンプレート
  $the_content = ob_get_clean();
  $the_content = $the_content.$ad_template;
endwhile;
$elements = array(
  //'amp-analytics' => 'amp-analytics-0.1.js',
  'amp-facebook' => 'amp-facebook-0.1.js',
  'amp-youtube' => 'amp-youtube-0.1.js',
  'amp-vine' => 'amp-vine-0.1.js',
  'amp-twitter' => 'amp-twitter-0.1.js',
  'amp-instagram' => 'amp-instagram-0.1.js',
  'amp-social-share' => 'amp-social-share-0.1.js',
  'amp-ad' => 'amp-ad-0.1.js',
  'amp-iframe' => 'amp-iframe-0.1.js',
  'amp-audio' => 'amp-audio-0.1.js',
);

//var_dump($the_content);
foreach( $elements as $key => $val ) {
  if( strpos($the_content, '<'.$key) !== false ) {
    echo '<script async custom-element="'.$key.'" src="https://cdn.ampproject.org/v0/'.$val.'"></script>'.PHP_EOL;

  }
}
//AMP Analytics用のライブラリ
if ( !is_user_logged_in() && (get_tracking_id() || get_amp_tracking_id()) )  {
  echo '<script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>'.PHP_EOL;
}
echo '<link rel="stylesheet" href="https://max'.'cdn.boot'.'strapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">'.PHP_EOL;
if (!is_site_font_default()) {
  echo '<link rel="stylesheet" href="'.get_site_font_source_url().'">'.PHP_EOL;
}
 ?>
<?php //JSON-LDの読み込み
get_template_part('json-ld'); ?>
<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
<style amp-custom>
<?php
if ( WP_Filesystem() ) {//WP_Filesystemの初期化
  global $wp_filesystem;//$wp_filesystemオブジェクトの呼び出し
  $css_all = '';
  //AMPスタイルの取得
  $css_file = get_template_directory().'/amp.css';
  if ( file_exists($css_file) ) {
    $css = $wp_filesystem->get_contents($css_file);//ファイルの読み込み
    $css_all .= $css;
  }

  //文字装飾スタイルの取得
  $css_file = get_template_directory().'/css/extension.css';
  if ( file_exists($css_file) ) {
    $css = $wp_filesystem->get_contents($css_file);//ファイルの読み込み
    $css_all .= $css;
  }

  ///////////////////////////////////////////
  //スキンのスタイル
  ///////////////////////////////////////////
  if ( get_skin_file() ) {//設定されたスキンがある場合
    if ( get_pearts_base_skin() ) {//パーツスキンの場合
      $parts_skin_file = url_to_local(get_parts_skin_file_uri());
      if (file_exists($parts_skin_file)) {
        $parts_skin_css = $wp_filesystem->get_contents($parts_skin_file);//ファイルの読み込み
        $css_all .= $parts_skin_css;
      }
    }
  } else {
    //通常のスキンスタイル
    $skin_file = url_to_local(get_skin_file());
    $amp_css_file = str_replace('style.css', 'amp.css', $skin_file);
    if (file_exists($amp_css_file)) {
      $amp_css = $wp_filesystem->get_contents($amp_css_file);//ファイルの読み込み
      $css_all .= $amp_css;
    }
  }

  ///////////////////////////////////////////
  //カスタマイザーのスタイル
  ///////////////////////////////////////////
  ob_start();//バッファリング
  get_template_part('css-custom');//カスタムテンプレートの呼び出し
  $css_custom = ob_get_clean();
  $css_all .= $css_custom;

  ///////////////////////////////////////////
  //子テーマのスタイル
  ///////////////////////////////////////////
  if ( get_template_directory_uri() != get_stylesheet_directory_uri() ) {
    $css_file_child = get_stylesheet_directory().'/amp.css';
    if ( file_exists($css_file_child) ) {
      $css_child = $wp_filesystem->get_contents($css_file_child);//ファイルの読み込み
      $css_all .= $css_child;
    }
  }
  //!importantの除去
  $css_all = preg_replace('/!important/i', '', $css_all);

  //CSSの縮小化
  $css_all = minify_css($css_all);

  //全てのCSSの出力
  echo $css_all;
}?>
</style>
</head>
<body <?php body_class('amp'); ?> itemscope itemtype="https://schema.org/WebPage">
<?php //Google Analyticsコード（ログインユーザーはカウントしない）
//var_dump(get_amp_tracking_id());
if ( !is_user_logged_in() ) {
  //AMP用Analyticsトラッキングコードを設定している場合
  $tracking_id = null;
  $after_title = null;
  if (get_amp_tracking_id()) {
    $tracking_id = get_amp_tracking_id();
  } else {
    $tracking_id = get_tracking_id();
    $after_title = '[AMP]';
  }

  if ( $tracking_id ) { ?>
  <amp-analytics type="googleanalytics" id="analytics1">
  <script type="application/json">
  {
    "vars": {
      "account": "<?php echo $tracking_id ?>"
    },
    "triggers": {
      "trackPageviewWithAmpdocUrl": {
        "on": "visible",
        "request": "pageview",
        "vars": {
          "title": "<?php the_title() ?><?php echo $after_title; ?>",
          "ampdocUrl": "<?php echo get_amp_permalink() ?>"
        }
      }
    }
  }
  </script>
  </amp-analytics>
  <?php //AMP用Analyticsトラッキングコードを設定しておらず通常ステージ用の場合
  }
}//AMP Analytics終了 ?>
  <div id="container">
    <!-- header -->
    <header itemscope itemtype="https://schema.org/WPHeader">
      <div id="header" class="clearfix">
        <div id="header-in">
          <div id="h-top">

            <div class="alignleft top-title-catchphrase">
              <?php get_template_part_amp('header-logo');?>
            </div>

            <div class="alignright top-sns-follows">
            </div>

          </div><!-- /#h-top -->
        </div><!-- /#header-in -->
      </div><!-- /#header -->
    </header>
    <!-- 本体部分 -->
    <div id="body">
      <div id="body-in">
       <!-- main -->
        <main itemscope itemprop="mainContentOfPage">
          <div id="main" itemscope itemtype="https://schema.org/Blog">
            <?php //get_template_part('breadcrumbs'); //カテゴリパンくずリスト?>