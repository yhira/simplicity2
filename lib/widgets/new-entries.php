<?php
///////////////////////////////////////////////////
//新着エントリーウイジェットの追加
///////////////////////////////////////////////////
class SimplicityNewEntryWidgetItem extends WP_Widget {
  function __construct() {
    parent::__construct(
      'new_entries',
      '[S] 新着記事',
      array('description' => '新着記事リストを表示するSimplicityウィジェットです。')
    );//ウイジェット名
  }
  function widget($args, $instance) {
    extract( $args );
    //ウィジェットモード（全ての新着記事を表示するか、カテゴリ別に表示するか）
    $widget_mode = apply_filters( 'widget_mode', $instance['widget_mode'] );
    //タイトル名を取得
    $title_new = apply_filters( 'widget_title_new', $instance['title_new'] );
    //表示数を取得
    $entry_count = apply_filters( 'widget_entry_count', $instance['entry_count'] );
    $is_top_visible = apply_filters( 'widget_is_top_visible', $instance['is_top_visible'] );
    $entry_type = apply_filters( 'widget_is_top_visible', $instance['entry_type'] );
    //表示数をグローバル変数に格納
    //ウィジェットモード
    global $g_widget_mode;
    //後で使用するテンプレートファイルへの受け渡し
    global $g_entry_count;
    //表示タイプをグローバル変数に格納
    global $g_entry_type;
    //ウィジェットモードが設定されてない場合はall（全て表示）にする
    if ( !$widget_mode ) $widget_mode = 'all';
    $g_widget_mode = $widget_mode;
    //表示数が設定されていない時は5にする
    if ( !$entry_count ) $entry_count = 5;
    $g_entry_count = $entry_count;
    //表示タイプのデフォルト設定
    if ( !$entry_type ) $entry_type ='default';
    $g_entry_type = $entry_type;
     ?>
    <?php //classにwidgetと一意となるクラス名を追加する ?>
    <?php if ( //「表示モード」が「全ての新着記事」のとき
               ( ($widget_mode == 'all') && ($is_top_visible || !is_home()) ) ||
               //「表示モード」が「カテゴリ別新着記事」のとき
               ( ($widget_mode == 'category') && get_category_ids() ) ): ?>
    <?php echo $args['before_widget']; ?>
      <?php echo $args['before_title']; ?>
      <?php if ($title_new) {
        echo $title_new;//タイトルが設定されている場合は使用する
      } else {
        if ( $widget_mode == 'all' ) {//全ての表示モードの時は
          echo '新着記事';
        } else {
          echo 'カテゴリー別新着記事';
        }
        //echo '新着記事';
      }
        ?>
      <?php echo $args['after_title']; ?>
      <?php
        //新着記事表示用の処理を書くところだけど
        //コード量も多く、インデントが深くなり読みづらくなるので
        //テンプレートファイル側に書く
        if ( $entry_type == 'default' ) {
          get_template_part('new-entries');
        }else{
          get_template_part('new-entries-large');
        }
         ?>
    <?php echo $args['after_widget']; ?>
    <?php endif; ?>
  <?php
  }
  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['widget_mode'] = strip_tags($new_instance['widget_mode']);
    $instance['title_new'] = strip_tags($new_instance['title_new']);
    $instance['entry_count'] = strip_tags($new_instance['entry_count']);
    $instance['is_top_visible'] = strip_tags($new_instance['is_top_visible']);
    $instance['entry_type'] = strip_tags($new_instance['entry_type']);
      return $instance;
  }
  function form($instance) {
    if(empty($instance)){
      $instance = array(
        'widget_mode' => null,
        'title_new' => null,
        'entry_count' => null,
        'is_top_visible' => null,
        'entry_type' => null,
      );
    }
    $widget_mode = esc_attr($instance['widget_mode']);
    $title_new = esc_attr($instance['title_new']);
    $entry_count = esc_attr($instance['entry_count']);
    $is_top_visible = esc_attr($instance['is_top_visible']);
    $entry_type = esc_attr($instance['entry_type']);
    ?>
    <?php //ウィジェットモード（全てか、カテゴリ別か） ?>
    <p>
      <label for="<?php echo $this->get_field_id('widget_mode'); ?>">
      <?php echo('表示モード'); ?>
      </label><br />
      <input class="widefat" id="<?php echo $this->get_field_id('widget_mode'); ?>" name="<?php echo $this->get_field_name('widget_mode'); ?>"  type="radio" value="all" <?php echo ( ($widget_mode == 'all' || !$widget_mode ) ? ' checked="checked"' : ""); ?> />全ての新着記事（全ページで表示）<br />
      <input class="widefat" id="<?php echo $this->get_field_id('widget_mode'); ?>" name="<?php echo $this->get_field_name('widget_mode'); ?>"  type="radio" value="category"<?php echo ($widget_mode == 'category' ? ' checked="checked"' : ""); ?> />カテゴリ別新着記事（投稿・カテゴリで表示）<br />
    </p>
    <?php //タイトル入力フォーム ?>
    <p>
      <label for="<?php echo $this->get_field_id('title_new'); ?>">
      <?php echo('新着記事のタイトル'); ?>
      </label>
      <input class="widefat" id="<?php echo $this->get_field_id('title_new'); ?>" name="<?php echo $this->get_field_name('title_new'); ?>" type="text" value="<?php echo $title_new; ?>" />
    </p>
    <?php //表示数入力フォーム ?>
    <p>
      <label for="<?php echo $this->get_field_id('entry_count'); ?>">
      <?php echo('表示数（半角数字、デフォルト：5）'); ?>
      </label>
      <input class="widefat" id="<?php echo $this->get_field_id('entry_count'); ?>" name="<?php echo $this->get_field_name('entry_count'); ?>" type="text" value="<?php echo $entry_count; ?>" />
    </p>
    <?php //表示タイプフォーム ?>
    <p>
      <label for="<?php echo $this->get_field_id('entry_type'); ?>">
      <?php echo('表示タイプ'); ?>
      </label><br />
      <input class="widefat" id="<?php echo $this->get_field_id('entry_type'); ?>" name="<?php echo $this->get_field_name('entry_type'); ?>"  type="radio" value="default" <?php echo ( ($entry_type == 'default' || !$entry_type ) ? ' checked="checked"' : ""); ?> />デフォルト<br />
      <input class="widefat" id="<?php echo $this->get_field_id('entry_type'); ?>" name="<?php echo $this->get_field_name('entry_type'); ?>"  type="radio" value="large_thumb"<?php echo ($entry_type == 'large_thumb' ? ' checked="checked"' : ""); ?> />大きなサムネイル<br />
      <input class="widefat" id="<?php echo $this->get_field_id('entry_type'); ?>" name="<?php echo $this->get_field_name('entry_type'); ?>"  type="radio" value="large_thumb_on"<?php echo ($entry_type == 'large_thumb_on' ? ' checked="checked"' : ""); ?> />タイトルを重ねた大きなサムネイル<br />
    </p>
    <?php //TOPページ表示 ?>
    <?php if ( $widget_mode == 'all' || $widget_mode == null ): ?>
    <p>
      <label for="<?php echo $this->get_field_id('is_top_visible'); ?>">
      <?php echo('トップページでの表示'); ?>
      </label><br />
      <input class="widefat" id="<?php echo $this->get_field_id('is_top_visible'); ?>" name="<?php echo $this->get_field_name('is_top_visible'); ?>" type="checkbox" value="on"<?php echo ($is_top_visible ? ' checked="checked"' : ''); ?> />表示する<br>※新着順のインデックスリストが表示されるトップでも表示する場合はチェックしてください。<br>※「表示モード」が「全ての新着記事」のときのみ有効な機能です。
    </p>
    <?php endif ?>

    <?php
  }
}
add_action('widgets_init', create_function('', 'return register_widget("SimplicityNewEntryWidgetItem");'));