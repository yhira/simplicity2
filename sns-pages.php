<?php //SNSページのフォローボタン ?>
<?php if ( is_all_sns_follow_btns_visible() ): //全てのフォローボタンを表示するかどうか?>
<!-- SNSページ -->
<div class="sns-pages">
<?php if ( get_follow_message_label() ): //フォローメッセージがあるか?>
<p class="sns-follow-msg"><?php echo esc_html( get_follow_message_label() ); //フォローメッセージの取得?></p>
<?php endif; ?>
<ul class="snsp">
<?php if ( get_twitter_follow_id() )://Twitterフォローボタンを表示するか ?><li class="twitter-page"><a href="//twitter.com/<?php echo esc_html( get_twitter_follow_id() ); //TwitterフォローIDの取得?>" target="_blank" title="<?php _e( 'Twitterをフォロー', 'simplicity2' ) ?>" rel="nofollow"><span class="icon-twitter-logo"></span></a></li><?php endif; ?>
<?php if ( get_facebook_follow_id() )://Facebookフォローボタンを表示するか ?><li class="facebook-page"><a href="//www.facebook.com/<?php echo esc_html( get_facebook_follow_id() ); //FacebookフォローIDの取得?>" target="_blank" title="<?php _e( 'Facebookをフォロー', 'simplicity2' ) ?>" rel="nofollow"><span class="icon-facebook-logo"></span></a></li><?php endif; ?>
<?php if ( false && get_google_plus_follow_id() )://Google＋フォローボタンを表示するか ?><li class="google-plus-page"><a href="//plus.google.com/<?php echo esc_html( get_google_plus_follow_id() ); //Google＋フォローIDの取得 ?>" target="_blank" title="<?php _e( 'Google＋をフォロー', 'simplicity2' ) ?>" rel="nofollow publisher"><span class="icon-google-plus-logo"></span></a></li><?php endif; ?>
<?php if ( get_hatebu_follow_id() )://はてブフォローボタンを表示するか ?><li class="hatebu-page"><a href="//b.hatena.ne.jp/<?php echo esc_html( get_hatebu_follow_id() ); //はてブフォローIDの取得 ?>" target="_blank" title="<?php _e( 'はてブをフォロー', 'simplicity2' ) ?>" rel="nofollow"><span class="icon-hatebu-logo"></span></a></li><?php endif; ?>
<?php if ( get_instagram_follow_id() )://Instagramフォローボタンを表示するか ?><li class="instagram-page"><a href="//instagram.com/<?php echo esc_html( get_instagram_follow_id() ); //InstagramフォローIDの取得 ?>" target="_blank" title="<?php _e( 'Instagramをフォロー', 'simplicity2' ) ?>" rel="nofollow"><span class="icon-instagram-logo"></span></a></li><?php endif; ?>
<?php if ( get_pinterest_follow_id() )://Pinterestフォローボタンを表示するか ?><li class="pinterest-page"><a href="//www.pinterest.com/<?php echo esc_html( get_pinterest_follow_id() ); //PinterestフォローIDの取得 ?>" target="_blank" title="<?php _e( 'Pinterestをフォロー', 'simplicity2' ) ?>" rel="nofollow"><span class="icon-pinterest-logo"></span></a></li><?php endif; ?>
<?php if (  get_youtube_follow_url() )://YouTubeフォローボタンを表示するか ?><li class="youtube-page"><a href="<?php echo esc_html(  get_youtube_follow_url() ); //YouTubeフォローURLの取得 ?>" target="_blank" title="<?php _e( 'YouTubeをフォロー', 'simplicity2' ) ?>" rel="nofollow"><span class="icon-youtube-logo"></span></a></li><?php endif; ?>
<?php if (  get_flickr_follow_id() )://Flickrフォローボタンを表示するか ?><li class="flickr-page"><a href="//www.flickr.com/photos/<?php echo esc_html(  get_flickr_follow_id() ); //YFlickrフォローIDの取得 ?>" target="_blank" title="<?php _e( 'Flickrをフォロー', 'simplicity2' ) ?>" rel="nofollow"><span class="icon-flickr-logo"></span></a></li><?php endif; ?>
<?php if ( get_line_at_follow_id() )://LINE@フォローボタンを表示するか ?><li class="line-page"><a href="//line.naver.jp/ti/p/<?php echo esc_html(  get_line_at_follow_id() ); //LINE@フォローURLの取得 ?>" target="_blank" title="<?php _e( 'LINE@をフォロー', 'simplicity2' ) ?>" rel="nofollow"><span class="icon-line-logo"></span></a></li><?php endif; ?>
<?php if ( get_github_follow_id() )://GitHubフォローボタンを表示するか ?><li class="github-page"><a href="//github.com/<?php echo esc_html(  get_github_follow_id() ); //GitHubフォローURLの取得 ?>" target="_blank" title="<?php _e( 'GitHubをフォロー', 'simplicity2' ) ?>" rel="nofollow"><span class="icon-github-logo"></span></a></li><?php endif; ?>
<?php $push7 = fetch_push7_info();
if ( get_push7_follow_app_no() && $push7 )://Push7フォローボタンを表示するか
 ?><li class="push7-page"><a href='https://<?php echo $push7->domain; ?>' target='blank' title="<?php _e( 'Push7で更新情報を購読', 'simplicity2' ) ?>" rel="nofollow"><span class="icon-push7-logo"></span></a></li><?php endif; ?>
<?php if ( is_feedly_follow_btn_visible() )://feedlyフォローボタンを表示するか ?><li class="feedly-page"><a href="//feedly.com/i/discover/sources/search/feed/<?php echo urlencode(get_site_url()); ?>" target="blank" title="<?php _e( 'feedlyで更新情報を購読', 'simplicity2' ) ?>" rel="nofollow"><span class="icon-feedly-logo"></span></a></li><?php endif; ?>
<?php if ( is_rss_follow_btn_visible() )://RSSフォローボタンを表示するか ?><li class="rss-page"><a href="<?php bloginfo('rss2_url'); ?>" target="_blank" title="<?php _e( 'RSSで更新情報をフォロー', 'simplicity2' ) ?>" rel="nofollow"><span class="icon-rss-logo"></span></a></li><?php endif; ?>
  </ul>
</div>
<?php endif; ?>
