<?php
////////////////////////////////
//投稿日と更新日のテンプレート
////////////////////////////////
$human_time_diff = '';
$mtime = get_mtime('c');
if (is_amp()) {
  $clock_icon_tag = '<amp-img src="'.get_template_directory_uri().'/images/clock-o.svg" width="12" height="12" class="fa fa-svg fa-fw"></amp-img>';
  $history_icon_tag = '<amp-img src="'.get_template_directory_uri().'/images/history.svg" width="12" height="12" class="fa fa-svg fa-fw"></amp-img>';
} else {
  $clock_icon_tag = '<span class="fa fa-clock-o fa-fw"></span>';
  $history_icon_tag = '<span class="fa fa-history fa-fw"></span>';
}
if ( is_human_time_diff_visible() )//時間差を表示するか
  $human_time_diff = '<span class="post-human-def-diff">（<span class="post-human-date-diff-in">'.human_time_diff( get_the_time('U'), current_time('timestamp') ).'前</span>）</span>';
if ( (is_seo_date_type_update() || is_seo_date_type_update_only()) && //検索エンジンに更新日を伝える場合
      $mtime ): //かつ更新日がある場合?>
    <?php if ( is_create_date_visible() && is_seo_date_type_update() ): //投稿日を表示する場合?>
      <span class="post-date"><?php echo $clock_icon_tag; ?><span class="entry-date date published"><?php the_time( get_theme_text_date_format() ) ;?></span><?php echo $human_time_diff; ?></span>
    <?php endif; //is_create_date_visible?>
    <?php if ( is_update_date_visible() ): //更新日を表示する場合?>
      <span class="post-update"><?php echo $history_icon_tag; ?><time class="entry-date date updated" datetime="<?php echo get_mtime('c'); ?>"><?php echo get_mtime( get_theme_text_date_format() ); ?></time></span>
    <?php endif; //is_update_date_visible?>
<?php else: //検索エンジンに投稿日を伝える場合?>
  <?php if ( is_create_date_visible() ): //投稿日を表示する場合?>
    <span class="post-date"><?php echo $clock_icon_tag; ?><time class="entry-date date published<?php echo ( $mtime && is_update_date_visible() ? '' : ' updated' ); ?>" datetime="<?php echo get_the_time('c');?>"><?php the_time( get_theme_text_date_format() ) ;?></time><?php echo $human_time_diff; ?></span>
  <?php endif; //is_create_date_visible?>
  <?php if ( is_update_date_visible() && //更新日を表示する場合
             $mtime ) : //更新日があるどき?>
    <span class="post-update"><?php echo $history_icon_tag; ?><span class="entry-date date updated"><?php echo get_mtime( get_theme_text_date_format() ); ?></span></span>
  <?php endif; //is_update_date_visible?>
<?php endif; ?>
