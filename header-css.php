<?php
///////////////////////////////////////////
//ヘッダーのCSSに関連する記述をまとめて書く
///////////////////////////////////////////
?>
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/webfonts/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/webfonts/icomoon/style.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/extension.css">
<?php //PCでサイドバーをレスポンシブ表示設定がオンの時（完全レスポンシブ機能がオンの時とモバイルの時は設定関係なくレスポンシブ表示する）
if ( is_responsive_pc_sidebar_enable() || is_responsive_enable() || is_mobile() ): ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/responsive-pc.css">
<?php endif; ?>
<?php //カレンダーウィジェットのスタイル
if ( is_calendar_border_visible() ): ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/calendar.css">
<?php endif ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/print.css" type="text/css" media="print" />
<?php
if ( get_skin_file() ): //設定されたスキンがある場合?>
  <?php
  if ( get_pearts_base_skin() )://パーツスキンの場合 ?>
    <link rel="stylesheet" href="<?php echo get_parts_skin_file_uri(); ?>">
<?php
//var_dump( get_parts_skin_file_uri() );

 ?>
  <?php else: //通常のスキン ?>
    <link rel="stylesheet" href="<?php echo get_skin_file(); ?>">
  <?php endif ?>
<?php endif; //設定されたスキン
?>
<?php if ( is_comment_type_thread() )://2chコメントタイプ ?>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/thread.css">
  <?php if ( is_mobile() && !is_responsive_enable() ): ?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/thread-mobile.css">
  <?php endif; //is_mobile && !is_responsive_enable()?>
  <?php if ( is_responsive_enable() ): ?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/thread-responsive.css">
  <?php endif; //is_responsive_enable?>
<?php elseif ( is_comment_type_thread_simple() )://シンプルなスレッドコメントタイプ ?>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/thread-simple.css">
<?php endif; //コメントタイプ終了?>
<?php //白抜きバイラルボタンのとき
if ( ( !is_mobile() && is_share_button_type_viral_white() ) || //PC表示
     ( is_mobile() && is_share_button_type_mobile_viral_white() ) ): //モバイル表示 ?>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/sns-viral-white.css">
<?php endif ?>
<?php
if ( is_mobile_menu_type_accordion_tree() ): //アコーディオンツリーメニューの時?>
<!-- SlickNav用のスタイル -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/slicknav.css">
<?php endif ?>