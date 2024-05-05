<?php

// Register this widget.
YF_Dashboard_Cleanup_Widget::register();

/**
 * Renderless widget to cleanup the dashboard from non-custom widgets.
 */
class YF_Dashboard_Cleanup_Widget extends YF_Widget {

  /**
   * List of Wordpress default widgets to keep for administrators.
   */
  private static $admin_widgets = [
    'dashboard_site_health',
    'dashboard_right_now',
    //'dashboard_activity',
    //'dashboard_quick_press',
    //'dashboard_primary',
  ];

  /**
   * The ID of this widget.
   */
  protected static $id = 'yf_dashboard_cleanup_widget';

  /**
   * The class name of this widget.
   */
  protected static $className = 'YF_Dashboard_Cleanup_Widget';

  /**
   * The context of this widget (normal, side, column3, column4).
   */
  protected static $context = 'normal';

  /**
   * The priority of this widget (high, core, default, low).
   */
  protected static $priority = 'high';

  /**
   * Remove the unwanted widgets from the dashboard.
   */
  public static function init() {
    global $wp_meta_boxes;
    $customWidgets = YF_Widget::$yf_widgets;


    if (!(isset($wp_meta_boxes['dashboard']) && is_array($wp_meta_boxes['dashboard']))) {
      return;
  }
    
    foreach ($wp_meta_boxes['dashboard'] as $context_key => $context) {
      if (!is_array($context)) continue;

      foreach ($context as $priority_key => $priority) {
        if (!is_array($priority)) continue;

        foreach ($priority as $widget_id => $widget) {
          //if (isset($customWidgets[$context_key][$priority_key][$widget_id])) {
          if (!in_array($widget_id, $customWidgets)) {
            unset($wp_meta_boxes['dashboard'][$context_key][$priority_key][$widget_id]);

            if (current_user_can('administrator') && in_array($widget_id, self::$admin_widgets)) {
              $wp_meta_boxes['dashboard']['column4']['core'][$widget_id] = $widget;
            }
          }
        }
      }
    }
  }
}