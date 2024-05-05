<?php

// Register this widget.
YF_Admin_Menu_Cleanup_Widget::register();

/**
 * Widget to clean the Admin Menu.
 */
class YF_Admin_Menu_Cleanup_Widget extends YF_Widget {
  /**
   * The ID of this widget.
   */
  protected static $id = 'yf_admin_menu_cleanup_widget';

  /**
   * The class name of this widget.
   */
  protected static $className = 'YF_Admin_Menu_Cleanup_Widget';

  /**
   * Hook to register this widget to.
   */
  protected static $hookAction = 'wp_before_admin_bar_render';

  /**
   * List of unwanted menu entries.
   */
  private static $excludedMenus = [
    "menu-toggle",
    "wp-logo",
    "updates",
    "comments",
    "new-content",
  ];

  /**
   * Removes the unwanted menu entries from the admin menu.
   */
  public static function init() {
    global $wp_admin_bar;

    $nodes = $wp_admin_bar->get_nodes();
    foreach ($nodes as $menu) {
      if (in_array($menu->id, self::$excludedMenus)) {
        $wp_admin_bar->remove_menu($menu->id);
      }
    }
  }

}