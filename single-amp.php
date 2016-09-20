<!DOCTYPE html>
<html amp>
<head>
<meta charset="utf-8">
<link rel="canonical" href="<?php the_permalink() ?>" />
<link rel="amphtml" href="<?php echo get_permalink().'?amp=1'; ?>">
<meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
<?php get_template_part('header-title-tag'); ?>
<!-- <title><?php single_post_title(); ?></title> -->
<?php if ( is_facebook_ogp_enable() ) //Facebook OGPタグ挿入がオンのとき
get_template_part('header-ogp');//Facebook OGP用のタグテンプレート?>
<?php if ( is_twitter_cards_enable() ) //Twitterカードタグ挿入がオンのとき
get_template_part('header-twitter-card');//Twitterカード用のタグテンプレート?>
<style type="text/css">
<?php
if ( WP_Filesystem() ) {//WP_Filesystemの初期化
  global $wp_filesystem;//$wp_filesystemオブジェクトの呼び出し
  //コメントで位置を表示するためのファイル名取得
  $css_file = get_template_directory().'/amp.css';
  $css = $wp_filesystem->get_contents($css_file);//ファイルの読み込み
  echo $css;
}
?>
</style>
</head>
<body <?php body_class('amp'); ?> itemscope itemtype="http://schema.org/WebPage">
  <div id="container">
    <!-- header -->
    <header itemscope itemtype="http://schema.org/WPHeader">
      <div id="header" class="clearfix">
        <div id="header-in">
          <div id="h-top">

            <div class="alignleft top-title-catchphrase">
              <?php get_template_part('header-logo');?>
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

  <?php get_template_part('entry-eye-catch');//アイキャッチ挿入機能?>

  <div id="the-content" class="entry-content">
  <?php //記事本文の表示
    the_content( get_theme_text_read_more() ); //デフォルト：続きを読む?>
  </div>

  <footer>
    <?php if ( is_single() ) get_template_part('pager-page-links');//ページリンクのページャー?>

    <?php //if ( is_single() ) get_template_part('ad-article-footer');?>

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
    <?php get_template_part('related-entries'); ?>
  </aside><!-- #related-entries -->
  <?php endif; //is_related_entry_visible?>
</div>




<!-- footer -->
<footer itemscope itemtype="http://schema.org/WPFooter">
  <div id="footer" class="main-footer">
    <div id="footer-in">
      <div id="copyright" class="wrapper">
        <?php //フッターメニューの設定
        if ( has_nav_menu('footer-navi') ): ?>
        <div id="footer-navi">
          <div id="footer-navi-in">
            <?php wp_nav_menu( array( 'theme_location' => 'footer-navi' ) ); ?>
            </div>
        </div>
        <?php endif ?>
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