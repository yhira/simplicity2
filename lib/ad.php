<?php //広告関係の関数

//H2見出しを判別する正規表現を定数にする
define('H2_REG', '/<h2.*?>/i');//H2見出しのパターン

//本文中にH2見出しが最初に含まれている箇所を返す（含まれない場合はnullを返す）
//H3-H6しか使っていない場合は、h2部分を変更してください
if ( !function_exists( 'get_h2_included_in_body' ) ):
function get_h2_included_in_body( $the_content ){
  if ( preg_match( H2_REG, $the_content, $h2results )) {//H2見出しが本文中にあるかどうか
    return $h2results[0];
  }
}
endif;

//最初のH2の手前に広告を挿入（最初のH2を置換）
if ( !function_exists( 'add_ads_before_1st_h2' ) ):
function add_ads_before_1st_h2($the_content) {
  if ( is_amp() ) {
    return $the_content;
  }
  if ( is_single() && //投稿ページのとき、固定ページも表示する場合はis_singular()にする
      ( is_ads_in_content() || //本文中表示設定のときもしくは
      (!is_ads_sidebar_top() && is_responsive_enable()) ) //サイドバー項目設定じゃないときでレスポンシブ設定のとき
  ) {
    //広告（AdSense）タグを記入
    ob_start();//バッファリング
    get_template_part('ad');//広告貼り付け用に作成したテンプレート
    $ad_template = ob_get_clean();
    $h2result = get_h2_included_in_body( $the_content );//本文にH2タグが含まれていれば取得
    if ( $h2result ) {//H2見出しが本文中にある場合のみ
      //最初のH2の手前に広告を挿入（最初のH2を置換）
      $count = apply_filters('add_ads_before_h2_count', 1);
      $the_content = preg_replace(H2_REG, $ad_template.$h2result, $the_content, $count);
    }
  }
  return $the_content;
}
endif;
add_filter('the_content', 'add_ads_before_1st_h2');


function get_all_post_count_in_publish(){
  global $wpdb;
  return intval($wpdb->get_var("SELECT count(*) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post'"));
}

//広告をトップページのリスト表示中間に掲載するか
if ( !function_exists( 'is_ads_list_in_middle_on_top_page_enable' ) ):
function is_ads_list_in_middle_on_top_page_enable($count){
  if (
      is_ads_performance_visible() &&//パフォーマンス追求広告を表示するとき
      is_ads_top_page_visible()  &&//トップページ広告が許可されているとき
      ($count == 3) && //3個目の表示のときのみ
      is_home() && //トップページリストのみ
      //!is_paged() && //2ページ目以降でないとき
      !is_pagination_last_page() && //ページネーションの最終ページでないとき
      (is_mobile() || is_responsive_enable() ) && //モバイルの時、もしくはレスポンシブ広告の時
      is_posts_per_page_6_and_over() && //1ページに表示する最大投稿数が6以上の時
      !is_ads_sidebar_top() && //サイドバー広告が表示されていないとき
      is_list_style_entry_type() && //エントリーカードタイプの一覧のとき
      //!is_list_style_tile_thumb_cards() && //タイル状リスト表示でないとき
      (get_all_post_count_in_publish() >= 6) //&&//公開記事が6以上の時
      //( !is_category() || ( get_the_category()[0]->count >= 3 ) )
  ) {
    return true;
  }
}
endif;

//広告を関連記事下に掲載するか
if ( !function_exists( 'is_ads_under_relations_enable' ) ):
function is_ads_under_relations_enable(){
  //$o = get_option('ads_options');
  if ( (is_ads_under_relations() ||
     ( is_ads_content_top() && !is_ads_performance_visible() )  || //関連記事下広告のとき
      ( is_mobile() && is_ads_in_content() ) || //モバイルの時も広告を表示
      ( is_mobile() && is_ads_content_top() ) || //モバイルの時も広告を表示
      //「本文中広告がオン」でも
      //本文中にH2タグがない時は広告を表示（必ず記事に広告が3つ表示されるように）
      !get_h2_included_in_body( get_the_content() ) ) && //本文中にH2見出しが含まれていないとき
      !is_ads_sidebar_top() &&//サイドバートップに広告が表示されていないとき
      ( !is_ads_content_top() || is_mobile() ) ||//パソコンでコンテンツ上部広告でないとき
      is_responsive_enable()
  ) {
    return true;
  } else {
    return false;
  }
}
endif;

