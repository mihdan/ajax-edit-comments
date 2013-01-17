<?php
class AECAdmin {
		public static function add_admin_pages(){
			global $aecomments;
			$capabilities = 'administrator';
			if ( AECCore::is_multisite() ) $capabilities = 'manage_network';
			$admin_hooks = array();
			$admin_hooks[] = add_menu_page( 'Ajax Edit Comments', 'AEC', $capabilities, 'wpaec', array("AECAdmin", 'print_admin_page_behavior'), $aecomments->get_plugin_url( 'images/menu-icon.png' ) );
			$admin_hooks[] = add_submenu_page( 'wpaec', __( 'Behavior', 'wpAjax' ), __( 'Behavior', 'wpAjax' ), $capabilities, 'wpaec', array( 'AECAdmin', 'print_admin_page_behavior' ) );
			$admin_hooks[] = add_submenu_page( 'wpaec', __( 'Appearance', 'wpAjax' ), __( 'Appearance', 'wpAjax' ), $capabilities, 'aecappearance', array( 'AECAdmin', 'print_admin_page_appearance' ) );
			$admin_hooks[] = add_submenu_page( 'wpaec', __( 'Permissions', 'wpAjax' ), __( 'Permissions', 'wpAjax' ), $capabilities, 'aecpermissions', array( 'AECAdmin', 'print_admin_page_permissions' ) );
			$admin_hooks[] = add_submenu_page( 'wpaec', __( 'Cleanup', 'wpAjax' ), __( 'Cleanup', 'wpAjax' ), $capabilities, 'aeccleanup', array( 'AECAdmin', 'print_admin_page_cleanup' ) );

			
			foreach( $admin_hooks as $hook ) {
				add_action('admin_print_styles-' . $hook, array('AECDependencies', 'add_admin_panel_css'), 1000);
				add_action('admin_print_scripts-' . $hook, array('AECDependencies', 'add_admin_scripts'), 1000);
			}
			do_action('aec-addon-menus');
		}
		
		public static function print_admin_page_appearance() {
			die( 'appearance' );
		} //end print_admin_page_appearance
		
		public static function print_admin_page_behavior() {
			global $aecomments;
			include_once $aecomments->get_plugin_dir( '/views/admin-panel/behavior.php' );
		} //end print_admin_page_behavior
		
		public static function print_admin_page_cleanup() {
			die( 'cleanup' );
		} //end print_admin_page_cleanup
		
		public static function print_admin_page_permissions() {
			die( 'permissions' );
		}
		
}