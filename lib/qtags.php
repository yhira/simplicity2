<?php //クイックタグ関係の関数

//テキストがエディタにクイックタグボタン追加
//http://webtukuru.com/web/wordpress-quicktag/
//https://wpdocs.osdn.jp/%E3%82%AF%E3%82%A4%E3%83%83%E3%82%AF%E3%82%BF%E3%82%B0API
if ( !function_exists( 'add_quicktags_to_text_editor' ) ):
function add_quicktags_to_text_editor() {
  //スクリプトキューにquicktagsが保存されているかチェック
  if (wp_script_is('quicktags')){?>
    <script>
      QTags.addButton('qt-pre','pre','<pre>','</pre>');
      QTags.addButton('qt-ruby','<?php _e( 'ふりがな', 'simplicity2' ) ?>','<ruby>','<rt><?php _e( 'ふりがな', 'simplicity2' ) ?></rt></ruby>');
      QTags.addButton('qt-bold','<?php _e( '太字', 'simplicity2' ) ?>','<span class="bold">','</span>');
      QTags.addButton('qt-red','<?php _e( '赤字', 'simplicity2' ); ?>','<span class="red">','</span>');
      QTags.addButton('qt-bold-red','<?php _e( '太い赤字', 'simplicity2' ); ?>','<span class="bold-red">','</span>');
      QTags.addButton('qt-red-under','<?php _e( '赤アンダーライン', 'simplicity2' ); ?>','<span class="red-under">','</span>');
      QTags.addButton('qt-marker','<?php _e( '黄色マーカー', 'simplicity2' ); ?>','<span class="marker">','</span>');
      QTags.addButton('qt-marker-under','<?php _e( '黄色アンダーラインマーカー', 'simplicity2' ); ?>','<span class="marker-under">','</span>');
      QTags.addButton('qt-strike','<?php _e( '打ち消し線', 'simplicity2' ); ?>','<span class="strike">','</span>');
      QTags.addButton('qt-ref','<?php _e( 'バッジ', 'simplicity2' ); ?>','<span class="ref">','</span>');
      QTags.addButton('qt-keyboard-key','<?php _e( 'キーボード', 'simplicity2' ); ?>','<span class="keyboard-key">','</span>');
      QTags.addButton('qt-information','<?php _e( '補足情報(i)', 'simplicity2' ); ?>','<div class="information">','</div>');
      QTags.addButton('qt-question','<?php _e( '補足情報(?)', 'simplicity2' ); ?>','<div class="question">','</div>');
      QTags.addButton('qt-alert','<?php _e( '補足情報(!)', 'simplicity2' ); ?>','<div class="alert">','</div>');
      QTags.addButton('qt-sp-primary','<?php _e( 'primary', 'simplicity2' ); ?>','<div class="sp-primary">','</div>');
      QTags.addButton('qt-sp-success','<?php _e( 'success', 'simplicity2' ); ?>','<div class="sp-success">','</div>');
      QTags.addButton('qt-sp-info','info','<div class="sp-info">','</div>');
      QTags.addButton('qt-sp-warning','<?php _e( 'warning', 'simplicity2' ); ?>','<div class="sp-warning">','</div>');
      QTags.addButton('qt-sp-danger','<?php _e( 'danger', 'simplicity2' ); ?>','<div class="sp-danger">','</div>');
    </script>
  <?php
  }
}
endif;
//管理画面のウィジェットページでは表示しない
if ( is_admin() && (($pagenow != 'widgets.php') && ($pagenow != 'customize.php')) ) {
  add_action( 'admin_print_footer_scripts', 'add_quicktags_to_text_editor' );
}


