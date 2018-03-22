<?php
///////////////////////////////////////////
// フッターモバイルボタンメニュー
///////////////////////////////////////////
if ( is_mobile_menu_type_slide_in() ): ?>
<div id="mobile-search-box">
  <?php get_template_part('searchform'); ?>
</div>
<div id="footer-mobile-buttons">
  <a id="footer-button-menu" href="#navi">
    <div class="menu-icon"><span class="fa fa-bars"></span></div>
    <div class="menu-caption menu-caption-menu"></div>
  </a>
  <a id="footer-button-home" href="<?php echo home_url() ?>">
    <div class="menu-icon"><span class="fa fa-home"></span></div>
    <div class="menu-caption menu-caption-home"></div>
  </a>
  <a id="footer-button-search" href="#">
    <div class="menu-icon"><span class="fa fa-search"></span></div>
    <div class="menu-caption menu-caption-search"></div>
  </a>
  <?php //前後の記事を取得
  $prevpost = get_adjacent_post(false, '', true); //前の記事
  $nextpost = get_adjacent_post(false, '', false); //次の記事
  if ( is_single() )://投稿ページのとき ?>
    <?php if ( $prevpost )://前の記事があるとし ?>
    <a id="footer-button-prev" href="<?php echo get_permalink($prevpost->ID); ?>" title="<?php echo get_the_title($prevpost->ID); ?>">
      <div class="menu-icon"><span class="fa fa-arrow-left"></span></div>
      <div class="menu-caption menu-caption-prev"></div>
    </a>
    <?php endif ?>
    <?php if ( $nextpost )://次の記事があるとき ?>
    <a id="footer-button-next" href="<?php echo get_permalink($nextpost->ID); ?>" title="<?php echo get_the_title($nextpost->ID); ?>">
      <div class="menu-icon"><span class="fa fa-arrow-right"></span></div>
      <div class="menu-caption menu-caption-next"></div>
    </a>
    <?php endif ?>
  <?php endif;//is_single ?>
  <a id="footer-button-go-to-top" href="#">
    <div class="menu-icon"><span class="fa fa-arrow-up"></span></div>
    <div class="menu-caption menu-caption-top"></div>
  </a>
  <a id="footer-button-sidebar" href="#sidebar">
    <div class="menu-icon"><span class="fa fa-outdent"></span></div>
    <div class="menu-caption menu-caption-sidebar"></div>
  </a>
</div>
<div class="slidein-over-ray"></div>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.sidr.min.js"></script>
<script>
///////////////////////////////////
// フッターモバイルメニューの挙動
///////////////////////////////////
(function($) {
  $(document).ready(function() {
    //ページトップへスクロール移動する
    $('#footer-button-go-to-top').click(function(){
      jQuery('body,html').animate({
              scrollTop: 0
          }, 800);
    });

    //モバイルの検索フォーム動作
    $('#footer-button-search').click(function(){
      if ($('#mobile-search-box').css('display') == 'none'){
        $('#mobile-search-box').fadeIn('normal');
        $('#footer-button-search .menu-icon span').
          removeClass('fa-search').addClass('fa-times');
      } else {
        $('#mobile-search-box').fadeOut('normal');
        $('#footer-button-search .menu-icon span').
          removeClass('fa-times').addClass('fa-search');
      }
    });

    //検索リンククリック動作をキャンセル
    $('a#footer-button-menu, a#footer-button-search, a#footer-button-go-to-top, a#footer-button-sidebar').on('click', function(e){
        e.preventDefault()
    });

    //スライドエリアを開いたときにコンテンツを暗転してぼかす
    function blur_body() {
      $('#header, #main, #footer').css({
        '-webkit-filter': 'blur(5px)',
        'filter': 'blur(5px)',
      });
      $('.slidein-over-ray').css({
        'display': 'block',
      });
    }

    //スライドエリアを閉じるときにコンテンツのエフェクトを元に戻す
    function unblur_body() {
      $('#header, #main, #footer').css({
        '-webkit-filter': 'none',
        'filter': 'none',
      });
      $('.slidein-over-ray').css({
        'display': 'none',
      });
    }

    //メニューを開いているか
    var is_menu_open = false;
    //Sidrメニュー表示
    $('#footer-button-menu, #footer-button-menu-close').sidr({
      name: 'navi',
      side: 'left',
      displace: false,
      onOpen: function(name) {
        is_menu_open = true;
        blur_body();
      },
      onClose: function(name) {
        is_menu_open = false;
        unblur_body();
      },
    });

    $('.slidein-over-ray').click(function(){
      if ( is_menu_open ) {
        $.sidr('close', 'navi')
      };
    });

    var is_sidebar_open = false;
    $('#footer-button-sidebar, #footer-button-sidebar-close').sidr({
      name: 'sidebar',
      side: 'right',
      displace: false,
      onOpen: function(name) {
        $('#footer-button-sidebar .menu-icon span').
          removeClass('fa-outdent').addClass('fa-times');
        is_sidebar_open = true;
        blur_body();
      },
      onClose: function(name) {
        $('#footer-button-sidebar .menu-icon span').
          removeClass('fa-times').addClass('fa-outdent');
        is_sidebar_open = false;
        unblur_body();
      },
    });

    $('.slidein-over-ray').click(function(){
      if ( is_sidebar_open ) {
        $.sidr('close', 'sidebar')
      };
    });

    //テキストエリアにフォーカスが入った時にメニューを隠す
    $("textarea#comment")
      .on("touchend focus", function(){
        $("#footer-mobile-buttons").addClass("comment-active");
        $("#container").addClass("comment-active");
      })
      .on("touchend blur", function(){
        $("#footer-mobile-buttons").removeClass("comment-active");
        $("#container").removeClass("comment-active");
      });


    // $('textarea#comment')
    //   .focusin(function(e) {
    //     $("#footer-mobile-buttons").addClass("comment-active");
    //     $("#container").addClass("comment-active");
    //   })
    //   .focusout(function(e) {
    //     $("#footer-mobile-buttons").removeClass("comment-active");
    //     $("#container").removeClass("comment-active");
    //   });
  });
})(jQuery);
</script>
<?php if ( !is_user_logged_in() && is_slide_in_top_buttons() ): ?>
<style>
  #container{
    margin-top: 55px;
  }
</style>
<?php endif ?>
<?php endif;//is_mobile_menu_type_slide_in ?>