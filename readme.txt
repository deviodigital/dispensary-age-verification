=== Age Verification ===
Contributors: deviodigital
Donate link: https://www.deviodigital.com
Tags: age-verify, dispensary, adults-only, modal, alcohol, cannabis, marijuana, age-verification, over-16, over-18, over-19, over-20, over-21, pop-up, popup, restrict, splash screen, verify
Requires at least: 3.0.1
Tested up to: 5.2
Stable tag: 2.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Check a visitors age before allowing them to view your dispensary website.

== Description ==

### Age Verification for WordPress
Add a pop-up window to your website and verify the age of the visitor before allowing them to view your content.

Customize a variety of features in the age verification box.

* Background image
* Logo image
* Title text
* Message text
* Minimum age
* Yes/No button text

You can customize your age verification pop up by going to `Appearance -> Customize -> Age Verification` in your WordPress dashboard.

== Installation ==

1. Go to `Plugins -> Add New` and search for `Age Verification`.
2. Install & Activate the **Age Verification** plugin.
3. Customize the settings by going to `Appearance -> Customize -> Age Verification`.

== Screenshots ==

1. Example of the background image feature
2. Example of the default age verification pop up modal box
3. All of the available customizer options

== Changelog ==

= 2.0.1 =
* Updated text strings for localization in `includes/customizer.php`
* Updated `.pot` file with text strings for localization in `languages/dispensary-age-verification.pot`
* Removed CSS and JS file from loading on admin screens in `includes/class-dispensary-age-verification.php`
* General code cleanup in multiple files

= 2.0 =
* Added a background image option to customizer
* Added Yes/No button text options to customizer
* Updated multiple styles for the pop up modal

= 1.9 =
* Updated multiple styles for the pop up modal (text, titles, buttons)

= 1.8 =
* Fixes bug where the pop up opened on every single page

= 1.7 =
* Changed the birthday input for a simple YES/NO button selection

= 1.6 =
* Added option to Customizer to hide the modal pop up for Administrator users

= 1.5 =
* Fixed bug with the logo upload not displaying on the live site

= 1.4 =
* Fixed bug with form not recognizing the right age input by the user

= 1.3 =
* Fixed bug with [age] selector not working correctly.
* Fixed bugs with the default customizer options not working correctly on fresh installs

= 1.2 =
* Uploaded missing `customizer.php` file from version 1.1
* Added new [age] selector in the pop up text which updates to the minimum age requirement you select in the customizer

= 1.1 =
* Added Theme Customizer options to allow users to customize the pop up title, copy, minimum age and logo upload

= 1.0.1 =
* Removed bug that redirected visitors to the wrong URL after form submissions (thanks [@VanSmoke](https://twitter.com/VanSmokecom))

= 1.0 =
* Initial release
