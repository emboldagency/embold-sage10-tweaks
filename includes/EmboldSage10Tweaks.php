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
                // If ul or ol already has a class, append "wp-block-ul" or "wp-block-ol"
                $block_content = preg_replace_callback(
                    '~<(ul|ol)([^>]*)class="([^"]*)"~',
                    function ($matches) {
                        $tag = $matches[1]; // ul or ol
                        $attributes = $matches[2]; // any other attributes before class
                        $existing_classes = $matches[3]; // current class list
                        $new_class = $tag === 'ul' ? 'wp-block-ul' : 'wp-block-ol';

                        // Append new class, making sure it's unique
                        $updated_classes = trim("$existing_classes $new_class");

                        return "<$tag$attributes class=\"$updated_classes\"";
                    },
                    $block_content
                );

                // If ul or ol has no class at all, add class attribute
                $block_content = preg_replace(
                    '~<(ul|ol)(?![^>]*class=)~',
                    '<$1 class="'.($block['blockName'] === 'core/list' && strpos($block_content, '<ul') !== false ? 'wp-block-ul' : 'wp-block-ol').'"',
                    $block_content
                );
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
