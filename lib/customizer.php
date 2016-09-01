<?php //テーマカスタマイザーに関係する関数
include 'customizer-sanitize.php';//カスタマイザーサニタイズ関係の関数

//色を定数にする
define("LINK_COLOR", "");
define("LINK_HOVER_COLOR", "");
define("HEADER_OUTER_BACKGROUND_COLOR", "");
define("HEADER_INNER_BACKGROUND_COLOR", "");
define("SITE_TITLE_COLOR", "");
define("SITE_DESCRIPTION_COLOR", "");
define("MOBILE_BACKGROUND_COLOR", "");
define("NAVI_COLOR", "");
define("NAVI_LINK_COLOR", "");
define("NAVI_LINK_HOVER_COLOR", "");
define("MENU_BUTTON_COLOR", "");
define("MENU_BUTTON_BACKGROUND_COLOR", "");
define("GO_TO_TOP_BUTTON_COLOR", "");
define("GO_TO_TOP_BUTTON_BACKGROUND_COLOR", "");
define("FOOTER_COLOR", "");

//文字サイズ
define("ARTICLE_FONT_SIZE", "16");


add_action( 'customize_register', 'theme_customize_register' );
function theme_customize_register($wp_customize) {

  /////////////////////////////
  //色設定項目の書き換え
  /////////////////////////////
  $wp_customize->add_section( 'colors', array(
    'title' =>'色',
    'description' => is_tips_visible() ? 'テーマで使用している色を変更します。' : '',
    'priority' => 20,
  ));

  //リンク色
  $wp_customize->add_setting( 'link_color', array(
    'default' => LINK_COLOR,
    'sanitize_callback' => 'sanitize_text',
  ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
    'label' => __( 'リンク色', 'colors' ),
    'description' => is_tips_visible() ? '通常のリンク色です。（デフォルト色：#2098a8）' : '',
    'section' => 'colors',
    'settings' => 'link_color',
    'priority' => 15,
  ) ) );

  //リンク色ホバー
  $wp_customize->add_setting( 'link_hover_color', array(
    'default' => LINK_HOVER_COLOR,
    'sanitize_callback' => 'sanitize_text',
  ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_hover_color', array(
    'label' => __( 'リンクホバー色', 'colors' ),
    'description' => is_tips_visible() ? 'マウスカーソルが乗ったときのリンク色です。（デフォルト色：#cc0033）' : '',
    'section' => 'colors',
    'settings' => 'link_hover_color',
    'priority' => 20,
  ) ) );

  //ヘッダー外側色
  $wp_customize->add_setting( 'header_outer_background_color', array(
    'default' => HEADER_OUTER_BACKGROUND_COLOR,
    'sanitize_callback' => 'sanitize_text',
  ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_outer_background_color', array(
    'label' => __( 'ヘッダー外側背景色', 'colors' ),
    'description' => is_tips_visible() ? '画面幅いっぱいに広がるヘッダーの背景色です。（デフォルト色：transparent）' : '',
    'section' => 'colors',
    'settings' => 'header_outer_background_color',
    'priority' => 25,
  ) ) );

  //ヘッダー内側色
  $wp_customize->add_setting( 'header_inner_background_color', array(
    'default' => HEADER_INNER_BACKGROUND_COLOR,
    'sanitize_callback' => 'sanitize_text',
    ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_inner_background_color', array(
    'label' => __( 'ヘッダー内側背景色', 'colors' ),
    'description' => is_tips_visible() ? 'ヘッダー内側の背景色です。（デフォルト色：transparent）' : '',
    'section' => 'colors',
    'settings' => 'header_inner_background_color',
    'priority' => 26,
  ) ) );

  //サイトタイトル色
  $wp_customize->add_setting( 'site_title_color', array(
    'default' => SITE_TITLE_COLOR,
    'sanitize_callback' => 'sanitize_text',
    ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_title_color', array(
    'label' => __( 'サイトタイトル色', 'colors' ),
    'description' => is_tips_visible() ? 'サイトタイトルの文字色です。（デフォルト色：#222222）' : '',
    'section' => 'colors',
    'settings' => 'site_title_color',
    'priority' => 30,
  ) ) );

  //サイト概要色
  $wp_customize->add_setting( 'site_description_color', array(
    'default' => SITE_DESCRIPTION_COLOR,
    'sanitize_callback' => 'sanitize_text',
    ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_description_color', array(
    'label' => __( 'サイト概要色', 'colors' ),
    'description' => is_tips_visible() ? 'サイトキャッチフレーズの文字色です。（デフォルト色：#777777）' : '',
    'section' => 'colors',
    'settings' => 'site_description_color',
    'priority' => 40,
  ) ) );

  //モバイル時ヘッダー色
  $wp_customize->add_setting( 'mobile_background_color', array(
    'default' => MOBILE_BACKGROUND_COLOR,
    'sanitize_callback' => 'sanitize_text',
    ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mobile_background_color', array(
    'label' => __( 'モバイル時ヘッダー背景色', 'colors' ),
    'description' => is_tips_visible() ? '画面幅いっぱいに広がるモバイルヘッダーの背景色です。（デフォルト色：transparent）' : '',
    'section' => 'colors',
    'settings' => 'mobile_background_color',
    'priority' => 50,
  ) ) );

  //モバイルサイトタイトル色
  $wp_customize->add_setting( 'mobile_site_title_color', array(
    'default' => SITE_TITLE_COLOR,
    'sanitize_callback' => 'sanitize_text',
    ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mobile_site_title_color', array(
    'label' => __( 'モバイルサイトタイトル色', 'colors' ),
    'description' => is_tips_visible() ? 'モバイル時のサイトタイトルの文字色です。（デフォルト色：#222222）' : '',
    'section' => 'colors',
    'settings' => 'mobile_site_title_color',
    'priority' => 60,
  ) ) );

  //サイト概要色
  $wp_customize->add_setting( 'mobile_site_description_color', array(
    'default' => SITE_DESCRIPTION_COLOR,
    'sanitize_callback' => 'sanitize_text',
    ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mobile_site_description_color', array(
    'label' => __( 'モバイルサイト概要色', 'colors' ),
    'description' => is_tips_visible() ? 'モバイル時のサイトキャッチフレーズの文字色です。（デフォルト色：#777777）' : '',
    'section' => 'colors',
    'settings' => 'mobile_site_description_color',
    'priority' => 70,
  ) ) );

  //グローバルナビ色
  $wp_customize->add_setting( 'navi_color', array(
    'default' => NAVI_COLOR,
    'sanitize_callback' => 'sanitize_text',
    ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'navi_color', array(
    'label' => __( 'グローバルナビ色', 'colors' ),
    'description' => is_tips_visible() ? 'グローバルナビ（メインメニュー）の背景色です。（デフォルト色：#f7f7f7）' : '',
    'section' => 'colors',
    'settings' => 'navi_color',
    'priority' => 80,
  ) ) );

  //グローバルナビリンク色
  $wp_customize->add_setting( 'navi_link_color', array(
    'default' => NAVI_LINK_COLOR,
    'sanitize_callback' => 'sanitize_text',
    ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'navi_link_color', array(
    'label' => __( 'グローバルナビリンク色', 'colors' ),
    'description' => is_tips_visible() ? 'グローバルナビリンクの文字色です。（デフォルト色：#111111）' : '',
    'section' => 'colors',
    'settings' => 'navi_link_color',
    'priority' => 90,
  ) ) );

  //グローバルナビリンク色ホバー
  $wp_customize->add_setting( 'navi_link_hover_color', array(
    'default' => NAVI_LINK_HOVER_COLOR,
    'sanitize_callback' => 'sanitize_text',
    ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'navi_link_hover_color', array(
    'label' => __( 'グローバルナビリンクホバー色', 'colors' ),
    'description' => is_tips_visible() ? 'マウスカーソルが乗ったときのメニュー項目の背景色です。（デフォルト色：#dddddd）' : '',
    'section' => 'colors',
    'settings' => 'navi_link_hover_color',
    'priority' => 100,
  ) ) );

  //メニューボタン色
  $wp_customize->add_setting( 'menu_button_color', array(
    'default' => MENU_BUTTON_COLOR,
    'sanitize_callback' => 'sanitize_text',
    ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_button_color', array(
    'label' => __( 'メニューボタン色', 'colors' ),
    'description' => is_tips_visible() ? 'モバイル用メニュー表示ボタンのアイコン色です。（デフォルト色：#333333）' : '',
    'section' => 'colors',
    'settings' => 'menu_button_color',
    'priority' => 102,
  ) ) );

  //メニューボタン背景色
  $wp_customize->add_setting( 'menu_button_background_color', array(
    'default' => MENU_BUTTON_BACKGROUND_COLOR,
    'sanitize_callback' => 'sanitize_text',
    ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_button_background_color', array(
    'label' => __( 'メニューボタン背景色', 'colors' ),
    'description' => is_tips_visible() ? 'モバイル用メニュー表示ボタンの背景色です。（デフォルト色：transparent）' : '',
    'section' => 'colors',
    'settings' => 'menu_button_background_color',
    'priority' => 104,
  ) ) );

  //トップへ戻るボタン色
  $wp_customize->add_setting( 'go_to_top_button_color', array(
    'default' => GO_TO_TOP_BUTTON_COLOR,
    'sanitize_callback' => 'sanitize_text',
    ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'go_to_top_button_color', array(
    'label' => __( 'トップへ戻るボタン色', 'colors' ),
    'description' => is_tips_visible() ? 'トップに戻るボタンのアイコン色です。（デフォルト色：#ffffff）' : '',
    'section' => 'colors',
    'settings' => 'go_to_top_button_color',
    'priority' => 110,
  ) ) );

  //トップへ戻るボタン背景色
  $wp_customize->add_setting( 'go_to_top_button_background_color', array(
    'default' => GO_TO_TOP_BUTTON_BACKGROUND_COLOR,
    'sanitize_callback' => 'sanitize_text',
    ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'go_to_top_button_background_color', array(
    'label' => __( 'トップへ戻るボタン背景色', 'colors' ),
    'description' => is_tips_visible() ? 'トップに戻るボタンの背景色です。（デフォルト色：#aaaaaa）' : '',
    'section' => 'colors',
    'settings' => 'go_to_top_button_background_color',
    'priority' => 112,
  ) ) );

  //フッター色
  $wp_customize->add_setting( 'footer_color', array(
    'default' => FOOTER_COLOR,
    'sanitize_callback' => 'sanitize_text',
    ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_color', array(
    'label' => __( 'フッター色', 'colors' ),
    'description' => is_tips_visible() ? 'フッター部分の背景色です。（デフォルト色：#555555）' : '',
    'section' => 'colors',
    'settings' => 'footer_color',
    'priority' => 120,
  ) ) );


  /////////////////////////////
  //ヘッダー設定項目の書き換え
  /////////////////////////////
  $wp_customize->add_section( 'header_image', array(
    'title' =>'ヘッダー',
    'description' => is_tips_visible() ? 'ヘッダーで使用する画像や、ロゴ、グローバルナビの幅に関する設定です。' : '',
    'priority' => 30,
  ));

  //ヘッダーの高さ
  $wp_customize->add_setting('header_height', array(
    'default' => '100',
    'sanitize_callback' => 'sanitize_number',
  ));
  $wp_customize->add_control( 'header_height', array(
    'settings' => 'header_height',
    'label' => 'ヘッダーの高さpx（デフォルト：100）',
    'description' => is_tips_visible() ? '画面トップからグローバルメニューまでの高さです。（※ヘッダー画像の設定をする前に高さの設定推奨）' : '',
    'section' => 'header_image',
    'type' => 'number',
    'priority' => 20,
  ));

  //ロゴ画像
  $wp_customize->add_setting( 'header_logo_url', array(
    'sanitize_callback' => 'sanitize_file_url',
  ) );
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_logo_url', array(
    'settings' => 'header_logo_url',
    'label' =>'ロゴ画像',
    'description' => is_tips_visible() ? 'タイトルテキストの代わりとなるロゴ設定します。（※表示させるには「ロゴを画像にする」を有効にする必要あり）' : '',
    'section' => 'header_image',
    'priority' => 30,
  ) ) );

  //ロゴを画像にする
  $wp_customize->add_setting('header_logo_enable', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'header_logo_enable', array(
    'settings' => 'header_logo_enable',
    'label' =>'ロゴを画像にする',
    'description' => is_tips_visible() ? 'タイトルロゴを画像にするか。' : '',
    'section' => 'header_image',
    'type' => 'checkbox',
    'priority' => 40,
  ));

  //ヘッダー外側背景画像
  $wp_customize->add_setting( 'header_outer_background_image', array(
    'sanitize_callback' => 'sanitize_file_url',
  ) );
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_outer_background_image', array(
    'settings' => 'header_outer_background_image',
    'label' =>'ヘッダー外側背景画像',
    'description' => is_tips_visible() ? '画面幅いっぱいに広がるヘッダー画像を設定します。（※画像の高さは高めに設定しておいてください）<br><a href="http://wp-simplicity.com/how-to-set-big-header-image/">ヘッダー画像の設定方法</a>' : '',
    'section' => 'header_image',
    'priority' => 50,
  ) ) );

  //グローバルナビ横幅いっぱいにする
  $wp_customize->add_setting('layout_option_navi_wide', array(
    'sanitize_callback' => 'sanitize_check',
    ));
  $wp_customize->add_control( 'layout_option_navi_wide', array(
    'settings' => 'layout_option_navi_wide',
    'label' =>'グローバルナビを横幅いっぱいにする',
    'description' => is_tips_visible() ? 'グローバルナビを画面幅いっぱいに広げて「ヘッダー外側背景画像」に合わせるか。（※「色→グローバルナビ色」の設定も併せて行う必要があるかもしれません）<br><a href="http://wp-simplicity.com/how-to-set-big-header-image/">ヘッダー画像の設定方法設定方法</a>' : '',
    'section' => 'header_image',
    'type' => 'checkbox',
    'priority' => 55,
  ));

  //ヘッダーの高さ
  $wp_customize->add_setting('header_height_mobile', array(
    'default' => '0',
    'sanitize_callback' => 'sanitize_number',
  ));
  $wp_customize->add_control( 'header_height_mobile', array(
    'settings' => 'header_height_mobile',
    'label' => 'ヘッダーの高さpx（デフォルト：0）',
    'description' => is_tips_visible() ? 'モバイルでの画面トップからグローバルメニューまでの高さです。（※0にするとデフォルト設定になります）' : '',
    'section' => 'header_image',
    'type' => 'number',
    'priority' => 57,
  ));

  //モバイルヘッダー背景画像
  $wp_customize->add_setting( 'mobile_header_background_image', array(
    'sanitize_callback' => 'sanitize_file_url',
  ) );
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mobile_header_background_image', array(
    'settings' => 'mobile_header_background_image',
    'label' =>'モバイルヘッダー背景画像',
    'description' => is_tips_visible() ? '画面幅いっぱいに広がるモバイルヘッダー画像を設定します。（※画像の高さは高めに設定しておいてください）<a href="http://wp-simplicity.com/how-to-set-big-header-image/" target="_blank" class="example-setting">設定例</a>
