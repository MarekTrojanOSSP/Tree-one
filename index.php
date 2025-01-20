<!DOCTYPE html>
<html>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_uri() ); ?>" type="text/css" />
<?php wp_head(); ?>
</head>

<body>
<?php
get_header();
?>

<div class="two-column-layout">
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <article class="post-summary">

            <div class="thumbnail">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium'); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <div class="detail">

                    <div class="kategorie">
                        <?php
                        $categories = get_the_category();
                        if ( ! empty( $categories ) ) :
                            echo '<span>' . esc_html( $categories[0]->name ) . '</span>';
                        endif;
                        ?>
                    </div>

                    <h2 class="titulek">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        
                    </h2>

                    <div class="uryvek">
                        <?php the_excerpt(); ?>
                        <a class="read-more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Číst více', 'textdomain' ); ?></a>
                    </div>

                    <div class="post-meta">
                        <span class="author">Autor: <?php the_author_posts_link(); ?></span>
                        <span class="post-date"><?php echo human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) . ' ' . esc_html__( 'před', 'textdomain' ); ?></span>
                    </div>

                </div>
            </article>
        <?php endwhile; ?>
    <?php else : ?>
        <p><?php esc_html_e( 'Sorry, no posts found.', 'textdomain' ); ?></p>
    <?php endif; ?>
</div>

<?php
get_footer();
?>

</body>
</html>