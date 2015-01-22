# Changelog

## v2.7

### Site Enhancements

* Added personalised Privacy and Disclaimer page
* Added RSS link in the
* Added placeholder message when a Traffic category is empty
* Breadcrumbs 'Home' element is now translated for all French sites
* Improved Open Graph implementation
* Improved the Questions landing page, removed duplicate categories listing
* Only show streets in the autocomplete that have a district officer

### Administrator Enhancements

* Added city to streets listbox in Districts and BINs
* Allow to backdate News articles
* Schedule News articles

* Added email address to District
* Manage zones and streets from within the manager application
* Added missing translations
* Improved article ordering and introduced 'drafts' in News
* Only empty categories in About and Questions can be removed
* Added autocomplete listbox to attach a police station to a District
* Added autocomplete listbox to attach a Street to a Contact
* Inserting a file link now automatically adds the file size and extension



### Bug Fixes

* Too small article image on About pages
* Double quotes issue in titles
* Pagination broke filters in some views
* Download of attachments in support tickets


### Refactoring

* The banner is now optional
* Theme dependencies are now managed by Composer
* Implemented auto-increment primary keys for Districts, Officers and BINs


### Sites

Release of:

* [Police De Wavre](http://www.policelocale.be/5271)
* [Police Mons-Quévy](http://www.policelocale.be/5324)
* [Politie Heusden-Zolder](http://www.lokalepolitie.be/5375)
* [Politie AMOW](http://www.lokalepolitie.be/5408)
* [Politie Erpe-Mere/Lede](http://www.lokalepolitie.be/5441)
* [Politie Dendermonde](http://www.lokalepolitie.be/5443)
* [Politie Oostende](http://www.lokalepolitie.be/5449)

## v2.6

### Site Enhancements

* Now the domain name matches the site's language
* Improved structured data (schema.org)
* Streets are now ordered by title instead of city
* Re-use the category image on the article page when the category contains only one article and the article doesn't have an image attached

### Administrator Enhancements

* Finalised multi-lingual support
* Automated CRAB synchronisation (weekly)
* Better handling of large images
* You can now filter streets for missing CRAB IDs
* Added width/height properties to inline images so PageSpeed can handle resizing
* Keep page published state in sync with the category

### Bug Fixes

* Fixed editor plugins
* Avoid rendering of office hours when no contact is found
* Limit street search to one zone during import of local streets

### Refactoring

* Proper naming convention for Sass variables

### Sites

Release of:

* [Politie Assenede-Evergem](http://www.lokalepolitie.be/5421)
* [Politie Beveren](http://www.lokalepolitie.be/5430)
* [Politie Demerdal-DSZ](http://www.lokalepolitie.be/5396)
* [Politie HANO](http://www.lokalepolitie.be/5372)
* [Politie HAZODI](http://www.lokalepolitie.be/5370)
* [Police Pays De Herve](http://www.policelocale.be/5288)
* [Police SECOVA](http://www.policelocale.be/5283)
* [Open Police](http://www.openpolice.be)

## v2.5

### Site Enhancements
* Added width & height property to featured image in the RSS feed
* The banner is now declared in CSS to avoid unnecessary load on small screen
* Featured image in News doesn't link to the cropped version anymore
* Added support for 3 quicklinks on the homepage
* Now the zone name is used as author metadata of News articles

### Administrator Enhancements
* Added 'name' and 'URL' field in Contacts
* Added 'note' field to office hours in Contacts
* Added 'appointment only' option to office hours in Contacts
* Added component to manage BIN/RIQ
* Date-time picker in News & Traffic now starts with Monday and is translated
* Allow user-select for comments in Support
* All support tickets are now centralised for support agents

### Bug Fixes
* Hide unpublished categories in Traffic
* Hide unpublished pages in footer menu
* Fixed sidebar in Districts
* Fixed pagination in Districts
* Fixed streets listbox in Districts when street name contains special characters
* Fixed missing attachments in Questions
* Fixed ability to download non-image attachments
* A huge list of streets in Traffic no longer breaks the UI

### Refactoring
* Major refactor of the site's main menu (ARIA support & duplicate HTML)

### Other
* Vagrant box is now hosted on [vagrantcloud.com](http://www.vagrantcloud.com/belgianpolice)
* Added a [product blog](http://www.openpolice.be/blog/)
* Updated some libraries: Nooku (v0.9.1), Apollo (v1.7.0), Select2 (v3.4.8), jQuery (v2.1.1), Susy (v2.1.2)
* Documentation is now available [online](http://www.openpolice.be/documentation/)
* Added Grunt to compile Sass
* Added Bower to install dependencies

### Sites
* Release of [Police Mouscron](http://www.policelocale.be/5317)

## 2.4

### Site Enhancements
* Proper message when no results are found in Questions
* Hide the read more link in Traffic when there is nothing more to read
* Show the category image in About
* No bold introtext when there is no fulltext
* Implement mobile number fallback in Contacts

### Administrator Enhancements
* Added Press component
* Automatically star the first attached image
* Improve menubar translations
* Make comment area resizable in Support
* Enable editor anchor plugin

### Bug Fixes
* CKEditor breaks DateTimePicker
* Unable to remove rows in Firefox
* Fixed missing French translations
* Avoid duplicate IDs in Districts
* Third image in the gallery floats to the right
* Copyright was running one year behind
* Hide disabled Quicklinks

### Refactoring
* Update to GA Universal Tracking

### Other
* Create new empty sites using Capistrano
* Import component can handle officers and press articles
* Update to CKEditor v4.3.4
* Slack integration to Support

### Sites
* Release of [Politie MidLim](http://www.lokalepolitie.be/5888)

## 2.3

### Site Enhancements
* Add Open Graph, Twitter Cards & microdata support to News
* Add jQuery lightbox gallery to News
* Add office hours to Contacts
* Improve article image on mobile
* Improve attachments workflow
* Improve navbar on small screens
* Improve district officer search
* Prevent district officer avatar indexing
* Group latest news on homepage (sticky and more articles)

### Administrator Enhancements
* Add Support component to replace Zendesk
* Make categories in Traffic editable
* Add Firefox v26+ support
* Add template overrides for Contacts & Categories
* Add office hours to Contacts
* Translate administrator interface to dutch & french
* Remove editor and attachments from category form in Questions
* Improve News import

### Bug Fixes
* Files not sort by name
* Missing breadcrumbs in com:traffic
* Select2 not working on Firefox
* Categories are not ordered based on the ordering value in About
* Navbar is shown momentarily on small screen
* Prevent saving tickets, news, questions, ... without text

### Refactoring
* Pixels to ems

### Other
* Setup phpmig with support for multiple databases
* HipChat integration to Support

### Sites
* Release of [Politie Damme/Knokke-Heist](http://www.lokalepolitie.be/5446)

## v2.2

### Enhancements
* Add uploads component for migration data from the v1 platform
* Add metadata to com:attachments using a template override
* Implement fallback when no article is stickified
* Improve color contrast to conform to WCAG 2.0 level AAA
* Add event tracking to pathway and attachments
* Highlight visited questions
* Specify image dimensions in markup
* Improve link accessibility
* Add city name behind street name in com:districts

### Bug Fixes
* Hide Twitter/Facebook links when not set
* Stickable behavior creates empty article
* Tables issue on small screens
* Override ```<address>``` user agent style
* Fix translation issues
* Search button is not working on older browsers

### Refactoring
* Avoid CSS ```@import```
* Refactor Bootstrap grid to Susy
* Upgrade Zendesk API usage

## v2.1

### Enhancements
* Add ngx_pagespeed
* Add input validation in com:traffic
* Add sticky header on small screens
* Add class to <html> which toggles between js-disabled/js-enabled based on JS support
* Add orderable behavior in com:about
* Multiple minor feature improvements

### Bug Fixes
* Articles in unpublished category remain accessible
* Fix the ability to save relations in com:districts
* Fix the ability to delete folders in com:files
* Fix issue with localised datetime in com:news and com:traffic
* Multiple minor bug fixes

### Refactoring
* Refactor quicklinks to modules

### Sites
* Release of [Police Comines-Warneton](http://www.lokalepolitie.be/5318)

## v2.0

### Enhancements
* Initial release

### Sites
* Release of [Politie Leuven](http://www.lokalepolitie.be/5388)
