=== µMint Plugin ===
Contributors: jwriteclub
Donate link: http://compu.terlicio.us/
Tags: mint, jquery, stats, statistics, dashboard widget, sidebar widget
Requires at least: 2.0
Tested up to: 2.7
Stable tag: 0.4.1

µMint is a tiny plugin to integrate <a href="http://haveamint.com">MINT</a> statistics right into wordpress.

== Description ==

__Now 2.7 Compatible!__

µMint is a slim plugin to integrate statistics from Shaun Inman's <a href="http://haveamint.com">Mint</a> statistics package into Wordpress*.

In addition to the Wordpress plug in, µMint includes two different mechanisms for creating an API for Mint. µMint is designed to work with both the Exposé API, by Adam Livesley as well as the included API, µAPI for Mint. Furthermore, there is a development version of a connector whcih allows Wordpress to directly query Mint, when the two share a database.

* µMint does require a valid Mint installation to function.

*Thanks to corouke for sorting out several annoying bugs.*

== Installation ==

The most basic installation simply requires that you upload the 'micromint' folder to your /wp-content/plugins directory. Then, from the Administration -> Plugins menu, simply activate the plugin and indicate where Mint is installed. Now the Mint tracking code is automatically inserted into wordpress. Done.

In order to integrate statistics into WordPress, you need to install an API for Mint. There are currently two supported options, the Exposé pepper, by Adam Livesley or the µAPI which is heavily based on the Exposé code, with some improvements. The µAPI is distributed along with this package. In the future, I hope to discontinue the µAPI and simply provide an exposure for Exposé, but at this time it is not mature enough to be the reccomended option. Although both pepper are supported, at this time I reccomend the µAPI pepper for several reasons:

Although somewhat convoluted there is a way that the Exposé pepper can expose priveledged information. µAPI patches this.

The µAPI includes better formed, XML based error responses, allowing the client application to integrate better.

The µAPI is currently 100% compatible with Exposé exposures, as it uses the same serializer.

µAPI has been more extensively tested with this release.

__Please Note:__ You cannot have both Exposé and µAPI installed concurently. If you already have Exposé installed (with Firemint, for example), you should simply drop the included `/exposures/micro.php` file into the /exposures folder of your Exposé installation

To install the API (installation is the same for both), simply upload the pepper to the appropriate folder in mint (/pepper/chrisoconnell/ and /pepper/84degrees/ for µAPI and Exposé respectively). Go to the Mint control panel and enable the API. Enter an API key. If you are using the Exposé API, make sure that the micro.php file is in /pepper/84degrees/expose/exposures/.

In wordpress goto 'Settings > µMint'. Change your mint URL if neccessary. Select "Integrate Mint statistics into WordPress?". Select the appropriate API and enter the API key.

To setup the sidebar widget, visit 'Design > Widgets'. You can manually configure which datafields are displayed as well as display labels for different data.

== Frequently Asked Questions ==

= How can I see when µMint Last Updated / Update Now? =

Append *&debug* to the end of the url on the µMint configuration page.


== Screenshots ==

1.  The µMint dashboard widget.
1.  The µMint management page.
1.  The µMint logo.
1.  An µMint sidebar widget (configured to show total visitors)

== Notes ==

*    As of this release, the local integration is not currently shipping with the plugin. I had several instances of mass data corruption on the testbed, and don't want to ship this integration until I am comfortable with the data integrity. The theory is that in an installation where WordPress and Mint both share a database, WordPress will simply query the Mint datatables directly without needing the API

*    You cannot have both the µAPI and the Exposé API installed at the same time.

*    Stats are only fetched every 10 minutes and cached. If you need a different value, you can edit the `$MICROMINT_INTERVAL` value at the top of microMint.php. This needs to be something which can be fed into php strtotime function.

*    If you want to update the stats __right now__, or just want to see some debugging information, append &debug to the end of the µMint configuration page. This will both print debug information as well as perform and immediate update

*    If you absolutely __have__ to change the widgets, edit microMint.widget.php (sidebar) and mircoMint.dashboard.php

*    The new dashboard design is currently 2.7+ only. Pre 2.7 still uses the old design.


== Known Issues ==

*    Please post any questions or bugs on the [Version Installation Page] (http://compu.terlicio.us/code/plugins/mint/micro-mint-installation/). Feature requests and comments of a more general nature should go on the [µAudio Home Page] (http://compu.terlicio.us/code/plugins/mint/).

*    When used with the Exsposé API, error information is not that imaginative.

*    API keys using non-alphanumeric characters don't work

== Changelog ==

*0.4.1*

*    Fixed missing images

*0.4*

*    Added 2.7 compatible dashboard widget
*    Added a new dashboard widget design
*    Fixed numbers to display using number_format
*    Fixed a potential API bug.

*0.3.2*

*    Fixed incorrect paths when auto-update is run
*    Updated documentation
*    Fixed some typos

*0.3.1*

*    Documentation added.
*    Screenshots added.

*0.3*

*    Initial public release.