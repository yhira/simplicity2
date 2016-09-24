<!DOCTYPE html>
<html amp>
<head>
<meta charset="utf-8">
<link rel="canonical" href="<?php the_permalink() ?>" />
<link rel="amphtml" href="<?php echo get_permalink().'?amp=1'; ?>">
<meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
<?php get_template_part('header-title-tag'); ?>
<?php if ( is_facebook_ogp_enable() ) //Facebook OGPタグ挿入がオンのとき
get_template_part('header-ogp');//Facebook OGP用のタグテンプレート?>
<?php if ( is_twitter_cards_enable() ) //Twitterカードタグ挿入がオンのとき
get_template_part('header-twitter-card');//Twitterカード用のタグテンプレート?>
<script async src="https://cdn.ampproject.org/v0.js"></script>
<script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
<script async custom-element="amp-facebook" src="https://cdn.ampproject.org/v0/amp-facebook-0.1.js"></script>
<script async custom-element="amp-youtube" src="https://cdn.ampproject.org/v0/amp-youtube-0.1.js"></script>
<script async custom-element="amp-vine" src="https://cdn.ampproject.org/v0/amp-vine-0.1.js"></script>
<script custom-element="amp-twitter" src="https://cdn.ampproject.org/v0/amp-twitter-0.1.js" async></script>
<script custom-element="amp-instagram" src="https://cdn.ampproject.org/v0/amp-instagram-0.1.js" async></script>
<script async custom-element="amp-social-share" src="https://cdn.ampproject.org/v0/amp-social-share-0.1.js"></script>
<script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "NewsArticle",
  "mainEntityOfPage":{
    "@type":"WebPage",
    "@id":"<?php the_permalink(); ?>" // パーマリンクを取得
  },
  "headline": "<?php the_title();?>", // ページタイトルを取得
  "image": {
    "@type": "ImageObject",
    "url": "<?php // アイキャッチ画像URLを取得
    $image_id = get_post_thumbnail_id();
    $image_url = wp_get_attachment_image_src($image_id, true);
    echo $image_url[0];
    ?>",
    "height": 800,
    "width": 800
  },
  "datePublished": "<?php the_time('Y/m/d') ?>", // 記事投稿時間
  "dateModified": "<?php the_modified_date('Y/m/d') ?>", // 記事更新時間
  "author": {
    "@type": "Person",
    "name": "<?php the_author_meta('nickname'); ?>" // 投稿者ニックネーム
  },
  "publisher": {
    "@type": "Organization",
    "name": "<?php bloginfo('name'); ?>", // サイト名
    // "logo": {
    //   "@type": "ImageObject",
    //   "url": "<?php echo get_template_directory_uri(); ?>/img/logo.png", // ロゴ画像
    //   "width": 130,
    //   "height": 53
    // }
  },
  "description": "<?php echo get_the_description(); ?>…" // 抜粋
}
</script>
<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
<style amp-custom>
<?php
if ( WP_Filesystem() ) {//WP_Filesystemの初期化
  global $wp_filesystem;//$wp_filesystemオブジェクトの呼び出し
  //コメントで位置を表示するためのファイル名取得
  $css_file = get_template_directory().'/amp.css';
  $css = $wp_filesystem->get_contents($css_file);//ファイルの読み込み
  $css_all = $css;

  ob_start();//バッファリング
  get_template_part('css-custom');//カスタムテンプレートの呼び出し
  $css_custom = ob_get_clean();
  $css_all .= $css_custom;

  if ( get_template_directory_uri() != get_stylesheet_directory_uri() ) {
    $css_file_child = get_stylesheet_directory().'/amp.css';
    if ( file_exists($css_file_child) ) {
      $css_child = $wp_filesystem->get_contents($css_file_child);//ファイルの読み込み
      $css_all .= $css_child;
    }
  }
  //CSSの縮小化
  $css_all = minify_css($css_all);
  //全てのCSSの出力
  echo $css_all;
}?>
</style>
<?php //Google Analyticsコード（ログインユーザーはカウントしない）
if ( !is_user_logged_in() && get_tracking_id() ): ?>
<amp-pixel src="//ssl.google-analytics.com/collect?v=1&amp;tid=<?php echo get_tracking_id() ?>&amp;t=pageview&amp;cid=$RANDOM&amp;dt=$TITLE&amp;dl=$CANONICAL_URL&amp;z=$RANDOM"></amp-pixel>
<?php endif ?>
</head>
<body <?php body_class('amp'); ?> itemscope itemtype="http://schema.org/WebPage">
  <div id="container">
    <!-- header -->
    <header itemscope itemtype="http://schema.org/WPHeader">
      <div id="header" class="clearfix">
        <div id="header-in">
          <div id="h-top">

            <div class="alignleft top-title-catchphrase">
              <p id="site-title" itemscope itemtype="http://schema.org/Organization">
                <?php
                $site_title = '<a href="'.home_url('/').'">'.get_bloginfo('name').'</a>';
                echo $site_title ?>
              </p>
              <p id="site-description">
                <?php echo get_bloginfo('description') ?>
              </p>
            </div>

            <div class="alignright top-sns-follows">
            </div>

          </div><!-- /#h-top -->
        </div><!-- /#header-in -->
      </div><!-- /#header -->
    </header>
    <!-- 本体部分 -->
    <div id="body">
      <div id="body-in">
       <!-- main -->
        <main itemscope itemprop="mainContentOfPage">
          <div id="main" itemscope itemtype="http://schema.org/Blog">
            <?php get_template_part('breadcrumbs'); //カテゴリパンくずリスト?>




