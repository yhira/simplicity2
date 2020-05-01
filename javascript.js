/////////////////////////////////
//TOPへ戻るボタン
/////////////////////////////////
(function($){
  var prevScrollTop = -1;
  var $window = $(window);
  $window.scroll(function(){
    //最上部から現在位置までの距離を取得して、変数[scrollTop]に格納
    var scrollTop = $window.scrollTop();
    var threashold = 600;
    var s1 = (prevScrollTop > threashold);
    var s2 = (scrollTop > threashold);

    // スレッショルドを跨いだ時のみ処理をする
    if (s1 ^ s2) {
      if (s2) {
        //[#page-top]をゆっくりフェードインする
        $('#page-top').fadeIn('slow');
      } else {
        //それ以外だったらフェードアウトする
        $('#page-top').fadeOut('slow');
      }
    }

    prevScrollTop = scrollTop;
  });
  //ボタン(id:move-page-top)のクリックイベント
  $('#move-page-top').click(function(){
  //ページトップへ移動する
    $('body,html').animate({
            scrollTop: 1
        }, 800);
  });
})(jQuery);

/////////////////////////////////
//スクロール追従
/////////////////////////////////
var wrapperTop;//追従エリアのトップ位置を格納（追従開始位置
var wrapperHeight;//追従エリアの高さを格納
var sidebarHeight;//サイドバーの高さを格納

//非同期ブログパーツがあっても追従開始位置がずれないように修正（無理やり）
//スマートな良い方法があれば、ご教授お願いします。
setInterval(function (){
  wrapperHeight = jQuery('#sidebar-scroll').outerHeight();
  sidebarHeight = jQuery('#sidebar').outerHeight();
  wrapperTop = sidebarHeight - wrapperHeight + 240;
}, 2000);

(function($) {
  $(document).ready(function() {
    /*
    Ads Sidewinder
    by Hamachiya2. http://d.hatena.ne.jp/Hamachiya2/20120820/adsense_sidewinder
    */
    var main = $('#main'); // メインカラムのID
    var side = $('#sidebar'); // サイドバーのID
    var wrapper = $('#sidebar-scroll'); // スクロール追従要素のID
    var side_top_margin = 60;
    if (!wrapper.size()) {return;}//スクロール追従エリアにウイジェットが入っていないときはスルー
    if (side.css('clear') == 'both') {return;}//レスポンシブでサイドバーをページ下に表示しているときはスルー

    if (main.length === 0 || side.length === 0 || wrapper.length === 0) {
      return;
    }

    var w = $(window);
    wrapperHeight = wrapper.outerHeight();
    wrapperTop = wrapper.offset().top;//とりあえずドキュメントを読み込んだ時点でスクロール追従領域の高さを取得
    var sideLeft = side.offset().left;
    //console.log(wrapperTop);

    var sideMargin = {
      top: side.css('margin-top') ? side.css('margin-top') : 0,
      right: side.css('margin-right') ? side.css('margin-right') : 0,
      bottom: side.css('margin-bottom') ? side.css('margin-bottom') : 0,
      left: side.css('margin-left') ? side.css('margin-left') : 0
    };

    var winLeft;
    var pos;

    var scrollAdjust = function() {
      var
        sideHeight = side.outerHeight(),
        mainHeight = main.outerHeight(),
        mainAbs = main.offset().top + mainHeight,
        winTop = w.scrollTop()+side_top_margin,
        winLeft = w.scrollLeft(),
        winHeight = w.height();
      var nf = (winTop > wrapperTop) && (mainHeight > sideHeight) ? true : false;
      pos = !nf ? 'static' : (winTop + wrapperHeight) > mainAbs ? 'absolute' : 'fixed';
      if (pos === 'fixed') {
        side.css({
          position: pos,
          top: '',
          bottom: winHeight - wrapperHeight,
          left: sideLeft - winLeft,
          margin: 0,
          marginBottom: '-'+side_top_margin+'px'
        });

      } else if (pos === 'absolute') {
        side.css({
          position: pos,
          top: mainAbs - sideHeight,
          bottom: '',
          left: sideLeft,
          margin: 0,
          marginBottom: '-'+side_top_margin+'px'
        });

      } else {
        side.css({
          position: pos,
          marginTop: sideMargin.top,
          marginRight: sideMargin.right,
          marginBottom: sideMargin.bottom,
          marginLeft: sideMargin.left
        });
      }
    };

    var resizeAdjust = function() {
      side.css({
        position:'static',
        marginTop: sideMargin.top,
        marginRight: sideMargin.right,
        marginBottom: sideMargin.bottom,
        marginLeft: sideMargin.left
      });
      sideLeft = side.offset().left;
      winLeft = w.scrollLeft();
      if (pos === 'fixed') {
        side.css({
          position: pos,
          left: sideLeft - winLeft,
          margin: 0,
          marginBottom: '-'+side_top_margin+'px'
        });

      } else if (pos === 'absolute') {
        side.css({
          position: pos,
          left: sideLeft,
          margin: 0,
          marginBottom: '-'+side_top_margin+'px'
        });
      }
    };
    w.on('load', scrollAdjust);
    w.on('scroll', scrollAdjust);
    w.on('resize', resizeAdjust);
  });
})(jQuery);