' : '',
    'section' => 'header_image',
    'priority' => 60,
  ) ) );


  /////////////////////////////
  //スキン設定項目の追加
  /////////////////////////////
  $wp_customize->add_section( 'skin_section', array(
    'title'          =>'スキン',
    'description' => is_tips_visible() ? 'Simplicityの外観を手軽に変更します。詳細は、<a href="http://wp-simplicity.com/skin/" target="_blank" class="example-setting">スキンの使い方</a>を参照してください。<br>パーツスキンに関しては<a href="http://wp-simplicity.com/skin-parts/">パーツスキンの使い方</a>を参照してください。' : '',
    'priority'       => 88,
  ));

  //スキンの種類
  $wp_customize->add_setting('skin_file', array(
    'default' => null,//デフォルト値
    'sanitize_callback' => 'sanitize_text',
  ));
  $skins = get_skin_files();//スキンファイル情報の取得
  $radio_items = array(
    '' => '選択しない（デフォルト）' ,//デフォルト値
  );
  foreach ($skins as $skin) {
    $radio_items += array($skin['path'] => $skin['name']);
  }
  $wp_customize->add_control( 'skin_file', array(
    'settings' => 'skin_file',
    'label' =>'スキン選択',
    'description' => is_tips_visible() ? '手軽にデザインを変更することができます。[P]マークがついているものは、フォルダ内のCSSファイルを結合して適用表示するパーツスキンです。※スキンで設定されたスタイルは親テーマ・子テーマで設定されたものより優先されます。' : '',
    'section' => 'skin_section',
    'type' => 'radio',
    'choices'    => $radio_items,
    'priority' => 10, //優先度（並び順）
  ));

  /////////////////////////////
  //レイアウト（全体）設定項目の追加
  /////////////////////////////
  $wp_customize->add_section( 'layout_section', array(
    'title'          =>'レイアウト（全体・リスト）',
    'description' => is_tips_visible() ? 'サイト全体や一覧リストページのレイアウトに関する設定です。' : '',
    'priority'       => 89,
  ));

  //完全レスポンシブデザインにする
  $wp_customize->add_setting('responsive_enable', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'responsive_enable', array(
    'settings' => 'responsive_enable',
    'label' =>'完全レスポンシブ表示を有効',
    'description' => is_tips_visible() ? 'パソコンとモバイルでシームレスな完全なレスポンシブデザイン表示になります。' : '',
    'section' => 'layout_section',
    'type' => 'checkbox',
    'priority' => 1,
  ));

  if ( !is_responsive_enable() ):
  //PCでサイドバーをレスポンシブ表示（※完全レスポンシブがオフの時のみに有効な設定）
  $wp_customize->add_setting('responsive_pc_sidebar_enable', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'responsive_pc_sidebar_enable', array(
    'settings' => 'responsive_pc_sidebar_enable',
    'label' =>'PCでサイドバーをレスポンシブ表示',
    'description' => is_tips_visible() ? 'PC表示時にサイドバーをレスポンシブ表示するか。オフにするとレスポンシブ表示されません。（※完全レスポンシブ機能がオフの時のみ有効な設定）' : '',
    'section' => 'layout_section',
    'type' => 'checkbox',
    'priority' => 5,
  ));
  endif;

  //タブレットはモバイル表示
  $wp_customize->add_setting('tablet_mobile', array(
    'default' => false,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'tablet_mobile', array(
    'settings' => 'tablet_mobile',
    'label' =>'タブレットはモバイル表示',
    'description' => is_tips_visible() ? 'タブレット端末をモバイルとして表示するか。' : '',
    'section' => 'layout_section',
    'type' => 'checkbox',
    'priority' => 7,
  ));

  //タイトルの中央寄せ
  $wp_customize->add_setting('title_center', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'title_center', array(
    'settings' => 'title_center',
    'label' => 'サイトタイトルの中央寄せ',
    'description' => is_tips_visible() ? 'サイトのタイトルをヘッダーの中央にするか。（※トップのフォローボタンは表示されなくなります）' : '',
    'section' => 'layout_section',
    'type' => 'checkbox',
    'priority' => 10
  ));

  //グローバルナビを表示
  $wp_customize->add_setting('navi_visible', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'navi_visible', array(
    'settings' => 'navi_visible',
    'label' =>'グローバルナビを表示',
    'description' => is_tips_visible() ? 'グローバルナビ（メインメニュー）を表示させたくないときはオフにしてください。' : '',
    'section' => 'layout_section',
    'type' => 'checkbox',
    'priority' => 20
  ));

  //モバイルメニュータイプ
  $radio_items = array();
  $radio_items += array(
    'accordion' => 'アコーディオン（デフォルト）',
    'accordion_tree' => 'アコーディオンツリー',
    'modal' => 'モーダルメニュー'
  );
  if ( !is_responsive_enable() ) $radio_items += array(
    'slide_in_light_top' => 'スライドインライト（ボタン上）',
    'slide_in_light_bottom' => 'スライドインライト（ボタン下）',
    'slide_in_dark_top' => 'スライドインダーク（ボタン上）',
    'slide_in_dark_bottom' => 'スライドインダーク（ボタン下）',
  );
  $wp_customize->add_setting('mobile_menu_type', array(
    'default' => 'accordion',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'mobile_menu_type', array(
    'settings' => 'mobile_menu_type',
    'label' =>'モバイルメニュータイプ',
    'description' => is_tips_visible() ? 'モバイル時、メニューボタンを押したときのスタイルです。（※スライドイン機能は「完全レスポンシブ」機能がオンの時は利用できません）' : '',
    'section' => 'layout_section',
    'type' => 'radio',
    'choices'    => $radio_items,
    'priority' => 24,
  ));

  //スライドインメニューを日本語表示
  $wp_customize->add_setting('mobile_menu_japanese', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'mobile_menu_japanese', array(
    'settings' => 'mobile_menu_japanese',
    'label' =>'スライドインメニューを日本語表示',
    'description' => is_tips_visible() ? 'スライドインメニューを日本語で表示するか。（※モバイルメニュータイプをスライドイン選択しているとき。' : '',
    'section' => 'layout_section',
    'type' => 'checkbox',
    'priority' => 25
  ));

  //リストスタイル
  $wp_customize->add_setting('list_style', array(
    'default' => 'cards',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'list_style', array(
    'settings' => 'list_style',
    'label' =>'一覧リストのスタイル',
    'description' => is_tips_visible() ? '一覧（インデックス）ページの表示スタイル設定。' : '',
    'section' => 'layout_section',
    'type' => 'radio',
    'choices'    => array(
      'cards' => 'エントリーカード（デフォルト）',
      'large_cards' => '大きなエントリーカード',
      'large_card_just_for_first' => '最初だけ大きなエントリーカード',
      'bodies' => '本文表示',
      'body_just_for_first' => '最初だけ本文表示',
      'bodies' => '本文表示',
      'large_thumb' => 'サムネイル大',
      'tile_thumb_2columns' => 'タイル2列',
      'tile_thumb_3columns' => 'タイル3列',
      'tile_thumb_2columns_raw' => 'タイル2列 画像縦横比保存（要再生成）',
      'tile_thumb_3columns_raw' => 'タイル3列 画像縦横比保存（要再生成）',
    ),
    'priority' => 40,
  ));

  //モバイルで1ページに表示する最大投稿数
  $wp_customize->add_setting('posts_per_page_mobile', array(
    'default' => '10',
    'sanitize_callback' => 'sanitize_number',
  ));
  $wp_customize->add_control( 'posts_per_page_mobile', array(
    'settings' => 'posts_per_page_mobile',
    'label' =>'モバイルで1ページに表示する最大投稿数（デフォルト：10）',
    'description' => is_tips_visible() ? 'モバイルのインデックスリストに表示される最大投稿数を設定します。' : '',
    'section' => 'layout_section',
    'type' => 'number',
    'priority' => 45,
  ));

  //固定ページを一覧に含める
  $wp_customize->add_setting('page_include_in_list', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'page_include_in_list', array(
    'settings' => 'page_include_in_list',
    'label' =>'固定ページも一覧リストに含める',
    'description' => is_tips_visible() ? '固定ページを一覧リスト（インデックス）に含めるか。' : '',
    'section' => 'layout_section',
    'type' => 'checkbox',
    'priority' => 50,
  ));

  //エントリーカード全体をリンク化
  $wp_customize->add_setting('wraped_entry_card', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'wraped_entry_card', array(
    'settings' => 'wraped_entry_card',
    'label' =>'エントリーカード全体をリンク化',
    'description' => is_tips_visible() ? 'インデックスリスト・関連記事のエントリーカードやブログカード全体をAタグで囲ってリンク化するか。' : '',
    'section' => 'layout_section',
    'type' => 'checkbox',
    'priority' => 55,
  ));

  //サムネイル表示
  $wp_customize->add_setting('thumbnail_visible', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'thumbnail_visible', array(
    'settings' => 'thumbnail_visible',
    'label' =>'サムネイル表示',
    'description' => is_tips_visible() ? 'サムネイルを表示するか。（※テキスト主体ページなどではオフ）' : '',
    'section' => 'layout_section',
    'type' => 'checkbox',
    'priority' => 60,
  ));

  //サムネイルの丸め
  $wp_customize->add_setting('thumbnail_radius', array(
    'default' => 'default',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'thumbnail_radius', array(
    'settings' => 'thumbnail_radius',
    'label' =>'サムネイルの角の丸め具合',
    'description' => is_tips_visible() ? 'サムネイル角のスタイル。' : '',
    'section' => 'layout_section',
    'type' => 'radio',
    'choices'    => array(
      'default' => '丸めない（デフォルト）',
      'radius_10px' => '角を丸める',
      'circle' => '円形にする',
    ),
    'priority' => 70,
  ));

  //抜粋文字数
  $wp_customize->add_setting('excerpt_length', array(
    'default' => '70',
    'sanitize_callback' => 'sanitize_number',
  ));
  $wp_customize->add_control( 'excerpt_length', array(
    'settings' => 'excerpt_length',
    'label' =>'抜粋文字数（デフォルト：70）',
    'description' => is_tips_visible() ? 'インデックスリストや関連記事、ブログカードで表示される抜粋文字の文字数を設定します。' : '',
    'section' => 'layout_section',
    'type' => 'number',
    'priority' => 80,
  ));

  //抜粋の末尾文字
  $wp_customize->add_setting('excerpt_more', array(
    'default' => '...',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'excerpt_more', array(
    'settings' => 'excerpt_more',
    'label' =>'抜粋の末尾文字（デフォルト：...）',
    'description' => is_tips_visible() ? '抜粋文の末尾に付属する文字列を設定します。' : '',
    'section' => 'layout_section',
    'type' => 'text',
    'priority' => 90,
  ));

  //Wordpress固有の抜粋文を使用する
  $wp_customize->add_setting('wordpress_excerpt', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'wordpress_excerpt', array(
    'settings' => 'wordpress_excerpt',
    'label' =>'投稿画面の「抜粋」項目を利用',
    'description' => is_tips_visible() ? '記事一覧・ブログカードのスニペットに投稿管理画面で設定した「抜粋」テキストを使用します。（※未入力の場合は記事冒頭の抜粋文）' : '',
    'section' => 'layout_section',
    'type' => 'checkbox',
    'priority' => 100,
  ));

  //サイドバーの幅を336pxに
  $wp_customize->add_setting('sidebar_width_336', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'sidebar_width_336', array(
    'settings' => 'sidebar_width_336',
    'label' =>'サイドバーの幅を336pxに（デフォルト300px）',
    'description' => is_tips_visible() ? 'サイドバーを「レクタングル（大）」幅に設定します。（※ヘッダー画像を既に設定している場合は要再設定）' : '',
    'section' => 'layout_section',
    'type' => 'checkbox',
    'priority' => 110,
  ));

  //サイドバーの背景を白色に
  $wp_customize->add_setting('sidebar_background_white', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'sidebar_background_white', array(
    'settings' => 'sidebar_background_white',
    'label' =>'サイドバーの背景を白色に',
    'description' => is_tips_visible() ? 'サイドバーの背景色を白色に設定します。（※背景画像などを設定して、サイドバーが見づらくなったときなどに）' : '',
    'section' => 'layout_section',
    'type' => 'checkbox',
    'priority' => 115,
  ));

  //サイドバーを左側に表示
  $wp_customize->add_setting('sidebar_left', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'sidebar_left', array(
    'settings' => 'sidebar_left',
    'label' =>'サイドバーを左側に表示',
    'description' => is_tips_visible() ? 'サイドバーを左側に表示するようにレイアウトを変更します。' : '',
    'section' => 'layout_section',
    'type' => 'checkbox',
    'priority' => 120,
  ));

  //検索ボックスのスタイル
  $wp_customize->add_setting('search_box_style', array(
    'default' => 'white_rect',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'search_box_style', array(
    'settings' => 'search_box_style',
    'label' =>'検索ボックスのスタイル',
    'description' => is_tips_visible() ? '検索ボックスのデザイン設定。<a href="http://wp-simplicity.com/searchform-style/" target="_blank" class="example-setting">設定方法</a>' : '',
    'section' => 'layout_section',
    'type' => 'radio',
    'choices'    => array(
      'white_rect' => 'ホワイト四角（デフォルト）',
      'white_circle' => 'ホワイト丸型',
      'gray_rect' => 'グレー四角',
      'gray_circle' => 'グレー丸型',
    ),
    'priority' => 130,
  ));

  //ページネーションタイプ
  $wp_customize->add_setting('list_pager_type', array(
    'default' => 'responsive',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'list_pager_type', array(
    'settings' => 'list_pager_type',
    'label' =>'ページネーションタイプ',
    'description' => is_tips_visible() ? 'インデックス一覧リストのページ送りのタイプ設定です。' : '',
    'section' => 'layout_section',
    'type' => 'radio',
    'choices'    => array(
      'responsive' => 'レスポンシブ（デフォルト）',
      'old_pager' => '旧ページネーション',
    ),
    'priority' => 135,
  ));

  //フッターを背景色と同じにする
  $wp_customize->add_setting('footer_transparent', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'footer_transparent', array(
    'settings' => 'footer_transparent',
    'label' =>'フッターを背景色と同じにする',
    'description' => is_tips_visible() ? 'フッターを透過色にして背景を表示します。' : '',
    'section' => 'layout_section',
    'type' => 'checkbox',
    'priority' => 140,
  ));

  //メニューボタンアイコン
  $wp_customize->add_setting('menu_button_icon_font', array(
    'default' => 'fa-bars',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'menu_button_icon_font', array(
    'settings' => 'menu_button_icon_font',
    'label' =>'メニューボタンのアイコン（デフォルト：fa-bars）',
    'description' => is_tips_visible() ? 'メニュー表示ボタンのアイコンフォントを設定します。アコーディオンツリーメニューのアイコンは変更できません。（※設定用のコードはFont Awesomeから取得します）<a href="http://wp-simplicity.com/button-icon-font-change/" target="_blank" class="example-setting">設定方法</a>' : '',
    'section' => 'layout_section',
    'type' => 'text',
    'priority' => 140,
  ));

  //トップへ戻るボタンの表示
  $wp_customize->add_setting('go_to_top_button_visible', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'go_to_top_button_visible', array(
    'settings' => 'go_to_top_button_visible',
    'label' =>'トップへ戻るボタンの表示',
    'description' => is_tips_visible() ? 'トップへ戻るボタンを表示するか。' : '',
    'section' => 'layout_section',
    'type' => 'checkbox',
    'priority' => 150,
  ));

  //トップへ戻るボタンアイコン
  $wp_customize->add_setting('go_to_top_button_icon_font]', array(
    'default' => 'fa-angle-double-up',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'go_to_top_button_icon_font', array(
    'settings' => 'go_to_top_button_icon_font',
    'label' =>'トップへ戻るボタンのアイコン（デフォルト：fa-angle-double-up）',
    'description' => is_tips_visible() ? 'トップへ戻るボタンのアイコンフォントを設定します。（※設定用のコードはFont Awesomeから取得します）<a href="http://wp-simplicity.com/button-icon-font-change/" target="_blank" class="example-setting">設定方法</a>' : '',
    'section' => 'layout_section',
    'type' => 'text',
    'priority' => 160,
  ));

  //トップへ戻るボタンに画像を指定
  $wp_customize->add_setting( 'go_to_top_button_image', array(
    'sanitize_callback' => 'sanitize_file_url',
  ) );
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'go_to_top_button_image', array(
    'settings' => 'go_to_top_button_image',
    'label' =>'トップへ戻るボタンに画像を指定',
    'description' => is_tips_visible() ? 'こちらに画像が指定されている場合は、アイコンフォントが画像に入れ替わります。' : '',
    'section' => 'layout_section',
    'priority' => 170,
  ) ) );

  //カレンダーウィジェットに枠線を表示
  $wp_customize->add_setting('calendar_border_visible', array(
    'default' => false,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'calendar_border_visible', array(
    'settings' => 'calendar_border_visible',
    'label' =>'カレンダーに枠線を表示',
    'description' => is_tips_visible() ? 'カレンダーウィジェットに枠線を表示します。' : '',
    'section' => 'layout_section',
    'type' => 'checkbox',
    'priority' => 180,
  ));

  //404イメージ
  $wp_customize->add_setting( '404_image', array(
    'sanitize_callback' => 'sanitize_file_url',
  ) );
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, '404_image', array(
    'settings' => '404_image',
    'label' => '404イメージ',
    'description' => is_tips_visible() ? '404ページに表示するイメージを設定してください' : '',
    'section' => 'layout_section',
    'priority' => 200,
  ) ) );


  /////////////////////////////
  //レイアウト（ページ）設定項目の追加
   /////////////////////////////
  $wp_customize->add_section( 'layout_singular_section', array(
    'title'          =>'レイアウト（投稿・固定ページ）',
    'description' => is_tips_visible() ? '投稿・固定ページのレイアウトに関する設定です。' : '',
    'priority'       => 89.5,
  ));

  //本文文字サイズ
  $wp_customize->add_setting('article_font_size', array(
    'default' => ARTICLE_FONT_SIZE,
    'sanitize_callback' => 'sanitize_number',
  ));
  $wp_customize->add_control( 'article_font_size', array(
    'settings' => 'article_font_size',
    'label' =>'本文文字サイズ（全角文字数）',
    'description' => is_tips_visible() ? 'パソコン表示時の本文文字サイズを設定します。' : '',
    'section' => 'layout_singular_section',
    'type' => 'radio',
    'choices'    => array(
      '14' => '14px（1行48文字くらい）',
      '15' => '15px（1行45文字くらい）',
      '16' => '16px（1行42文字くらい：デフォルト）',
      '17' => '17px（1行40文字くらい）',
      '18' => '18px（1行37文字くらい）',
      '19' => '19px（1行35文字くらい）',
    ),
    'priority' => 3,
  ));

//モバイル本文文字サイズ
  $wp_customize->add_setting('article_mobile_font_size', array(
    'default' => ARTICLE_FONT_SIZE,
    'sanitize_callback' => 'sanitize_number',
  ));
  $wp_customize->add_control( 'article_mobile_font_size', array(
    'settings' => 'article_mobile_font_size',
    'label' =>'モバイル本文文字サイズ',
    'description' => is_tips_visible() ? '主にスマホ表示時の本文文字サイズを設定します。' : '',
    'section' => 'layout_singular_section',
    'type' => 'radio',
    'choices'    => array(
      '14' => '14px',
      '15' => '15px',
      '16' => '16px（デフォルト）',
      '17' => '17px',
      '18' => '18px',
      '19' => '19px',
    ),
    'priority' => 4,
  ));

  //長い単語を強制改行する
  $wp_customize->add_setting('word_wrap_break_word', array(
    'default' => false,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'word_wrap_break_word', array(
    'settings' => 'word_wrap_break_word',
    'label' =>'長い単語を必要に応じて改行する',
    'description' => is_tips_visible() ? '必要に応じて長い単語やURLを要素からはみ出さないように改行します。ただし、この機能を有効にすると単語の途中で改行されることもあります。' : '',
    'section' => 'layout_singular_section',
    'type' => 'checkbox',
    'priority' => 6,
  ));

  //モバイルで改行を表示する
  $wp_customize->add_setting('br_visible_with_mobile', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'br_visible_with_mobile', array(
    'settings' => 'br_visible_with_mobile',
    'label' =>'モバイルで<br>を表示',
    'description' => is_tips_visible() ? '画面幅の狭いモバイル端末でbr改行を表示するか。' : '',
    'section' => 'layout_singular_section',
    'type' => 'checkbox',
    'priority' => 7,
  ));

  //投稿日の表示
  $wp_customize->add_setting('create_date_visible', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'create_date_visible', array(
    'settings' => 'create_date_visible',
    'label' =>'投稿日の表示',
    'description' => is_tips_visible() ? '投稿日を表示するか。（※一覧リストにも表示されます。）（※非表示にするとGoogle Search Consoleで構造化データエラーが出る可能性があります。）' : '',
    'section' => 'layout_singular_section',
    'type' => 'checkbox',
    'priority' => 7,
  ));

  //現在との時間差の表示
  $wp_customize->add_setting('human_time_diff_visible', array(
    'default' => false,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'human_time_diff_visible', array(
    'settings' => 'human_time_diff_visible',
    'label' =>'投稿日と現在との時間差を表示',
    'description' => is_tips_visible() ? '現在から投稿日を差し引いた人間の感覚的な時間差を表示します。' : '',
    'section' => 'layout_singular_section',
    'type' => 'checkbox',
    'priority' => 7.1,
  ));

  //更新日の表示
  $wp_customize->add_setting('update_date_visible', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'update_date_visible', array(
    'settings' => 'update_date_visible',
    'label' =>'更新日の表示',
    'description' => is_tips_visible() ? '更新日を表示するか。（※非表示にするとGoogle Search Consoleで構造化データエラーが出る可能性があります。）' : '',
    'section' => 'layout_singular_section',
    'type' => 'checkbox',
    'priority' => 8,
  ));

  //カテゴリ情報の表示
  $wp_customize->add_setting('category_visible', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'category_visible', array(
    'settings' => 'category_visible',
    'label' =>'カテゴリ情報の表示',
    'description' => is_tips_visible() ? 'カテゴリ情報を表示するか。（※一覧リストにも表示されます）' : '',
    'section' => 'layout_singular_section',
    'type' => 'checkbox',
    'priority' => 9,
  ));

  //コメント数の表示
  $wp_customize->add_setting('comment_count_visible', array(
    'default' => false,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'comment_count_visible', array(
    'settings' => 'comment_count_visible',
    'label' =>'コメント数の表示',
    'description' => is_tips_visible() ? 'コメント数リンクを表示するか。（※コメントの設定でコメントを表示にしていないと表示されません。）' : '',
    'section' => 'layout_singular_section',
    'type' => 'checkbox',
    'priority' => 9.5,
  ));

  //タグ情報の表示
  $wp_customize->add_setting('tag_visible', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'tag_visible', array(
    'settings' => 'tag_visible',
    'label' =>'タグ情報の表示',
    'description' => is_tips_visible() ? '本文フッター部分にあるタグ情報を表示するか。' : '',
    'section' => 'layout_singular_section',
    'type' => 'checkbox',
    'priority' => 10,
  ));

  //投稿者情報の表示
  $wp_customize->add_setting('author_visible', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'author_visible', array(
    'settings' => 'author_visible',
    'label' =>'投稿者情報の表示',
    'description' => is_tips_visible() ? '本文フッター部分にある投稿者情報を表示するか。（※構造化データに必要な情報が含まれているのでオフにすると、Google Search Consoleの構造化データエラーが出ます。）' : '',
    'section' => 'layout_singular_section',
    'type' => 'checkbox',
    'priority' => 20,
  ));

  //投稿者情報にTwitterIDを表示
  $wp_customize->add_setting('twitter_follow_id_author_visible', array(
    'default' => false,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'twitter_follow_id_author_visible', array(
    'settings' => 'twitter_follow_id_author_visible',
    'label' =>'投稿者情報をTwitter IDに',
    'description' => is_tips_visible() ? '投稿者にTwitterのIDリンクを表示します。（※SNS設定でTwitter ID設定がされている必要があります。）' : '',
    'section' => 'layout_singular_section',
    'type' => 'checkbox',
    'priority' => 21,
  ));

  //編集リンクの表示
  $wp_customize->add_setting('edit_visible', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'edit_visible', array(
    'settings' => 'edit_visible',
    'label' =>'編集リンクの表示',
    'description' => is_tips_visible() ? '投稿・固定ページの管理画面に直接アクセスするための編集リンクを表示するか。' : '',
    'section' => 'layout_singular_section',
    'type' => 'checkbox',
    'priority' => 30,
  ));

  //本文先頭にアイキャッチを表示
  $wp_customize->add_setting('eye_catch_visible', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'eye_catch_visible', array(
    'settings' => 'eye_catch_visible',
    'label' =>'本文先頭にアイキャッチ画像を表示',
    'description' => is_tips_visible() ? '投稿・固定ページ管理画面で設定したアイキャッチを自動で本文トップに挿入するか。' : '',
    'section' => 'layout_singular_section',
    'type' => 'checkbox',
    'priority' => 32,
  ));

  //本文先頭のアイキャッチにキャプションを表示
  $wp_customize->add_setting('eye_catch_caption_visible', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'eye_catch_caption_visible', array(
    'settings' => 'eye_catch_caption_visible',
    'label' =>'先頭のアイキャッチにキャプションを表示',
    'description' => is_tips_visible() ? '先頭のアイキャッチにキャプションが設定されているとき表示するか。（※「本文先頭にアイキャッチ画像を表示」設定が有効の場合のみ）' : '',
    'section' => 'layout_singular_section',
    'type' => 'checkbox',
    'priority' => 33,
  ));

  //引用部分の幅を広げる
  $wp_customize->add_setting('blockquote_wide', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'blockquote_wide', array(
    'settings' => 'blockquote_wide',
    'label' =>'引用部分の幅を広げる',
    'description' => is_tips_visible() ? '引用部分の横幅を広げ表示エリアを増やします。<a href="http://wp-simplicity.com/blockquote-css/" target="_blank" class="example-setting">詳細</a>' : '',
    'section' => 'layout_singular_section',
    'type' => 'checkbox',
    'priority' => 35,
  ));

  //関連記事の表示
  $wp_customize->add_setting('related_entry_visible', array(
     'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'related_entry_visible', array(
    'settings' => 'related_entry_visible',
    'label' =>'関連記事の表示',
    'description' => is_tips_visible() ? '本文下の関連記事を表示するか。' : '',
    'section' => 'layout_singular_section',
    'type' => 'checkbox',
    'priority' => 36,
  ));

  //関連記事タイプ
  $wp_customize->add_setting('related_entry_type', array(
    'default' => 'default',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'related_entry_type', array(
    'settings' => 'related_entry_type',
    'label' =>'関連記事表示タイプ',
    'description' => is_tips_visible() ? '関連記事の表示スタイルの設定です。' : '',
    'section' => 'layout_singular_section',
    'type' => 'radio',
    'choices'    => array(
      'default' => 'デフォルト（推奨表示数3-10）',
      'thumbnail' => 'サムネイル3列（推奨表示数3, 6, 9）',
      'thumbnail4' => 'サムネイル4列（推奨表示数4, 8, 12）',
    ),
    'priority' => 40,
  ));

  //関連記事の関連付け
  $wp_customize->add_setting('related_entry_association', array(
    'default' => 'category',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'related_entry_association', array(
    'settings' => 'related_entry_association',
    'label' =>'関連記事の関連付け',
    'description' => is_tips_visible() ? '関連記事をカテゴリに関連付けるか、タグに関連付けるか。' : '',
    'section' => 'layout_singular_section',
    'type' => 'radio',
    'choices'    => array(
      'category' => 'カテゴリに関連付け（デフォルト）',
      'tag' => 'タグに関連付け',
    ),
    'priority' => 45,
  ));

  //関連記事数
  $wp_customize->add_setting('related_entry_count', array(
    'default' => 10,
    'sanitize_callback' => 'sanitize_number',
  ));
  $wp_customize->add_control( 'related_entry_count', array(
    'settings' => 'related_entry_count',
    'label' =>'関連記事表示数（デフォルト：10）',
    'description' => is_tips_visible() ? '関連記事の表示数を設定します。' : '',
    'section' => 'layout_singular_section',
    'type' => 'number',
    'priority' => 50,
  ));

  //[前ページ][次ページ]ナビの表示
  $wp_customize->add_setting('post_navi_visible', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'post_navi_visible', array(
    'settings' => 'post_navi_visible',
    'label' =>'[前ページ] [次ページ] ナビの表示',
    'description' => is_tips_visible() ? 'ページ送りナビを表示するか。' : '',
    'section' => 'layout_singular_section',
    'type' => 'checkbox',
    'priority' => 52,
  ));

  //[前ページ] [次ページ] ナビタイプ
  $wp_customize->add_setting('post_navi_type', array(
    'default' => 'default',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'post_navi_type', array(
    'settings' => 'post_navi_type',
    'label' =>'[前ページ] [次ページ] ナビタイプ',
    'description' => is_tips_visible() ? 'ページ送りナビの表示スタイルの設定です。' : '',
    'section' => 'layout_singular_section',
    'type' => 'radio',
    'choices'    => array(
      'default' => 'デフォルト',
      'thumbnail' => 'サムネイル付き',
    ),
    'priority' => 53,
  ));

  //固定ページにパンくずリストを表示
  $wp_customize->add_setting('page_breadcrumb_visible', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'page_breadcrumb_visible', array(
    'settings' => 'page_breadcrumb_visible',
    'label' =>'固定ページにパンくずリストを表示',
    'description' => is_tips_visible() ? '固定ページにページの親子関係を利用したパンくずリストを表示するか。' : '',
    'section' => 'layout_singular_section',
    'type' => 'checkbox',
    'priority' => 62,
  ));

  /////////////////////////////
  //画像設定項目の追加
  /////////////////////////////
  $wp_customize->add_section( 'image_section', array(
    'title'          =>'画像',
    'description' => is_tips_visible() ? '投稿・固定ページの本文で使用されている画像に関する設定です。' : '',
    'priority'       => 89.7,
  ));

  //アイキャッチを自動設定
  $wp_customize->add_setting('auto_post_thumbnail_enable', array(
    'default' => false,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'auto_post_thumbnail_enable', array(
    'settings' => 'auto_post_thumbnail_enable',
    'label' =>'アイキャッチを自動設定',
    'description' => is_tips_visible() ? '本文に最初に出てくる画像を利用してアイキャッチを自動設定するか。（※サーバーのphp.iniのallow_url_fopenがOffの時は外部サーバーから画像を取得できない可能性があります。）' : '',
    'section' => 'image_section',
    'type' => 'checkbox',
    'priority' => 5,
  ));

  //画像の遅延読み込みを有効
  $wp_customize->add_setting('lazy_load_enable', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'lazy_load_enable', array(
    'settings' => 'lazy_load_enable',
    'label' =>'Lazy Loadを有効（画像の遅延読み込み）',
    'description' => is_tips_visible() ? 'Lazy Loadを利用して本文にある画像を、表示するタイミングで読み込みます。（※サーバーの負荷対策）' : '',
    'section' => 'image_section',
    'type' => 'checkbox',
    'priority' => 10,
  ));

  //Lazy Loadのエフェクトを有効
  $wp_customize->add_setting('lazy_load_effect_enable', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'lazy_load_effect_enable', array(
    'settings' => 'lazy_load_effect_enable',
    'label' =>'Lazy Loadのエフェクトを有効',
    'description' => is_tips_visible() ? 'フェイドインエフェクトを有効にするか。' : '',
    'section' => 'image_section',
    'type' => 'checkbox',
    'priority' => 20,
  ));

  //Lazy Loadで画像を読み込むタイミング
  $wp_customize->add_setting('lazy_load_threshold', array(
    'default' => 0,
    'sanitize_callback' => 'sanitize_number',
  ));
  $wp_customize->add_control( 'lazy_load_threshold', array(
    'settings' => 'lazy_load_threshold',
    'label' =>'Lazy Loadで読み込むタイミング',
    'description' => is_tips_visible() ? 'ページスクロールのどのタイミングで画像を読み込むかを設定します。' : '',
    'section' => 'image_section',
    'type' => 'radio',
    'choices'    => array(
      '0' => 'スクロール表示と同時',
      '200' => '200px手前',
      '400' => '400px手前',
      '600' => '600px手前',
      '800' => '800px手前',
    ),
    'priority' => 30,
  ));

  //画像リンク拡大効果
  $wp_customize->add_setting('lightbox_type', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'lightbox_type', array(
    'settings' => 'lightbox_type',
    'label' =>'画像リンク拡大効果のタイプ',
    'description' => is_tips_visible() ? 'ライトボックス（画像拡大効果）のタイプを指定します。それぞれは、jQueryライブラリ名です。詳細はリンク先を参照してください。<a href="http://nelog.jp/lightbox-jquery" target="_blank">Lightbox</a>、<a href="http://nelog.jp/lity-js" target="_blank">Lity</a>' : '',
    'section' => 'image_section',
    'type' => 'radio',
    'choices'    => array(
      'none' => '拡大効果なし',
      'lightbox' => 'Lightbox',
      'lity' => 'Lity（軽い）',
    ),
    'priority' => 50,
  ));

  //画像効果
  $wp_customize->add_setting('image_effect', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'image_effect', array(
    'settings' => 'image_effect',
    'label' =>'画像効果',
    'description' => is_tips_visible() ? '本文画像の枠線の設定です。' : '',
    'section' => 'image_section',
    'type' => 'radio',
    'choices'    => array(
      'none' => 'なし（デフォルト）',
      'border1px' => 'ボーダー（枠線）',
      'shadow' => 'シャドー（影）',
    ),
    'priority' => 60,
  ));

  //画像リンク拡大効果
  $wp_customize->add_setting('lightbox_type', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'lightbox_type', array(
    'settings' => 'lightbox_type',
    'label' =>'画像リンク拡大効果のタイプ',
    'description' => is_tips_visible() ? 'ライトボックス（画像拡大効果）のタイプを指定します。それぞれは、jQueryライブラリ名です。詳細はリンク先を参照してください。<a href="http://nelog.jp/lightbox-jquery" target="_blank">Lightbox</a>、<a href="http://nelog.jp/lity-js" target="_blank">Lity</a>' : '',
    'section' => 'image_section',
    'type' => 'radio',
    'choices'    => array(
      'none' => '拡大効果なし',
      'lightbox' => 'Lightbox',
      'lity' => 'Lity（軽い）',
    ),
    'priority' => 50,
  ));

  //マウスホバーでAlt属性値をキャプション表示
  $wp_customize->add_setting('alt_caption_type', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'alt_caption_type', array(
    'settings' => 'alt_caption_type',
    'label' =>'Alt属性値をキャプション表示',
    'description' => is_tips_visible() ? '画像の上にマウスホバーするとAlt属性値を利用してキャプションを表示するかどうかを設定します。' : '',
    'section' => 'image_section',
    'type' => 'radio',
    'choices'    => array(
      'none' => '表示しない（デフォルト）',
      'ac_admin' => '管理者のみ（ログインユーザーのみ）',
      'ac_all' => '全てのユーザー',
    ),
    'priority' => 70,
  ));

  // //マウスホバーでAlt属性値をキャプション表示
  // $wp_customize->add_setting('alt_hover_effect_enable', array(
  //   'default' => false,
  //   'sanitize_callback' => 'sanitize_check',
  // ));
  // $wp_customize->add_control( 'alt_hover_effect_enable', array(
  //   'settings' => 'alt_hover_effect_enable',
  //   'label' =>'ホバーでAlt属性値をキャプション表示',
  //   'description' => is_tips_visible() ? '画像にマウスホバーした時にAlt属性値をキャプション表示するか。' : '',
  //   'section' => 'image_section',
  //   'type' => 'checkbox',
  //   'priority' => 70,
  // ));


  /////////////////////////////
  //SEO設定項目の追加
  /////////////////////////////
  $wp_customize->add_section( 'seo_section', array(
    'title'          =>'SEO',
    'description' => is_tips_visible() ? 'SEOに関する設定です。（※既にプラグインを使用している場合は設定をオフにしてください）' : '',
    'priority'       => 90,
  ));

  //フロントページのタイトルのあとにキャッチフレーズを付加する
  $wp_customize->add_setting('add_catch_phrase_to_frontpage_title', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'add_catch_phrase_to_frontpage_title', array(
    'settings' => 'add_catch_phrase_to_frontpage_title',
    'label' =>'フロントページタイトル後にキャッチフレーズを付加',
    'description' => is_tips_visible() ? '「サイト名｜キャッチフレーズ」のようなタイトルになります。' : '',
    'section' => 'seo_section',
    'type' => 'checkbox',
    'priority' => 50,
  ));

  //投稿・固定ページのタイトルのあとサイト名を付加
  $wp_customize->add_setting('add_site_name_to_singular_title', array(
    'default' => false,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'add_site_name_to_singular_title', array(
    'settings' => 'add_site_name_to_singular_title',
    'label' =>'投稿・固定ページタイトル後にサイト名を付加',
    'description' => is_tips_visible() ? '「投稿・固定ページタイトル｜サイト名」のようなタイトルになります。' : '',
    'section' => 'seo_section',
    'type' => 'checkbox',
    'priority' => 75,
  ));

  //トップページのメタディスクリプション
  $wp_customize->add_setting('top_page_meta_description', array(
    'default' => null,
    'sanitize_callback' => 'sanitize_html_text',
  ));
  $wp_customize->add_control( 'top_page_meta_description', array(
    'settings' => 'top_page_meta_description',
    'label' =>'トップページのメタディスクリプション',
    'description' => is_tips_visible() ? 'トップページの一覧のみに表示されるメタディスクリプションを設定してください。（※無記入で表示されません。固定ページをトップにしている場合は固定ページのものが表示されます。）' : '',
    'section' => 'seo_section',
    'type' => 'text',
    'priority' => 80,
  ));


  //トップページのメタキーワード
  $wp_customize->add_setting('top_page_meta_keyword', array(
    'default' => null,
    'sanitize_callback' => 'sanitize_html_text',
  ));
  $wp_customize->add_control( 'top_page_meta_keyword', array(
    'settings' => 'top_page_meta_keyword',
    'label' =>'トップページのメタキーワード',
    'description' => is_tips_visible() ? 'トップページの一覧のみに表示されるメタキーワードを設定してください。（※無記入で表示されません。固定ページをトップにしている場合は表示されません。）' : '',
    'section' => 'seo_section',
    'type' => 'text',
    'priority' => 90,
  ));

  //投稿・固定ページのタイトルのあとサイト名を付加
  $wp_customize->add_setting('rel_next_prev_link_enable', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'rel_next_prev_link_enable', array(
    'settings' => 'rel_next_prev_link_enable',
    'label' =>'分割ページにrel="next"/"prev"タグの追加',
    'description' => is_tips_visible() ? '「投稿・固定ページの分割ページ（マルチページ）」と「トップページ一覧やカテゴリ等の分割ページ」のみにrel="next"/"prev"タグを追加します。' : '',
    'section' => 'seo_section',
    'type' => 'checkbox',
    'priority' => 95,
  ));

  //カテゴリページの2ページ目以降をnoindexとする
  $wp_customize->add_setting('paged_category_page_noindex', array(
    'default' => false,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'paged_category_page_noindex', array(
    'settings' => 'paged_category_page_noindex',
    'label' => 'カテゴリページの2ページ目以降をnoindexとする',
    'description' => is_tips_visible() ? 'カテゴリページの2ページ目以降は検索エンジンのインデックスから除外します。' : '',
    'section' => 'seo_section',
    'type' => 'checkbox',
    'priority' => 97,
  ));

  //検索エンジンに伝える日付
  $wp_customize->add_setting('seo_date_type', array(
    'default' => 'create',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'seo_date_type', array(
    'settings' => 'seo_date_type',
    'label' =>'検索エンジンに伝える日付',
    'description' => is_tips_visible() ? '検索エンジンに伝える日時を「公開日」にするか「更新日」にするか。（※投稿・固定ページのみ）' : '',
    'section' => 'seo_section',
    'type' => 'radio',
    'choices'    => array(
      'create' => '公開日',
      'update' => '更新日',
      'update_only' => '更新日（更新したら更新日だけを表示）β版',
    ),
    'priority' => 100,
  ));

  //投稿ページの抜粋を使ってMeta Descriptionをヘッダーに挿入
  $wp_customize->add_setting('meta_description_insert', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'meta_description_insert', array(
    'settings' => 'meta_description_insert',
    'label' =>'投稿ページにメタディスクリプションを挿入',
    'description' => is_tips_visible() ? '投稿ページのメタタグに説明文を挿入するか。（※抜粋があるときはそれを使用、ない場合は冒頭の抽出文）' : '',
    'section' => 'seo_section',
    'type' => 'checkbox',
    'priority' => 200,
  ));

  //投稿ページのカテゴリを使ってMetaキーワードをヘッダーに挿入
  $wp_customize->add_setting('meta_keywords_insert', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'meta_keywords_insert', array(
    'settings' => 'meta_keywords_insert',
    'label' =>'投稿ページにメタキーワードを挿入',
    'description' => is_tips_visible() ? '投稿ページのメタタグにキーワードを挿入するか。（※投稿のカテゴリ情報を使用）' : '',
    'section' => 'seo_section',
    'type' => 'checkbox',
    'priority' => 300,
  ));

  //カテゴリ設定の説明を使ってMeta Descriptionをヘッダーに挿入
  $wp_customize->add_setting('meta_description_insert_to_category', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'meta_description_insert_to_category', array(
    'settings' => 'meta_description_insert_to_category',
    'label' =>'カテゴリページにメタディスクリプションを挿入',
    'description' => is_tips_visible() ? 'カテゴリーページのメタタグに説明文を挿入するか。（※カテゴリ設定の説明文を使用、ない場合は自動設定）' : '',
    'section' => 'seo_section',
    'type' => 'checkbox',
    'priority' => 400,
  ));

  //カテゴリページにMetaキーワードをヘッダーに挿入
  $wp_customize->add_setting('meta_keywords_insert_to_category', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'meta_keywords_insert_to_category', array(
    'settings' => 'meta_keywords_insert_to_category',
    'label' =>'カテゴリページにメタキーワードを挿入',
    'description' => is_tips_visible() ? 'カテゴリーページのメタタグにキーワードを挿入するか。（※カテゴリ情報から挿入）' : '',
    'section' => 'seo_section',
    'type' => 'checkbox',
    'priority' => 500,
  ));

  /////////////////////////////
  //SNS設定項目の追加
  /////////////////////////////
  $wp_customize->add_section( 'sns_section', array(
    'title'          =>'SNS',
    'description' => is_tips_visible() ? 'ソーシャルサービスのシェアボタンやフォローボタンに関する設定です。<br><a href="http://wp-simplicity.com/sns-settings/" target="_blank" class="example-setting">SNSの設定詳細</a>' : '',
    'priority'       => 91,
  ));

  //全シェアボタンの表示
  $wp_customize->add_setting('all_sns_share_btns_visible', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'all_sns_share_btns_visible', array(
    'settings' => 'all_sns_share_btns_visible',
    'label' =>'全シェアボタンの表示',
    'description' => is_tips_visible() ? '全てのシェアボタンの表示を切り替えます。' : '',
    'section' => 'sns_section',
    'type' => 'checkbox',
    'priority' => 0,
  ));

  //全シェア数の表示
  $wp_customize->add_setting('all_share_count_visible', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'all_share_count_visible', array(
    'settings' => 'all_share_count_visible',
    'label' =>'全シェア数の表示',
    'description' => is_tips_visible() ? '全てのシェアカウント表示を切り替えます。（※シェアボタンがSNSサービス固有ボタンであるときは無効）' : '',
    'section' => 'sns_section',
    'type' => 'checkbox',
    'priority' => 0.5,
  ));

  //シェアボタンのタイプ
  $wp_customize->add_setting('share_button_type', array(
    'default' => 'default',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'share_button_type', array(
    'settings' => 'share_button_type',
    'label' =>'シェアボタンのタイプ（PC）',
    'description' => is_tips_visible() ? 'パソコンで表示したときのシェアボタンスタイル。' : '',
    'section' => 'sns_section',
    'type' => 'radio',
    'choices'    => array(
      'default' => 'デフォルト（サービス固有のボタン）',
      'theme_color_type' => 'テーマカラータイプ（高速）',
      'twitter_type' => 'Twitterタイプ（高速）',
      'viral_type' => 'バイラルタイプ（高速）',
      'viral_white_type' => 'バイラル白タイプ（高速）',
    ),
    'priority' => 1,
  ));

  //シェアボタンのタイプ（モバイル）
  $wp_customize->add_setting('share_button_type_mobile', array(
    'default' => 'default',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'share_button_type_mobile', array(
    'settings' => 'share_button_type_mobile',
    'label' =>'シェアボタンのタイプ（モバイル）',
    'description' => is_tips_visible() ? 'モバイルで表示したときのシェアボタンスタイル。' : '',
    'section' => 'sns_section',
    'type' => 'radio',
    'choices'    => array(
      'default' => 'デフォルト（アイコン）',
      'viral_type' => 'バイラルタイプ',
      'viral_white_type' => 'バイラル白タイプ',
    ),
    'priority' => 2,
  ));

  //タイトル下にシェアボタンを表示
  $wp_customize->add_setting('top_share_btns_visible', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'top_share_btns_visible', array(
    'settings' => 'top_share_btns_visible',
    'label' =>'タイトル下にシェアボタンを表示',
    'description' => is_tips_visible() ? '投稿ページでタイトル下にシェアボタンを表示するか。' : '',
    'section' => 'sns_section',
    'type' => 'checkbox',
    'priority' => 3,
  ));

  //追従シェアボタンを表示
  $wp_customize->add_setting('obsequence_share_btns_visible', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'obsequence_share_btns_visible', array(
    'settings' => 'obsequence_share_btns_visible',
    'label' =>'サイドに追従シェアボタンを表示',
    'description' => is_tips_visible() ? '投稿ページでサイドに追従するにシェアボタンを表示するか。' : '',
    'section' => 'sns_section',
    'type' => 'checkbox',
    'priority' => 5,
  ));

  //本文下シェアボタンを表示
  $wp_customize->add_setting('bottom_share_btns_visible', array(
    'default'  => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'bottom_share_btns_visible', array(
    'settings' => 'bottom_share_btns_visible',
    'label' =>'本文下シェアボタンを表示',
    'description' => is_tips_visible() ? '投稿ページ本文下にあるシェアボタンを表示するか。' : '',
    'section' => 'sns_section',
    'type' => 'checkbox',
    'priority' => 6,
  ));

  //シェアメッセージ
  $wp_customize->add_setting('share_message_label', array(
    'default' => 'シェアする',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'share_message_label', array(
    'settings' => 'share_message_label',
    'label' =>'シェアメッセージ',
    'description' => is_tips_visible() ? 'シェアボタン用のラベルを設定します。（※無記入で非表示）' : '',
    'section' => 'sns_section',
    'type' => 'text',
    'priority' => 10,
  ));

  //Twitter拡散ボタン表示
  $wp_customize->add_setting('twitter_btn_visible', array(
    'default'  => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'twitter_btn_visible', array(
    'settings' => 'twitter_btn_visible',
    'label' =>'Twitter「ツイート」ボタンの表示',
    'section' => 'sns_section',
    'type' => 'checkbox',
    'priority' => 20,
  ));

  //Facebook拡散ボタン表示
  $wp_customize->add_setting('facebook_btn_visible', array(
    'default'  => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'facebook_btn_visible', array(
    'settings' => 'facebook_btn_visible',
    'label' =>'Facebook「いいね！」ボタンの表示',
    'section' => 'sns_section',
    'type' => 'checkbox',
    'priority' => 30,
  ));

  //Google＋拡散ボタン表示
  $wp_customize->add_setting('google_plus_btn_visible', array(
    'default'  => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'google_plus_btn_visible', array(
    'settings' => 'google_plus_btn_visible',
    'label' =>'Google＋「+1」ボタンの表示',
    'section' => 'sns_section',
    'type' => 'checkbox',
    'priority' => 40,
  ));

  //はてな拡散ボタン表示
  $wp_customize->add_setting('hatena_btn_visible', array(
    'default'  => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'hatena_btn_visible', array(
    'settings' => 'hatena_btn_visible',
    'label' =>'はてな「はてブ」ボタンの表示',
    'section' => 'sns_section',
    'type' => 'checkbox',
    'priority' => 50,
  ));

  //ポケットボタン表示
  $wp_customize->add_setting('pocket_btn_visible', array(
    'default'  => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'pocket_btn_visible', array(
    'settings' => 'pocket_btn_visible',
    'label' =>'pocket「あとで読む」ボタンの表示',
    'section' => 'sns_section',
    'type' => 'checkbox',
    'priority' => 60,
  ));

  //LINEボタン表示（モバイル時）
  $wp_customize->add_setting('line_btn_visible', array(
    'default'  => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'line_btn_visible', array(
    'settings' => 'line_btn_visible',
    'label' =>'LINEボタンの表示（モバイル時）',
    'section' => 'sns_section',
    'type' => 'checkbox',
    'priority' => 70,
  ));

  //Evernoteボタン表示
  $wp_customize->add_setting('evernote_btn_visible', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'evernote_btn_visible', array(
    'settings' => 'evernote_btn_visible',
    'label' =>'Evernoteボタンの表示',
    'section' => 'sns_section',
    'type' => 'checkbox',
    'priority' => 71,
  ));

  //Push7ボタン表示
  $wp_customize->add_setting('push7_btn_visible', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'push7_btn_visible', array(
    'settings' => 'push7_btn_visible',
    'label' =>'Push7ボタンの表示',
    'description' => is_tips_visible() ? '※フォローボタンの設定でAPPNO入力をしないと反映されません。' : '',
    'section' => 'sns_section',
    'type' => 'checkbox',
    'priority' => 71.5,
  ));

  //feedlyボタン表示
  $wp_customize->add_setting('feedly_btn_visible', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'feedly_btn_visible', array(
    'settings' => 'feedly_btn_visible',
    'label' =>'feedlyボタンの表示',
    'section' => 'sns_section',
    'type' => 'checkbox',
    'priority' => 72,
  ));

  //コメント数の表示
  $wp_customize->add_setting('comments_btn_visible', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'comments_btn_visible', array(
    'settings' => 'comments_btn_visible',
    'label' =>'コメント数の表示',
    'section' => 'sns_section',
    'type' => 'checkbox',
    'priority' => 72.5,
  ));

  //画像にPinterestピンを表示
  $wp_customize->add_setting('pinterest_btn_visible', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'pinterest_btn_visible', array(
    'settings' => 'pinterest_btn_visible',
    'label' =>'画像にPinterestピンを表示',
    'section' => 'sns_section',
    'type' => 'checkbox',
    'priority' => 73,
  ));

  //ツイート数を表示する
  $wp_customize->add_setting('twitter_count_visible', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'twitter_count_visible', array(
    'settings' => 'twitter_count_visible',
    'label' =>'ツイート数を表示',
    'description' => is_tips_visible() ? '<a href="http://jsoon.digitiminimi.com/">count.jsoon</a>サービスを利用してツイート数を表示します。（※<a href="http://wp-simplicity.com/count-jsoon/">要登録作業</a>）' : '',
    'section' => 'sns_section',
    'type' => 'checkbox',
    'priority' => 73.5,
  ));

  //ツイートにメンションを含める
  $wp_customize->add_setting('twitter_id_include', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'twitter_id_include', array(
    'settings' => 'twitter_id_include',
    'label' =>'ツイートにメンションを含める',
    'description' => is_tips_visible() ? 'ツイートに「@Twitter_idより」をツイートに含めるか。（※要フォローID登録）' : '',
    'section' => 'sns_section',
    'type' => 'checkbox',
    'priority' => 74,
  ));

  //ツイート後にフォローを促す
  $wp_customize->add_setting('twitter_related_follow_enable', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'twitter_related_follow_enable', array(
    'settings' => 'twitter_related_follow_enable',
    'label' =>'ツイート後にフォローを促す',
    'description' => is_tips_visible() ? 'ツイート後にフォローボタンを表示して閲覧者にアカウントのフォローを促すか。（※要フォローID登録）' : '',
    'section' => 'sns_section',
    'type' => 'checkbox',
    'priority' => 74.5,
  ));


  //全フォローボタンの表示
  $wp_customize->add_setting('all_sns_follow_btns_visible', array(
    'default'  => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'all_sns_follow_btns_visible', array(
    'settings' => 'all_sns_follow_btns_visible',
    'label' =>'全フォローボタンの表示',
    'description' => is_tips_visible() ? '全てのフォローボタンの表示を切り替えます。' : '',
    'section' => 'sns_section',
    'type' => 'checkbox',
    'priority' => 75,
  ));

  //ページトップのフォローボタン表示
  $wp_customize->add_setting('top_follows_visible', array(
    'default'  => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'top_follows_visible', array(
    'settings' => 'top_follows_visible',
    'label' =>'ページトップフォローボタンの表示',
    'description' => is_tips_visible() ? 'サイトヘッダー部分のフォローボタンを表示するか。' : '',
    'section' => 'sns_section',
    'type' => 'checkbox',
    'priority' => 76,
  ));

  //本文下のフォローボタン表示
  $wp_customize->add_setting('body_bottom_follows_visible', array(
    'default'  => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'body_bottom_follows_visible', array(
    'settings' => 'body_bottom_follows_visible',
    'label' =>'本文下フォローボタンの表示',
    'description' => is_tips_visible() ? '投稿・固定ページ本文下のフォローボタンを表示するか。' : '',
    'section' => 'sns_section',
    'type' => 'checkbox',
    'priority' => 77,
  ));

  //フォローメッセージ
  $wp_customize->add_setting('follow_message_label', array(
    'default' => 'フォローする',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'follow_message_label', array(
    'settings' => 'follow_message_label',
    'label' =>'フォローメッセージ',
    'description' => is_tips_visible() ? 'フォローボタンのラベルを設定します。（※無記入で非表示）' : '',
    'section' => 'sns_section',
    'type' => 'text',
    'priority' => 80,
  ));

  //TwitterフォローID
  $wp_customize->add_setting('twitter_follow_id', array(
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'twitter_follow_id', array(
    'settings' => 'twitter_follow_id',
    'label' =>'twitter.com/XXXXXXX',
    'description' => is_tips_visible() ? 'TwitterページURLのXXXXXXX部分を入力してください。＠は不要です。' : '',
    'section' => 'sns_section',
    'type' => 'text',
    'priority' => 90,
  ));

  //FacebookフォローID
  $wp_customize->add_setting('facebook_follow_id', array(
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'facebook_follow_id', array(
    'settings' => 'facebook_follow_id',
    'label' =>'facebook.com/XXXXXXX',
    'description' => is_tips_visible() ? 'FacebookページURLのXXXXXXX部分を入力してください。' : '',
    'section' => 'sns_section',
    'type' => 'text',
    'priority' => 100,
  ));

  //Google＋フォローID
  $wp_customize->add_setting('google_plus_follow_id', array(
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'google_plus_follow_id', array(
    'settings' => 'google_plus_follow_id',
    'label' =>'plus.google.com/XXXXXXX',
    'description' => is_tips_visible() ? 'Google+ページURLのXXXXXXX部分を入力してください。' : '',
    'section' => 'sns_section',
    'type' => 'text',
    'priority' => 110,
  ));

  //はてブフォローID
  $wp_customize->add_setting('hatebu_follow_id', array(
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'hatebu_follow_id', array(
    'settings' => 'hatebu_follow_id',
    'label' =>'b.hatena.ne.jp/XXXXXXX',
    'description' => is_tips_visible() ? 'はてブページURLのXXXXXXX部分を入力してください。' : '',
    'section' => 'sns_section',
    'type' => 'text',
    'priority' => 113,
  ));

  //InstagramフォローID
  $wp_customize->add_setting('instagram_follow_id', array(
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'instagram_follow_id', array(
    'settings' => 'instagram_follow_id',
    'label' =>'instagram.com/XXXXXXX',
    'description' => is_tips_visible() ? 'InstagramページURLのXXXXXXX部分を入力してください。' : '',
    'section' => 'sns_section',
    'type' => 'text',
    'priority' => 115,
  ));

  //PinterestフォローID
  $wp_customize->add_setting('pinterest_follow_id', array(
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'pinterest_follow_id', array(
    'settings' => 'pinterest_follow_id',
    'label' =>'pinterest.com/XXXXXXX',
    'description' => is_tips_visible() ? 'PinterestページURLのXXXXXXX部分を入力してください。' : '',
    'section' => 'sns_section',
    'type' => 'text',
    'priority' => 116,
  ));

  //YouTubeフォローURLの一部
  $wp_customize->add_setting('youtube_follow_page_id', array(
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'youtube_follow_page_id', array(
    'settings' => 'youtube_follow_page_id',
    'label' =>'youtube.com/XXXX/XXXXXXX',
    'description' => is_tips_visible() ? 'YouTubeページURL（youtube.com/<span style="color: red;">XXXX/XXXXXXXXXX</span>）の<span style="color: red;">XXXX/XXXXXXXXXX</span>部分を入力してください。例：user/XXXXXXX、channel/XXXXXXX、c/XXXXXXX。' : '',
    'section' => 'sns_section',
    'type' => 'text',
    'priority' => 117,
  ));

  //Flickr
  $wp_customize->add_setting('flickr_follow_id', array(
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'flickr_follow_id', array(
    'settings' => 'flickr_follow_id',
    'label' =>'flickr.com/photos/XXXXXXXXXX',
    'description' => is_tips_visible() ? 'FlickrページURLのXXXXXXX部分を入力してください。' : '',
    'section' => 'sns_section',
    'type' => 'text',
    'priority' => 117.4,
  ));

  //LINE@ID
  $wp_customize->add_setting('line_at_follow_id', array(
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'line_at_follow_id', array(
    'settings' => 'line_at_follow_id',
    'label' =>'line.naver.jp/ti/p/XXXXXXXXXX',
    'description' => is_tips_visible() ? 'LINE@ページURLのXXXXXXX部分を入力してください。<span style="color: red;">@が必要な場合は@もし入力してください。</span>' : '',
    'section' => 'sns_section',
    'type' => 'text',
    'priority' => 117.5,
  ));

  //Push7購読ボタン
  $wp_customize->add_setting('push7_follow_app_no', array(
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'push7_follow_app_no', array(
    'settings' => 'push7_follow_app_no',
    'label' =>'Push7のAPPNO',
    'description' => is_tips_visible() ? 'Push7でタグに出力されるAPPNOを入力してください。' : '',
    'section' => 'sns_section',
    'type' => 'text',
    'priority' => 119,
  ));

  //feedlyフォローボタン
  $wp_customize->add_setting('feedly_follow_btn_visible', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'feedly_follow_btn_visible', array(
    'settings' => 'feedly_follow_btn_visible',
    'label' =>'feedlyの表示',
    'description' => is_tips_visible() ? 'feedlyフォローアイコンを表示するか。' : '',
    'section' => 'sns_section',
    'type' => 'checkbox',
    'priority' => 120,
  ));

  //RSSフォローボタン
  $wp_customize->add_setting('rss_follow_btn_visible', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'rss_follow_btn_visible', array(
    'settings' => 'rss_follow_btn_visible',
    'label' =>'RSSの表示',
    'description' => is_tips_visible() ? 'RSSフォローアイコンを表示するか。' : '',
    'section' => 'sns_section',
    'type' => 'checkbox',
    'priority' => 130,
  ));

  //Twitterカードタグを挿入
  $wp_customize->add_setting('twitter_cards_enable', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'twitter_cards_enable', array(
    'settings' => 'twitter_cards_enable',
    'label' =>'Twitterカードタグを挿入',
    'description' => is_tips_visible() ? 'Twitterカード用のタグをHTMLに埋め込むか。（※プラグインで設定している場合はオフ）<a href="http://wp-simplicity.com/twitter-cards/" target="_blank" class="example-setting">Twitter Cards登録方法</a>' : '',
    'section' => 'sns_section',
    'type' => 'checkbox',
    'priority' => 133,
  ));

  //Twitterカードタイプ
  $wp_customize->add_setting('twitter_card_type', array(
    'default' => 'summary',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'twitter_card_type', array(
    'settings' => 'twitter_card_type',
    'label' =>'Twitterカードタイプ',
    'description' => is_tips_visible() ? 'Twitterカードの表示タイプの設定。' : '',
    'section' => 'sns_section',
    'type' => 'radio',
    'choices'    => array(
      'summary' => 'サマリー（summary）',
      'summary_large_image' => 'サマリー（summary_large_image）',
      //'photo' => '写真（photo）',
    ),
    'priority' => 134,
  ));

  //FacebookOGPタグを挿入
  $wp_customize->add_setting('facebook_ogp_enable', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'facebook_ogp_enable', array(
    'settings' => 'facebook_ogp_enable',
    'label' =>'FacebookOGPタグを挿入',
    'description' => is_tips_visible() ? 'Facebook OGP用のタグをHTMLに埋め込むか。（※プラグインで設定している場合はオフ）' : '',
    'section' => 'sns_section',
    'type' => 'checkbox',
    'priority' => 135,
  ));

  //fb:admins
  $wp_customize->add_setting('fb_admins', array(
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'fb_admins', array(
    'settings' => 'fb_admins',
    'label' =>'FacebookOGP管理者ID（fb:admins）' ,
    'description' => is_tips_visible() ? 'Facebookの管理者IDを入力してください。（※要Facebookユーザー登録）' : '',
    'section' => 'sns_section',
    'type' => 'text',
    'priority' => 140,
  ));

  //fb:app_id
  $wp_customize->add_setting('fb_app_id', array(
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'fb_app_id', array(
    'settings' => 'fb_app_id',
    'label' =>'FacebookOGPアプリID（fb:app_id）',
    'description' => is_tips_visible() ? 'FacebookのアプリIDを入力してください。（※要Facebookユーザー登録）' : '',
    'section' => 'sns_section',
    'type' => 'text',
    'priority' => 150,
  ));

  //OGPやTwitterカードのホームイメージ
  $wp_customize->add_setting( 'ogp_home_image', array(
    'sanitize_callback' => 'sanitize_file_url',
  ) );
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ogp_home_image', array(
    'settings' => 'ogp_home_image',
    'label' =>'OGPやTwitterカードのホームイメージ',
    'description' => is_tips_visible() ? 'SNSカード用のデフォルトのイメージを設定します。トップやアーカイブなどのインデックスページで利用されます。（※最低600 × 315px以上推奨）' : '',
    'section' => 'sns_section',
    'priority' => 155,
  ) ) );

  //フォローボタンに色をつける
  $wp_customize->add_setting('colored_follow_btns', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'colored_follow_btns', array(
    'settings' => 'colored_follow_btns',
    'label' =>'フォローボタンに色をつける',
    'description' => is_tips_visible() ? 'フォローボタンを各種ソーシャルサービスのテーマカラーにするか。' : '',
    'section' => 'sns_section',
    'type' => 'checkbox',
    'priority' => 170,
  ));

  /////////////////////////////
  //広告設定項目の追加
  /////////////////////////////
  $wp_customize->add_section( 'ads_section', array(
    'title'          =>'広告',
    'description' => is_tips_visible() ? '広告の表示や配置に関する設定です。<br><a href="http://wp-simplicity.com/ads-settings/" target="_blank" class="example-setting">広告の設定詳細</a>' : '',
    'priority'       => 97,
  ));

  //全ての広告を表示
  $wp_customize->add_setting('ads_visible', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'ads_visible', array(
    'settings' => 'ads_visible',
    'label' => '全ての広告を表示',
    'description' => is_tips_visible() ? '全ての広告表示を切り替えます。 （※チェックを外すと全ての広告が非表示に）' : '',
    'section' => 'ads_section',
    'type' => 'checkbox',
    'priority'=> 10,
  ));

  //広告位置の設定
  $wp_customize->add_setting('ads_position', array(
    'default'    => 'under_relations',
    'sanitize_callback' => 'sanitize_text',
  ));
  $radio_items = array();
  if ( !is_responsive_enable() ) $radio_items += array('under_relations' => '関連記事下（デフォルト）');
  $radio_items += array('sidebar_top' => 'サイドバートップ',
      'in_content' => '本文記事中（H2見出し手前）');
  if ( is_ads_performance_visible() && !is_responsive_enable() ) $radio_items += array('content_top'=>'コンテンツ上部にバナー表示');
  //$label = ( is_responsive_enable() ? 'レスポンシブ広告位置の設定' :  '記事下以外の広告位置');
  $wp_customize->add_control( 'ads_position', array(
    'settings' => 'ads_position',
    'label' => '広告位置',
    'description' => is_tips_visible() ? '広告の配置を設定します。（※「完全レスポンシブ機能」がオンのときは、配置が変わります）' : '',
    'section' => 'ads_section',
    'type' => 'radio',
    'choices'    => $radio_items,
    'priority'=> 20,
  ));

  //広告のラベル
  $wp_customize->add_setting('ads_label', array(
    'default' => 'スポンサーリンク',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'ads_label', array(
    'settings' => 'ads_label',
    'label' =>'広告のラベル',
    'description' => is_tips_visible() ? '広告のラベルを設定します。アドセンス推奨は「スポンサーリンク」か「広告」。' : '',
    'section' => 'ads_section',
    'type' => 'text',
    'priority'=> 30,
  ));

  //トップページに広告を表示する
  $wp_customize->add_setting('ads_top_page_visible', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'ads_top_page_visible', array(
    'settings' => 'ads_top_page_visible',
    'label' =>'トップページに広告を表示する',
    'description' => is_tips_visible() ? 'サイトトップページに広告を表示するか。' : '',
    'section' => 'ads_section',
    'type' => 'checkbox',
    'priority'=> 30,
  ));

  //広告を中央表示
  $wp_customize->add_setting('ads_center', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'ads_center', array(
    'settings' => 'ads_center',
    'label' =>'広告を中央表示',
    'description' => is_tips_visible() ? '広告を親要素の中心に表示するか。' : '',
    'section' => 'ads_section',
    'type' => 'checkbox',
    'priority'=> 40,
  ));

  //ダブルレクタングルを縦型にする
  $wp_customize->add_setting('ads_vatical_rectangle', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'ads_vatical_rectangle', array(
    'settings' => 'ads_vatical_rectangle',
    'label' =>'PC表示のダブルレクタングルを縦型に',
    'description' => is_tips_visible() ? '横並びのダブルレクタングルを縦並びにするか。' : '',
    'section' => 'ads_section',
    'type' => 'checkbox',
    'priority'=> 500,
  ));

  //パフォーマンス追求広告の表示
  $wp_customize->add_setting('ads_performance_visible', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'ads_performance_visible', array(
    'settings' => 'ads_performance_visible',
    'label' =>'パフォーマンス追求広告の表示',
    'description' => is_tips_visible() ? '広告が3つ表示されていないページにできる限り表示するか。ウィジェットページに設定用のウィジェットが表示されます。【重要】グローバルナビでサブメニュー表示している人は、メニューがかぶるとアドセンスポリシー違反になるので非推奨 <a href="http://wp-simplicity.com/adsense-performance/" target="_blank" class="example-setting">設定方法</a>' : '',
    'section' => 'ads_section',
    'type' => 'checkbox',
    'priority'=> 600,
  ));

  //PCトップをカスタムサイズ広告に
  $wp_customize->add_setting('custum_ad_space', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'custum_ad_space', array(
    'settings' => '',
    'label' =>'PCトップ広告をカスタムサイズ広告に',
    'description' => is_tips_visible() ? '一覧リストのトップ広告にビックバナー（728px）以外の広告を入れるときはオン。' : '',
    'section' => 'ads_section',
    'type' => 'checkbox',
    'priority'=> 700,
  ));

  //除外する記事のID
  $wp_customize->add_setting('exclude_article_ids', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_id_comma_text',
  ));
  $wp_customize->add_control( 'exclude_article_ids', array(
    'settings' => 'exclude_article_ids',
    'label' =>'広告除外記事のID',
    'description' => is_tips_visible() ? '広告を非表示にする投稿・固定ページのIDを,（カンマ）区切りで指定してください。例：111,222,3333<br><a href="http://wp-simplicity.com/ban-ads/" target="_blank" class="example-setting">設定方法</a>' : '',
    'section' => 'ads_section',
    'type' => 'text',
    'priority'=> 800,
  ));

  //除外するカテゴリのID
  $wp_customize->add_setting('exclude_category_ids', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_id_comma_text',
  ));
  $wp_customize->add_control( 'exclude_category_ids', array(
    'settings' => 'exclude_category_ids',
    'label' =>'広告除外カテゴリのID',
    'description' => is_tips_visible() ? '広告を非表示にするカテゴリのIDを,（カンマ）区切りで指定してください。例：1,7,22<br><a href="http://wp-simplicity.com/ban-ads/" target="_blank" class="example-setting">設定方法</a>' : '',
    'section' => 'ads_section',
    'type' => 'text',
    'priority'=> 900,
  ));


  //アクセス解析設定項目の追加
  $wp_customize->add_section( 'ana_section', array(
    'title'          =>'アクセス解析（Analyticsなど）',
    'description' => is_tips_visible() ? 'Google Analyticsや、Google Search Consoleに関する設定です。' : '',
    'priority'       => 96,
  ));

  //Google AnalyticsトラッキングID
  $wp_customize->add_setting('tracking_id', array(
    'default' => null,
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'tracking_id', array(
    'settings' => 'tracking_id',
    'label' =>'Google AnalyticsトラッキングID（UA-xxxxxxxx-x）',
    'description' => is_tips_visible() ? 'Google AnalyticsからIDを取得して入力してください。（※プラグインとの二重登録注意）<a href="http://wp-simplicity.com/access-analyse-settings/" target="_blank" class="example-setting">設定方法</a>' : '',
    'section' => 'ana_section',
    'type' => 'text',
    'priority'=> 10,
  ));

  //Twitterカードタイプ
  $wp_customize->add_setting('analytics_tracking_type', array(
    'default' => 'ga',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'analytics_tracking_type', array(
    'settings' => 'analytics_tracking_type',
    'label' =>'Google Analytics トラッキングタイプ',
    'description' => is_tips_visible() ? 'Google Analyticsのトラッキング方法の設定です。' : '',
    'section' => 'ana_section',
    'type' => 'radio',
    'choices'    => array(
      'ga' => 'ga.js（旧タイプ）',
      'dc' => 'dc.js（ユーザー属性、インタレスト対応）',
      'analytics' => 'analytics.js（ユニバーサルアナリティクス）',
      'analytics_displayfeatures' => 'analytics.js（ユニバーサルアナリティクス + ユーザー属性、インタレスト対応）',
    ),
    'priority' => 20,
  ));

  // //ユーザー属性とインタレストカテゴリに関するレポートに対応する
  // $wp_customize->add_setting('analytics_interest', array(
  //   'sanitize_callback' => 'sanitize_check',
  // ));
  // $wp_customize->add_control( 'analytics_interest', array(
  //   'settings' => 'analytics_interest',
  //   'label' =>'ユーザー属性とインタレストカテゴリレポートに対応',
  //   'description' => is_tips_visible() ? 'Googleアナリティクスでユーザーの年齢や興味に関するデータを収集します。（※要Analyticsで設定の有効化）<a href="http://wp-simplicity.com/google-analytics-interest-settings/" target="_blank" class="example-setting">設定方法</a>' : '',
  //   'section' => 'ana_section',
  //   'type' => 'checkbox',
  //   'priority'=> 20,
  // ));

  //PtengineのID
  $wp_customize->add_setting('ptengin_tracking_id', array(
    'default' => null,
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'ptengin_tracking_id', array(
    'settings' => 'ptengin_tracking_id',
    'label' =>'PtengineのID',
    'description' => is_tips_visible() ? 'Ptengineで解析を行います。PtengineからIDを取得して入力してください。（※プラグインとの二重登録注意）<a href="http://wp-simplicity.com/ptengin/" target="_blank" class="example-setting">設定方法</a>' : '',
    'section' => 'ana_section',
    'type' => 'text',
    'priority'=> 25,
  ));

  //Google Search Console ID
  $wp_customize->add_setting('webmaster_tool_id', array(
    'default' => null,
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'webmaster_tool_id', array(
    'settings' => 'webmaster_tool_id',
    'label' =>'Google Search ConsoleのID',
    'description' => is_tips_visible() ? 'Google Search Console（旧ウェブマスターツール）のサイト認証IDを入力してください。<a href="http://wp-simplicity.com/webmaster-tool-setting/" target="_blank" class="example-setting">設定方法</a>
' : '',
    'section' => 'ana_section',
    'section' => 'ana_section',
    'type' => 'text',
    'priority'=> 30,
  ));

  /////////////////////////////
  //ブログカード設定項目の追加
  /////////////////////////////
  $wp_customize->add_section( 'blog_card_section', array(
    'title'          =>'ブログカード（内部リンク）',
    'description' => is_tips_visible() ? '内部リンクブログカードに関する設定です。<br><a href="http://wp-simplicity.com/how-to-use-blogcard/" target="_blank" class="example-setting">ブログカードの利用方法</a>' : '',
    'priority'       => 98,
  ));

  //ブログカードの有効化
  $wp_customize->add_setting('blog_card_enable', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'blog_card_enable', array(
    'settings' => 'blog_card_enable',
    'label' =>'ブログカード有効',
    'description' => is_tips_visible() ? 'サイト内のURL（内部リンク）を入力するとブログカードとして表示します。' : '',
    'section' => 'blog_card_section',
    'type' => 'checkbox',
    'priority' => 100,
  ));

  //ブログカードのサムネイルを右側にする
  $wp_customize->add_setting('blog_card_thumbnail_right', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'blog_card_thumbnail_right', array(
    'settings' => 'blog_card_thumbnail_right',
    'label' =>'サムネイルを右側にする',
    'description' => is_tips_visible() ? 'ブログカードのサムネイルを右側に表示するか。' : '',
    'section' => 'blog_card_section',
    'type' => 'checkbox',
    'priority' => 400,
  ));

  //ブログカードのリンクを新しいタブで開く
  $wp_customize->add_setting('blog_card_target_blank', array(
    'default' => false,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'blog_card_target_blank', array(
    'settings' => 'blog_card_target_blank',
    'label' =>'新しいタブで開く',
    'description' => is_tips_visible() ? 'ブログカードのリンクをクリックした時に新しいタブで開くか。' : '',
    'section' => 'blog_card_section',
    'type' => 'checkbox',
    'priority' => 500,
  ));

  //サイトロゴ表示
  $wp_customize->add_setting('blog_card_site_logo_visible', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'blog_card_site_logo_visible', array(
    'settings' => 'blog_card_site_logo_visible',
    'label' =>'サイトロゴを表示',
    'description' => is_tips_visible() ? 'サイトのファビコンとドメインを表示するか。（※「その他」設定項目のファビコン設定をしてないとロゴは表示されません。' : '',
    'section' => 'blog_card_section',
    'type' => 'checkbox',
    'priority' => 600,
  ));

  //サイトロゴリンク有効
  $wp_customize->add_setting('blog_card_site_logo_link_enable', array(
    'default' => false,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'blog_card_site_logo_link_enable', array(
    'settings' => 'blog_card_site_logo_link_enable',
    'label' =>'サイトロゴリンク有効',
    'description' => is_tips_visible() ? 'サイトドメインにトップURLへのリンクを貼るかどうか。' : '',
    'section' => 'blog_card_section',
    'type' => 'checkbox',
    'priority' => 650,
  ));

  //はてブ数を表示
  $wp_customize->add_setting('blog_card_hatena_visible', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'blog_card_hatena_visible', array(
    'settings' => 'blog_card_hatena_visible',
    'label' =>'はてブ数を表示',
    'description' => is_tips_visible() ? 'はてなブックマーク数を表示するか。' : '',
    'section' => 'blog_card_section',
    'type' => 'checkbox',
    'priority' => 700,
  ));

  //日付を表示
  $wp_customize->add_setting('blog_card_date_visible', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'blog_card_date_visible', array(
    'settings' => 'blog_card_date_visible',
    'label' =>'投稿日を表示',
    'description' => is_tips_visible() ? '投稿日を表示するか。' : '',
    'section' => 'blog_card_section',
    'type' => 'checkbox',
    'priority' => 800,
  ));

  //カード幅を広げる
  $wp_customize->add_setting('blog_card_width_auto', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'blog_card_width_auto', array(
    'settings' => 'blog_card_width_auto',
    'label' =>'カード幅を広げる',
    'description' => is_tips_visible() ? 'カード幅はデフォルトで500pxですが、横幅をさらに広げます。' : '',
    'section' => 'blog_card_section',
    'type' => 'checkbox',
    'priority' => 900,
  ));

  /////////////////////////////
  //外部ブログカード設定項目の追加
  /////////////////////////////
  $wp_customize->add_section( 'blog_card_external_section', array(
    'title'          =>'ブログカード（外部リンク）',
    'description' => is_tips_visible() ? '外部リンクブログカードに関する設定です。<br>ブログカード自体の使い方は<a href="http://wp-simplicity.com/how-to-use-blogcard/" target="_blank" class="example-setting">ブログカードの利用方法</a>を。<br>外部リンクブログカードに関する設定は<a href="http://wp-simplicity.com/external-blog-card/" target="_blank">外部ブログカードの設定</a>を参照してください。' : '',
    'priority'       => 98.1,
  ));

  //外部URLをブログカードにする
  $wp_customize->add_setting('blog_card_external_enable', array(
    'default' => false,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'blog_card_external_enable', array(
    'settings' => 'blog_card_external_enable',
    'label' =>'ブログカード有効',
    'description' => is_tips_visible() ? '投稿時に外部リンクURLのみを記入するとブログカードを表示します。' : '',
    'section' => 'blog_card_external_section',
    'type' => 'checkbox',
    'priority' => 100,
  ));

  //外部ブログカードタイプ
  $wp_customize->add_setting('blog_card_external_type', array(
    'default' => 'default',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'blog_card_external_type', array(
    'settings' => 'blog_card_external_type',
    'label' =>'外部ブログカードタイプ',
    'description' => is_tips_visible() ? '外部リンク用のブログカードのタイプ設定です。「はてなカード」と「Embedlyカード」は以降の細かな設定はできません。' : '',
    'section' => 'blog_card_external_section',
    'type' => 'radio',
    'choices'    => array(
      'default' => 'ブログカード（独自キャッシュ）',
      'hatena' => 'はてなカード',
      'embedly' => 'Embedlyカード',
    ),
    'priority' => 200,
  ));

  //ブログカードのサムネイルを右側にする
  $wp_customize->add_setting('blog_card_external_thumbnail_right', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'blog_card_external_thumbnail_right', array(
    'settings' => 'blog_card_external_thumbnail_right',
    'label' =>'サムネイルを右側にする',
    'description' => is_tips_visible() ? 'ブログカードのサムネイルを右側に表示するか。' : '',
    'section' => 'blog_card_external_section',
    'type' => 'checkbox',
    'priority' => 300,
  ));

  //ブログカードのリンクを新しいタブで開く
  $wp_customize->add_setting('blog_card_external_target_blank', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'blog_card_external_target_blank', array(
    'settings' => 'blog_card_external_target_blank',
    'label' =>'新しいタブで開く',
    'description' => is_tips_visible() ? 'ブログカードのリンクをクリックした時に新しいタブで開くか。' : '',
    'section' => 'blog_card_external_section',
    'type' => 'checkbox',
    'priority' => 400,
  ));

  //ブログカードのリンクを新しいタブで開く
  $wp_customize->add_setting('blog_card_external_target_blank', array(
    'default' => false,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'blog_card_external_target_blank', array(
    'settings' => 'blog_card_external_target_blank',
    'label' =>'新しいタブで開く',
    'description' => is_tips_visible() ? 'ブログカードのリンクをクリックした時に新しいタブで開くか。' : '',
    'section' => 'blog_card_external_section',
    'type' => 'checkbox',
    'priority' => 500,
  ));

  //サイトロゴ表示
  $wp_customize->add_setting('blog_card_external_site_logo_visible', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'blog_card_external_site_logo_visible', array(
    'settings' => 'blog_card_external_site_logo_visible',
    'label' =>'サイトロゴを表示',
    'description' => is_tips_visible() ? 'サイトのファビコンとドメインを表示するか。（※「その他」設定項目のファビコン設定をしてないとロゴは表示されません。' : '',
    'section' => 'blog_card_external_section',
    'type' => 'checkbox',
    'priority' => 600,
  ));

  //サイトロゴリンク有効
  $wp_customize->add_setting('blog_card_external_site_logo_link_enable', array(
    'default' => false,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'blog_card_external_site_logo_link_enable', array(
    'settings' => 'blog_card_external_site_logo_link_enable',
    'label' =>'サイトロゴリンク有効',
    'description' => is_tips_visible() ? 'サイトドメインにトップURLへのリンクを貼るかどうか。' : '',
    'section' => 'blog_card_external_section',
    'type' => 'checkbox',
    'priority' => 650,
  ));

  //はてブ数を表示
  $wp_customize->add_setting('blog_card_external_hatena_visible', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'blog_card_external_hatena_visible', array(
    'settings' => 'blog_card_external_hatena_visible',
    'label' =>'はてブ数を表示',
    'description' => is_tips_visible() ? 'はてなブックマーク数を表示するか。' : '',
    'section' => 'blog_card_external_section',
    'type' => 'checkbox',
    'priority' => 700,
  ));

  //カード幅を広げる
  $wp_customize->add_setting('blog_card_external_width_auto', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'blog_card_external_width_auto', array(
    'settings' => 'blog_card_external_width_auto',
    'label' =>'カード幅を広げる',
    'description' => is_tips_visible() ? 'カード幅はデフォルトで500pxですが、横幅をさらに広げます。' : '',
    'section' => 'blog_card_external_section',
    'type' => 'checkbox',
    'priority' => 900,
  ));

  //キャッシュの保存期間
  $wp_customize->add_setting('blog_card_external_cache_days', array(
    'default' => 90,
    'sanitize_callback' => 'sanitize_cache_days',
  ));
  $wp_customize->add_control( 'blog_card_external_cache_days', array(
    'settings' => 'blog_card_external_cache_days',
    'label' => '外部ブログカードキャシュ保存日数',
    'description' => is_tips_visible() ? '外部リンクカードが「ブログカード」になっている時のOGP情報キャッシュを保存する期間を設定します。設定範囲は7～365日です。短くすると、キャッシュの更新は早いですが表示速度が遅くなったり、先方のサーバーに負荷がかかります。' : '',
    'section' => 'blog_card_external_section',
    'type' => 'number',
    'priority'=> 1100,
  ));

  //OGPキャッシュクリアモード
  $wp_customize->add_setting('blog_card_external_cache_refresh_mode', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'blog_card_external_cache_refresh_mode', array(
    'settings' => 'blog_card_external_cache_refresh_mode',
    'label' =>'キャッシュ更新モード',
    'description' => is_tips_visible() ? '「キャッシュ更新モード」を有効にして管理者（ログインユーザー）によって外部ブログカードが表示されているページを閲覧したときに、OGPキャシュが更新されます。更新が済んだら無効などに戻すなどして使用してください。' : '',
    'section' => 'blog_card_external_section',
    'type' => 'checkbox',
    'priority' => 1200,
  ));


  /////////////////////////////
  //ソースコード設定項目の追加
  /////////////////////////////
  $wp_customize->add_section( 'source_code_section', array(
    'title'          =>'ソースコード',
    'description' => is_tips_visible() ? 'ソースコードのハイライト表示の設定です。ハイライト表示には、<a href="https://highlightjs.org/" target="_blank">highlight.js</a>を利用しています。詳しくは、<a href="http://wp-simplicity.com/highlight-js/" target="_blank">ハイライト設定</a>を参照してください。' : '',
    'priority'       => 98.2,
  ));

  //ソースコードをハイライト表示
  $wp_customize->add_setting('code_highlight_enable', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'code_highlight_enable', array(
    'settings' => 'code_highlight_enable',
    'label' => 'ソースコードをハイライト表示',
    'description' => is_tips_visible() ? 'preタグで囲まれたソースコードをハイライト表示します。' : '',
    'section' => 'source_code_section',
    'type' => 'checkbox',
    'priority' => 100,
  ));

  //テーマスタイル
  $wp_customize->add_setting('code_highlight_style', array(
    'default' => 'default',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'code_highlight_style', array(
    'settings' => 'code_highlight_style',
    'label' => 'ハイライトスタイル',
    'description' => is_tips_visible() ? 'ソースコードのハイライトテーマです。スタイリについては、<a href="https://highlightjs.org/static/demo/" target="_blank">highlight.js demo</a>を参照してください。' : '',
    'section' => 'source_code_section',
    'type' => 'select',
    'choices'    => array(
      'agate' => 'agate',
      'androidstudio' => 'androidstudio',
      'arduino-light' => 'arduino-light',
      'arta' => 'arta',
      'ascetic' => 'ascetic',
      'atelier-cave-dark' => 'atelier-cave-dark',
      'atelier-cave-light' => 'atelier-cave-light',
      'atelier-dune-dark' => 'atelier-dune-dark',
      'atelier-dune-light' => 'atelier-dune-light',
      'atelier-estuary-dark' => 'atelier-estuary-dark',
      'atelier-estuary-light' => 'atelier-estuary-light',
      'atelier-forest-dark' => 'atelier-forest-dark',
      'atelier-forest-light' => 'atelier-forest-light',
      'atelier-heath-dark' => 'atelier-heath-dark',
      'atelier-heath-light' => 'atelier-heath-light',
      'atelier-lakeside-dark' => 'atelier-lakeside-dark',
      'atelier-lakeside-light' => 'atelier-lakeside-light',
      'atelier-plateau-dark' => 'atelier-plateau-dark',
      'atelier-plateau-light' => 'atelier-plateau-light',
      'atelier-savanna-dark' => 'atelier-savanna-dark',
      'atelier-savanna-light' => 'atelier-savanna-light',
      'atelier-seaside-dark' => 'atelier-seaside-dark',
      'atelier-seaside-light' => 'atelier-seaside-light',
      'atelier-sulphurpool-dark' => 'atelier-sulphurpool-dark',
      'atelier-sulphurpool-light' => 'atelier-sulphurpool-light',
      'brown-paper' => 'brown-paper',
      'codepen-embed' => 'codepen-embed',
      'color-brewer' => 'color-brewer',
      'dark' => 'dark',
      'darkula' => 'darkula',
      'default' => 'default',
      'docco' => 'docco',
      'dracula' => 'dracula',
      'far' => 'far',
      'foundation' => 'foundation',
      'github-gist' => 'github-gist',
      'github' => 'github',
      'googlecode' => 'googlecode',
      'grayscale' => 'grayscale',
      'gruvbox-dark' => 'gruvbox-dark',
      'gruvbox-light' => 'gruvbox-light',
      'hopscotch' => 'hopscotch',
      'hybrid' => 'hybrid',
      'idea' => 'idea',
      'ir-black' => 'ir-black',
      'kimbie.dark' => 'kimbie.dark',
      'kimbie.light' => 'kimbie.light',
      'magula' => 'magula',
      'mono-blue' => 'mono-blue',
      'monokai-sublime' => 'monokai-sublime',
      'monokai' => 'monokai',
      'obsidian' => 'obsidian',
      'paraiso-dark' => 'paraiso-dark',
      'paraiso-light' => 'paraiso-light',
      'pojoaque' => 'pojoaque',
      'purebasic' => 'purebasic',
      'qtcreator_dark' => 'qtcreator_dark',
      'qtcreator_light' => 'qtcreator_light',
      'railscasts' => 'railscasts',
      'rainbow' => 'rainbow',
      'school-book' => 'school-book',
      'solarized-dark' => 'solarized-dark',
      'solarized-light' => 'solarized-light',
      'sunburst' => 'sunburst',
      'tomorrow-night-blue' => 'tomorrow-night-blue',
      'tomorrow-night-bright' => 'tomorrow-night-bright',
      'tomorrow-night-eighties' => 'tomorrow-night-eighties',
      'tomorrow-night' => 'tomorrow-night',
      'tomorrow' => 'tomorrow',
      'vs' => 'vs',
      'xcode' => 'xcode',
      'xt256' => 'xt256',
      'zenburn' => 'zenburn',
      'agate' => 'agate',
      'androidstudio' => 'androidstudio',
      'arduino-light' => 'arduino-light',
      'arta' => 'arta',
      'ascetic' => 'ascetic',
      'atelier-cave-dark' => 'atelier-cave-dark',
      'atelier-cave-light' => 'atelier-cave-light',
      'atelier-dune-dark' => 'atelier-dune-dark',
      'atelier-dune-light' => 'atelier-dune-light',
      'atelier-estuary-dark' => 'atelier-estuary-dark',
      'atelier-estuary-light' => 'atelier-estuary-light',
      'atelier-forest-dark' => 'atelier-forest-dark',
      'atelier-forest-light' => 'atelier-forest-light',
      'atelier-heath-dark' => 'atelier-heath-dark',
      'atelier-heath-light' => 'atelier-heath-light',
      'atelier-lakeside-dark' => 'atelier-lakeside-dark',
      'atelier-lakeside-light' => 'atelier-lakeside-light',
      'atelier-plateau-dark' => 'atelier-plateau-dark',
      'atelier-plateau-light' => 'atelier-plateau-light',
      'atelier-savanna-dark' => 'atelier-savanna-dark',
      'atelier-savanna-light' => 'atelier-savanna-light',
      'atelier-seaside-dark' => 'atelier-seaside-dark',
      'atelier-seaside-light' => 'atelier-seaside-light',
      'atelier-sulphurpool-dark' => 'atelier-sulphurpool-dark',
      'atelier-sulphurpool-light' => 'atelier-sulphurpool-light',
      'brown-paper' => 'brown-paper',
      'codepen-embed' => 'codepen-embed',
      'color-brewer' => 'color-brewer',
      'dark' => 'dark',
      'darkula' => 'darkula',
      'default' => 'default',
      'docco' => 'docco',
      'dracula' => 'dracula',
      'far' => 'far',
      'foundation' => 'foundation',
      'github-gist' => 'github-gist',
      'github' => 'github',
      'googlecode' => 'googlecode',
      'grayscale' => 'grayscale',
      'gruvbox-dark' => 'gruvbox-dark',
      'gruvbox-light' => 'gruvbox-light',
      'hopscotch' => 'hopscotch',
      'hybrid' => 'hybrid',
      'idea' => 'idea',
      'ir-black' => 'ir-black',
      'kimbie.dark' => 'kimbie.dark',
      'kimbie.light' => 'kimbie.light',
      'magula' => 'magula',
      'mono-blue' => 'mono-blue',
      'monokai-sublime' => 'monokai-sublime',
      'monokai' => 'monokai',
      'obsidian' => 'obsidian',
      'paraiso-dark' => 'paraiso-dark',
      'paraiso-light' => 'paraiso-light',
      'pojoaque' => 'pojoaque',
      'purebasic' => 'purebasic',
      'qtcreator_dark' => 'qtcreator_dark',
      'qtcreator_light' => 'qtcreator_light',
      'railscasts' => 'railscasts',
      'rainbow' => 'rainbow',
      'school-book' => 'school-book',
      'solarized-dark' => 'solarized-dark',
      'solarized-light' => 'solarized-light',
      'sunburst' => 'sunburst',
      'tomorrow-night-blue' => 'tomorrow-night-blue',
      'tomorrow-night-bright' => 'tomorrow-night-bright',
      'tomorrow-night-eighties' => 'tomorrow-night-eighties',
      'tomorrow-night' => 'tomorrow-night',
      'tomorrow' => 'tomorrow',
      'vs' => 'vs',
      'xcode' => 'xcode',
      'zenburn' => 'zenburn',
      'xt256' => 'xt256',
    ),
    'priority' => 200,
  ));

  //ソースコードのハイライトをするCSSセレクタの設定
  $wp_customize->add_setting('code_highlight_css_selector', array(
    'default' => '.entry-content pre',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'code_highlight_css_selector', array(
    'settings' => 'code_highlight_css_selector',
    'label' => 'ハイライトするCSSセレクタ',
    'description' => is_tips_visible() ? 'ソースコードをハイライトするCSSセレクターを細かく設定できます。よくわからない場合は変更しないでください。' : '',
    'section' => 'source_code_section',
    'type' => 'text',
    'priority'=> 300,
  ));


  /////////////////////////////
  //コメント項目の追加
  /////////////////////////////
  $wp_customize->add_section( 'comment_section', array(
    'title'          =>'コメント',
    'description' => is_tips_visible() ? 'コメント表示欄・入力欄に関する設定です。' : '',
    'priority'       => 98.3,
  ));

  //コメントの表示
  $wp_customize->add_setting('comments_visible', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'comments_visible', array(
    'settings' => 'comments_visible',
    'label' =>'コメントの表示',
    'description' => is_tips_visible() ? 'コメントを表示するか。' : '',
    'section' => 'comment_section',
    'type' => 'checkbox',
    'priority' => 10,
  ));

  //コメントスタイル
  $wp_customize->add_setting('comment_display_type', array(
    'default' => 'default',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'comment_display_type', array(
    'settings' => 'comment_display_type',
    'label' =>'コメント表示タイプ',
    'description' => is_tips_visible() ? 'コメントの表示スタイルを設定します。' : '',
    'section' => 'comment_section',
    'type' => 'radio',
    'choices'    => array(
      'default' => 'デフォルト',
      'thread_simple' => 'シンプルスレッド表示',
      'thread' => '某スレッド掲示板風',
    ),
    'priority' => 100,
  ));

  //インデックスリストにコメント数を表示
  $wp_customize->add_setting('list_comment_count_visible', array(
    'default' => false,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'list_comment_count_visible', array(
    'settings' => 'list_comment_count_visible',
    'label' =>'インデックスリストにコメント数を表示',
    'description' => is_tips_visible() ? 'エントリーの一覧リストにコメント数を表示するか。（※コメントの設定でコメントを表示にしていないと表示されません。）' : '',
    'section' => 'comment_section',
    'type' => 'checkbox',
    'priority' => 200,
  ));

  //コメント欄の伸縮
  $wp_customize->add_setting('comment_textarea_expand', array(
    'default' => false,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'comment_textarea_expand', array(
    'settings' => 'comment_textarea_expand',
    'label' =>'コメント欄を文章量に応じて伸縮',
    'description' => is_tips_visible() ? 'コメント入力フォームを文章量に応じて伸縮させるか。' : '',
    'section' => 'comment_section',
    'type' => 'checkbox',
    'priority' => 300,
  ));


  /////////////////////////////
  //テーマテキスト設定項目の追加
  /////////////////////////////
  $wp_customize->add_section( 'theme_text_section', array(
    'title'          =>'テーマ内テキスト',
    'description' => is_tips_visible() ? 'テーマ内で使用されている定型文を変更することができます。' : '',
    'priority'       => 98.5,
  ));

  //パンくずリストの「ホーム」を変更
  $wp_customize->add_setting('theme_text_breadcrumbs_home', array(
    'default' => 'ホーム',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'theme_text_breadcrumbs_home', array(
    'settings' => 'theme_text_breadcrumbs_home',
    'label' =>'パンくずリストのホームを変更',
    'description' => is_tips_visible() ? 'パンくずリストの「ホーム」のテキストを変更します。設定は、投稿と固定ページ両方のパンくずリストに反映されます。。' : '',
    'section' => 'theme_text_section',
    'type' => 'text',
    'priority'=> 50,
  ));

  //関連記事のタイトルを変更
  $wp_customize->add_setting('theme_text_related_entry', array(
    'default' => '関連記事',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'theme_text_related_entry', array(
    'settings' => 'theme_text_related_entry',
    'label' =>'関連記事タイトルを変更',
    'description' => is_tips_visible() ? '関連記事のH3見出しを変更します。' : '',
    'section' => 'theme_text_section',
    'type' => 'text',
    'priority'=> 100,
  ));

  //コメントタイトルを変更
  $wp_customize->add_setting('theme_text_comments', array(
    'default' => 'コメント',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'theme_text_comments', array(
    'settings' => 'theme_text_comments',
    'label' =>'コメントタイトルを変更',
    'description' => is_tips_visible() ? 'コメント欄ののH3見出しを変更します。' : '',
    'section' => 'theme_text_section',
    'type' => 'text',
    'priority'=> 200,
  ));

  //返信コメントタイトルを変更
  $wp_customize->add_setting('theme_text_comment_reply_title', array(
    'default' => 'コメントをどうぞ',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'theme_text_comment_reply_title', array(
    'settings' => 'theme_text_comment_reply_title',
    'label' =>'返信コメントタイトルを変更',
    'description' => is_tips_visible() ? 'コメントを促すテキスト変更します。' : '',
    'section' => 'theme_text_section',
    'type' => 'text',
    'priority'=> 300,
  ));

  //サブミットラベルを変更
  $wp_customize->add_setting('theme_text_comment_submit_label', array(
    'default' => 'コメントを送信',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'theme_text_comment_submit_label', array(
    'settings' => 'theme_text_comment_submit_label',
    'label' =>'コメントサブミットラベルを変更',
    'description' => is_tips_visible() ? 'コメント送信ボタンテキスト変更します。' : '',
    'section' => 'theme_text_section',
    'type' => 'text',
    'priority'=> 400,
  ));

  //サブミットラベルを変更
  $wp_customize->add_setting('theme_text_comment_freeze_label', array(
    'default' => 'コメントの入力は終了しました。',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'theme_text_comment_freeze_label', array(
    'settings' => 'theme_text_comment_freeze_label',
    'label' => 'コメント入力凍結時のメッセージ',
    'description' => is_tips_visible() ? 'コメント入力欄を非表示にした時のメッセージを変更します。' : '',
    'section' => 'theme_text_section',
    'type' => 'text',
    'priority'=> 420,
  ));

  //匿名のユーザー名を変更
  $wp_customize->add_setting('theme_text_comment_anonymous_name', array(
    'default' => '匿名',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'theme_text_comment_anonymous_name', array(
    'settings' => 'theme_text_comment_anonymous_name',
    'label' =>'匿名のユーザー名を変更',
    'description' => is_tips_visible() ? '匿名でコメント投稿するユーザーのデフォルト名を変更します。' : '',
    'section' => 'theme_text_section',
    'type' => 'text',
    'priority'=> 450,
  ));

  //「記事を読む」の変更
  $wp_customize->add_setting('theme_text_read_entry', array(
    'default' => '記事を読む',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'theme_text_read_entry', array(
    'settings' => 'theme_text_read_entry',
    'label' =>'「記事を読む」の変更',
    'description' => is_tips_visible() ? '一覧リストの「記事を読む」リンクのテキストを変更します。' : '',
    'section' => 'theme_text_section',
    'type' => 'text',
    'priority'=> 500,
  ));

  //「続きを読む」の変更
  $wp_customize->add_setting('theme_text_read_more', array(
    'default' => '続きを読む',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'theme_text_read_more', array(
    'settings' => 'theme_text_read_more',
    'label' =>'「続きを読む」の変更',
    'description' => is_tips_visible() ? 'moreタグ以降の「続きを読む」リンクのテキストを変更します。' : '',
    'section' => 'theme_text_section',
    'type' => 'text',
    'priority'=> 600,
  ));

  //リストタイトルの「一覧」を変更
  $wp_customize->add_setting('theme_text_list', array(
    'default' => '一覧',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'theme_text_list', array(
    'settings' => 'theme_text_list',
    'label' =>'リストタイトルの「一覧」を変更',
    'description' => is_tips_visible() ? 'インデックスリストのタイトルに含まれる「一覧」部分を変更します。' : '',
    'section' => 'theme_text_section',
    'type' => 'text',
    'priority'=> 700,
  ));

  //日付のフォーマット
  $wp_customize->add_setting('theme_text_date_format', array(
    'default' => 'Y/n/j',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'theme_text_date_format', array(
    'settings' => 'theme_text_date_format',
    'label' =>'日付表示のフォーマット',
    'description' => is_tips_visible() ? '投稿日や更新日の日付表示フォーマットを変更します。' : '',
    'section' => 'theme_text_section',
    'type' => 'text',
    'priority'=> 750,
  ));

  //年月日のフォーマット
  $wp_customize->add_setting('theme_text_ymd_format', array(
    'default' => 'Y年m月d日',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'theme_text_ymd_format', array(
    'settings' => 'theme_text_ymd_format',
    'label' =>'一覧：年月日のフォーマット',
    'description' => is_tips_visible() ? 'インデクスリストの年月日表示フォーマットを変更します。' : '',
    'section' => 'theme_text_section',
    'type' => 'text',
    'priority'=> 800,
  ));

  //年と月のフォーマット
  $wp_customize->add_setting('theme_text_ym_format', array(
    'default' => 'Y年m月',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'theme_text_ym_format', array(
    'settings' => 'theme_text_ym_format',
    'label' =>'一覧：年月のフォーマット',
    'description' => is_tips_visible() ? 'インデクスリストの年月表示フォーマットを変更します。' : '',
    'section' => 'theme_text_section',
    'type' => 'text',
    'priority'=> 900,
  ));

  //年のフォーマット
  $wp_customize->add_setting('theme_text_y_format', array(
    'default' => 'Y年',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'theme_text_y_format', array(
    'settings' => 'theme_text_y_format',
    'label' =>'一覧：年のフォーマット',
    'description' => is_tips_visible() ? 'インデクスリストの年表示フォーマットを変更します。' : '',
    'section' => 'theme_text_section',
    'type' => 'text',
    'priority'=> 1000,
  ));

  //検索ボックスのプレースホルダ
  $wp_customize->add_setting('theme_text_search_placeholder', array(
    'default' => 'ブログ内を検索',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'theme_text_search_placeholder', array(
    'settings' => 'theme_text_search_placeholder',
    'label' =>'検索ボックスのプレースホルダー',
    'description' => is_tips_visible() ? '検索ボックスに表示されるテキスト変更します。' : '',
    'section' => 'theme_text_section',
    'type' => 'text',
    'priority'=> 1100,
  ));

  // //関連記事が見つからなかった時のメッセージ
  // $wp_customize->add_setting('theme_text_related_not_found_message', array(
  //   'default' => '関連記事は見つかりませんでした。',
  //   'sanitize_callback' => 'sanitize_text',
  // ));
  // $wp_customize->add_control( 'theme_text_related_not_found_message', array(
  //   'settings' => 'theme_text_related_not_found_message',
  //   'label' =>'関連記事が見つからなかった時のメッセージ',
  //   'description' => is_tips_visible() ? '関連記事が見つからなかった場合に表示されるテキスト変更します。' : '',
  //   'section' => 'theme_text_section',
  //   'type' => 'text',
  //   'priority'=> 1125,
  // ));

  // //ページが見つからなかった時のタイトル
  // $wp_customize->add_setting('theme_text_not_found_title', array(
  //   'default' => 'ページが見つかりませんでした',
  //   'sanitize_callback' => 'sanitize_text',
  // ));
  // $wp_customize->add_control( 'theme_text_not_found_title', array(
  //   'settings' => 'theme_text_not_found_title',
  //   'label' =>'見つからなかった時のタイトル',
  //   'description' => is_tips_visible() ? '404ページのタイトルを変更します。' : '',
  //   'section' => 'theme_text_section',
  //   'type' => 'text',
  //   'priority'=> 1150,
  // ));

  //ページが見つからなかった時のメッセージ
  $wp_customize->add_setting('theme_text_not_found_message', array(
    'default' => '記事は見つかりませんでした。',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'theme_text_not_found_message', array(
    'settings' => 'theme_text_not_found_message',
    'label' =>'見つからなかった時のメッセージ',
    'description' => is_tips_visible() ? '記事が見つからなかった時に表示されるテキスト変更します。' : '',
    'section' => 'theme_text_section',
    'type' => 'text',
    'priority'=> 1200,
  ));


  /////////////////////////////
  //管理画面設定項目の追加
  /////////////////////////////
  $wp_customize->add_section( 'admin_section', array(
    'title'          =>'管理画面',
    'description' => is_tips_visible() ? '管理画面やアドミンバー（管理バー）に独自機能を追加する設定です。' : '',
    'priority'       => 98.7,
  ));

  //ビジュアルエディターにSimplicityスタイルを適用
  $wp_customize->add_setting('admin_editor_enable', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'admin_editor_enable', array(
    'settings' => 'admin_editor_enable',
    'label' =>'ビジュアルエディターにSimplicityスタイルを適用',
    'description' => is_tips_visible() ? '投稿管理画面のビジュアルエディターの表示をSimplicityデフォルトのようにします。（※子テーマなどにカスタマイズしたスタイルは適用されません。）' : '',
    'section' => 'admin_section',
    'type' => 'checkbox',
    'priority' => 50,
  ));

  //アドミンバーに独自管理メニュー表示
  $wp_customize->add_setting('admin_bar_menu_visible', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'admin_bar_menu_visible', array(
    'settings' => 'admin_bar_menu_visible',
    'label' =>'アドミンバーに独自管理メニューを表示',
    'description' => is_tips_visible() ? '管理バーにSimplicity独自のメニューを表示するか。' : '',
    'section' => 'admin_section',
    'type' => 'checkbox',
    'priority' => 100,
  ));

  //ログイン画面のロゴをカスタマイズで設定したロゴにする
  $wp_customize->add_setting('admin_original_login_logo_enable', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'admin_original_login_logo_enable', array(
    'settings' => 'admin_original_login_logo_enable',
    'label' =>'ログイン画面のロゴをカスタマイズで設定したロゴにする',
    'description' => is_tips_visible() ? 'テーマカスタマイザーで設定したロゴをログイン画面で表示するか。' : '',
    'section' => 'admin_section',
    'type' => 'checkbox',
    'priority' => 200,
  ));

  //メディアを挿入の初期表示を「この投稿へのアップロード」にする
  $wp_customize->add_setting('admin_initial_media_disp_type_in_entry', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'admin_initial_media_disp_type_in_entry', array(
    'settings' => 'admin_initial_media_disp_type_in_entry',
    'label' =>'メディアを挿入の初期表示を「この投稿へのアップロード」にする',
    'description' => is_tips_visible() ? '投稿管理画面からメディアを表示したときに、その投稿に含まれている画像のみを表示します。' : '',
    'section' => 'admin_section',
    'type' => 'checkbox',
    'priority' => 300,
  ));

  //ページ公開前に確認アラートを出す
  $wp_customize->add_setting('confirmation_before_publish', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'confirmation_before_publish', array(
    'settings' => 'confirmation_before_publish',
    'label' =>'ページ公開前に確認アラートを出す',
    'description' => is_tips_visible() ? '投稿・固定ページを公開前に確認ダイアログを表示します。' : '',
    'section' => 'admin_section',
    'type' => 'checkbox',
    'priority' => 400,
  ));

  //管理者のみにPV表示
  $wp_customize->add_setting('admin_pv_visible', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'admin_pv_visible', array(
    'settings' => 'admin_pv_visible',
    'label' =>'管理者のみにPV表示',
    'description' => is_tips_visible() ? 'ログインユーザーのみにPVを表示します。（※要Wordpress Popular Postsプラグインのインストール）' : '',
    'section' => 'admin_section',
    'type' => 'checkbox',
    'priority' => 500,
  ));


  /////////////////////////////
  //その他項目の追加
  /////////////////////////////
  $wp_customize->add_section( 'other_section', array(
    'title'          =>'その他',
    'description' => is_tips_visible() ? 'ファビコンや、アップルタッチアイコン、その他の設定がまとめてあります。' : '',
    'priority'       => 99,
  ));

  //カスタマイザー項目説明の表示
  $wp_customize->add_setting('tips_visible', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'tips_visible', array(
    'settings' => 'tips_visible',
    'label' =>'Tips（項目の説明）の表示',
    'description' => is_tips_visible() ? 'テーマカスタマイザーのそれぞれの項目に関する詳細な説明を表示するか。' : '',
    'section' => 'other_section',
    'type' => 'checkbox',
    'priority' => 5,
  ));

  //テーマ側でファビコンを設定
  $wp_customize->add_setting('favicon_enable', array(
    'priority' => 10,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'favicon_enable', array(
    'settings' => 'favicon_enable',
    'label' =>'ファビコンを有効',
    'section' => 'other_section',
    'type' => 'checkbox',
    'priority'=> 10,
  ));

  //ファビコン
  $wp_customize->add_setting( 'favicon_url', array(
    'sanitize_callback' => 'sanitize_file_url',
  ) );
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'favicon_url', array(
    'settings' => 'favicon_url',
    'label' => 'ファビコン',
    'description' => is_tips_visible() ? 'メディアからファビコンを設定できます。' : '',
    'section' => 'other_section',
    'priority' => 20,
  ) ) );

  //テーマ側でアップルタッチアイコンを設定
  $wp_customize->add_setting('apple_touch_icon_enable', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'apple_touch_icon_enable', array(
    'settings' => 'apple_touch_icon_enable',
    'label' => 'アップルタッチアイコンを有効',
    'section' => 'other_section',
    'type' => 'checkbox',
    'priority'=> 30,
  ));

  //アップルタッチアイコン
  $wp_customize->add_setting( 'apple_touch_icon_url', array(
    'sanitize_callback' => 'sanitize_file_url',
  ) );
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'apple_touch_icon_url', array(
    'settings' => 'apple_touch_icon_url',
    'label' =>'アップルタッチアイコン',
    'description' => is_tips_visible() ? 'メディアからアップルタッチアイコンを設定できます。（※.png推奨）' : '',
    'section' => 'other_section',
    'priority' => 40,
  ) ) );

  //外部サイトデータ取得時にSSL検証を行う
  $wp_customize->add_setting('ssl_verification_enable', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'ssl_verification_enable', array(
    'settings' => 'ssl_verification_enable',
    'label' =>'外部サイトデータ取得時にSSL検証を行う',
    'description' => is_tips_visible() ? 'wp_remote_getで外部サイトデータを取得時に、SSL検証を有効にします。' : '',
    'section' => 'other_section',
    'type' => 'checkbox',
    'priority' => 43,
  ));

  //自動アップデートを有効にする
  $wp_customize->add_setting('auto_update_enable', array(
    'default' => true,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'auto_update_enable', array(
    'settings' => 'auto_update_enable',
    'label' => 'オートアップデートを有効',
    'description' => is_tips_visible() ? 'テーマのオートアップデート機能を有効にするか。親テーマをカスタマイズしている場合は、オフにしておいたほうがいいかも。（※オフにするとセキュリティー問題があったときも自動通知されません。）' : '',
    'section' => 'other_section',
    'type' => 'checkbox',
    'priority'=> 45,
  ));

  //カスタマイザーのスタイルを外部CSSに書き出す
  $wp_customize->add_setting('external_custom_css_enable', array(
    'default' => false,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'external_custom_css_enable', array(
    'settings' => 'external_custom_css_enable',
    'label' => 'カスタマイザーのスタイル変更を外部CSSに書き出す（非推奨）',
    'description' => is_tips_visible() ? 'ヘッダーに埋め込まれるテーマカスタマイザーのスタイルシートを外部CSSファイルに書き出してから読み込みます。（※使用による不具合についてはサポートできません）' : '',
    'section' => 'other_section',
    'type' => 'checkbox',
    'priority'=> 47,
  ));

  //Windows Live Writerで編集を表示
  $wp_customize->add_setting('wlw_link_visible', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'wlw_link_visible', array(
    'settings' => 'wlw_link_visible',
    'label' => '「WLWで編集」リンクを出す',
    'description' => is_tips_visible() ? 'ログインユーザーにWindows Live Writer用の編集リンクを表示します。（※Windows Live Writerユーザーで、「WLW Post Downloader Plugin」のインストールが必須）' : '',
    'section' => 'other_section',
    'type' => 'checkbox',
    'priority'=> 50,
  ));

  //日本語のスラッグを有効にする
  $wp_customize->add_setting('japanese_slug_enable', array(
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'japanese_slug_enable', array(
    'settings' => 'japanese_slug_enable',
    'label' =>'日本語のスラッグを有効にする',
    'description' => is_tips_visible() ? '投稿・固定ページのパーマリンクに日本語を使用するか。' : '',
    'section' => 'other_section',
    'type' => 'checkbox',
    'priority' => 80,
  ));

  //著作権表記
  $wp_customize->add_setting('site_license', array(
    'default' => 'copyright',
    'sanitize_callback' => 'sanitize_text',
  ));
  $wp_customize->add_control( 'site_license', array(
    'settings' => 'site_license',
    'label' =>'ライセンス',
    'description' => is_tips_visible() ? 'サイトのライセンスを設定します。' : '',
    'section' => 'other_section',
    'type' => 'radio',
    'choices'    => array(
      'copyright' => '©（デフォルト）',
      'copyright_abridged' => '©（日付なし）',
      'copyright_backward' => 'Copyright©（表記を書く）',
      'cc_by' => 'CC-表示',
      'cc_by_sa' => 'CC-表示-継承',
      'cc_by_nd' => 'CC-表示-改変禁止',
      'cc_by_nc' => 'CC-表示-非営利',
      'cc_by_nc_sa' => 'CC-表示-非営利-継承',
      'cc_by_nc_nd' => 'CC-表示-非営利-改変禁止',
      'cc0' => 'CC0',
      'pd' => 'パブリックドメイン',
    ),
    'priority' => 1000,
  ));

  //ローカルでのレスポンシブテストを表示
  $wp_customize->add_setting('responsive_test_visible', array(
    'default' => false,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'responsive_test_visible', array(
    'settings' => 'responsive_test_visible',
    'label' =>'ローカルでのレスポンシブテストを表示',
    'description' => is_tips_visible() ? 'ローカル環境でテスト時のみサイトフッター部分にレスポンシブテスト用のリンクを表示します。' : '',
    'section' => 'other_section',
    'type' => 'checkbox',
    'priority' => 2000,
  ));

  //ページキャッシュモード
  $wp_customize->add_setting('page_cache_enable', array(
    'default' => false,
    'sanitize_callback' => 'sanitize_check',
  ));
  $wp_customize->add_control( 'page_cache_enable', array(
    'settings' => 'page_cache_enable',
    'label' =>'ページキャッシュモード',
    'description' => is_tips_visible() ? '※通常は利用非推奨。ページキャシュプラグインと併わせて利用して高速化を図るためのモードです。尚、この機能をオンにすると不具合があるかもしれません。ですが基本的にノーサポートです。この機能は．自分の力で何とかできる場合にのみご利用ください。' : '',
    'section' => 'other_section',
    'type' => 'checkbox',
    'priority' => 3000,
  ));

}

//カスタムスキン設定の値を取得
function get_skin_options(){
  return get_option('skin_options');
}

function remove_protocol($url){
  return preg_replace('/https?:/i', '', $url);
}

//スキンファイルを取得
//スキンファイルを設定している場合はスタイルシート名（パス/style.css）を返す
//設定していない場合は偽（空文字）を返す
function get_skin_file(){
  $file_path = get_theme_mod( 'skin_file', null );
  if ( $file_path ) {
    $file_path = remove_protocol($file_path);
    //CSS縮小化プラグインのためにプロトコルをつけるように変更v2.2.1
    //プロトコルがついていないと縮小化できないプラグインもある
    if ( is_ssl() ) {
      $file_path = 'https:'.$file_path;
    } else {
      $file_path = 'http:'.$file_path;
    }

    return $file_path;
  }
}

//カスタムレイアウト設定の値を取得
function get_layout_options(){
  return get_option('layout_options');
}

//ヘッダーの高さを取得
function get_header_height(){
  return get_theme_mod( 'header_height', 100 );
}

//ロゴを画像にするかどうか
function is_header_logo_enable(){
  return get_theme_mod( 'header_logo_enable', false );
}

//ヘッダーロゴ画像のURL
function get_header_logo_url(){
  $header_logo_url = null;
  if ( is_header_logo_enable() ) {
    $header_logo_url = get_theme_mod( 'header_logo_url', null );
  }
  return $header_logo_url;
}

//ヘッダー外側の背景画像URLの取得
function get_header_outer_background_image(){
  return get_theme_mod( 'header_outer_background_image', null);
}

//モバイルヘッダーの高さを取得
function get_header_height_mobile(){
  return get_theme_mod( 'header_height_mobile', 0 );
}

//モバイルヘッダーの背景画像URLの取得
function get_mobile_header_background_image(){
  return get_theme_mod( 'mobile_header_background_image', null );
}

//完全レスポンシブかどうか
function is_responsive_enable(){
  return get_theme_mod( 'responsive_enable', false ) || is_page_cache_enable();
}

//PCでサイドバーをレスポンシブにするか（完全レスポンシブがオフの時のみ）
function is_responsive_pc_sidebar_enable(){
  return get_theme_mod( 'responsive_pc_sidebar_enable', true );
}

//タブレットをモバイル表示するか
function is_tablet_mobile(){
  return get_theme_mod( 'tablet_mobile', false );
}

//タイトルを中央寄せにするか
function is_title_center(){
  return get_theme_mod( 'title_center', false );
}

//本文文字サイズ
function get_article_font_size(){
  return get_theme_mod( 'article_font_size', ARTICLE_FONT_SIZE );
}

//モバイル本文文字サイズ
function get_article_mobile_font_size(){
  return get_theme_mod( 'article_mobile_font_size', ARTICLE_FONT_SIZE );
}

//長い単語を強制改行するか
function is_word_wrap_break_word(){
  return get_theme_mod( 'word_wrap_break_word', false );
}

//モバイルでbr改行を表示するか
function is_br_visible_with_mobile(){
  return get_theme_mod( 'br_visible_with_mobile', true );
}

//投稿日表示がオンかどうか
function is_create_date_visible(){
  return get_theme_mod( 'create_date_visible', true );
}

//時間差表示がオンかどうか
function is_human_time_diff_visible(){
  return get_theme_mod( 'human_time_diff_visible', false );
}

//更新日表示がオンかどうか
function is_update_date_visible(){
  return get_theme_mod( 'update_date_visible', true );
}

//カテゴリー情報表示がオンかどうか
function is_category_visible(){
  return get_theme_mod( 'category_visible', true );
}

//タグ情報表示がオンかどうか
function is_tag_visible(){
  return get_theme_mod( 'tag_visible', true );
}

//コメント数表示がオンかどうか
function is_comment_count_visible(){
  return get_theme_mod( 'comment_count_visible', false );
}

//投稿者情報表示がオンかどうか
function is_author_visible(){
  return get_theme_mod( 'author_visible', true );
}

//投稿者情報にTwitter IDを表示するか
function is_twitter_follow_id_author_visible(){
  return get_theme_mod( 'twitter_follow_id_author_visible', false );
}

//編集リンク表示がオンかどうか
function is_edit_visible(){
  return get_theme_mod( 'edit_visible', true );
}

//先頭のアイキャッチを表示するかどうか
function is_eye_catch_visible(){
  return get_theme_mod( 'eye_catch_visible', false );
}

//先頭のアイキャッチキャプションを表示するかどうか
function is_eye_catch_caption_visible(){
  return get_theme_mod( 'eye_catch_caption_visible', false );
}

//抜粋文字数の取得
function get_excerpt_length(){
  return get_theme_mod( 'excerpt_length', 70 );
}

//抜粋の末尾文字
function get_excerpt_more(){
  return get_theme_mod( 'excerpt_more', '...' );
}

//Wordpress固有の抜粋文を使用するか
function is_wordpress_excerpt(){
  return get_theme_mod( 'wordpress_excerpt', false );
}

//関連記事を表示するか
function is_related_entry_visible(){
  return get_theme_mod( 'related_entry_visible', true );
}

//関連記事表示タイプの取得
function get_related_entry_type(){
  return get_theme_mod( 'related_entry_type', 'default' );
}

//関連記事表示タイプはデフォルトか
function is_related_entry_type_default(){
  return get_related_entry_type() == 'default';
}

//関連記事表示タイプはサムネイル3列表示が
function is_related_entry_type_thumbnail3(){
  return get_related_entry_type() == 'thumbnail';
}

//関連記事表示タイプはサムネイル4列表示が
function is_related_entry_type_thumbnail4(){
  return get_related_entry_type() == 'thumbnail4';
}

//関連記事の関連付けタイプの取得
function get_related_entry_association(){
  return get_theme_mod( 'related_entry_association', 'category' );
}

//関連記事の関連付けはカテゴリか
function is_related_entry_association_category(){
  return get_related_entry_association() == 'category';
}

//関連記事の関連付けはタグか
function is_related_entry_association_tag(){
  return get_related_entry_association() == 'tag';
}

//関連記事数の取得
function get_related_entry_count(){
  return get_theme_mod( 'related_entry_count', 10 );
}

//グローバルナビを表示するかどうか
function is_navi_visible(){
  return get_theme_mod( 'navi_visible', true ) ||
   ( is_mobile_menu_type_slide_in() && is_mobile() );
}

//モバイルメニュータイプの取得
function get_mobile_menu_type(){
  return get_theme_mod( 'mobile_menu_type', 'accordion' );
}

//グローバルナビをアコーディオンにするか
function is_mobile_menu_type_accordion(){
  return get_mobile_menu_type() == 'accordion';
}

//グローバルナビをアコーディオンツリーにするか（SlickNav）
function is_mobile_menu_type_accordion_tree(){
  return get_mobile_menu_type() == 'accordion_tree';
}

//グローバルナビをモーダル表示するかどうか
function is_mobile_menu_type_modal(){
  return get_mobile_menu_type() == 'modal';
}

//グローバルナビをスライドインボタンで表示するかどうか
function is_mobile_menu_type_slide_in(){
  return is_slide_in_light() ||
         is_slide_in_dark();
}
//グローバルナビが「スライドインライト」か
function is_slide_in_light(){
  return is_slide_in_light_top() ||
         is_slide_in_light_bottom();
}

//グローバルナビを「スライドインライト（ボタン上）」で表示するかどうか
function is_slide_in_light_top(){
  return get_mobile_menu_type() == 'slide_in_light_top' && is_mobile() && !is_responsive_enable();
}

//グローバルナビを「スライドインライト（ボタン下）」で表示するかどうか
function is_slide_in_light_bottom(){
  return get_mobile_menu_type() == 'slide_in_light_bottom' && is_mobile() && !is_responsive_enable();
}

//グローバルナビが「スライドインダーク」か
function is_slide_in_dark(){
  return is_slide_in_dark_top() ||
         is_slide_in_dark_bottom();
}

//グローバルナビを「スライドインダーク（ボタン上）」で表示するかどうか
function is_slide_in_dark_top(){
  return get_mobile_menu_type() == 'slide_in_dark_top' && is_mobile() && !is_responsive_enable();
}

//グローバルナビを「スライドインダーク（ボタン下）」で表示するかどうか
function is_slide_in_dark_bottom(){
  return get_mobile_menu_type() == 'slide_in_dark_bottom' && is_mobile() && !is_responsive_enable();
}

//グローバルナビが「スライドイン（ボタン上）」か
function is_slide_in_top_buttons(){
  return is_slide_in_light_top() ||
         is_slide_in_dark_top();
}

//グローバルナビが「スライドイン（ボタン下）」か
function is_slide_in_bottom_buttons(){
  return is_slide_in_light_bottom() ||
         is_slide_in_dark_bottom();
}

//スライドインメニューを日本語表示にするか
function is_mobile_menu_japanese(){
  return get_theme_mod( 'mobile_menu_japanese', true );
}

//グローバルナビを横幅いっぱいにするかどうか
function is_navi_wide(){
  return get_theme_mod( 'layout_option_navi_wide', false );
}

//[前ページ] [次ページ] ナビを表示するか
function is_post_navi_visible(){
  return get_theme_mod( 'post_navi_visible', true );
}

//[前ページ] [次ページ] ナビタイプの取得
function get_post_navi_type(){
  return get_theme_mod( 'post_navi_type', 'default' );
}

//[前ページ] [次ページ] ナビタイプはデフォルトか
function is_post_navi_type_default(){
  return get_post_navi_type() == 'default';
}

//[前ページ] [次ページ] ナビタイプはサムネイルか
function is_post_navi_type_thumbnail(){
  return get_post_navi_type() == 'thumbnail';
}

//固定ページにパンくずリストを表示するかどうか
function is_page_breadcrumb_visible(){
  return get_theme_mod( 'page_breadcrumb_visible', true );
}

//一覧リストのスタイル取得
function get_list_style(){
  return get_theme_mod( 'list_style', 'cards');
}

//モバイルで1ページに表示する最大投稿数
function get_posts_per_page_mobile(){
  return get_theme_mod( 'posts_per_page_mobile', 10);
}

//固定ページを一覧リストに含めるか
function is_page_include_in_list(){
  return get_theme_mod( 'page_include_in_list', false );
}

//エントリーカード全体をリンク化するか
function is_wraped_entry_card(){
  return get_theme_mod( 'wraped_entry_card', false );
}

//サムネイルを表示するかどうか
function is_thumbnail_visible(){
  return get_theme_mod( 'thumbnail_visible', true );
}

//サムネイルの角の状態を取得
function get_thumbnail_radius(){
  return get_theme_mod( 'thumbnail_radius', 'default' );
}

//サムネイルの角を10pxで丸めるか
function is_thumbnail_radius_10px(){
  return get_thumbnail_radius() == 'radius_10px';
}

//サムネイルを円形にするか
function is_thumbnail_circle(){
  return get_thumbnail_radius() == 'circle';
}

//一覧リストのスタイルがエントリーカードタイプかどうか（インデックスミドル広告を表示するか）
function is_list_style_entry_type(){
  return is_list_style_entry_cards() ||
         is_list_style_large_cards() ||
         is_list_style_large_card_just_for_first() ||
         is_list_style_body_just_for_first();
}

//一覧リストのスタイルがエントリーカード表示かどうか
function is_list_style_entry_cards(){
  return ( get_list_style() == 'cards' );
}

//一覧リストのスタイルが大きなエントリーカード表示かどうか
function is_list_style_large_cards(){
  return ( get_list_style() == 'large_cards' );
}

//一覧リストのスタイルが最初だけを大きなエントリーカード表示かどうか
function is_list_style_large_card_just_for_first(){
  return ( get_list_style() == 'large_card_just_for_first' );
}

//一覧リストのスタイルが本文表示かどうか
function is_list_style_bodies(){
  return ( get_list_style() == 'bodies' );
}

//一覧リストのスタイルが最初だけ本文表示かどうか
function is_list_style_body_just_for_first(){
  return ( get_list_style() == 'body_just_for_first' );
}

//一覧リストのスタイルが大きなサムネイル表示かどうか
function is_list_style_large_thumb_cards(){
  return ( get_list_style() == 'large_thumb' );
}

//一覧リストのスタイルがタイル表示かどうか
function is_list_style_tile_thumb_cards(){
  return ( is_list_style_tile_thumb_2columns() || is_list_style_tile_thumb_3columns() ||
           is_list_style_tile_thumb_2columns_raw() || is_list_style_tile_thumb_3columns_raw() );
}

//一覧リストのスタイルがタイル2列表示かどうか
function is_list_style_tile_thumb_2columns(){
  return ( get_list_style() == 'tile_thumb_2columns' );
}

//一覧リストのスタイルがタイル3列表示かどうか
function is_list_style_tile_thumb_3columns(){
  return ( get_list_style() == 'tile_thumb_3columns' );
}

//一覧リストのスタイルがタイル（画像縦横比保存）表示かどうか
function is_list_style_tile_thumb_cards_raw(){
  return ( is_list_style_tile_thumb_2columns_raw() || is_list_style_tile_thumb_3columns_raw() );
}

//一覧リストのスタイルがタイル2列（画像縦横比保存）表示かどうか
function is_list_style_tile_thumb_2columns_raw(){
  return ( get_list_style() == 'tile_thumb_2columns_raw' );
}

//一覧リストのスタイルがタイル3列（画像縦横比保存）表示かどうか
function is_list_style_tile_thumb_3columns_raw(){
  return ( get_list_style() == 'tile_thumb_3columns_raw' );
}


//一覧リストのスタイルがタイル2列表示かどうか
function is_list_style_tile_thumb_2columns_style(){
  return ( is_list_style_tile_thumb_2columns() || is_list_style_tile_thumb_2columns_raw() );
}

//一覧リストのスタイルがタイル3列表示かどうか
function is_list_style_tile_thumb_3columns_style(){
  return ( is_list_style_tile_thumb_3columns() || is_list_style_tile_thumb_3columns_raw() );
}

//検索ボックスのスタイル取得
function get_search_box_style(){
  return get_theme_mod( 'search_box_style', 'default_circle' );
}

//リストのページネーションスタイルはレスポンシブか
function is_list_pager_type_responsive(){
  return get_theme_mod( 'list_pager_type', 'responsive') == 'responsive';
}
//リストのページネーションスタイルは旧タイプかどうか
function is_list_pager_type_old_pager(){
  return get_theme_mod( 'list_pager_type', 'responsive') == 'old_pager';
}

//引用部分が幅を広げる
function is_blockquote_wide(){
  return get_theme_mod( 'blockquote_wide', false );
}

//サイドバーの幅を336pxにするかどうか
function is_sidebar_width_336(){
  return get_theme_mod( 'sidebar_width_336', false );
}

//サイドバーの背景を白色にするか
function is_sidebar_background_white(){
  return get_theme_mod( 'sidebar_background_white', false );
}

//サイドバーは左側にするかどうか
function is_sidebar_left(){
  return get_theme_mod( 'sidebar_left', false );
}

//フッター透過にするかどうか
function is_footer_transparent(){
  return get_theme_mod( 'footer_transparent', false );
}

//メニューボタンアイコンフォントの取得
function get_menu_button_icon_font(){
  $iconic_font = get_theme_mod( 'menu_button_icon_font', 'fa-bars' );
  return strip_tags( $iconic_font );
}

//トップへ戻るボタンを表示するか
function is_go_to_top_button_visible(){
  return get_theme_mod( 'go_to_top_button_visible', true ) && !is_mobile_menu_type_slide_in();
}

//TOPへ戻るボタンアイコンフォントの取得
function get_go_to_top_button_icon_font(){
  $iconic_font = get_theme_mod( 'go_to_top_button_icon_font', 'fa-angle-double-up' );
  return strip_tags( $iconic_font );
}

//TOPへ戻るボタン画像URLの取得
function get_go_to_top_button_image(){
  return get_theme_mod( 'go_to_top_button_image', null );
}

//カレンダーウィジェットの枠線を表示するか
function is_calendar_border_visible(){
  return get_theme_mod( 'calendar_border_visible', false );
}

//404イメージの取得
function get_404_image(){
  return get_theme_mod( '404_image', null );
}

//アイキャッチの自動設定をするか
function is_auto_post_thumbnail_enable(){
  return get_theme_mod( 'auto_post_thumbnail_enable', false );
}

//Lazy Loadを有効にするか
function is_lazy_load_enable(){
  return get_theme_mod( 'lazy_load_enable', false );
}

//Lazy Loadのエフェクトを有効にするか
function is_lazy_load_effect_enable(){
  return get_theme_mod( 'lazy_load_effect_enable', true );
}

//Lazy Loadの読み込み開始位置の取得
function get_lazy_load_threshold(){
  return get_theme_mod( 'lazy_load_threshold', 0 );
}

//画像リンク拡大効果タイプの取得
function get_lightbox_type(){
  return get_theme_mod( 'lightbox_type', 'none' );
}

//Alt属性キャプション表示タイプの取得
function get_alt_caption_type(){
  return get_theme_mod( 'alt_caption_type', 'none' );
}

//Alt属性キャプション表示タイプは「管理者のみ」か
function is_alt_caption_type_ac_admin(){
  return get_alt_caption_type() == 'ac_admin';
}

//Alt属性キャプション表示タイプは「全てのユーザー」か
function is_alt_caption_type_ac_all(){
  return get_alt_caption_type() == 'ac_all';
}

//Lightboxが有効か
function is_lightbox_enable(){
  return get_lightbox_type() == 'lightbox';
}

//lityが有効か
function is_lity_enable(){
  return get_lightbox_type() == 'lity';
}

//画像効果の取得
function get_image_effect(){
  return get_theme_mod( 'image_effect', 'none' );
}

//画像効果はボーダーか
function is_image_effect_border1px(){
  return get_image_effect() == 'border1px';
}

//画像効果はシャドウか
function is_image_effect_shadow(){
  return get_image_effect() == 'shadow';
}

//マウスホバーでAlt属性値をキャプション表示するか
function is_alt_hover_effect_enable(){
  return get_theme_mod( 'alt_hover_effect_enable', false );
}

//カスタムSEO設定の値を取得
function get_seo_options(){
  return get_option('seo_options');
}

//フロントページのタイトルのあとにキャッチフレーズを付加
function is_catch_phrase_to_frontpage_title(){
  return get_theme_mod( 'add_catch_phrase_to_frontpage_title', true );
}

//投稿・固定ページタイトルなどにサイト名を付加
function is_site_name_to_singular_title(){
  return get_theme_mod( 'add_site_name_to_singular_title', false );
}

//トップページのメタディスクリプションの取得
function get_top_page_meta_description(){
  return get_theme_mod( 'top_page_meta_description', null );
}

//トップページのメタキーワードの取得
function get_top_page_meta_keyword(){
  return get_theme_mod( 'top_page_meta_keyword', null );
}

//分割ページにrel="next"/"prev"を追加するか
function is_rel_next_prev_link_enable(){
  return get_theme_mod( 'rel_next_prev_link_enable', true );
}

//2ページ目以降のカテゴリページをnoindexとするか
function is_paged_category_page_noindex(){
  return get_theme_mod( 'paged_category_page_noindex', false );
}

//canonicalタグをを追加するか
function is_canonical_enable(){
  return get_theme_mod( 'canonical_enable', true );
}

//検索エンジンに伝える日を取得
function get_seo_date_type(){
  return get_theme_mod( 'seo_date_type', 'create' );
}


//投稿日を検索エンジンに伝えるか
function is_seo_date_type_create(){
  return get_seo_date_type() == 'create';
}

//更新日を検索エンジンに伝えるか
function is_seo_date_type_update(){
  return get_seo_date_type() == 'update';
}

//更新日のみを検索エンジンに伝えるか
function is_seo_date_type_update_only(){
  return get_seo_date_type() == 'update_only';
}

//抜粋を投稿ページのMeta Descriptionタグに挿入するか
function is_meta_description_insert(){
  return get_theme_mod('meta_description_insert', true );
}

//カテゴリを投稿ページのMetaキーワードタグに挿入するか
function is_meta_keywords_insert(){
  return get_theme_mod('meta_keywords_insert', true );
}

//カテゴリーをカテゴリページのMeta Descriptionタグに挿入するか
function is_meta_description_insert_to_category(){
  return get_theme_mod('meta_description_insert_to_category', true);
}

//カテゴリをカテゴリーページのMetaキーワードタグに挿入するか
function is_meta_keywords_insert_to_category(){
  return get_theme_mod('meta_keywords_insert_to_category', true );
}

//カスタムSNS設定の値を取得
function get_sns_options(){
  return get_option('sns_options');//外観→カスタム→SNSの設定の取得
}

//シェアメッセージの取得
function get_share_message_label(){
  return get_theme_mod('share_message_label', 'シェアする' );
}

//全シェアボタン表示がオンかどうか
function is_all_sns_share_btns_visible(){
  return get_theme_mod( 'all_sns_share_btns_visible', true );
}

//全シェアカウント表示がオンかどうか
function is_all_share_count_visible(){
  return get_theme_mod( 'all_share_count_visible', true );
}

//シェアボタンタイプの取得
function get_share_button_type(){
  return get_theme_mod( 'share_button_type', 'default');
}

//デフォルトのシェアボタンタイプか
function is_share_button_type_default(){
  return get_share_button_type() == 'default';
}

//テーマカラータイプか
function is_share_button_type_theme_color(){
  return get_share_button_type() == 'theme_color_type';
}

//Twitterタイプボタンか
function is_share_button_type_twitter(){
  return get_share_button_type() == 'twitter_type';
}

//バイラルタイプか
function is_share_button_type_viral(){
  return is_share_button_type_viral_theme_color() || is_share_button_type_viral_white();
}

//バイラルタイプか
function is_share_button_type_viral_theme_color(){
  return get_share_button_type() == 'viral_type';
}

//バイラル白タイプか
function is_share_button_type_viral_white(){
  return get_share_button_type() == 'viral_white_type';
}

//独自シェアボタンかどうか
function is_simplicity_share_button(){
  return is_share_button_type_theme_color() || is_share_button_type_twitter() || is_share_button_type_viral();
}

//モバイルのシェアボタンタイプの取得
function get_share_button_type_mobile(){
  return get_theme_mod( 'share_button_type_mobile', 'default');
}

//モバイルのシェアボタンタイプはデフォルトアイコンか
function is_share_button_type_mobile_default(){
  return get_share_button_type_mobile() == 'default';
}

//モバイルのシェアボタンタイプはデフォルトバイラルタイプか
function is_share_button_type_mobile_viral(){
  return is_share_button_type_mobile_viral_theme_color() || is_share_button_type_mobile_viral_white();
}

//モバイルのシェアボタンタイプはデフォルトバイラルタイプか
function is_share_button_type_mobile_viral_theme_color(){
  return get_share_button_type_mobile() == 'viral_type';
}

//モバイルのシェアボタンタイプはデフォルトバイラル白タイプか
function is_share_button_type_mobile_viral_white(){
  return get_share_button_type_mobile() == 'viral_white_type';
}

//Twitterボタンを表示するかどうか
function is_twitter_btn_visible(){
  return get_theme_mod( 'twitter_btn_visible', true );
}

//Facebookボタンを表示するかどうか
function is_facebook_btn_visible(){
  $facebook_btn_visible = get_theme_mod( 'facebook_btn_visible', true );
  global $g_facebook_sdk;
  $g_facebook_sdk = $facebook_btn_visible && is_share_button_type_default();
  return $facebook_btn_visible;
}

//Google＋ボタンを表示するかどうか
function is_google_plus_btn_visible(){
  return get_theme_mod( 'google_plus_btn_visible', true );
}

//はてなボタンを表示するかどうか
function is_hatena_btn_visible(){
  return get_theme_mod( 'hatena_btn_visible', true );
}

//ポケットボタンを表示するかどうか
function is_pocket_btn_visible(){
  return get_theme_mod( 'pocket_btn_visible', true );
}

//LINEボタンを表示するかどうか
function is_line_btn_visible(){
  return get_theme_mod( 'line_btn_visible', true );
}

//Evernoteボタンを表示するかどうか
function is_evernote_btn_visible(){
  return get_theme_mod( 'evernote_btn_visible', false );
}

//feedlyボタンを表示するかどうか
function is_feedly_btn_visible(){
  return get_theme_mod( 'feedly_btn_visible', false );
}

//Push7ボタンを表示するかどうか
function is_push7_btn_visible(){
  return get_theme_mod( 'push7_btn_visible', false ) && get_push7_follow_app_no();
}

//コメント数ボタンを表示するかどうか
function is_comments_btn_visible(){
  return get_theme_mod( 'comments_btn_visible', false );
}

//画像にPinterestボタンを表示するかどうか
function is_pinterest_btn_visible(){
  return get_theme_mod( 'pinterest_btn_visible', false );
}

//ツイート数を表示するか
function is_twitter_count_visible(){
  return get_theme_mod( 'twitter_count_visible', false );
}

//ツイートにユーザーIDを含めるか
function is_twitter_id_include(){
  return get_theme_mod( 'twitter_id_include', false );
}

//ツイート後にフォローを促すか
function is_twitter_related_follow_enable(){
  return get_theme_mod( 'twitter_related_follow_enable', false );
}

//全フォローボタン表示がオンかどうか
function is_all_sns_follow_btns_visible(){
  return get_theme_mod( 'all_sns_follow_btns_visible', true );
}

//ページトップのフォローボタンを表示するか
function is_top_follows_visible(){
  return get_theme_mod( 'top_follows_visible', true );
}

//本文下フォローボタンを表示するか
function is_body_bottom_follows_visible(){
  return get_theme_mod( 'body_bottom_follows_visible', true );
}

//シェアメッセージの取得
function get_follow_message_label(){
  return get_theme_mod( 'follow_message_label', 'フォローする' );
}

//TwitterフォローボタンのIDを取得
function get_twitter_follow_id(){
  return get_theme_mod( 'twitter_follow_id', null );
}

//FacebookフォローボタンのIDを取得
function get_facebook_follow_id(){
  return get_theme_mod( 'facebook_follow_id', null );
}

//Google＋フォローボタンのIDを取得
function get_google_plus_follow_id(){
  return get_theme_mod( 'google_plus_follow_id', null );
}

//はてブフォローボタンのIDを取得
function get_hatebu_follow_id(){
  return get_theme_mod( 'hatebu_follow_id', null );
}

//InstagramフォローボタンのIDを取得
function get_instagram_follow_id(){
  return get_theme_mod( 'instagram_follow_id', null );
}

//PinterestフォローボタンのIDを取得
function get_pinterest_follow_id(){
  return get_theme_mod( 'pinterest_follow_id', null );
}

//YouTubeフォローページのURLの一部を取得
function get_youtube_follow_page_id(){
  return get_theme_mod( 'youtube_follow_page_id', null );
}

//YouTubeフォローボタンのIDを取得
function get_youtube_follow_id(){
  return get_theme_mod( 'youtube_follow_id', null );
}

//YouTubeチャンネルフォローボタンのチャンネルIDを取得
function get_youtube_channel_id(){
  return get_theme_mod( 'youtube_channel_id', null );
}

//YouTubeのフォローURLを取得
function get_youtube_follow_url(){
  $url = 'https://www.youtube.com/';
  if ( get_youtube_follow_page_id() ) {
    $url = $url . get_youtube_follow_page_id();
  } else {
    $url = false;
  }
  // if ( get_youtube_channel_id() ) {
  //   $url = $url . 'channel/' . get_youtube_channel_id();
  // } elseif ( get_youtube_follow_id() ) {
  //   $url = $url . 'user/' . get_youtube_follow_id();
  // } else {
  //   $url = false;
  // }

  return $url;
}

//FlickrフォローボタンのIDを取得
function get_flickr_follow_id(){
  return get_theme_mod( 'flickr_follow_id', null );
}

//LINE@フォローボタンのIDを取得
function get_line_at_follow_id(){
  return get_theme_mod( 'line_at_follow_id', null );
}

//Push7フォローボタンのIDを取得
function get_push7_follow_app_no(){
  return get_theme_mod( 'push7_follow_app_no', null );
}

//feedlyフォローボタンを表示するかどうか
function is_feedly_follow_btn_visible(){
  return get_theme_mod( 'feedly_follow_btn_visible', true );
}

//RSSフォローボタンを表示するかどうか
function is_rss_follow_btn_visible(){
  return get_theme_mod( 'rss_follow_btn_visible', true );
}

//Twitterカードタグを挿入するか
function is_twitter_cards_enable(){
  return get_theme_mod( 'twitter_cards_enable', true );
}


//Twitterカードタイプを取得
function get_twitter_card_type(){
  $card_type = get_theme_mod( 'twitter_card_type', 'summary' );
  //photoが廃止されたため、photoが設定してある場合はsummaryにする
  //https://dev.twitter.com/cards/types/photo
  if ( $card_type == 'photo' ) {
    return 'summary';
  }
  return $card_type;
}

//FacebookOGPタグを挿入するか
function is_facebook_ogp_enable(){
  return get_theme_mod( 'facebook_ogp_enable', true );
}

//fb:adminsを取得
function get_fb_admins(){
  return get_theme_mod( 'fb_admins', null );
}

//fb:app_idを取得
function get_fb_app_id(){
  return get_theme_mod( 'fb_app_id', null );
}

//OGPやTwitterカードのホームイメージのURLを取得
function get_ogp_home_image(){
  return get_theme_mod( 'ogp_home_image', null );
}

//フォローボタンに色をつけるかどうか
function is_colored_follow_btns(){
  return get_theme_mod( 'colored_follow_btns', false );
}

//外部サイトデータを取得時にSSL検証を行うか
function is_ssl_verification_enable(){
  return get_theme_mod( 'ssl_verification_enable', true );
}

//タイトル下に小さなシェアボタンを表示するかどうか
function is_top_share_btns_visible(){
  return get_theme_mod( 'top_share_btns_visible', false );
}

//追従シェアボタンを表示するかどうか
function is_obsequence_share_btns_visible(){
  return get_theme_mod( 'obsequence_share_btns_visible', false );
}

//本文下のシェアボタンを表示するかどうか
function is_bottom_share_btns_visible(){
  return get_theme_mod( 'bottom_share_btns_visible', true );
}

// //カスタム広告設定の値を取得
// function get_ads_options(){
//   return get_option('ads_options');
// }

//広告表示がオンかどうか
if ( !function_exists( 'is_ads_visible' ) ):
function is_ads_visible(){
  $article_ids = get_exclude_article_ids();
  $category_ids =get_exclude_category_ids();

  //広告の除外（いずれかがあてはまれば表示しない）
  $is_exclude_ids = (
    //記事の除外
    is_single( $article_ids ) || //投稿ページの除外
    is_page( $article_ids ) ||   //個別ページの除外
    //カテゴリの除外
    (is_single() && in_category( $category_ids ) ) ||//投稿ページの除外
    is_category( $category_ids ) //アーカイブページの除外
  );
//  var_dump('広告非表示か');
//  var_dump($is_exclude_ids);
  global $wp_query;
  //var_dump($wp_query->found_posts);
  return get_theme_mod( 'ads_visible', true) &&
    !$is_exclude_ids && //除外ページでない場合広告を表示（カスタマイザー設定）
    !is_ads_removed_in_page() && //ページで除外していない場合
    !is_attachment() && //添付ページではない場合
    !(is_search() && ($wp_query->found_posts == 0)); //検索結果ページで一件もヒットしなかった場合
}
endif;

//ダブルレクタングルが縦型か
function is_ads_vatical_rectangle(){
  return get_theme_mod( 'ads_vatical_rectangle', false );
}

//パフォーマンス追求広告を表示するかどうか
function is_ads_performance_visible(){
  return get_theme_mod( 'ads_performance_visible', false );
}

//PCトップをカスタムサイズ広告にするか
function is_ads_custum_ad_space(){
  return get_theme_mod( 'custum_ad_space', false );
}

//広告を表示しない記事ID配列の取得
function get_exclude_article_ids(){
  $ids = get_theme_mod( 'exclude_article_ids', null );
  return explode(',', $ids);
}

//広告を表示しないカテゴリID配列の取得
function get_exclude_category_ids(){
  $ids = get_theme_mod( 'exclude_category_ids', null );
  return explode(',', $ids);
}

//広告位置の取得
function get_ads_position(){
  return get_theme_mod( 'ads_position', 'under_relations' );
}

//広告を本文中に掲載するか
function is_ads_in_content(){
  return get_ads_position() == 'in_content';
}

//広告をコンテンツトップに掲載するか
function is_ads_content_top(){
  return get_ads_position() == 'content_top' && is_ads_performance_visible();
}

//広告をサイドバートップに掲載するか
function is_ads_sidebar_top(){
  return get_ads_position() == 'sidebar_top';
}

//関連記事下に掲載するか
function is_ads_under_relations(){
  return get_ads_position() == 'under_relations';
}

//広告ラベルの取得（文字が入力されていない場合は偽を返す）
function get_ads_label(){
  return get_theme_mod( 'ads_label', 'スポンサーリンク' );
}

//広告をサイドバートップに掲載するか
function is_ads_top_page_visible(){
  return get_theme_mod( 'ads_top_page_visible', true );
}

//広告を中央表示
function is_ads_center(){
  return get_theme_mod( 'ads_center', false );
}

//内部ブログカードを有効にするか
function is_blog_card_enable(){
  return get_theme_mod( 'blog_card_enable', true );
}

//内部ブログカードのブログカードのサムネイルを右側にするか
function is_blog_card_thumbnail_right(){
  return get_theme_mod( 'blog_card_thumbnail_right', false );
}

//内部ブログカードのブログカードリンクを新しいタブで開くか
function is_blog_card_target_blank(){
  return get_theme_mod( 'blog_card_target_blank', false );
}

//内部ブログカードのサイトロゴを表示するか
function is_blog_card_site_logo_visible(){
  return get_theme_mod( 'blog_card_site_logo_visible', true );
}

//内部ブログカードのサイトロゴリンクを有効にするか
function is_blog_card_site_logo_link_enable(){
  return get_theme_mod( 'blog_card_site_logo_link_enable', false );
}

//内部ブログカードのはてブ数を表示するか
function is_blog_card_hatena_visible(){
  return get_theme_mod( 'blog_card_hatena_visible', true );
}

//内部ブログカードの日付を表示するか
function is_blog_card_date_visible(){
  return get_theme_mod( 'blog_card_date_visible', false );
}

//内部ブログカードのカラム幅いっぱいにするか
function is_blog_card_width_auto(){
  return get_theme_mod( 'blog_card_width_auto', false );
}

//外部リンクをブログカードにするか
function is_blog_card_external_enable(){
  return get_theme_mod( 'blog_card_external_enable', false );
}

//外部リンクのブログカードタイプの取得
function get_blog_card_external_type(){
  return get_theme_mod( 'blog_card_external_type', 'default' );
}

//外部リンクのブログカードタイプはSimplicity独自ブログカードか
function is_blog_card_external_default(){
  return get_blog_card_external_type() == 'default';
}

//外部リンクのブログカードタイプははてなか
function is_blog_card_external_hatena(){
  return get_blog_card_external_type() == 'hatena';
}

//外部リンクをブログカードタイプはEmbedlyか
function is_blog_card_external_embedly(){
  return get_blog_card_external_type() == 'embedly';
}

//外部ブログカードのサムネイルを右側にするか
function is_blog_card_external_thumbnail_right(){
  return get_theme_mod( 'blog_card_external_thumbnail_right', false );
}

//外部ブログカードのリンクを新しいタブで開くか
function is_blog_card_external_target_blank(){
  return get_theme_mod( 'blog_card_external_target_blank', false );
}

//外部ブログカードのサイトロゴを表示するか
function is_blog_card_external_site_logo_visible(){
  return get_theme_mod( 'blog_card_external_site_logo_visible', true );
}

//内部ブログカードのサイトロゴリンクを有効にするか
function is_blog_card_external_site_logo_link_enable(){
  return get_theme_mod( 'blog_card_external_site_logo_link_enable', false );
}

//外部ブログカードのはてブ数を表示するか
function is_blog_card_external_hatena_visible(){
  return get_theme_mod( 'blog_card_external_hatena_visible', true );
}

//外部ブログカードのカラム幅いっぱいにするか
function is_blog_card_external_width_auto(){
  return get_theme_mod( 'blog_card_external_width_auto', false );
}


//外部ブログカードのキャッシュ保存期間を取得
function get_blog_card_external_cache_days(){
  return get_theme_mod( 'blog_card_external_cache_days', 90 );
}

//外部ブログカードキャッシュ更新モードか
function is_blog_card_external_cache_refresh_mode(){
  return get_theme_mod( 'blog_card_external_cache_refresh_mode', false );
}

//パンくずリストのホームを取得
function get_theme_text_breadcrumbs_home(){
  return get_theme_mod( 'theme_text_breadcrumbs_home', 'ホーム' );
}

//関連記事タイトルの取得
function get_theme_text_related_entry(){
  return get_theme_mod( 'theme_text_related_entry', '関連記事' );
}

//コードをハイライト表示するか
function is_code_highlight_enable(){
  return get_theme_mod( 'code_highlight_enable', false );
}

//ソースコードハイライトのスタイル
function get_code_highlight_style(){
  return get_theme_mod( 'code_highlight_style', 'default' );
}

//ソースコードをハイライトするCSSセレクタの指定
function get_code_highlight_css_selector(){
  return get_theme_mod( 'code_highlight_css_selector', '.entry-content pre' );
}

//コメントを表示するか
function is_comments_visible(){
  return get_theme_mod( 'comments_visible', true );
}

//コメント表示タイプの取得
function get_comment_display_type(){
  return get_theme_mod( 'comment_display_type', 'default' );
}

//コメントタイプがデフォルトか
function is_comment_type_default(){
  return get_comment_display_type() == 'default';
}

//コメントタイプが2chタイプか
function is_comment_type_thread(){
  return get_comment_display_type() == 'thread';
}

//コメントタイプがシンプルスレッド表示タイプか
function is_comment_type_thread_simple(){
  return get_comment_display_type() == 'thread_simple';
}

//インデックスリストにコメント数を表示するか
function is_list_comment_count_visible(){
  return get_theme_mod( 'list_comment_count_visible', false );
}

//コメント欄を伸縮するか
function is_comment_textarea_expand(){
  return get_theme_mod( 'comment_textarea_expand', false );
}

//コメントタイトルの取得
function get_theme_text_comments(){
  return get_theme_mod( 'theme_text_comments', 'コメント' );
}

//返信コメントタイトルの取得
function get_theme_text_comment_reply_title(){
  return get_theme_mod( 'theme_text_comment_reply_title', 'コメントをどうぞ' );
}

//コメントサブミットラベルの取得
function get_theme_text_comment_submit_label(){
  return get_theme_mod( 'theme_text_comment_submit_label', 'コメントを送信' );
}

//匿名ユーザー名の取得
function get_theme_text_comment_anonymous_name(){
  $name = get_theme_mod( 'theme_text_comment_anonymous_name', '匿名' );
  return ( $name ? $name : '匿名' );
}

//コメント凍結メッセージの取得
function get_theme_text_comment_freeze_label(){
  $msg = get_theme_mod( 'theme_text_comment_freeze_label', 'コメントの入力は終了しました。' );
  $cmsg = get_comment_form_freeze_message();
  if ( $cmsg ) {
    $msg = $cmsg;
  }
  return $msg;
}

//記事を読むテキストの取得
function get_theme_text_read_entry(){
  return get_theme_mod( 'theme_text_read_entry', '記事を読む' );
}

//続きを読むテキストの取得
function get_theme_text_read_more(){
  return get_theme_mod( 'theme_text_read_more', '続きを読む' );
}

//リストタイトルの「一覧」部分のテキストを取得
function get_theme_text_list(){
  return get_theme_mod( 'theme_text_list', '一覧' );
}

//日付表示のフォーマットを取得
function get_theme_text_date_format(){
  return get_theme_mod( 'theme_text_date_format', 'Y/n/j' );
}

//年月日のフォーマットを取得
function get_theme_text_ymd_format(){
  return get_theme_mod( 'theme_text_ymd_format', 'Y年m月d日' );
}

//年月のフォーマットを取得
function get_theme_text_ym_format(){
  return get_theme_mod( 'theme_text_ym_format', 'Y年m月' );
}

//年のフォーマットを取得
function get_theme_text_y_format(){
  return get_theme_mod( 'theme_text_y_format', 'Y年' );
}

//検索ボックスのプレースホルダテキストを取得
function get_theme_text_search_placeholder(){
  return get_theme_mod( 'theme_text_search_placeholder', 'ブログ内を検索' );
}

//記事が見つからなかったページのタイトルテキストを取得
function get_theme_text_not_found_title(){
  return get_theme_mod( 'theme_text_not_found_title', 'ページが見つかりませんでした' );
}

//記事が見つからなかった時のメッセージテキストを取得
function get_theme_text_not_found_message(){
  return get_theme_mod( 'theme_text_not_found_message', '記事は見つかりませんでした。' );
}

//ビジュアルエディターにSimplicityスタイルを適用するか
function is_admin_editor_enable(){
  return get_theme_mod( 'admin_editor_enable', true );
}

//アドミンバーに独自メニューを表示するか
function is_admin_bar_menu_visible(){
  return get_theme_mod( 'admin_bar_menu_visible', true );
}

//ログイン画面でカスタマイズで設定したロゴを表示するか
function is_original_login_logo_enable(){
  return get_theme_mod( 'admin_original_login_logo_enable', true );
}

//  メディアを挿入の初期表示を「この投稿へのアップロード」にするか
function is_initial_media_disp_type_in_entry(){
  return get_theme_mod( 'admin_initial_media_disp_type_in_entry', false );
}

//記事を公開前に確認するか
function is_confirmation_before_publish(){
  return get_theme_mod( 'confirmation_before_publish', false );
}

//管理者にPV表示
function is_admin_pv_visible(){
  return get_theme_mod( 'admin_pv_visible', false );
}

//テーマでファビコンを設定するかどうか
function is_favicon_enable(){
  return get_theme_mod( 'favicon_enable', false );
}

//カスタムアクセス解析設定の値を取得
function get_ana_options(){
  return get_option('ana_options');
}

//トラッキングIDの取得
function get_tracking_id(){
  return get_theme_mod( 'tracking_id', null );
}

//Google Analyticsトラッキングタイプの取得
function get_analytics_tracking_type(){
  return get_theme_mod( 'analytics_tracking_type', 'ga' );
}

//Analyticsトラッキングタイプがga.jsか
function is_analytics_tracking_type_ga(){
  return get_analytics_tracking_type() == 'ga';
}

//Analyticsトラッキングタイプがdc.jsか
function is_analytics_tracking_type_dc(){
  return get_analytics_tracking_type() == 'dc';
}

//Analyticsトラッキングタイプがanalytics.jsか
function is_analytics_tracking_type_analytics(){
  return get_analytics_tracking_type() == 'analytics';
}

//Analyticsトラッキングタイプがanalytics.jsか
function is_analytics_tracking_type_analytics_with_displayfeatures(){
  return get_analytics_tracking_type() == 'analytics_displayfeatures';
}

//ユーザー属性とインタレストカテゴリに関するレポートに対応しているか
function is_analytics_interest(){
  return is_analytics_tracking_type_dc();
  //return get_theme_mod( 'analytics_interest', true );
}

//ユニバーサルアナリティクスか
function is_analytics_universal(){
  return is_analytics_tracking_type_analytics() || is_analytics_tracking_type_analytics_with_displayfeatures();
}

//PtengineトラッキングIDの取得
function get_ptengin_tracking_id(){
  return get_theme_mod( 'ptengin_tracking_id', null );
}

//トラッキングIDの取得
function get_webmaster_tool_id(){
  return get_theme_mod( 'webmaster_tool_id', null );
}

//ファビコンのURLを取得
function get_favicon_url(){
  $o = get_option('other_options');//旧バージョンのファビコン設定
  $favicon_url = get_theme_mod( 'favicon_url', null );
  return $favicon_url ? $favicon_url : $o['favicon_url'];
}

//ファビコンのURLを取得
function get_the_favicon_url(){
  if (is_favicon_enable()) {
    if ( get_favicon_url() ) {
      return get_favicon_url();
    } else {
      return get_stylesheet_directory_uri().'/images/favicon.ico';
    }
  }
}

//テーマでアップルタッチアイコンを設定するかどうか
function is_apple_touch_icon_enable(){
  return get_theme_mod( 'apple_touch_icon_enable', false );
}

//アップルタッチアイコンのURLを取得
function get_apple_touch_icon_url(){
  $o = get_option('other_options');//旧バージョンのアップルタッチアイコン設定
  $apple_touch_icon_url = get_theme_mod( 'apple_touch_icon_url', null );
  return $apple_touch_icon_url ? $apple_touch_icon_url : $o['apple_touch_icon_url'];
}

//自動アップデート機能を有効にするか
function is_auto_update_enable(){
  return get_theme_mod( 'auto_update_enable', true );
}

//カスタマイザーの外部CSS読み込みを有効にするか
function is_external_custom_css_enable(){
  return get_theme_mod( 'external_custom_css_enable', false );
}

//「WLWで編集」を出すかどうか
function is_wlw_link_visible(){
  return get_theme_mod( 'wlw_link_visible', false );
}

//テーマカスタマイザー項目の説明を表示するか
function is_tips_visible(){
  return get_theme_mod( 'tips_visible', true );
}

//Simplicity新着・人気エントリーウイジェットにWordpress Popular Postsを使うかどうか
function is_wpp_enable(){
  // $o = get_option('other_options');
  // return $o['wpp'] && function_exists('wpp_get_mostpopular');
  return function_exists('wpp_get_mostpopular');
}

//日本語のスラッグを有効にするかどうか
function is_japanese_slug_enable(){
  return get_theme_mod( 'japanese_slug_enable', false );
}
//最初の投稿の年を取得
function get_first_post_year(){
  $year = null;
  //記事を古い順に1件だけ取得
  query_posts('posts_per_page=1&order=ASC');
  if ( have_posts() ) : while ( have_posts() ) : the_post();
    $year = intval(get_the_time('Y'));//最初の投稿の年を取得
  endwhile; endif;
  wp_reset_query();
  return $year;
}

//Copyright表示
function get_copylight_credit($should_show_date = true){
  //サイト名のみ
  $site_tag = get_bloginfo('name');
  //
  $year = '';
  if ( $should_show_date ) {
    $year = get_first_post_year();
  }
  //サイト名とリンク
  $site_tag = ' <a href="'.home_url().'">'.get_bloginfo('name').'</a>';
  return '&copy; '.$year.' '.$site_tag;
}
//ライセンス表記の取得
function get_site_license(){
  $site_license = get_theme_mod( 'site_license', 'copyright' );
  $site_link = ' <a href="'.home_url().'">'.get_bloginfo('name').'</a>';
  $cc_desc = ' Some Rights Reserved.';
  switch ( $site_license ) {
    case "cc_by":
      return '<a href="http://creativecommons.org/licenses/by/2.1/jp/" rel="nofollow license">CC BY</a>'.$site_link.$cc_desc;
      break;
    case "cc_by_sa":
      return '<a href="http://creativecommons.org/licenses/by-sa/2.1/jp/" rel="nofollow license">CC BY-SA</a>'.$site_link.$cc_desc;
      break;
    case "cc_by_nd":
      return '<a href="http://creativecommons.org/licenses/by-nd/2.1/jp/" rel="nofollow license">CC BY-ND</a>'.$site_link.$cc_desc;
      break;
    case "cc_by_nc":
      return '<a href="http://creativecommons.org/licenses/by-nc/2.1/jp/" rel="nofollow license">CC BY-NC</a>'.$site_link.$cc_desc;
      break;
    case "cc_by_nc_sa":
      return '<a href="http://creativecommons.org/licenses/by-nc-sa/2.1/jp/" rel="nofollow license">CC BY-NC-SA</a>'.$site_link.$cc_desc;
      break;
    case "cc_by_nc_nd":
      return '<a href="http://creativecommons.org/licenses/by-nc-nd/2.1/jp/" rel="nofollow license">CC BY-NC-ND</a>'.$site_link.$cc_desc;
      break;
    case "cc0":
      return '<a href="http://creativecommons.org/publicdomain/zero/1.0/" rel="nofollow license">CC0</a>'.$site_link.' No Rights Reserved.';
      break;
    case "pd":
      return '<a href="http://creativecommons.org/publicdomain/zero/1.0/" rel="nofollow license">Public Domain</a>'.$site_link.' No Rights Reserved.';
      break;
    case "copyright_abridged":
      return get_copylight_credit(false);//(c)表記の短縮形（簡易版）
      break;
    case "copyright_backward":
      return 'Copyright&copy; '.$site_link.' All Rights Reserved.';
      break;
    default:
      return get_copylight_credit(true);//(c)表記の短縮形（日付付）
  }
}

//ローカルでレスポンシブテストのリンクを表示するか
function is_responsive_test_visible(){
  return get_theme_mod( 'responsive_test_visible', false);
}

//ローカルでレスポンシブテストのリンクを表示するか
function is_page_cache_enable(){
  return get_theme_mod( 'page_cache_enable', false);
}

//Windows Live Writerで編集するためのリンクを作成する
function wlw_edit_post_link($link, $before, $after){
  if (is_wlw_link_visible()) {
    if ( is_user_logged_in() ):
      $query = ( is_single() ? 'postid' : 'pageid' );
      echo $before.'<a href="wlw://'.get_this_site_domain().'/?'.$query.'=';
      echo the_ID();
      echo '">'.$link.'</a>'.$after;
    endif;
  }
}

//カテゴリーメタディスクリプション用の説明文を取得
function get_meta_description_from_category(){
  $cate_desc = trim( strip_tags( category_description() ) );
  if ( $cate_desc ) {//カテゴリ設定に説明がある場合はそれを返す
    return htmlspecialchars($cate_desc);
  }
  $cate_desc = '「' . single_cat_title('', false) . '」の記事一覧です。';
  return htmlspecialchars($cate_desc);
}

//カテゴリメタキーワード用のキーワードを取得
function get_meta_keyword_from_category(){
  return single_cat_title('', false) . ',ブログ,記事一覧';
}


//タグメタディスクリプション用の説明文を取得
function get_meta_description_from_tag(){
  $tag_desc = trim( strip_tags( tag_description() ) );
  if ( $tag_desc ) {//タグ設定に説明がある場合はそれを返す
    return htmlspecialchars($tag_desc);
  }
  $tag_desc = '「' . single_tag_title('', false) . '」の記事一覧です。';
  return htmlspecialchars($tag_desc);
}

//タグメタキーワード用のキーワードを取得
function get_meta_keyword_from_tag(){
  return single_tag_title('', false) . ',ブログ,記事一覧';
}