<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <article class="article">
    <header>
      <h1 class="entry-title">
        <?php the_title(); //投稿のタイトル?>
      </h1>
      <p class="post-meta">
        <?php get_template_part('datetime') //投稿日と更新日?>
        <?php if ( is_category_visible() && //カテゴリを表示する場合
                   get_the_category() ): //投稿ページの場合?>
        <span class="category"><span class="fa fa-folder fa-fw"></span><?php the_category(', ') ?></span>
        <?php endif; //is_category_visible?>
      </p>

      <?php get_template_part('admin-pv');//管理者のみにPV表示?>

      <?php //if ( is_single() ) get_template_part('ad-top');//記事トップ広告 ?>

      <?php //if ( is_single() ) get_template_part('sns-buttons-top');//タイトル下の小さなシェアボタン?>
    </header>

    <?php get_template_part_amp('entry-eye-catch');//アイキャッチ挿入機能?>

    <div id="the-content" class="entry-content">
    <?php //記事本文の表示
      the_content( get_theme_text_read_more() ); //デフォルト：続きを読む?>
    </div>

    <footer>
      <?php if ( is_single() ) get_template_part('pager-page-links');//ページリンクのページャー?>

      <?php //if ( is_single() ) get_template_part('ad-article-footer');?>

      <?php //AMP用のアドセンスコード
      get_template_part('ad-amp'); ?>

      <div id="sns-group" class="sns-group sns-group-bottom">
      <?php if ( is_single() && is_bottom_share_btns_visible() )://SNSシェアボタンの?>

        <?php if ( get_share_message_label() ): //シェアボタン用のメッセージを取得?>
        <p class="sns-share-msg"><?php echo esc_html( get_share_message_label() ) ?></p>
        <?php endif; ?>

        <?php //AMP SNSシェアボタン ?>
        <ul class="sns-amp">
          <?php if ( is_twitter_btn_visible() )://Twitterボタンを表示するか ?>
          <li class="sns-amp-twitter"><amp-social-share type="twitter" width="80" height="30"></amp-social-share></li>
          <?php endif; ?>
          <?php if ( is_facebook_btn_visible() && get_fb_app_id() )://Facebookボタンを表示するか ?>
          <li class="sns-amp-facebook"><amp-social-share type="facebook"
            data-param-app_id="<?php echo get_fb_app_id(); ?>"
            width="80" height="30"></amp-social-share></li>
          <?php endif; ?>
          <?php if ( is_google_plus_btn_visible() )://Google＋ボタンを表示するか ?>
          <li class="sns-amp-gplus"><amp-social-share type="gplus" width="80" height="30"></amp-social-share></li>
          <?php endif; ?>
        </ul>

      <?php endif; ?>
      </div>

      <p class="footer-post-meta">
        <?php if (is_tag_visible()): ?>
        <span class="post-tag"><?php the_tags('<span class="fa fa-tag fa-fw"></span>',', '); ?></span>
        <?php endif; ?>

        <?php if ( is_single() ) get_template_part('author-link') //投稿者リンク?>
      </p>
    </footer>
  </article><!-- .article -->
</div><!-- .post -->



<div id="under-entry-body">
  <?php if ( is_related_entry_visible() ): //関連記事を表示するか?>
  <aside id="related-entries">
    <h2><?php echo get_theme_text_related_entry();//関連記事タイトルの取得 ?></h2>
    <?php get_template_part_amp('related-entries'); ?>
  </aside><!-- #related-entries -->
  <?php endif; //is_related_entry_visible?>
</div>

<?php //AMP用のアドセンスコード
get_template_part('ad-amp'); ?>


<!-- footer -->
<footer itemscope itemtype="http://schema.org/WPFooter">
  <div id="footer" class="main-footer">
    <div id="footer-in">
      <div id="copyright" class="wrapper">
        <div class="credit">
          <?php echo get_site_license(); //サイトのライセンス表記の取得 ?>
        </div>

      </div>
  </div><!-- /#footer-in -->
  </div><!-- /#footer -->
</footer>

          </div>
        </main>
      </div>
    </div>
  </div>
</body>
</html>