<?php get_header(); ?>

  <?php //パンくずリスト上ウイジェット
  if ( is_single() && is_active_sidebar( 'widget-over-breadcrumbs' ) ): ?>
    <?php dynamic_sidebar( 'widget-over-breadcrumbs' ); ?>
  <?php endif; ?>

  <?php get_template_part('breadcrumbs'); //カテゴリパンくずリスト?>
  <?php
  if (have_posts()) : // WordPress ループ
    while (have_posts()) : the_post(); // 繰り返し処理開始
      get_template_part('entry-body'); //本文記事の呼び出し?>

      <div id="under-entry-body">

      <?php if ( is_related_entry_visible() ): //関連記事を表示するか?>
      <aside id="related-entries">
        <h2><?php echo get_theme_text_related_entry();//関連記事タイトルの取得 ?></h2>
        <?php get_template_part('related-entries'); ?>
      </aside><!-- #related-entries -->
      <?php endif; //is_related_entry_visible?>



      <?php if ( is_ads_under_relations_enable() ){//関連記事下広告が有効のとき
        get_template_part('ad');
      }?>

      <?php //関連記事下ウイジェット
      if ( is_active_sidebar( 'widget-under-related-entries' ) ): ?>
        <div id="widget-under-related-entries">
        <?php dynamic_sidebar( 'widget-under-related-entries' ); ?>
        </div>
      <?php endif; ?>

      <?php
        if ( is_post_navi_visible() ) {//「前の記事」「次の記事」を表示するか
          if ( is_post_navi_type_default() ) {//「前の記事」「次の記事」ナビタイプはデフォルトか
            get_template_part('pager-post-navi'); //デフォルトナビのテンプレート
          } else {//「前の記事」「次の記事」ナビタイプはサムネイルか
            get_template_part('pager-post-navi-thumbnail'); //サムネイルナビのテンプレート
          }
        }
      ?>

      <?php
        if ( is_comments_visible() ) {//コメント・コメント欄を表示するか
          comments_template(); //コメントテンプレート
        }
      ?>
      </div>
    <?php
    endwhile; // 繰り返し処理終了
  else : // ここから記事が見つからなかった場合の処理 ?>
      <div class="post">
        <h2>NOT FOUND</h2>
        <p><?php echo get_theme_text_not_found_message();//見つからない時のメッセージ ?></p>
      </div>
  <?php
  endif;
  ?>

<?php get_footer(); ?>