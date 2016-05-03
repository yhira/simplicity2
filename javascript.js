/////////////////////////////////
//TOPへ戻るボタン
/////////////////////////////////
jQuery(function(){
  jQuery(window).scroll(function(){
    //最上部から現在位置までの距離を取得して、変数[now]に格納
    var now = jQuery(window).scrollTop();
    //最上部から現在位置までの距離(now)が600以上
    if(now > 600){
      //[#page-top]をゆっくりフェードインする
      jQuery('#page-top').fadeIn('slow');
      //それ以外だったらフェードアウトする
    }else{
      jQuery('#page-top').fadeOut('slow');
    }
    //console.log(wrapperTop);
  });
  //ボタン(id:move-page-top)のクリックイベント
  jQuery('#move-page-top').click(function(){
  //ページトップへ移動する
    jQuery('body,html').animate({
            scrollTop: 0
        }, 800);
  });
});

/////////////////////////////////
//スクロール追従
/////////////////////////////////
var wrapperTop;//追従エリアのトップ位置を格納（追従開始位置
var wrapperHeight;//追従エリアの高さを格納
var sidebarHeight;//サイドバーの高さを格納

//非同期ブログパーツがあっても追従開始位置がずれないように修正（無理やり）
//スマートな良い方法があれば、ご教授お願いします。
function getScrollAreaSettings(){
  wrapperHeight = jQuery('#sidebar-scroll').outerHeight();
  sidebarHeight = jQuery('#sidebar').outerHeight();
  wrapperTop = sidebarHeight - wrapperHeight + 240;
}
setInterval('getScrollAreaSettings()',2000);

