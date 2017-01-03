<?php //インデックスページや投稿ページで表示されるカテゴリーリンク
if ( is_category_visible() && //カテゴリを表示する場合
           get_the_category() ): //投稿ページの場合?>
<span class="category"><span class="fa fa-folder fa-fw"></span><?php the_category('<span class="category-separator">, </span>') ?></span>
<?php endif; //is_category_visible?>