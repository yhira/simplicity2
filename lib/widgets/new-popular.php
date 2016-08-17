<?php
///////////////////////////////////////////////////
//新着・人気ウイジェットの追加
///////////////////////////////////////////////////
class SimplicityNewPopularWidgetItem extends WP_Widget {
  function __construct() {
    parent::__construct(
      'new_popular',
      '[S] 新着・人気記事',
      array('description' => 'トップページで「人気記事」リストを、それ以外のページで「新着記事」リストを表示するSimplicityウィジェットです。（※要Wordpress Popular Postsプラグイン）')
    );
  }
  function widget($args, $instance) {
    extract( $args );
    // $title_new = apply_filters( 'widget_title_new', $instance['title_new'] );
    // $title_popular = apply_filters( 'widget_title_popular', $instance['title_popular'] );
    // //表示数を取得
    // $entry_count = apply_filters( 'widget_entry_count', $instance['entry_count'] );
    // //表示タイプ
    // $entry_type = apply_filters( 'widget_entry_type', $instance['entry_type'] );
    // //固定ページを含める
    // $is_pages_include = apply_filters( 'widget_is_pages_include', $instance['is_pages_include'] );
    // $is_views_visible = apply_filters( 'widget_is_views_visible', $instance['is_views_visible'] );
    // $range = apply_filters( 'range', $instance['range'] );
    // $range_visible = apply_filters( 'range_visible', $instance['range_visible'] );
    // $is_ranking_visible = apply_filters( 'is_ranking_visible', $instance['is_ranking_visible'] );

    $title_new = apply_filters( 'widget_title_new', empty($instance['title_new']) ? "新着記事" : $instance['title_new'] );
    $title_popular = apply_filters( 'widget_title_popular', empty($instance['title_popular']) ? "人気記事" : $instance['title_popular']);
    $entry_count = empty($instance['entry_count']) ? 5 : absint( $instance['entry_count'] );
    $entry_type = apply_filters( 'widget_entry_type', empty($instance['entry_type']) ? "default" : $instance['entry_type'], $instance );
    $is_pages_include = apply_filters( 'widget_is_pages_include', empty($instance['is_pages_include']) ? "" : $instance['is_pages_include'], $instance );
    $is_views_visible = apply_filters( 'widget_is_views_visible', empty($instance['is_views_visible']) ? "" :$instance['is_views_visible'], $instance );
    $range = apply_filters( 'range', empty($instance['range']) ? "" : $instance['range'], $instance );
    $range_visible = apply_filters( 'range_visible', empty($instance['range_visible']) ? "" : $instance['range_visible'], $instance );
    $is_ranking_visible = apply_filters( 'is_ranking_visible', empty($instance['is_ranking_visible']) ? "" : $instance['is_ranking_visible'], $instance );
    //除外ID
    $exclude_ids = apply_filters( 'exclude_ids', empty($instance['exclude_ids']) ? "" : $instance['exclude_ids'], $instance );

    //表示数をグローバル変数に格納
    //後で使用するテンプレートファイルへの受け渡し
    //表示数が設定されていない時は5にする
    global $g_entry_count;
    if ( !$entry_count ) $entry_count = 5;
    $g_entry_count = $entry_count;
    //表示タイプのデフォルト設定
    global $g_entry_type;
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
    $g_widget_item = 'SimplicityNewPopularWidgetItem';
    //除外ID
    global $g_exclude_ids;
    $g_exclude_ids = $exclude_ids;
  ?>
      <?php if ( is_home() ) { //トップリストの場合?>
      <?php echo $args['before_widget']; ?>
          <?php echo $args['before_title']; ?>
          <?php if ($title_popular) {
            echo $title_popular;
          } else {
            echo '人気記事';
          }
            ?>
          <?php echo $args['after_title']; ?>
        <?php if ( $is_ranking_visible ) {//ランキングの表示
          echo get_popular_posts_ranking_style('.widget_new_popular');
        }  ?>
        <?php if ( is_wpp_enable() ) { //Wordpress Popular Postsを有効にしてあるか?>
          <?php //PV順
          if ( $entry_type == 'default' ) {
            get_template_part('popular-posts-entries');//デフォルト
          } else {
            get_template_part('popular-posts-entries-large');//大きなサムネイル
          }?>
          <?php if ($range_visible) {
            echo get_range_tag($range);
          } ?>
        <?php } else { //Wordpress Popular Postsがインストールされていない?>
          <?php //コメント順
          if ( $entry_type == 'default' ) {
            get_template_part('popular-entries');//デフォルト
          } else {
            get_template_part('popular-entries-large');//大きなサムネイル
          } ?>
        <?php } ?>
        <?php echo $args['after_widget']; ?>
      <?php } else { //メインページ以外?>
        <?php echo $args['before_widget']; ?>
          <?php echo $args['before_title']; ?>
          <?php if ($title_new) {
            echo $title_new;
          } else {
            echo '新着記事';
          }
            ?>
          <?php echo $args['after_title']; ?>
          <?php //新着記事
          if ( $entry_type == 'default' ) {
            get_template_part('new-entries');//デフォルト
          } else {
            get_template_part('new-entries-large');//大きなサムネイル
          } ?>
        <?php echo $args['after_widget']; ?>
      <?php } ?>
    <?php
  }
  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title_new'] = strip_tags($new_instance['title_new']);
    $instance['title_popular'] = trim($new_instance['title_popular']);
    $instance['entry_count'] = strip_tags($new_instance['entry_count']);
    $instance['entry_type'] = strip_tags($new_instance['entry_type']);
    $instance['is_pages_include'] = strip_tags($new_instance['is_pages_include']);
    $instance['is_views_visible'] = strip_tags($new_instance['is_views_visible']);
    $instance['range'] = strip_tags($new_instance['range']);
    $instance['range_visible'] = $new_instance['range_visible'];
    $instance['is_ranking_visible'] = strip_tags($new_instance['is_ranking_visible']);
    $instance['exclude_ids'] = strip_tags($new_instance['exclude_ids']);
      return $instance;
  }
  // private function init_instance($instance) {
  //   if( empty($instance) ){
  //     return array(
  //       'title_new' => null,
  //       'title_popular' => null,
  //       'entry_count' => null,
  //       'entry_type' => null,
  //       'is_pages_include' => null,
  //       'is_views_visible' => null,
  //       'range' => null,
  //       'range_visible' => null,
  //       'is_ranking_visible' => null,
  //     );
  //   }else{
  //     return $instance;
  //   }
  // }
  function form($instance) {
    if(empty($instance)){
      $instance = array(
        'title_new' => null,
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
    $title_new = esc_attr($instance['title_new']);
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
    <p>
      <label for="<?php echo $this->get_field_id('title_new'); ?>">
      <?php echo('新着記事のタイトル'); ?>
      </label>
      <input class="widefat" id="<?php echo $this->get_field_id('title_new'); ?>" name="<?php echo $this->get_field_name('title_new'); ?>" type="text" value="<?php echo $title_new; ?>" />
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
      <?php echo('固定ページの表示（人気記事のみ）'); ?>
      </label><br />
      <input class="widefat" id="<?php echo $this->get_field_id('is_pages_include'); ?>" name="<?php echo $this->get_field_name('is_pages_include'); ?>" type="checkbox" value="on"<?php echo ($is_pages_include ? ' checked="checked"' : ''); ?> />ランキングに固定ページを含める
    </p>
    <?php //集計単位の指定 ?>
    <p>
      <label for="<?php echo $this->get_field_id('range'); ?>">
      <?php echo('集計単位（人気記事のみ）'); ?>
      </label><br />
      <input class="widefat" id="<?php echo $this->get_field_id('range'); ?>" name="<?php echo $this->get_field_name('range'); ?>" type="radio" value="daily"<?php echo ($range == 'daily' ? ' checked="checked"' : ''); ?> />1日<br />
      <input class="widefat" id="<?php echo $this->get_field_id('range'); ?>" name="<?php echo $this->get_field_name('range'); ?>" type="radio" value="weekly"<?php echo ($range == 'weekly' ? ' checked="checked"' : ''); ?> />1週間<br />
      <input class="widefat" id="<?php echo $this->get_field_id('range'); ?>" name="<?php echo $this->get_field_name('range'); ?>" type="radio" value="monthly"<?php echo ($range == 'monthly' ? ' checked="checked"' : ''); ?> />1ヶ月<br />
      <input class="widefat" id="<?php echo $this->get_field_id('range'); ?>" name="<?php echo $this->get_field_name('range'); ?>" type="radio" value="all"<?php echo ($range == null || $range == 'all' ? ' checked="checked"' : ''); ?> />全期間<br />
    </p>
    <?php //集計単位の表示 ?>
    <p>
      <label for="<?php echo $this->get_field_id('range_visible'); ?>">
      <?php echo('集計期間の表示（人気記事のみ）'); ?>
      </label><br />
      <input class="widefat" id="<?php echo $this->get_field_id('range_visible'); ?>" name="<?php echo $this->get_field_name('range_visible'); ?>" type="checkbox" value="on"<?php echo ($range_visible ? ' checked="checked"' : ''); ?> />集計単位の表示
    </p>
    <?php //閲覧数の表示 ?>
    <p>
      <label for="<?php echo $this->get_field_id('is_views_visible'); ?>">
      <?php echo('閲覧数の表示（人気記事のみ）'); ?>
      </label><br />
      <input class="widefat" id="<?php echo $this->get_field_id('is_views_visible'); ?>" name="<?php echo $this->get_field_name('is_views_visible'); ?>" type="checkbox" value="on"<?php echo ($is_views_visible ? ' checked="checked"' : ''); ?> />閲覧数の表示
    </p>
    <?php //ランキング順位の表示 ?>
    <p>
      <label for="<?php echo $this->get_field_id('is_ranking_visible'); ?>">
      <?php echo('ランキング順位の表示（人気記事のみ）'); ?>
      </label><br />
      <input class="widefat" id="<?php echo $this->get_field_id('is_ranking_visible'); ?>" name="<?php echo $this->get_field_name('is_ranking_visible'); ?>" type="checkbox" value="on"<?php echo ($is_ranking_visible ? ' checked="checked"' : ''); ?> />ランキング順位の表示
    </p>
    <?php //除外する投稿ID（カンマ区切りで指定） ?>
    <p>
       <label for="<?php echo $this->get_field_id('exclude_ids'); ?>">
       <?php echo('除外する投稿ID（カンマ区切りで指定。※Popular Posts使用時のみ）'); ?>
       </label>
       <input class="widefat" id="<?php echo $this->get_field_id('exclude_ids'); ?>" name="<?php echo $this->get_field_name('exclude_ids'); ?>" type="text" value="<?php echo $exclude_ids; ?>" />
    </p>
    <?php
  }
}
add_action('widgets_init', create_function('', 'return register_widget("SimplicityNewPopularWidgetItem");'));