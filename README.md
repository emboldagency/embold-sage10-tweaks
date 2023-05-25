# Tweaks and Changes to Sage 10

There are common things we'll need to change in every Sage 10 theme, this plugin simplifies making all these changes wit
a drag and drop plugin.


1. Enqueues app.css styles in only the Gutenberg editor, not the entire admin panel.
2. Allow SVG uploads in the admin panel.
3. Defer and async various Gutenberg scripts to avoid Coders 502 errors.
4. Add "wp-block-paragraph" class to Gutenberg paragraph blocks to allow easier styling of the blocks vs ACF wysiwyg p's.
5. Add "wp-block-ul" and "wp-block-ol" classes to Gutenberg list blocks to allow easier targeting.