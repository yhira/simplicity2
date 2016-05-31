<?php
//////////////////////////////////
// モバイルメニューボタンのテンプレート
//////////////////////////////////
if ( is_navi_visible() &&
     !is_mobile_menu_type_accordion_tree() ): //アコーディオンツリーメニュー設定（SlickNav）じゃないとい表示
  $button_id = 'mobile-menu-toggle';
  $href_val = '#';
  //モーダルメニューがオンのときIDとhrefの付け替え
  if ( is_mobile_menu_type_modal() && (is_mobile() || is_responsive_enable()) ) {
    $button_id = 'mobile-menu-modal';
    $href_val = '#animatedModal';
  } ?>
<!-- モバイルメニュー表示用のボタン -->
<div id="mobile-menu">
  <a id="<?php echo $button_id; ?>" href="<?php echo $href_val; ?>"><span class="fa <?php echo get_menu_button_icon_font(); //Font Awesomeアイコンフォントの取得 ?> fa-2x"></span></a>
</div>
<?php endif; ?>