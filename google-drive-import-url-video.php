<?php
/**
 * Plugin Name: WooCommerce Google Drive Video URL Importer
 * Description: Import videos from Google Drive URL for WooCommerce products.
 * Version: 1.0.0
 * Author: Tomás David Vazquez
 */

require_once 'vendor/autoload.php';

// 1. Registra los ganchos de activación y desactivación del plugin
register_activation_hook(__FILE__, 'wgdvi_activate_plugin');
register_deactivation_hook(__FILE__, 'wgdvi_deactivate_plugin');

function wgdvi_activate_plugin()
{
    // Realiza tareas de activación del plugin, si es necesario
}

function wgdvi_deactivate_plugin()
{
    // Realiza tareas de desactivación del plugin, si es necesario
}

// 2. Agrega una página de configuración para el plugin
add_action('admin_menu', 'wgdvi_add_plugin_page');
add_action('admin_init', 'wgdvi_settings_init');

function wgdvi_add_plugin_page()
{
    add_options_page(
        'Google Drive Video Importer Settings',
        'Google Drive Video Importer',
        'manage_options',
        'wgdvi-settings',
        'wgdvi_render_settings_page'
    );
}

// Aquí hay código, pero solo sí lo compras ^^ 

function wgdvi_render_settings_page()
{
    global $post;

    echo '<script>alert("probando")</script>';

    // Verifica si se está editando un producto existente
    $product_id = $post->ID;
    $video_url = get_post_meta($product_id, 'wgdvi_video_url', true);

    // Renderiza el campo de entrada para el enlace del video
    ?>
    <div class="form-field">
        <label for="wgdvi_video_url"><?php esc_html_e('Drive URL Video', 'wgdvi'); ?></label>
        <input type="text" id="wgdvi_video_url" name="wgdvi_video_url" value="<?php echo esc_attr($video_url); ?>">
        <p class="description"><?php esc_html_e('Enter the video URL from Google Drive. Developed by @tomdvazq', 'wgdvi'); ?></p>
    </div>
    <?php
}

add_action('woocommerce_product_options_general_product_data', 'wgdvi_add_video_url_field');

function wgdvi_add_video_url_field()
{
    global $post;

    $product_id = $post->ID;
    $video_url = get_post_meta($product_id, 'wgdvi_video_url', true);

    // Aquí hay código muy importante, pero solo sí lo compras ^^ 
}

add_action('woocommerce_process_product_meta', 'wgdvi_save_product_video_url');

function wgdvi_save_product_video_url($product_id)
{
    if (isset($_POST['wgdvi_video_url'])) {
        $video_url = sanitize_text_field($_POST['wgdvi_video_url']);
        update_post_meta($product_id, 'wgdvi_video_url', $video_url);
    }
}

// 3. Implementa la función para importar videos desde Google Drive
function wgdvi_import_video_from_drive($drive_link)
{
    // Lógica para importar el video desde Google Drive y obtener la URL del video

    // Guarda la URL del video en los metadatos del producto
    update_post_meta($product_id, 'wgdvi_video_url', $video_url);
}

// 4. Reemplaza las miniaturas de la galería de productos con el video si está disponible
add_filter('woocommerce_single_product_image_thumbnail_html', 'wgdvi_replace_product_gallery_thumbnail_html', 10, 2);

function wgdvi_replace_product_gallery_thumbnail_html($html, $attachment_id)
{
    global $product;

    // Obtén la URL del video desde los metadatos del producto
    $video_url = get_post_meta($product->get_id(), 'wgdvi_video_url', true);

    // Aquí hay código muy importante, pero solo sí lo compras ^^ 

    return $html;
}

add_action('woocommerce_before_shop_loop_item_title', 'wgdvi_replace_image_with_video_shop_loop', 10);
function wgdvi_replace_image_with_video_shop_loop(){
    global $product;

    // Obtén la URL del video desde los metadatos del producto
    $video_url = get_post_meta($product->get_id(), 'wgdvi_video_url', true);

    // Aquí hay código muy importante, pero solo sí lo compras ^^ 
}