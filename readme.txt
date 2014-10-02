=== Sermon Manager ===
Contributors: wpforchurch
Donate link: http://wpforchurch.com/
Tags: church, sermon, sermons, preaching, podcasting
Requires at least: 3.6
Tested up to: 3.9
Stable tag: 1.9.2

Add audio and video sermons, manage speakers, series, and more to your church website

== Description ==

Sermon Manager is designed to help churches easily publish sermons online. You can add speakers, sermon series, Bible references etc. 

Sermons can have .mp3 files, as well as pdf, doc, ppt, etc. added to them. Video embeds from sites like Vimeo are also possible.

Images can be attached to any sermon, sermon series, speaker, or sermon topic. There are many filters available for displaying the images in your theme.

It will work with any theme, but themes can be customized to display content as you like. You'll find the template files in the /views folder. You can copy these into the root of your theme folder and customize to suit your site's design. If you need assistance, just post on the forums at WP for Church.

Super flexible shortcode for displaying sermons in page content. (improved pagination in 1.9)

Display the most recent series by service type [latest_series]
Display a grid of images assigned to speakers or series with shortcode [sermon_images]
Display a list of sermon series, preachers, sermon topics, or book of the Bible with shortcode [list_sermons]

iTunes podcasting support for all sermons, plus each sermon series, preachers, sermon topics, or book of the Bible!