//TinyMCE追加用のスタイルを初期化
//http://com4tis.net/tinymce-advanced-post-custom/
if ( !function_exists( 'initialize_tinymce_styles' ) ):
function initialize_tinymce_styles($init_array) {
  //追加するスタイルの配列を作成
  $style_formats = array(
    array(
      'title' => __( 'インライン', 'simplicity2' ),
      'items' => array(
        array(
          'title' => __( '太字', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'bold',
        ),
        array(
          'title' => __( '赤字', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'red',
        ),
        array(
          'title' => __( '太い赤字', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'bold-red'
        ),
        array(
          'title' => __( '赤アンダーライン', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'red-under'
        ),
        array(
          'title' => __( '黄色マーカー', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'marker'
        ),
        array(
          'title' => __( '黄色アンダーラインマーカー', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'marker-under'
        ),
        array(
          'title' => __( '打ち消し線', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'strike'
        ),
        array(
          'title' => __( 'キーボードキー', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'keyboard-key'
        ),
      ),
    ),
    array(
      'title' => __( 'ボックス', 'simplicity2' ),
      'items' => array(
        array(
          'title' => __( '補足情報(i)', 'simplicity2' ),
          'block' => 'div',
          'classes' => 'information'
        ),
        array(
          'title' => __( '補足情報(?)', 'simplicity2' ),
          'block' => 'div',
          'classes' => 'question'
        ),
        array(
          'title' => __( '補足情報(!)', 'simplicity2' ),
          'block' => 'div',
          'classes' => 'alert'
        ),
        array(
          'title' => __( 'primaryボックス', 'simplicity2' ),
          'block' => 'div',
          'classes' => 'sp-primary'
        ),
        array(
          'title' => __( 'successボックス', 'simplicity2' ),
          'block' => 'div',
          'classes' => 'sp-success'
        ),
        array(
          'title' => __( 'infoボックス', 'simplicity2' ),
          'block' => 'div',
          'classes' => 'sp-info'
        ),
        array(
          'title' => __( 'warningボックス', 'simplicity2' ),
          'block' => 'div',
          'classes' => 'sp-warning'
        ),
        array(
          'title' => __( 'dangerボックス', 'simplicity2' ),
          'block' => 'div',
          'classes' => 'sp-danger',
        ),
      ),
    ),
    array(
      'title' => __( 'バッジ', 'simplicity2' ),
      'items' => array(
        array(
          'title' => __( 'バッジ（オレンジ）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'ref'
        ),
        array(
          'title' => __( 'バッジ（レッド）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'ref ref-red'
        ),
        array(
          'title' => __( 'バッジ（ピンク）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'ref ref-pink'
        ),
        array(
          'title' => __( 'バッジ（パープル）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'ref ref-purple'
        ),
        array(
          'title' => __( 'バッジ（ブルー）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'ref ref-blue'
        ),
        array(
          'title' => __( 'バッジ（グリーン）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'ref ref-green'
        ),
        array(
          'title' => __( 'バッジ（イエロー）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'ref ref-yellow'
        ),
        array(
          'title' => __( 'バッジ（ブラウン）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'ref ref-brown'
        ),
        array(
          'title' => __( 'バッジ（グレー）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'ref ref-grey'
        ),
      ),
    ),
    array(
      'title' => __( 'ボタン（β版）', 'simplicity2' ),
      'items' => array(

        array(
          'title' => __( 'レッド（小）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-red'
        ),
        array(
          'title' => __( 'レッド（中）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-red btn-m'
        ),
        array(
          'title' => __( 'レッド（大）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-red btn-l'
        ),

        array(
          'title' => __( 'ピンク（小）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-pink'
        ),
        array(
          'title' => __( 'ピンク（中）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-pink btn-m'
        ),
        array(
          'title' => __( 'ピンク（大）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-pink btn-l'
        ),

        array(
          'title' => __( 'パープル（小）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-purple'
        ),
        array(
          'title' => __( 'パープル（中）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-purple btn-m'
        ),
        array(
          'title' => __( 'パープル（大）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-purple btn-l'
        ),

        array(
          'title' => __( 'ディープパープル（小）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-deep'
        ),
        array(
          'title' => __( 'ディープパープル（中）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-deep btn-m'
        ),
        array(
          'title' => __( 'ディープパープル（大）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-deep btn-l'
        ),

        array(
          'title' => __( 'インディゴ[紺色]（小）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-indigo'
        ),
        array(
          'title' => __( 'インディゴ[紺色]（中）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-indigo btn-m'
        ),
        array(
          'title' => __( 'インディゴ[紺色]（大）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-indigo btn-l'
        ),

        array(
          'title' => __( 'ブルー（小）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-blue'
        ),
        array(
          'title' => __( 'ブルー（中）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-blue btn-m'
        ),
        array(
          'title' => __( 'ブルー（大）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-blue btn-l'
        ),

        array(
          'title' => __( 'ライトブルー（小）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-light-blue'
        ),
        array(
          'title' => __( 'ライトブルー（中）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-light-blue btn-m'
        ),
        array(
          'title' => __( 'ライトブルー（大）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-light-blue btn-l'
        ),

        array(
          'title' => __( 'シアン（小）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-cyan'
        ),
        array(
          'title' => __( 'シアン（中）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-cyan btn-m'
        ),
        array(
          'title' => __( 'シアン（大）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-cyan btn-l'
        ),

        array(
          'title' => __( 'ティール[緑色がかった青]（小）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-teal'
        ),
        array(
          'title' => __( 'ティール[緑色がかった青]（中）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-teal btn-m'
        ),
        array(
          'title' => __( 'ティール[緑色がかった青]（大）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-teal btn-l'
        ),

        array(
          'title' => __( 'グリーン（小）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-green'
        ),
        array(
          'title' => __( 'グリーン（中）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-green btn-m'
        ),
        array(
          'title' => __( 'グリーン（大）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-green btn-l'
        ),

        array(
          'title' => __( 'ライトグリーン（小）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-light-green'
        ),
        array(
          'title' => __( 'ライトグリーン（中）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-light-green btn-m'
        ),
        array(
          'title' => __( 'ライトグリーン（大）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-light-green btn-l'
        ),

        array(
          'title' => __( 'ライム（小）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-lime'
        ),
        array(
          'title' => __( 'ライム（中）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-lime btn-m'
        ),
        array(
          'title' => __( 'ライム（大）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-lime btn-l'
        ),

        array(
          'title' => __( 'イエロー（小）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-yellow'
        ),
        array(
          'title' => __( 'イエロー（中）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-yellow btn-m'
        ),
        array(
          'title' => __( 'イエロー（大）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-yellow btn-l'
        ),

        array(
          'title' => __( 'アンバー[琥珀色]（小）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-amber'
        ),
        array(
          'title' => __( 'アンバー[琥珀色]（中）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-amber btn-m'
        ),
        array(
          'title' => __( 'アンバー[琥珀色]（大）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-amber btn-l'
        ),

        array(
          'title' => __( 'オレンジ（小）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-orange'
        ),
        array(
          'title' => __( 'オレンジ（中）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-orange btn-m'
        ),
        array(
          'title' => __( 'オレンジ（大）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-orange btn-l'
        ),

        array(
          'title' => __( 'ディープオレンジ（小）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-deep-orange'
        ),
        array(
          'title' => __( 'ディープオレンジ（中）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-deep-orange btn-m'
        ),
        array(
          'title' => __( 'ディープオレンジ（大）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-deep-orange btn-l'
        ),

        array(
          'title' => __( 'ブラウン（小）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-brown'
        ),
        array(
          'title' => __( 'ブラウン（中）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-brown btn-m'
        ),
        array(
          'title' => __( 'ブラウン（大）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-brown btn-l'
        ),

        array(
          'title' => __( 'グレー（小）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-grey'
        ),
        array(
          'title' => __( 'グレー（中）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-grey btn-m'
        ),
        array(
          'title' => __( 'グレー（大）', 'simplicity2' ),
          'inline' => 'span',
          'classes' => 'btn btn-grey btn-l'
        ),

      ),
    ),
  );
  //JSONに変換
  $init_array['style_formats'] = json_encode($style_formats);

  //ビジュアルエディターのフォントサイズ変更機能の文字サイズ指定
  $init_array['fontsize_formats'] = '10px 12px 14px 16px 18px 20px 24px 28px 32px 36px 42px 48px';

  return $init_array;
}
endif;
add_filter('tiny_mce_before_init', 'initialize_tinymce_styles', 10000);


// //ビジュアルエディターのフォントサイズ変更機能の文字サイズ指定
// if ( !function_exists( 'customize_tinymce_initial_settings' ) ):
// function customize_tinymce_initial_settings($settings) {
//   $settings['fontsize_formats'] = '10px 12px 14px 16px 18px 20px 24px 28px 32px 36px 42px 48px';

//   return $settings;
// }
// endif;
// add_filter( 'tiny_mce_before_init', 'customize_tinymce_initial_settings' );

//Wordpressビジュアルエディターに文字サイズの変更機能を追加
if ( !function_exists( 'add_ilc_mce_buttons_to_bar' ) ):
function add_ilc_mce_buttons_to_bar($buttons){
  array_push($buttons, 'backcolor', 'fontsizeselect', 'cleanup');
  return $buttons;
}
endif;
add_filter('mce_buttons', 'add_ilc_mce_buttons_to_bar');

//TinyMCEにスタイルセレクトボックスを追加
//https://codex.wordpress.org/Plugin_API/Filter_Reference/mce_buttons,_mce_buttons_2,_mce_buttons_3,_mce_buttons_4
if ( !function_exists( 'add_styles_to_tinymce_buttons' ) ):
function add_styles_to_tinymce_buttons($buttons) {
  //見出しなどが入っているセレクトボックスを取り出す
  $temp = array_shift($buttons);
  //先頭にスタイルセレクトボックスを追加
  array_unshift($buttons, 'styleselect');
  //先頭に見出しのセレクトボックスを追加
  array_unshift($buttons, $temp);

  return $buttons;
}
endif;
add_filter('mce_buttons','add_styles_to_tinymce_buttons');
