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
}
