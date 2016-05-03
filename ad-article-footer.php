<?php if ( is_ads_visible() ): //広告表示がオンのとき?>
  <!-- 文章下広告 -->
  <?php if ( is_responsive_enable() ): //完全レスポンスの場合?>
    <?php if (is_mobile()): //スマートフォンの場合?>
      <?php if ( is_active_sidebar( 'adsense-300' ) ) :  ?>
         <div class="ad-article-bottom ad-space">
          <div class="ad-label"><?php echo get_ads_label() ?></div>
          <div class="ad-responsive ad-mobile adsense-300"><?php dynamic_sidebar('adsense-300');?></div>
        </div>
      <?php endif; ?>
    <?php else: //パソコンの場合?>
      <?php if ( is_active_sidebar( 'adsense-336' ) ) :  ?>
        <div class="ad-article-bottom ad-space">
          <div class="ad-label"><?php echo get_ads_label() ?></div>
          <div class="ad-responsive adsense-336"><?php dynamic_sidebar('adsense-336');?></div>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  <?php else: //レスポンシブじゃない時?>
    <?php if (is_mobile()): //スマートフォンの場合?>
      <?php if ( is_active_sidebar( 'adsense-300' ) ) :  ?>
         <div class="ad-article-bottom ad-space">
          <div class="ad-label"><?php echo get_ads_label() ?></div>
          <div class="ad-mobile adsense-300"><?php dynamic_sidebar('adsense-300');?></div>
        </div>
      <?php endif; ?>
    <?php else: //パソコンの場合?>
      <?php if ( is_active_sidebar( 'adsense-336' ) ) :  ?>
         <div class="ad-article-bottom ad-space">
          <div class="ad-label"><?php echo get_ads_label() ?></div>
          <div class="ad-left ad-pc adsense-336"><?php dynamic_sidebar('adsense-336');?></div>
          <div class="ad-right ad-pc adsense-336"><?php dynamic_sidebar('adsense-336');?></div>
          <div class="clear"></div>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  <?php endif; ?>
<?php endif; ?>
