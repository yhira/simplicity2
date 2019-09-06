<?php //投稿本文 ?>
<?php //インデックス表示時はセクションで区切る（開始タグ）
//if ( !is_single() ) echo '<article>'; ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <article class="article<?php if ( !is_single() ) echo ' article-list'; ?>">
  <?php  if ( is_single() ) get_template_part('sns-buttons-sharebar'); //スクロール追従シェアバー ?>

  <?php //投稿本文上ウイジェット
  if ( is_single() && is_active_sidebar( 'widget-over-articletitle' ) ): ?>
    <?php dynamic_sidebar( 'widget-over-articletitle' ); ?>
  <?php endif; ?>

  <header>
    <h1 class="entry-title"><?php
      if ( !is_single() ) echo '<a href="'.get_permalink().'">'; //投稿ページ以外ではタイトルにリンクを貼る
        the_title(); //投稿のタイトル
      if ( !is_single() ) echo '</a>'; //投稿ページ以外ではタイトルにリンクを貼る
    ?></h1>


    <?php //レビュー表示
    if (is_the_page_review_enable()) {
      echo '<div class="review-rating">';
      echo get_rating_star_tag(get_the_review_rate(), 5, true);
      echo '</div>';
    }
    ?>

    <p class="post-meta">
      <?php get_template_part('datetime') //投稿日と更新日?>

      <?php get_template_part('category-link');//カテゴリーリンク?>

      <?php //コメント数
      if ( is_comments_visible() && is_comment_count_visible() && is_comment_open() ):
        $comment_count_anchor = ( get_comments_number() > 0 ) ? '#comments' : '#reply-title'; ?>
        <span class="comments">
          <span class="fa fa-comment"></span>
          <span class="comment-count">
            <a href="<?php echo get_permalink().$comment_count_anchor; ?>" class="comment-count-link"><?php echo get_comments_number(); ?></a>
          </span>
        </span>
      <?php endif //is_comment_count_visible?>

      <?php //AMPページへ
      if ( is_user_logged_in() && is_amp_link_visible() && has_amp_page() ): ?>
        <span class="amp-view"><span class="fa icon-amp-logo2 fa-fw"></span><a href="<?php echo get_amp_permalink().'#development=1'; ?>"><?php _e( 'AMP', 'simplicity2' ) ?></a></span>
      <?php endif ?>

      <?php //AMPテストへ
      if ( is_user_logged_in() && is_amp_test_link_visible() && has_amp_page() ): ?>
        <span class="amp-test"><span class="fa icon-amp-logo2 fa-fw"></span><a href="<?php echo get_amp_test_tool_url(get_amp_permalink()); ?>" target="_blank"><?php _e( 'テスト', 'simplicity2' ) ?></a></span>
      <?php endif ?>

      <?php if ( is_single() ) get_template_part('edit-link'); //編集リンク?>

      <?php wlw_edit_post_link(__( 'WLWで編集', 'simplicity2' ), '<span class="wlw-edit"><span class="fa fa-pencil-square-o fa-fw"></span>', '</span>'); ?>

    </p>

    <?php get_template_part('admin-pv');//管理者のみにPV表示?>

    <?php if ( is_single() ) get_template_part('ad-top');//記事トップ広告 ?>

    <?php if ( is_single() ) get_template_part('sns-buttons-top');//タイトル下の小さなシェアボタン?>

    <?php //投稿本文上ウイジェット
    if ( is_single() && is_active_sidebar( 'widget-over-article' ) ): ?>
      <?php dynamic_sidebar( 'widget-over-article' ); ?>
    <?php endif; ?>
  </header>

  <?php get_template_part('entry-eye-catch');//アイキャッチ挿入機能?>

  <div id="the-content" class="entry-content">
  <?php //記事本文の表示
    the_content( get_theme_text_read_more() ); //デフォルト：続きを読む?>
  </div>

  <footer>
    <?php if ( is_single() ) get_template_part('pager-page-links');//ページリンクのページャー?>
    <?php //投稿本文下ウイジェット
    if ( is_single() && is_active_sidebar( 'widget-under-article' ) ): ?>
      <?php dynamic_sidebar( 'widget-under-article' ); ?>
    <?php endif; ?>

    <?php if ( is_single() ) get_template_part('ad-article-footer');?>


    <?php //投稿SNSボタン上ウイジェット
    if ( is_single() && is_active_sidebar( 'widget-over-sns-buttons' ) ): ?>
      <?php dynamic_sidebar( 'widget-over-sns-buttons' ); ?>
    <?php endif; ?>

    <div id="sns-group" class="sns-group sns-group-bottom">
    <?php if ( is_single() && is_bottom_share_btns_visible() )
      get_template_part('sns-buttons'); //SNSシェアボタンの取得?>

    <?php if ( is_single() &&
               is_body_bottom_follows_visible() ) //記事下フォローボタン表示のとき
                 get_template_part('sns-pages'); //SNSフォーローボタンの取得?>
    </div>

    <?php //投稿SNSボタン下ウイジェット
    if ( is_single() && is_active_sidebar( 'widget-under-sns-buttons' ) ): ?>
      <div id="widget-under-sns-buttons" class="widgets">
      <?php dynamic_sidebar( 'widget-under-sns-buttons' ); ?>
      </div>
    <?php endif; ?>

    <p class="footer-post-meta">

      <?php if (is_tag_visible()): ?>
      <span class="post-tag"><?php the_tags('<span class="fa fa-tags fa-fw"></span>','<span class="tag-separator">, </span>'); ?></span>
      <?php endif; ?>

      <?php if ( is_single() ) get_template_part('author-link') //投稿者リンク?>

      <?php if ( is_single() ) get_template_part('edit-link') //編集リンク?>

      <?php if ( is_single() ) wlw_edit_post_link(__( 'WLWで編集', 'simplicity2' ), '<span class="wlw-edit"><span class="fa fa-pencil-square-o fa-fw"></span>', '</span>'); ?>
    </p>
  </footer>
  </article><!-- .article -->
  <?php if ( is_list_style_bodies() && !is_singular() ): //本文リストスタイルの時?>
  <hr class="sep" />
  <?php endif; ?>
</div><!-- .post -->
<?php //インデックス表示時はセクションで区切る（終了タグ）
//if ( !is_single() ) echo '</article>'; ?>