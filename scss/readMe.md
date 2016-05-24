# scssの構成

こちらは、[GitHub-hidekichi/simplicity-1][a]のreadme.mdになります。
このディレクトリ以下にあるscssは**vendor prefixesは書いてありません**ので、コンパイル時にgulpなら、gulp-Autoprefixerが必要です。  
Autoprefixerを利用してコンパイルすることで、必要な`web-kit-`や`-moz-`、`-ms-`などのベンダープリフィックスが自動で入ります。

[a]:https://github.com/hidekichi/simplicity-1/tree/master/scss

## style.scssの説明

style.scssは[Simplicity][6]の親テーマstyle.cssをscssに変換したものです。scssなので**そのままではブラウザは読み込めません**。
scssは、コンパイルして、**cssに変換することによってはじめて利用できます**。

通常はコンパイルできる環境を自身のPCに作らないといけません。[cloud9][1]でもコンパイルすることは可能ですし、簡単なものであれば[codepen][2]でも利用できます。  

環境の作り方としては、「scss 環境」などとして検索すればたくさん説明しているサイトは出てきます。筆者はLinuxなので今どきのWindowsやMaxでどのように導入するかの手順はわかりませんが、基本的に、[node.js][4]と[gulp][3]や、[grunt][5]などのタスクランナーを導入すればコンパイルできるようになります。  

ただし、こちらのファイルは、**親テーマstyle.cssのscss化したものですから多くのSimplicityユーザーはまず不要かと思います**。  
通常カスタマイズを行う場合は、子テーマstyle.cssやその他子テーマのファイルに行うのが普通なので、親テーマをいじる必要はあまりありません。

[1]:https://c9.io/
[2]:http://codepen.io/
[3]:http://gulpjs.com/
[4]:https://nodejs.org/en/
[5]:http://gruntjs.com/
[6]:http://wp-simplicity.com/

style.scssからは、フォルダ分けしていない\_(アンダーバー付き)から始まる各ファイルが読み込まれます。これら\_付きのファイルはそれぞれ対応するフォルダの中のscssファイルを読み込み、結果的にstyle.cssにすべてのファイルを読み込むという事になります。

これら読み込みは`@import`で行われ、読み込み順はその順番を変えるだけということになります。
> scssでは、\_と拡張子は不要でフォルダがあればそのフォルダ名とファイル名だけで読み込みできます。  
> `@import "sns/sharebar";`  
とすれば、snsフォルダにある_sharebar.scssが読み込まれます

#### mixin

また、scss(あるいはsass)の機能であるmixin(ミックスイン)をいくつか用意しました。これらを上手く利用することで入力の手間が省けるのと、プロパティの並びを一定化して可読性をあげることができます。
mixin以外にも便利な機能はありますが、ひとまずわかりやすいものを入れておきました。
mixinは `_mixin.scss` に書かれています。

#### 定数(あるいは変数)

PHPやjavascriptなどもそうですが、定数を作っておくと変な値が入らなくなるので例えば、
```css
color: #cc0000; /*これが決まりの色として*/
color: #ccc000; /*こういう間違いが無くなる*/
```
こういった微妙な間違いを防ぐことができます。上記は赤で、下記は黄色なので16進数の文字からだけではその間違いに気がつかない場合もあったりします。

例を上げるとtwitterのカラーは何だっけ？  
あるいは、:hoverの色は何だっけ？  
と言うような場合です。これらを決めておくことで共通の色や仕様を利用できるようになります。

scssでは$で始まる変数を利用することができます。例えば、

```scss
$twitterColor: #55acee;
```

このように設定しておけば、

```scss
ul {
	li {
		background-color: $twitterColor;
	}
}
```
として利用できます。こういった変数を用意しておけば、確実にその値が利用できるのでとても便利になります。pのマージンは、上1.5emで、下は0.5emと言う事なら、

```scss
$marginDefault: 1em;

p {
	margin-top: $marginDefault * 1.5;
	margin-bottom: $marginDefault / 2;
}
```

と言うような使い方ができるというわけです。これらを決めることで一定の値を取得することができるようになります。これら定数(変数)は、`_variable.scss`に書いてあります。

#### webフォント

Simplicityでは、たくさん読み込んでいるわけではありませんがいくつかwebフォントが利用されています。これらもまとめて読み込んでいるのが、`_webfont.scss`です。

#### コメントについて

もともとSimplicityのstyle.cssにかかれていた`/*〜*/`によるコメントは、大分類のものだけ`/*〜*/`で書いてあり、小分類のものは`//〜`で書いてあります。  
これらは、今後修正していくかと思いますが、変更は簡単に行えます。

>  `/*〜*/` のコメントはcssにコンパイルした際に出力されますが、`//〜`のコメントは出力されません。

## 各フォルダの中身
### layout
_layout.scssから以下のファイルが呼び出されます。

ファイル名 | その内容
------------ | -------------
_anythingResponsive.scss | 何でもレスポンシブ化するスタイル
_article.scss | articleの基本設定
_breadcrumbs.scss | パンくずリスト
_comment_area.scss | コメントエリア
_footer.scss | フッター
_header.scss | ヘッダー
_inputform.scss | 入力フォーム（Form）
_list_item.scss | リストアイテム(index.phpのリスト)
_main.scss | #mainまわり
_navi_menu.scss | グローバルナビメニューとフッター・モバイルナビメニュー、サムネ付きポストナビ
_pager_navigation.scss | 前の記事・次の記事、ページナビゲーション
_related-entry.scss | 関連記事
_sidebar.scss | サイドバー

### sns

_sns.scssから以下のファイルが呼び出されます。

ファイル名 | その内容
------------ | -------------
_balloonButton.scss | バルーンボタン
_followbutton.scss | SNSページフォロー
_iconfont_size.scss | アイコンフォントの大きさ
_push7Notification.scss | Push7通知ボタンのスタイル
_sharebar.scss | シェアバー
_sharebutton.scss | SNSシェアボタン、自作のバルーンシェアボタン
_under_title_snsbutton.scss | タイトル下SNSボタン
_viralbutton.scss | バイラルボタン、シェアバーのも

### typo

_htmltag.scssから以下のファイルが呼び出されます。

ファイル名 | その内容
------------ | -------------
_anchor.scss | アンカー(リンク色等)
_basic.scss | 基本設定
_blockquote.scss | ブロッククォート(引用)
_headeing.scss | 見出し
_list.scss | リスト

### unit

_parts.scssから以下のファイルが呼び出されます。

ファイル名 | その内容
------------ | -------------
_ads.scss | 広告
_alt_hover_caption.scss | Alt属性値を画像ホバー時にキャプション表示する
_bbpress.scss | 外部パーツ微調整(bbpress)
_blog-card.scss | ブログカード
_eyecatch.scss | アイキャッチ
_facebook.scss | facebook(サイドバーのfacebookも含む)
_feedly | feedly(たて型ヨコ型)
_folding_archviWidget.scss | 折り畳みアーカイブ
_gototop.scss | トップへ戻るボタン
_hidden_items.scss | 非表示するアイテム
_highlight_js.scss | highlight.js
_mobile_modal_menu.scss | モバイルモーダルメニュー
_responsivePagenation.scss | レスポンシブページネーション(ひとまずここ)
_searchform.scss | 検索フォーム
_widget.scss | ウィジェット
_wordpress_misc.scss | wordpressの機能
