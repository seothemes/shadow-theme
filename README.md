# Shadow Theme

* Theme URI: [https://seothemes.net/themes/shadow/](https://seothemes.net/themes/shadow/)
* Description: A mobile first blogging Genesis child theme inspired by [Ghost](https://ghost.org/).
* Author: Seo Themes
* Author URI: [http://seothemes.net/](http://seothemes.net/)
* Version: 0.1.0
* Tags: one-column, responsive-layout, custom-menu, custom-logo, custom-header, custom-background, full-width-template, sticky-post, theme-options, threaded-comments, black, white.
* Template: genesis
* Template Version: 2.2.4
* License: [GPL-2.0+](http://www.opensource.org/licenses/gpl-license.php)


## Installation

***Please note that this theme requires the Genesis Framework***

1. Upload and install the Genesis Framework theme.
2. Upload, install and activate the Shadow child theme.
3. Install and activate recommended plugins.
4. Import demo content *(sample.xml)* with the **WordPress Importer**
5. Import widgets demo content *(widgets.wie)* with the **Widget Importer & Exporter** plugin.
6. Create navigation menus from ***Appearance > Menus***


## Recomended Plugins

After you have activated the Shadow theme, a Recommended Plugins notice will appear in the WordPress dashboard. Click 'Begin installing plugins' and follow the steps to install and activate all of the plugins recommended by the theme. This theme recommends the following:

* ### [EA Share Count](https://github.com/jaredatch/EA-Share-Count)
	* Add social sharing links on blog posts. This plugin is hosted on a public GitHub repository, not the WordPress.org repository. Recommended because it is an excellent lightweight plugin.

* ### Custom Header Extended
	* Allows per-post custom header images to be set from the post/page edit screen. To use, edit any post or page and then upload an image in the ***Custom Header*** meta box.

* ### Genesis eNews Extended
	* A simple plugin that creates a email newsletter sign up form that can be placed in any widget area. See the plugin homepage for details on how to configure with your email marketing service of choice.

* ### Ninja Forms
	* Ninja Forms is a popular, free contact form plugin. This plugin is optional and any WordPress form plugin will work such as Gravity Forms or Contact Form 7.

* ### Widget Importer & Exporter <a name="wie"></a>
	* Widget Importer & Exporter makes it easy to import the theme demo widget content. Upon acitvation it will create a new settings page under ***Tools > Widget Importer***. Simply upload the ***widgets.wie*** file included with the theme.

* ### WP Featherlight
	* This plugin adds simple lightbox functionality to any WordPress `[gallery]` shortcode. No settings or configuration required, just simply create a gallery on any post or page and link the images to 'Media File' and the lightbox will be automatically applied.

* ### WordPress Importer
	* Imports the theme demo content such as posts, pages, comments and more.


## Import Demo Content

Once the recommended plugins have been installed it is safe to import the theme demo content and widget demo content. To import the content used in the Shadow theme demo site, navigate to ***Tools > Import*** and then select ***WordPress > Run***. This will take you to the **Import** settings page where you can upload the *sample.xml* file included with the theme.


## Menus

Shadow includes one responsive menu by default with support for sub-menu items. This is the **Header Menu** and is displayed in the site-header section of the theme. The menu used in the demo should be imported with the theme demo content *(sample.xml)*, however WordPress sometimes has problems with importing menu items. If this occurs, please create your menu by navigating to ***Appearance > Menus*** and configuring to your liking.


## Widget Areas

This theme supports 3 default widget areas, Header Right, Footer Widget and After Entry. To import the theme demo widget content, [follow the instructions](#wie) for using the ***Widget Importer & Exporter*** plugin above.

* ### Header Right
	* This is displayed to the right of the site header. This area is not intended for all widgets and works best with only one or two widgets such as social links or search form.

* ### Footer Widget
	* This is the footer widget area. Used for displaying the footer credits text and social profile links.

* ### After Entry
	* This widget area is displayed at the bottom of single posts. The theme demo uses this area for displaying the *Genesis eNews Extended* newsletter sign up form.


## Customization

Shadow makes it easy to customize the theme to your liking. All customizations are done via the WordPress customizer as recommended by WordPress.

* ### Custom Logo
	* To upload your own custom logo, navigate to ***Appearance > Customize > Site Identity***. From the **Site Identity** section of the customizer panel you can upload your own logo and favicon.

* ### Custom Header
	* To upload a site-wide custom header, navigate to ***Appearance > Customize > Header Media***. The **Header Media** section contains video upload, YouTube URL or image upload options. This custom header will be applied site-wide but can be overidden on a per-post basis with the **Custom Header Extended** plugin.

* ### Custom Background
	* To set a custom background image, navigate to ***Appearance > Customize > Background Image***. From here you can upload your own image and configure to your liking. You can also use a color instead by navigating to the **Colors** section. You can find some really great free textures to use [here](http://subtlepatterns.com).

* ### Custom Colors
	* To customize the colors of your theme, navigate to ***Appearance > Customize > Colors*** and customize to your liking. The available colors for this theme are as follows:

		* dark, heading, body, links, accent, border, light, input, select, white.


## Optimization

We decided to leave out the theme optimization file that most of our
themes include by default, instead we recommend the use of the amazing  [Soil](https://github.com/roots/soil) plugin by the team at Roots. Shadow fully supports all of Soil's features by default, all you need to do is install and activate the plugin and your set. The only configuration required is if you are using Google Analytics, you will then need to add your own GA tracking code to the /includes/theme-functions.php file on line 30. Simply uncomment the `add_theme_support( 'soil-google-analytics', 'YOUR-GA-CODE' );` line and replace *YOUR-GA-CODE* with your own unique code.

## CHANGELOG

= 0.1.0 = 2017-05-26
* Initial beta release