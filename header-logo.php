<?php //サイトのタイトル（タイトルをロゴ画像に変更するカスタマイズなど） ?>
<!-- サイトのタイトル -->
<?php if ( get_header_logo_url() )://ヘッダーロゴを画像が設定されている場合
    $logo_url = ( get_header_logo_url() ? get_header_logo_url() : get_stylesheet_directory_uri().'/images/logo.png' );//ロゴ画像の取得
    $site_title = '<a href="'.home_url('/').'"><img src="'.$logo_url.'" alt="'.get_bloginfo('name').'" class="site-title-img" /></a>';
  else://ロゴがテキストの場合（デフォルト）
    $site_title = '<a href="'.home_url('/').'">'.get_bloginfo('name').'</a>';
  endif;
?>
<?php if ( is_home() ): ?>
<h1 id="site-title" itemscope itemtype="https://schema.org/Organization">
  <?php echo $site_title ?>
</h1>
<?php else: ?>
<p id="site-title" itemscope itemtype="https://schema.org/Organization">
  <?php echo $site_title ?>
</p>
<?php endif ?>
<!-- サイトの概要 -->
<?php //サイトの概要 ?>
<?php $site_description = get_bloginfo('description'); ?>
<?php if ( is_home() ): ?>
<h2 id="site-description">
  <?php echo $site_description ?>
</h2>
<?php else: ?>
<p id="site-description">
  <?php echo $site_description ?>
</p>
<?php endif ?>