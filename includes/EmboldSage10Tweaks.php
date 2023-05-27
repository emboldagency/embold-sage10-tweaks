<?php

namespace App;

class EmboldSage10Tweaks {
    /**
     * Add the CSS to the editor.
     *
     * @return void
     */
    public function addCssToEditor()
    {
        add_action('after_setup_theme', function () {
            add_theme_support('editor-styles');
        
            $public_path = get_template_directory() . '/public/css';
            $app_css_path = '';
        
            $files = glob($public_path . '/app.*.css');
        
            if (!empty($files)) {
                $app_css_path = get_template_directory_uri() . '/public/css/' . basename($files[0]);
            }
        
            add_editor_style($app_css_path);
        });
    }

    /**
     * Add a class to the paragraph block.
     */
    public function addParagraphBlockClass()
    {
        add_filter('render_block', function ($block_content, $block) {
            if ($block['blockName'] === 'core/paragraph') {
                $block_content = str_replace('<p', '<p class="wp-block-paragraph"', $block_content);
            }
        
            return $block_content;
        }, 10, 2);
    }

    /**
     * Add a class to the list blocks.
     */
    public function addListBlockClass()
    {
        add_filter('render_block', function ($block_content, $block) {
            if ($block['blockName'] === 'core/list') {
                $block_content = str_replace('<ul', '<ul class="wp-block-ul"', $block_content);
                $block_content = str_replace('<ol', '<ol class="wp-block-ol"', $block_content);
            }
        
            return $block_content;
        }, 10, 2);
    }

    /**
     * Ensure block library css is included even when Soil clean up is active
     * @return void 
     */
    public function enqueueBlockLibraryOverride()
    {
        add_action('wp_enqueue_scripts', function () {
            wp_enqueue_style('wp-block-library');
        }, 300);
    }
}