/////////////////////////////////
// メニューボタンの開閉
/////////////////////////////////
(function($){
  $(document).ready(function() {
    $('#mobile-menu-toggle').click(function(){
      var header_menu = $('#navi ul');
      if (header_menu.css('display') == 'none') {
        header_menu.slideDown();
      } else{
        header_menu.slideUp();
      }
    });
  });
})(jQuery);

///////////////////////////////////
// ソーシャルボタンカウントの非同期取得
///////////////////////////////////
(function($){
  $(window).scroll(function(){
    //console.log($('#sidebar').css('clear'));
    //最上部から現在位置までの距離を取得して、変数[now]に格納
    var now = $(window).scrollTop();
    var sharebar = $('#sharebar');
    if (!sharebar.size()) {return;}
    var main = $('#main');
    var sharebar_top = sharebar.offset().top;
    var sharebar_h = sharebar.outerHeight();
    var main_top = main.offset().top;
    var main_h = main.outerHeight();

    var bottom_line = main_h-400;
    if(now < (main_h-sharebar_h)){
      if (now > main_top) {
        sharebar.css({
          position: 'fixed',
          top: '70px'
        });
      } else{
        sharebar.css({
          position: 'absolute',
            top: main_top+70
        });
      }
    }else{
      sharebar.css({
        position: 'absolute',
        top: main_h-sharebar_h
      });
    }
  });
})(jQuery);

// // Twitterのシェア数を取得
// function fetch_twitter_count(url, selector) {
//   jQuery.ajax({
//     url:'//urls.api.twitter.com/1/urls/count.json',
//     dataType:'jsonp',
//     timeout: 10000, //10sec
//     data:{
//       url:url
//     }
//   }).done(function(res){
//     jQuery( selector ).text( res.count || 0 );
//   }).fail(function(){
//     jQuery( selector ).html('<span class="fa fa-exclamation"></span>');
//   });
// }

// //Twitterのシェア数を取得（自分のサーバーからPHPで取得）
// function fetch_twitter_count(url, selector) {
//   jQuery.ajax({
//     url: social_count_config.theme_url+'/lib/fetch-twitter.php?url='+url,
//     dataType:'text',
//     timeout: 10000, //10sec
//   }).done(function(res){
//     jQuery( selector ).text( res || 0 );
//   }).fail(function(){
//     jQuery( selector ).html('<span class="fa fa-exclamation"></span>');
//   });
// }

//count.jsoonからTwitterのツイート数を取得
function fetch_twitter_count_from_count_jsoon(url, selector) {
  jQuery.ajax({
    url:'//jsoon.digitiminimi.com/twitter/count.json',
    dataType:'jsonp',
    timeout: 10000, //10sec
    data:{
      url:url
  },
  success:function(res){
    jQuery( selector ).html( res.count || 0 );
  },
  error:function(){
    jQuery( selector ).html('error');
  }
  });
}


//Facebookのシェア数を取得
function fetch_facebook_count(url, selector) {
  if ( social_count_config.facebook_count_visible ) {
    jQuery( selector ).text( social_count_config.facebook_count );
  } else {
    jQuery( selector ).text( 0 );
  }
  // jQuery.ajax({
  //   url:'https://graph.facebook.com/',
  //   dataType:'jsonp',
  //   timeout: 10000, //10sec
  //   data:{
  //     id: url
  //   }
  // }).done(function(res){
  //   console.log(fb_access_token);
  //   console.log(res);
  //   if ( facebookCount ) {
  //     jQuery( selector ).text( facebookCount );
  //   } else {
  //     jQuery( selector ).text( 0 );
  //   }
  // }).fail(function(){
  //   jQuery( selector ).html('<span class="fa fa-exclamation"></span>');
  // });
}

//Google＋のシェア数を取得
function fetch_google_plus_count(url, selector) {
  jQuery.ajax({
    url: social_count_config.theme_url+'/lib/fetch-google-plus.php?url='+url,
    dataType:'text',
    timeout: 10000, //10sec
  }).done(function(res){
    jQuery( selector ).text( res || 0 );
  }).fail(function(){
    jQuery( selector ).html('<span class="fa fa-exclamation"></span>');
  });
}

