<?php //カテゴリ情報から関連記事をランダムに呼び出す
$args = get_related_wp_query_args();
$query = new WP_Query( $args ); ?>
  <?php if( $query -> have_posts() && !empty($args) ): //関連記事があるとき?>
  <?php while ($query -> have_posts()) : $query -> the_post(); ?>
    <article class="related-entry-thumbnail">
      <div class="related-entry-thumb">
        <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
        <?php if ( has_post_thumbnail() ): // サムネイルを持っているとき ?>
        <?php echo get_the_post_thumbnail($post->ID, 'thumb150', array('class' => 'thumbnail-entry-thumb-image', 'alt' => get_the_title()) ); //サムネイルを呼び出す?>
        <?php else: // サムネイルを持っていないとき ?>
        <img src="<?php echo get_template_directory_uri(); ?>/images/no-image.png" alt="NO IMAGE"  class="no-image thumbnail-entry-no-image" />
        <?php endif; ?>
        </a>
      </div><!-- /.related-entry-thumb -->

      <div class="related-entry-content">
        <h3 class="related-entry-title">
          <a href="<?php the_permalink(); ?>" class="related-entry-title-link" title="<?php the_title(); ?>">
          <?php the_title(); //記事のタイトル?>
          </a></h3>
      </div><!-- /.related-entry-content -->
    </article><!-- /.elated-entry-thumbnail -->

  <?php endwhile;?>

  <?php else:?>
  <p><?php echo get_theme_text_not_found_message();//見つからない時のメッセージ ?></p>
  <?php
endif;
wp_reset_postdata();
?>
<br style="clear:both;">