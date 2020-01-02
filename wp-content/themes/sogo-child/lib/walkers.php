<?php

class SogoHeaderWalker extends Walker_Nav_Menu {
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		if ( array_search( 'menu-item-has-children', (array) $item->classes ) ) {

			$is_current = array_search( 'current-menu-item', (array) $item->classes ) || array_search( 'current-page-parent', (array) $item->classes );
			$output     .= sprintf( "\n<li class='expand-sub cursor-pointer %s'><div class='position-relative'><span class='ml-md-3 %s' tabindex='0' role='button'>$item->title</span><i class='fa fa-chevron-down position-absolute pos-l-2 y-align'></i></div>\n",
				$is_current ? 'current-menu-item' : '', $is_current ? 'text-color-3' : '' );

		} else {

			$is_current = array_search( 'current-menu-item', (array) $item->classes );

			$output .= sprintf( "\n<li class='%s'><a class='%s' href='%s'>%s</a>\n",
				$is_current ? 'current-menu-item' : '', $is_current ? 'text-color-3' : '', $item->url, $item->title );

		}
	}


//    function end_el(&$output, $item, $depth = 0, $args = array())
//    {
//        if (in_array('menu-item-has-children', $item->classes)) {
//            $output .= "<i class='fas fa-chevron-down left-0 y-center'></i></li>";
//            $output .= "</li>";
//        } else {
//            $output .= "</li>";
//        }
//    }
}

