<?php //コメント数の多い順番 ?>
<?php
//グローバル変数の呼び出し
global $g_entry_count;
global $g_entry_type;
 ?>
<div class="popular-entrys popular-entrys-large<?php if ( $g_entry_type == 'large_thumb_on' &&
           is_thumbnail_visible() ):
  echo ' popular-entrys-large-on';
endif
//echo ($g_entry_type == 'large_thumb_on' ? ' popular-entrys-large-on' : ''); ?>">
<?php query_posts( '&posts_per_page='.$g_entry_count.'&orderby=comment_count&order=DESC&ignore_sticky_posts=1'  ); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div class="popular-entry">

  <div class="popular-entry-thumb">
  <?php if ( has_post_thumbnail() ): // サムネイルを持っているときの処理 ?>
    <a href="<?php the_permalink(); ?>" class="popular-entry-link" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'thumb320', array('alt' => '') ); ?></a>
  <?php else: // サムネイルを持っていないときの処理 ?>
    <a href="<?php the_permalink(); ?>" class="popular-entry-image" title="<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/no-image-320.png" alt="NO IMAGE" class="no-image popular-list-no-image" /></a>
  <?php endif; ?>
  </div><!-- /.popular-entry-thumb -->

  <div class="popular-entry-content">
    <a href="<?php the_permalink(); ?>" class="popular-entry-title" title="<?php the_title(); ?>"><?php the_title();?></a>
  </div><!-- /.popular-entry-content -->

</div><!-- /.popular-entry -->
<?php endwhile;
else :
  echo '<p>'.get_theme_text_not_found_message().'</p>';//見つからない時のメッセージ
endif; ?>

<?php wp_reset_query(); ?>
</div>
<div class="clear"></div>