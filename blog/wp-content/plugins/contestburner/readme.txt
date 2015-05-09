=== ContestBurner ===
Contributors: gwrey
Tags: contest, facebook, twitter, social, viral, referral, traffic, tweet
Requires at least: 2.9
Tested up to: 3.9.1
Stable tag: 3.11

Create viral contests on your blog that integrate with social networking sites.

== Description ==

Create viral contests on your blog that integrate with Twitter & other social
networking sites. Reward your visitors with contest points for linking to you,
Tweeting about you, commenting on your blog, visiting specific pages & much
more.

= We do not recommend you upgrade during a running contest =
* Although there should not be any issue with upgrading, it is always safest and recommended to wait until your contest ends before upgrading.
* Always backup your data before upgrading

= To modify the Language data: =
* edit ContestBurner/languages/default.php
* or
* copy en_US.php to a new file for your language then edit ContestBurner/config.php and set the "lang" option to the new file

== Installation ==

= We do not recommend you upgrade during a running contest =
* Although there should not be any issue with upgrading, it is always safest and recommended to wait until your contest ends before upgrading.
* Always backup your data before upgrading

1. Upload the contest plugin to your blog
2. Activate the ContestBurner plugin
3. Setup your contest

== Changelog ==

= 3.11 =
* Fix for Facebook App
* Changed Facebook user name to be pulled in javascript from the client rather than from the server

= 3.10.10 =
* Fixed Points for Tweets feature

= 3.10.9 =
* Fixed Facebook Comments Widget display on Links page when points for FB Comments is enabled, the fix for this in 3.10.5 had a bug that blocked the display.

= 3.10.8 =
* Fixed bug on links page where JUST_FOR_ENTERING text was displayed twice
* Fixed duplicate contest_slug bug with deleted contests.
* Increased timeout for curl requests

= 3.10.7 =
* Update to improve submissions to email list

= 3.10.6 =
* Bug fix for webservers running PHP ver 5.4+

= 3.10.5 =
* Only display Facebook Comments Widget on Links page if points for FB Comments is enabled

= 3.10.4 =
* Update for Twitter API to post contest standings

= 3.10.3 =
* Fix for YouTube video search
* Update email list javascript to handle spaces in field names

= 3.10.2 =
* YouTube video search API update

= 3.10.1 =
* Fix for use with SSL
* Fix for Tracking ID display on Contestants tab

= 3.10 =
* Update for WordPress version 3.6

= 3.09 =
* Update Twitter API
* Add additional text to languages file

= 3.08 =
* Fix to prevent excluded users from being selected as winners
* Fix for winner name display at time of winner selection

= 3.07 =
* Fix for prize winner name display in admin
* Update for Find my points search on Leaders page

= 3.06 =
* Leaders and Contestant data consistancy updates
* Fix for limit option in contest_leaders shortcode
* Updated Facebook comments widget to load link in top frame

= 3.05 =
* Fixed issue where some users were awarded points for entering multiple times

= 3.04 =
* Fixed issue that prevented removing or editing Points for Viewing a Page
* Added YouTube username validation
* Fixed issue preventing categories from being deselected
* Fixed Hello message in Leaders Table header to display the correct points total for the user
* Added Validation for Facebook account and updated Facebook actions display on Entry page
* Updated Points for WordPress comment feature to prompt for the users email instead of Contest Username

= 3.03 =
* Fix for affiliate url not saving

= 3.02 =
* Fix for blank names in the Leaders table

= 3.01 =
* Fix for Points For Viewing Page
* Fix for ClickBank Affiliate Nickname linking in ContestBurner footer
* Fix for OpenInviter enabled option not being saved
