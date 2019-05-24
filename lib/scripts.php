<?php //CSSやJSファイルの呼び出し

if ( !function_exists( 'simplicity_scripts' ) ):
function simplicity_scripts() {
////////////////////////////////////////////////////////////////
//
//スタイルシートの呼び出し
//
////////////////////////////////////////////////////////////////

  ///////////////////////////////////////////
  //テーマスタイルの呼び出し
  ///////////////////////////////////////////
  wp_enqueue_style( 'simplicity-style', get_template_directory_uri() . '/style.css' );

  ///////////////////////////////////////////
  //PCでサイドバーをレスポンシブ表示設定がオンの時（完全レスポンシブ機能がオンの時とモバイルの時は設定関係なくレスポンシブ表示する）
  ///////////////////////////////////////////
  if ( is_responsive_pc_sidebar_enable() || is_responsive_enable() || is_mobile() ) {
    //パソコン用のレスポンシブスタイル
    wp_enqueue_style( 'responsive-style', get_template_directory_uri() . '/css/responsive-pc.css', array('simplicity-style') );
  }


  ///////////////////////////////////////////
  //スキンのスタイル
  ///////////////////////////////////////////
  if ( get_skin_file() ) {//設定されたスキンがある場合
    if ( get_pearts_base_skin() ) {//パーツスキンの場合
      //パーツスキンスタイル
      wp_enqueue_style( 'parts-skin-style',  get_parts_skin_file_uri(), array('simplicity-style') );
    } else {
      //通常のスキンスタイル
      wp_enqueue_style( 'skin-style',  get_skin_file(), array('simplicity-style') );
      // echo('<pre>');
      // var_dump(get_skins_js_local_dir());
      // echo('</pre>');
      //スキンフォルダ内にjavascript.jsファイルがあれば読み込む
      //var_dump(get_skins_js_local_dir());
      if ( file_exists( get_skins_js_local_dir() ) ) {
        wp_enqueue_script( 'skins-javascript-js', get_skins_js_uri(), array( 'jquery', 'simplicity-js' ), false, true );
      }
    }
  }

  // ///////////////////////////////////////////
  // //Font Awesome
  // ///////////////////////////////////////////
  //wp_enqueue_style( 'font-awesome-style', 'https://max'.'cdn.boots'.'trapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
  wp_enqueue_style( 'font-awesome-style',  get_template_directory_uri() . '/webfonts/css/font-awesome.min.css', array('simplicity-style') );

  ///////////////////////////////////////////
  //IcoMoonアイコンフォント
  ///////////////////////////////////////////
  wp_enqueue_style( 'icomoon-style',  get_template_directory_uri() . '/webfonts/icomoon/style.css', array('simplicity-style') );


  ///////////////////////////////////////////
  //Google Fonts
  ///////////////////////////////////////////
  if (!is_site_font_default()) {
    wp_enqueue_style( 'google-fonts-'.get_site_font_source(), get_site_font_source_url() );
  }



  ///////////////////////////////////////////
  //カレンダーウィジェットのスタイル
  ///////////////////////////////////////////
  if ( is_calendar_border_visible() ) {
    wp_enqueue_style( 'calendar-style',  get_template_directory_uri() . '/css/calendar.css', array('simplicity-style') );
  }

  ///////////////////////////////////////////
  //コメントのスタイル
  ///////////////////////////////////////////
  if ( is_comment_type_thread() ) {//2chコメントタイプ
    //スレッドスタイル
    wp_enqueue_style( 'thread-style',  get_template_directory_uri() . '/css/thread.css', array('simplicity-style') );
    //完全レスポンシブでないモバイル表示
    if ( is_mobile() && !is_responsive_enable() ) {
      //モバイルのスレッドスタイル
      wp_enqueue_style( 'thread-mobile-style',  get_template_directory_uri() . '/css/thread-mobile.css', array('simplicity-style') );
    }
    //完全レスポンシブ表示のとき
    if ( is_responsive_enable() ) {
      //レスポンシブのスレッドスタイル
      wp_enqueue_style( 'thread-responsive-style',  get_template_directory_uri() . '/css/thread-responsive.css', array('simplicity-style') );
    }
  //シンプルなスレッドコメントタイプ
  } elseif ( is_comment_type_thread_simple() ) {
    wp_enqueue_style( 'thread-simple-style',  get_template_directory_uri() . '/css/thread-simple.css', array('simplicity-style') );
  }

  ///////////////////////////////////////////
  //白抜きバイラルボタンのとき
  ///////////////////////////////////////////
  if ( ( !is_mobile() && is_share_button_type_viral_white() ) || //PC表示
     ( is_mobile() && is_share_button_type_mobile_viral_white() ) ) {
    wp_enqueue_style( 'sns-viral-white-style',  get_template_directory_uri() . '/css/sns-viral-white.css', array('simplicity-style') );
  }

  ///////////////////////////////////////////
  //完全レスポンシブ機能が有効のとき
  ///////////////////////////////////////////
  if ( is_responsive_enable() ) {
    //完全レスポンシブ表示用のスタイル
    wp_enqueue_style( 'responsive-mode-style',  get_template_directory_uri() . '/responsive.css', array('simplicity-style') );
  }

  ///////////////////////////////////////////
  //ソースコードのハイライト表示が有効のとき
  ///////////////////////////////////////////
  if ( is_code_highlight_enable() ) {
    //ソースコードハイライト表示用のスタイル
    wp_enqueue_style( 'code-highlight-style',  get_template_directory_uri() . '/highlight-js/styles/'.get_code_highlight_style().'.css' );
  }

  ///////////////////////////////////////////
  //モバイルか完全レスポンシブモードのとき
  ///////////////////////////////////////////
  if ( is_mobile() || is_responsive_enable() ) {
    ///////////////////////////////////////////
    //画面が狭い端末用のnarrow.css
    ///////////////////////////////////////////
    wp_enqueue_style( 'narrow-style',  get_template_directory_uri() . '/css/narrow.css', array('simplicity-style') );

    ///////////////////////////////////////////
    //設定されたスキンがある場合responsive.cssを読み込む
    ///////////////////////////////////////////
    $responsive_style_url = str_replace('style.css', 'responsive.css', get_skin_file());
    $responsive_style_file = url_to_local($responsive_style_url);
    if ( get_skin_file() && file_exists($responsive_style_file) ) {
     wp_enqueue_style( 'responsive-skin-style', $responsive_style_url, array('simplicity-style', 'skin-style') );
    }


    ///////////////////////////////////////////
    //YouTubeなどiframe関係のmedia.css
    ///////////////////////////////////////////
    wp_enqueue_style( 'media-style',  get_template_directory_uri() . '/css/media.css', array('simplicity-style') );

    ///////////////////////////////////////////
    //animatedModal.js関連ファイルの呼び出し
    ///////////////////////////////////////////
    if ( is_mobile_menu_type_modal() ) {
      wp_enqueue_style( 'animatedmodal-normalize-style',  get_template_directory_uri() . '/css/normalize.min.css', array('simplicity-style') );
      wp_enqueue_style( 'animatedmodal-animate-style',  get_template_directory_uri() . '/css/animate.min.css', array('simplicity-style') );
    }

  }

  ///////////////////////////////////////////
  //Simplicityモバイル
  ///////////////////////////////////////////
  if ( is_mobile() ) {
    ///////////////////////////////////////////
    //完全レスポンシブじゃないときだけモバイルスタイルを読み込む
    ///////////////////////////////////////////
    if ( !is_responsive_enable() ) {
      wp_enqueue_style( 'mobile-style',  get_template_directory_uri() . '/mobile.css', array('simplicity-style') );
    }

    ///////////////////////////////////////////
    //設定されたスキンがある場合mobile.cssを読み込む
    ///////////////////////////////////////////
    $mobile_style_url = str_replace('style.css', 'mobile.css', get_skin_file());
    $mobile_style_file = url_to_local($mobile_style_url);
    if ( get_skin_file() && file_exists($mobile_style_file) ) {
      wp_enqueue_style( 'mobile-skin-style', $mobile_style_url, array('simplicity-style', 'skin-style', 'mobile-style') );
    }

    ///////////////////////////////////////////
    //フッターモバイルボタンメニュー
    ///////////////////////////////////////////
    if ( is_mobile_menu_type_slide_in() ) {//スライドインメニューのとき
      if ( is_slide_in_light() ) {//スライドイン（ライト）のとき
        wp_enqueue_style( 'jquery-sidr-light-style',  get_template_directory_uri() . '/css/jquery.sidr.light.css', array('simplicity-style') );
        wp_enqueue_style( 'footer-mobile-buttons-style',  get_template_directory_uri() . '/css/footer-mobile-buttons.css', array('simplicity-style') );
        wp_enqueue_style( 'footer-mobile-buttons-light-style',  get_template_directory_uri() . '/css/footer-mobile-buttons-light.css', array('simplicity-style') );
      } elseif ( is_slide_in_dark() ) {//スライドイン（ダーク）のとき
        wp_enqueue_style( 'jquery-sidr-dark-style',  get_template_directory_uri() . '/css/jquery.sidr.dark.css', array('simplicity-style') );
        wp_enqueue_style( 'footer-mobile-buttons-style',  get_template_directory_uri() . '/css/footer-mobile-buttons.css', array('simplicity-style') );
        wp_enqueue_style( 'footer-mobile-buttons-dark-style',  get_template_directory_uri() . '/css/footer-mobile-buttons-dark.css', array('simplicity-style') );
      }

    }
  }

  ///////////////////////////////////////////
  //モバイルメニュータイプがアコーディオンツリーのとき
  ///////////////////////////////////////////
  if ( is_mobile_menu_type_accordion_tree() ) {
    //SlickNav用のスタイル
    wp_enqueue_style( 'slicknav-style',  get_template_directory_uri() . '/css/slicknav.css', array('simplicity-style') );
  }

  ///////////////////////////////////////////
  //拡張スタイル
  ///////////////////////////////////////////
  wp_enqueue_style( 'extension-style',  get_template_directory_uri() . '/css/extension.css', array('simplicity-style') );

  ///////////////////////////////////////////
  //テーマカスタマイザーでのスタイルの反映
  ///////////////////////////////////////////
  if ( is_external_custom_css_enable() && //カスタムCSSを外部ファイルに書き込む時
       css_custum_to_css_file() ) {//外部ファイルに書き出しがうまくいったとき
    wp_enqueue_style( 'simplicity-style-inline',  get_template_directory_uri() . '/css/css-custom.css', array('extension-style') );
  } else {//ヘッダーに埋め込む時
    ob_start();//バッファリング
    get_template_part('css-custom');
    $css_custom = ob_get_clean();
    //CSSの縮小化
    $css_custom = minify_css($css_custom);
    //HTMLにインラインでスタイルを書く
    wp_add_inline_style( 'extension-style', $css_custom, array('extension-style') );
  }


////////////////////////////////////////////////////////////////
//
//子テーマ用スタイルシートの呼び出し
//
////////////////////////////////////////////////////////////////

  ///////////////////////////////////////////
  //子テーマが存在しているときだけに呼び出すスタイル
  ///////////////////////////////////////////
  if ( is_child_theme_enable() ) {
    //子テーマのstyle.css
    wp_enqueue_style( 'child-style',  get_stylesheet_directory_uri() . '/style.css', array('simplicity-style', 'simplicity-style') );
    //子テーマのresponsive.css
    if ( is_responsive_enable() ) {
      //完全レスポンシブ表示用のスタイル
      wp_enqueue_style( 'child-responsive-mode-style',  get_stylesheet_directory_uri() . '/responsive.css', array('simplicity-style') );
    }
    //子テーマのmobile.css
    if ( is_mobile() && !is_responsive_enable() ) {
      wp_enqueue_style( 'child-mobile-style',  get_stylesheet_directory_uri() . '/mobile.css', array('simplicity-style') );
    }
  }


////////////////////////////////////////////////////////////////
//
//印刷用スタイル
//
////////////////////////////////////////////////////////////////


  ///////////////////////////////////////////
  //印刷時に本文部分のみを抽出するスタイル
  ///////////////////////////////////////////
  wp_enqueue_style( 'print-style',  get_template_directory_uri() . '/css/print.css', array('simplicity-style'), false, 'print' );


////////////////////////////////////////////////////////////////
//
//Wordpress関係スクリプトの呼び出し
//
////////////////////////////////////////////////////////////////

  ///////////////////////////////////////////
  //jQueryの読み込み
  ///////////////////////////////////////////
  //jQueryの読み込み（なくてもOKだけど一応明示）
  wp_enqueue_script('jquery');

  ///////////////////////////////////////////
  //コメント返信時のフォームの移動（WPライブラリから呼び出し）
  ///////////////////////////////////////////
  if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

  ///////////////////////////////////////////
  //Simplicity内で使用するJavaScript関数をまとめて定義する外部ファイルを呼び出す（javascript.js）
  ///////////////////////////////////////////
  wp_enqueue_script( 'simplicity-js', get_template_directory_uri() . '/javascript.js', array( 'jquery' ), false, true );

  ///////////////////////////////////////////
  //子テーマディレクトリ内のjavascript.jsファイルを呼び出す
  ///////////////////////////////////////////
  if ( file_exists_in_child_theme('javascript.js') ) {//子テーマフォルダ内にjavascript.jsがある場合
    wp_enqueue_script( 'simplicity-child-js', get_stylesheet_directory_uri() . '/javascript.js', array( 'simplicity-js' ), false, true );
  }

  ///////////////////////////////////////////
  //Masonryに関する記述（タイル状リスト）
  ///////////////////////////////////////////
  if ( !is_singular() && //投稿ページや固定ページ以外のとき
  is_list_style_tile_thumb_cards() && //タイル状リストのとき
  have_posts() ) {//投稿があるとき
    //Masonryライブラリの呼び出し（WPライブラリから呼び出し）
    wp_enqueue_script('jquery-masonry');
    //スクリプトに値を送る
    wp_localize_script('simplicity-js', 'do_masonry', array('enable' => true));
  }

  ///////////////////////////////////
  //独自シェアボタンに関する記述
  ///////////////////////////////////
  if ( is_singular() ) {//投稿・固定ページのみ
    //CSSの呼び出し
    if ( is_share_button_type_default() ||//SNS固有ボタンでもスタイルを利用
         is_share_button_type_twitter() ) {//独自ボタンでスタイルを利用
      //独自シェアボタン用のスタイルを呼び出す
      wp_enqueue_style( 'sns-twitter-type-style',  get_template_directory_uri() . '/css/sns-twitter-type.css', array('simplicity-style') );
    }

    //スクリプト用の設定
    if ( !is_share_button_type_default() || is_mobile() ) {
      wp_localize_script('simplicity-js', 'social_count_config', array(
        'permalink' => get_permalink(),
        'rss2_url' => get_bloginfo('rss2_url'),
        'theme_url' => get_template_directory_uri(),
        'all_sns_share_btns_visible' => is_all_sns_share_btns_visible() && !scc_exists(),
        'all_share_count_visible' => is_all_share_count_visible() && !scc_exists(),
        'twitter_btn_visible' => is_twitter_btn_visible(),
        'twitter_count_visible' => is_twitter_count_visible(),
        'facebook_btn_visible' => is_facebook_btn_visible(),
        'google_plus_btn_visible' => is_google_plus_btn_visible(),
        'hatena_btn_visible' => is_hatena_btn_visible(),
        'pocket_btn_visible' => is_pocket_btn_visible(),
        'feedly_btn_visible' => is_feedly_btn_visible(),
        'push7_btn_visible' => is_push7_btn_visible(),
        'push7_app_no' => get_push7_follow_app_no(),
        'facebook_count_visible' => get_fb_access_token(),
        'facebook_count' => fetch_facebook_count(get_permalink()),
      ));
    }
  }

  ///////////////////////////////////
  //ダミー画像生成スクリプトを呼び出す（開発用）
  ///////////////////////////////////
  if ( is_local_test() ) {//ローカルのテスト環境だった場合
    wp_enqueue_script( 'holder-js', get_template_directory_uri() . '/js/holder.js' );
  }

  ///////////////////////////////////
  //コメント欄の高さを文章量に応じて自動調整する
  ///////////////////////////////////
  if ( is_single() && is_comment_textarea_expand() ) {
    wp_enqueue_script( 'expanding-js', get_template_directory_uri() . '/js/expanding.js', array( 'jquery' ), false, true );
  }

  ///////////////////////////////////
  //画像の遅延読み込み（Lazy Load）の設定
  ///////////////////////////////////
  if ( is_lazy_load_enable() ) {
    ////Lazy Load jQueryプラグインの呼び出し
    wp_enqueue_script( 'jquery-lazyload-js', get_template_directory_uri() . '/js/jquery.lazyload.min.js', array( 'jquery' ), false, true );

    //Lazy Loadプラグインの実行
    $lazyload_config = array('threshold' => get_lazy_load_threshold());
    if (is_lazy_load_effect_enable()) {
      $lazyload_config['effect'] = 'fadeIn';
    }
    wp_localize_script( 'simplicity-js', 'lazyload_config', $lazyload_config );
    //Responsive Imagesを無効にする（HTML5のsrcset属性利用）
    remove_filter( 'the_content', 'wp_make_content_images_responsive' );
  }

  // ///////////////////////////////////
  // //Facebookアクセストークン
  // ///////////////////////////////////
  // if ( get_fb_access_token() ) {
  //   wp_localize_script( 'simplicity-js', 'facebookCount', fetch_facebook_count(get_permalink()) );
  //   //Responsive Imagesを無効にする（HTML5のsrcset属性利用）
  // }
  ///////////////////////////////////
  //画像リンク拡大効果がLightboxのとき
  ///////////////////////////////////
  if ( is_lightbox_enable() && //Lightboxが有効のとき
   //投稿・固定ページか、リストスタイルが本文表示の時だけ呼び出す
   ( is_singular() || is_list_style_bodies() ) ) {
    //Lightboxスタイルの呼び出し
    wp_enqueue_style( 'lightbox-style',  get_template_directory_uri() . '/lightbox/css/lightbox.css' );
    //Lightboxスクリプトの呼び出し
    wp_enqueue_script( 'lightbox-js', get_template_directory_uri() . '/lightbox/js/lightbox.js', array( 'jquery' ), false, true  );
  }

  ///////////////////////////////////
  //画像リンク拡大効果がLityのとき
  ///////////////////////////////////
  if ( is_lity_enable() && //Lityが有効のとき
   //投稿・固定ページか、リストスタイルが本文表示の時だけ呼び出す
   ( is_singular() || is_list_style_bodies() || is_list_style_body_just_for_first() ) ) {
    //Lityスタイルの呼び出し
    wp_enqueue_style( 'lity-style',  get_template_directory_uri() . '/css/lity.min.css' );
    //Lityスクリプトの呼び出し
    wp_enqueue_script( 'lity-js', get_template_directory_uri() . '/js/lity.min.js', array( 'jquery' ), false, true  );
  }

  ///////////////////////////////////
  //baguetteboxの呼び出し
  ///////////////////////////////////
  if ( is_baguettebox_enable() && //Lightboxが有効のとき
  //投稿・固定ページか、リストスタイルが本文表示の時だけ呼び出す
  ( is_singular() || is_list_style_bodies() ) ) {
    //baguettebox CSSの呼び出し
    wp_enqueue_style( 'baguettebox-style', get_template_directory_uri() . '/css/baguetteBox.min.css' );
    //baguetteboxスクリプトの呼び出し
    wp_enqueue_script( 'baguettebox-js', get_template_directory_uri() . '/js/baguetteBox.min.js', array(), false, true  );
    //実行コードの記入
    $data = "
          window.onload = function() {
            baguetteBox.run('.entry-content');
          };
    ";
    wp_add_inline_script( 'baguettebox-js', $data, 'after' );
  }


  // ///////////////////////////////////
  // //Evernoteに関する記述
  // ///////////////////////////////////
  // if ( is_singular() && is_evernote_btn_visible() ) {
  //   wp_enqueue_script( 'evernote-js', get_template_directory_uri() . '/js/noteit.js', array(), false, true  );
  // }

}
endif;
add_action( 'wp_enqueue_scripts', 'simplicity_scripts', 1 );
