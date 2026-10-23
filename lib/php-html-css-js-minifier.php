<?php


/**
 * ----------------------------------------------------------------------------------------
 * Based on `https://github.com/mecha-cms/mecha-cms/blob/master/engine/plug/converter.php`
 * ----------------------------------------------------------------------------------------
 */


// Helper function(s) ...

//他のプラグインの定数と区別し、再読込でも定数を重複定義しない。
if (!defined('SIMPLICITY_MINIFY_PLACEHOLDER')) {
    define('SIMPLICITY_MINIFY_PLACEHOLDER', "\x1A");
}

$SS = '"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'';
$CC = '\/\*[\s\S]*?\*\/';
$CH = '<\!--[\s\S]*?-->';

if ( !function_exists( '__minifyx' ) ) {
function __minifyx($input) {
    return str_replace(array("\n", "\t", ' '), array(SIMPLICITY_MINIFY_PLACEHOLDER . '\n', SIMPLICITY_MINIFY_PLACEHOLDER . '\t', SIMPLICITY_MINIFY_PLACEHOLDER . '\s'), $input);
}
}


if ( !function_exists( '__minifyv' ) ) {
function __minifyv($input) {
    return str_replace(array(SIMPLICITY_MINIFY_PLACEHOLDER . '\n', SIMPLICITY_MINIFY_PLACEHOLDER . '\t', SIMPLICITY_MINIFY_PLACEHOLDER . '\s'), array("\n", "\t", ' '), $input);
}
}



/**
 * =======================================================
 *  HTML MINIFIER
 * =======================================================
 */
if ( !function_exists( '__replace_html_style_for_minify' ) ) {
function __replace_html_style_for_minify($m) {
  return $m[1] . $m[2] . minify_css($m[3]) . $m[2];
}
}


if ( !function_exists( '__replace_html_for_minify' ) ) {
function __replace_html_for_minify($m) {
    if(isset($m[2])) {
        // Minify inline CSS declaration(s)
        if(stripos($m[2], ' style=') !== false) {
            $attributes = preg_replace_callback('#( style=)([\'"]?)(.*?)\2#i', '__replace_html_style_for_minify', $m[2]);
            //属性の圧縮に失敗した場合は、nullを後続へ渡さず元のタグを保つ。
            if ($attributes === null) return $m[0];
            $m[2] = $attributes;
        }
        $attributes = preg_replace(
            array(
                // From `defer="defer"`, `defer='defer'`, `defer="true"`, `defer='true'`, `defer=""` and `defer=''` to `defer` [^1]
                '#\s(checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped)(?:=([\'"]?)(?:true|\1)?\2)#i',
                // Remove extra white-space(s) between HTML attribute(s) [^2]
                '#\s*([^\s=]+?)(=(?:\S+|([\'"]?).*?\3)|$)#',
                // From `<img />` to `<img/>` [^3]
                '#\s+\/$#'
            ),
            array(
                // [^1]
                ' $1',
                // [^2]
                ' $1$2',
                // [^3]
                '/'
            ),
        str_replace("\n", ' ', $m[2]));
        if ($attributes === null) return $m[0];
        return '<' . $m[1] . $attributes . '>';
    }
    return '<' . $m[1] . '>';
    }
}


if ( !function_exists( '_minify_html' ) ) {
function _minify_html($input) {
    return preg_replace_callback('#<\s*([^\/\s]+)\s*(?:>|(\s[^<>]+?)\s*>)#', '__replace_html_for_minify', $input);
}
}


