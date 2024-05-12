<?php

// Register this widget.
YF_Admin_Menu_Bar_Cleanup_Widget::register();

/**
 * Widget to clean the Admin Menu Bar.
 */
class YF_Admin_Menu_Bar_Cleanup_Widget extends YF_Widget {
  /**
   * The ID of this widget.
   */
  protected static $id = 'yf_admin_menu_bar_cleanup_widget';

  /**
   * The class name of this widget.
   */
  protected static $className = 'YF_Admin_Menu_Bar_Cleanup_Widget';

  /**
   * Hook to register this widget to.
   */
  protected static $hookAction = 'admin_init';

  /**
   * Priority for the hook which this widget has to be registered on.
   */
  protected static $hookPriority = 999999;

  /**
   * Menu entries to keep.
   */
  private static $allowedMenuEntries = [
    "menu-dashboard",
    "menu-posts-gallery",
    "menu-media",
    "menu-users",
  ];

  /**
   * Extra menu entries to keep if user is an administrator.
   */
  private static $allowedMenuEntriesAsAdmin = [
    "menu-appearance",
    "menu-plugins",
    "menu-users",
    "menu-tools",
    "menu-settings",
    "ACF",
  ];

  /**
   * Rest of the submenu entries to exclude.
   */
  private static $excludedSubmenuEntries = [
    "manage_post_tags",
  ];

  /**
   * Remove the unwanted entries from the Admin Menu Bar.
   */
  public static function init() {
    global $menu, $submenu;

    self::cleanMenu();
    self::cleanSubMenu();
  }

  /**
   * Cleans the first level of the Admin Menu Bar.
   */
  private static function cleanMenu() {
    global $menu;

    if (empty($menu)) return;

    $allowedEntries = self::$allowedMenuEntries;
    if (current_user_can( "administrator" )) {
      $allowedEntries = array_merge($allowedEntries, self::$allowedMenuEntriesAsAdmin);
    }

    foreach ($menu as $key => $entry) {

      if (!self::isMenuEntryAllowed($entry, $allowedEntries)) {
        
        unset($menu[$key]);
      }
    }
  }

  /**
   * Cleans the second level of the Admin Menu Bar.
   */
  private static function cleanSubMenu() {

    // Nothing to remove for administrators.
    if (current_user_can( "administrator")) return;

    global $submenu;

    $excludedEntries = self::$excludedSubmenuEntries;

    foreach ($submenu as $action => $submenuList) {
      foreach ($submenuList as $key => $entry) {
        if (in_array($entry[1], $excludedEntries)) {
          unset($submenuList[$key]);
          $submenu[$action] = $submenuList;
        }
      }
    }
  }

  /**
   * Determines if a menu entry is allowed.
   */
  private static function isMenuEntryAllowed($entry, $allowedEntries) {
    return $entry[0] == "" || // Check for separators
      in_array($entry[0], $allowedEntries) || // Compare entry name
      in_array($entry[5], $allowedEntries); // Compare entry class name.
  }
}