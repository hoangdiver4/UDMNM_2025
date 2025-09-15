<?php

if ( post_password_required() ) {
    return;
}

?>

<div id="comments" class="comments-area">
    <?php if ( have_comments()) : ?>
            <h2 class="comments-title">
                <?php
                $comments_number = get_comments_number();
                if ( '1' === $comments_number ) {
                    printf(
                        esc_html__( 'comments (1)', 'herobiz' ),
                    );
                } else {
                    printf(
                        esc_html__('comments (%1$s)', 'herobiz' ),
                        intval( $comments_number )
                    );
                }   
                ?>
            </h2>
            <?php the_comments_navigation(); ?>
            <ol class="comment-list">
                <?php
                    wp_list_comments( [ 
                        'style'       => 'ol',
                        'short_ping'  => true,
                        'avatar_size' => 74,
                    ] );
                ?>
            </ol>
            <?php 
            the_comments_navigation(); 
            if ( ! comments_open() ) {
                printf(
                    '<p class="no-comments">%1$s</p>',
                    esc_html__( 'comments are closed.', 'herobiz' )
                );
            }
            ?>
        <?php 
        endif; 
        comments_form ();
        ?> 
</div>