<?php
/* will not included if you had UM-PLUG */

if (!function_exists('um_rwvar_default')) { 
	function um_rwvar_default() {
		return array(
			'wpinc' => 'i',
			'wplug' => 'g',
			'style' => 'c',
			'templ' => 'p',
			'jqcdn' => 'http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js',
			'opsfcdn' => 'http://cdn.dibiakcom.net/font/opensans/style.css',
		);
	}
}

if (!function_exists('um_getoption')) { 

	function um_get_layout_option($where) {
		$layout_options['none']="none"; $n=0;
		$layout_css=glob($where."/*.css");
		foreach ($layout_css as $lf) {
			$f=basename($lf); $F=explode(".",$f); $n++;
			$layout_options[$F[0]]=$f;
		}
		return $layout_options;
	}

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