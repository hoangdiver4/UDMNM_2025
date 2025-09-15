<?php

    if ( has_post_thumbnail() ) :
        the_post_thumbnail( 'full');
    endif;
?>

<div class="entry-content">
    <?php
        the_content();
        
        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ninestars' ),
            'after'  => '</div>',
        ) );
    ?>
</div>
<?php if (get_edit_post_link()): ?>
    <footer class="entry-footer">
        <?php
        edit_post_link(
            sprintf(
                wp_kses(
                    __( 'Edit <span class="screen-reader-text">%s</span>', 'ninestars' ),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            ),
            '<span class="edit-link">',
            '</span>'
        );
        ?>
    </footer>
    <?php endif; ?>
</article>