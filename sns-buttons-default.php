<?php //SNSシェアボタン用テンプレート、シェアボタンが表示されるときは全てこのテンプレートが呼び出されます ?>
<?php if ( is_all_sns_share_btns_visible() ):
  global $g_is_small; ?>
<div class="sns-buttons sns-buttons-pc">
  <?php if ( get_share_message_label() ): //シェアボタン用のメッセージを取得?>
  <p class="sns-share-msg"><?php echo esc_html( get_share_message_label() ) ?></p>
  <?php endif; ?>
  <ul class="snsb clearfix">
    <?php get_template_part('sns-button-twitter'); ?>
    <?php if ( false && is_twitter_btn_visible() )://Twitterボタンを表示するか ?>
    <li class="twitter-btn"><a href="<?php echo get_twitter_share_url(); ?>" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-count="<?php echo ($g_is_small ? 'horizontal' : 'vertical') ?>" data-related="<?php echo is_twitter_related_follow_enable() ? get_twitter_follow_id() : '' ;//ツイート後にフォローを促す ?>">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
    </li>
    <?php endif; ?>
    <?php if ( is_facebook_btn_visible() )://Facebookボタンを表示するか ?><li class="facebook-btn"><div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="<?php echo ($g_is_small ? 'button_count' : 'box_count') ?>" data-action="like" data-show-faces="false" data-share="true"></div></li>
    <?php endif; //Facebook?>
    <?php if ( false && is_google_plus_btn_visible() )://Google＋ボタンを表示するか ?>
    <li class="google-plus-btn"><script type="text/javascript" src="//apis.google.com/js/plusone.js"></script>
      <div class="g-plusone"<?php echo ($g_is_small ? '' : ' data-size="tall"') ?> data-href="<?php the_permalink(); ?>"></div>
    </li>
    <?php endif;?>
    <?php if ( is_hatena_btn_visible() )://はてなボタンを表示するか ?>
    <li class="hatena-btn"> <a href="//b.hatena.ne.jp/entry/<?php the_permalink(); ?>" class="hatena-bookmark-button" data-hatena-bookmark-title="<?php the_title(); ?>｜<?php bloginfo('name'); ?>" data-hatena-bookmark-layout="<?php echo ($g_is_small ? 'standard' : 'vertical-large') ?>"><img src="//b.st-hatena.com/images/entry-button/button-only.gif" alt="<?php _e( 'このエントリーをはてなブックマークに追加', 'simplicity2' ) ?>" style="border: none;" /></a><script type="text/javascript" src="//b.st-hatena.com/js/bookmark_button.js" async="async"></script>
    </li>
    <?php endif; ?>
    <?php if ( is_pocket_btn_visible() )://pocketボタンを表示するか ?>
    <li class="pocket-btn"><a data-pocket-label="pocket" data-pocket-count="<?php echo ($g_is_small ? 'horizontal' : 'vertical') ?>" class="pocket-btn" data-lang="en"></a>
<script type="text/javascript">!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="//widgets.getpocket.com/v1/j/btn.js?v=1";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"pocket-btn-js");</script>
    </li>
    <?php endif; ?>
    <?php if ( is_line_btn_visible() )://LINEボタンを表示するか?>
    <li class="line-btn">
      <a href="<?php echo get_line_share_url(); ?>" target="blank" class="line-btn-link" rel="nofollow">
          <img src="<?php echo get_template_directory_uri().'/images/line-btn.png'; ?>" alt="" class="line-btn-img"><img src="<?php echo get_template_directory_uri().'/images/line-btn-mini.png'; ?>" alt="" class="line-btn-img-mini">
        </a>
    </li>
    <?php endif; ?>
    <?php if ( is_evernote_btn_visible() )://Evernoteボタンを表示するか ?>
    <li class="evernote-btn">
  <a href="#" onclick="Evernote.doClip({url:'<?php the_permalink();?>',
    providerName:'<?php bloginfo('name'); ?>',
    title:'<?php the_title();?>',
    contentId:'the-content',
    }); return false;" class="evernote-btn-link"><img src="<?php echo get_template_directory_uri();?>/images/article-clipper-vert.png" alt="Evernoteに保存" class="evernote-btn-img"><img src="<?php echo get_template_directory_uri();?>/images/article-clipper.png" alt="Evernoteに保存" class="evernote-btn-img-mini"></a></li>
    <?php endif; ?>
    <?php //Push7ボタン
    get_template_part('sns-button-push7'); ?>
    <?php if ( is_feedly_btn_visible() )://feedlyボタンを表示するか ?>
      <?php if ($g_is_small): //横型の小さいfeedlyボタン?>
      <li class="feedly-btn feedly-btn-horizontal">
        <a href="//feedly.com/i/discover/sources/search/feed/<?php echo urlencode(get_site_url()); ?>" target="blank"><img id="feedly-follow" src="//s3.feedly.com/img/follows/feedly-follow-rectangle-flat-medium_2x.png" alt=""></a>
    <span class="arrow_box"><a href="//feedly.com/i/discover/sources/search/feed/<?php echo urlencode(get_site_url()); ?>" target="blank"><?php echo fetch_feedly_count(); ?></a></span>
      </li>
      <?php else: //縦型の大きなfeedlyボタン?>
      <li class="feedly-btn feedly-btn-vertical">
        <div id="feedly-followers">
        <span id="feedly-count" class="feedly-count"><a href="//feedly.com/i/discover/sources/search/feed/<?php echo urlencode(get_site_url()); ?>" target="blank"><?php echo fetch_feedly_count(); ?></a></span>
        <a href="//feedly.com/i/discover/sources/search/feed/<?php echo urlencode(get_site_url()); ?>" target="blank">
          <img id="feedly-follow" src="//s3.feedly.com/img/follows/feedly-follow-rectangle-flat-medium_2x.png" alt="">
        </a></div>
      </li>
      <?php endif; ?>
    <?php endif; //is_feedly_btn_visible?>
    <?php get_template_part('sns-button-comments'); ?>
  </ul>
</div>
<?php endif; ?>
