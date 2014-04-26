=== Plugin Name ===
Contributors: neoloki
Tags: carousel, slider, elastislide, responsive, images
Requires at least: 3.0.1
Tested up to: 3.8.3
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

WP Dream Carousel creates a custom post type in which any number of images can be uploaded via the WordPress media uploader and then arranged into a carousel slider.


== Description ==

WP Dream Carousel creates a custom post type in which any number of images can be uploaded via the WordPress media uploader and then arranged into a carousel slider.  Once the images are uploaded, slides can be defined and arranged bt drag-and-drop to set their order.  The carousel can be implemented through the page/post content using the provided shortcode or can be placed directly into a template using the provided php function.

Th plugin uses the Elastislide.js library to create a fully responsive carousel slider that uses CSS3 animations.  All of the necessary javascript libraries are included in the plugin and registered when/where they are needed.  The plugin does not universally register the script libraries on all front- and back-end pages.  Instead it only loads the libraries when/where they are needed in order to minimize impact on site performance.

Slides can be set to have a link and that link can be set to open in the same window or a new window.  There is also a setting that allows the link to open a modal window that can include a YouTube video.

This plugin includes and requires the Piklist WordPress plugin.  It will automatically install Piklist if it is not present on your site.  Disabling the Piklist plugin will cause many features on the back end of WP Dream Carousel to stop functioning - including the ability to create or modify slideshows.


== Installation ==

This section describes how to install the plugin and get it working

Manual:
1. Upload the wp-dream-carousel folder to the /wp-content/plugins folder on your web server.
2. From the "PLugins" page in the WordPress Dashboard click "Activate" underneath the heading for "WP Dream Carousel".
3. Go to the Settings page for WP Dream Carousel and set your default settings such as image size and slider animation.
4. Use the newly created custom post type to begin creating sliders and embedding them in your content.

From the Repository:
1. From the Plugins page in the WordPress Dashboard click on “Add New”.
2. Search for “WP Dream Carousel”.
3. Click on “Install Now”.
4. When prompted to make sure, click “OK”.
5. Once the plugin is successfully installed click “Activate Plugin”.
6. Go to the Settings page for WP Dream Carousel and set your default settings such as image size and slider animation.
7. Use the newly created custom post type to begin creating sliders and embedding them in your content.


== Screenshots ==

1. The Custom Post Type created by WP Dream Carousel
2. The WP Dream Carousel Settings Page
3. Each Carousel is created as a post which contains all of the data and images needed for the carousel slider.
4. Editing a Carousel - the top area showing the shortcode and the embedded function information
5. Editing a Carousel - images that have been uploaded/selected (through the WordPress Media Uploader) are shown as previews here.
6. Editing a Carousel - once images have been uploaded, slides can be defined and dragged/dropped into whatever order you would like them to display.


== Changelog ==

= 1.0.1b =
*Replaced FancyBox modal implementation with Magnific Popup jQuery plugin
*Added support for Vimeo video linking in modal windows

= 1.0.0 =
*Initial version/release of the plugin


== Frequently Asked Questions ==

= How do I build a carousel? =

1. Go to the WP Dream Carousel Settings page and make sure that you have defined an "Image Width" and an "Image Height" under "Image Settings" and that you have SAVED the settings.
2. Go to "Add New" under the "Dream Carousel" entry in the WordPress Dashboard.
3. Give your carousel a title.
4. Use the WordPress Media Uploader provided on the page to upload or choose images to include for this carousel. (!Important! This must be done before slides can be defined!)
5. SAVE YOUR CAROUSEL.  The carousel cannot recognize that images have been associated with it until the carousel has been saved.  This MUST be done before slides can be defined.
6. In the "Slideshow Slides" section give your first slide a title, provide a link for it to open when it is clicked (if desired), choose how the link should open (if you have set a link), and select an image that you uploaded or chose from the "Select Image" dropdown.
7. Click the "+" icon to add a new slide as needed and repeat step 6 for each slide you want to create.
8. Drag and drop your slides to put them in the order that you want them to display if they are not already in that order.
9. UPDATE the post so that the information about the carousel is saved.
10. Use the provided shortcode to embed the carousel into the content of a page or post, or use the provided PHP function to directly call the carousel from a template file.

= I set the link to open in a lightbox, and TWO lightboxes open up.  What's going on here? =

If you are linking a slide to locally hosted images that have been uploaded to WordPress then WordPress AUTOMATICALLY opens them in a lightbox.  When you set the link from the plugin to ALSO open in a lightbox it will open OUR ligetbox as well as the default WordPress lightbox.  This is a bug that we are working on resolving.  For now you should only set a link to open in a lightbox if it is opening a YouTube hosted video or if it is opening content that is NOT hosted on your website.

= How do I link a slide to a YouTube video? =

Because of the way that video embed URL's work, the link has to be in a very specific format.  That format looks like this: http://www.youtube.com/watch?v=XQ7z57qrZU8.  To get this type of link from YouTube, go to the desired video on YouTube, copy the URL from your browser's address bar, and paste that URL into the "Link" section of the slide definition.  If you want the video to open in a lightbox, select "Lightbox" from the "Link Opens In" dropdown.