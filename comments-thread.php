<div id="comments-thread">
  <?php
if(have_comments()):
?>
<section>
  <h2 id="comments">『<?php the_title(); ?>』へのコメント</h2>
  <ol class="commets-list">
    <?php wp_list_comments('callback=thread_comment'); ?>
  </ol>

  <div class="comment-page-link">
      <?php paginate_comments_links(); //コメントが多い場合、ページャーを表示 ?>
  </div>
</section>
  <?php
endif;

if (is_comment_form_freeze()) {//コメントを凍結
    echo get_theme_text_comment_freeze_label();
} else {//コメント欄を表示
  $args=array('title_reply' => get_theme_text_comment_reply_title(),
      'label_submit' => get_theme_text_comment_submit_label(),
  );
  echo '<aside>';
  comment_form($args);
  echo '</aside>';
}


?>
</div>
<!-- END div#comments-thread -->