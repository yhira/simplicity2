<!-- Navigation -->
<nav itemscope itemtype="https://schema.org/SiteNavigationElement">
  <div id="navi">
    <?php get_template_part('button-slide-menu-close');//スライドメニュー用の閉じるボタン ?>
  	<div id="navi-in">
      <?php wp_nav_menu( array ( 'theme_location' => 'header-navi' ) ); ?>
    </div><!-- /#navi-in -->
  </div><!-- /#navi -->
</nav>
<!-- /Navigation -->