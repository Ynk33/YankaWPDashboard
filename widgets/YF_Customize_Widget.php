<?php

// Register this Widget.
YF_Customize_Widget::register();

/**
 * Widget to display useful links to access the different parts of YankaForge customization.
 */
class YF_Customize_Widget extends YF_Widget {
  /**
   * The ID of this widget.
   */
  protected static $id = 'yf_customize_widget';

  /**
   * The title of this widget.
   */
  protected static $title = 'Quick links';

  /**
   * The class name of this widget.
   */
  protected static $className = 'YF_Customize_Widget';

  /**
   * The context of this widget (normal, side, column3, column4).
   */
  protected static $context = 'side';

  /**
   * Render this widget.
   */
  public static function render() {
    ?>

    <h1>Welcome to <?php echo bloginfo( 'name' ); ?></h1>

    <p>
      <i>Here you can access the different part to customize the content of your website.</i>
    </p>

    <h2>Pictures</h2>

    <ul>
      <li><a href="<?php echo admin_url( "post.php?post=248&action=edit" ); ?>" class="button">Modify the highlights</a></li>
      <li><a href="<?php echo admin_url( "edit.php?post_type=gallery" ); ?>" class="button">Modify the galleries</a></li>
    </ul>

    <h2>Content</h2>

    <p>
      <a href="<?php echo admin_url('/customize.php?return=%2Fwp-admin%2Findex.php'); ?>" class="button">Modify the content of your website</a>
    </p>

    <?php
  }

}