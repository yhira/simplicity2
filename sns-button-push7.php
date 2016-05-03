<?php //Push7ボタン
if ( is_push7_btn_visible() ):
  $push7 = fetch_push7_info();
  if ( isset($push7->domain) ): //APIの値が正常取得出来たかドメインで判断
  global $g_is_small; ?>
  <li class="balloon-btn push7-balloon-btn">
    <div class="p7-b push7" data-p7id="<?php echo get_push7_follow_app_no(); ?>" data-p7c="<?php echo (($g_is_small && !is_share_button_type_viral()) ? 'r' : 't'); ?>"></div> <script src="https://<?php echo $push7->domain; ?>/static/button/p7.js"></script>
  </li>
<?php
  endif; //$push7->domain
endif; //is_push7_btn_visible ?>