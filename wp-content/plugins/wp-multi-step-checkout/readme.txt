=== WooCommerce Multi-Step Checkout ===
Created: 30/10/2017
Contributors: diana_burduja
Email: diana@burduja.eu
Tags: multistep checkout, multi-step-checkout, woocommerce, checkout, shop checkout, checkout steps, checkout wizard, checkout style, checkout page
Requires at least: 3.0.1
Tested up to: 5.2 
Stable tag: 2.1 
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
Requires PHP: 5.2.4

Change your WooCommerce checkout page with a multi-step checkout page. This will let your customers have a faster and easier checkout process, therefore a better conversion rate for you.


== Description ==

Create a better user experience by splitting the checkout process in several steps. This will also improve your conversion rate.

The plugin was made with the use of the WooCommerce standard templates. This ensure that it should work with most the themes out there. Nevertheless, if you find that something isn't properly working, let us know in the Support forum.

= Features =

* Sleak design
* Mobile friendly
* Responsive layout
* Adjust the main color to your theme
* Inherit the form and buttons design from your theme
* Keyboard navigation

= Available translations = 

* German
* French

Tags: multistep checkout, multi-step-checkout, woocommerce, checkout, shop checkout, checkout steps, checkout wizard, checkout style, checkout page

== Installation ==

* From the WP admin panel, click "Plugins" -> "Add new".
* In the browser input box, type "WooCommerce Multi-Step Checkout".
* Select the "WooCommerce Multi-Step Checkout" plugin and click "Install".
* Activate the plugin.

OR...

* Download the plugin from this page.
* Save the .zip file to a location on your computer.
* Open the WP admin panel, and click "Plugins" -> "Add new".
* Click "upload".. then browse to the .zip file downloaded from this page.
* Click "Install".. and then "Activate plugin".

OR...

* Download the plugin from this page.
* Extract the .zip file to a location on your computer.
* Use either FTP or your hosts cPanel to gain access to your website file directories.
* Browse to the `wp-content/plugins` directory.
* Upload the extracted `wp-image-zoooom` folder to this directory location.
* Open the WP admin panel.. click the "Plugins" page.. and click "Activate" under the newly added "WooCommerce Multi-Step Checkout" plugin.

== Frequently Asked Questions ==

= The login form isn't showing in the wizard =
Please check the 'Display returning customer login reminder on the "Checkout" page' option found on the WP Admin -> WooCommerce -> Settings -> Accounts page

= Is the plugin GDPR compatible? =
The plugin doesn't add any cookies and it doesn't modify/add/delete any of the form fields. It simply reorganizes the checkout form into steps.

== Screenshots ==

1. Login form
2. Billing
3. Review Order
4. Choose Payment
5. Settings page
6. On mobile devices

== Changelog ==

= 2.1 =
* 05/30/2019
* Fix: the coupon form was not showing up
* Show warning about an option in the German Market plugin

= 2.0 =
* 05/24/2019
* Warning: plugin incompatible with the Suki theme
* Code refactory so to allow programatically to add/remove/modify steps

= 1.20 =
* 05/08/2019
* Fix small issues with the WooCommerce Germanized plugin
* Declare compatibility with WordPress 5.2

= 1.19 =
* 04/27/2019
* Feature: compatibility with the WooCommerce Points and Rewards plugin 
* Declare compatibility with WooCommerce 3.6
* Tweak: update the Bootstrap library used in the admin side to 3.4.1 version

= 1.18 =
* 04/12/2019
* Fix: the "Your Order" section is squished in half a column on the Storefront theme
* Fix: don't toggle the coupon form on the Avada theme
* Fix: remove constantly loading icon from the Zass theme

= 1.17 =
* 02/24/2019
* Feature: add the "wpmc_before_switching_tab" and "wpmc_after_switching_tab" JavaScript triggers to the ".woocommerce-checkout" element
* Fix: design error with WooCommerce Germanized and "Order & Payment" steps together
* Fix: small design fixes for the Avada theme
* Admin notice for "WooCommerce One Page Checkout" option for Avada theme 

= 1.16.2 =
* 02/18/2019
* Fix: PHP warnings when WooCommerce Germanized isn't installed

= 1.16.1 =
* 02/17/2019
* Fix: use the available strings from WooCommerce Germanized so the translation doesn't break

= 1.16 =
* 02/14/2019
* Fix: input fields for the Square payment gateway were too small
* Fix: "load_text_domain" is loaded now in the "init" hook 
* Fix: the steps were shown over the header if the header was transparent
* Fix: adjust the checkout form template for the Avada theme
* Fix: with Visual Composer the "next" and "previous" buttons weren't clickable on iPhone 
* Fix: spelling errors in the nl_NL translation
* Compatibility with the WooCommerce Germanized plugin

= 1.15 =
* 12/27/2018
* Tweak: show a warning about the "Multi-Step Checkout" option for the OceanWP theme
* Compatibility with the WooCommerce Social Login plugin from SkyVerge
* Add nl_NL, nl_BE, fr_CA, fr_BE, de_CH languages
* Feature: option for the sign between two united steps. For example "Billing & Shipping"

= 1.14 =
* 12/04/2018
* Fix: set "padding:0" to the steps in order to normalize to all the themes
* Fix: the "WooCommerce not installed" message was showing up even if WooCommerce was installed
* Fix: small design changes for the Flatsome, Enfold and Bridge themes  
* Fix: load the CSS and JS assets only on the checkout page

= 1.13 =
* 10/03/2018
* remove PHP notice when WPML option isn't enabled

= 1.12 =
* 09/06/2018
* New: the plugin is multi-language ready

= 1.11 =
* 07/28/2018
* Fix: warning for sizeof() in PHP >= 7.2
* Fix: rename the CSS enqueue identifier
* Tweak: rename the "Cheating huh?" error message

= 1.10 =
* 06/25/2018
* Fix: PHP notice for WooCommerce older than 3.0
* Fix: message in login form wasn't translated

= 1.9 =
* 05/21/2018
* Change: add instructions on how to remove the login form
* Fix: add the `woocommerce_before_checkout_form` filter even when the login form is missing
* Compatibility with the Avada theme
* Tweak: for Divi theme add the left arrow for the "Back to cart" and "Previous" button

= 1.8 =
* 03/31/2018
* Tweak: add minified versions for CSS and JS files
* Fix: unblock the form after removing the .processing CSS class
* Fix: hide the next/previous buttons on the Retailer theme 

= 1.7 =
* 02/07/2018
* Fix: keyboard navigation on Safari/Chrome
* Fix: correct Settings link on the Plugins page
* Fix: option for enabling the keyboard navigation

= 1.6 =
* 01/19/2018
* Fix: center the tabs for wider screens
* Fix: show the "Have a coupon?" form from WooCommerce

= 1.5 =
* 01/18/2018
* Fix: for logged in users show the "Next" button and not the "Skip Login" button

= 1.4 =
* 12/18/2017
* Feature: allow to change the text on Steps and Buttons
* Tweak: change the settings page appearance
* Fix: change the "Back to Cart" tag from <a> to <button> in order to keep the theme's styling
* Add French translation

= 1.3 =
* 12/05/2017
* Add "language" folder and prepare the plugin for internationalization
* Add German translation

= 1.2 =
* 11/20/2017
* Fix: the steps were collapsing on mobile
* Fix: arrange the buttons in a row on mobile

= 1.1 =
* 11/09/2017
* Add a Settings page and screenshots
* Feature: scroll the page up when moving to another step and the tabs are out of the viewport

= 1.0 =
* 10/30/2017
* Initial commit

== Upgrade Notice ==

Nothing at the moment
