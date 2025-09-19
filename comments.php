<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Ngăn truy cập trực tiếp
}

if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if ( have_comments() ) : ?>
        

        <?php the_comments_navigation(); ?>


        <?php the_comments_navigation(); ?>
    <?php endif; ?>

    <?php
    // Chỉ gọi nếu hàm tồn tại
    if ( function_exists( 'comments_form' ) && comments_open() ) {
        comments_form();
    }
    ?>
</div>
