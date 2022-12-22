<?php
require_once get_theme_file_path() . '/inc/tgm.php';
require_once get_theme_file_path() . '/inc/cmb2-meta.php';
// ACF METABOX
// require_once get_theme_file_path() . '/inc/exported-meta.php';
// Hide ACF Menu
add_filter('acf/settings/show_admin','__return_false');

// Version Control
if(site_url()=="http://localhost/arfa"){
	define("VERSION",time());
} else{
	define("VERSION",wp_get_theme()->get("Version"));
}

// REQUIRE_ONCE [ Attachments Plugin ]
if ( class_exists( 'Attachments' ) ){
	require_once("lib/attachments.php");
}

// Convert Text to Uppercase
function convert_uppercase( $name ) {
    return strtoupper( $name );
}
// Theme Bootstrapping
function arfa_bootstrapping() {
    load_theme_textdomain( 'arfa' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
	// Custom Logo
	$arfa_custom_logo = array(
		"width" => "100px",
		"height"=> "100px",
	);
	add_theme_support("custom-logo", $arfa_custom_logo);

	// Header Image, Text & Color
	$arfa_custom_header = array(
		'header-text'=> true,
		'default-text-color'=> "#222",
		'width' => '1200px',
		'height'=> '600px',
		'flex-width' => false,
		'flex-height'=> true,
	);
    add_theme_support( 'custom-header', $arfa_custom_header );

	// Custom Background SET
    add_theme_support( 'custom-background' );

	// Post Formats Support
	add_theme_support("post-formats", array("audio", "video", "image", "quote", "aside", "gallery"));

	// Search Form SUPPORT
	add_theme_support( 'html5', array( 'search-form' ) );

	// ADD Image Size
	add_image_size("arfa_square",400,400,true); // HardCrop
	add_image_size("arfa_portrait",400,400,array("left","top"));
	add_image_size("arfa_portrait",400,400);

}
add_action( 'after_setup_theme', 'arfa_bootstrapping' );

	// Image SRCSET OFF
	function arfa_srcset(){
		return null;
	}
	// add_filter("wp_calculate_image_srcset","arfa_srcset");
	add_filter("wp_calculate_image_srcset","__return_null");

// Enqueue Scripts
function arfa_assets() {
	wp_enqueue_style( "bootstrap", "//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" );
	// Featherlight CSS
    wp_enqueue_style( "feather-css", "//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.css" );
	// Featherlight JS
	// Dashicons Enqueue
	wp_enqueue_style("dashicons");
	// Tiny Slider Enqueue
	wp_enqueue_style("tinyslider-css","//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css");
    wp_enqueue_style( "arfa-style", get_stylesheet_uri(),null,VERSION );
	wp_enqueue_script("feather-js","//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.js",array("jquery"),"1.0",true);
	wp_enqueue_script("tinyslider-js","//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js", null, "2.9.2", true);

	// Main JS Enqueue
	wp_enqueue_script("arfa-main",get_theme_file_uri("/assets/js/main.js"),array("jquery","feather-js"),VERSION,true);
	// wp_enqueue_script("arfa-main",get_template_directory_uri()."/assets/js/main.js",null,"1.0.0",true);
}
add_action( 'wp_enqueue_scripts', 'arfa_assets' );

// ARFA Sidebar
function arfa_sidebar(){
    register_sidebar( array(
		'name'          => __( 'Single Post Sidebar', 'arfa' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Sidebar Widgets', 'arfa' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
	) );
    register_sidebar( array(
		'name'          => __( 'Footer Text Sidebar', 'arfa' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Footer Widgets', 'arfa' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '', // NO NEED FOR FOOTER TEXT
		'after_title'   => '',
	) );
}
add_action('widgets_init','arfa_sidebar');

// Password Protected Form Showing Function
function arfa_password_form($excerpt){
	if(!post_password_required()){
		return $excerpt;
	}else{
		echo get_the_password_form();
	}
}
add_filter('the_excerpt','arfa_password_form');

// Password Protected Title Changing Function
function arfa_protected_title($excerpt){
	return "%s [ Locked ]";
}
add_filter('protected_title_format','arfa_protected_title');

// Menu [ Register Nav Menu ]
register_nav_menu("topmenu",__("Top Menu","arfa"));
register_nav_menu("footermenu",__("Footer Menu","arfa"));
register_nav_menu("socialmenu",__("Social Menu","arfa"));

// Nav Menu CSS Class >> add_filter
function arfa_nav_css($classes, $item){
	$classes[]="list-inline-item";
	return $classes;
}
add_filter( 'nav_menu_css_class', 'arfa_nav_css', 10, 2 );

	// Banner Image BG Add
	function arfa_page_bg(){
		if(is_page()){
			$arfa_bg = get_the_post_thumbnail_url(null,"large");
			?>
			<style>
			.page-banner{
				background-position: center;
				background-size: cover;
				margin-bottom: 30px;
				padding: 170px 0px;
				background-image: url(<?php echo $arfa_bg; ?>);
			}
			</style>
			<?php
		}
		if(is_front_page()){
			if(current_theme_supports("custom-header")){
				?>
				<style>
				.header{
					background-position: center;
					background-size: cover;
					margin-bottom: 30px;
					padding: 170px 0px;
					background-image: url(<?php echo header_image(); ?>);
				}
				.header h1.heading a, h3.tagline{
					color: #<?php echo get_header_textcolor(); ?>;
					<?php
					if(!display_header_text()){
						echo "display: none;";
					} 
					?>
				}
				</style>
				<?php
			}
		}
	}
	add_action('wp_head','arfa_page_bg');

	// REMOVE Body Class
	function arfa_body_class($classes){
		unset($classes[array_search("class-1", $classes)]);
		$classes[] = "new-class";
		return $classes;
	}
	add_filter("body_class","arfa_body_class");

// Search Form
function arfa_search_form($form, $args) { 
	?>
	<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
		<label>
			<span class="screen-reader-text"><?php echo esc_html_x( 'Search 2022 for:', 'arfa' ) ?></span>
			<input type="search" class="search-field"
				placeholder="<?php echo esc_attr_x( 'Search ...', 'arfa' ) ?>"
				value="<?php echo get_search_query() ?>" name="s"
				title="<?php echo esc_attr_x( 'Enter Search Query', 'arfa' ) ?>" />
		</label>
		<input type="submit" class="search-submit"
			value="<?php echo esc_attr_x( 'Searchme', 'arfa' ) ?>" />
	</form>
	<?php
	return $form;
}
add_filter( "get_search_form", "arfa_search_form", 10, 2 );

// Search Result Highlights
if(!function_exists("arfa_highlights")){
function arfa_highlights($text){
	if(is_search()){
		$pattern = '/('. join('|', explode(' ', get_search_query())).')/i';
		$text = preg_replace($pattern, '<span class="highlights">\0</span>', $text);
	}
	return $text;
}
add_filter('the_content', 'arfa_highlights');
add_filter('the_excerpt', 'arfa_highlights');
add_filter('the_title', 'arfa_highlights');
}

// Parent Todays Date
if(!function_exists("arfa_date")){
	function arfa_date(){
		echo date('d/m/y');
	}
}

// WP_Query MODIFY
function arfa_wpq_modify($wpq){
	if(is_home() && $wpq->is_main_query()){
	$wpq->set("tag__not_in",array(3));
	}
}
add_action("pre_get_posts","arfa_wpq_modify");

/*
* Theme Name: My Theme
* Author: Theme Author
* Text Domain: my-theme
* Domain Path: /languages
*/


// CMB2 META Post Format SET >> Using JavaScript
function arfa_admin_assets( $hook ) {
	if ( isset( $_REQUEST['post'] ) || isset( $_REQUEST['post_ID'] ) ) {
		$post_id = empty( $_REQUEST['post_ID'] ) ? $_REQUEST['post'] : $_REQUEST['post_ID'];
	}
	if ( "post.php" == $hook ) {
		$post_format = get_post_format($post_id);
		wp_enqueue_script( "admin-js", get_theme_file_uri( "/assets/js/admin.js" ), array( "jquery" ), VERSION, true );
		wp_localize_script("admin-js","arfa_pf",array("format"=>$post_format));
	}
}

add_action( "admin_enqueue_scripts", "arfa_admin_assets" );

// Post Format HOOK
function arfa_cmb2_post_format( $display, $post_format ) {

    if ( ! isset( $post_format['show_on']['key'] ) ) {
        return $display;
    }

    $post_id = 0;

    // If we're showing it based on ID, get the current ID
    if ( isset( $_GET['post'] ) ) {
        $post_id = $_GET['post'];
    } elseif ( isset( $_POST['post_ID'] ) ) {
        $post_id = $_POST['post_ID'];
    }

    if ( ! $post_id ) {
        return $display;
    }

    $value  = get_post_format($post_id);
 
    if ( empty( $post_format['show_on']['key'] ) ) {
        return (bool) $value;
    }

    return $value == $post_format['show_on']['value'];
}
// add_filter( 'cmb2_show_on', 'arfa_cmb2_post_format', 10, 2 );