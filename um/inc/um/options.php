<?php

function umt_args() {
	return array(
		'featcss'=> array(
			'text'=> 'CSS',
			'note'	=> 'Cascading Style Sheet Options',
			'field'	=> array(
				'umcss'	=> array ('check','UM-reset','Makes browsers render all elements more consistently and in line with modern standards.<br/><small>Warning! might render your working theme differently.</small>',''),
				'layout'=> array ('selectfile','Layout','Layout Selections',get_stylesheet_directory()."/layouts"),
				'schcss'=> array ('check','UM-scheme.css','Load customable colour schemes',''),
				'navcss'=> array ('check','UM-navui.css','Load main-navigation menu styles',''),
				'iehtml5'=> array ('check','IE html5','Include html5 hack for IE9 and IE8',''),
				
			)
		),
		'featjs'=> array(
			'text'=> 'JS',
			'note'	=> 'Extending Javascript FX and Helper',
			'field'	=> array(
				'umgui'	=> array ('check','UM-gui-lib','Load um-gui jQuery Libraries for FX and layout fix.',''),
				'ajaxwpl'=> array ('check','UM-login.js','Use Ajax WP-Login <small> &mdash; require: um-gui-lib.js</small>',''),
				'ajredir'=> array ('text','UM Login Redirect','<br><small>Relative Path will be nice<small>','30'),
				'skejs'=> array ('check','skel.js','a lightweight frontend framework for building responsive sites and apps','')
			)
		),

	);
}

class um_as_theme {

	public $um_theme;

	private $options;
		public function __construct() {
		add_action('admin_menu',array($this,'um_add_menu_slug'));
		add_action('admin_init',array($this,'um_page_init'));
	}
	public function um_add_menu_slug() {
		add_theme_page( 'UM Theme Options', 'UM Theme Options', 'edit_theme_options', 'um-theme-options',array($this,'um_themeoption'));
		if (file_exists( UMCORE_DIR. '/css/font/icons-reference.html' ) ) {
			add_theme_page( 'UM Font References', 'UM Font References', 'edit_theme_options', 'um-fontref',array($this,'um_fontref'));
		}
	}

	public function um_fontref() {
		echo "<div class='wrap'><div class='um-head-set'><h2>UM - Font References</h2></div>";
		echo "<iframe class='iframe_full' src='". UMCORE_URL. '/css/font/icons-reference.html'. "'></iframe>";
		echo "</div>";
	}
	
	public function um_themeoption() {
		$umt=umt_args();
		$this->options=get_option('umt');
		echo '<div class="wrap"><div class="um-head-set"><h2>UM - Theme Options</h2></div>';
		echo '<ul id="umtab" class=""><li class="span">Theme Options cames with Themes</li></ul><div class="um-frame-box dress">';
		echo '<form method="post" class="maketab" action="options.php">'."\n";
			settings_fields("umt_group");
			$S=array_keys($umt); foreach($S as $section) {
				echo "<div>";
				do_settings_sections("umt-$section");
				echo "</div>";
			}
			echo '<div class="clear"></div>';
			submit_button('Change');
		echo "\n".'</form></div></div><!--warp-->';
	}				
	public function um_page_init() {
		$umt=umt_args();
		register_setting("umt_group","umt",array($this,'umt_sanitize'));
		$S=array_keys($umt);
		foreach($S as $se) {
			$n=0; add_settings_section("$se",$umt[$se]['text'],array($this,'umt_option_print_section'),"umt-$se");
			foreach ($umt[$se]['field'] as $fi) {
				$F=array_keys($umt[$se]['field']); $m=count($F);
				if ($n < $m) {
					$args=array(
						'type'=> $umt[$se]['field'][$F[$n]][0],
						'id'=> $F[$n],
						'note'=> $umt[$se]['field'][$F[$n]][2],
						'var'=> $umt[$se]['field'][$F[$n]][3]
					);
					add_settings_field($F[$n],$umt[$se]['field'][$F[$n]][1],array($this,'umt_option_print'),"umt-$se","$se",$args);
					$n++;
				}
			}
		}
	}
	public function umt_option_print_section (array $args) { $umt=umt_args();	print $umt[$args['id']]['note']; }
	public function umt_option_print(array $args) {
		if ($args['type']== "check") {
			printf(
				'<input type="checkbox" name="umt[%2$s]" %1$s value="1" /> %3$s',
				isset($this->options[$args['id']]) ? esc_attr("checked") : '',
				$args['id'],$args['note']
			);
		} else if ($args['type']== "number") {
			printf(
				'<input type="number" min="0" max="16" name="umt[%2$s]" value="%1$s" /> %3$s',
				$this->options[$args['id']],$args['id'],$args['note']
			);
		} else if ($args['type']== "text") {
			$def = um_rwvar_default();
			printf(
				'<input type="text" name="umt[%2$s]" size="%4$s" value="%1$s" /> %3$s',
				isset($this->options[$args['id']]) ? $this->options[$args['id']] : $def[$args['id']],
				$args['id'],$args['note'],$args['var']
			);
		} else if ($args['type']== "selectfile") {
			$sotxt="";
			foreach(um_get_layout_option($args['var']) as $label=> $value) {
				$sotxt .="<option value='$value' ";
				if ($this->options[$args['id']]== $value) { $sotxt .="selected"; }
				$sotxt .=" >$label</option>";
			}
			printf(
				'<select name="umt[%1$s]"/>%3$s</select> %2$s',
				$args['id'],$args['note'],$sotxt
			);
		}
	}	
	public function umt_sanitize($input) {
		$new_input=array();
		$umt=umt_args();
		$S=array_keys($umt);
		foreach($S as $se) {
			$n=0;
			foreach ($umt[$se]['field'] as $fi) {
				$F=array_keys($umt[$se]['field']); $m=count($F);
				if ($n < $m) {
					if(isset($input[ $F[$n] ])) {
						$type=$umt[$se]['field'][$F[$n]][0];
						if (($type== "check") || ($type== "number")) {
							$new_input[ $F[$n] ]=absint($input[ $F[$n] ]);
						} else {
							$new_input[ $F[$n] ]=sanitize_text_field($input[ $F[$n] ]);
						}
					}
				$n++;
				}
			}
		}
	return $new_input;
	}	
}
if(is_admin()) { $my_settings_page=new um_as_theme(); }
