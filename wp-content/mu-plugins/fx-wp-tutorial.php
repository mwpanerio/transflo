<?php 

/**
 * Plugin Name: WebFX WordPress Tutorial 
 * Description: This plugin is designed to add the WebFX WordPress tutorial to the admin view. 
 * Author:      WebFX team
 */


function custom_menu() { 
  add_menu_page( 
      'How-To Guide', 
      'How-To Guide', 
      'edit_posts', 
      'webfx_wp_tutorial', 
      'google_drive_plugin', 
      'dashicons-lightbulb',
      '3'
    );
}
add_action('admin_menu', 'custom_menu');

// fail safe in case of redirect not functioning
if ( !function_exists("google_drive_plugin") ) { 
    function google_drive_plugin() {
        ?> <h1> WordPress How-Guide by the team at WebFX </h1>
        
            <p><a href="https://wordpressguide.webfx.com" target="_blank">Click me!</a></p>
        <?php
    }
}

function adding_tutorial() {
  ?>
  <script>
    (function($) {
      $('a.toplevel_page_webfx_wp_tutorial').attr("href", "https://wordpressguide.webfx.com");
      $('a.toplevel_page_webfx_wp_tutorial').attr("target","_blank");
    })(jQuery);
  </script>
  <?php
}
add_action('admin_footer', 'adding_tutorial' );