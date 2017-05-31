<?php
////////////////////////////
//パンくずリスト
////////////////////////////
  if (is_category()) {
    get_template_part('breadcrumbs');
  }
?>

<?php
////////////////////////////
//アーカイブのタイトル
////////////////////////////
if (!is_home() && !is_search()) { ?>
  <h1 id="archive-title"><?php echo get_archive_chapter_text(); ?></h1>
<?php } ?>


<?php
////////////////////////////
//トップの広告
////////////////////////////
if (!is_home() || is_ads_top_page_visible())//メインページ以外は広告を出す
  get_template_part('ad-top');//記事トップ広告 ?>

<?php
////////////////////////////
//インデックスリストトップウィジェット
////////////////////////////
if ( is_active_sidebar( 'widget-index-top' ) ):
  echo '<div id="widget-index-top" class="widgets">';
  dynamic_sidebar( 'widget-index-top' );
  echo '</div>';
endif; ?>

<?php
////////////////////////////
//カテゴリ説明文の挿入
////////////////////////////
if (is_category() && //カテゴリページの時
          !is_paged() &&   //カテゴリページのトップの時
          category_description()) : //カテゴリの説明文が空でない時 ?>
<!-- カテゴリの説明文 -->
<div class="category-description"><?php echo category_description(); ?></div>
<?php endif; ?>

<?php
////////////////////////////
//タグ説明文の挿入
////////////////////////////
if (is_tag() && //タグページの時
          !is_paged() &&   //タグページのトップの時
          tag_description()) : //タグの説明文が空でない時 ?>
<!-- カテゴリの説明文 -->
<div class="category-description tag-description"><?php echo tag_description(); ?></div>
<?php endif; ?>

<div id="list">
<!-- 記事一覧 -->
<?php
////////////////////////////
//一覧の繰り返し処理
////////////////////////////
if (have_posts()) : // WordPress ループ
  $count = 0;
  while (have_posts()) : the_post(); // 繰り返し処理開始
    $count += 1;
    global $g_list_index;
    $g_list_index = $count-1;//インデックスなので-1

    //一覧リストのスタイル
    if ( is_list_style_bodies() ) {//一覧表示スタイルが本文表示
      get_template_part('entry-body');//一覧表示スタイルが本文表示の場合
    } else if ( is_list_style_large_cards() ){//大きなエントリーカードの場合
      get_template_part_card('entry-card-large');
    } else if ( is_list_style_large_card_just_for_first() ){//最初だけ大きなエントリーカードの場合
      //最初だけ大きなものであとは普通のエントリーカード
      if ( is_home() && !is_paged() && $count == 1 ) {
        get_template_part_card('entry-card-large');
      } else {
        get_template_part_card('entry-card');
      }
    } else if ( is_list_style_body_just_for_first() ){//最初だけ本文表示の場合
      //最初だけ本文表示であとは普通のエントリーカード
      if ( is_home() && !is_paged() && $count == 1 ) {
        get_template_part('entry-body');
      } else {
        get_template_part_card('entry-card');
      }
    } else {//エントリーカードか、大きなサムネイルカードの場合
      //一覧表示スタイルがカードor大きなサムネイルカード表示の場合
      get_template_part_card('entry-card');
    }

    //トップページ中間に広告を表示できるかどうか（表示するかどうか）
    if ( is_ads_list_in_middle_on_top_page_enable($count) ) {
      get_template_part('ad');
    }

    //3つ目のアイテムの下にインデックスリストミドルウィジェットを表示するか
    if ( $count == 3 && //3番目
      is_list_style_entry_type() && //表示タイプがエントリーカードタイプの時のみ
      is_active_sidebar( 'widget-index-middle' ) && //インデックスミドルに値が入っているとき
      !is_pagination_last_page() && //インデックスリストの最後のページでないとき
      is_posts_per_page_6_and_over() //1ページに表示する最大投稿数が6以上の時
    ) {
      echo '<div id="widget-index-middle" class="widgets">';
      dynamic_sidebar( 'widget-index-middle' );
      echo '</div>';

    }

  endwhile; // 繰り返し処理終了 ?>
  <div class="clear"></div>
<?php else : // ここから記事が見つからなかった場合の処理  ?>
    <div class="post">
      <h2>NOT FOUND</h2>
      <p><?php echo get_theme_text_not_found_message();//見つからない時のメッセージ ?></p>
    </div>
<?php
endif;
?>
</div><!-- /#list -->

<?php
////////////////////////////
//ボトムの広告
////////////////////////////
if (!is_home() || is_ads_top_page_visible()) ://メインページ以外は広告を出す
  get_template_part('ad-article-footer' );
endif; ?>

<?php
////////////////////////////
//インデックスリストボトムウィジェット
////////////////////////////
if ( is_active_sidebar( 'widget-index-bottom' ) ):
  echo '<div id="widget-index-bottom" class="widgets">';
  dynamic_sidebar( 'widget-index-bottom' );
  echo '</div>';
endif; ?>

<?php
////////////////////////////
//エントリーのページネーション
////////////////////////////
if ( is_list_pager_type_responsive() ) {
  //レスポンシブタイプのページネーション関数の呼び出し
  responsive_pagination();
} else {
  //旧タイプのページネーション
  get_template_part('pager-paginate-links');
}
?>