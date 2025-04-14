<style>.custom-product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 20px;
    margin: 40px 0;
}

.product-card {
    background-color: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    padding: 15px;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    position: relative;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.product-card img {
    max-width: 100%;
    height: auto;
    margin-bottom: 15px;
    border-radius: 5px;
}

.product-title {
    font-size: 18px;
    color: #333;
    margin: 10px 0;
}

.price {
    font-size: 16px;
    margin: 10px 0;
}

.price del {
    color: #888;
    margin-right: 8px;
}

.price .sale {
    color: #e60023;
    font-weight: bold;
}

.sale-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background-color: #e60023;
    color: white;
    padding: 5px 10px;
    font-size: 12px;
    font-weight: bold;
    border-radius: 5px;
}

.product-card form.cart {
    margin-top: 10px;
}
</style>

<?php
function moje_produkty_shortcode($atts) {
    ob_start();

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 4,
        'post_status' => 'publish',
    );
    $loop = new WP_Query($args);

    if ($loop->have_posts()) :
        echo '<div class="custom-product-grid">';
        while ($loop->have_posts()) : $loop->the_post();
            global $product;
            ?>
            <div class="product-card">
                <?php if ($product->is_on_sale()) : ?>
                    <span class="sale-badge">Sale!</span>
                <?php endif; ?>
                <a href="<?php the_permalink(); ?>">
                    <?php echo $product->get_image(); ?>
                    <h2 class="product-title"><?php the_title(); ?></h2>
                </a>
                <p class="price">
                    <?php if ($product->is_on_sale()) : ?>
                        <del><?php echo wc_price($product->get_regular_price()); ?></del>
                        <span class="sale"><?php echo wc_price($product->get_sale_price()); ?></span>
                    <?php else : ?>
                        <?php echo wc_price($product->get_price()); ?>
                    <?php endif; ?>
                </p>
                <?php woocommerce_template_loop_add_to_cart(); ?>
            </div>
            <?php
        endwhile;
        echo '</div>';
        wp_reset_postdata();
    else :
        echo '<p>Žádné produkty nebyly nalezeny.</p>';
    endif;

    return ob_get_clean();
}
add_shortcode('moje_produkty', 'moje_produkty_shortcode');
?>