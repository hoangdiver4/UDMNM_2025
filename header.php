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
     <div class="leftheader">
        <?php if ( function_exists( 'pll_the_languages' ) ) : ?>
            <span class="lang-icon" aria-hidden="true">🌐</span>
            <div class="language-switcher">
                <?php
                // Lấy danh sách ngôn ngữ dưới dạng array
                $langs = pll_the_languages( array(
                    'dropdown'      => 1,
                    'show_flags'    => 0,
                    'show_names'    => 1,
                    'echo'          => 0 
                ) );
                echo $langs; // Chỉ in ra một lần
                ?>
            </div>
        <?php endif; ?>
     
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

        <div class="icon-user">
            <div class="icon-user user-dropdown-wrapper">
                <?php if ( is_user_logged_in() ) : 
                    $current_user = wp_get_current_user();
                    $is_admin = in_array('administrator', $current_user->roles);
                ?>
                    <a href="javascript:void(0);" class="user-menu-link" id="userDropdownBtn" title="Tài khoản của bạn">
                        <span class="user-icon" aria-hidden="true">
                            <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="12" cy="8" r="4"/>
                                <path d="M4 20c0-4 8-4 8-4s8 0 8 4"/>
                            </svg>
                        </span>
                    </a>
                    <div class="user-dropdown" id="userDropdownMenu">
                        <ul>
                            <?php if ( $is_admin ) : ?>
                                <li><a href="<?php echo esc_url( admin_url() ); ?>">Trang quản lý</a></li>
                            <?php else: ?>
                                <li><a href="<?php echo esc_url( site_url('/quan-ly-bai/') ); ?>">Quản lý bài</a></li>
                                <li><a href="<?php echo esc_url( site_url('/viet-bai/') ); ?>">Viết bài</a></li>
                            <?php endif; ?>
                            <li><a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>">Đăng xuất</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="<?php echo esc_url( wp_login_url() ); ?>" class="user-menu-link" title="Đăng nhập/Đăng ký">
                        <span class="user-icon" aria-hidden="true">
                            <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="12" cy="8" r="4"/>
                                <path d="M4 20c0-4 8-4 8-4s8 0 8 4"/>
                            </svg>
                        </span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        
    </div>
</header>