if ( !function_exists( 'minify_html' ) ) {
function minify_html($input) {
    if( ! $input = trim($input)) return $input;
    //正規表現の処理上限に達した場合は、HTMLを壊さず元の内容を返す。
    $original_input = $input;
    global $CH;
    // Keep important white-space(s) after self-closing HTML tag(s)
    $input = preg_replace('#(<(?:img|input)(?:\s[^<>]*?)?\s*\/?>)\s+#i', '$1' . SIMPLICITY_MINIFY_PLACEHOLDER . '\s', $input);
    if ($input === null) return $original_input;
    // Create chunk(s) of HTML tag(s), ignored HTML group(s), HTML comment(s) and text
    $input = preg_split('#(' . $CH . '|<pre(?:>|\s[^<>]*?>)[\s\S]*?<\/pre>|<code(?:>|\s[^<>]*?>)[\s\S]*?<\/code>|<script(?:>|\s[^<>]*?>)[\s\S]*?<\/script>|<style(?:>|\s[^<>]*?>)[\s\S]*?<\/style>|<textarea(?:>|\s[^<>]*?>)[\s\S]*?<\/textarea>|<[^<>]+?>)#i', $input, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
    if ($input === false) return $original_input;
    $output = "";
    foreach($input as $v) {
        if($v !== ' ' && trim($v) === "") continue;
        if($v[0] === '<' && substr($v, -1) === '>') {
            if($v[1] === '!' && strpos($v, '<!--') === 0) { // HTML comment ...
                // Remove if not detected as IE comment(s) ...
                if(substr($v, -12) !== '<![endif]-->') continue;
                $output .= $v;
            } else {
                $minified = _minify_html($v);
                if ($minified === null) return $original_input;
                $output .= __minifyx($minified);
            }
        } else {
            // Force line-break with `&#10;` or `&#xa;`
            $v = str_replace(array('&#10;', '&#xA;', '&#xa;'), SIMPLICITY_MINIFY_PLACEHOLDER . '\n', $v);
            // Force white-space with `&#32;` or `&#x20;`
            $v = str_replace(array('&#32;', '&#x20;'), SIMPLICITY_MINIFY_PLACEHOLDER . '\s', $v);
            // Replace multiple white-space(s) with a space
            $minified = preg_replace('#\s+#', ' ', $v);
            if ($minified === null) return $original_input;
            $output .= $minified;
        }
    }
    // Clean up ...
    $output = preg_replace(
        array(
            // Remove two or more white-space(s) between tag [^1]
            '#>([\n\r\t]\s*|\s{2,})<#',
            // Remove white-space(s) before tag-close [^2]
            '#\s+(<\/[^\s]+?>)#'
        ),
        array(
            // [^1]
            '><',
            // [^2]
            '$1'
        ),
    $output);
    if ($output === null) return $original_input;
    $output = __minifyv($output);
    // Remove white-space(s) after ignored tag-open and before ignored tag-close (except `<textarea>`)
    $output = preg_replace('#<(code|pre|script|style)(>|\s[^<>]*?>)\s*([\s\S]*?)\s*<\/\1>#i', '<$1$2$3</$1>', $output);
    return $output === null ? $original_input : $output;
}
}



/**
 * =======================================================
 *  CSS MINIFIER
 * =======================================================
 */
if ( !function_exists( '__replace_css_for_minify' ) ) {
function __replace_css_for_minify($m) {
    return $m[1] . preg_replace('#\s+#', SIMPLICITY_MINIFY_PLACEHOLDER . '\s', $m[2]) . ')';
}
}


if ( !function_exists( '_minify_css' ) ) {
function _minify_css($input) {
    // Keep important white-space(s) in `calc()`
    if(stripos($input, 'calc(') !== false) {
        $input = preg_replace_callback('#\b(calc\()\s*(.*?)\s*\)#i', '__replace_css_for_minify', $input);
        //失敗した正規表現のnullを次の処理へ渡さず、呼び出し元で元のCSSへ戻す。
        if ($input === null) return null;
    }
    // Minify ...
    return preg_replace(
        array(
            // Fix case for `#foo [bar="baz"]` and `#foo :first-child` [^1]
            '#(?<![,\{\}])\s+(\[|:\w)#',
            // Fix case for `[bar="baz"] .foo` and `@media (foo: bar) and (baz: qux)` [^2]
            '#\]\s+#', '#\b\s+\(#', '#\)\s+\b#',
            // Minify HEX color code ... [^3]
            '#\#([\da-f])\1([\da-f])\2([\da-f])\3\b#i',
            // Remove white-space(s) around punctuation(s) [^4]
            '#\s*([~!@*\(\)+=\{\}\[\]:;,>\/])\s*#',
            // Replace zero unit(s) with `0` [^5]
            '#\b(?:0\.)?0([a-z]+\b|%)#i',
            // Replace `0.6` with `.6` [^6]
            '#\b0+\.(\d+)#',
            // Replace `:0 0`, `:0 0 0` and `:0 0 0 0` with `:0` [^7]
            '#:(0\s+){0,3}0(?=[!,;\)\}]|$)#',
            // Replace `background(?:-position)?:(0|none)` with `background$1:0 0` [^8]
            '#\b(background(?:-position)?):(0|none)\b#i',
            // Replace `(border(?:-radius)?|outline):none` with `$1:0` [^9]
            '#\b(border(?:-radius)?|outline):none\b#i',
            // Remove empty selector(s) [^10]
            '#(^|[\{\}])(?:[^\{\}]+)\{\}#',
            // Remove the last semi-colon and replace multiple semi-colon(s) with a semi-colon [^11]
            '#;+([;\}])#',
            // Replace multiple white-space(s) with a space [^12]
            '#\s+#'
        ),
        array(
            // [^1]
            SIMPLICITY_MINIFY_PLACEHOLDER . '\s$1',
            // [^2]
            ']' . SIMPLICITY_MINIFY_PLACEHOLDER . '\s', SIMPLICITY_MINIFY_PLACEHOLDER . '\s(', ')' . SIMPLICITY_MINIFY_PLACEHOLDER . '\s',
            // [^3]
            '#$1$2$3',
            // [^4]
            '$1',
            // [^5]
            '0',
            // [^6]
            '.$1',
            // [^7]
            ':0',
            // [^8]
            '$1:0 0',
            // [^9]
            '$1:0',
            // [^10]
            '$1',
            // [^11]
            '$1',
            // [^12]
            ' '
        ),
    $input);
}
}


if ( !function_exists( 'minify_css' ) ) {
function minify_css($input) {
    if( ! $input = trim($input)) return $input;
    //正規表現の処理上限に達した場合は、CSSを壊さず元の内容を返す。
    $original_input = $input;
    global $SS, $CC;
    // Keep important white-space(s) between comment(s)
    $input = preg_replace('#(' . $CC . ')\s+(' . $CC . ')#', '$1' . SIMPLICITY_MINIFY_PLACEHOLDER . '\s$2', $input);
    if ($input === null) return $original_input;
    // Create chunk(s) of string(s), comment(s) and text
    $input = preg_split('#(' . $SS . '|' . $CC . ')#', $input, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
    if ($input === false) return $original_input;
    $output = "";
    foreach($input as $v) {
        if(trim($v) === "") continue;
        if(
            ($v[0] === '"' && substr($v, -1) === '"') ||
            ($v[0] === "'" && substr($v, -1) === "'") ||
            (strpos($v, '/*') === 0 && substr($v, -2) === '*/')
        ) {
            // Remove if not detected as important comment ...
            if($v[0] === '/' && strpos($v, '/*!') !== 0) continue;
            $output .= $v; // String or comment ...
        } else {
            $minified = _minify_css($v);
            if ($minified === null) return $original_input;
            $output .= $minified;
        }
    }
    // Remove quote(s) where possible ...
    $output = preg_replace(
        array(
            // '#(' . $CC . ')|(?<!\bcontent\:|[\s\(])([\'"])([a-z_][-\w]*?)\2#i',
            '#(' . $CC . ')|\b(url\()([\'"])([^\s]+?)\3(\))#i'
        ),
        array(
            // '$1$3',
            '$1$2$4$5'
        ),
    $output);
    if ($output === null) return $original_input;
    return __minifyv($output);
}
}



/**
 * =======================================================
 *  JAVASCRIPT MINIFIER
 * =======================================================
 */

if ( !function_exists( '_minify_js' ) ) {
function _minify_js($input) {
    return preg_replace(
        array(
            // Remove inline comment(s) [^1]
            '#\s*\/\/.*$#m',
            // Remove white-space(s) around punctuation(s) [^2]
            '#\s*([!%&*\(\)\-=+\[\]\{\}|;:,.<>?\/])\s*#',
            // Remove the last semi-colon and comma [^3]
            '#[;,]([\]\}])#',
            // Replace `true` with `!0` and `false` with `!1` [^4]
            '#\btrue\b#', '#\bfalse\b#', '#\breturn\s+#'
        ),
        array(
            // [^1]
            "",
            // [^2]
            '$1',
            // [^3]
            '$1',
            // [^4]
            '!0', '!1', 'return '
        ),
    $input);
}
}


if ( !function_exists( 'minify_js' ) ) {
function minify_js($input) {
    if( ! $input = trim($input)) return $input;
    //正規表現の処理上限に達した場合は、JavaScriptを壊さず元の内容を返す。
    $original_input = $input;
    // Create chunk(s) of string(s), comment(s), regex(es) and text
    global $SS, $CC;
    $input = preg_split('#(' . $SS . '|' . $CC . '|\/[^\n]+?\/(?=[.,;]|[gimuy]|$))#', $input, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
    if ($input === false) return $original_input;
    $output = "";
    foreach($input as $v) {
        if(trim($v) === "") continue;
        if(
            ($v[0] === '"' && substr($v, -1) === '"') ||
            ($v[0] === "'" && substr($v, -1) === "'") ||
            ($v[0] === '/' && substr($v, -1) === '/')
        ) {
            // Remove if not detected as important comment ...
            if(strpos($v, '//') === 0 || (strpos($v, '/*') === 0 && strpos($v, '/*!') !== 0 && strpos($v, '/*@cc_on') !== 0)) continue;
            $output .= $v; // String, comment or regex ...
        } else {
            $minified = _minify_js($v);
            if ($minified === null) return $original_input;
            $output .= $minified;
        }
    }
    $output = preg_replace(
        array(
            // Minify object attribute(s) except JSON attribute(s). From `{'foo':'bar'}` to `{foo:'bar'}` [^1]
            '#(' . $CC . ')|([\{,])([\'])(\d+|[a-z_]\w*)\3(?=:)#i',
            // From `foo['bar']` to `foo.bar` [^2]
            '#([\w\)\]])\[([\'"])([a-z_]\w*)\2\]#i'
        ),
        array(
            // [^1]
            '$1$2$4',
            // [^2]
            '$1.$3'
        ),
    $output);
    return $output === null ? $original_input : $output;
}
}
