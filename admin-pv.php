<?php //管理者のみにPV表示 ?>
<?php if ( is_admin_pv_visible() &&
           is_user_logged_in() &&
           (is_wpp_enable() || (is_jetpack_stats_module_active() && is_singular())) &&
           !(is_front_page() && is_page()) ): ?>
  <div class="admin-pv">
  <?php //全体、月別、週別、日別のPV表示
    $views_all = 0;
    $views_monthly = 0;
    $views_weekly = 0;
    $views_daily = 0;
    if (is_wpp_enable()) {//Wordpress Popular Posts利用時
      $views_all = wpp_get_views ( get_the_ID(), 'all' );
      $views_monthly = wpp_get_views ( get_the_ID(), 'monthly' );
      $views_weekly = wpp_get_views ( get_the_ID(), 'weekly' );
      $views_daily = wpp_get_views ( get_the_ID(), 'daily' );
    } elseif (is_jetpack_stats_module_active()) {//Jetpack利用時

      $jetpack_views = stats_get_csv('postviews', array('days' => -1, 'limit' => 1, 'post_id' => $post->ID ));
      if (isset($jetpack_views[0]['views'])) {
        $views_all = $jetpack_views[0]['views'];
      }
      $jetpack_views = stats_get_csv('postviews', array('days' => 30, 'limit' => 1, 'post_id' => $post->ID ));
      if (isset($jetpack_views[0]['views'])) {
        $views_monthly = $jetpack_views[0]['views'];
      }
      $jetpack_views = stats_get_csv('postviews', array('days' => 7, 'limit' => 1, 'post_id' => $post->ID ));
      if (isset($jetpack_views[0]['views'])) {
        $views_weekly = $jetpack_views[0]['views'];
      }
      $jetpack_views = stats_get_csv('postviews', array('days' => 1, 'limit' => 1, 'post_id' => $post->ID ));
      if (isset($jetpack_views[0]['views'])) {
        $views_daily = $jetpack_views[0]['views'];
      }
    }
    echo '<span class="all">全体:<span class="pv-count">', $views_all, '</span></span>';
    echo '<span class="monthly">月:<span class="pv-count">', $views_monthly, '</span></span>';
    echo '<span class="weekly">週:<span class="pv-count">', $views_weekly, '</span></span>';
    echo '<span class="daily">日:<span class="pv-count">', $views_daily, '</span></span>';
    if (is_jetpack_stats_module_active() && !is_wpp_enable()) {
      echo '<span class="jp-page"><a href="'.admin_url().'admin.php?page=stats&view=post&post='.get_the_ID().'"title="Jetpackの統計" target="_blank"><span class="fa fa-bar-chart"></span></a></span>';
    }
  ?>
  </div>
<?php endif ?>