<?php if ( is_comment_type_default() ) {//デフォルトのコメント欄のとき
  get_template_part('comments-default');
} else {//某スレッド掲示板風のコメント欄のとき
  get_template_part('comments-thread');
}
 ?>