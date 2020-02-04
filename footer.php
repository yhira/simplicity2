            </div><!-- /#main -->
          </main>
        <?php get_sidebar(); ?>

        </div><!-- /#body-in -->
      </div><!-- /#body -->

      <!-- footer -->
      <footer itemscope itemtype="https://schema.org/WPFooter">
        <div id="footer" class="main-footer">
          <div id="footer-in">

            <?php //フッターにウィジェットが一つも入っていない時とモバイルの時は表示しない
            if ( (is_active_sidebar('footer-left') ||
              is_active_sidebar('footer-center') ||
              is_active_sidebar('footer-right') ) &&
              !is_mobile() ): ?>
            <div id="footer-widget" class="footer-widget nwa">
               <div class="footer-left">
               <?php if ( dynamic_sidebar('footer-left') ) : else : ?>
               <?php endif; ?>
               </div>
               <div class="footer-center">
               <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('footer-center') ) : else : ?>
               <?php endif; ?>
               </div>
               <div class="footer-right">
               <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('footer-right') ) : else : ?>
               <?php endif; ?>
               </div>
            </div>
          <?php endif; ?>

          <div class="clear"></div>
            <div id="copyright" class="wrapper">
              <?php //フッターメニューの設定
              if ( has_nav_menu('footer-navi') ): ?>
              <div id="footer-navi">
                <div id="footer-navi-in">
                  <?php wp_nav_menu( array( 'theme_location' => 'footer-navi' ) ); ?>
                  </div>
              </div>
              <?php endif ?>
              <div class="credit">
                <?php echo get_site_license(); //サイトのライセンス表記の取得 ?>
              </div>

              <?php if ( is_local_test() && is_responsive_test_visible() ): //ローカルかつ設定で表示になっている場合のみ?>
                <br /><a href="<?php echo get_template_directory_uri().'/responsive-test/?'.get_this_page_url(); ?>" target="_blank" rel="nofollow">レスポンシブテスト</a>
              <?php endif; ?>
            </div>
        </div><!-- /#footer-in -->
        </div><!-- /#footer -->
      </footer>
      <?php get_template_part('button-go-to-top'); //トップへ戻るボタンテンプレート?>
      <?php get_template_part('buttons-footer-mobile'); //フッターモバイルボタンのテンプレート?>
    </div><!-- /#container -->
    <?php wp_footer(); ?>
    <?php get_template_part('footer-custom-field');//カスタムフィールドの挿入（カスタムフィールド名：footer_custom）?>
    <?php get_template_part('footer-slicknav'); //SlickNav用のテンプレート（ツリー式モバイル用メニュー）?>
    <?php get_template_part('footer-javascript'); //フッターで呼び出すJavaScript用のテンプレート?>
    <?php get_template_part('analytics'); //アクセス解析用テンプレート?>
    <?php get_template_part('footer-insert'); //</body>手前のフッターにタグを挿入したいとき用のテンプレート?>
  </body>
</html>
