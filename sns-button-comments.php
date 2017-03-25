<?php if ( is_comments_btn_visible() && is_comment_open() && is_single() )://コメントボタンを表示するか
//コメントがある場合は、コメント一覧に、ない場合はコメント投稿欄に飛ばすためのアンカー
$comment_count_anchor = ( get_comments_number() > 0 ) ? '#comments' : '#reply-title'; ?>
<li class="balloon-btn comments-balloon-btn">
  <span class="balloon-btn-set">
    <span class="arrow-box">
      <a href="<?php echo $comment_count_anchor; ?>" class="arrow-box-link feedly-arrow-box-link" rel="nofollow">
        <span class="social-count comments-count"><?php echo get_comments_number(); ?></span>
      </a>
    </span>
    <a href="#reply-title" class="balloon-btn-link comments-balloon-btn-link" rel="nofollow">
      <span class="fa fa-comment"></span>
    </a>
  </span>
</li>
<?php endif; //is_comments_btn_visible?>