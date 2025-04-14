<!DOCTYPE html> 
<html>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_uri() ); ?>" type="text/css" />
    <?php wp_head(); ?>
    <style>
        .product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 20px;
    padding: 20px;
}
.product-grid{
    text-align: center;
    justify-content: center;
    align-items: center;
}

.product-card {
    border: 5px solid #eee;
    border-width: 2px;
    border-radius: 8px;
    padding: 15px;
    text-align: center;
    background: #fff;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
}

.product-card img {
    max-width: 100%;
    height: auto;
    margin-bottom: 10px;
}

.product-title {
    font-size: 16px;
    margin: 10px 0;
}

.price {
    display: block;
    font-weight: bold;
    color: #444;
    margin-bottom: 10px;
}

.add_to_cart_button {
    background-color: #2c5aa0;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 25px;
    text-transform: uppercase;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s ease;
}

.add_to_cart_button:hover {
    background-color: #1b3f75;
}

    </style>
</head>

<body>
<?php get_header(); ?>

<?php if ( is_shop() || is_product_category() || is_product() ) : ?>

    <!-- WooCommerce shop layout -->
    <div class="woocommerce-shop">
        <?php woocommerce_content(); ?>
    </div>
    <div class="product-grid">
    <?php
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 12
    );
    $loop = new WP_Query( $args );
    while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
        <div class="product-card">
            <a href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail()) {
                    the_post_thumbnail('medium');
                } ?>
            </a>
            <h2 class="product-title"><?php the_title(); ?></h2>
            <span class="price"><?php echo $product->get_price_html(); ?></span>
            <?php woocommerce_template_loop_add_to_cart(); ?>
        </div>
    <?php endwhile; wp_reset_query(); ?>
</div>

<?php else : ?>

    <!-- Home -->
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

<?php endif; ?>

<?php get_footer(); ?>
</body>
</html>
