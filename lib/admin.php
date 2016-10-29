<?php //管理画面関係の関数

//メディアを挿入の初期表示を「この投稿へのアップロード」にする
function customize_initial_view_of_media_uploader() {
echo "<script type='text/javascript'>
 //<![CDATA[
jQuery(function($) {
        $('#wpcontent').ajaxSuccess(function() {
                $('select.attachment-filters [value=\"uploaded\"]').attr( 'selected', true ).parent().trigger('change');
        });
});
  //]]>
</script>";
}
if ( is_initial_media_disp_type_in_entry() ){
  add_action( 'admin_footer-post-new.php', 'customize_initial_view_of_media_uploader' );
  add_action( 'admin_footer-post.php', 'customize_initial_view_of_media_uploader' );
}


//投稿記事一覧にアイキャッチ画像を表示
function customize_admin_manage_posts_columns($columns) {
    $columns['thumbnail'] = 'アイキャッチ';
    return $columns;
}
function customize_admin_add_column($column_name, $post_id) {
    if ( 'thumbnail' == $column_name) {
        //テーマで設定されているサムネイルを利用する場合
        $thum = get_the_post_thumbnail($post_id, 'thumb100', array( 'style'=>'width:75px;height:auto;' ));
        //Wordpressで設定されているサムネイル（小）を利用する場合
        //$thum = get_the_post_thumbnail($post_id, 'small', array( 'style'=>'width:75px;height:auto;' ));
    }
    if ( isset($thum) && $thum ) {
        echo $thum;
    }
}
//アイキャッチ画像の列の幅をCSSで調整
function customize_admin_css_list() {
    echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/admin.css" />'.PHP_EOL;
    //echo '<style TYPE="text/css">.column-thumbnail{width:80px;}</style>'.PHP_EOL;
}
//カラムの挿入
add_filter( 'manage_posts_columns', 'customize_admin_manage_posts_columns' );
//サムネイルの挿入
add_action( 'manage_posts_custom_column', 'customize_admin_add_column', 10, 2 );
//投稿一覧のカラムの幅のスタイル調整
add_action('admin_print_styles', 'customize_admin_css_list', 21);


//管理ツールバーにメニュー追加
function customize_admin_bar_menu($wp_admin_bar){
  //バーにメニューを追加
  $title = sprintf(
      '<span class="ab-label">%s</span>',
      '管理メニュー'//親メニューラベル
  );
  $wp_admin_bar->add_menu(array(
      'id'    => 'dashboard_menu',
      'meta'  => array(),
      'title' => $title
  ));
  //サブメニューを追加
  $wp_admin_bar->add_menu(array(
      'parent' => 'dashboard_menu', // 親メニューID
      'id'     => 'dashboard_menu-dashboard', // 子メニューID
      'meta'   => array(),
      'title'  => 'ダッシュボード', // ラベル
      'href'   => site_url('/wp-admin/') // ページURL
  ));
  $wp_admin_bar->add_menu(array(
      'parent' => 'dashboard_menu', // 親メニューID
      'id'     => 'dashboard_menu-singles', // 子メニューID
      'meta'   => array(),
      'title'  => '投稿一覧', // ラベル
      'href'   => site_url('/wp-admin/edit.php') // ページURL
  ));
  $wp_admin_bar->add_menu(array(
      'parent' => 'dashboard_menu', // 親メニューID
      'id'     => 'dashboard_menu-pages', // 子メニューID
      'meta'   => array(),
      'title'  => '固定ページ一覧', // ラベル
      'href'   => site_url('/wp-admin/edit.php?post_type=page') // ページURL
  ));
  $wp_admin_bar->add_menu(array(
      'parent' => 'dashboard_menu', // 親メニューID
      'id'     => 'dashboard_menu-medias', // 子メニューID
      'meta'   => array(),
      'title'  => 'メディア一覧', // ラベル
      'href'   => site_url('/wp-admin/upload.php') // ページURL
  ));
  $wp_admin_bar->add_menu(array(
      'parent' => 'dashboard_menu', // 親メニューID
      'id'     => 'dashboard_menu-themes', // 子メニューID
      'meta'   => array(),
      'title'  => 'テーマ', // ラベル
      'href'   => site_url('/wp-admin/themes.php') // ページURL
  ));
  $wp_admin_bar->add_menu(array(
      'parent' => 'dashboard_menu', // 親メニューID
      'id'     => 'dashboard_menu-customize', // 子メニューID
      'meta'   => array(),
      'title'  => 'カスタマイズ', // ラベル
      'href'   => site_url('/wp-admin/customize.php?return=' . esc_url(site_url('/wp-admin/themes.php'))) // ページURL
  ));
  $wp_admin_bar->add_menu(array(
      'parent' => 'dashboard_menu', // 親メニューID
      'id'     => 'dashboard_menu-widget', // 子メニューID
      'meta'   => array(),
      'title'  => 'ウィジェット', // ラベル
      'href'   => site_url('/wp-admin/widgets.php') // ページURL
  ));
  $wp_admin_bar->add_menu(array(
      'parent' => 'dashboard_menu', // 親メニューID
      'id'     => 'dashboard_menu-nav-menus', // 子メニューID
      'meta'   => array(),
      'title'  => 'メニュー', // ラベル
      'href'   => site_url('/wp-admin/nav-menus.php') // ページURL
  ));
  $wp_admin_bar->add_menu(array(
      'parent' => 'dashboard_menu', // 親メニューID
      'id'     => 'dashboard_menu-theme-editor', // 子メニューID
      'meta'   => array(),
      'title'  => 'テーマの編集', // ラベル
      'href'   => site_url('/wp-admin/theme-editor.php') // ページURL
  ));
  $wp_admin_bar->add_menu(array(
      'parent' => 'dashboard_menu', // 親メニューID
      'id'     => 'dashboard_menu-plugins', // 子メニューID
      'meta'   => array(),
      'title'  => 'プラグイン一覧', // ラベル
      'href'   => site_url('/wp-admin/plugins.php') // ページURL
  ));
}
if ( is_admin_bar_menu_visible() ){
  add_action('admin_bar_menu', 'customize_admin_bar_menu', 9999);
}