Would you like to help develop Sermon Manager? Fork it on [Bit Bucket](https://bitbucket.org/wpforchurch/sermon-manager-for-wordpress)

We want Sermon Manager to be easy to use and to extend for every church. 

= Available Addons =
* [Import MP3 to Sermon Manager](http://wordpress.org/plugins/sermon-manager-import/) from @khornberg

[DEMO](http://demo.wpforchurch.com/sermon-manager/)

You can visit the [plugin's homepage](http://www.wpforchurch.com/products/sermon-manager-for-wordpress/ "Sermon Manager homepage") to get support.

[WP for Church](http://wpforchurch.com/ "WP for Church") provides plugins and responsive themes for churches using WordPress.

Sign up for the [newsletter](http://www.wpforchurch.com/newsletter/)!


== Installation ==

1. Just use the "Add New" button in Plugin section of your WordPress blog's Control panel. To find the plugin there, search for 'Sermon Manager'
1. Activate the plugin 
1. Add a sermon through the Dashboard
1. To display the sermons on the frontend of your site, just visit the http://yourdomain.com/sermons if you have permalinks enabled or http://yourdomain.com/?post_type=wpfc_sermon if not. Or you can use the shortcode [sermons] in any page.
1. Visit [WP for Church](http://wpforchurch.com/ "WP for Church") for support

== Frequently Asked Questions ==

= How do I display sermons on the frontend? =

Visit the http://yourdomain.com/sermons if you have permalinks enabled or http://yourdomain.com/?post_type=wpfc_sermon if not. Or you can use the shortcode [sermons] in any page.

= How do I create a menu link? =

Go to Appearance => Menus. In the "Custom Links" box add "http://yourdomain.com/?post_type=wpfc_sermon" as the url and "Sermons" as the label; click "Add to Menu".

= I wish Sermon Manager could... =

I'm open to suggestions to make this a great tool for churches! Submit your feedback at [WP for Church](http://wpforchurch.com/ "WP for Church") 

= More Questions? =

Visit the [plugin homepage](http://wpforchurch.com/plugins/sermon-manager/ "Sermon Manager homepage")

== Screenshots ==
1. Sermon Details
2. Sermon Files

== Changelog ==

= 1.9.2 =
* improve setting MP3 duration; allow user to edit duration if not set accurately

= 1.9.1 =
* Minor fixes to the [latest_series] shortcode - [updated documentation](http://www.wpforchurch.com/knowledgebase/sermon-manager-shortcodes/)

= 1.9 =
* NEW FEATURE: Podcast feeds for every Preacher, Service Type, Series, Bible Book, and Topic.
* NEW FEATURE: New shortcode to display the latest sermon series image [latest_series] (many options including displaying by service type)
* NEW FEATURE: Admin columns are now sortable - props to @khornberg
* NEW FEATURE: All media is now uploaded to a custom folder /sermons/ under /uploads. This will allow easier media management and exclusion from backups (if desired)
* Remove mediaelement audio player and use the built in mediaelement (now requires WordPress 3.6+)
* Remove dependency on wp-pagenavi for shortcode pagination
* Resolved issue with media player not displaying with shortcodes


= 1.8.3 =
* require WordPress 3.6+ 
* use built in mediaelement player

= 1.8.1 =
* fixed errors with saving settings for some users (remove dependency on CURL)

= 1.8 =
* improved podcasting performance - props @livingos
* cleaned up options page with tabs, added hooks for other plugins to hook into the option page.
* fixed bug causing sermons to display 2x

= 1.7.4 = 
* updated the way attachments are displayed. Now they will be available for download even if not attached to the sermon.
* fix sermon-images shortcode

= 1.7.3 = 
* compatibility with WordPress 3.6

= 1.7.2 =
* disable a filter that was causing problems in some themes (added in 1.7)

= 1.7.1 =
* fix a few bugs introduced in 1.7

= 1.7 =
* Improved many areas of the code; organized files
* Made a new permalink structure possible with a common base slug across all taxonomies, e.g. sermons/preacher or sermons/series.
* Added new template tag for the podcast url
* Add series, preacher, topic, and book to post class
* Trim taxonomy description in Admin
* Improve widget CSS
* Add missing filter for template files
* Add template tags to show preacher and series info on individual sermons
* Allow service type to be empty
* Use date option set in WordPress settings instead of hardcoded format
* Resolve $wpfc_entry_views error with PHP 5.4
* Cleaned up CSS ids and classes to be compliant code

= 1.6 =
* Improved localization & added French translation
* Updated mediaelements.js to the latest version
* Change Service Types to a custom taxonomy so you can add/edit as you wish (you'll see an admin notice to refresh your database)

= 1.5.6 =
* Added comma separator in case of multiple speakers or multiple series
* Added speaker name to widget
* Added "sort by Book" to sermon sort fields

= 1.5.5 =
* Fix settings for bib.ly

= 1.5.4 =
* Added an action 'wpfc_settings_form' to add fields to the settings page
* Fixed bug with sermon topic dropdown

= 1.5.3 =
* Properly prefixed the entry views function to prevent conflicts

= 1.5.2 =
* Only load admin scripts and styles on Sermon pages

= 1.5.1 =
* Improve CSS for Chrome
* Add the option to include the audio player in archive view
* Fix display issues on some themes in archive view

= 1.5 =
* Improve page navigation styles with shortcode
* Improve admin interface & added a "Sermon Notes" field
* Fixed the views count for sermons
* Update function to add images to series & preachers
* Added podcasting with iTunes
* Properly enqueueing all JavaScript and CSS
* New template tags for easier theme customization
* Added new taxonomy "Book of the Bible" to allow easy sorting of sermons
* Display a grid of images assigned to speakers or series with a new shortcode [sermon-images]
* Display a list of sermon series, preachers, sermon topics, or book of the Bible with a new shortcode [list-sermons]

= 1.3.3 =
* Bug fix with menu not showing in some themes 

= 1.3.1 =
* Bug fix with Service Type not saving correctly 

= 1.3 = 
* Added a settings page
* Now translation ready!
* Added styling to the Recent Sermons Widget
* Added featured image to individual sermons 
* Added images to sermon topics 
* Created new functions to render sermon archive listing and single sermons
* Added better sorting fields on archive page
* Added shortcode to insert sort fields - sermon_sort_fields

= 1.2.1 =
* Enhanced shortcode to allow for Ajax pagination
* Requires a plugin for pagination in shortcode to work: http://wordpress.org/extend/plugins/wp-pagenavi/

= 1.2 =
* Shortcode completely updated with [documentation](http://www.wpforchurch.com/882/sermon-shortcode/) 

= 1.1.4 =
* Now you can add images to sermon series and preachers! 
* Widget now includes the sermon date
* Added icons for audio and video attachments

= 1.1.3 =
* Theme developers can add support for sermon manager to their theme with `add_theme_support( 'sermon-manager' );` in functions.php. For now, this will disable the loading of the jwplayer javascript
* Bug fix to load javascript for sermon player and verse popups on single sermon pages only
* minor CSS fix to increase font size of popup Bible passages

= 1.1.2 =
* bug fixes so everything saved correctly when doing autosave, quick edit, and bulk edit
* minor CSS fix for icon to display with additional files

= 1.1.1 =
* bug fixes to templating system
* minor CSS fixes

= 1.1 =
* New much improved templating system! 
* Bug fixes related to the loading of javascript and CSS

= 1.0 =
* Fixes related to WordPress 3.3; takes advantage of new tinymce editor

= 0.9 =
* Added WYSIWYG editor to the sermon description field

= 0.8 =
* Added Widgets

= 0.7 =
* Bug Fixes

= 0.6 =
* initial public release