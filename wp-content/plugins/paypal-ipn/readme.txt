=== PayPal IPN for WordPress ===
Contributors: angelleye
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=RP48QUAJW2ZT4
Tags: paypal, ipn, instant payment notification, automation
Requires at least: 3.8
Tested up to: 4.8
Stable tag: 1.1.1
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Developed by an Ace Certified PayPal Developer, official PayPal Partner, PayPal Ambassador, and 3-time PayPal Star Developer Award Winner.

== Description ==

= Introduction =

A PayPal Instant Payment Notification (IPN) toolkit that helps you automate tasks in real-time when transactions hit your PayPal account.

 * All PayPal IPN data is saved and available in your WordPress admin panel.
 * Developer hooks are provided for triggering events based on the transaction type or payment status of the IPN.
 * Extend the plugin with your own plugins or theme functions, or check out our premium extensions for easy automation of various tasks.

= Premium Extensions =

If you are not a developer (or simply wish to save some time) you can still take advantage of PayPal IPN by adding our premium extensions to this plugin.

 * [PayPal IPN Forwarder](https://www.angelleye.com/product/wordpress-paypal-ipn-forwarder/) - Automatically forward PayPal's IPN data to additional IPN listener URLs.
 * [PayPal IPN MailChimp](https://www.angelleye.com/product/paypal-ipn-for-wordpress-paypal-mailchimp-plugin/) - Automatically add the email address from PayPal transactions to a MailChimp mailing list.
 * More coming soon!

= Localization =
PayPal IPN for WordPress was developed with localization in mind and is ready for translation.

If you're interested in helping translate please [let us know](http://www.angelleye.com/contact-us/)!

= Get Involved =
Developers can contribute to the source code on the [PayPal IPN for WordPress Git repository on BitBucket](https://bitbucket.org/angelleye/paypal-ipn-for-wordpress).

== Installation ==

= Automatic installation =

Automatic installation is the easiest option as WordPress handles the file transfers itself and you don't need to leave your web browser. To do an automatic install, log in to your WordPress dashboard, navigate to the Plugins menu and click Add New.

In the search field type "PayPal IPN" and click Search Plugins. Once you've found our plugin you can view details about it such as the the rating and description. Most importantly, of course, you can install it by simply clicking Install Now.

= Manual Installation =

1. Unzip the files and upload the folder into your plugins folder (/wp-content/plugins/) overwriting previous versions if they exist
2. Activate the plugin in your WordPress admin area.

== Screenshots ==

1. Categorized browser for all IPN transactions.
2. Parsed transaction data for an individual IPN.
3. Hook function template for copy/paste into projects.

== Frequently Asked Questions ==

= What is PayPal Instant Payment Notification (IPN)? =

Instant Payment Notification (IPN) is a message service that notifies you of events related to PayPal transactions. You can use IPN messages to automate back-office and administrative functions, such as fulfilling orders, tracking customers, and providing status and other transaction-related information.

Some things you could potentially do with IPN are...

* Automatically generate custom, branded email notifications for buyers and/or sellers.
* Automatically update databases when transactions occur for customer, order, and inventory tracking.
* Automatically post new messages on a Facebook or Twitter account when an item sells.
* Automatically deliver e-goods for digital products like music, videos, and documents.

You can automate all sorts of things with IPN, so the list really goes on and on.  Also, it all happens in instantly as transactions hit your PayPal account.  It's really a very powerful tool that too few people utilize.

= How do I enable IPN in my PayPal account? =

* Take a look at [PayPal's IPN Setup Guide](https://developer.paypal.com/docs/classic/ipn/integration-guide/IPNSetup/) for details on enabling IPN within your PayPal account.
* You can find your IPN URL under Settings -> PayPal IPN in your WordPress admin panel.

= Where can I find more detailed documentation? =

* We have [documentation available on our website](http://www.angelleye.com/category/docs/paypal-ipn-for-wordpress/).

= Why am I not seeing transactions in my PayPal IPN dashboard in WordPress? =

* Make sure you have added the IPN URL for the plugin (Available in WordPress under Settings -> PayPal IPN) to your PayPal profile under the [IPN settings area](https://developer.paypal.com/webapps/developer/docs/classic/ipn/integration-guide/IPNSetup/).
* If you are using PayPal Standard Payments buttons, make sure you don't have the "notify" parameter set to some other URL.
* If you are using PayPal API's, make sure you don't have the NOTIFYURL parameter set to some other URL.
* If you still have problems you may [start a thread in the plugin support forum](https://wordpress.org/support/plugin/paypal-ipn).

= How can I test that my IPN solution is working as expected? =

* Take a look at [this article I wrote covering the topic of general IPN testing and troubleshooting](https://www.angelleye.com/test-paypal-ipn/).  I think it will help!

== Changelog ==

= 1.1.1 - 09.19.2017 =

* Feature - New hooks for "ipn_response_verified" and "ipn_response_invalid". ([#87](https://bitbucket.org/angelleye/paypal-ipn-for-wordpress/issues/87/add-hooks-for-ipn-status))
* Tweak - Adjusts URL forwarding filters to improve functionality. ([#84](https://bitbucket.org/angelleye/paypal-ipn-for-wordpress/issues/84/problems-with-forwarder-url-filter))
* Tweak - Clean post-meta data when IPN records are deleated. [(#85](https://bitbucket.org/angelleye/paypal-ipn-for-wordpress/issues/85/database-cleanup))
* Tweak - Tighter integration with PayPal Standard and PayPal Plus to avoid IPN conflicts. ([#86](https://bitbucket.org/angelleye/paypal-ipn-for-wordpress/issues/86/exclude-paypal-plus-and-paypal-standard))
* Tweak - Adjusts date / time stamps for local server time. ([#88](https://bitbucket.org/angelleye/paypal-ipn-for-wordpress/issues/88/ipn-timestamp-local-time-option))
* Tweak - Adjustments to avoid Google crawlers indexing IPN records. ([#93](https://bitbucket.org/angelleye/paypal-ipn-for-wordpress/issues/93/ipn-data-is-getting-indexed-by-search))


= 1.1.0 - 10.12.2016 =
* Feature - Adds premium extension library. ([#51](https://bitbucket.org/angelleye/paypal-ipn-for-wordpress/issues/51/plugin-directory))
* Fix - Resolves missing amount data for new subscription sign ups. ([#64](https://bitbucket.org/angelleye/paypal-ipn-for-wordpress/issues/64/subscription-transactions-do-not-show-date))
* Fix - Resolves the broken link from the settings page to the PayPal IPN Configuration Guide. ([#71](https://bitbucket.org/angelleye/paypal-ipn-for-wordpress/issues/71/fix-link-to-ipn-setup-guide)
* Fix - Adds a content-type header to IPNs that get forwarded (using our Forwarder premium extension) to resolve issues with 3rd party IPN handlers that require it. ([#73](https://bitbucket.org/angelleye/paypal-ipn-for-wordpress/issues/73/add-content-type-to-forwarded-ipn-data))
* Fix - Resolves a PHP notice. ([#76](https://bitbucket.org/angelleye/paypal-ipn-for-wordpress/issues/76/php-notice-report))
* Fix - Resolves an issue causing refund IPN data to fail triggering its hook. ([#78](https://bitbucket.org/angelleye/paypal-ipn-for-wordpress/issues/78/problem-with-refund-transactions-not))
* Fix - Resolves an issue with Prettify JavaScript. ([#79](https://bitbucket.org/angelleye/paypal-ipn-for-wordpress/issues/79/google-run_prettifyjs-is-coming-up-404-not))
* Tweak - Removes unnecessary enqueued scripts. ([#65](https://bitbucket.org/angelleye/paypal-ipn-for-wordpress/issues/65/enqueued-script-adjustments))
* Tweak - Adjusts sorting on table output by shortcode. ([#62](https://bitbucket.org/angelleye/paypal-ipn-for-wordpress/issues/62/adjustment-to-table-list-shortcode))
* Tweak - Makes arrangements for additional functionality. (Smarter Forwarding) to be added to our IPN Forwarder premium extension. ([#66](https://bitbucket.org/angelleye/paypal-ipn-for-wordpress/issues/66/smarter-forwarding))
* Tweak - Hides View and Edit links because there is no public view for the IPN data. ([#69](https://bitbucket.org/angelleye/paypal-ipn-for-wordpress/issues/69/view-link-goes-to-404-not-found))
* Tweak - Adds functionality to handle URL name from the IPN Forwarder premium extension. ([#68](https://bitbucket.org/angelleye/paypal-ipn-for-wordpress/issues/68/forwarder-url-filter))
* Tweak - Updates IPN verification endpoints. ([#70](https://bitbucket.org/angelleye/paypal-ipn-for-wordpress/issues/70/ipn-verify-endpoint-updates-and-ssl))
* Tweak - Adjustments to enqueued scripts for performance improvements. ([#75](https://bitbucket.org/angelleye/paypal-ipn-for-wordpress/issues/75/performance-improvement))
* Tweak - Adjusts date format in IPN log. ([#82](https://bitbucket.org/angelleye/paypal-ipn-for-wordpress/issues/82/date-format-adjustment))

= 1.0.8 - 08.29.2015 =
* Fix - Resolves PHP notices when activating the plugin in WordPress 4.3.

= 1.0.7 - 07.13.2015 =
* Fix - Adds missing files that were keeping shortcodes from functioning properly.
* Fix - Resolves a code logic conflict causing Adaptive Payments hooks to not be triggered.

= 1.0.6 - 05.06.2015 =
* Fix - Resolves a potential SQL injection vulnerability in the IPN filter logic.

= 1.0.5 - 04.30.2015 =
* Fix - Resolves a number of minor bugs.
* Fix - Adds the BAID in the post title for Billing Agreement IPNs.
* Tweak - Adds separate hook for MassPay transactions based on payment status.
* Tweak - Updates the log path to /wp-content/uploads/paypal-ipn-logs/
* Feature - Highlights PayPal sandbox IPNs yellow so that they are easy to recognize.
* Feature - Adds hook function snippet to IPN details page which provides a function template including IPN data parsed to PHP vars.

= 1.0.4 - 03.26.2015 =
* Fix - Resolves issue where direct hits to the IPN URL were creating empty records in the system.
* Fix - Resolves PHP notices when updating plugin.
* Fix - Resolves issue where search functionality was not working correctly.
* Tweak - Search now works across all columns.
* Feature - Adaptive Payments compatibility.

= 1.0.3 - 01.28.2015 =
* Fix - More adjustments to resolve issues with plugin repo name change.
* Fix - Corrects random typos through-out the plugin.

= 1.0.2 - 01.27.2015 =
* Fix - Adjusts areas of the plugin where the slug needed to be updated to match repo name.
* Fix - Adjusts WooCommerce compatibility so that IPN forwarding will not occur unless PayPal Standard is enabled.

= 1.0.1 =
* Fix - Adjusts post type icon so it will work regardless of plugin folder name.

= 1.0.0 =

* Logs all IPN transaction data in the WordPress database.
* Provides developer hooks for extending functionality and automating tasks within extension plugins.