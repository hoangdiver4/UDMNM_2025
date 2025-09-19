<?php
echo get_post_format();
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php
        while ( have_posts() ) :
            the_post();

            // Gọi file template cho nội dung bài viết (chuẩn WordPress)
            get_template_part( 'template-parts/post/content', get_post_format() );

        endwhile;

        // Hiển thị comment nếu bật
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;
        ?>

    </main>

    <?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>
