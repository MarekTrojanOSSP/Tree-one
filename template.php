<?php
/**
 * The Template for displaying a single product
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * @package WooCommerce
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

get_header('shop');
?>

<div class="product">
    <?php while (have_posts()) : the_post(); ?>
        <div class="image">
            <?php woocommerce_show_product_images(); ?>
        </div>
        
        <div class="details">
            <h1 class="product-title"><?php the_title(); ?></h1>
            <p class="product-sku"><?php echo get_post_meta(get_the_ID(), '_sku', true); ?></p>
            <p class="product-price"><?php wc_get_template('loop/price.php'); ?></p>
            <p class="product-availability">
                <?php echo wc_get_stock_html($product); ?>
            </p>
            
            <div class="product-add-to-cart">
                <?php woocommerce_template_single_add_to_cart(); ?>
            </div>
            
            <div class="product-meta">
                <span class="product-category">
                    <?php echo get_the_term_list(get_the_ID(), 'product_cat', '', ', '); ?>
                </span>
                <span class="product-sku">Katalogové číslo: <?php echo get_post_meta(get_the_ID(), '_sku', true); ?></span>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<?php get_footer('shop'); ?>

