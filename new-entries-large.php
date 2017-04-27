<?php
//グローバル変数の呼び出し
global $g_widget_mode;//ウィジェットモード（全て表示するか、カテゴリ別に表示するか）
global $g_entry_count;
global $g_entry_type;
 ?>
<div class="new-entrys new-entrys-large
<?php if ( $g_entry_type == 'large_thumb_on' &&
           is_thumbnail_visible() ):
  echo ' new-entrys-large-on';
endif
//echo ($g_entry_type == 'large_thumb_on' ? ' new-entrys-large-on' : ''); ?>">
<?php
$args = array(
  'posts_per_page' => $g_entry_count,
);
$cat_ids = get_category_ids();//カテゴリ配列の取得
$has_cat_ids = $cat_ids && ($g_widget_mode == 'category');
if ( $has_cat_ids ) {
  $args += array('category__in' => $cat_ids);
}
query_posts( $args ); //クエリの作成
//query_posts('posts_per_page='.$g_entry_count); //クエリの作成?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div class="new-entry">

  <div class="new-entry-thumb">
  <?php if ( has_post_thumbnail() ): // サムネイルを持っているときの処理 ?>
    <a href="<?php the_permalink(); ?>" class="new-entry-image" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'thumb320', array('alt' => '') ); ?></a>
  <?php else: // サムネイルを持っていないときの処理 ?>
    <a href="<?php the_permalink(); ?>" class="new-entry-image"><img src="<?php echo get_template_directory_uri(); ?>/images/no-image-320.png" alt="NO IMAGE" class="no-image new-list-no-image" /></a>
  <?php endif; ?>
  </div><!-- /.new-entry-thumb -->

  <div class="new-entry-content">
    <a href="<?php the_permalink(); ?>" class="new-entry-title" title="<?php the_title(); ?>"><?php the_title();?></a>
  </div><!-- /.new-entry-content -->

</div><!-- /.new-entry -->
<?php endwhile;
else :
  echo '<p>'.get_theme_text_not_found_message().'</p>';//見つからない時のメッセージ
endif; ?>
<?php wp_reset_query(); ?>
</div><!-- /.new-entry-large -->
<div class="clear"></div>