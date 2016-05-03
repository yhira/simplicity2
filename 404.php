<?php get_header(); ?>

<div class="post">
  <!--ループ開始-->
  <h2 class="entry-title">ページが存在しません</h2>
  <img class="not-found" src="<?php echo get_template_directory_uri() ?>/images/404.png" alt="404 Not Found" />
  <p><?php echo get_theme_text_not_found_message();//見つからない時のメッセージ ?></p>

</div>
<!-- END div.post -->
<?php get_footer(); ?>
