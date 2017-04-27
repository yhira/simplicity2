<?php //投稿一覧リストのループ内で呼び出される大きなエントリーカード ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(array('entry', 'entry-card-large')) ?>>
  <figure class="entry-large-thumb">
    <?php if ( has_post_thumbnail() ): // サムネイルを持っているとき ?>
      <a href="<?php the_permalink(); ?>" class="entry-image entry-large-image-link" title="<?php the_title(); ?>"><?php the_post_thumbnail('large' , array('class' => 'entry-large-thumnail', 'alt' => '') ); ?></a>
    <?php else: // サムネイルを持っていないとき ?>
      <a href="<?php the_permalink(); ?>" class="entry-image entry-large-image-link" title="<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/no-image-large.png" alt="NO IMAGE" class="entry-large-thumnail no-image list-no-image" /></a>
    <?php endif; ?>
  </figure><!-- /.entry-thumb -->

  <?php //エントリーカードのコンテンツ部分を呼び出す
  get_template_part('entry-card-content') ?>

</article>