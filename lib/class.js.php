<?php
class AECJS {
		public static function output_js( $handler, $dependencies = array(), $in_footer = false ) {
			AECJS::get_js( $handler, $dependencies, $in_footer ); //echo out
		} //end output_js
		
		public static function get_js( $handler, $dependencies, $in_footer ) {
			global $aecomments;
			$min = $aecomments->get_admin_option( 'compressed_scripts' ) == 'true' ? ".min" : '';
			$load_footer = ($aecomments->get_admin_option( 'scripts_in_footer' ) == "true" ? true: false);

			switch ( $handler ) {
				case "wp_ajax_edit_comments_script": /* Allows editing of icon items */
					wp_enqueue_script( $handler, $aecomments->get_plugin_url( "/js/wp-ajax-edit-comments$min.js" ), $dependencies, $aecomments->get_version(), $in_footer );
					wp_localize_script( $handler, 'wpajaxeditcomments', AECDependencies::get_js_vars() );
					break;
				case "admin": /* Admin panel scripts */
					//Admin panel sortables and tabs
					include( $aecomments->get_plugin_dir( '/js/admin-panel.js' ) );
					//Admin tab config
					include( $aecomments->get_plugin_dir( '/js/tab-config.js' ) );
					break;
				case "frontend": /* After the Deadline and Expand popup */
					$atdlang = "true";
					$afterthedeadline = ($aecomments->get_admin_option( 'after_deadline_posts' ) == "true" ? true : false);
					if (!$afterthedeadline) {
						$atdlang = "false";
					}	
					$aec_frontend = 	$aecomments->get_admin_option( 'use_wpload' ) == 'true' ? $aecomments->get_plugin_url( '/views/comment-popup.php' ) : site_url( '/?aec_page=comment-popup.php' );
					AECUtility::js_localize('aec_frontend', array('atdlang' => $atdlang, 'atd' => $aecomments->get_admin_option( 'after_deadline_posts' ),'expand' => $aecomments->get_admin_option( 'expand_posts' ),'url' => $aec_frontend, 'title' => __('Comment Box', 'ajaxEdit')), true );
					include( $aecomments->get_plugin_dir( 'js/jquery.atd.textarea.js' ) );
					include( $aecomments->get_plugin_dir( 'js/frontend.js' ) );
					break;
				case "popups":
					$atdlang = "true";
					$afterthedeadline = ($aecomments->get_admin_option( 'after_deadline_posts' ) == "true" ? true : false);
					if (!$afterthedeadline) {
						$atdlang = "false";
					}	
					AECUtility::js_localize('wpajaxeditcommentedit',AECDependencies::get_js_vars(), true);
					AECUtility::js_localize('aec_popup', array('atdlang' => $atdlang, 'atd' => $aecomments->get_admin_option( 'after_deadline_posts' ),'expand' => $aecomments->get_admin_option( 'expand_posts' ), 'title' => __('Comment Box', 'ajaxEdit')), true );
					//Include the various interfaces
					include( $aecomments->get_plugin_dir( "/js/comment-editor{$min}.js" ) );
					include( $aecomments->get_plugin_dir( "/js/blacklist-comment{$min}.js" ) );
					include( $aecomments->get_plugin_dir( "/js/comment-popup{$min}.js" ) );
					include( $aecomments->get_plugin_dir( "/js/email{$min}.js" ) );
					include( $aecomments->get_plugin_dir( "/js/move-comment{$min}.js" ) );
					include( $aecomments->get_plugin_dir( "/js/request-deletion{$min}.js" ) );
					
					$afterthedeadline = ($aecomments->get_admin_option( 'after_deadline_popups' ) == "true"  ? true : false);
					if ($afterthedeadline) {
						include( $aecomments->get_plugin_dir( '/js/jquery.atd.textarea.js' ) );
					}
					include( $aecomments->get_plugin_dir( '/js/jquery.tools.min.js' ) );
					include( $aecomments->get_plugin_dir( '/js/tab-config.js' ) );
					break;
			} //end switch
		} //end get_interface_css
		
} //end AECJS