(function(jquery) {
  jquery(document).ready(function() {
    /*
    Ads Sidewinder
    by Hamachiya2. http://d.hatena.ne.jp/Hamachiya2/20120820/adsense_sidewinder
    */
    var main = jQuery('#main'); // メインカラムのID
    var side = jQuery('#sidebar'); // サイドバーのID
    var wrapper = jQuery('#sidebar-scroll'); // スクロール追従要素のID
    var side_top_margin = 60;
    if (!wrapper.size()) {return;}//スクロール追従エリアにウイジェットが入っていないときはスルー
    if (side.css('clear') == 'both') {return;}//レスポンシブでサイドバーをページ下に表示しているときはスルー

    if (main.length === 0 || side.length === 0 || wrapper.length === 0) {
      return;
    }

    var w = jquery(window);
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
      sideHeight = side.outerHeight();
      mainHeight = main.outerHeight();
      mainAbs = main.offset().top + mainHeight;
      var winTop = w.scrollTop()+side_top_margin;
      winLeft = w.scrollLeft();
      var winHeight = w.height();
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
jQuery(document).ready(function() {
  jQuery('#mobile-menu-toggle').click(function(){
    header_menu = jQuery('#navi ul');
    if (header_menu.css('display') == 'none') {
      header_menu.slideDown();
    } else{
      header_menu.slideUp();
    };
  });

});

///////////////////////////////////
// ソーシャルボタンカウントの非同期取得
///////////////////////////////////
jQuery(function(){
  jQuery(window).scroll(function(){
    //console.log(jQuery('#sidebar').css('clear'));
    //最上部から現在位置までの距離を取得して、変数[now]に格納
    var now = jQuery(window).scrollTop();
    var sharebar = jQuery('#sharebar');
    if (!sharebar.size()) {return;}
    var main = jQuery('#main');
    var sharebar_top = sharebar.offset().top;
    var sharebar_h = sharebar.outerHeight();
    var main_top = main.offset().top;
    var main_h = main.outerHeight();

    var bottom_line = main_h-400;
    if(now < (main_h-sharebar_h)){
      if (now > main_top) {
        //sharebar.fadeIn('fast');
        sharebar.css({
          position: 'fixed',
          top: '70px'
        });
      } else{
        sharebar.css({
          position: 'absolute',
            top: main_top+70
        });
      };
    }else{
      //sharebar.fadeOut('fast');
      sharebar.css({
        position: 'absolute',
        top: main_h-sharebar_h
      });
    }
    //console.log(sharebar_h);

  });
});

// Twitterのシェア数を取得
function fetch_twitter_count(url, selector) {
  jQuery.ajax({
    url:'//urls.api.twitter.com/1/urls/count.json',
    dataType:'jsonp',
    timeout: 10000, //10sec
    data:{
      url:url
    }
  }).done(function(res){
    jQuery( selector ).text( res.count || 0 );
  }).fail(function(){
    jQuery( selector ).html('<span class="fa fa-exclamation"></span>');
  });
}
// function fetch_twitter_count(url, selector) {
//   jQuery.ajax({
//     url:'//urls.api.twitter.com/1/urls/count.json',
//     dataType:'jsonp',
//     timeout: 10000, //10sec
//     data:{
//       url:url
//   },
//   success:function(res){
//     jQuery( selector ).text( res.count || 0 );
//   },
//   error:function(){
//     jQuery( selector ).html('<span class="fa fa-exclamation"></span>');
//   }
//   });
// }

//Facebookのシェア数を取得
function fetch_facebook_count(url, selector) {
    jQuery.ajax({
      url:'https://graph.facebook.com/',
      dataType:'jsonp',
      timeout: 10000, //10sec
      data:{ id:url }
    }).done(function(res){
      jQuery( selector ).text( res.shares || 0 );
    }).fail(function(){
      jQuery( selector ).html('<span class="fa fa-exclamation"></span>');
    });
}
// function fetch_facebook_count(url, selector) {
//   jQuery.ajax({
//     url:'https://graph.facebook.com/',
//     dataType:'jsonp',
//     timeout: 10000, //10sec
//     data:{
//       id:url
//     },
//     success:function(res){
//       jQuery( selector ).text( res.shares || 0 );
//     },
//     error:function(){
//       jQuery( selector ).html('<span class="fa fa-exclamation"></span>');
//     }
//   });
// }

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

// function fetch_google_plus_count(url, selector) {
//   jQuery.ajax({
//     url: social_count_config.theme_url+'/lib/fetch-google-plus.php?url='+url,
//     dataType:'text',
//     timeout: 10000, //10sec
//     success:function(res){
//       jQuery( selector ).text( res || 0 );
//     },
//     error:function(){
//       jQuery( selector ).html('<span class="fa fa-exclamation"></span>');
//     }
//   });
//   // jQuery.ajax({
//   //   type: "get", dataType: "xml",
//   //   url: "//query.yahooapis.com/v1/public/yql",
//   //   data: {
//   //     q: "SELECT content FROM data.headers WHERE url='https://plusone.google.com/_/+1/fastbutton?hl=ja&url=" + url + "' and ua='#Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36'",
//   //     format: "xml",
//   //     env: "http://datatables.org/alltables.env"
//   //   },
//   //   success: function (data) {
//   //     var content = jQuery(data).find("content").text();
//   //     var match = content.match(/window\.__SSR[\s*]=[\s*]{c:[\s*](\d+)/i);
//   //     var count = (match != null) ? match[1] : 0;

//   //     jQuery( selector ).text(count);
//   //   }
//   // });
// }

//はてなブックマークではてブ数を取得
function fetch_hatebu_count(url, selector) {
  jQuery.ajax({
    url:'//api.b.st-hatena.com/entry.count?callback=?',
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
// //はてなブックマークではてブ数を取得
// function fetch_hatebu_count(url, selector) {
//   jQuery.ajax({
//     url:'//api.b.st-hatena.com/entry.count?callback=?',
//     dataType:'jsonp',
//     timeout: 10000, //10sec
//     data:{
//       url:url
//     },
//     success:function(res){
//       jQuery( selector ).text( res || 0 );
//     },
//     error:function(){
//       jQuery( selector ).html('<span class="fa fa-exclamation"></span>');
//     }
//   });
// }

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
// function fetch_pocket_count(url, selector) {
//   jQuery.ajax({
//     url: social_count_config.theme_url+'/lib/fetch-pocket.php?url='+url,
//     dataType:'text',
//     timeout: 10000, //10sec
//     success:function(res){
//       jQuery( selector ).text( res || 0 );
//     },
//     error:function(){
//       jQuery( selector ).html('<span class="fa fa-exclamation"></span>');
//     }
//   });
//   // jQuery.ajax({
//   //   type: "get", dataType: "xml",
//   //   url: "//query.yahooapis.com/v1/public/yql",
//   //   data: {
//   //     q: "SELECT content FROM data.headers WHERE url='https://widgets.getpocket.com/v1/button?label=pocket&count=vertical&v=1&url=" + url + "' and ua='#Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36'",
//   //     format: "xml",
//   //     env: "http://datatables.org/alltables.env"
//   //   },
//   //   success: function (data) {
//   //     var content = jQuery(data).find("content").text();
//   //     var match = content.match(/<em id="cnt">(\d+)<\/em>/i);
//   //     var count = (match != null) ? match[1] : 0;

//   //     jQuery( selector ).text(count);
//   //   }
//   // });
// }

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
// function fetch_feedly_count(rss_url, selector) {
//   jQuery.ajax({
//     url: social_count_config.theme_url+'/lib/fetch-feedly.php?url='+rss_url,
//     dataType:'text',
//     timeout: 10000, //10sec
//     success:function(res){
//       //console.log(res);
//       jQuery( selector ).text( res || 0 );
//     },
//     error:function(){
//       jQuery( selector ).html('<span class="fa fa-exclamation"></span>');
//     }
//   });
// }

function doMasonry() {
  jQuery('#list').masonry({ //<!-- #listは記事一覧を囲んでる部分 -->
    itemSelector: '.entry', //<!--.entryは各記事を囲んでる部分-->
    isAnimated: true //<!--アニメーションON-->
  });
}

jQuery(function(){
  if (typeof social_count_config !== 'undefined') {
    //console.log(social_count_config.all_sns_share_btns_visible);
    //シェアボタンを全部表示しているとき
    if ( social_count_config.all_sns_share_btns_visible &&
         social_count_config.all_share_count_visible ) {

      //Twitterカウントの取得
      if ( social_count_config.twitter_btn_visible )
        fetch_twitter_count(social_count_config.permalink, '.twitter-count');
      //Facebookカウントの取得
      if ( social_count_config.facebook_btn_visible )
        fetch_facebook_count(social_count_config.permalink, '.facebook-count');
      //Google＋カウントの取得
      if ( social_count_config.google_plus_btn_visible )
        fetch_google_plus_count(social_count_config.permalink, '.googleplus-count');
      //はてブカウントの取得
      if ( social_count_config.hatena_btn_visible )
        fetch_hatebu_count(social_count_config.permalink, '.hatebu-count');
      //Pocketカウントの取得
      if ( social_count_config.pocket_btn_visible )
        fetch_pocket_count(social_count_config.permalink, '.pocket-count');
      //feedlyカウントの取得
      if ( social_count_config.feedly_btn_visible )
        fetch_feedly_count(social_count_config.rss2_url, '.feedly-count');

    };

  }

  if (typeof lazyload_config !== 'undefined') {
    jQuery('img').lazyload(lazyload_config);
  }
});

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
jQuery(function(){
  jQuery(window).resize(function(){
    if ( jQuery(window).width() > 1110 ) {
      jQuery('#navi-in ul').removeAttr('style');
    };
  });
});

///////////////////////////////////
// Facebookページいいねエリアのリサイズ（Androidブラウザ対応用）
///////////////////////////////////
function adjast_article_like_arrow_box() {
  var w = jQuery('#main').width();
  jQuery('#main .article-like-arrow-box').css('width', (w - 114) + 'px');
  var w = jQuery('#sidebar').width();
  jQuery('#sidebar .article-like-arrow-box').css('width', (w - 114) + 'px');
  //console.log(w);
}
jQuery(window).resize(function() {
  adjast_article_like_arrow_box()
});

jQuery(document).ready(function() {
  adjast_article_like_arrow_box()
});

