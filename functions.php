<?php

if ( ! function_exists( 'herobiz_setup' ) ) {
    function herobiz_setup() {
        load_theme_textdomain( 'herobiz', get_template_directory() . '/languages' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'custom-background', apply_filters( 'herobiz_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );
        add_theme_support( 'customize-selective-refresh-widgets' );
        add_theme_support( 'custom-logo', [
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ] );
        add_theme_support( 'custom-header',array(
            'default-image'      => '',
            'width'              => 1600,
            'height'             => 450,
            'flex-width'         => true,
            'flex-height'        => true,
        ) );
        add_theme_support( 'post-formats', array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
            'gallery',
            'audio',
        ) ); 
        register_nav_menus( array(
            'primary' => esc_html__( 'Primary', 'herobiz' ),
            'footer'  => esc_html__( 'Footer Menu', 'herobiz' ),
        ) );
    }
}
add_action( 'after_setup_theme', 'herobiz_setup' );
function herobiz_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'herobiz_content_width', 1170 );
}
add_action( 'after_setup_theme', 'herobiz_content_width', 0 );

function herobiz_sidebar_registration() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'herobiz' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'herobiz' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'herobiz_sidebar_registration' );
function herobiz_public_scripts() {
    wp_enqueue_style('default',get_template_directory_uri().'/assets/css/default.css',[],wp_rand(),'all');
    wp_enqueue_style('main',get_template_directory_uri().'/assets/css/main.css',[],wp_rand(),'all');

    wp_enqueue_script('main',get_template_directory_uri().'/assets/js/main.js',[],wp_rand(),true);

}
add_action('wp_enqueue_scripts','herobiz_public_scripts');
function herobiz_admin_scripts() {

}
add_action('admin_enqueue_scripts','herobiz_admin_scripts');
function theme_enqueue_styles() {
  wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function herobiz_theme_supports() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array(
        'comment-list',
        'comment-form',
        'search-form',
        'gallery',
        'caption',
    ) );
}
add_action( 'after_setup_theme', 'herobiz_theme_supports' );
register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'your-theme' ),
) );
function create_user_post_type() {
    $labels = array(
        'name'               => 'Bài viết người dùng',
        'singular_name'      => 'Bài viết người dùng',
        'menu_name'          => 'Bài viết người dùng',
        'name_admin_bar'     => 'Bài viết người dùng',
        'add_new'            => 'Thêm mới',
        'add_new_item'       => 'Thêm bài viết mới',
        'new_item'           => 'Bài viết mới',
        'edit_item'          => 'Chỉnh sửa bài viết',
        'view_item'          => 'Xem bài viết',
        'all_items'          => 'Tất cả bài viết',
        'search_items'       => 'Tìm bài viết',
        'not_found'          => 'Không tìm thấy',
        'not_found_in_trash' => 'Không tìm thấy trong thùng rác'
    );
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'user-post'),
        'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt'),
        'capability_type'    => 'post',
        'map_meta_cap'       => true,
        'show_in_rest'       => true,
    );
    register_post_type('user_post', $args);
}
add_action('init', 'create_user_post_type');
function add_user_post_caps() {
    $role = get_role('author'); // hoặc 'contributor', 'subscriber'
    if ($role) {
        $role->add_cap('edit_user_posts');
        $role->add_cap('edit_published_user_posts');
        $role->add_cap('delete_user_posts');
        $role->add_cap('publish_user_posts');
        $role->add_cap('read');
    }
}
add_action('admin_init', 'add_user_post_caps');
require get_template_directory() . '/inc/user-post.php';
