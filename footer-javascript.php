<?php //Simplicityのフッターで呼び出すJavaScript関係のことをまとめて書く?>
<?php
///////////////////////////////////
//Evernoteに関する記述
///////////////////////////////////
if ( is_singular() && is_evernote_btn_visible() ): //固定ページか投稿ページのときEvernoteスクリプトを呼び出す ?>
<script defer src="<?php echo get_template_directory_uri(); ?>/js/noteit.js"></script>
<?php endif; //Evernote終了?>
<?php
///////////////////////////////////
//Pinterestボタンの呼び出し
///////////////////////////////////
if ( is_pinterest_btn_visible() && is_singular() ): ?>
<!-- 画像にPinterestボタン -->
<script type="text/javascript" async defer data-pin-height="28" data-pin-hover="true" src="//assets.pinterest.com/js/pinit.js"></script>
<?php endif; ?>
<?php
///////////////////////////////////
//はてブシェアボタン用のスクリプト呼び出し
///////////////////////////////////
if ( is_hatena_btn_visible() && is_singular() ): ?>
<!-- はてブシェアボタン用スクリプト -->
<script type="text/javascript" src="//b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
<?php endif; ?>
<?php
///////////////////////////////////
//animatedModal.js関連ファイルの呼び出し
///////////////////////////////////
if ( is_mobile_menu_type_modal() && (is_mobile() || is_responsive_enable()) ): ?>
<!--#mobile-menu-toggleボタンで呼び出される-->
<div id="animatedModal">
    <div class="close-animatedModal">
        <a href="#" class="close-button"><span class="fa fa-times-circle"></span></a>
    </div>

    <div class="modal-content">
        <?php wp_nav_menu( array ( 'theme_location' => 'header-navi' ) ); ?>
    </div>
</div>
<?php
///////////////////////////////////
//animatedModal.jsの呼び出し
///////////////////////////////////
//wp_enqueue_script( "animated-modal-js", get_template_directory_uri() . "/js/animatedModal.min.js", array( "jquery" ), false, true );
?>
<script src="<?php echo get_template_directory_uri(); ?>/js/animatedModal.min.js"></script>
<script>
  jQuery("#mobile-menu-modal").animatedModal({
    color: '#333',
    animatedIn:  'fadeIn',
    animatedOut: 'fadeOut',
    animationDuration: '.1s',
  });
</script>
<?php endif; ?>
<?php
///////////////////////////////////
//Facebookページの「いいね！」ボタン用のコード
///////////////////////////////////
global $g_facebook_sdk;//Facebookスクリプトを利用するかどうか ?>
<?php if ( $g_facebook_sdk ): ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id; js.async = true;
  js.src = '//connect.facebook.net/<?php _e( 'ja_JP', 'simplicity2' ) ?>/sdk.js#xfbml=1&version=v2.11';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php endif ?>
<?php //Facebook SDK ?>
<?php
///////////////////////////////////
//ソースコードのハイライト表示
///////////////////////////////////
if ( is_code_highlight_enable() ): ?>
<script src="<?php echo get_template_directory_uri(); ?>/highlight-js/highlight.min.js"></script>
<script type="text/javascript">
(function($){
 $('<?php echo get_code_highlight_css_selector(); ?>').each(function(i, block) {
  hljs.highlightBlock(block);
 });
})(jQuery);
</script>
<?php endif ?>