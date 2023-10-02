=== Frantic Ape's Easy WP to PDF ===
Contributors: Frantic Ape
Tags: wp to pdf, wordpress to pdf, acrobat, pdf, post to pdf, generate pdf, mpdf, generate, convert, create, convert pdf, create pdf
Requires at least: 5.0.0
Tested up to: 6.3.2
Requires PHP: 7.4
Stable tag: 2.0.0

WordPress to PDF made easy.

== Description ==

DK PDF allows site visitors convert posts and pages to PDF using a button.

[vimeo https://vimeo.com/148082260]

= Features =

* Add PDF button in posts (including custom post types) and pages.
* Configure PDF header, body and footer, add custom logo and custom CSS.
* Copy plugin templates in your theme for PDF customizations.
* Add custom fonts to the PDF.


= Github =
* <a href="https://github.com/alejandrosan3/fa-easy-wp-pdf" target="_blank">https://github.com/alejandrosan3/fa-easy-wp-pdf</a>

== Installation ==

Installing "FA Easy WP to PDF" can be done either by searching for "Easy WP to PDF" via the "Plugins > Add New" screen in your WordPress dashboard, or by using the following steps:

1. Download the plugin via WordPress.org
2. Upload the ZIP file through the 'Plugins > Add New > Upload' screen in your WordPress dashboard
3. Activate the plugin through the 'Plugins' menu in WordPress

== Screenshots ==

1. Front-end PDF Button
2. PDF Button settings
3. PDF Setup settings
4. PDF Header & Footer settings
5. PDF Custom CSS
6. Disable PDF Button Metabox

== Credits ==

Thanks to:

Dinamiko, the original author of this plugin. the person that brought this really awesome plugin to life.
https://github.com/Dinamiko

mPDF, PHP class which generates PDF files from UTF-8 encoded HTML
https://mpdf.github.io/

Font Awesome, the iconic font and CSS toolkit
http://fortawesome.github.io/Font-Awesome/

== Changelog ==

= 2.0.0 =
* **Major Update**: Transitioned the plugin's Author From Dinamiko to Frantic Ape's.
* **Major Update**: Changed Repo Logo and metadata.
* **Improvement**: PHP 8.X compatibility.
* **Improvement**: Optimized the plugin structure for faster performance.
* **Improvement**: Started the transition to fully standard WordPress code.
* **Update**: Updated all dependencies to their latest versions as of September 2023.
* **Fix**: Addressed various minor bugs and issues reported by users in the past.
* **Documentation**: Updated README to provide clearer instructions for both installation and development processes.

---------------------------------

= 1.9.6 =
* Update mPDF library to latest version.
* New filters `faeasypdf_mpdf_font_dir`, `faeasypdf_mpdf_font_data`, `faeasypdf_mpdf_temp_dir`. Thanks to [joostvanbockel](https://github.com/joostvanbockel).

= 1.9.3 =
* Reverting to 1.9.1, something went wrong in 1.9.2

= 1.9.2 =
* PHP7: Remove some warnings, see [issue #38](https://github.com/Dinamiko/fa-easypdf/issues/38), [issue #48](https://github.com/Dinamiko/fa-easypdf/issues/48).
* HTTPS: Fix images not working after move to https, see [issue #51](https://github.com/Dinamiko/fa-easypdf/issues/51).

= 1.9.1 =
* Added PDF Protection in PDF Setup Settings
* New Columns Shortcodes: [faeasypdf-columns] and [faeasypdf-columnbreak]
* New Filter: faeasypdf_pdf_filename
* Fixed Admin scripts enqueued on all pages (thanks to Aristeides Stathopoulos @aristath)

= 1.9 =
* Added shortcode tag attribute to faeasypdf-remove shortcode
* FontAwesome icons support
* Added post title as PDF filename when downloaded from browser

= 1.8 =
* New filter faeasypdf_pdf_format
* New filter faeasypdf_header_title
* Option for remove default PDF button when adding PDF button manually (thanks to Renato Alves)

= 1.7 =
* New filters (see documentation filters)
* Fixed github issues #21 #23 #24

= 1.6 =
* 4.4.2 Tested
* Added DK PDF Generator compatibility (css + shortcodes)

= 1.5 =
* Added PDF Custom CSS setting
* Sanitized settings fields

= 1.4 =
* Added [faeasypdf-pagebreak] shortcode for adding page breaks
* Added filters faeasypdf_header_pagination and faeasypdf_footer_pagination
* Added addons page to admin menu

= 1.3 =
* New DK PDF admin menu for better usability
* Added a PDF Setup tab for adjusting page orientation, font size and margins of the PDF
* Added [faeasypdf-remove] shortcode for removing pieces of content in the generated PDF

= 1.2 =
* Settings link in plugins list page
* Adjusts header template for better logo display

= 1.1 =
* Removes faeasypdf-button shortcode in the generated PDF

= 1.0 =
* Initial release
