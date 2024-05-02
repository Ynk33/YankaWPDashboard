<?php 

/**
 * Abstract class to create new widgets.
 */
class YF_Widget {
  /**
   * The ID of this widget.
   */
  protected static $id = 'yf_widget';

  /**
   * The title of this widget.
   */
  protected static $title = 'YF Widget';

  /**
   * The class name of this widget.
   */
  protected static $className = 'YF_Widget';

  /**
   * The context of this widget (normal, side, column3, column4).
   */
  protected static $context = 'normal';

  /**
   * The priority of this widget (high, core, default, low).
   */
  protected static $priority = 'default';

  /**
   * Sets up this widget.
   */
  protected static function setup() {
  }

  /**
   * Register this widget.
   */
  public static function register() {
    // Sets up this widget.
    static::setup();

    // Hook to wp_dashboard_setup to register this widget.
    add_action( 'wp_dashboard_setup', [ static::$className, 'init' ] );
  }

  /**
   * Hook to wp_dashboard_setup to add this widget.
   */
  public static function init() {
    wp_add_dashboard_widget(
      static::$id,
      esc_html__( static::$title, 'yankaforge' ),
      [ static::$className, 'render' ],
      null,
      null,
      static::$context,
      static::$priority
    );
  }

  /**
   * Renders this widget.
   */
  public static function render() {
  }
}