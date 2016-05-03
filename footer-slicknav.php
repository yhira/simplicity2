<?php
///////////////////////////////////////
// アコーディオンツリーメニュー用の設定（SlickNav）
///////////////////////////////////////
if ( is_mobile_menu_type_accordion_tree() ): //アコーディオンツリーメニューの時?>
<!-- SlickNav用のスタイル -->
<!-- <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/slicknav.css"> -->
<!-- SlickNavのスクリプトファイル -->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.slicknav.min.js"></script>
<script>
//グローバルナビのCSSセレクタを指定する
(function($){
  $('#navi .menu > ul, #navi ul.menu').slicknav({
    label: 'MENU',
    allowParentLinks: true,
  });
})(jQuery);
</script>
<?php if ( is_mobile() && //モバイルのときSlickNavメニューを表示
           !is_responsive_enable() ): //でも完全レスポンシブの時は表示しない ?>
<style type="text/css">
.slicknav_menu {
  display: block;
}
</style>
<?php endif //is_mobile ?>
<?php endif //is_mobile_menu_type_accordion_tree ?>