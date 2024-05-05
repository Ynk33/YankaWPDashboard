<?php

/*
Plugin Name:  YankaForge Wordpress Dashboard
Plugin URI:   https://github.com/Ynk33/YankaWPDashboard
Description:  A clean dashboard serving only the needs of the YankaWordpress theme.
Version:      1.0
Author:       Yannick Tirand
Author URI:   https://github.com/Ynk33
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/

// Register styles.
function yf_widgets_enqueue_styles() {
  wp_register_style( 'yf_widgets_style', plugins_url( 'style/yf-widgets-style.css', __FILE__ ) );
  wp_enqueue_style( 'yf_widgets_style' );
}
add_action( 'admin_enqueue_scripts', 'yf_widgets_enqueue_styles' );

// Widgets to include.
$widgets = [
  "Maintenance",
  "Check_Galleries",
  "Customize",
  "Messages",
  "Dashboard_Cleanup",
];

// Includes the custom widgets.
include('widgets/YF_Widget.php');
foreach ($widgets as $widget) {
  include ('widgets/YF_' . $widget . '_Widget.php');
}
