<?php

// Register this Widget.
YF_Maintenance_Widget::register();

/**
 * Widget to toggle the Maintenance mode.
 */
class YF_Maintenance_Widget extends YF_Widget {
  
  /**
   * The ID of this widget.
   */
  protected static $id = 'yf_maintenance_widget';

  /**
   * The title of this widget.
   */
  protected static $title = 'Maintenance Mode';

  /**
   * The class name of this widget.
   */
  protected static $className = 'YF_Maintenance_Widget';

  /**
   * The context of this widget (normal, side, column3, column4).
   */
  protected static $context = 'normal';

  /**
   * The priority of this widget (high, core, default, low).
   */
  protected static $priority = 'high';

  /**
   * Action name to do when submitting the form.
   */
  private static $action = 'yf_maintenance_toggle';


  /**
   * Hook to wp_dashboard_setup to add the widget.
   */
  protected static function setup() {

    add_action( 'admin_action_' . self::$action, [self::$className, 'toggleMaintenanceMode'] );
  }
  
  /**
   * Renders this widget.
   */
  public static function render() {
    
    $maintenanceMod = get_theme_mod('yf_maintenance_toggle');
    ?>

    <form method="POST" action="<?php echo admin_url( 'admin.php' ); ?>">
      <input type="hidden" name="action" value="<?php echo self::$action; ?>"/>

      <p>
        The maintenance mode is now 
        <button type="submit"><span class="yf-maintenance-on <?php echo $maintenanceMod == 1 ? 'active' : ''; ?>">ON</span><span class="yf-maintenance-off <?php echo $maintenanceMod == 1 ? '' : 'active'; ?>">OFF</span></button>
      </p>

      <p class="yf-maintenance-message <?php echo $maintenanceMod == 1 ? 'active' : ''; ?>">
      <?php if ($maintenanceMod == 1) : ?>
        Your website is in maintenance mode. Users CANNOT visit your website.
      <?php else: ?>
        Your website is open. Users can visit your website.
      <?php endif; ?>
      </p>
    </form>

    <?php
  }

  /**
   * Update the Maintenance mode.
   */
  public static function toggleMaintenanceMode() {

    $maintenanceMod = get_theme_mod('yf_maintenance_toggle');
    set_theme_mod( 'yf_maintenance_toggle', $maintenanceMod == 1 ? 0 : 1);

    // Return to Dashboard.
    wp_redirect( $_SERVER['HTTP_REFERER'] );
    exit();
  }
}