<?php if ( is_ads_sidebar_enable() ): //広告をサイドバーに掲載するか?>
  <?php if ( is_sidebar_width_336() && !is_mobile() ): ?>
    <?php if ( is_active_sidebar( 'adsense-336' ) ): ?>
    <div class="ad-space ad-space-sidebar">
        <div class="ad-label"><?php echo get_ads_label() ?></div>
        <div class="ad-sidebar adsense-336"><?php dynamic_sidebar('adsense-336');?></div>
    </div>
    <?php endif; ?>
  <?php else: ?>
    <?php if ( is_active_sidebar( 'adsense-300' ) ): ?>
    <div class="ad-space ad-space-sidebar">
        <div class="ad-label"><?php echo get_ads_label() ?></div>
        <div class="ad-sidebar adsense-300"><?php dynamic_sidebar('adsense-300');?></div>
    </div>
    <?php endif; ?>
  <?php endif; ?>
<?php endif; ?>