<?php //AMPシェアボタン
//ob_start();
get_template_part_amp('sns-buttons-icon');
 ?>

<?php //AMP機能を使ったシェアボタン（現在無効化）
if ( false && is_single() && is_bottom_share_btns_visible() )://SNSシェアボタンの?>
<div id="sns-group" class="sns-group sns-group-bottom">

  <?php if ( get_share_message_label() ): //シェアボタン用のメッセージを取得?>
  <p class="sns-share-msg"><?php echo esc_html( get_share_message_label() ) ?></p>
  <?php endif; ?>

  <?php //AMP SNSシェアボタン ?>
  <ul class="sns-amp">
    <?php if ( is_twitter_btn_visible() )://Twitterボタンを表示するか ?>
    <li class="sns-amp-twitter"><amp-social-share type="twitter" width="80" height="30"></amp-social-share></li>
    <?php endif; ?>
    <?php if ( is_facebook_btn_visible() && get_fb_app_id() )://Facebookボタンを表示するか ?>
    <li class="sns-amp-facebook"><amp-social-share type="facebook"
      data-param-app_id="<?php echo get_fb_app_id(); ?>"
      width="80" height="30"></amp-social-share></li>
    <?php endif; ?>
    <?php if ( is_google_plus_btn_visible() )://Google＋ボタンを表示するか ?>
    <li class="sns-amp-gplus"><amp-social-share type="gplus" width="80" height="30"></amp-social-share></li>
    <?php endif; ?>
  </ul>

</div>
<?php endif; ?>