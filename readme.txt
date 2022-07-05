=== Age Verification ===
Contributors: deviodigital
Donate link: https://www.deviodigital.com
Tags: age-verify, dispensary, adults-only, verification, modal, alcohol, cannabis, marijuana, age-verification, over-16, over-18, over-19, over-20, over-21, pop-up, popup, restrict, splash screen, verify
Requires at least: 4.6
Tested up to: 6.0.0
Stable tag: 2.9.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Check a visitors age before allowing them to view your website.

== Description ==

### Age Verification for WordPress

Add a pop-up window to your website and verify the age of the visitor before allowing them to view your content.

Customize a variety of features in the age verification box.

*   Minimum age
*   Background image
*   Logo image
*   Title text
*   Message text
*   Yes/No button text

You can customize your age verification pop up by going to `Appearance -> Customize -> Age Verification` in your WordPress dashboard.

There is also a cookie that gets saved for 30 days when the user selects the "Yes" button.

## Translations

Age Verification for WordPress has been translated into the following languages:

*   Afrikaans
*   Czech
*   German
*   Spanish
*   Spanish (Mexico)
*   Finnish
*   French
*   Italian

## Age Verification Pro

Customize your age verification pop up even more by using our [Age Verification Pro](https://deviodigital.com/product/age-verification-pro/) plugin.

### Pro features

*   Set the amount of days to save cookies
*   Turn on debug to test popup changes without saving cookies
*   Customize the Success & Failure messages (title & text)

**Pro color customizations**

*   Page background color
*   Popup background color
*   Title text color
*   Message text color
*   "No" button colors
*   "Yes" button colors

== Installation ==

1. Go to `Plugins -> Add New` and search for `Age Verification`.
2. Install & Activate the **Age Verification** plugin.
3. Customize the settings by going to `Appearance -> Customize -> Age Verification`.

== Screenshots ==

1. Example of the background image feature
2. Example of the default age verification pop up modal box
3. All of the available customizer options in the free version
4. All of the available customizer options in the Pro version

== Changelog ==

= 2.9.0 =
*   Added new Afrikaans translation in `languages/dispensary-age-verification-af.po`
*   Added new Afrikaans translation in `languages/dispensary-age-verification-af.mo`
*   Added new Finnish translation in `languages/dispensary-age-verification-fi_FI.po`
*   Added new Finnish translation in `languages/dispensary-age-verification-fi_FI.mo`

= 2.8.0 =
*   Added new Czech translation in `languages/dispensary-age-verification-es_MX.pot`
*   Added new Spanish (Mexico) translation in `languages/dispensary-age-verification-cs_CZ.pot`
*   Bug fix 'TypeError: $.ageCheck is not a function' error in `public/class-dispensary-age-verification-public.php`
*   Updated text strings for localization in multiple language translation files in `languages/`
*   WordPress Coding Standards throughout multiple files in the plugin

= 2.7.0 =
*   Updated various security related issues found with [Codacy](https://codacy.com) throughout multiple files in the plugin

= 2.6.0 =
*   Added new German translation in `languages/dispensary-age-verification-de_DE.pot`
*   Added option in the customizer settings to set timeout for the success message in `includes/customizer.php`
*   Added `dav_sanitize_select` helper function for the customizer settings in `includes/customizer.php`
*   Updated translation array with `successMessage` array item in `public/class-dispensary-age-verification-public.php`
*   Updated text strings for localization in `languages/dispensary-age-verification.pot`
*   Updated text strings for localization in `languages/dispensary-age-verification-es_ES.pot`
*   Updated text strings for localization in `languages/dispensary-age-verification-fr_FR.pot`
*   Updated text strings for localization in `languages/dispensary-age-verification-it_IT.pot`
*   General code cleanup in multiple files

= 2.5.0 =
*   Added new Spanish translation in `languages/dispensary-age-verification-es_ES.pot`
*   Added new French translation in `languages/dispensary-age-verification-fr_FR.pot`
*   Added new Italian translation in `languages/dispensary-age-verification-it_IT.pot`
*   Updated `.pot` file name and updated text strings for localization in `languages/dispensary-age-verification.pot`

= 2.4.0 =
*   Added admin notice based on installed version of AVWP Pro in `dispensary-age-verification.php`
*   Updated public CSS enqueue to use the minified file version in `public/class-dispensary-age-verification-public.php`
*   Updated `.pot` file name and updated text strings for localization in `languages/avwp.pot`
*   Updated the plugin text-domain from `dispensary-age-verification` to `avwp` in multiple files
*   Updated Class names to use use the `Age_Verification` prefix (removing 'Dispensary') in multiple files
*   Updated function names to use the `avwp` prefix in multiple files
*   Updated CSS class names to use the `avwp` prefix in multiple files
*   General code cleanup in multiple files

= 2.3.2 =
*   Added `avwp_hex2rgba` helper function in `includes/age-verification-functions.php`

= 2.3.1 =
*   Updated the YES/NO button order in the customizer settings in `includes/customizer.php`
*   Updated the YES/NO button order in the popup in `public/js/dispensary-age-verification-public.js`
*   Updated the YES/NO button styles in `public/css/dispensary-age-verification-public.css`
*   Updated popup title to not display if the setting is empty in `public/js/dispensary-age-verification-public.js`
*   Updated text strings for localization in `languages/dispensary-age-verification.pot`
*   General code cleanup in multiple files

= 2.3.0 =
*   Added 2 new filters for before/after the popup content in `public/class-dispensary-age-verification-public.php`
*   Updated the popup to include the before/after filters in `public/js/dispensary-age-verification-public.js`
*   Updated the popup background image CSS in `public/class-dispensary-age-verification-public.php`
*   Updated text strings for localization in `languages/dispensary-age-verification.pot`
*   General code cleanup in multiple files

= 2.2.0 =
*   Added `avwp_localize_script_translation_array` filter in `public/class-dispensary-age-verification-public.php`
*   Bugfix for empty background image CSS overriding background color in `public/class-dispensary-age-verification-public.php`
*   Updated $translation_array data in `public/class-dispensary-age-verification-public.php`
*   Updated prefix for `dav_redirect_on_fail_link` filter to use avwp instead of dav in `public/class-dispensary-age-verification-public.php`
*   Updated priority order for settings controls in `includes/customizer.php`
*   Updated text strings for localization in `languages/dispensary-age-verification.pot`
*   General code cleanup in multiple files

= 2.1.0 =
*   Added JavaScript functions for cookie that saves to users computer for 30 days when they verify their age in `public/js/js.cookie.js`
*   Added cookie that saves to users computer for 30 days when they verify their age in `public/js/dispensary-age-verification-public.php`
*   Added `dav_redirect_on_fail_link` filter for the pop up in `public/class-dispensary-age-verification.php`
*   Updated check for popup to remain hidden when checkbox is selected in the Customizer in `public/class-dispensary-age-verification.php`
*   General code cleanup in multiple files

= 2.0.1 =
*   Updated text strings for localization in `includes/customizer.php`
*   Updated `.pot` file with text strings for localization in `languages/dispensary-age-verification.pot`
*   Removed CSS and JS file from loading on admin screens in `includes/class-dispensary-age-verification.php`
*   General code cleanup in multiple files

= 2.0.0 =
*   Added a background image option to customizer
*   Added Yes/No button text options to customizer
*   Updated multiple styles for the pop up modal

= 1.9.0 =
*   Updated multiple styles for the pop up modal (text, titles, buttons)

= 1.8.0 =
*   Fixes bug where the pop up opened on every single page

= 1.7.0 =
*   Changed the birthday input for a simple YES/NO button selection

= 1.6.0 =
*   Added option to Customizer to hide the modal pop up for Administrator users

= 1.5.0 =
*   Fixed bug with the logo upload not displaying on the live site

= 1.4.0 =
*   Fixed bug with form not recognizing the right age input by the user

= 1.3.0 =
*   Fixed bug with [age] selector not working correctly.
*   Fixed bugs with the default customizer options not working correctly on fresh installs

= 1.2.0 =
*   Uploaded missing `customizer.php` file from version 1.1
*   Added new [age] selector in the pop up text which updates to the minimum age requirement you select in the customizer

= 1.1.0 =
*   Added Theme Customizer options to allow users to customize the pop up title, copy, minimum age and logo upload

= 1.0.1 =
*   Removed bug that redirected visitors to the wrong URL after form submissions (thanks [@VanSmoke](https://twitter.com/VanSmokecom))

= 1.0.0 =
*   Initial release
