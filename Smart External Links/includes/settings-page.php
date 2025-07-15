<?php
if (!defined('ABSPATH')) exit;

add_action('admin_menu', function () {
    add_options_page('Smart External Links', 'External Links', 'manage_options', 'smart-external-links', 'sel_settings_page');
});

add_action('admin_init', function () {
    register_setting('sel_settings', 'sel_excluded_domains');
    register_setting('sel_settings', 'sel_open_new_tab');
});

function sel_settings_page() {
    ?>
    <div class="wrap">
        <h1>Smart External Links Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('sel_settings');
            do_settings_sections('sel_settings');
            $domains = get_option('sel_excluded_domains', []);
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Loại trừ domain</th>
                    <td>
                        <textarea name="sel_excluded_domains[]" rows="5" cols="50"><?php echo esc_textarea(implode("\n", (array) $domains)); ?></textarea>
                        <p class="description">Mỗi domain 1 dòng. VD: example.com</p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Mở tab mới</th>
                    <td>
                        <input type="checkbox" name="sel_open_new_tab" value="1" <?php checked(get_option('sel_open_new_tab', '1'), '1'); ?> />
                        <label>Mở link ngoài trong tab mới (target="_blank")</label>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
