<?php //コメント数の多い順番 ?>
<ul class="popular-entrys">
<?php global $g_entry_count; //グローバル変数の呼び出し?>
<?php query_posts( '&posts_per_page='.$g_entry_count.'&orderby=comment_count&order=DESC&ignore_sticky_posts=1'  ); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<li class="popular-entry">

  <div class="popular-entry-thumb">
  <?php if ( has_post_thumbnail() ): // サムネイルを持っているときの処理 ?>
    <a href="<?php the_permalink(); ?>" class="popular-entry-link" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'thumb100', array('alt' => '') ); ?></a>
  <?php else: // サムネイルを持っていないときの処理 ?>
    <a href="<?php the_permalink(); ?>" class="popular-entry-image" title="<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/no-image.png" alt="NO IMAGE" class="no-image popular-list-no-image" /></a>
  <?php endif; ?>
  </div><!-- /.popular-entry-thumb -->

  <div class="popular-entry-content">
    <a href="<?php the_permalink(); ?>" class="popular-entry-title" title="<?php the_title(); ?>"><?php the_title();?></a>
  </div><!-- /.popular-entry-content -->

</li><!-- /.popular-entry -->
<?php endwhile;
else :
  echo '<p>'.get_theme_text_not_found_message().'</p>';//見つからない時のメッセージ
endif; ?>

<?php wp_reset_query(); ?>
</ul>
<div class="clear"></div>