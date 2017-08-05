<?php while(have_posts()): the_post(); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <article class="article">
    <header>
      <h1 class="entry-title">
        <?php the_title(); //投稿のタイトル?>
      </h1>
      <p class="post-meta">
        <?php get_template_part('datetime') //投稿日と更新日?>
        <?php if ( is_category_visible() && //カテゴリを表示する場合
                   get_the_category() ): //投稿ページの場合?>
        <span class="category"><amp-img src="<?php echo get_template_directory_uri(); ?>/images/folder.svg" width="12" height="12" class="fa fa-svg fa-fw"></amp-img><?php the_category(', ') ?></span>
        <?php endif; //is_category_visible?>

        <?php //通常ページへ
        if (is_user_logged_in() && is_amp_link_visible() ): ?>
        <span class="view-amp"><amp-img src="<?php echo get_template_directory_uri(); ?>/images/file-text-o.svg" width="12" height="12" class="fa fa-svg fa-fw"></amp-img><a href="<?php echo the_permalink(); ?>"><?php _e( '通常ページ', 'simplicity2' ) ?></a></span>
        <?php endif ?>

        <?php //AMPテストへ
        if (is_user_logged_in() && is_amp_test_link_visible() ): ?>
        <span class="view-amp"><amp-img src="<?php echo get_template_directory_uri(); ?>/images/amp-logo2.svg" width="12" height="12" class="fa fa-svg fa-fw"></amp-img><a href="<?php echo get_amp_test_tool_url(get_amp_permalink()); ?>" target="_blank"><?php _e( 'テスト', 'simplicity2' ) ?></a></span>
        <?php endif ?>
      </p>

      <?php get_template_part('admin-pv');//管理者のみにPV表示?>

      <?php //if ( is_single() ) get_template_part('ad-top');//記事トップ広告 ?>

      <?php //if ( is_single() ) get_template_part('sns-buttons-top');//タイトル下の小さなシェアボタン?>
    </header>

    <?php get_template_part_amp('entry-eye-catch');//アイキャッチ挿入機能?>

    <div id="the-content" class="entry-content">
      <?php //記事本文の表示
        the_content( get_theme_text_read_more() ); //デフォルト：続きを読む?>
    </div>

    <footer>
      <?php if ( is_single() ) get_template_part('pager-page-links');//ページリンクのページャー?>

      <?php //if ( is_single() ) get_template_part('ad-article-footer');?>

      <?php //AMP用のアドセンスコード
      get_template_part('ad-amp'); ?>

      <?php //AMP用のSNSシェアボタン
      get_template_part('sns-amp'); ?>

      <p class="footer-post-meta">
        <?php if (is_tag_visible()): ?>
        <span class="post-tag"><?php the_tags('<amp-img src="'.get_template_directory_uri().'/images/tags.svg" width="12" height="12" class="fa fa-svg fa-fw"></amp-img>',', '); ?></span>
        <?php endif; ?>

        <?php if ( is_single() ) get_template_part('author-link') //投稿者リンク?>
      </p>
    </footer>
  </article><!-- .article -->
</div><!-- .post -->
<?php endwhile; ?>