<?php if ( is_mobile() //&& //モバイルの時は単なるアイコン
           /*!is_page_cache_enable()*/ ) {//ページキャッシュモードの時はPCの表示にする
  get_template_part('sns-buttons-icon');
} else {//PCの時はバルーン付きボタン
  if ( is_share_button_type_theme_color() || is_share_button_type_twitter() ) {//独自シェアボタンオンのとき（テーマカラータイプ、Twitterタイプ）
    get_template_part('sns-buttons-balloon');
  } elseif ( is_share_button_type_viral() ) {//バイラルボタンのとき
    get_template_part('sns-buttons-viral');
  } else {//ソーシャルサービスのデフォルトのシェアボタン
    get_template_part('sns-buttons-default');
  }
} ?>