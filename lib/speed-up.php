<?php //高速化関連の処理


//レンダリングブロックしているJavascriptの読み込みを遅らせる
if ( !function_exists( 'move_scripts_head_to_footer' ) ):
function move_scripts_head_to_footer(){
  //ヘッダーのスクリプトを取り除く
  remove_action('wp_head', 'wp_print_scripts');
  remove_action('wp_head', 'wp_print_head_scripts', 9);
  remove_action('wp_head', 'wp_enqueue_scripts', 1);

  //フッターにスクリプトを移動する
  add_action('wp_footer', 'wp_print_scripts', 5);
  add_action('wp_footer', 'wp_print_head_scripts', 5);
  add_action('wp_footer', 'wp_enqueue_scripts', 5);
}
endif;
//add_action( 'wp_enqueue_scripts', 'move_scripts_head_to_footer' );

//スクリプトのasyncやdeferの設定
if ( !function_exists( 'defer_async_scripts' ) ):
function defer_async_scripts( $tag, $handle, $src ) {

  //var_dump($handle);
  // The handles of the enqueued scripts we want to defer
  $async_defer = array(
    //とりあえず影響が計り知れないのでコメントアウト
    // 'jquery-core',
    // 'jquery-migrate',
  );
  $async_scripts = array(
    'holder-js',
    'comment-reply',
    'lity-js',
    'lightbox-js',
  );
  $defer_scripts = array(
    'admin-bar',
    'simplicity-js',
    'simplicity-child-js',
    'jquery-lazyload-js',
    //'crayon_js',

  );
    if ( in_array( $handle, $async_defer ) ) {
        return '<script src="' . $src . '" async defer></script>' . "\n";
    }
    if ( in_array( $handle, $defer_scripts ) ) {
        return '<script src="' . $src . '" defer></script>' . "\n";
    }
    if ( in_array( $handle, $async_scripts ) ) {
        return '<script src="' . $src . '" async></script>' . "\n";
    }

    return $tag;
}
endif;
add_filter( 'script_loader_tag', 'defer_async_scripts', 10, 3 );
