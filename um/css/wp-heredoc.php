<?php


DEFINE ('fontsize', 16); // In Pixel
DEFINE ('base1',".entry-content");
DEFINE ('base2',".comment-content");

function _px($val) {  return round($val*fontsize)."px"; }
function _tx($val,$unit) { return $val.$unit; }
function _fs() { return 'fontsize'."px"; }
function _base($el) { return ".um-content $el"; }

function heredocs() {

$s     = _(1); //default size;
$fs    = _(fontsize."px");
$base1 = _(base1);
$base2 = _(base2);
$_base = '_base';
$_px   = '_px';
$_tx   = '_tx';

$here = <<<EOF

$base1 { 
	position: relative; 
	font-size: {$fs}; line-height: {$_tx( $s*1.5,"rem")};
}

$base2 { 
	position: relative; 
	font-size: {$_px(.9*$s)}; line-height: {$_tx( $s*1.2,"rem")};
}

.consist { 
	margin-bottom: {$_tx($s*2,'em')}; 
}

$base1 p { 
	margin-bottom: {$_tx($s*1.5,'em')}; 
}

$base2 p { 
	margin-bottom: {$_tx($s*0.65,'em')}; 
}

.page h1.entry-title,
{$_base('h1')} {
	font-size: {$_tx($s*3,'em')};
	margin-bottom: {$_px(1.5*$s)}
}

{$_base('h2')} {
	font-size: {$_tx($s*1.5,'em')};
	line-height: {$_tx( $s*1.5 ,"rem")};
	margin: {$_tx($s,"rem")} 0;
}

{$_base('h3')} { 
	font-size: {$_tx($s*1.2,'em')};
	line-height: {$_tx( $s*1.2 ,"rem")};
	margin: {$_tx($s,"rem")} 0;
}

{$_base('h4')} {
	font-size: {$_tx($s,'em')};
	line-height: {$_tx( $s,"rem")};
	margin-bottom: 0;
	margin-top: {$_tx($s,"rem")};
}

{$_base('h5')} { 
	font-size: {$_tx($s*.9,'em')};
	line-height: {$_tx( $s*1,"rem")};
	margin-bottom: 0;
	margin-top: {$_tx($s,"rem")};
}

{$_base('h6')} { 
	font-size: {$_tx($s*.8,'em')};
	font-weight: 300;
	line-height: {$_tx( $s*1 ,"rem")};
	margin-bottom: 0;
	text-transform: uppercase;
	border-top: 1px solid #ccc;
	padding-top: {$_tx($s*.5,"rem")};
	margin-top: {$_tx($s,"rem")};
}

{$_base('a')} { text-decoration: none }
{$_base('a:hover')} { text-decoration:underline }

{$_base('> ol')},
{$_base('> ul')} { 
	margin-bottom: {$_tx($s*1.5,'em')} 
}

{$_base('ol > li')} { 
	list-style-type: decimal;
}
{$_base('ul > li')} { 
	list-style-type: square;
}

{$_base('ol')},
{$_base('dd')},
{$_base('ul')} { 
	padding-left: {$_tx($s*1.5,'em')};
}

{$_base('dt')},
{$_base('dd')} { margin: 0 }

{$_base('li')} { margin-bottom: {$_tx($s*.2,'em')} }

{$_base('li')} > ol,
{$_base('li')} > ul { margin-bottom: {$_tx($s*.5,'em')} }

{$_base('b')},
{$_base('strong')} {font-weight:bold}
{$_base('dfn')},
{$_base('cite')},
{$_base('em')},
{$_base('i')}:not[class=icon*] {font-style:italic}

{$_base('table')} { border: 1px solid #ccc; font-size: .9em}
{$_base('td')}, 
{$_base('th')} { 
	border: 1px solid #ccc;
	padding: {$_tx($s*.3,'em')} {$_tx($s*.5,'em')}; 
	vertical-align: top;
	line-height: {$_tx($s*1.3,'em')}; 
}

{$_base('blockquote')} {
	margin:0 {$_tx($s*1.5,'em')};
	font-size: {$_tx($s*1.25,'em')};
	line-height: {$_tx($s*2,'rem')}
}

{$_base('address')} {margin:0 0 {$_tx($s*1.5,'em')}}

{$_base('pre')}  { 
	font-size: {$_tx($s*.8,'em')};
	font-family: Monaco,Consolas,'Andale Mono','DejaVu Sans Mono',monospace
	line-height: {$_tx($s*1.3,'em')};
	max-width:100%;
	overflow:auto;
	margin-bottom:{$_tx($s*1,'em')};
}

{$_base('code')}, 
{$_base('kbd')},
{$_base('tt')},
{$_base('var')} {
	font:15px Monaco,Consolas,'Andale Mono','DejaVu Sans Mono',monospace
}

{$_base('abbr')} ,
{$_base('acronym')} {
	border-bottom:1px dotted #666;
	cursor:help
}

{$_base('mark')} ,
{$_base('ins')} {
	background:#fff9c0;
	text-decoration:none
}

{$_base('small')} {font-size:75%}
{$_base('big')} {font-size:125%}
{$_base('hr')} {
	background-color:#ccc;
	border:0;
	height:1px;
	margin-bottom:{$_tx($s*1.5,'em')}
}

{$_base('dt')} {
	font-weight:bold}

{$_base('dl')} {
	margin-bottom: {$_tx($s*1.5,'em')}
}

{$_base('figure')} {margin:0}
{$_base('table')} {
	margin:0 0 {$_tx($s*1.5,'em')};
	width:100%;
	border: 1px solid rgba(0,0,0,.1);
}
{$_base('th')} {font-weight:bold;
	 background: rgba(255,255,255,.2) }
{$_base('th')} 
{$_base('td ')} { border: 1px solid rgba(0,0,0,.1);
	 border-bottom: none;
	 border-right: none;
	 padding: {$_tx($s*.2,'em')} {$_tx($s*.5,'em')} 
}

{$_base('p img')}  { 
	max-width:100%;
	vertical-align: -25% 
}

{$_base('td img')}  { vertical-align: -50% }

EOF;
return $here;

}

?>
