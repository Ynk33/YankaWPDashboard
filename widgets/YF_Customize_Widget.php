<?php

// Register this Widget;
YF_Customize_Widget::register();

class YF_Customize_Widget extends YF_Widget {
  /**
   * The ID of this widget.
   */
  protected static $id = 'yf_customize_widget';

  /**
   * The title of this widget.
   */
  protected static $title = 'Customize my website';

  /**
   * The class name of this widget.
   */
  protected static $className = 'YF_Customize_Widget';

  /**
   * Render this widget.
   */
  public static function render() {
    ?>

    <div>
      <p>If you need to make any changes to the design of your website, click here</p>
      <a href="<?php echo admin_url('/customize.php?return=%2Fwp-admin%2Findex.php'); ?>" class="button">Customize</a>
    </div>

    <?php
  }

}