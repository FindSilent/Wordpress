=== Smart External Links ===
Contributors: your-name
Tags: external links, nofollow, target blank, outbound links, link tracking, google analytics
Requires at least: 5.0
Tested up to: 6.5
Requires PHP: 7.2
Stable tag: 1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Automatically add rel="nofollow" and target="_blank" to external links. Exclude specific domains, open links in new tabs, and track outbound link clicks via Google Analytics.

== Description ==

**Smart External Links** helps you automatically handle outbound links on your WordPress site by:

- ✅ Adding `rel="nofollow"` to external links.
- ✅ Adding `target="_blank"` to open external links in a new tab.
- ✅ Excluding specific domains from `nofollow` rules (e.g. affiliates, partners).
- ✅ Tracking clicks on external links using Google Analytics (GA4).
- ✅ Lightweight, no third-party libraries required.

This plugin is ideal for SEO-conscious publishers, affiliate marketers, and site owners who want better control over external linking.

== Features ==

- Auto-detects external links and appends `rel="nofollow"` and `target="_blank`".
- Exclude specific domains (e.g., your affiliate links or trusted partners).
- Optionally open external links in new tabs.
- Click tracking using Google Analytics (`gtag.js`, GA4 event format).
- Simple and easy-to-use settings page.

== Installation ==

1. Upload the plugin folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the **Plugins** menu in WordPress.
3. Go to **Settings → External Links** to configure domain exclusions and behaviors.

== Usage ==

1. By default, all external links in post content will open in a new tab and have `rel="nofollow"`.
2. To exclude specific domains from this behavior (e.g. example.com), enter each domain in the **Exclude Domains** setting (one per line).
3. Click tracking works automatically if your site is using Google Analytics 4 with `gtag.js`.

== Frequently Asked Questions ==

= Does it support Classic Editor and Block Editor? =
Yes, it works with both editors since it filters the final rendered content.

= Will it affect internal links? =
No. It only applies to links that point to external domains (different from your site URL).

= How are clicks tracked in GA4? =
The plugin fires a `click_external_link` event with event category "Outbound" and label as the clicked URL. This works with `gtag.js`.

== Screenshots ==

1. Settings page: Configure excluded domains and target behavior.
2. Example: External links automatically updated with rel and target attributes.

== Changelog ==

= 1.0 =
* Initial release with nofollow, target blank, exclusion list, and GA4 outbound click tracking.

== Upgrade Notice ==

= 1.0 =
First stable version. Basic outbound link enhancements and tracking included.

== License ==

This plugin is licensed under the GPLv2 or later.
========================

## 🔍 Xem thống kê click link ngoài trong Google Analytics 4

### ✅ Bước 1: Đảm bảo tracking đã hoạt động

* Vào trang web bạn, mở DevTools (F12) > tab **Console**
* Nhấp một link ngoài bất kỳ
* Kiểm tra có dòng như:

  ```
  Clicked external link: https://external-site.com
  ```
* Nếu có: plugin và JS đang hoạt động.

---

### ✅ Bước 2: Xem sự kiện trong GA4

1. **Vào Google Analytics 4**
2. Chọn **“Báo cáo” (Reports)** → **Sự kiện (Events)**
   Đường dẫn: `Báo cáo > Gắn thẻ sự kiện > Tất cả các sự kiện`
3. Tìm sự kiện có tên: `click_external_link`
4. Nhấp vào đó để xem chi tiết:

   * Tổng số lần nhấp
   * URL được nhấp (event label)
   * Thiết bị, nguồn truy cập, v.v.

---

## 🎯 Mẹo nâng cao: Tạo báo cáo tùy chỉnh

Bạn có thể tạo báo cáo riêng cho sự kiện này:

### Bằng **Khám phá (Explore)** trong GA4:

1. Vào GA4 > **Khám phá (Explore)**
2. Chọn loại khám phá **Tự do (Free form)**
3. Thêm **“Event name”** vào Bộ lọc (Filters) → `click_external_link`
4. Thêm **event\_label** (URL) vào trục hàng
5. Thêm **số lượt nhấp (event count)** vào giá trị

📊 Bạn sẽ thấy báo cáo có dạng:

| Liên kết ngoài                             | Số lần nhấp |
| ------------------------------------------ | ----------- |
| [https://abc.com](https://abc.com)         | 24          |
| [https://example.org](https://example.org) | 17          |

---

## ❓ Muốn xem trực tiếp trong WordPress?

Hiện tại plugin chưa lưu dữ liệu vào database. Nếu bạn muốn:

* Hiển thị số click theo từng link ngay trong WordPress,
* Thống kê theo thời gian (ngày/tuần/tháng),
* Không dùng Google Analytics (có thể nội bộ lưu)

→ Mình có thể mở rộng plugin để **ghi log click vào DB hoặc file**, và thêm **bảng thống kê admin**.

📌 Bạn có muốn mình tích hợp phần thống kê ngay trong WordPress không?
