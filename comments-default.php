<!-- comment area -->
<div id="comment-area">
	<?php
	if(have_comments()): // コメントがあったら
	?>
		<section>
			<h2 id="comments"><?php echo get_theme_text_comments(); //コメントタイトル ?></h2>

			<ol class="commets-list">
			<?php wp_list_comments('avatar_size=55'); //コメント一覧を表示 ?>
			</ol>

			<div class="comment-page-link">
					<?php paginate_comments_links(); //コメントが多い場合、ページャーを表示 ?>
			</div>
		</section>
	<?php
	endif;
	if ( is_comment_form_freeze() ) {//コメント凍結
		echo get_theme_text_comment_freeze_label();
	} else {//コメント表示
		// ここからコメントフォーム
		$args = array(
			'title_reply' => get_theme_text_comment_reply_title(),//コメントをどうぞ
			'label_submit' => get_theme_text_comment_submit_label(),//コメントを送信
		);
		echo '<aside>';
		comment_form($args);
		echo '</aside>';
	}


	?>
</div>
<!-- /comment area -->