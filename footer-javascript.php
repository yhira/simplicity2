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
//animatedModal.js関連ファイルの呼び出し
///////////////////////////////////
if ( is_mobile_menu_type_modal() && is_mobile() ): ?>
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
//wp_enqueue_script( "animated_modal", get_template_directory_uri() . "/js/animatedModal.min.js", array( "jquery" ), false, true );
?>
<script src="<?php echo get_template_directory_uri(); ?>/js/animatedModal.min.js"></script>
<script>
  jQuery("#mobile-menu-modal").animatedModal({
    color: '#333',
    animatedIn:  'fadeIn',
    animatedOut: 'fadeOut',
    // animatedIn:  'bounceInRight',
    // animatedOut: 'bounceOutLeft',
    animationDuration: '.1s',
  });
</script>
<?php endif; ?>
<?php
///////////////////////////////////
//Facebookページの「いいね！」ボタン用のコード
/////////////////////////////////// ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php //Facebook SDK ?>