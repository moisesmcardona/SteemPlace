# Steem.Place

[Steem.Place](https://steem.place) was a website that allowed you to do some stuff, like the following:

* Vote on posts other people votes
* Follow some trails
* Publish posts using more than 5 tags and a custom URL
* Receive emails when you are mentioned in a post

The site is powered by Drupal.

The site's main code is in the **backend** folder. 

The **English** and **Spanish** folders contains the code that should be added to Drupal's content pages when adding pages to it.

It has to be noted that the site account sign-up/login is just for the website and is completely unrelated to Steem. The site also doesn't asks for your Steem password in any way. In fact, it uses SteemConnect when you sign up on the site to authorize the @steem.place account to your Steem Account and associate it with your Drupal account. SteemConnect is a trusted 3rd-party account authoriation/deauthorization tool, and just the Publishing section will require the Private Posting Key if you opt not to use SteemConnect or sign up at the site.

This repo is under the MIT license. Feel free to adapt the code to your needs.
