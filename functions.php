<?php 

	function fenikso_setup() {
		// 注册菜单
		register_nav_menu( 'primary', __( 'Primary Menu', 'fenikso' ) );  
	}
	add_action( 'after_setup_theme', 'fenikso_setup' );

	/*
	 * 网站的页面标题，来自 Twenty Twelve 1.0
	 */
	function fenikso_wp_title( $title, $sep ) {
		global $paged, $page;

		if ( is_feed() )
			return $title;

		// 添加网站名称
		$title .= get_bloginfo( 'name' );

		// 为首页添加网站描述
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title = "$title $sep $site_description";

		// 在页面标题中添加页码
		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( __( 'Page %s', 'fenikso' ), max( $paged, $page ) );

		return $title;
	}
	add_filter( 'wp_title', 'fenikso_wp_title', 10, 2 );

	/*
	* 网站的搜索表单
	*/
	function fenikso_search_form( $form ) {

	    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
	    <div class="input-append pull-right" id="search"><label class="hide screen-reader-text" for="s">' . __('Search for:') . '</label>
	    <input class="span3" type="text" value="' . get_search_query() . '" name="s" id="s" />
	    <input class="btn" type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
	    </div>
	    </form>';

	    return $form;
	}
	add_filter( 'get_search_form', 'fenikso_search_form');

	/*
	 * Bootstrap 导航菜单
	 */

	class fenikso_Nav_Walker extends Walker_Nav_Menu {

	     /*
	      * @see Walker_Nav_Menu::start_lvl()
	      */
	     function start_lvl( &$output, $depth ) {
	          $output .= "\n<ul class=\"dropdown-menu\">\n";
	     }

	     /*
	      * @see Walker_Nav_Menu::start_el()
	      */
	     function start_el( &$output, $item, $depth, $args ) {
	          global $wp_query;
	         
	          $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	          $li_attributes = $class_names = $value = '';
	          $classes = empty( $item->classes ) ? array() : (array) $item->classes;
	          $classes[] = 'menu-item-' . $item->ID;

	          if ( $args->has_children ) {
	               $classes[] = ( 1 > $depth) ? 'dropdown': 'dropdown-submenu';
	               $li_attributes .= ' data-dropdown="dropdown"';
	          }

	          $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
	          $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

	          $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
	          $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

	          $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

	          $attributes     =     $item->attr_title     ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
	          $attributes    .=     $item->target          ? ' target="' . esc_attr( $item->target     ) .'"' : '';
	          $attributes    .=     $item->xfn               ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
	          $attributes    .=     $item->url               ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
	          $attributes    .=     $args->has_children     ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';

	          $item_output    =     $args->before . '<a' . $attributes . '>';
	          $item_output   .=     $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
	          $item_output   .=     ( $args->has_children AND 1 > $depth ) ? ' <b class="caret"></b>' : '';
	          $item_output   .=     '</a>' . $args->after;

	          $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	     }

	     /*
	      * @see Walker::display_element()
	      */
	     function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
	          if ( ! $element )
	               return;
	          $id_field = $this->db_fields['id'];
	          //display this element
	          if ( is_array( $args[0] ) )
	               $args[0]['has_children'] = (bool) ( ! empty( $children_elements[$element->$id_field] ) AND $depth != $max_depth - 1 );
	          elseif ( is_object(  $args[0] ) )
	               $args[0]->has_children = (bool) ( ! empty( $children_elements[$element->$id_field] ) AND $depth != $max_depth - 1 );

	          $cb_args = array_merge( array( &$output, $element, $depth ), $args );
	          call_user_func_array( array( &$this, 'start_el' ), $cb_args );

	          $id = $element->$id_field;

	          // descend only when the depth is right and there are childrens for this element
	          if ( ( $max_depth == 0 OR $max_depth > $depth+1 ) AND isset( $children_elements[$id] ) ) {

	               foreach ( $children_elements[ $id ] as $child ) {

	                    if ( ! isset( $newlevel ) ) {
	                         $newlevel = true;
	                         //start the child delimiter
	                         $cb_args = array_merge( array( &$output, $depth ), $args );
	                         call_user_func_array( array( &$this, 'start_lvl' ), $cb_args );
	                    }
	                    $this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
	               }
	               unset( $children_elements[ $id ] );
	          }

	          if ( isset( $newlevel ) AND $newlevel ) {
	               //end the child delimiter
	               $cb_args = array_merge( array( &$output, $depth ), $args );
	               call_user_func_array( array( &$this, 'end_lvl' ), $cb_args );
	          }

	          //end this element
	          $cb_args = array_merge( array( &$output, $element, $depth ), $args );
	          call_user_func_array( array( &$this, 'end_el' ), $cb_args );
	     }
	}

	/*
	 * 给激活的导航菜单添加 .active
	 */
	function fenikso_nav_menu_css_class( $classes ) {
	     if ( in_array('current-menu-item', $classes ) OR in_array( 'current-menu-ancestor', $classes ) )
	          $classes[]     =     'active';

	     return $classes;
	}
	add_filter( 'nav_menu_css_class', 'fenikso_nav_menu_css_class' );

	// Replaces the excerpt "more" text by a link
	function faber_excerpt_more($more) {
	    global $post;
		return '... <a href="'. get_permalink($post->ID) . '">更多 &rarr;</a>';
	}
	add_filter('excerpt_more', 'faber_excerpt_more');

	function faber_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'faber' ),
		'id' => 'sidebar',
		'description' => __( 'Widgets you add here will be added to the sidebar', 'faber' ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	) );
	register_sidebar( array(
		'name' => __( 'Footbar', 'faber' ),
		'id' => 'footbar',
		'description' => __( 'Widgets you add here will be added to the Footer - Maximum 4 Widgets For a Better Alignment', 'faber' ),
		'before_widget' => '<div class="widget footer-widget">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	) );
}
add_action( 'widgets_init', 'faber_widgets_init' );
?>


