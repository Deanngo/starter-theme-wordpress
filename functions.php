<?php

/**
 * hrv543 functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package hrv543
 */

define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
require_once dirname( __FILE__ ) . '/inc/options-framework.php';
require_once dirname( __FILE__ ) . '/functions/filters/filter_services_admin.php';
require_once dirname( __FILE__ ) . '/functions/filters/filters_function.php';
require_once dirname( __FILE__ ) . '/functions/CPT/cpt_services.php';
require_once dirname( __FILE__ ) . '/functions/validation_register_form.php';
require_once dirname( __FILE__ ) . '/functions/CPT/cpt_services_leased.php';
require_once dirname( __FILE__ ) . '/functions/user-profile/login-custom.php';
require_once dirname( __FILE__ ) . '/functions/user-profile/register-custom.php';
require_once dirname( __FILE__ ) . '/functions/CPT/cpt_services_leased.php';



if ( ! function_exists( 'hrv543_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function hrv543_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on hrv543, use a find and replace
	 * to change 'hrv543' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'hrv543', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'hrv543' ),
		'menu_services' => esc_html__( 'Menu Services', 'hrv543' ),
		'menu_leases' => esc_html__( 'Menu leases', 'hrv543' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'hrv543_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // hrv543_setup
add_action( 'after_setup_theme', 'hrv543_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hrv543_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'hrv543_content_width', 640 );
}
add_action( 'after_setup_theme', 'hrv543_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hrv543_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'hrv543' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'hrv543_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function hrv543_scripts() {
	

	wp_enqueue_script( 'hrv543-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'hrv543-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
        wp_enqueue_script( 'hrv543-app-script', get_template_directory_uri() . '/js/app.js', array('jquery'), '', true );
	if( !is_singular( 'services' ) )
	{
		wp_enqueue_script( 'hrv543-my-script', get_template_directory_uri() . '/js/myscript.js', array(), '20120206', true );
	}

	/* Add style and script date picker */


	if( !is_singular( 'services' ) )
	{
		wp_enqueue_script( 'hrv543-my-script', get_template_directory_uri() . '/js/myscript.js', array(), '20120206', true );
	}

	/* Add style and script date picker */


	wp_enqueue_style( 'css-datepicker-mdp', get_template_directory_uri() . '/css/css_datepicker/mdp.css', true );

	wp_enqueue_style( 'css-prettify', get_template_directory_uri() . '/css/css_datepicker/prettify.css', true );

	wp_enqueue_script( 'jquery' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_page_template( 'page-create-service.php' ) && !isset($_GET['post']) )
	{
		wp_enqueue_script( 'my-calendar-script', get_template_directory_uri() . '/js/my_calendar_script.js', array(), '1.0.0', true );

	}


	if ( (is_page_template( 'page-create-service.php' ) && isset($_GET['post'])) || is_singular( 'services' ) )
	{
		wp_enqueue_script( 'my-pre-calendar-script', get_template_directory_uri() . '/js/my_pre_calendar_script.js', array(), '1.0.0', true );

	}

	if (  is_page_template( 'page-rent-service.php' ) )
	{
		wp_enqueue_script( 'my-rent-calendar-script', get_template_directory_uri() . '/js/my_rent_calendar_script.js', array(), '1.0.0', true );

	} 


        
    wp_enqueue_style('font-google-source-san', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,400italic,700italic', true);
    wp_enqueue_style('font-google-lato', '//fonts.googleapis.com/css?family=Lato:400,900,300,700', true);
    wp_enqueue_style('boostrap', get_template_directory_uri() . '/css/bootstrap.min.css', true);    
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', true);
    //custom css
    wp_enqueue_style('my-style', get_template_directory_uri() . '/css/my-style.css', true);
    wp_enqueue_style('my-datepicker', get_template_directory_uri() . '/css/css_datepicker/my-datepicker.css', true);
    wp_enqueue_style( 'hrv543-style', get_stylesheet_uri() );
    
    //Enqueue script
    wp_enqueue_script('bootstrap.min.js', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '1.0.0', false);    



}

add_action( 'wp_enqueue_scripts', 'hrv543_scripts' );

/**
 * Enqueue scripts and styles admin.
 */

function load_admin_styles() {

	wp_enqueue_style( 'backend-styles', get_template_directory_uri() . '/css/backend-styles.css', false, '1.0.0' );

    wp_enqueue_script( 'hrv543-my-backend-script', get_template_directory_uri() . '/js/my_backend_script.js', array(), '20120206', true );

}  
add_action( 'admin_enqueue_scripts', 'load_admin_styles' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/*
* Creating a function to create our CPT
*/



/*
* Creating a function to create post service in front end
*/

function my_service_save_post( $post_id ) {

    // check if this is to be a new post
    if( $post_id != 'new_post' )
    {
        return $post_id;
    }

    // vars
	$title = $_POST['fields']['field_55daed70a191f'];
	
    // Create a new post
    $post = array(
        'post_status'    => 'publish',
        'post_title'     => $title,
        'post_type'      => 'services',
    );

    // insert the post
    $post_id = wp_insert_post( $post );

    // update $_POST['return']
    $_POST['return'] = add_query_arg( array('post_id' => $post_id), $_POST['return'] );

    // return the new ID
    return $post_id;

}
add_filter('acf/pre_save_post' , 'my_service_save_post' );

function my_service_lease_save_post( $post_id ) {

    // check if this is to be a new post
    if( $post_id != 'new_post' )
    {
        return $post_id;
    }

    // vars
	$title = $_POST['fields']['field_55deb99fafb26'];
	
    // Create a new post
    $post = array(
        'post_status'    => 'publish',
        'post_title'     => $title,
        'post_type'      => 'services_leased',
    );

    // insert the post
    $post_id = wp_insert_post( $post );

    // update $_POST['return']
    $_POST['return'] = add_query_arg( array('post_id' => $post_id), $_POST['return'] );

    // return the new ID
    return $post_id;

}
add_filter('acf/pre_save_post' , 'my_service_lease_save_post' );

/* Delete Service or Item */
function wp_delete_post_link($link = 'weet je zeker', $before = '', $after = '') {
    global $post;
    if ( $post->post_type == 'page' ) {
    if ( !current_user_can( 'edit_page', $post->ID ) )
      return;
  } else {
    if ( !current_user_can( 'edit_post', $post->ID ) )
      return;
  }
    $message = "Are you sure you want to delete ".get_the_title($post->ID)." ?";
    $delLink = wp_nonce_url( get_bloginfo('url') . "/wp-admin/post.php?action=delete&post=" . $post->ID, 'delete-post_' . $post->ID);
    $htmllink = "<a href='" . $delLink . "' onclick = \"if ( confirm('".$message."' ) ) { execute(); return true; } return false;\"/><button class='btn btn-default btn-2'>".$link."</button></a>";
    echo $before . $htmllink . $after;
}

/* add Add Custom Post Type Columns - Services Leased */
function add_new_services_leased_columns($new_columns) {
    
    $new_columns['renter_id'] = __('Renter ID');
    $new_columns['request_date'] = __('Request date', 'hrv543');
    $new_columns['response_date'] = __('Response date', 'hrv543');
    $new_columns['status'] = __('Status', 'hrv543');
     
    return $new_columns;
}

// Add to admin_init function
add_filter('manage_services_leased_posts_columns', 'add_new_services_leased_columns');

function custom_services_leased_column( $new_columns, $id ) {
    switch ( $new_columns ) {

        case 'renter_id' :

        	global $post;
			$user_id=$post->post_author;

        	$user_info = get_userdata($user_id);
        	$renter_id = $user_info->user_login;
            echo $renter_id;

            break;
        case 'request_date' :

            $request_date = the_field('request_date', $id);
            echo $request_date;
            break;
        case 'response_date' :

        	$response_date = the_field('response_date', $id);
            echo $response_date;
            
            break;
        case 'status' :

        	$status = the_field('status', $id);;
            echo $status;
            
            break;             	
    }
    return $return;
}

add_action( 'manage_services_leased_posts_custom_column' , 'custom_services_leased_column', 10, 2 );

// determine the topmost parent of a term
function get_term_top_most_parent($term_id, $taxonomy){
    // start from the current term
    $parent  = get_term_by( 'id', $term_id, $taxonomy);
    // climb up the hierarchy until we reach a term with parent = '0'
    while ($parent->parent != '0'){
        $term_id = $parent->parent;

        $parent  = get_term_by( 'id', $term_id, $taxonomy);
    }
    return $parent;
}

// Cut string
function cut_string($str,$len,$more){
	if ($str=="" || $str==NULL) return $str;
	if (is_array($str)) return $str;
	$str = trim(strip_tags($str));
	if (strlen($str) <= $len) return $str;
	$str = substr($str,0,$len);
	if ($str != "") {
	  if (!substr_count($str," ")) {
			  if ($more) $str .= " ...";
			return $str;
		}
	while(strlen($str) && ($str[strlen($str)-1] != " ")) {
			$str = substr($str,0,-1);
		}
		$str = substr($str,0,-1);
		if ($more) $str .= " ...";
	}
	return $str;
}

function my_post_queries( $query ) {
  // do not alter the query on wp-admin pages and only alter it if it's the main query
  if (!is_admin()){

    // alter the query for the home and category pages 

    if(is_page(291)){
      $query->set('posts_per_page', 1);
    }

  }
}
add_action( 'pre_get_posts', 'my_post_queries' );

add_filter( 'nav_menu_link_attributes', 'themeprefix_menu_attribute_add', 10, 3 );
function themeprefix_menu_attribute_add( $atts, $item, $args )
{  
  // Set the menu ID
  $menu_login_link = 312;  
  $menu_register_link = 313;  
  // Conditionally match the ID and add the attribute and value
  if ($item->ID == $menu_login_link) {
    $atts['data-toggle'] = 'modal';
    $atts['data-target'] = '#login_modal';
    if(is_user_logged_in()){
        $atts['style'] = 'display:none;';    
    }
  } 
  if ($item->ID == $menu_register_link) {    
    if(is_user_logged_in()){
        $atts['style'] = 'display:none;';    
    }
  } 
 
  //Return the new attribute
  return $atts;
}
