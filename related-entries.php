<?php //カテゴリ情報から関連記事をランダムに呼び出す
$args = get_related_wp_query_args();
$query = new WP_Query( $args ); ?>
  <?php if( $query -> have_posts() && !empty($args) ): //関連記事があるとき?>
  <?php while ($query -> have_posts()) : $query -> the_post(); ?>
    <?php //関連記事表示タイプ
    if (is_related_entry_type_default() || is_amp()) {
      get_template_part_card('related-entry-card');
    } else{
      get_template_part_card('related-entry-thumbnail-card');
    }  ?>
  <?php endwhile;?>

  <?php else:?>
  <p><?php echo get_theme_text_not_found_message();//見つからない時のメッセージ ?></p>
  <?php
endif;
wp_reset_postdata();
?>
<br style="clear:both;">