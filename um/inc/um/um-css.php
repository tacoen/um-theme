<?php
function css_include($f,$c=1) {
	if (file_exists($f)) {
		return "\n/* $f */\n".css_compress(join("",file($f)),$c)."\n";
	}
}
function css_compress($buffer,$readable=0) {
	if ($readable != 1) { $readable = 0; }
	$buffer = str_replace("\\", 'UM_TT', $buffer);
	$buffer = preg_replace('#\"#','\'', $buffer);
	$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
	$buffer = preg_replace('#\s\s+#',' ', $buffer);
	$buffer = preg_replace('#^\s+#','', $buffer);
	$buffer = preg_replace('#(\s+>\s+)|(\s?>\s?)#', '>', $buffer);
	$buffer = preg_replace('#(\s+;\s+)|(\s?;\s?)#', ';', $buffer);
	$buffer = preg_replace('#(\s+:\s+)|(\s?:\s?)#', ':', $buffer);
	$buffer = preg_replace('#(\s+{\s+)|(\s?{\s?)#', '{', $buffer);
	$buffer = preg_replace('#(\s+}\s+)|(\s?}\s?)#', '}', $buffer);
	$buffer = preg_replace('#(\s+,\s+)|(\s?,\s?)#', ',', $buffer);
	$buffer = preg_replace('#;}#','}', $buffer);
	$buffer = preg_replace('#,{#','{', $buffer);
	$buffer = preg_replace('#[\r|\n|\t]#i', '', $buffer);
	if ($readable==1) $buffer = preg_replace('/}/', "}\n", $buffer);
	$buffer = str_replace("UM_TT", "\\", $buffer);
	return $buffer;
}
?>