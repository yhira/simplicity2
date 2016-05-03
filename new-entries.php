<ul class="new-entrys">
<?php global $g_entry_count; //グローバル変数の呼び出し?>
<?php query_posts('posts_per_page='.$g_entry_count); //クエリの作成?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<li class="new-entry">
  <div class="new-entry-thumb">
  <?php if ( has_post_thumbnail() ): // サムネイルを持っているときの処理 ?>
    <a href="<?php the_permalink(); ?>" class="new-entry-image" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'thumb100', array('alt' => get_the_title()) ); ?></a>
  <?php else: // サムネイルを持っていないときの処理 ?>
    <a href="<?php the_permalink(); ?>" class="new-entry-image" title="<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/no-image.png" alt="NO IMAGE" class="no-image new-list-no-image" /></a>
  <?php endif; ?>
  </div><!-- /.new-entry-thumb -->

  <div class="new-entry-content">
    <a href="<?php the_permalink(); ?>" class="new-entry-title" title="<?php the_title(); ?>"><?php the_title();?></a>
  </div><!-- /.new-entry-content -->

</li><!-- /.new-entry -->
<?php endwhile;
else :
  echo '<p>'.get_theme_text_not_found_message().'</p>';//見つからない時のメッセージ
endif; ?>
<?php wp_reset_query(); ?>
</ul>
<div class="clear"></div>