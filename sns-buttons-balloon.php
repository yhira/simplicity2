<?php //SNSシェアボタン用テンプレート、シェアボタンが表示されるときは全てこのテンプレートが呼び出されます ?>
<?php if ( is_all_sns_share_btns_visible() ):
  global $g_is_small; ?>
<div class="sns-buttons sns-buttons-pc">
  <?php if ( get_share_message_label() ): //シェアボタン用のメッセージを取得?>
  <p class="sns-share-msg"><?php echo esc_html( get_share_message_label() ) ?></p>
  <?php endif; ?>
  <ul class="snsb snsb-balloon clearfix">
    <?php if ( is_twitter_btn_visible() )://Twitterボタンを表示するか ?>
    <li class="balloon-btn twitter-balloon-btn">
      <span class="balloon-btn-set">
        <span class="arrow-box">
          <a href="//twitter.com/search?q=<?php echo urlencode( punycode_encode( get_permalink() ) ); ?><?php echo get_twitter_via_param(); //ツイートにメンションを含める ?><?php echo get_twitter_related_param();//ツイート後にフォローを促す ?>" target="blank" class="arrow-box-link twitter-arrow-box-link" rel="nofollow">
            <span class="social-count twitter-count"><?php
              //count.jsoonでシェア数を表示
              if ( is_twitter_count_visible() ) {
                if ( scc_twitter_exists() ) {//SNS Count Cache関数があるか
                  echo scc_get_share_twitter();
                } else {
                  //カウント数取得待ち表示用のスピナー
                  echo '<span class="fa fa-spinner fa-pulse"></span>';
                }
              } else {
                //コメントアイコン
                echo '<span class="fa fa-comments"></span>';
              }
         ?></span>
          </a>
        </span>
        <a href="<?php echo get_twitter_share_url(); ?>" target="blank" class="balloon-btn-link twitter-balloon-btn-link" rel="nofollow">
          <span class="icon-twitter"></span>
        </a>
      </span>
    </li>
    <?php endif; ?>
    <?php if ( is_facebook_btn_visible() )://Facebookボタンを表示するか ?>
    <li class="balloon-btn facebook-balloon-btn">
      <span class="balloon-btn-set">
        <span class="arrow-box">
          <a href="//www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>&amp;t=<?php echo urlencode( get_the_title() );?>" target="blank" class="arrow-box-link facebook-arrow-box-link" rel="nofollow">
            <span class="social-count facebook-count"><?php
              if ( scc_facebook_exists() ) {//SNS Count Cache関数があるか
                echo scc_get_share_facebook();
              } else {
                //カウント数取得待ち表示用のスピナー
                echo '<span class="fa fa-spinner fa-pulse"></span>';
              }
             ?></span>
          </a>
        </span>
        <a href="//www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>&amp;t=<?php echo urlencode( get_the_title() ); ?>" target="blank" class="balloon-btn-link facebook-balloon-btn-link" rel="nofollow">
          <span class="icon-facebook"></span>
        </a>
      </span>
    </li>
    <?php endif;?>
    <?php if ( is_google_plus_btn_visible() )://Google＋ボタンを表示するか ?>
    <li class="balloon-btn googleplus-balloon-btn">
      <span class="balloon-btn-set">
        <span class="arrow-box">
          <a href="//plus.google.com/share?url=<?php echo rawurlencode(get_permalink($post->ID)) ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="blank" class="arrow-box-link googleplus-arrow-box-link" rel="nofollow">
            <span class="social-count googleplus-count"><?php
              if ( scc_gplus_exists() ) {//SNS Count Cache関数があるか
                echo scc_get_share_gplus();
              } else {
                //カウント数取得待ち表示用のスピナー
                echo '<span class="fa fa-spinner fa-pulse"></span>';
              }
             ?></span>
          </a>
        </span>
        <a href="//plus.google.com/share?url=<?php echo rawurlencode(get_permalink($post->ID)) ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="blank" class="balloon-btn-link googleplus-balloon-btn-link" rel="nofollow">
          <span class="icon-googleplus"></span>
        </a>
      </span>
    </li>
    <?php endif;?>
    <?php if ( is_hatena_btn_visible() )://はてなボタンを表示するか ?>
    <li class="balloon-btn hatena-balloon-btn">
      <span class="balloon-btn-set">
        <span class="arrow-box">
          <a href="<?php echo get_hatebu_url(get_permalink()); ?>" target="blank" class="arrow-box-link hatena-arrow-box-link" rel="nofollow">
            <span class="social-count hatebu-count"><?php
              if ( scc_hatebu_exists() ) {//SNS Count Cache関数があるか
                echo scc_get_share_hatebu();
              } else {
                //カウント数取得待ち表示用のスピナー
                echo '<span class="fa fa-spinner fa-pulse"></span>';
              }
             ?></span>
          </a>
        </span>
        <a href="<?php echo get_hatebu_url(get_permalink()); ?>" target="blank" class="hatena-bookmark-button balloon-btn-link hatena-balloon-btn-link" data-hatena-bookmark-layout="simple" title="<?php the_title(); ?>" rel="nofollow">
          <span class="icon-hatena"></span>
        </a>
      </span>
    </li>
    <?php endif; ?>
    <?php if ( is_pocket_btn_visible() )://pocketボタンを表示するか ?>
    <li class="balloon-btn pocket-balloon-btn">
      <span class="balloon-btn-set">
        <span class="arrow-box">
          <a href="//getpocket.com/edit?url=<?php the_permalink() ?>" target="blank" class="arrow-box-link pocket-arrow-box-link" rel="nofollow">
            <span class="social-count pocket-count"><?php
              if ( scc_pocket_exists() ) {//SNS Count Cache関数があるか
                echo scc_get_share_pocket();
              } else {
                //カウント数取得待ち表示用のスピナー
                echo '<span class="fa fa-spinner fa-pulse"></span>';
              }
             ?></span>
          </a>
        </span>
        <a href="//getpocket.com/edit?url=<?php the_permalink() ?>" target="blank" class="balloon-btn-link pocket-balloon-btn-link" rel="nofollow">
          <span class="icon-pocket"></span>
        </a>
      </span>
    </li>
    <?php endif; ?>
    <?php if ( is_line_btn_visible() )://LINEボタンを表示するか ?>
    <li class="balloon-btn line-balloon-btn">
      <span class="balloon-btn-set">
        <span class="arrow-box">
          <a href="<?php echo get_line_share_url(); ?>" target="blank" class="arrow-box-link line-arrow-box-link" rel="nofollow">
            LINE!
          </a>
        </span>
        <a href="<?php echo get_line_share_url(); ?>" target="blank" class="balloon-btn-link line-balloon-btn-link" rel="nofollow">
          <span class="icon-line"></span>
        </a>
      </span>
    </li>
    <?php endif; ?>
    <?php if ( is_evernote_btn_visible() )://Evernoteボタンを表示するか ?>
    <li class="balloon-btn evernote-balloon-btn">
      <span class="balloon-btn-set">
        <span class="arrow-box">
          <a href="#" onclick="Evernote.doClip({url:'<?php the_permalink();?>',
    providerName:'<?php bloginfo('name'); ?>',
    title:'<?php the_title();?>',
    contentId:'the-content',
    }); return false;" target="blank" class="arrow-box-link evernote-arrow-box-link" rel="nofollow">
            CLIP!
          </a>
        </span>
        <a href="#" onclick="Evernote.doClip({url:'<?php the_permalink();?>',
    providerName:'<?php bloginfo('name'); ?>',
    title:'<?php the_title();?>',
    contentId:'the-content',
    }); return false;" target="blank" class="balloon-btn-link evernote-balloon-btn-link" rel="nofollow">
          <span class="icon-evernote"></span>
        </a>
      </span>
    </li>
    <?php endif; ?>
    <?php //Push7ボタン
    if ( is_push7_btn_visible() ):
      $push7 = fetch_push7_info();
      if ( isset($push7->domain) ): //APIの値が正常取得出来たかドメインで判断
       ?>
        <li class="balloon-btn push7-balloon-btn">
          <span class="balloon-btn-set">
            <span class="arrow-box">
              <a href="https://<?php echo $push7->domain; ?>" target="blank" class="arrow-box-link push7-arrow-box-link" rel="nofollow">
                <span class="social-count push7-count"><?php
                  if ( scc_exists() ) {
                    echo $push7->subscribers;
                  } else {
                    //カウント数取得待ち表示用のスピナー
                    echo '<span class="fa fa-spinner fa-pulse"></span>';
                  }
                 ?></span>
              </a>
            </span>
            <a href="https://<?php echo $push7->domain; ?>" target="blank" class="balloon-btn-link push7-balloon-btn-link" rel="nofollow">
              <span class="icon-push7"></span>
            </a>
          </span>
        </li>
      <?php endif //isset($push7->domain) ?>
    <?php endif //is_push7_btn_visible ?>
    <?php if ( is_feedly_btn_visible() )://feedlyボタンを表示するか ?>
    <li class="balloon-btn feedly-balloon-btn">
      <span class="balloon-btn-set">
        <span class="arrow-box">
          <a href="//feedly.com/i/discover/sources/search/feed/<?php echo urlencode(get_site_url()); ?>" target="blank" class="arrow-box-link feedly-arrow-box-link" rel="nofollow">
            <span class="social-count feedly-count"><?php
              if ( scc_feedly_exists() ) {//SNS Count Cache関数があるか
                echo scc_get_follow_feedly();
              } else {
                //カウント数取得待ち表示用のスピナー
                echo '<span class="fa fa-spinner fa-pulse"></span>';
              }
             ?></span>
          </a>
        </span>
        <a href="//feedly.com/i/discover/sources/search/feed/<?php echo urlencode(get_site_url()); ?>" target="blank" class="balloon-btn-link feedly-balloon-btn-link" rel="nofollow">
          <span class="icon-feedly"></span>
        </a>
      </span>
    </li>
    <?php endif; //is_feedly_btn_visible?>
    <?php get_template_part('sns-button-comments'); ?>
  </ul>
</div>
<?php endif; ?>
