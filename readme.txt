=== Single MP3 Player ===
Contributors: flashblue
Tags: mp3, glow, flashblue, filter, equalizer, bar, as3, alpha, xml, soundmixer, player, wordpress, joomla, plugin
Requires at least: 2.8.0
Tested up to: 3.0.2
Stable tag: trunk

Sound spectrum driven single MP3 player with full XML support. 

== Description ==

Sound spectrum driven single MP3 player with full XML support.

Features included:

* XML driven MP3 player
* You can set MP3 URL
* Equalizer bars count
* Equalizer bar color, width, height
* Equalizer bar alpha according to bar height
* You can set padding / empty space between equalizer bars
* You can show / hide glow filter
* You can show / hide shadow filter at the bottom of equalizer bars
* You can play / pause MP3 player clicking on it
* SoundMixer is used to equalizer
* Includes WordPress plugin & Joomla module

You can see other XML files in sources folder. 

== Installation ==

Make sure your Wordpress version is greater than 2.8 and your hosting provider is using PHP5.

1. Download the plugin and upload it to the **/wp-content/plugins/** directory. Activate through the 'Plugins' menu in WordPress.
2. Create a new folder inside your **wp-content** folder called **flashdo**, inside this folder create a new one called **flashblue**, inside this folder create a new one called **single-mp3-player** and copy files under **deploy** or free zip folder there
3. Download the [Free Single MP3 Player](http://www.flashdo.com/fc/wordpress/single-mp3-player.zip "Single MP3 Player") and copy the content of the archive in **single-mp3-player** folder. (e.g: "http://www.yoursite.com/wp-content/flashdo/flashblue/single-mp3-player")
4. If you copied the files to a location different than the one above, go to **Single MP3 Player** from the **Settings** tab in your **WordPress Dashboard** and update the path accordingly
5. Add `[single-mp3-player][/single-mp3-player]` where you want the Flash to show up in your post/page
6. If you want to make the Single MP3 Player part of your theme, edit the template files and add `<?php singlemp3player_echo_embed_code(); ?>` where you want it to show up
7. Modify the `mp3player.xml` content and use it to overwrite `wp-content/flashdo/flashblue/single-mp3-player/xml/mp3player.xml`
8. To use your own images / swf, upload them to `wp-content/flashdo/flashblue/single-mp3-player/images/`

= Additional settings file =

To embed the Single MP3 Player more than once, you will need another settings file. Let's assume your new file is called `mp3player2.xml`. Add `[single-mp3-player xmlUrl="xml/mp3player2.xml"][/single-mp3-player]` where you want the Flash to show up in your post/page. If you made the Flash part of your theme, add the file name as **the first argument** of the `singlemp3player_echo_embed_code()` function call (for example `<?php singlemp3player_echo_embed_code("xml/mp3player2.xml"); ?>`).

= No Flash support text =

To support visitors without Adobe Flash Player, you can provide alternative content by adding the text between `[single-mp3-player]` and `[/single-mp3-player]`. If you made the Flash part of your theme, add the text as **the second argument** of the `singlemp3player_echo_embed_code()` function call (for example `<?php singlemp3player_echo_embed_code("","Alternative content"); ?>`).

= If you have PHP4 =

To make it work with PHP4, add `[single-mp3-player width="590" height="300"][/single-mp3-player]` where you want the Flash to show up in your post/page. If you made the Flash part of your theme, add the width and height as **the third and fourth argument** of the `singlemp3player_echo_embed_code()` function call. Don't forget to provide your own width and height values, since 590 and 300 are just examples.

= Remove FlashBlue logo =

If you don't want to have the FlashBlue logo on the top left corner, you'll have to purchase the [commercial package](http://www.flashdo.com/item/single-mp3-player/67 "Single MP3 Player"). You'll also have access to the fla file and all other sources. After downloading the commercial archive, overwrite the swf file from the `/wp-content/flashdo/flashblue/single-mp3-player` directory.

== Screenshots ==

1. You can view the live demo on [flashdo.com](http://www.flashdo.com/item/single-mp3-player/67 "Single MP3 Player") for Single MP3 Player.