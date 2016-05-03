<?php get_header(); ?>

<div class="post">
  <!--ループ開始-->
  <h2 class="entry-title">ページが見つかりませんでした</h2>
  <?php if ( get_404_image() ): ?>
    <img class="not-found" src="<?php echo get_404_image(); ?>" alt="404 Not Found" />
  <?php else: ?>
    <img class="not-found" src="<?php echo get_template_directory_uri() ?>/images/404.png" alt="404 Not Found" />
  <?php endif ?>
  <?php if ( false && get_theme_text_not_found_message() ): ?>
    <p><?php echo get_theme_text_not_found_message();//見つからない時のメッセージ ?></p>
  <?php endif ?>

  <?php //404ページウィジェット
  if ( is_active_sidebar( '404-page' ) ): ?>
    <?php dynamic_sidebar( '404-page' ); ?>
  <?php endif; ?>

</div>
<!-- END div.post -->
<?php get_footer(); ?>
