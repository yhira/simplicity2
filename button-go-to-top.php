<?php
//////////////////////////////////
// トップへ戻るボタンのテンプレート
//////////////////////////////////
if ( is_go_to_top_button_visible()  ): //トップへ戻るボタンを表示するか?>
<div id="page-top">
  <?php if ( get_go_to_top_button_image() ): //カスタマイザーでトップへ戻る画像が指定されている時 ?>
    <a id="move-page-top" class="move-page-top-image"><img src="<?php echo get_go_to_top_button_image(); ?>" alt="トップへ戻る"></a>
  <?php else: ?>
    <a id="move-page-top"><span class="fa <?php echo get_go_to_top_button_icon_font(); //Font Awesomeアイコンフォントの取得 ?> fa-2x"></span></a>
  <?php endif ?>

</div>
<?php endif; ?>