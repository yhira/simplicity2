<?php //テーマカスタマイザーのサニタイズ関数


if ( !function_exists( 'sanitize_text' ) ) {
function sanitize_text( $str ) {
  $str = trim( $str );
  return sanitize_text_field( $str );
}
}


function sanitize_cache_days( $int ) {
  if ( $int < 7 ) {
    $int = 7;
  }
  if ( $int > 365 ) {
    $int = 365;
  }
  return absint( $int );
}

if ( !function_exists( 'sanitize_html_text' ) ) {
function sanitize_html_text( $str ) {
  $str = trim(strip_tags( $str ));
  $str = htmlspecialchars($str);
  return sanitize_text_field( $str );
}
}


//ID入力用のカンマ区切りテキストから余計な文字を取り除く
if ( !function_exists( 'sanitize_id_comma_text' ) ) {
function sanitize_id_comma_text( $comma_text ) {
  $removed_comma_text = trim( sanitize_text_field( $comma_text ) );
  $removed_comma_text = preg_replace('/[^\d,]/i', '', $removed_comma_text);
  return $removed_comma_text;
}
}


if ( !function_exists( 'sanitize_textarea' ) ) {
function sanitize_textarea( $text ) {
  return esc_textarea( $text );
}
}


function sanitize_adsense_code( $text ) {
  return sanitize_text_field( htmlspecialchars($text) );
}

if ( !function_exists( 'sanitize_number' ) ) {
function sanitize_number( $int ) {
  return absint( $int );
}
}


function sanitize_check( $value ) {
  return $value;
}

if ( !function_exists( 'sanitize_file_url' ) ) {
function sanitize_file_url( $url ) {
  $output = '';
  $filetype = wp_check_filetype( $url );
  if ( $filetype["ext"] ) {
    $output = esc_url( $url );
  }
  return $output;
}
}