//はてなブックマークではてブ数を取得
function fetch_hatebu_count(url, selector) {
  jQuery.ajax({
    url:'//b.hatena.ne.jp/entry.count?callback=?',
    //url:'//api.b.st-hatena.com/entry.count?callback=?',
    dataType:'jsonp',
    timeout: 10000, //10sec
    data:{
      url:url
    }
  }).done(function(res){
    jQuery( selector ).text( res || 0 );
  }).fail(function(){
    jQuery( selector ).html('<span class="fa fa-exclamation"></span>');
  });
}

//ポケットのストック数を取得
function fetch_pocket_count(url, selector) {
  jQuery.ajax({
    url: social_count_config.theme_url+'/lib/fetch-pocket.php?url='+url,
    dataType:'text',
    timeout: 10000, //10sec
  }).done(function(res){
    jQuery( selector ).text( res || 0 );
  }).fail(function(){
    jQuery( selector ).html('<span class="fa fa-exclamation"></span>');
  });
}

//feedlyの購読者数を取得
function fetch_feedly_count(rss_url, selector) {
  jQuery.ajax({
    url: social_count_config.theme_url+'/lib/fetch-feedly.php?url='+rss_url,
    dataType:'text',
    timeout: 10000, //10sec
  }).done(function(res){
    jQuery( selector ).text( res || 0 );
  }).fail(function(){
    jQuery( selector ).html('<span class="fa fa-exclamation"></span>');
  });
}

//Push7で購読者数を取得
function fetch_push7_count(app_no, selector) {
  url = 'https://api.push7.jp/api/v1/'+app_no+'/head';
  jQuery.ajax({
    url:url,
    dataType:'json',
    timeout: 10000, //10sec
    data:{
      url:url
    }
  }).done(function(res){
    jQuery( selector ).text( res.subscribers || 0 );
  }).fail(function(){
    jQuery( selector ).html('<span class="fa fa-exclamation"></span>');
  });
}

jQuery(function(){
  if (typeof social_count_config !== 'undefined') {
    //console.log(social_count_config.all_sns_share_btns_visible);
    //シェアボタンを全部表示しているとき
    if ( social_count_config.all_sns_share_btns_visible &&
         social_count_config.all_share_count_visible ) {

      //Twitterカウントの取得
      if ( social_count_config.twitter_btn_visible ){
        fetch_twitter_count_from_count_jsoon(social_count_config.permalink, '.twitter-count');
      }

      //Facebookカウントの取得
      if ( social_count_config.facebook_btn_visible ){
        fetch_facebook_count(social_count_config.permalink, '.facebook-count');
      }
      //Google＋カウントの取得
      if ( social_count_config.google_plus_btn_visible ){
        fetch_google_plus_count(social_count_config.permalink, '.googleplus-count');
      }
      //はてブカウントの取得
      if ( social_count_config.hatena_btn_visible ){
        fetch_hatebu_count(social_count_config.permalink, '.hatebu-count');
      }
      //Pocketカウントの取得
      if ( social_count_config.pocket_btn_visible ){
        fetch_pocket_count(social_count_config.permalink, '.pocket-count');
      }
      //feedlyカウントの取得
      if ( social_count_config.feedly_btn_visible ){
        fetch_feedly_count(social_count_config.rss2_url, '.feedly-count');
      }
      //push7カウントの取得
      if ( social_count_config.push7_btn_visible ){
        fetch_push7_count(social_count_config.push7_app_no, '.push7-count');
      }

    }

  }

  if (typeof lazyload_config !== 'undefined') {
    jQuery('img').lazyload(lazyload_config);
  }
});

function doMasonry() {
  jQuery('#list').masonry({ //<!-- #listは記事一覧を囲んでる部分 -->
    itemSelector: '.entry', //<!--.entryは各記事を囲んでる部分-->
    isAnimated: false //<!--アニメーションON-->
  });
}

jQuery(window).load(function(){
  if (typeof do_masonry !== 'undefined') {
    doMasonry()
  }
});
jQuery(function(){
  if (typeof do_masonry !== 'undefined') {
    doMasonry()
  }
});

///////////////////////////////////
// レスポンス表示時のメニューの挙動
// メニューのスタイル表示崩れの防止
///////////////////////////////////
(function($){
  $(window).resize(function(){
    if ( $(window).width() > 1110 ) {
      $('#navi-in ul').removeAttr('style');
    }
  });
})(jQuery);

