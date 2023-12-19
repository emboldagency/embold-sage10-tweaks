<?php
/**
 * @wordpress-plugin
 * Plugin Name:        emBold Sage10 Tweaks
 * Plugin URI:         https://embold.com
 * Description:        A collection of tweaks and changes to the Sage 10 framework.
 * Version:            0.9.0
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

require 'plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$embold_update_checker = PucFactory::buildUpdateChecker(
	'https://github.com/emboldagency/embold-sage10-tweaks/',
	__FILE__,
	'embold-sage10-tweaks'
);

$update_key_url = 'https://embold.net/api/wp-plugin-key';

// Initialize cURL session
$ch = curl_init($update_key_url);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 0.2); // Set timeout in seconds

// Execute cURL session
$update_key = @curl_exec($ch);

if ($update_key !== false && ($update_key = trim($update_key))) {
    // Close cURL session
    curl_close($ch);

    // Set authentication and enable release assets
    $embold_update_checker->setAuthentication($update_key);
    $embold_update_checker->getVcsApi()->enableReleaseAssets();
}

// Plugin initialization
function embold_sage10_tweaks_init() {
    // Create an instance of your plugin class
    $plugin = new \App\EmboldSage10Tweaks();

    // Enqueue the frontend CSS to the editor
    $plugin->addCssToEditor();

    // Add wp-block-paragraph class to paragraph blocks
    $plugin->addParagraphBlockClass();

    // Add wp-block-ul and wp-block-ol classes to list blocks
    $plugin->addListBlockClass();

    // Ensure the default block library is enqueued even if Soil clean up is active
    $plugin->enqueueBlockLibraryOverride();
}

add_action('plugins_loaded', 'embold_sage10_tweaks_init');