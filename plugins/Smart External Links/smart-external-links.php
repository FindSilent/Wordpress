<?php
/**
 * Plugin Name: Smart External Links
 * Description: Thêm target="_blank", rel="nofollow" cho link ngoài. Cho phép loại trừ domain và đếm lượt click.
 * Version: 1.0
 * Author: iSEO AI
 * Author URI:  https://iseoai.com
 */

if (!defined('ABSPATH')) exit;

require_once plugin_dir_path(__FILE__) . 'includes/settings-page.php';

function sel_modify_external_links($content) {
    $site_url = get_site_url();
    $excluded_domains = get_option('sel_excluded_domains', []);
    $open_new_tab = get_option('sel_open_new_tab', '1');

    return preg_replace_callback(
        '#<a[^>]+href=["\'](.*?)["\'][^>]*>#is',
        function ($matches) use ($site_url, $excluded_domains, $open_new_tab) {
            $link = $matches[0];
            $href = $matches[1];

            // Bỏ qua link nội bộ và neo
            if (strpos($href, $site_url) !== false || strpos($href, '/') === 0 || strpos($href, '#') === 0) {
                return $link;
            }

            // Bỏ qua domain loại trừ
            foreach ($excluded_domains as $domain) {
                if (strpos($href, $domain) !== false) {
                    return $link;
                }
            }

            // Thêm target="_blank" nếu bật
            if ($open_new_tab && !preg_match('/target=["\']_blank["\']/', $link)) {
                $link = preg_replace('/<a/i', '<a target="_blank"', $link);
            }

            // Thêm rel="nofollow" nếu chưa có
            if (!preg_match('/rel=["\'].*nofollow.*["\']/', $link)) {
                if (preg_match('/rel=["\']([^"\']*)["\']/', $link, $relMatch)) {
                    $rel = $relMatch[1] . ' nofollow';
                    $link = preg_replace('/rel=["\'][^"\']*["\']/', 'rel="' . trim($rel) . '"', $link);
                } else {
                    $link = preg_replace('/<a/i', '<a rel="nofollow"', $link);
                }
            }

            // Thêm class để JS đếm click
            if (!preg_match('/class=["\']([^"\']*)["\']/', $link)) {
                $link = preg_replace('/<a/i', '<a class="sel-external"', $link);
            } else {
                $link = preg_replace('/class=["\']([^"\']*)["\']/', 'class="$1 sel-external"', $link);
            }

            return $link;
        },
        $content
    );
}
add_filter('the_content', 'sel_modify_external_links');

function sel_enqueue_scripts() {
    wp_enqueue_script('sel-track-clicks', plugin_dir_url(__FILE__) . 'js/track-clicks.js', [], '1.0', true);
}
add_action('wp_enqueue_scripts', 'sel_enqueue_scripts');