///////////////////////////////////
// Facebookページいいねエリアのリサイズ（Androidブラウザ対応用）
///////////////////////////////////
// function adjast_article_like_arrow_box() {
//   var w = jQuery('#main').width();
//   jQuery('#main .article-like-arrow-box').css('width', (w - 114) + 'px');
//   w = jQuery('#sidebar').width();
//   jQuery('#sidebar .article-like-arrow-box').css('width', (w - 114) + 'px');
//   //console.log(w);
// }
// jQuery(window).resize(function() {
//   adjast_article_like_arrow_box()
// });

// jQuery(document).ready(function() {
//   adjast_article_like_arrow_box()
// });

// ///////////////////////////////////
// // Twitterのツイート数取得関数を呼び出す
// ///////////////////////////////////
// jQuery(function(){
//   if (typeof social_count_config !== 'undefined') {
//     //シェアボタンを全部表示しているとき
//     if ( social_count_config.all_sns_share_btns_visible &&
//          social_count_config.all_share_count_visible &&
//          social_count_config.twitter_count_visible ) {
//       fetch_twitter_count_from_count_jsoon('http://nelog.jp/google-map-to-amp', '.twitter-count');
//     }
//   }
// });

/////////////////////////////////
// 折り畳み式アーカイブウィジェット
/////////////////////////////////
(function($) {
  $(function() {
    var wgts = $(".widget_archive");//アーカイブウィジェット全てを取得
    //アーカイブウィジェットを1つずつ処理する
    wgts.each(function(i, el) {
      var wgt = $(el);

      //日付表示＋投稿数か
      var has_date_count = wgt.text().match(/\d+年\d+月\s\(\d+\)/);
      //日付表示だけか
      var has_date_only = wgt.text().match(/\d+年\d+月/) && !has_date_count;

      //日付表示されているとき（ドロップダウン表示でない時）
      if ( has_date_count || has_date_only ) {
        var
          clone = wgt.clone(),//アーカイブウィジェットの複製を作成
          year = [];
        //クローンはウィジェットが後にに挿入。クローンはcssで非表示
        wgt.after(clone);
        clone.attr("class", "archive_clone").addClass('hide');

        var
          acv = wgt, //ウィジェット
          acvLi = acv.find("li"); //ウィジェット内のli全て
        //ul.yearsをアーカイブウィジェット直下に追加してそのDOMを取得
        var acv_years =  acv.append('<ul class="years"></ul>').find("ul.years");

        //liのテキストから年がどこからあるかを調べる
        acvLi.each(function(i) {
          var reg = /(\d+)年 ?(\d+)月/;
          //日付表示＋投稿数か
          if ( has_date_count ) {
            reg = /(\d+)年 ?(\d+)月\s\((\d+)\)/;
          }
          var dt = $(this).text().match(reg);
          if (dt) {
            year.push(dt[1]);
          }

        });
        $.unique(year); //重複削除

        acvLi.unwrap(); //liの親のulを解除

        //投稿年があるだけ中にブロックを作る
        var
          yearCount = year.length,
          ii = 0;
        while (ii < yearCount) {
          acv_years.append("<li class='year_" + year[ii] + "'><a class='year'>" + year[ii] + "年</a><ul class='month'></ul></li>");
          ii++;
        }

        //作ったブロック内のulに内容を整形して移動
        //オリジナルのクローンは順番に削除
        var j = 0;
        acvLi.each(function(i, el) {
          var reg = /(\d+)年 ?(\d+)月/;
          //日付表示＋投稿数か
          if ( has_date_count ) {
            reg = /(\d+)年 ?(\d+)月\s\((\d+)\)/;
          }
          var
            dt = $(this).text().match(reg),
            href = $(this).find("a").attr("href");

          //月の追加
          var rTxt = "<li><a href='" + href + "'>" + "" + dt[2] + "月</a>";
          //日付表示＋投稿数か
          if ( has_date_count ) {
            rTxt += " (" + dt[3] + ")" + "</li>"; //投稿数の追加
          }

          //作成した月のHTMLを追加、不要なものは削除
          if (year[j] === dt[1]) {
            acv_years.find(".year_" + year[j] + " ul").append(rTxt);
            $(this).remove();
          } else {
            j++;
            acv_years.find(".year_" + year[j] + " ul").append(rTxt);
            $(this).remove();
          }
        });

        //クローン要素を削除
        clone.remove();

        //直近の年の最初以外は.hide
        acv.find("ul.years ul:not(:first)").addClass("hide");

        //年をクリックでトグルshow
        acv.find("a.year").on("click", function() {
          $(this).next().toggleClass("hide");
        });
      }//if has_date_count || has_date_only
    });//wgts.each

  });

})(jQuery);

/////////////////////////////////
//テーブルにレスポンシブ用のラップを追加する
/////////////////////////////////
// (function($){
//   $('table:not(.table-wrap table)').wrap('<div class="table-wrap"></div>');
// })(jQuery);

