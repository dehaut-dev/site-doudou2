=== Subscribe to Double-Opt-In Comments ===
Contributors: Tobiask
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=3736248
Tags: comments, subscribe, double opt in, kommentar, abonnieren, opt in, optin, kommentare, benachrichtigung
Requires at least: 2.5
Tested up to: 3.1
Stable tag: 5.8

Based on the well known Subscribe-to-Comments PlugIn, but now with double-opt-in feature to prevent spam.

== Changelog ==

= 5.8 =
* Minor bug fixes
* Checked WP 3.1 compatibility

= 5.7 =
* Minor bug fixes

= 5.6 =
* New css class to style the Verify-Page: verify_succeeded and verify_failed
* Higher security for generated verify-token implemented
* Improved code formatting

= 5.5 =
* Checked 3.0.4 compatibility
* Bugfix with standalone subscribe

= 5.4 =
* Checked 3.0.2 compatibility

= 5.3 =
* Arabic language support added

= 5.2 =
* Hebrew language support added

= 5.1 =
* Minor Bugfix in l10n.

= 5.0 =
* Added Italian language support

= 4.9 =
* Checked 3.0.1 compatibility
* Added Ukrainian language support

= 4.8 =
* Checked 3.0 compatibility

= 4.7 =
* Added Spanish (Argentina). Thanks to Luis P. (http://ktulu.com.ar/blog/)

= 4.6 =
* Minor Bugfixes.

= 4.5 =
* Added Belorussian. Thanks to Marcis G. (http://pc.de/)

= 4.4 =
* Changed some language files, new translations needed! New .pot file is attached.

= 4.3 =
* Changed FAQ
* Changed Settings Title

= 4.2 =
* Added Russian language support.

= 4.1 =
* Stable and working with WP 2.9.
* No e-mail on spam comments anymore.
* Check if comment exists on confirmation, error message if not.

= 4.0 =
* Added more documentation. ;)

== Description ==

= English =

Allows readers to receive notifications of new comments that are posted to an entry, with double-opt-in Feature. 
First, the user will get an e-mail with a confirmation link, after the user has confirmed the subscription, he or she will be noticed about new comments. 
Plugin based on Mark Jaquith "Subscribe to Comments".
More information on my blog: <a href="http://www.sjmp.de/internet/subscribe-to-comments-mit-double-opt-in-pruefung/">sjmp.de</a>.

Language support: English, German, Slovak, Turkish, Danish, French, Belorussian, Spanish (Argentina), Ukrainian, Italian, Hebrew, Arabic.

= Deutsch =

Weiterentwicklung der bekannten Version des "Subscribe to Comments" Plugins von Mark Jaquith.
Jetzt mit Double-Opt-In Feature. Wichtig f&uuml;r deutsche Blogger. User muessen ein Abo eines Blogposts erst via E-Mail bestaetigen.
Danach erhalten sie erst eine Mail falls ein neuer Kommentar gepostet wurde. So werden Spameintragungen ausgeschlossen.
Mehr dazu auch auf meinem Blog: <a href="http://www.sjmp.de/internet/subscribe-to-comments-mit-double-opt-in-pruefung/">sjmp.de</a>.

Sprachunterst&uuml;tzung: Deutsch, Englisch, Slowakisch, T&uuml;rkisch, D&auml;nisch, Franz&ouml;sisch, Wei&szlig;russisch, Spanisch (Argentinien), Ukrainisch, Italienisch, Hebr&auml;isch, Arabisch.

== Installation ==

= English =

1. Upload all files to the "/wp-content/plugins/" directory
2. Activate the plugin through the "Plugins" menu in your WordPress Adminpanel
3. Set settings via "Settings" menu in WordPress
4. Ready, steady, go :)

= Deutsch =

1. Dateien ins "/wp-content/plugins" Verzeichnis laden
2. Im Adminbereich das Plugin aktivieren
3. Einstellungen anpassen, ebenfalls im Adminbereich!
4. Fertig, jetzt darf man sich freuen :)

== Frequently Asked Questions ==

= How can I change the place of the subscription checkbox? =

Use this code (within the loop) in your template file, to change the place of the checkbox: <code><?php show_subscription_checkbox(); ?></code>

= Can people subscribe manually without commenting? =

Yes, just place this code snippet in your template (outside the comments form): <code><?php show_manual_subscription_form(); ?></code>

== Screenshots ==

1. Part of the settings menu