<?php //投稿タイトル下、小さな横型のSNSボタン ?>
<?php if (is_top_share_btns_visible()): //カスタマイズからチェックされていない場合は表示しない?>
<div id="sns-group-top" class="sns-group sns-group-top">
<?php if (is_mobile() //&& //モバイルの時は単なるアイコン
          /*!is_page_cache_enable()*/ ) {//ページキャッシュモードでないと
  get_template_part('sns-buttons-icon');
} else {//PCの時はバルーン付きボタン
  global $g_is_small;
  $g_is_small = true;//小さいSNS表示フラグを立てる
  get_template_part('sns-buttons');
  $g_is_small = false;
} ?>
</div>
<div class="clear"></div>
<?php endif; ?>