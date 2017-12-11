<?php
//gtagアナリティクス設定になっているとき
if( !is_user_logged_in() && get_tracking_id() && is_analytics_tracking_type_gtag() ): ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_html( get_tracking_id() ) ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '<?php echo esc_html( get_tracking_id() ) ?>');
</script>
<!-- /Global site tag (gtag.js) - Google Analytics -->
<?php endif; ?>