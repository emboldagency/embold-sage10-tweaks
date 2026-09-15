# Tweaks and Changes to Sage 10 and Sage 11

There are common things we'll need to change in every Sage 10 and Sage 11 theme, this plugin simplifies making all these changes with
a drag and drop plugin.

1. Enqueues app.css styles in only the Gutenberg editor, not the entire admin panel.
2. Add "wp-block-paragraph" class to Gutenberg paragraph blocks to allow easier styling of the blocks vs ACF wysiwyg p's.
3. Add "wp-block-ul" and "wp-block-ol" classes to Gutenberg list blocks to allow easier targeting.
4. Always make sure the default block library is loaded even when Soil is installed and set to clean.

## Installation via Git Clone

If installing directly via `git clone` (instead of using the release ZIP), you must clean up development files after cloning so WP Haven can verify checksums.

From the `wp-content/plugins` directory:

```bash
git clone git@github.com:emboldagency/embold-sage10-tweaks.git
cd embold-sage10-tweaks
bash bin/clean-dist.sh --yes
wp plugin activate embold-sage10-tweaks
```

**Note**: `bin/clean-dist.sh` strips all dev-only files (including `.git`) listed in `.distignore`. As a safeguard, it refuses to run if it detects uncommitted or unpushed changes. Run without arguments for a dry-run preview, or add `--force` to explicitly override the safeguard.
