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
    $columns['thumbnail'] = __( 'アイキャッチ', 'simplicity2' );
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
      __( '管理メニュー', 'simplicity2' )//親メニューラベル
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
      'title'  => __( 'ダッシュボード', 'simplicity2' ), // ラベル
      'href'   => site_url('/wp-admin/') // ページURL
  ));
  $wp_admin_bar->add_menu(array(
      'parent' => 'dashboard_menu', // 親メニューID
      'id'     => 'dashboard_menu-singles', // 子メニューID
      'meta'   => array(),
      'title'  => __( '投稿一覧', 'simplicity2' ), // ラベル
      'href'   => site_url('/wp-admin/edit.php') // ページURL
  ));
  $wp_admin_bar->add_menu(array(
      'parent' => 'dashboard_menu', // 親メニューID
      'id'     => 'dashboard_menu-pages', // 子メニューID
      'meta'   => array(),
      'title'  => __( '固定ページ一覧', 'simplicity2' ), // ラベル
      'href'   => site_url('/wp-admin/edit.php?post_type=page') // ページURL
  ));
  $wp_admin_bar->add_menu(array(
      'parent' => 'dashboard_menu', // 親メニューID
      'id'     => 'dashboard_menu-medias', // 子メニューID
      'meta'   => array(),
      'title'  => __( 'メディア一覧', 'simplicity2' ), // ラベル
      'href'   => site_url('/wp-admin/upload.php') // ページURL
  ));
  $wp_admin_bar->add_menu(array(
      'parent' => 'dashboard_menu', // 親メニューID
      'id'     => 'dashboard_menu-themes', // 子メニューID
      'meta'   => array(),
      'title'  => __( 'テーマ', 'simplicity2' ), // ラベル
      'href'   => site_url('/wp-admin/themes.php') // ページURL
  ));
  $wp_admin_bar->add_menu(array(
      'parent' => 'dashboard_menu', // 親メニューID
      'id'     => 'dashboard_menu-customize', // 子メニューID
      'meta'   => array(),
      'title'  => __( 'カスタマイズ', 'simplicity2' ), // ラベル
      'href'   => site_url('/wp-admin/customize.php?return=' . esc_url(site_url('/wp-admin/themes.php'))) // ページURL
  ));
  $wp_admin_bar->add_menu(array(
      'parent' => 'dashboard_menu', // 親メニューID
      'id'     => 'dashboard_menu-widget', // 子メニューID
      'meta'   => array(),
      'title'  => __( 'ウィジェット', 'simplicity2' ), // ラベル
      'href'   => site_url('/wp-admin/widgets.php') // ページURL
  ));
  $wp_admin_bar->add_menu(array(
      'parent' => 'dashboard_menu', // 親メニューID
      'id'     => 'dashboard_menu-nav-menus', // 子メニューID
      'meta'   => array(),
      'title'  => __( 'メニュー', 'simplicity2' ), // ラベル
      'href'   => site_url('/wp-admin/nav-menus.php') // ページURL
  ));
  $wp_admin_bar->add_menu(array(
      'parent' => 'dashboard_menu', // 親メニューID
      'id'     => 'dashboard_menu-theme-editor', // 子メニューID
      'meta'   => array(),
      'title'  => __( 'テーマの編集', 'simplicity2' ), // ラベル
      'href'   => site_url('/wp-admin/theme-editor.php') // ページURL
  ));
  $wp_admin_bar->add_menu(array(
      'parent' => 'dashboard_menu', // 親メニューID
      'id'     => 'dashboard_menu-plugins', // 子メニューID
      'meta'   => array(),
      'title'  => __( 'プラグイン一覧', 'simplicity2' ), // ラベル
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
    $post_text = __( '公開', 'simplicity2' );
    $confirm_text = __( '記事を公開してもよろしいですか？', 'simplicity2' );
    echo <<< EOM
<script type="text/javascript">
<!--
window.onload = function() {
    var id = document.getElementById('publish');
    if (id.value.indexOf("$post_text", 0) != -1) {
        id.onclick = publish_confirm;
    }
}
function publish_confirm() {
    if (window.confirm("$confirm_text")) {
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

//投稿一覧リストの上にタグフィルターと管理者フィルターを追加する
if ( !function_exists( 'custmuize_restrict_manage_posts' ) ):
function custmuize_restrict_manage_posts(){
  global $post_type, $tag;
  if (($post_type == 'post') || ($post_type == 'page')) {
    if ( is_object_in_taxonomy( $post_type, 'post_tag' ) ) {
      $dropdown_options = array(
        'show_option_all' => get_taxonomy( 'post_tag' )->labels->all_items,
        'hide_empty' => 0,
        'hierarchical' => 1,
        'show_count' => 0,
        'orderby' => 'name',
        'selected' => $tag,
        'name' => 'tag',
        'taxonomy' => 'post_tag',
        'value_field' => 'slug'
      );
      wp_dropdown_categories( $dropdown_options );
    }

    wp_dropdown_users(
      array(
        'show_option_all' => 'すべてのユーザー',
        'name' => 'author'
      )
    );
  }
}
endif;
add_action('restrict_manage_posts', 'custmuize_restrict_manage_posts');

//投稿一覧で「全てのタグ」選択時は$_GET['tag']をセットしない
if ( !function_exists( 'custmuize_load_edit_php' ) ):
function custmuize_load_edit_php(){
  if (isset($_GET['tag']) && '0' === $_GET['tag']) {
    unset ($_GET['tag']);
  }
}
endif;
add_action('load-edit.php', 'custmuize_load_edit_php');

// ビジュアルエディタにHTMLを直挿入するためのボタンを追加
if ( !function_exists( 'add_insert_html_button' ) ):
function add_insert_html_button( $buttons ) {
  $buttons[] = 'button_insert_html';
  return $buttons;
}
endif;
add_filter( 'mce_buttons', 'add_insert_html_button' );

if ( !function_exists( 'add_insert_html_button_plugin' ) ):
function add_insert_html_button_plugin( $plugin_array ) {
  $plugin_array['custom_button_script'] =  get_template_directory_uri() . "/js/button-insert-html.js";
  return $plugin_array;
}
endif;
add_filter( 'mce_external_plugins', 'add_insert_html_button_plugin' );


//投稿管理画面のカテゴリー選択にフィルタリング機能を付ける
if ( !function_exists( 'add_category_filter_form' ) ):
function add_category_filter_form() {
?>
<script type="text/javascript">
jQuery(function($) {
  function zenToHan(text) {
    return text.replace(/[Ａ-Ｚａ-ｚ０-９]/g, function(s) {
          return String.fromCharCode(s.charCodeAt(0) - 65248);
      });
  }

  function catFilter( header, list ) {
    var form  = $('<form>').attr({'class':'filterform', 'action':'#'}).css({'position':'absolute', 'top':'38px'}),
        input = $('<input>').attr({'class':'filterinput', 'type':'text', 'placeholder':'<?php _e( 'カテゴリー検索', 'simplicity2' ) ?>' });
    $(form).append(input).appendTo(header);
    $(header).css({'padding-top':'42px'});
    $(input).change(function() {
      var filter = $(this).val();
      filter = zenToHan(filter).toLowerCase();
      if( filter ) {
        //ラベルテキストから検索文字の見つからなかった場合は非表示
        $(list).find('label').filter(
          function (index) {
          //console.log($(this).prop('tagName'));
          //console.log($(this).text().toLowerCase());
          //console.log(filter.toLowerCase());
            var labelText = zenToHan($(this).text()).toLowerCase();
            return labelText.indexOf(filter) == -1;
          }
        ).hide();
        //ラベルテキストから検索文字の見つかった場合は表示
        $(list).find('label').filter(
          function (index) {
            var labelText = zenToHan($(this).text()).toLowerCase();
            return labelText.indexOf(filter) != -1;
          }
        ).show();
      } else {
        $(list).find('label').show();
      }
      return false;
    })
    .keyup(function() {
      $(this).change();
    });
  }

  $(function() {
    catFilter( $('#category-all'), $('#categorychecklist') );
  });
});
</script>
<?php
}
endif;
add_action( 'admin_head-post-new.php', 'add_category_filter_form' );
add_action( 'admin_head-post.php', 'add_category_filter_form' );
