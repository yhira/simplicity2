<?php //投稿・固定ページのアイキャッチ
if ( has_post_thumbnail() && is_eye_catch_visible() ): // サムネイルを持っているときの処理 ?>
<figure class="eye-catch">
    <?php
        //the_post_thumbnail('large');
        //アイキャッチの表示
        the_post_thumbnail();
        //アイキャッチのキャプション機能が有効のとき
        if( is_eye_catch_caption_visible() ) {
          $thumbnail_post = get_post( get_post_thumbnail_id() );
          //削除済みの添付ファイルではnullのプロパティを参照しない
          if ( !empty($thumbnail_post->post_excerpt) ) {
            echo '<figcaption class="eye-catch-caption">' . wp_kses_post($thumbnail_post->post_excerpt) . '</figcaption>';
          }
        }
    ?>
</figure>
<?php endif; ?>
