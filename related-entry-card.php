<article class="related-entry cf">
  <div class="related-entry-thumb">
    <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
    <?php if ( has_post_thumbnail() ): // サムネイルを持ってぁE��とぁE?>
    <?php echo get_the_post_thumbnail($post->ID, 'thumb100', array('class' => 'related-entry-thumb-image', 'alt' => '') ); //サムネイルを呼び出ぁE>
    <?php else: // サムネイルを持ってぁE��ぁE��ぁE?>
    <img src="<?php echo get_template_directory_uri(); ?>/images/no-image.png" alt="NO IMAGE" class="no-image related-entry-no-image"<?php echo get_noimage_sizes_attr(); ?> />
    <?php endif; ?>
    </a>
  </div><!-- /.related-entry-thumb -->

  <div class="related-entry-content">
    <header>
      <h3 class="related-entry-title">
        <a href="<?php the_permalink(); ?>" class="related-entry-title-link" title="<?php the_title_attribute(); ?>">
        <?php the_title(); //記事�Eタイトル?>
        </a></h3>
    </header>
    <p class="related-entry-snippet">
   <?php echo get_the_custom_excerpt( $post->post_content, get_excerpt_length() ) . ''; //カスタマイズで持E��した文字�E長さだけ本斁E��粁E></p>

    <?php if ( get_theme_text_read_entry() ): //「記事を読む」�EようなチE��ストが設定されてぁE��晁E?>
    <footer>
      <p class="related-entry-read"><a href="<?php the_permalink(); ?>"><?php echo get_theme_text_read_entry(); //チE��ォルト：記事を読む ?></a></p>
    </footer>
    <?php endif; ?>

  </div><!-- /.related-entry-content -->
</article><!-- /.elated-entry -->