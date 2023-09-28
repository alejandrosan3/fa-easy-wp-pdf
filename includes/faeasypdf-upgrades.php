<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
* adds dashboard page 
*/
function faeasypdf_welcome_screen_page(){
    add_dashboard_page('Easy WP to PDF Welcome', 'Easy WP to PDF Welcome', 'manage_options', 'faeasypdf-welcome', 'faeasypdf_welcome_page');
}

// output faeasypdf-welcome dashboard page 
function faeasypdf_welcome_page(){ ?>

    <div class="wrap">

      <h1>Welcome to Easy WP to PDF <?php echo FAEASYPDF_VERSION;?></h1>
      <h2 style="font-size:140%;">What's new in this version:</h2>
      <ul>
        <li>
          <h3 style="margin-top:20px;">FA Easy WP to PDF admin menu</h3>
          <?php 
            $img1 = plugins_url( 'assets/images/faeasypdf-admin-menu.jpg', faeasypdf_PLUGIN_FILE );
          ?>
          <img style="margin-bottom:20px;width:100%;height:auto;"src="<?php echo $img1;?>">
        </li>
        <li>
          <h3 style="margin-top:20px;">PDF Setup tab for adjusting page orientation, font size and margins of the PDF</h3>
          <?php 
            $img2 = plugins_url( 'assets/images/faeasypdf-setup-tab.jpg', faeasypdf_PLUGIN_FILE );
          ?>
          <img style="margin-bottom:20px;width:100%;height:auto;"src="<?php echo $img2;?>">
        </li>
        <li>
          <h3 style="margin-top:20px;">[faeasypdf-remove] shortcode for removing pieces of content in the generated PDF</h3></li>
          <p><a href="https://franticape.com/demos/faeasypdf/doc/faeasypdf-remove-shortcode/" target="_blank">See more info here</a></p>
      </ul>

    </div>

<?php }

add_action('admin_menu', 'faeasypdf_welcome_screen_page');

/**
* Fires when plugin is activated or upgraded
*/
function faeasypdf_welcome_redirect( $plugin ) {

   if( $plugin == 'fa-easypdf/fa-easypdf.php' ) {

       wp_redirect( admin_url( 'index.php?page=faeasypdf-welcome' ) );
       die();

   }
}

add_action( 'activated_plugin', 'faeasypdf_welcome_redirect' );

/**
* removes faeasypdf-welcome link in Dashboard submenu 
*/
function faeasypdf_remove_menu_entry(){
    remove_submenu_page( 'index.php', 'faeasypdf-welcome' );
}

add_action( 'admin_head', 'faeasypdf_remove_menu_entry' );








