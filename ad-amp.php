<?php if ( is_ads_visible() ): //広告表示がオンのとき?>
  <?php if ( generate_amp_adsense_code() ) :  ?>
     <div class="ad-space">
      <div class="ad-label"><?php echo get_ads_label() ?></div>
      <div class="ad-responsive ad-mobile adsense-300"><?php echo generate_amp_adsense_code() ;?></div>
    </div>
  <?php endif; ?>
<?php endif; ?>