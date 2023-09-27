<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class FAEASYPDF_Settings {

	private static $_instance = null;
	public $parent = null;
	public $_token;
	public $base = '';
	public $settings = array();

	public function __construct ( $parent ) {

		$this->parent = $parent;

		$this->base = 'FAEASYPDF_';

		// Initialise settings
		add_action( 'init', array( $this, 'init_settings' ), 11 );

		// Register plugin settings
		add_action( 'admin_init' , array( $this, 'register_settings' ) );

		// Add settings page to menu
		add_action( 'admin_menu' , array( $this, 'add_menu_item' ) );

		// Add settings link to plugins page
		add_filter( 'plugin_action_links_' . plugin_basename( FAEASYPDF_PLUGIN_FILE ) , array( $this, 'add_settings_link' ) );

	}

	/**
	 * Initialise settings
	 * @return void
	 */
	public function init_settings () {
		$this->settings = $this->settings_fields();
	}

	/**
	 * Adds DK PDF admin menu
	 * @return void
	 */
	public function add_menu_item () {

		// main menu
		$page = add_menu_page( 'Easy WP To PDF', 'Easy WP To PDF', 'manage_options', 'faeasypdf' . '_settings',  array( $this, 'settings_page' ) );

		// Addons submenu
		add_submenu_page( 'faeasypdf' . '_settings', 'Addons', 'Addons', 'manage_options', 'faeasypdf-addons', array( $this, 'faeasypdf_addons_screen' ));

		// settings assets
		add_action( 'admin_print_styles-' . $page, array( $this, 'settings_assets' ) );

	}

	/*
	public function faeasypdf_addons_screen() { ?>

		<div class="wrap">
			<h2>DK PDF Addons</h2>

			<div class="faeasypdf-item">
				<h3>Frantic Ape's PDF Generator</h3>
				<p>Allows creating PDF documents with your selected WordPress content, also allows adding a Cover and a Table of contents.</p>
				<! -- <p><a href="https://codecanyon.net/item/fa-easypdf-generator/13530581" target="_blank">Go to PDF Generator</a></p> -->
			</div>

		</div>

	<?php }
*/

	/**
	 * Load settings JS & CSS
	 * @return void
	 */
	public function settings_assets () {

		// We're including the farbtastic script & styles here because they're needed for the colour picker
		// If you're not including a colour picker field then you can leave these calls out as well as the farbtastic dependency for the faeasypdf-admin-js script below
		wp_enqueue_style( 'farbtastic' );
    	wp_enqueue_script( 'farbtastic' );

    	// We're including the WP media scripts here because they're needed for the image upload field
    	// If you're not including an image upload then you can leave this function call out
    	wp_enqueue_media();

    	wp_register_script( 'faeasypdf' . '-settings-js', plugins_url( 'fa-easypdf/assets/js/settings-admin.js' ), array( 'farbtastic', 'jquery' ), '1.0.0' );
    	wp_enqueue_script( 'faeasypdf' . '-settings-js' );
	}

	/**
	 * Add settings link to plugin list table
	 * @param  array $links Existing links
	 * @return array 		Modified links
	 */
	public function add_settings_link ( $links ) {
		$settings_link = '<a href="admin.php?page=' . 'faeasypdf' . '_settings">' . __( 'Settings', 'faeasypdf' ) . '</a>';
  		array_push( $links, $settings_link );
  		return $links;
	}

	/**
	 * Build settings fields
	 * @return array Fields to be displayed on settings page
	 */
	private function settings_fields () {

		$post_types_arr = faeasypdf_get_post_types();

		// pdf button settings
		$settings['pdfbtn'] = array(
			'title'					=> __( 'PDF Button', 'faeasypdf' ),
			'description'			=> '',
			'fields'				=> array(
				array(
					'id' 			=> 'pdfbutton_text',
					'label'			=> __( 'Button text' , 'faeasypdf' ),
					'description'	=> '',
					'type'			=> 'text',
					'default'		=> 'PDF Button',
					'placeholder'	=> ''
				),
				array(
					'id' 			=> 'pdfbutton_post_types',
					'label'			=> __( 'Post types to apply:', 'faeasypdf' ),
					'description'	=> '',
					'type'			=> 'checkbox_multi',
					'options'		=> $post_types_arr,
					'default'		=> array()
				),
				array(
					'id' 			=> 'pdfbutton_action',
					'label'			=> __( 'Action', 'faeasypdf' ),
					'description'	=> '',
					'type'			=> 'radio',
					'options'		=> array( 'open' => 'Open PDF in new Window', 'download' => 'Download PDF directly' ),
					'default'		=> 'open'
				),
				array(
					'id' 			=> 'pdfbutton_position',
					'label'			=> __( 'Position', 'faeasypdf' ),
					'description'	=> '',
					'type'			=> 'radio',
					'options'		=> array( 'shortcode' => 'Use shortcode', 'before' => 'Before content', 'after' => 'After content' ),
					'default'		=> 'before'
				),
				array(
					'id' 			=> 'pdfbutton_align',
					'label'			=> __( 'Align', 'faeasypdf' ),
					'description'	=> '',
					'type'			=> 'radio',
					'options'		=> array( 'left' => 'Left', 'center' => 'Center', 'right' => 'Right' ),
					'default'		=> 'right'
				),
			)
		);


		// pdf setup
		$settings['faeasypdf_setup'] = array(
			'title'					=> __( 'PDF Setup', 'faeasypdf' ),
			'description'			=> '',
			'fields'				=> array(
				array(
					'id' 			=> 'page_orientation',
					'label'			=> __( 'Page orientation', 'faeasypdf' ),
					'description'	=> '',
					'type'			=> 'radio',
					'options'		=> array( 'vertical' => 'Vertical', 'horizontal' => 'Horizontal' ),
					'default'		=> 'vertical'
				),
				array(
					'id' 			=> 'font_size',
					'label'			=> __( 'Font size', 'faeasypdf' ),
					'description'	=> 'In points (pt)',
					'type'			=> 'number',
					'default'		=> '12',
					'placeholder'	=> '12'
				),
				array(
					'id' 			=> 'margin_left',
					'label'			=> __( 'Margin left', 'faeasypdf' ),
					'description'	=> 'In points (pt)',
					'type'			=> 'number',
					'default'		=> '15',
					'placeholder'	=> '15'
				),
				array(
					'id' 			=> 'margin_right',
					'label'			=> __( 'Margin right', 'faeasypdf' ),
					'description'	=> 'In points (pt)',
					'type'			=> 'number',
					'default'		=> '15',
					'placeholder'	=> '15'
				),
				array(
					'id' 			=> 'margin_top',
					'label'			=> __( 'Margin top', 'faeasypdf' ),
					'description'	=> 'In points (pt)',
					'type'			=> 'number',
					'default'		=> '50',
					'placeholder'	=> '50'
				),
				array(
					'id' 			=> 'margin_bottom',
					'label'			=> __( 'Margin bottom', 'faeasypdf' ),
					'description'	=> 'In points (pt)',
					'type'			=> 'number',
					'default'		=> '30',
					'placeholder'	=> '30'
				),
				array(
					'id' 			=> 'margin_header',
					'label'			=> __( 'Margin header', 'faeasypdf' ),
					'description'	=> 'In points (pt)',
					'type'			=> 'number',
					'default'		=> '15',
					'placeholder'	=> '15'
				),
				array(
					'id' 			=> 'enable_protection',
					'label'			=> __( 'Enable PDF protection', 'faeasypdf' ),
					'description'	=> __( 'Encrypts PDF file and respects permissions given below', 'faeasypdf' ),
					'type'			=> 'checkbox',
					'default'		=> ''
				),
				array(
					'id' 			=> 'grant_permissions',
					'label'			=> __( 'Protected PDF permissions', 'faeasypdf' ),
					'description'	=> '',
					'type'			=> 'checkbox_multi',
					'options'		=> array( 'copy' => 'Copy', 'print' => 'Print', 'print-highres' => 'Print Highres', 'modify' => 'Modify', 'annot-forms' => 'Annot Forms', 'fill-forms' => 'Fill Forms', 'extract' => 'Extract', 'assemble' => 'Assemble' ),
					'default'		=> array()
				),
				array(
					'id' 			=> 'keep_columns',
					'label'			=> __( 'Keep columns', 'faeasypdf' ),
					'description'	=> 'Columns will be written successively (faeasypdf-columns shortcode). i.e. there will be no balancing of the length of columns.',
					'type'			=> 'checkbox',
					'default'		=> ''
				),
			)
		);

		// header & footer settings
		$settings['pdf_header_footer'] = array(
			'title'	=> __( 'PDF Header & Footer', 'faeasypdf' ),
			'description'			=> '',
			'fields'				=> array(
				array(
					'id' 			=> 'pdf_header_image',
					'label'			=> __( 'Header logo' , 'faeasypdf' ),
					'description'	=> '',
					'type'			=> 'image',
					'default'		=> '',
					'placeholder'	=> ''
				),
				array(
					'id' 			=> 'pdf_header_show_title',
					'label'			=> __( 'Header show title', 'faeasypdf' ),
					'description'	=> '',
					'type'			=> 'checkbox',
					'default'		=> ''
				),
				array(
					'id' 			=> 'pdf_header_show_pagination',
					'label'			=> __( 'Header show pagination', 'faeasypdf' ),
					'description'	=> '',
					'type'			=> 'checkbox',
					'default'		=> ''
				),
				array(
					'id' 			=> 'pdf_footer_text',
					'label'			=> __( 'Footer text' , 'faeasypdf' ),
					'description'	=> __( 'HTML tags: a, br, em, strong, hr, p, h1 to h4', 'faeasypdf' ),
					'type'			=> 'textarea',
					'default'		=> '',
					'placeholder'	=> ''
				),
				array(
					'id' 			=> 'pdf_footer_show_title',
					'label'			=> __( 'Footer show title', 'faeasypdf' ),
					'description'	=> '',
					'type'			=> 'checkbox',
					'default'		=> ''
				),
				array(
					'id' 			=> 'pdf_footer_show_pagination',
					'label'			=> __( 'Footer show pagination', 'faeasypdf' ),
					'description'	=> '',
					'type'			=> 'checkbox',
					'default'		=> ''
				),

			)
		);

		// style settings
		$settings['pdf_css'] = array(
			'title'	=> __( 'PDF CSS', 'faeasypdf' ),
			'description'			=> '',
			'fields'				=> array(
				array(
					'id' 			=> 'pdf_custom_css',
					'label'			=> __( 'PDF Custom CSS' , 'faeasypdf' ),
					'description'	=> __( '', 'faeasypdf' ),
					'type'			=> 'textarea_code',
					'default'		=> '',
					'placeholder'	=> ''
				),
				array(
					'id' 			=> 'print_wp_head',
					'label'			=> __( 'Use current theme\'s CSS', 'faeasypdf' ),
					'description'	=> __( 'Includes the stylesheet from current theme, but is overridden by PDF Custom CSS and plugins adding its own stylesheets.', 'faeasypdf' ),
					'type'			=> 'checkbox',
					'default'		=> ''
				),
			)
		);

		$settings = apply_filters( 'faeasypdf' . '_settings_fields', $settings );

		return $settings;

	}

	/**
	 * Register plugin settings
	 * @return void
	 */
	public function register_settings () {
		if ( is_array( $this->settings ) ) {

			// Check posted/selected tab
			$current_section = '';
			if ( isset( $_POST['tab'] ) && $_POST['tab'] ) {
				$current_section = $_POST['tab'];
			} else {
				if ( isset( $_GET['tab'] ) && $_GET['tab'] ) {
					$current_section = $_GET['tab'];
				}
			}

			foreach ( $this->settings as $section => $data ) {

				if ( $current_section && $current_section != $section ) continue;

				// Add section to page
				add_settings_section( $section, $data['title'], array( $this, 'settings_section' ), 'faeasypdf' . '_settings' );

				foreach ( $data['fields'] as $field ) {

					// Validation callback for field
					$validation = '';
					if ( isset( $field['callback'] ) ) {
						$validation = $field['callback'];
					}

					// Register field
					$option_name = $this->base . $field['id'];
					register_setting( 'faeasypdf' . '_settings', $option_name, $validation );

					// Add field to page
					add_settings_field( $field['id'], $field['label'], array( $this->parent->admin, 'display_field' ), 'faeasypdf' . '_settings', $section, array( 'field' => $field, 'prefix' => $this->base ) );
				}

				if ( ! $current_section ) break;
			}
		}
	}

	public function settings_section ( $section ) {
		$html = '<p> ' . $this->settings[ $section['id'] ]['description'] . '</p>' . "\n";
		echo $html;
	}

	/**
	 * Load settings page content
	 * @return void
	 */
	public function settings_page () {

		if( isset( $_GET['settings-updated']) ) { ?>
		    <div id="message" class="updated">
		        <p><?php _e('Settings saved.', 'faeasypdf');?></p>
		    </div>
		<?php }

		// Build page HTML
		$html = '<div class="wrap" id="' . 'faeasypdf' . '_settings">' . "\n";
			$html .= '<h2>' . __( 'DK PDF Settings' , 'faeasypdf' ) . '</h2>' . "\n";

			$tab = '';
			if ( isset( $_GET['tab'] ) && $_GET['tab'] ) {
				$tab .= $_GET['tab'];
			}

			// Show page tabs
			if ( is_array( $this->settings ) && 1 < count( $this->settings ) ) {

				$html .= '<h2 class="nav-tab-wrapper">' . "\n";

				$c = 0;
				foreach ( $this->settings as $section => $data ) {

					// Set tab class
					$class = 'nav-tab';
					if ( ! isset( $_GET['tab'] ) ) {
						if ( 0 == $c ) {
							$class .= ' nav-tab-active';
						}
					} else {
						if ( isset( $_GET['tab'] ) && $section == $_GET['tab'] ) {
							$class .= ' nav-tab-active';
						}
					}

					// Set tab link
					$tab_link = add_query_arg( array( 'tab' => $section ) );
					if ( isset( $_GET['settings-updated'] ) ) {
						$tab_link = remove_query_arg( 'settings-updated', $tab_link );
					}

					// Output tab
					$html .= '<a href="' . $tab_link . '" class="' . esc_attr( $class ) . '">' . esc_html( $data['title'] ) . '</a>' . "\n";

					++$c;
				}

				$html .= '</h2>' . "\n";
			}

			$html .= '<form method="post" action="options.php" enctype="multipart/form-data">' . "\n";

				// Get settings fields
				ob_start();
				settings_fields( 'faeasypdf' . '_settings' );
				do_settings_sections( 'faeasypdf' . '_settings' );
				$html .= ob_get_clean();

				$html .= '<p class="submit">' . "\n";
					$html .= '<input type="hidden" name="tab" value="' . esc_attr( $tab ) . '" />' . "\n";
					$html .= '<input name="Submit" type="submit" class="button-primary" value="' . esc_attr( __( 'Save Settings' , 'faeasypdf' ) ) . '" />' . "\n";
				$html .= '</p>' . "\n";
			$html .= '</form>' . "\n";

		$html .= '</div>' . "\n";

		echo $html;
	}

	/**
	 * Main FAEASYPDF_Settings Instance
	 */
	public static function instance ( $parent ) {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self( $parent );
		}
		return self::$_instance;
	} // End instance()

	/**
	 * Cloning is forbidden.
	 */
	public function __clone () {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), $this->parent->_version );
	} // End __clone()

	/**
	 * Unserializing instances of this class is forbidden.
	 */
	public function __wakeup () {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), $this->parent->_version );
	} // End __wakeup()

}
