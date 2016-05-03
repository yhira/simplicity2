<?php
///////////////////////////////////////////////////
//Facebook保存ボタンウイジェットの追加
///////////////////////////////////////////////////
class FacebookSaveButtonWidgetItem extends WP_Widget {
  function __construct() {
     parent::__construct(
      'facebook_save_button',
      '[S] 「Facebookに保存する」ボタンウィジェット',//ウイジェット名
      array('description' => '「Facebookに保存する」ボタンを利用して、訪問者にページをストック機能を利用してもらうためのウィジェットです。（※投稿・固定ページでしか利用できません）')
    );
  }
  function widget($args, $instance) {
    extract( $args );
    //タイトル名を取得
    $title = apply_filters( 'widget_facebook_save_button', $instance['facebook_save_button'] );
    //Facebookスクリプトを利用するか
    global $g_facebook_sdk;
    $g_facebook_sdk = true;

     ?>
      <?php //classにwidgetと一意となるクラス名を追加する ?>
      <?php if ( is_singular() ): //投稿・固定ページのトップ表示 ?>
      <?php echo $args['before_widget']; ?>
        <?php if ($title) {
          echo $args['before_title'].$title.$args['after_title'];//タイトルが設定されている場合は使用する
        }
          ?>
        <div class="facebook-save-button">
          <div class="fb-save" data-uri="<?php the_permalink() ?>" data-size="large"></div>
        </div>
      <?php echo $args['after_widget']; ?>
    <?php endif;//is_singular ?>
    <?php
  }
  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['facebook_save_button'] = strip_tags($new_instance['facebook_save_button']);
      return $instance;
  }
  function form($instance) {
    if(empty($instance)){//notice回避
      $instance = array(
        'facebook_save_button' => null,
      );
    }
    $title = esc_attr($instance['facebook_save_button']);
    ?>
    <?php //タイトル入力フォーム ?>
    <p>
      <label for="<?php echo $this->get_field_id('facebook_save_button'); ?>">
      タイトル
      </label>
      <input class="widefat" id="<?php echo $this->get_field_id('facebook_save_button'); ?>" name="<?php echo $this->get_field_name('facebook_save_button'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>
    <?php
  }
}
//add_action('widgets_init', create_function('', 'return register_widget("FacebookSaveButtonWidgetItem");'));