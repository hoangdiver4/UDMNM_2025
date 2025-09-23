<?php
get_header();
?>

<div class="user-post-archive-list">
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <div class="user-post-archive-card">
                <div class="user-post-archive-thumb">
                    <a href="<?php the_permalink(); ?>">
                        <?php 
                        if ( has_post_thumbnail() ) {
                            the_post_thumbnail('large');
                        }
                        ?>
                    </a>
                </div>
                <div class="user-post-archive-content">
                    <h2>
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <div class="user-post-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        <div class="pagination" style="text-align:center;">
            <?php the_posts_pagination(); ?>
        </div>
    <?php else : ?>
        <p style="text-align:center;">Không có bài viết nào.</p>
    <?php endif; ?>
</div>

<?php
get_footer();