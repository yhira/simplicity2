<?php if ( is_twitter_btn_visible() )://Twitterボタンを表示するか ?>
<li class="balloon-btn twitter-balloon-btn<?php echo (is_share_button_type_default() ? ' twitter-balloon-btn-defalt' : ''); ?>">
  <div class="balloon-btn-set">
    <div class="arrow-box">
      <a href="//twitter.com/search?q=<?php echo urlencode( punycode_encode( get_permalink() ) ); ?>" target="blank" class="arrow-box-link twitter-arrow-box-link" rel="nofollow">
        <span class="social-count twitter-count"><?php
        if ( is_twitter_count_visible() ) {//count.jsoonでシェア数を表示
          echo fetch_twitter_count( get_permalink() );//ツイート数の表示
        } else {
          echo '<span class="fa fa-comments"></span>';//コメントアイコン
        }
         ?></span>
      </a>
    </div>
    <a href="//twitter.com/share?text=<?php echo urlencode( get_the_title() ); ?>&amp;url=<?php echo urlencode( get_the_permalink() ) ?><?php echo get_twitter_via_param(); //ツイートにメンションを含める ?><?php echo get_twitter_related_param();//ツイート後にフォローを促す ?>" target="blank" class="balloon-btn-link twitter-balloon-btn-link twitter-balloon-btn-link-default" rel="nofollow">
      <span class="fa fa-twitter"></span>
      <?php if ( is_share_button_type_default() ): ?>
        <span class="tweet-label">ツイート</span>
      <?php endif ?>
    </a>
  </div>
</li>
<?php endif; ?>