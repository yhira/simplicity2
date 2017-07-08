<?php //コメントに関する関数


//無記名のコメント投稿者名を変更する
if ( !function_exists( 'rename_anonymous_name' ) ):
function rename_anonymous_name($author = '') {
  //global $comment;

  if ( !$author || $author == 'Anonymous' || $author == __( '匿名', 'simplicity2' ) ) {
    $author = get_theme_text_comment_anonymous_name();//匿名ユーザー名の取得
  //} else {
    // if( empty( $comment->comment_author ) ) {
    //   if( !empty( $comment->user_id ) ) {
    //     $user = get_userdata( $comment->user_id );
    //     $author = $user->user_login;
    //   } else {
    //     $author = get_theme_text_comment_anonymous_name();//匿名ユーザー名の取得
    //   }
    // } else {
    //   $author = $comment->comment_author;
    // }
  }
  return $author;
}
endif;
add_filter( 'get_comment_author', 'rename_anonymous_name' );

//コメントリスト表示用カスタマイズコード

if ( !function_exists( 'thread_comment' ) ):
function thread_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>">
    <div class="comment-listCon">
        <div class="comment-info">
            <?php echo get_avatar( $comment, 48 );//アバター画像 ?>
            <?php printf('<span class="admin">'.__( '名前:', 'simplicity2' ).'<cite class="fn comment-author">%s</cite></span> ', get_comment_author_link()); //投稿者の設定 ?>
            <span class="comment-datetime"><?php _e( '投稿日：', 'simplicity2' ) ?><?php printf('%1$s %2$s', get_comment_date(__( 'Y/m/d(D)', 'simplicity2' )),  get_comment_time(__( 'H:i:s', 'simplicity2' ))); //投稿日の設定 ?></span>
            <span class="comment-id">
            ID：<?php //IDっぽい文字列の表示（あくまでIDっぽいものです。）
                $ip01 = get_comment_author_IP(); //書き込んだユーザーのIPアドレスを取得
                $ip02 = get_comment_date('jn'); //今日の日付
                $ip03 = ip2long($ip01); //IPアドレスの数値化
                $ip04 = ($ip02) * ($ip03); //ip02とip03を掛け合わせる
                echo mb_substr(sha1($ip04), 2, 9); //sha1でハッシュ化、頭から9文字まで出力
                //echo mb_substr(base64_encode($ip04), 2, 9); //base64でエンコード、頭から9文字まで出力
            ?>
            </span>
            <span class="comment-reply">
              <?php comment_reply_link(array_merge( $args, array(
                'depth'   =>$depth,
                'max_depth' =>$args['max_depth']))) ?>
            </span>
            <span class="comment-edit"><?php edit_comment_link(__( '編集', 'simplicity2' ),'  ',''); //編集リンク ?></span>
        </div>
        <?php if ($comment->comment_approved == '0') : ?>
            <em><?php _e( 'あなたのコメントは現在承認待ちです。', 'simplicity2' ) ?></em>
        <?php endif; ?>
        <div class="comment-text"></div>
        <?php comment_text(); //コメント本文 ?>

        <?php //返信機能は不要なので削除 ?>
    </div>
</div>
<?php
}
endif;

///////////////////////////////////////
// コメントを促す見出しタグをH3からH2に変更する
///////////////////////////////////////

if ( !function_exists( 'simplicity_comment_form_before' ) ):
function simplicity_comment_form_before() {
    ob_start();
}
endif;
add_action( 'comment_form_before', 'simplicity_comment_form_before' );

if ( !function_exists( 'simplicity_comment_form_after' ) ):
function simplicity_comment_form_after() {
  if ( !have_comments() ) {//コメントがないとき
      $html = ob_get_clean();
      $html = preg_replace(
          '/<h3 id="reply-title"(.*)>(.*)<\/h3>/',
          '<h2 id="reply-title"\1>\2</h2>',
          $html
      );
      echo $html;
  }
}
endif;
add_action( 'comment_form_after', 'simplicity_comment_form_after' );
