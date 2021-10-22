<?php

//Подключение логотипа
if ( ! function_exists('wp_dev_setup')) {
	function wp_dev_setup() {
		add_theme_support( 'custom-logo', [
		'height'      => 50,
		'width'       => 130,
		'flex-width'  => false,
		'flex-height' => false,
		'header-text' => '',
		'unlink-homepage-logo' => false, // WP 5.5
	]);

// Добавляем динамический тег <title>
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 720, 480, true );
}
add_action( 'after_setup_theme', 'wp_dev_setup' );
}

/*
Подключение стилей и скриптов
*/
add_action( 'wp_enqueue_scripts', 'wp_dev_scripts' );

function wp_dev_scripts() {
	// Подключение стилей
	wp_enqueue_style( 'main', get_stylesheet_uri() );
	// bootstrap.min css
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/plugins/bootstrap/css/bootstrap.css', array(), null );
	// fontawesome css
	wp_enqueue_style('fontawesome', get_template_directory_uri() . '/plugins/fontawesome/css/all.css', array(), null);
	// animate css
	wp_enqueue_style('animate', get_template_directory_uri() . '/plugins/animate-css/animate.css', array(), null );
	// icofont css
	wp_enqueue_style( 'icofont', get_template_directory_uri() . '/plugins/icofont/icofont.css', array(), null );
	// wp_dev css
	wp_enqueue_style( 'wp_dev', get_template_directory_uri() . '/css/style.css', array(), null );

	// Подключение скриптов
	// wp_deregister_script('jquery' );
	wp_enqueue_script('jquery');
	wp_register_script('jquery', get_template_directory_uri() . '/plugins/jquery/jquery.min.js' );
	wp_enqueue_script('popper', get_template_directory_uri() . '/plugins/bootstrap/js/popper.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/plugins/bootstrap/js/bootstrap.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script('wow', get_template_directory_uri() . '/plugins/counterup/wow.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script('easing', get_template_directory_uri() . '/plugins/counterup/jquery.easing.1.3.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script('waypoint', get_template_directory_uri() . '/plugins/counterup/jquery.waypoints.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script('counterup', get_template_directory_uri() . '/plugins/counterup/jquery.counterup.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script('counterup', get_template_directory_uri() . '/plugins/counterup/jquery.counterup.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script('google-map', get_template_directory_uri() . '/plugins/google-map/gmap3.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script('contact', get_template_directory_uri() . '/plugins/form/contact.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script('custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '1.0.0', true );
}

/**
 * Регистрируем сразу несколько областей меню
 */
function wp_dev_menus() {
// Собираем несколько областей меню
	$locations = array(
		'header'  => __( 'Header Menu', 'wp_dev' ),
		'footer'   => __( 'Footer Menu', 'wp_dev' ),
	);
// Регистрируем области меню, которые лежат в переменной $locations
	register_nav_menus( $locations );
}
// хук-событие
add_action( 'init', 'wp_dev_menus' );


class bootstrap_4_walker_nav_menu extends Walker_Nav_menu {

    function start_lvl(&$output, $depth = 0, $args = array()){ // ul
        $indent = str_repeat("\t",$depth); // indents the outputted HTML
        $submenu = ($depth > 0) ? ' sub-menu' : '';
        $output .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n";
    }

  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ){ // li a span

    $indent = ( $depth ) ? str_repeat("\t",$depth) : '';

    $li_attributes = '';
        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
        $classes[] = ($item->current || $item->current_item_anchestor) ? 'active' : '';
        $classes[] = 'nav-item';
        $classes[] = 'nav-item-' . $item->ID;
        if( $depth && $args->walker->has_children ){
            $classes[] = 'dropdown-menu';
        }

        $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr($class_names) . '"';

        $id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr($item->url) . '"' : '';

        $attributes .= ( $args->walker->has_children ) ? ' class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="nav-link"';

        $item_output = $args->before;
        $item_output .= ( $depth > 0 ) ? '<a class="dropdown-item"' . $attributes . '>' : '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters ( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

    }
}

## отключаем создание миниатюр файлов для указанных размеров
add_filter( 'intermediate_image_sizes', 'delete_intermediate_image_sizes' );
function delete_intermediate_image_sizes( $sizes ){
	// размеры которые нужно удалить
	return array_diff( $sizes, [
		'medium_large',
		'large',
		'1536x1536',
		'2048x2048',
	] );
}


add_action( 'widgets_init', 'wp_dev_widgets_init' ); // цепляемся к событию wordpress widgets_init и выполняем функцию

function wp_dev_widgets_init(){ //инициализируем несколько виджетов

	register_sidebar( array(
		'name'          => esc_html__('Сайдбар блога', 'wp_dev'),
		'id'            => "sidebar-blog",
		'before_widget' => '<section id="%1$s" class="sidebar-widget %2%s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title mb-3">',
		'after_title'   => '</h5>',
	));
}

?>