//広告をサイドバーに掲載するか
if ( !function_exists( 'is_ads_sidebar_enable' ) ):
function is_ads_sidebar_enable(){
  //広告を表示しているとき
  if ( is_ads_visible() ) {
    if ( is_ads_sidebar_top() && //サイドバー広告のとき
             !is_404() && //404ページじゃないとき
             ( !is_home() || is_ads_top_page_visible() ) &&//トップページは「トップページ広告が許可」されている時だけ表示
             !is_mobile_menu_type_slide_in() &&//スライドイン表示でないとき
             (!is_mobile() || is_single()) &&//投稿ページ以外のモバイルページでは表示しない（固定ページは2つ縦に並んで表示される可能性があるので投稿ページのみ）
             (!is_mobile() || !is_bbpress_page()) //bbPressが生成したページのモバイルページでは表示しない（PCページでbbPressページ以外のとき）
    ) {
      return true;
    }
  }
}
endif;

//パフォーマンス追求（トップバナー広告）広告が有効化どうか
if ( !function_exists( 'is_ads_top_banner_enable' ) ):
function is_ads_top_banner_enable(){
  global $wp_query;
  if ( is_ads_visible() && is_ads_performance_visible() && !is_responsive_enable() ) {
    if ( is_page() ) {//個別ページのとき
      if ( is_mobile() ) {
        return true;
      } else {
        return !is_ads_sidebar_top() || is_ads_content_top();//サイドバートップ表示以外のとき
      }
    }elseif ( is_single() ){//投稿ページのとき
      if ( is_mobile() ) {
        return ( is_ads_in_content() && !get_h2_included_in_body(get_the_content()) ) || //本文中表示設定で本文で表示されていない場合
        is_ads_under_relations() || //関連記事表示のとき
        is_ads_sidebar_top() || //サイドバートップ表示のとき
        is_ads_content_top();//コンテンツトップ表示のとき
      } else {
        return is_ads_content_top();//コンテンツトップ表示のとき
      }
    }else{//その他、リスト表示のときなど
      if ( is_mobile() ) {
        //トップページ以外は必ず表示、トップページは表示がオンになっていたら
        return (!is_home() || is_ads_top_page_visible()) && !is_list_style_bodies() &&
          //表示アイテムが3つ以上あるとき
          ($wp_query->found_posts > 3);
      } else {
        //サイドバーに広告がなくて、トップページ以外か、TOPページ表示がオンになっているとき
        return !is_ads_sidebar_top() && ( !is_home() || is_ads_top_page_visible() || is_ads_content_top() ) && !is_list_style_bodies();
      }
    }
  }
}
endif;

//インデックスページの最後のページかどうか
if ( !function_exists( 'is_posts_per_page_6_and_over' ) ):
function is_posts_per_page_6_and_over(){
  return ( intval(get_option('posts_per_page')) >= 6 );
}
endif;

//インデックスページの最後のページかどうか
if ( !function_exists( 'is_pagination_last_page' ) ):
function is_pagination_last_page(){
  global $wp_query;
  //現在のページ数
  $now_page = get_query_var('paged') ? get_query_var('paged') : 1;
  //インデックスリストのページ数
  $max_page = intval($wp_query->max_num_pages);
  return ( $now_page == $max_page );
}
endif;

//[ad]ショートコードに対して広告を表示する
if ( !function_exists( 'replace_ad_shortcode_to_advertisement' ) ):
function replace_ad_shortcode_to_advertisement($the_content){
  $ad_shortcode = '[ad]';
  ob_start();//バッファリング
  if (is_amp()) {
    //get_template_part('ad-amp');//AMP用広告コート
  } else {
    get_template_part('ad');//通常ページ用広告コード
  }
  $ad_template = ob_get_clean();
  $the_content = preg_replace('{^(<p>)?'.preg_quote($ad_shortcode).'(</p>)?$}m', $ad_template, $the_content);
  //$the_content = str_replace($ad_shortcode, $ad_template, $the_content);
  return $the_content;
}
endif;
if (is_ads_ad_shortcode_enable()) {
  add_filter('the_content', 'replace_ad_shortcode_to_advertisement');
}
