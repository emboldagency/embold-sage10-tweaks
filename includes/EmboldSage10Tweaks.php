<?php

namespace App;

class EmboldSage10Tweaks
{
    /**
     * Add the CSS to the editor.
     *
     * @return void
     */
    public function addCssToEditor()
    {
        add_action('enqueue_block_editor_assets', function () {
            $public_path = get_template_directory().'/public/css';
            $app_css_path = '';

            $files = glob($public_path.'/app.*.css');

            if (! empty($files)) {
                $app_css_path = get_template_directory_uri().'/public/css/'.basename($files[0]);
            }

            if (! empty($app_css_path)) {
                wp_enqueue_style('custom-editor-style', $app_css_path, false, '1.0', 'all');
            }
        }, 100);
    }

    /**
     * Add a class to the paragraph block.
     */
    public function addParagraphBlockClass()
    {
        add_filter('render_block', function ($block_content, $block) {
            if ($block['blockName'] === 'core/paragraph') {
                // if string contains class, just prepend it
                if (str_contains($block_content, 'class="')) {
                    $block_content = str_replace('class="', 'class="wp-block-paragraph ', $block_content);
                } else {
                    $block_content = str_replace('<p', '<p class="wp-block-paragraph"', $block_content);
                }
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
     *
     * @return void
     */
    public function enqueueBlockLibraryOverride()
    {
        add_action('wp_enqueue_scripts', function () {
            wp_enqueue_style('wp-block-library');
        }, 300);
    }

    public function fixGravityForms()
    {
        add_action('admin_footer', function () {
            $isGravityFormsEditPage = isset($_GET['page']) && $_GET['page'] === 'gf_edit_forms';
            if (! $isGravityFormsEditPage) {
                return;
            }
            ?>
                <script type="text/javascript">document.querySelector('select[name="_gform_setting_event"]').setAttribute('id', 'event');</script>
            <?php
        }, 1000);
    }
}
