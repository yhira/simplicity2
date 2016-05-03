<?php //管理者のみにPV表示 ?>
<?php if ( is_admin_pv_visible() &&
           is_user_logged_in() &&
           is_wpp_enable() &&
           !(is_front_page() && is_page()) ): ?>
  <div class="admin-pv">
  <?php //全体、月別、週別、日別のPV表示
    echo '<span class="all">全体:<span class="pv-count">', wpp_get_views ( get_the_ID(), 'all' ), '</span></span>';
    echo '<span class="monthly">月:<span class="pv-count">', wpp_get_views ( get_the_ID(), 'monthly' ), '</span></span>';
    echo '<span class="weekly">週:<span class="pv-count">', wpp_get_views ( get_the_ID(), 'weekly' ), '</span></span>';
    echo '<span class="daily">日:<span class="pv-count">', wpp_get_views ( get_the_ID(), 'daily' ), '</span></span>';
  ?>
  </div>
<?php endif ?>