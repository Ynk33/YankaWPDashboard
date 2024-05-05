<?php 

/**
 * Abstract class to create new widgets.
 */
class YF_Widget {

  /**
   * The registered custom widgets.
   */
  protected static $yf_widgets = [];

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
   * Hook to register this widget to.
   */
  protected static $hookAction = 'wp_dashboard_setup';

  /**
   * Priority for the hook which this widget has to be registered on.
   */
  protected static $hookPriority = 10;

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

    // Hook to $hookAction to register this widget.
    add_action( static::$hookAction, [ static::$className, 'init' ], static::$hookPriority );

    // Save the registered widget.
    self::save(static::$id, static::$context, static::$priority);
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

  /**
   * Saves a registered custom widget.
   */
  private static function save($id, $context, $priority) {
    self::$yf_widgets[] = $id;
  }
}