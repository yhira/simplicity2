<?php
///////////////////////////////////////////////////
//SNSフォローボタン
///////////////////////////////////////////////////
class SimplicitySocialFollowWidgetItem extends WP_Widget {
  function __construct() {
    parent::__construct(
      'sns_follow_buttons',
      __( '[S] SNSフォローボタン', 'simplicity2' ),
      array('description' => __( 'SNSサービスのフォローアイコンボタンを表示するSimplicityウィジェットです。', 'simplicity2' ))
    );
  }
  function widget($args, $instance) {
    extract( $args );
    $title = !empty($instance['title']) ? $instance['title'] : '';
    $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
    echo $args['before_widget'];

    if ($title !== null) {
      echo $args['before_title'];
      if ($title) {
        echo $title;
      } else {
        echo __( 'SNSフォローボタン', 'simplicity2' );
      }
      echo $args['after_title'];      
    }


    get_template_part('sns-pages'); //SNSフォローボタン
    echo $args['after_widget']; ?>
  <?php
  }
  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = trim(strip_tags($new_instance['title']));
      return $instance;
  }
  function form($instance) {
    if(empty($instance)){
      $instance = array(
        'title' => null,
      );
    }
    $title = esc_attr($instance['title']);
    ?>
    <p>
       <label for="<?php echo $this->get_field_id('title'); ?>">
        <?php _e( 'SNSフォローボタンのタイトル', 'simplicity2' ) ?>
       </label>
       <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>
    <?php
  }
}
//add_action('widgets_init', create_function('', 'return register_widget("SimplicitySocialFollowWidgetItem");'));
add_action('widgets_init', function(){register_widget('SimplicitySocialFollowWidgetItem');});