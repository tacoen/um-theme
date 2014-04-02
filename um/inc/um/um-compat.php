<?php
/* will not included if you had UM-PLUG */

if (!function_exists(um_getoption)) { 

	function um_getoption($w) {
		$umo->options=get_option('umo');
		if (in_array($w,array_keys($umo->options))) {
			return $umo->options[$w];
		}
	}
	function um_get_themeoption($w) {
		$umt->options=get_option('umt');
		if (in_array($w,array_keys($umt->options))) {
			return $umt->options[$w];
		}
	}
	function um_tool_which($file) {
		if (file_exists(get_stylesheet_directory()."/".$file)) {
			return get_stylesheet_directory_uri()."/".$file;
		} else {
			return get_template_directory_uri()."/".$file;
		}
	}
	function umtag($func,$args=array()) {
	if (um_getoption('umtag')) {
		if (! function_exists($func)) {
			$ttdir=get_template_directory()."/template-tags/";
				if (file_exists($ttdir.$func.".php")) {
					require $ttdir.$func.".php"; call_user_func_array($func,array($args));
				} else {
					echo "<!-- umtag: $func not exist --->";
				}
			} else {
				call_user_func_array($func,array($args));
			}
		} else {
			echo "<!-- umtag: disable --->";
		}
	}

}
?>