<?php //テーマカスタマイザーのサニタイズ関数


if ( !function_exists( 'simplicity_sanitize_text' ) ) {
function simplicity_sanitize_text( $str ) {
  // フォームから文字列以外が届いても、型エラーや null の非推奨警告を起こしません。
  $str = is_scalar($str) ? (string)$str : '';
  $str = trim( $str );
  return sanitize_text_field( $str );
}
}


//ブログカードキャッシュ日数のサニタイズ（7〜365日に制限）
if ( !function_exists( 'simplicity_sanitize_cache_days' ) ) {
function simplicity_sanitize_cache_days( $int ) {
  // 数値以外や NaN は最小日数とし、整数変換時の警告を防ぎます。
  if (!is_numeric($int) || is_nan((float)$int)) {
    return 7;
  }
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
  // 不正な配列や未設定値は空文字として扱ってから HTML を処理します。
  $str = is_scalar($str) ? (string)$str : '';
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
  // WordPress 内の htmlspecialchars に null や配列を渡さないようにします。
  $text = is_scalar($text) ? (string)$text : '';
  return esc_textarea( $text );
}
}


//AdSenseコードのサニタイズ（HTMLエンコード＋テキストフィールドサニタイズ）
if ( !function_exists( 'simplicity_sanitize_adsense_code' ) ) {
function simplicity_sanitize_adsense_code( $text ) {
  // htmlspecialchars は null や配列を受け取れないため、文字列へ整えます。
  $text = is_scalar($text) ? (string)$text : '';
  return sanitize_text_field( htmlspecialchars($text) );
}
}

//数値のサニタイズ（非負整数に変換）
if ( !function_exists( 'simplicity_sanitize_number' ) ) {
function simplicity_sanitize_number( $int ) {
  if (!is_scalar($int) || (!is_numeric($int) && !is_bool($int))) {
    return 0;
  }
  // 整数と整数文字列は、浮動小数点数に変換せずに精度を保ちます。
  $integer = is_int($int) ? $int : (is_string($int) ? filter_var($int, FILTER_VALIDATE_INT) : false);
  if ($integer !== false) {
    return $integer < -PHP_INT_MAX ? PHP_INT_MAX : absint($integer);
  }
  $number = (float)$int;
  if (!is_finite($number)) {
    return 0;
  }
  // PHP 8.5 では範囲外の float から int への変換が警告になるため、先に上限を設けます。
  if ($number >= PHP_INT_MAX || $number <= -PHP_INT_MAX) {
    return PHP_INT_MAX;
  }
  return absint($number);
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
  // WordPress 内の拡張子検索も文字列が必要なので、未設定値は空文字にします。
  $url = is_scalar($url) ? (string)$url : '';
  $output = '';
  $filetype = wp_check_filetype( $url );
  if ( $filetype["ext"] ) {
    $output = esc_url( $url );
  }
  return $output;
}
}
