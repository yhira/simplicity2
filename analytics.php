
<?php
if (!is_user_logged_in()) :
?>
<?php if ( get_tracking_id() && //トラッキングIDが設定されているとき
           !is_analytics_universal() && //ユニバーサルアナリティクス以外
           !is_analytics_tracking_type_gtag() )://gtag以外 ?>
<!-- Google Analytics -->
<script type="text/javascript">
<?php if ( is_analytics_interest() ): //インタレストカテゴリに対応しているとき?>
var gaJsHost = (("https:" == document.location.protocol) ? "https://" : "http://");
document.write(unescape("%3Cscript src='" + gaJsHost + "stats.g.doubleclick.net/dc.js' type='text/javascript'%3E%3C/script%3E"));
<?php else: //is_analytics_interest?>
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
<?php endif; //is_analytics_interest?>
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("<?php echo esc_html( get_tracking_id() ) ?>");
pageTracker._initData();
pageTracker._trackPageview();
</script>
<!-- /Google Analytics -->
<?php endif; ?>
<?php if ( get_ptengin_tracking_id() ): ?>
<!-- Ptengine -->
<script type="text/javascript">
    window._pt_lt = new Date().getTime();
    window._pt_sp_2 = [];
    _pt_sp_2.push('setAccount,<?php echo get_ptengin_tracking_id(); ?>');
    var _protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
    (function() {
        var atag = document.createElement('script'); atag.type = 'text/javascript'; atag.async = true;
        atag.src = _protocol + 'js.ptengine.jp/pta.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(atag, s);
    })();
</script>
<!-- /Ptengine -->
<?php endif ?>
<?php //以下その他の解析コードなど ?>

<?php endif; ?>