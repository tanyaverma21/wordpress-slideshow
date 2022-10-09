# wordpress-slideshow

Tags: comments, spam
Requires at least: 4.5
Tested up to: 6.0.2
Requires PHP: 5.6
Stable tag: 0.1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A plugin to allow editor to create and manage slideshow.

== Description ==

A plugin to allow editor to create and manage slideshow.

== Installation ==

1. Upload `wordpress-slideshow` directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Run **yarn install** followed by 'yarn build:prod:all' inside plugins/wordpress-slideshow/ directory to install required webpack modules.
4. Run **composer update** inside plugins/wordpress-slideshow/ directory to install composer dependencies.

== Working ==

1. After the plugin activation in WP Admin, a menu page will be created named as, 'Slideshow'.
2. On that page, various settings related to Slideshow Configurations are given.
3. After configurations, add/edit any Page in **Pages**.
4. Add shortcode [wp_slideshow] on that page.
5. View the page on the frontend.

== Changelog ==

= 1.0 =
* Latest Changes

== Arbitrary section ==

1. Settings Page in WordPress Admin Area.
2. Upload Multiple Image Interface.
3. Display Slideshow on any frontend page with the help of a shortcode [wp-slideshow].
