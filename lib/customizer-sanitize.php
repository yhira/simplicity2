<?php //テーマカスタマイザーのサニタイズ関数


if ( !function_exists( 'simplicity_sanitize_text' ) ) {
function simplicity_sanitize_text( $str ) {
  $str = trim( $str );
  return sanitize_text_field( $str );
}
}


//ブログカードキャッシュ日数のサニタイズ（7〜365日に制限）
if ( !function_exists( 'simplicity_sanitize_cache_days' ) ) {
function simplicity_sanitize_cache_days( $int ) {
  if ( $int < 7 ) {
    $int = 7;
  }
  if ( $int > 365 ) {
    $int = 365;
  }
  return absint( $int );
}
}

//HTMLテキストのサニタイズ（タグ除去＋HTMLエンコード）
if ( !function_exists( 'simplicity_sanitize_html_text' ) ) {
function simplicity_sanitize_html_text( $str ) {
  $str = trim(strip_tags( $str ));
  $str = htmlspecialchars($str);
  return sanitize_text_field( $str );
}
}


//ID入力用のカンマ区切りテキストから余計な文字を取り除く
if ( !function_exists( 'simplicity_sanitize_id_comma_text' ) ) {
function simplicity_sanitize_id_comma_text( $comma_text ) {
  $removed_comma_text = trim( sanitize_text_field( $comma_text ) );
  $removed_comma_text = preg_replace('/[^\d,]/i', '', $removed_comma_text);
  return $removed_comma_text;
}
}


//テキストエリアのサニタイズ
if ( !function_exists( 'simplicity_sanitize_textarea' ) ) {
function simplicity_sanitize_textarea( $text ) {
  return esc_textarea( $text );
}
}


//AdSenseコードのサニタイズ（HTMLエンコード＋テキストフィールドサニタイズ）
if ( !function_exists( 'simplicity_sanitize_adsense_code' ) ) {
function simplicity_sanitize_adsense_code( $text ) {
  return sanitize_text_field( htmlspecialchars($text) );
}
}

//数値のサニタイズ（非負整数に変換）
if ( !function_exists( 'simplicity_sanitize_number' ) ) {
function simplicity_sanitize_number( $int ) {
  return absint( $int );
}
}


//チェックボックスのサニタイズ（値をそのまま返す）
if ( !function_exists( 'simplicity_sanitize_check' ) ) {
function simplicity_sanitize_check( $value ) {
  return $value;
}
}

//ファイルURLのサニタイズ（拡張子チェック＋esc_url）
if ( !function_exists( 'simplicity_sanitize_file_url' ) ) {
function simplicity_sanitize_file_url( $url ) {
  $output = '';
  $filetype = wp_check_filetype( $url );
  if ( $filetype["ext"] ) {
    $output = esc_url( $url );
  }
  return $output;
}
}
