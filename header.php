<?php
// Contains the header.
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="container header-container">
        <!-- Logo -->
        <div class="site-logo">
            <?php
            if ( function_exists( 'the_custom_logo' ) ) {
                the_custom_logo();
            }
            if ( ! has_custom_logo() ) { ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-title">
                    <?php bloginfo( 'name' ); ?>
                </a>
            <?php } ?>
        </div>

        <!-- 🔽 Nút toggle menu (hiện khi màn hình <= 700px) -->
        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">☰</button>
    </div>

    <!-- Menu điều hướng (nằm dưới header-container) -->
    <nav class="main-navigation">
        <?php
        wp_nav_menu( array(
            'theme_location' => 'primary', // Đã khai báo trong functions.php
            'menu_id'        => 'primary-menu',
            'container'      => false,
            'fallback_cb'    => false,
        ) );
        ?>
    </nav>
</header>
