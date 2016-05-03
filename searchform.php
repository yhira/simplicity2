<form method="get" id="searchform" action="<?php echo home_url('/'); ?>">
	<input type="text" placeholder="<?php echo get_theme_text_search_placeholder();//検索ボックスのプレースホルダテキストを取得 ?>" name="s" id="s">
	<input type="submit" id="searchsubmit" value="">
</form>