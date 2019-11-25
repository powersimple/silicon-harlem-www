<?php
/**
 * @package Metrika
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <a href="<?php the_permalink(); ?>" class="post_link" rel="bookmark"></a>
    <div class="entry-thumbnail">
        <?php the_post_thumbnail(); ?>
    </div>
    <div class="entry-header">
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <div class="container">
            <?php if ( 'post' == get_post_type() ) : ?>
            <div class="entry-meta span5">
                <i class="ib-icon-bodkin"></i>
                <?php // Metrika_posted_on(); ?>
                <?php $comments_count = wp_count_comments(get_the_ID()); ?>
                <?php the_author(); ?>, <?php the_date('d.m.Y'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="comments-icon"></i>&nbsp;<?php echo $comments_count->approved; ?>
            </div><!-- .entry-meta -->
            <?php endif; ?>
            <div class="entry-meta span7">
                <?php if ( 'post' == get_post_type() ) : ?>
                    <?php $categories_list = get_the_category_list( __( ', ', 'Metrika' ) ); ?>
                    <span class="cat-links">
                        <?php printf( __( 'Posted in %1$s', 'Metrika' ), $categories_list ); ?>
                    </span>

                    <?php
                    $tags_list = get_the_tag_list( '', __( ', ', 'Metrika' ) );
                    if ( $tags_list ) : ?>
                    <span class="tags-links">
                        <?php printf( __( 'Tagged %1$s', 'Metrika' ), $tags_list ); ?>
                    </span>
                    <?php endif; // End if $tags_list ?>
                <?php endif; // End if 'post' == get_post_type() ?>
                <?php edit_post_link( __( 'Edit', 'Metrika' ), '<span class="edit-link">', '</span>' ); ?>
            </div>
        </div>
    </div><!-- .entry-header -->

    <?php if ( is_search() ) : // Only display Excerpts for Search ?>
    <div class="entry-summary">
        <?php the_excerpt(); ?>
    </div><!-- .entry-summary -->
    <?php else : ?>
    <div class="entry-content">
        <?php the_excerpt();//the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'Metrika' ) ); ?>
        <?php
                wp_link_pages( array(
                        'before' => '<div class="page-links">' . __( 'Pages:', 'Metrika' ),
                        'after'  => '</div>',
                ) );
        ?>
    </div><!-- .entry-content -->
    <?php endif; ?>

</article><!-- #post-## -->
