<?php //主にモバイル用に表情は早くするためのアイコンボタン ?>
<?php if ( is_all_sns_share_btns_visible() ):
$viral_class = is_share_button_type_mobile_viral() ? ' sns-group-viral' : ''; ?>
<div class="sns-buttons sns-buttons-icon<?php echo $viral_class; ?>">
  <?php if ( get_share_message_label() ): //シェアボタン用のメッセージを取得?>
  <p class="sns-share-msg"><?php echo esc_html( get_share_message_label() ) ?></p>
  <?php endif; ?>
  <ul class="snsb clearfix snsbs">
    <?php if ( is_twitter_btn_visible() )://Twitterボタンを表示するか ?>
  	<li class="twitter-btn-icon"><a href="//twitter.com/share?text=<?php echo urlencode( get_the_title() ); ?>&amp;url=<?php echo urlencode( punycode_encode( get_permalink() ) ) ?><?php echo get_twitter_via_param(); //ツイートにTwitter ID ?>" class="twitter-btn-icon-link" target="blank" rel="nofollow"><span class="social-icon icon-twitter"></span><?php
              //count.jsoonでシェア数を表示
              if ( is_twitter_count_visible() ) {
                //ツイート数の表示用の領域とスピナー
                echo '<span class="social-count twitter-count"><span class="fa fa-spinner fa-pulse"></span></span>';
              }
         ?></a></li>
    <?php endif; ?>
    <?php if ( is_facebook_btn_visible() )://Facebookボタンを表示するか ?>
  	<li class="facebook-btn-icon"><a href="//www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>&amp;t=<?php echo urlencode( get_the_title() ); ?>" class="facebook-btn-icon-link" target="blank" rel="nofollow"><span class="social-icon icon-facebook"></span><span class="social-count facebook-count"><span class="fa fa-spinner fa-pulse"></span></span></a></li>
    <?php endif; ?>
    <?php if ( is_google_plus_btn_visible() )://Google＋ボタンを表示するか ?>
  	<li class="google-plus-btn-icon"><a href="//plus.google.com/share?url=<?php echo rawurlencode(get_permalink($post->ID)) ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="google-plus-btn-icon-link" target="blank" rel="nofollow"><span class="social-icon icon-googleplus"></span><span class="social-count googleplus-count"><span class="fa fa-spinner fa-pulse"></span></span></a></li>
    <?php endif; ?>
    <?php if ( is_hatena_btn_visible() )://はてなボタンを表示するか ?>
  	<li class="hatena-btn-icon"><?php
//    $page_title=trim(wp_title( '', false));
//    $page_title_encoded=urlencode(mb_convert_encoding($page_title, "UTF-8"));
?>
    <a href="//b.hatena.ne.jp/add?mode=confirm&amp;url=<?php echo get_encoded_url(get_permalink()) ?>&amp;title=<?php echo get_encoded_title( trim(wp_title( '', false)) ); ?>" class="hatena-btn-icon-link" target="blank" rel="nofollow"><span class="social-icon icon-hatena"></span><span class="social-count hatebu-count"><span class="fa fa-spinner fa-pulse"></span></span></a></li>
    <?php endif; ?>
    <?php if ( is_pocket_btn_visible() )://pocketボタンを表示するか ?>
  	<li class="pocket-btn-icon"><a href="//getpocket.com/edit?url=<?php the_permalink() ?>" class="pocket-btn-icon-link" target="blank" rel="nofollow"><span class="social-icon icon-pocket"></span><span class="social-count pocket-count"><span class="fa fa-spinner fa-pulse"></span></span></a></li>
    <?php endif; ?>
    <?php if ( is_line_btn_visible() )://LINEボタンを表示するか ?>
      <?php if (is_mobile()): //モバイルの時のみ表示?>
    	<li class="line-btn-icon"><a href="//line.me/R/msg/text/?<?php echo strip_tags( get_the_title() ); ?>%0D%0A<?php the_permalink(); ?>" class="line-btn-icon-link" target="blank" rel="nofollow"><span class="social-icon icon-line"></span></a></li>
      <?php endif; ?>
    <?php endif; ?>
    <?php if ( is_evernote_btn_visible() )://Evernoteボタンを表示するか ?>
    <li class="evernote-btn-icon">
    <a href="#" onclick="Evernote.doClip({url:'<?php the_permalink();?>',
    providerName:'<?php bloginfo('name'); ?>',
    title:'<?php the_title();?>',
    contentId:'the-content',
    }); return false;" class="evernote-btn-icon-link" target="blank" rel="nofollow"><span class="social-icon icon-evernote"></span></a></li>
    <?php endif; ?>
    <?php if ( is_feedly_btn_visible() )://feedlyボタンを表示するか ?>
    <li class="feedly-btn-icon">
    <a href="//feedly.com/index.html#subscription%2Ffeed%2F<?php urlencode(bloginfo('rss2_url')); ?>" class="feedly-btn-icon-link" target="blank" rel="nofollow"><span class="social-icon icon-feedly"></span><span class="social-count feedly-count"><span class="fa fa-spinner fa-pulse"></span></span></a></li>
    <?php endif; //is_feedly_btn_visible?>
    <?php if ( is_comments_btn_visible() && is_single() )://コメント数ボタンを表示するか ?>
    <li class="comments-btn-icon">
    <a href="#reply-title" class="comments-btn-icon-link" rel="nofollow"><span class="social-icon fa fa-comment"></span><span class="social-count comments-count"><?php echo get_comments_number(); ?></span></a></li>
    <?php endif; //is_comments_visible?>
  </ul>
</div>
<?php endif; ?>