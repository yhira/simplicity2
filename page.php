<?php //AMP表示するかの判別
if ( is_amp() ) {
  get_template_part('page-amp');
} else {
  get_template_part('page-page');
}
?>