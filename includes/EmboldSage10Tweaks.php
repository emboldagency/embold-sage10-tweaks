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
     * Add SVG support.
     *
     * @return void
     */
    public function addSvgSupport()
    {
        add_filter('upload_mimes', function ($mimes) {
            $mimes['svg'] = 'image/svg+xml';

            return $mimes;
        });
    }

    /**
     * Defer scripts to try to avoid Coders 502 errors.
     *
     * @return void
     */
    public function deferScripts()
    {
        add_filter('script_loader_tag', function ($tag, $handle) {
            $scripts_to_defer = [
                'common',
                'wp-menu',
            ];
        
            foreach ($scripts_to_defer as $defer_script) {
                if ($defer_script === $handle) {
                    return str_replace(' src', " defer='defer' src", $tag);
                }
            }
        
            return $tag;
        }, 10, 2);
    }

    /**
     * Async scripts to try to avoid Coders 502 errors.
     * 
     * @return void 
     */
    public function asyncScripts()
    {
        add_filter('script_loader_tag', function ($tag, $handle) {
            $scripts_to_async = [
                'admin-bar',
                'heartbeat',
                'mce-view',
                'image-edit',
                'quicktags',
                'wplink',
                'jquery-ui-autocomplete',
                'media-upload',
                'wp-block-styles',
                'wp-block-directory',
                'wp-format-library',
                'editor/0',
                'editor/1',
                'utils',
                'svg-painter',
                'wp-auth-check',
                'wordcount',
                'block-editor',
                'references',
                'style-engine',
            ];
        
            foreach ($scripts_to_async as $async_script) {
                if ($async_script === $handle) {
                    return str_replace(' src', ' async src', $tag);
                }
            }
        
            return $tag;
        }, 10, 2);
    }

    /**
     * Add a class to the paragraph block.
     */
    public function addParagraphBlockClass()
    {
        add_filter('render_block', function ($block_content, $block) {
            if ($block['blockName'] === 'core/paragraph') {
                $block_content = str_replace('<p', '<p class="wp-paragraph"', $block_content);
            }
        
            return $block_content;
        }, 10, 2);            
    }
}
