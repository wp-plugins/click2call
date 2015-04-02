=== Click2Call Integration Plugin ===
Contributors: Thiago Fernandes, Luis Machado Reis
Donate link: http://www.ligflat.com.br/
Tags: sip, click2call, click to call, click-to-call, html5, call2action, call to action, tollfree, toll-free, 0800, 0800web, 0800-web, 0800
Requires at least: 4.0
Tested up to: 4.1
Stable tag: 1.0.1
License: GPL v3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Calling to your staff through a new toll-free channel directly from your website using the new WebRTC stack from your Chrome or Firefox browser.

== Description ==

**Click2Call** is an elegant solution to keep contact with your customers, visitors, users direct to you by any SIP device or software using the new WebRTC (Web Real Time Communications) features from Google Chrome or Mozilla Firefox web browsers. 

It means that you can talk with people direct from your Wordpress website using a very simple shortcode

	[click2call]

This shortcode get your **Click2Call ID** from your admin panel and build all necessary stuff to transform your Wordpress in a webphone that dials direct to you!

To activate your **Click2Call** you must visit **[Click2call.us](http://www.click2call.us)** and create an account and then get your ***Click2Call ID** and put on your Wordpress Panel prefrences.

== Installation ==

You can choose to install through the **Wordpress Plugin Directory** (*easy way*) or download and install manually (*hard way*).

= Easy way =

1. Enter your Wordpress admin area as an Administrator user
2. Click *Plugins* > *Add New*
3. Search "**Click2Call**"
4. Click on **Install**
5. Be happy!

= Hard way =

1. Upload `click2call` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Configure your ID in `LigFlat / Click2Call` menu item
4. Place a shortcode in your posts or pages `[click2call]`
5. Insert the Click2Call Widget in your sidebar
6. Be happy!

== Frequently Asked Questions ==

= Click2Call service is payed? =

**Yes**, because it has costs with datacenter, internet link and staff to support you 24/7.

= How much it is? =

Please visit out [website](http://www.click2call.us).

= This is GPL v3 but it is payed. How can it be? =

The plugin php code is free under [GPL v3](http://www.gnu.org/licenses/gpl-3.0.html). The service that it consumes is **payed**.

= What are the approved SIP software? =

For updated news, please visit out [website](http://www.click2call.us) but you can use these:

**Desktops**

- **Windows**: [Jitsi](https://jitsi.org/Main/Download), [X-lite](http://www.counterpath.com/x-lite-download), [MicroSIP](http://www.microsip.org/downloads)
- **Linux**: [Jitsi](https://jitsi.org/Main/Download)
- **Mac**: [Jitsi](https://jitsi.org/Main/Download),[X-lite](http://www.counterpath.com/x-lite-download)

**Smartphones**

- **Android**: [CSIPSimple](https://play.google.com/store/apps/details?id=com.csipsimple&hl=en)
- **iOS**: [Join SIP Phone](https://itunes.apple.com/us/app/join-softphone-voip-sip-client/id566525840?mt=8)
- **Windows Phone**: tell us please, we didn't have enought time to test it on Windows Phone ;-)

= What are the approved SIP hardware? =

You can use any SIP device. It can be an ATA (Analogic Telephony Adapter) or a IP Phone.

= There is some feature to restrick call time? =

**No**, but it is on our roadmap.

= There is a way to integrate it on my IP PBX or Asterisk? =

**Yes**, just register your Click2Call account and all calls will be forward to you ;-)

= There is a way to enable a queue or IVR to my Click2Call ID? =

**Depends**, if you have a PBX with this funcitonalities just program it to get all incoming calls from your Click2Call ID and redirect it to your PBX and *voilà*; but if you don't have and need a cloud solution **no** bacause it is on our product roadmap.

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets 
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png` 
(or jpg, jpeg, gif).
2. This is the second screen shot

== Changelog ==

= 1.0.1 =
* Template and css update

= 1.0 =
* Shortcode
* Admin Panel to customize your Click2Call button, modal template and ID
* Supports Google Chrome and Mozilla Firefox (Windows, Mac, Linux) 

== Upgrade Notice ==

None yet