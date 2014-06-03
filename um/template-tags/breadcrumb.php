<?php
/* 	umtag: breadcrumb 
 *
 */

defined('ABSPATH') or die('huh?');

function umtag_breadcrumb() { um_breadcrumb_script(); }

function um_li_catagory($num){
	$cat_string ="";
    $temp=get_the_category();
    $count=count($temp);// Getting the total number of categories the post is filed in.
    for($i=0;$i<$num&&$i<$count;$i++){
        $cat_string.='<li><a href="'.get_category_link( $temp[$i]->cat_ID  ).'">'.$temp[$i]->cat_name.'</a></li>';
        //if($i!=$num-1&&$i+1<$count)
        //$cat_string.="</li>";
    }
    echo $cat_string;
}

function um_breadcrumb_script() {
	$n = 0; $date_format =  get_option( 'date_format' );
	echo '<ul id="um-crumbs" class="micro">';
				echo "<li><a href='";
				echo home_url();
				echo "'>";
				if (!is_home()) {
					echo 'Home';
				} else {
					echo 'Welcome';
				}
				echo "</a></li>";
				if (is_category() || is_single()) {

						um_li_catagory(2);
						
						if (is_single()) {
								echo "</li><li>";
								the_title();
								echo '</li>';
						}
				} elseif (is_page()) {
						echo '<li>';
						echo the_title();
						echo '</li>';
				}
		elseif (is_tag()) {single_tag_title();}
		elseif (is_day()) {echo"<li>Archive for "; the_time($date_format); echo'</li>';}
		elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}
		elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}
		elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
		elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
		elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}
	echo '</ul>';
}


?>