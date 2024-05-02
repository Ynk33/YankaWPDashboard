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
   * Sets up this widget.
   */
  protected static function setup() {
  }

  /**
   * Register this widget.
   */
  public static function register() {
    add_action( 'wp_dashboard_setup', [ static::$className, 'init' ] );
  }

  /**
   * Hook to wp_dashboard_setup to add the widget.
   */
  public static function init() {

    static::setup();

    wp_add_dashboard_widget(
      static::$id,
      esc_html__( static::$title, 'yankaforge' ),
      [ static::$className, 'render' ]
    );
  }

  /**
   * Renders this widget.
   */
  public static function render() {
  }
}