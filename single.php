<?php //AMP表示するかの判別
if ( is_amp() ) {
  get_template_part('single-amp');
} else {
  get_template_part('single-page');
}
?>