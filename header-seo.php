<?php //ヘッダー部分の内部SEO最適化策
//ヘッダー部分を子テーマでカスタマイズしていても
//SEOのアップデートは親テーマで上書きできるようにするためのテンプレート ?>
<?php
if( is_noindex_page() ): ?>
<meta name="robots" content="noindex,follow">
<?php endif; ?>
<?php //投稿・固定ページのとき
if ( is_singular() ):
  //投稿・固定ページのnoindex、nofollowタグの出力
  echo get_meta_robots_tag();
//ver2.0用
//投稿・固定ページ以外のとき、Simplicity独自のnoindex条件に当てはまるかどうか
//トップページ、カテゴリの2ページ目以降、アーカイブ、タグ、検索結果ページなど
// elseif ( is_noindex_page() ):
//   //is_noindex_page()は、子テーマのfunctions.phpで再定義が可能
//   echo '<meta name="robots" content="noindex,follow">';
endif ?>
<?php //トップページのみ（メタディスクリプションとMetaキーワードの設定）
if (is_home() && !is_paged()) : ?>
<?php if ( get_top_page_meta_description() )://メタディスクリプション ?>
<meta name="description" content="<?php echo get_top_page_meta_description(); ?>">
<?php endif ?>
<?php if ( get_top_page_meta_keyword() )://メタキーワード ?>
<meta name="keywords" content="<?php echo get_top_page_meta_keyword(); ?>">
<?php endif ?>
<?php endif; ?>
<?php //投稿ページにMETAタグを挿入するとき
if ( is_singular() && is_meta_description_insert() ):
  $page_str = null;
  if ( get_multi_page_number() > 1 ) {
    $page_str = ' - ページ '.get_multi_page_number();
  }?>
<meta name="description" content="<?php echo get_the_description().$page_str; ?>" />
<?php endif; ?>
<?php //投稿ページにMETAキーワードを挿入するとき
if ( is_single() && is_meta_keywords_insert() && get_the_keywores() ):?>
<meta name="keywords" content="<?php echo get_the_keywores(); ?>" />
<?php endif; ?>
<?php //固定ページにMETAキーワードを挿入するとき
if ( is_page() && is_meta_keywords_insert() && get_meta_keywords_singular_page() ):?>
<meta name="keywords" content="<?php echo get_meta_keywords_singular_page(); ?>" />
<?php endif; ?>
<?php //カテゴリーページにMETAディスクリプションを挿入するとき
if ( is_category() && is_meta_description_insert_to_category() ): ?>
<meta name="description" content="<?php echo get_meta_description_from_category(); ?>" />
<?php endif; ?>
<?php //カテゴリーページにMETAキーワードを挿入するとき
if ( is_category() && is_meta_keywords_insert_to_category() ): ?>
<meta name="keywords" content="<?php echo get_meta_keyword_from_category(); ?>" />
<?php endif; ?>
<?php //タグページにMETAディスクリプションを挿入するとき
if ( is_tag() ): ?>
<meta name="description" content="<?php echo get_meta_description_from_tag(); ?>" />
<?php endif; ?>
<?php //タグページにMETAキーワードを挿入するとき
if ( is_tag() ): ?>
<meta name="keywords" content="<?php echo get_meta_keyword_from_tag(); ?>" />
<?php endif; ?>
<?php //はてブのコメント一覧非表示機能に対応
if (get_hatebu_follow_id()): ?>
<link rel="author" href="http://www.hatena.ne.jp/<?php echo get_hatebu_follow_id(); ?>/" />
<?php endif ?>
<?php
///////////////////////////////////////
// canonicalタグの設定
///////////////////////////////////////
//ver2.0用
if ( false && is_canonical_enable() ) {
  canonical_tag();
} ?>