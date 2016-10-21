<?php
   /**
    * Plugin Name: My System Date
    * Plugin URI: https://gitdevs.com/
    * Description: This plugin adds the system Date
    * Version: 1.0.0
    * Author: Dnyanesh
    * Author https://www.gitdevs.com/
    * License: GPL2
    */
   
   
    /* Registers and enqueues admin-specific JavaScript.
      */
    function admin_custom_script(){
     wp_deregister_script('jquery'); 
     wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js', false, '1.8.3'); 
     wp_enqueue_script('jquery');
   }
   add_action( 'wp_enqueue_scripts', 'admin_custom_script' );
   
   
    
   function sysdate_plugin_setup_menu(){
           add_submenu_page( 'options-general.php','My Sys Date', 'MY System Date', 'manage_options', 'test-plugin', 'test_init' );
   }
   
   add_action('admin_menu', 'sysdate_plugin_setup_menu');
   
   function test_init(){
           echo "<h1 class='sys-title'>My System Date</h1>";
   
           // the date / day / time from users system.
           echo "<h3 class='sys-subtitle'>Today Date and Time</h3>";
           echo "<p class='systime-date'>".date( "F j, Y / l g:i", current_time( 'timestamp', 0 ) )."</p>";
           
          // Shortcode to display in admin area.
   		echo "<h2>Please use bellow shortcode to print the day of users system.</h2>";
           echo "<p class='sysshortcode'>[systemday]</p>";
           echo"<br/>";
           echo '<h4>"Enjoy Your ';
           echo do_shortcode('[systemday]');
           echo '!"</h4>';
   
           //On // Off button to show hide text at the end of post
            echo '<h3 class="sys-btn">ON/OFF to show hide string "Enjoy your" at end of post</h3>';
   
            ?>
<form name="">
   <input type="radio" id="r1" name="radiobtn" value="ON">ON
   <input type="radio" id="r2" name="radiobtn" value="OFF">OFF
</form>
<?php
}
// Shortocde to print the day of users system.
function usersysday(){
echo date("l");
}
add_shortcode('systemday','usersysday');
//- At the end of every single blog post, print Day!
function add_sysday($content){
if(is_single()) {
$content.= '<span class="enjoy-string"><strong>Enjoy your </span><span class="bottom-sysday">'.date("l").'<strong></span>';
}
return $content;
}
add_filter ('the_content', 'add_sysday');
