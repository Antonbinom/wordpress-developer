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
		'footer_left'   => __( 'Footer Left Menu', 'wp_dev' ),
		'footer_right'   => __( 'Footer Right Menu', 'wp_dev' ),
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

	register_sidebar( array(
		'name'          => esc_html__('Текст в подвале', 'wp_dev'),
		'id'            => "sidebar-footer-text",
		'before_widget' => '<div class="footer-widget footer-link">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	));

	register_sidebar( array(
		'name'          => esc_html__('Контакты в подвале', 'wp_dev'),
		'id'            => "sidebar-footer-contacts",
		'before_widget' => '<div class="footer-widget footer-text">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	));
}

/**
 * Добавление нового виджета Download_Widget.
 */
class Download_Widget extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
		parent::__construct(
			'download_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: download_widget
			'Полезные файлы',
			array( 'description' => 'Скачайте полезные файлы по интересующей вас теме', 'classname' => 'download_widget', )
		);

		// скрипты/стили виджета, только если он активен
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action('wp_enqueue_scripts', array( $this, 'add_download_widget_scripts' ));
			add_action('wp_head', array( $this, 'add_download_widget_style' ) );
		}
	}

	/**
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$file_name = $instance['file_name'];
		$file_name_2 = $instance['file_name_2'];
		$file = $instance['file'];
		$file_2 = $instance['file_2'];


		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		echo '<a download href="'.$file.'"><i class="fa fa-file-pdf"></i>'.$file_name.'</a>';
		echo '<a download href="'.$file_2.'"><i class="fa fa-file-pdf"></i>'.$file_name_2.'</a>';
		echo $args['after_widget'];
	}

	/**
	 * Админ-часть виджета
	 *
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title = @ $instance['title'] ?: 'Полезные файлы';
		$file_name = @ $instance['file_name'] ?: 'Название файла';
		$file_name_2 = @ $instance['file_name_2'] ?: 'Название файла';
		$file_2 = @ $instance['file_2'] ?: 'URL файла';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'file_name' ); ?>"><?php _e( 'Название файла:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'file_name' ); ?>" name="<?php echo $this->get_field_name( 'file_name' ); ?>" type="text" value="<?php echo esc_attr( $file_name ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'file_name_2' ); ?>"><?php _e( 'Название файла:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'file_name_2' ); ?>" name="<?php echo $this->get_field_name( 'file_name_2' ); ?>" type="text" value="<?php echo esc_attr( $file_name_2 ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'file' ); ?>"><?php _e( 'Ссылка на файл:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'file' ); ?>" name="<?php echo $this->get_field_name( 'file' ); ?>" type="text" value="<?php echo esc_attr( $file ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'file_2' ); ?>"><?php _e( 'Ссылка на файл:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'file_2' ); ?>" name="<?php echo $this->get_field_name( 'file_2' ); ?>" type="text" value="<?php echo esc_attr( $file_2 ); ?>">
		</p>
		<?php
	}

	/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 *
	 * @return array данные которые будут сохранены
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		$instance['file_name'] = ( ! empty( $new_instance['file_name'] ) ) ? strip_tags( $new_instance['file_name'] ) : '';

		$instance['file_name_2'] = ( ! empty( $new_instance['file_name_2'] ) ) ? strip_tags( $new_instance['file_name_2'] ) : '';

		$instance['file'] = ( ! empty( $new_instance['file'] ) ) ? strip_tags( $new_instance['file'] ) : '';

		$instance['file_2'] = ( ! empty( $new_instance['file_2'] ) ) ? strip_tags( $new_instance['file_2'] ) : '';

		return $instance;
	}

	// скрипт виджета
	function add_download_widget_scripts() {
		// фильтр чтобы можно было отключить скрипты
		if( ! apply_filters( 'show_download_widget_script', true, $this->id_base ) )
			return;

		$theme_url = get_template_directory_uri();

		// wp_enqueue_script('download_widget_script', $theme_url .'js/download_widget_script.js' );
	}

	// стили виджета
	function add_download_widget_style() {
		// фильтр чтобы можно было отключить стили
		if( ! apply_filters( 'show_download_widget_style', true, $this->id_base ) )
			return;
		?>
		<style type="text/css">
			.download_widget a{ display:inline; }
		</style>
		<?php
	}

}
// конец класса Download_Widget

// регистрация Download_Widget в WordPress
function register_download_widget() {
	register_widget( 'Download_Widget' );
}
add_action( 'widgets_init', 'register_download_widget' );

?>
