<?php
/**
 * @wordpress-plugin
 * Plugin Name:        emBold Sage10 Tweaks
 * Plugin URI:         https://embold.com
 * Description:        A collection of tweaks and changes to the Sage 10 framework.
 * Version:            0.5.0
 * Author:             emBold
 * Author URI:         https://embold.com/
 * Primary Branch:     master
 */

// Prevent direct access to this file
if (!defined('ABSPATH')) {
    exit;
}

// Include the main plugin class
require_once plugin_dir_path(__FILE__) . 'includes/EmboldSage10Tweaks.php';

// Plugin initialization
function embold_sage10_tweaks_init() {
    // Create an instance of your plugin class
    $plugin = new \App\EmboldSage10Tweaks();

    // Enqueue the frontend CSS to the editor
    $plugin->addCssToEditor();

    // Allow SVG uploads
    $plugin->addSvgSupport();

    if (wp_get_environment_type() == 'development') {
        // Defer scripts to try to avoid Coders 502 errors
        $plugin->deferScripts();

        // Async scripts to try to avoid Coders 502 errors
        $plugin->asyncScripts();
    }

    $plugin->addParagraphBlockClass();

    $plugin->enqueueBlockLibraryOverride();
}

add_action('plugins_loaded', 'embold_sage10_tweaks_init');