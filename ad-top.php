<?php if ( is_ads_top_banner_enable() ): //パフォーマンス追求広告が有効か?>
  <div class="ad-space ad-space-top<?php echo (is_singular() ? ' ad-space-singular' : ''); ?>">
  <div class="ad-label"><?php echo get_ads_label() ?></div>
  <?php if ( is_mobile() ):?>
    <?php if ( is_active_sidebar( 'adsense-320' ) ): ?>
      <div class="ad-top-mobile adsense-320<?php echo ( is_top_share_btns_visible() && is_single() ? ' ad-over-sns-buttons' : '' ); ?>"><?php dynamic_sidebar('adsense-320');?></div>
    <?php endif; ?>
  <?php else: ?>
    <?php if ( is_active_sidebar( 'adsense-728' ) ): ?>
      <div class="ad-top-pc adsense-728<?php echo ( is_top_share_btns_visible() && is_single() ? ' ad-over-sns-buttons' : '' ); ?>"><?php dynamic_sidebar('adsense-728');?></div>
    <?php endif; ?>
  <?php endif; ?>
  </div>
<?php endif; ?>