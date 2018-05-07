<?php //AMPヘッダー
get_template_part('amp-header'); ?>

<?php //AMP本文
get_template_part('amp-content'); ?>

<div id="under-entry-body">
  <?php if ( is_related_entry_visible() || is_amp() ): //関連記事を表示するか?>
  <aside id="related-entries">
    <h2><?php echo get_theme_text_related_entry();//関連記事タイトルの取得 ?></h2>
    <?php get_template_part_amp('related-entries'); ?>
  </aside><!-- #related-entries -->
  <?php endif; //is_related_entry_visible?>
</div>

<?php //AMP用のアドセンスコード
get_template_part('ad-amp'); ?>

<?php //AMPフッター
get_template_part('amp-footer'); ?>