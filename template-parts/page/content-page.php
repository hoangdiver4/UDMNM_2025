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
