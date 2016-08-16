<?php
///////////////////////////////////////////////////
//パソコン用テキストウイジェットの追加
///////////////////////////////////////////////////
class PcTextWidgetItem extends WP_Widget {
  function __construct() {
     parent::__construct(
      'pc_text',
      '[S] パソコン用テキストウィジェット',//ウイジェット名
      array('description' => 'パソコンのみで表示されるSimplicity用のテキストウィジェットです。')
    );
  }
  function widget($args, $instance) {
    extract( $args );
    // //タイトル名を取得
    // $title = apply_filters( 'widget_title_pc_text', $instance['title_pc_text'] );
    //タイトル名を取得
    $title = apply_filters( 'widget_title_pc_text', empty($instance['title_pc_text']) ? "" : $instance['title_pc_text'] );
    $widget_text = isset( $instance['text_pc_text'] ) ? $instance['text_pc_text'] : '';
    $text = apply_filters( 'widget_text_pc_text', $widget_text, $instance, $this );
    //$text = apply_filters( 'widget_text_pc_text', $instance['text_pc_text'] );

     ?>
      <?php //classにwidgetと一意となるクラス名を追加する ?>
      <?php if ( !is_mobile() && !is_404() ): //パソコン表示かつ404ページでないとき ?>
      <?php echo $args['before_widget']; ?>
        <?php if ($title) {
          echo $args['before_title'].$title.$args['after_title'];//タイトルが設定されている場合は使用する
        }
          ?>
        <div class="text-pc">
          <?php echo $text; ?>
        </div>
      <?php echo $args['after_widget']; ?>
      <?php endif //!is_mobile ?>
    <?php
  }
  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title_pc_text'] = strip_tags($new_instance['title_pc_text']);
    $instance['text_pc_text'] = $new_instance['text_pc_text'];
      return $instance;
  }
  function form($instance) {
    if(empty($instance)){//notice回避
      $instance = array(
        'title_pc_text' => null,
        'text_pc_text' => null,
      );
    }
    $title = esc_attr($instance['title_pc_text']);
    $text = esc_attr($instance['text_pc_text']);
    ?>
    <?php //タイトル入力フォーム ?>
    <p>
      <label for="<?php echo $this->get_field_id('title_pc_text'); ?>">
      タイトル
      </label>
      <input class="widefat" id="<?php echo $this->get_field_id('title_pc_text'); ?>" name="<?php echo $this->get_field_name('title_pc_text'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>
    <?php //テキスト入力フォーム ?>
    <p>
      <label for="<?php echo $this->get_field_id('text_pc_text'); ?>">
      テキスト
      </label>
      <textarea class="widefat" id="<?php echo $this->get_field_id('text_pc_text'); ?>" name="<?php echo $this->get_field_name('text_pc_text'); ?>" cols="20" rows="16"><?php echo $text; ?></textarea>
    </p>
    <?php
  }
}
add_action('widgets_init', create_function('', 'return register_widget("PcTextWidgetItem");'));