//ログイン画面のロゴ変更
function customize_admin_login_logo() {
echo '<style type="text/css">
#login h1 a {
  background: url('.get_header_logo_url().') no-repeat;
  width: 320px;
  height: 70px;
  background-size:auto 100%;
  background-position: center bottom;
}
</style>';
}
if ( is_original_login_logo_enable() && //オリジナルロゴ設定がオンのとき
  get_header_logo_url() ){//サイトにロゴが設定されている時
  add_action('login_head', 'customize_admin_login_logo');
}

//Wordpress3.5で廃止されたリンクマネージャを表示する
add_filter('pre_option_link_manager_enabled','__return_true');

//記事公開前に確認アラートを出す
function publish_confirm_admin_print_scripts() {
    echo <<< EOM
<script type="text/javascript">
<!--
window.onload = function() {
    var id = document.getElementById('publish');
    if (id.value.indexOf("公開", 0) != -1) {
        id.onclick = publish_confirm;
    }
}
function publish_confirm() {
    if (window.confirm("記事を公開してもよろしいですか？")) {
        return true;
    } else {
        var elements = document.getElementsByTagName('span');
        for (var i = 0; i < elements.length; i++) {
            var element = elements[i];
            if (element.className.indexOf("spinner", 0) != -1) {
                element.classList.remove('spinner');
            }
        }
        document.getElementById('publish').classList.remove('button-primary-disabled');
        document.getElementById('save-post').classList.remove('button-disabled');

            return false;
    }
}
// -->
</script>
EOM;
}
if ( is_confirmation_before_publish() ) {
  // 公開する前にアラートを表示する
  add_action('admin_print_scripts', 'publish_confirm_admin_print_scripts');
}

//投稿一覧リストの上にタグフィルターを追加する
if ( !function_exists( 'add_tag_restrict_filter_on_post_list' ) ):
function add_tag_restrict_filter_on_post_list() {
    global $post_type;
    if ( is_object_in_taxonomy( $post_type, 'post_tag' ) ) {
?>
  <?php $tags = get_tags(); if ( $tags ) : ?>
  <select name="tag_name">
    <option value="" selected="selected">タグを選択</option>
    <?php foreach ( $tags as $tag ): ?>
    <option value="<?php echo $tag->name; ?>"><?php echo esc_html( $tag->name ); ?> (<?php echo $tag->count; ?>)</option>
    <?php endforeach; ?>
  </select>
  <?php endif; ?>
  <!-- <input name="tag_name" size="25" value="<?php echo esc_html( $_GET ? $_GET['tag_name'] : '' ); ?>" class="postform" /> -->
<?php
    }
}
endif;
add_action( 'restrict_manage_posts', 'add_tag_restrict_filter_on_post_list' );

//タグネームをタグスラッグに変換する
if ( !function_exists( 'convert_tag_name_to_tag_slug' ) ):
function convert_tag_name_to_tag_slug() {
  if ( ! isset( $_GET['post_type'] ) ) {
    $post_type = 'post';
  } elseif ( in_array( $_GET['post_type'], get_post_types( array( 'show_ui' => true ) ) ) ) {
    $post_type = $_GET['post_type'];
  } else {
    wp_die( __('Invalid post type') );
  }

  if ( ! is_object_in_taxonomy( $post_type, 'post_tag' ) || ! isset( $_GET['tag_name'] ) ) {
    return;
  }
  if ( is_array( $_GET['tag_name'] ) ) {
      $_GET['tag_name'] = implode( ',', $_GET['tag_name'] );
  }
  $tag_name = explode( ',', $_GET['tag_name'] );
  $tag_name = array_map( 'trim', $tag_name );
  if ( $tag_name ) {
    $tags = get_tags( 'hide_empty=0&orderby=slug' );
    $tags_arr = array();
    if ( $tags ) {
      foreach ( $tags as $tag ) {
        $tags_arr[$tag->name] = $tag->slug;
      }
    } else {
      unset( $_GET['tag_name'] );
      return;
    }
    $searh_tags = array();
    $matched_tags = array();
    foreach ( $tag_name as $t_name ) {
      if ( isset( $tags_arr[$t_name] ) ) {
        $searh_tags[] = $tags_arr[$t_name];
        $matched_tags[] = $t_name;
      }
    }
    $searh_tags = implode( ' ', $searh_tags );
    // OR 検索にしたい場合は、カンマ繋ぎにする
    //      $searh_tags = implode( ',', $searh_tags );
    if ( $searh_tags ) {
      $_GET['tag'] = $searh_tags;
      $_GET['tag_name'] = implode( ',', $matched_tags );
    } else {
      unset( $_GET['tag_name'] );
    }
  }
}
endif;
add_action( 'load-edit.php', 'convert_tag_name_to_tag_slug' );