<?php
///////////////////////////////////////////////////
//人気記事（Popular Posts）ウイジェットの追加
///////////////////////////////////////////////////
class SimplicityPopularPostsCategoryWidgetItem extends WP_Widget {
  function __construct() {
    parent::__construct(
      'popular_ranking',
      '[S] 人気記事',
      array('description' => '人気記事リストを表示するSimplicityウィジェットです。（※要Wordpress Popular Postsプラグイン）')
    );
  }
  function widget($args, $instance) {
    extract( $args );
    // //ウィジェットモード（全ての人気記事を表示するか、カテゴリ別に表示するか）
    // $widget_mode = apply_filters( 'widget_mode', $instance['widget_mode'] );
    // $title_popular = apply_filters( 'widget_title_popular', $instance['title_popular'] );
    // //表示数を取得
    // $entry_count = apply_filters( 'widget_entry_count', $instance['entry_count'] );
    // //表示タイプを取得
    // $entry_type = apply_filters( 'widget_entry_count', $instance['entry_type'] );
    // //固定ページを含める
    // $is_pages_include = apply_filters( 'widget_is_pages_include', $instance['is_pages_include'] );
    // //閲覧数の表示
    // $is_views_visible = apply_filters( 'widget_is_views_visible', $instance['is_views_visible'] );
    // //集計期間
    // $range = apply_filters( 'range', $instance['range'] );
    // //集計期間の表示
    // $range_visible = apply_filters( 'range_visible', $instance['range_visible'] );
    // //ランキング順位の表示
    // $is_ranking_visible = apply_filters( 'is_ranking_visible', $instance['is_ranking_visible'] );

    //ウィジェットモード（全ての人気記事を表示するか、カテゴリ別に表示するか）
    $widget_mode = apply_filters( 'widget_mode', empty($instance['widget_mode']) ? "defailt" : $instance['widget_mode'], $instance );
    $title_popular = apply_filters( 'widget_title_popular', empty($instance['title_popular']) ? "人気記事" : $instance['title_popular'] );
    //表示数を取得
    $entry_count = apply_filters( 'widget_entry_count', empty($instance['entry_count']) ? 5 : absint($instance['entry_count']) );
    //表示タイプを取得
    $entry_type = apply_filters( 'widget_entry_count', empty($instance['entry_type']) ? "default" : $instance['entry_type'], $instance );
    //固定ページを含める
    $is_pages_include = apply_filters( 'widget_is_pages_include', empty($instance['is_pages_include']) ? "" : $instance['is_pages_include'], $instance );
    //閲覧数の表示
    $is_views_visible = apply_filters( 'widget_is_views_visible', empty($instance['is_views_visible']) ? "" : $instance['is_views_visible'], $instance );
    //集計期間
    $range = apply_filters( 'range', empty($instance['range']) ? "all" : $instance['range'], $instance );
    //集計期間の表示
    $range_visible = apply_filters( 'range_visible', empty($instance['range_visible']) ? "" : $instance['range_visible'], $instance );
    //ランキング順位の表示
    $is_ranking_visible = apply_filters( 'is_ranking_visible', empty($instance['is_ranking_visible']) ? "" : $instance['is_ranking_visible'], $instance );
    //除外ID
    $exclude_ids = apply_filters( 'exclude_ids', empty($instance['exclude_ids']) ? "" : $instance['exclude_ids'], $instance );

    //後で使用するテンプレートファイルへの受け渡し
    //ウィジェットモード
    global $g_widget_mode;
    //表示数をグローバル変数に格納
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
    //固定ページを含めるかのデフォルト設定
    global $g_is_pages_include;
    $g_is_pages_include = $is_pages_include;
    //ページビュー表示に格納
    global $g_is_views_visible;
    $g_is_views_visible = $is_views_visible;
    global $g_range;
    $g_range = ($range ? $range : 'all');
    global $g_widget_item;
    $g_widget_item = 'SimplicityPopularPostsCategoryWidgetItem';
    //除外ID
    global $g_exclude_ids;
    $g_exclude_ids = $exclude_ids;
  ?>
    <?php if ( $widget_mode == 'all' || //モードがウィジェットモードが「すべての人気記事表示」の時
               is_single() || is_category() )://投稿ページとカテゴリーページのとき ?>
      <?php if ( $is_ranking_visible ) {//ランキングの表示
        echo get_popular_posts_ranking_style('.widget_popular_ranking');//問題なければいずれ消す[TODO]
      }  ?>
      <?php echo $args['before_widget']; ?>
        <?php echo $args['before_title']; ?>
        <?php if ($title_popular) {
          echo $title_popular;
        } else {
          if ( $widget_mode == 'all' ) {//全ての表示モードの時は
            echo '人気記事';
          } else {
            echo 'カテゴリー別人気記事';
          }
        }
          ?>
        <?php echo $args['after_title']; ?>
        <?php //PV順
        if ( $entry_type == 'default' ) {
          get_template_part('popular-posts-entries');
        } else {
          get_template_part('popular-posts-entries-large');
        } ?>
        <?php if ($range_visible) {
          echo get_range_tag($range);
        } ?>
      <?php echo $args['after_widget']; ?>
    <?php endif; ?>
  <?php
  }
  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['widget_mode'] = trim(strip_tags($new_instance['widget_mode']));
    $instance['title_popular'] = trim(strip_tags($new_instance['title_popular']));
    $instance['entry_count'] = strip_tags($new_instance['entry_count']);
    $instance['entry_type'] = strip_tags($new_instance['entry_type']);
    $instance['is_pages_include'] = strip_tags($new_instance['is_pages_include']);
    $instance['is_views_visible'] = $new_instance['is_views_visible'];
    $instance['range'] = $new_instance['range'];
    $instance['range_visible'] = $new_instance['range_visible'];
    $instance['is_ranking_visible'] = strip_tags($new_instance['is_ranking_visible']);
    $instance['exclude_ids'] = strip_tags($new_instance['exclude_ids']);
      return $instance;
  }
  function form($instance) {
    if(empty($instance)){
      $instance = array(
        'widget_mode' => null,
        'title_popular' => null,
        'entry_count' => null,
        'entry_type' => null,
        'is_pages_include' => null,
        'is_views_visible' => null,
        'range' => null,
        'range_visible' => null,
        'is_ranking_visible' => null,
        'exclude_ids' => null,
      );
    }
    $widget_mode = esc_attr($instance['widget_mode']);
    $title_popular = esc_attr($instance['title_popular']);
    $entry_count = esc_attr($instance['entry_count']);
    $entry_type = esc_attr($instance['entry_type']);
    $is_pages_include = esc_attr($instance['is_pages_include']);
    $is_views_visible = esc_attr($instance['is_views_visible']);
    $range = esc_attr($instance['range']);
    $range_visible = esc_attr($instance['range_visible']);
    $is_ranking_visible = esc_attr($instance['is_ranking_visible']);
    $exclude_ids = esc_attr($instance['exclude_ids']);
    ?>

    <?php //ウィジェットモード（全てか、カテゴリ別か） ?>
    <p>
      <label for="<?php echo $this->get_field_id('widget_mode'); ?>">
      <?php echo('表示モード'); ?>
      </label><br />
      <input class="widefat" id="<?php echo $this->get_field_id('widget_mode'); ?>" name="<?php echo $this->get_field_name('widget_mode'); ?>"  type="radio" value="all" <?php echo ( ($widget_mode == 'all' || !$widget_mode ) ? ' checked="checked"' : ""); ?> />全ての人気記事（全ページで表示）<br />
      <input class="widefat" id="<?php echo $this->get_field_id('widget_mode'); ?>" name="<?php echo $this->get_field_name('widget_mode'); ?>"  type="radio" value="category"<?php echo ($widget_mode == 'category' ? ' checked="checked"' : ""); ?> />カテゴリ別人気記事（投稿・カテゴリで表示）<br />
    </p>
    <p>
       <label for="<?php echo $this->get_field_id('title_popular'); ?>">
       <?php echo('人気記事のタイトル'); ?>
       </label>
       <input class="widefat" id="<?php echo $this->get_field_id('title_popular'); ?>" name="<?php echo $this->get_field_name('title_popular'); ?>" type="text" value="<?php echo $title_popular; ?>" />
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
    <?php //固定ページの表示 ?>
    <p>
      <label for="<?php echo $this->get_field_id('is_pages_include'); ?>">
      <?php echo('固定ページの表示'); ?>
      </label><br />
      <input class="widefat" id="<?php echo $this->get_field_id('is_pages_include'); ?>" name="<?php echo $this->get_field_name('is_pages_include'); ?>" type="checkbox" value="on"<?php echo ($is_pages_include ? ' checked="checked"' : ''); ?> />ランキングに固定ページを含める
    </p>
    <?php //集計単位の指定 ?>
    <p>
      <label for="<?php echo $this->get_field_id('range'); ?>">
      <?php echo('集計単位'); ?>
      </label><br />
      <input class="widefat" id="<?php echo $this->get_field_id('range'); ?>" name="<?php echo $this->get_field_name('range'); ?>" type="radio" value="daily"<?php echo ($range == 'daily' ? ' checked="checked"' : ''); ?> />1日<br />
      <input class="widefat" id="<?php echo $this->get_field_id('range'); ?>" name="<?php echo $this->get_field_name('range'); ?>" type="radio" value="weekly"<?php echo ($range == 'weekly' ? ' checked="checked"' : ''); ?> />1週間<br />
      <input class="widefat" id="<?php echo $this->get_field_id('range'); ?>" name="<?php echo $this->get_field_name('range'); ?>" type="radio" value="monthly"<?php echo ($range == 'monthly' ? ' checked="checked"' : ''); ?> />1ヶ月<br />
      <input class="widefat" id="<?php echo $this->get_field_id('range'); ?>" name="<?php echo $this->get_field_name('range'); ?>" type="radio" value="all"<?php echo ($range == null || $range == 'all' ? ' checked="checked"' : ''); ?> />全期間<br />
    </p>
    <?php //集計単位の表示 ?>
    <p>
      <label for="<?php echo $this->get_field_id('range_visible'); ?>">
      <?php echo('集計期間の表示'); ?>
      </label><br />
      <input class="widefat" id="<?php echo $this->get_field_id('range_visible'); ?>" name="<?php echo $this->get_field_name('range_visible'); ?>" type="checkbox" value="on"<?php echo ($range_visible ? ' checked="checked"' : ''); ?> />集計単位の表示
    </p>
    <?php //閲覧数の表示 ?>
    <p>
      <label for="<?php echo $this->get_field_id('is_not_top_visible'); ?>">
      <?php echo('閲覧数の表示'); ?>
      </label><br />
      <input class="widefat" id="<?php echo $this->get_field_id('is_views_visible'); ?>" name="<?php echo $this->get_field_name('is_views_visible'); ?>" type="checkbox" value="on"<?php echo ($is_views_visible ? ' checked="checked"' : ''); ?> />閲覧数の表示
    </p>
    <?php //ランキング順位の表示 ?>
    <p>
      <label for="<?php echo $this->get_field_id('is_ranking_visible'); ?>">
      <?php echo('ランキング順位の表示'); ?>
      </label><br />
      <input class="widefat" id="<?php echo $this->get_field_id('is_ranking_visible'); ?>" name="<?php echo $this->get_field_name('is_ranking_visible'); ?>" type="checkbox" value="on"<?php echo ($is_ranking_visible ? ' checked="checked"' : ''); ?> />ランキング順位の表示
    </p>
    <?php //除外する投稿ID（カンマ区切りで指定） ?>
    <p>
       <label for="<?php echo $this->get_field_id('exclude_ids'); ?>">
       <?php echo('除外する投稿ID（カンマ区切りで指定）'); ?>
       </label>
       <input class="widefat" id="<?php echo $this->get_field_id('exclude_ids'); ?>" name="<?php echo $this->get_field_name('exclude_ids'); ?>" type="text" value="<?php echo $exclude_ids; ?>" />
    </p>
    <?php
  }
}
//Wordpress Popular Postsが有効になっていない場合は表示しない
if ( is_wpp_enable() ):
  add_action('widgets_init', create_function('', 'return register_widget("SimplicityPopularPostsCategoryWidgetItem");'));
endif;