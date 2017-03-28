# Changelog

## v3.0

### Site Enhancements

- Complete redesign that significantly improves usability - #23
- Avoid redirect in link to twitter.com - #223

### Development

- Relicensed to AGPLv3 - #235
- Update installation SQL - #233
- Removed old themes - #236
- Removed site-specific overrides - #237

## v2.10

### Site Enhancements

- Added privacy-enhanced mode for Youtube embeds - #163
- Added structured data markup for breadcrumbs - #187
- Added margin below Youtube embed - #188
- Added purple styling for all visited links - #189
- Added new statistics - #170
- Added statistics for the provinces and regions - #151
- Changed 'In violation' to 'Not in violation' - #160
- Changed dates format to the NBN Z01-002 standard - #103
- Fixed issue with solved status of wanted persons - #150
- Fixed broken 404 page - #162
- Fixed unsanitized Javascript in path - #211
- Fixed XSS vulnerability in statistics - #175
- Fixed multiple French translations - #157
- Renamed 'Des numéros d'urgence' to 'Numéros d'urgence' - #186
- Replaced image on the 404 page - #181
- Removed eCops link - #177
- Removed news fetching in the background - #172
- Removed district officer avatar placeholder - #131
- District officer search form on the website of Grensleie is hidden - #220

### Administrator Enhancements

- Added limitation of login attempts - #149
- Added province filter to zones - #230
- Added district filter to zones - #229
- Added customised model for streets #190
- Added ability to add non-numeric references to found items - #158
- Added 'NL, FR & DE' option to listbox in the zone form - #153
- Added requestor field for wanted persons - #144
- Fixed selection of all district officers when creating a new district - #191
- Fixed accessible activities view - #178
- Fixed inability to add zero violations - #176
- Fixed undefined method when editing a checked out district - #36
- District ID is now optional for relations import - #194
- Make all streets available in specific sites - #180 & #135

### Development

- Fixed capistrano issue with zone numbers - #179

### Sites

Release of:

- [Police Arlon - Attert - Habay - Martelange](http://www.policelocale.be/5297) - #212
- [Police Botte de Hainaut](http://www.policelocale.be/5334) - #227
- [Police de Val de L'Escaut](http://www.policelocale.be/5320) - #203
- [Police Des 3 Vallées](http://www.policelocale.be/5311) - #164  
- [Police Des Fagnes](http://www.policelocale.be/5287) - #166
- [Police de Tournaisis](http://www.policelocale.be/5316) - #142
- [Police Hermeton-et-Heure](http://www.policelocale.be/5315) - #156
- [Police Meuse-Hesbaye](http://www.policelocale.be/5294) - #217
- [Police Namur](http://www.policelocale.be/5303) - #169
- [Police La Louvière](http://www.policelocale.be/5325) - #197
- [Police Lesse et Lhomme](http://www.policelocale.be/5313) - #228
- [Politie BRT](http://www.lokalepolitie.be/5399) - #174
- [Politie Denderleeuw/Haaltert](http://www.lokalepolitie.be/5439) - #185
- [Politie Dijleland](http://www.lokalepolitie.be/5398) - #195
- [Politie Grensleie](http://www.lokalepolitie.be/5455) - #222
- [Politie Limburg Regio Hoofdstad](http://www.lokalepolitie.be/5907) - #225 & #193
- [Politie Maldegem](http://www.lokalepolitie.be/5424) - #210
- [Politie Pajottenland](http://www.lokalepolitie.be/5405) - #168
- [Politie Spoorkin](http://www.lokalepolitie.be/5459) - #155  
- [Politie TARL](http://www.lokalepolitie.be/5407) - #159
- [Politie Zennevallei](http://www.lokalepolitie.be/5905) - #226 & #196

## v2.9

### Site Enhancements

* Added new portal page for the integrated police
* Added meta description to homepage
* Added hreflang to the language links
* Added correct language values (nl-BE, fr-BE & de-BE)
* Added optional link to a contact on the questions pages
* Added fallback to domain name language instead of browser language
* Renamed 'Nouvelles' to 'Actualités'
* Improved streets autocomplete when returning to previous page
* Single column in 'Your district' on non-full width screens
* Truncate zone names on small screens
* Merged 'District officer' and 'BIN' pages
* Break out of an iFrame

### Administrator Enhancements

* Added Youtube embed in news and about articles
* Added publish on field to press articles
* Found on date is now required and 'today' as default
* Fixed scrolling issue
* Improved analytics screen

### Bug Fixes

* Fixed issue when referrer Cookie is empty by adding a fallback
* Fixed news links in multilingual sites
* Fixed sluggable behavior in multilingual setup
* Fixed layout issue when searching questions
* Fixed multiple minor multilingual improvements
* Fixed thumbnails on IE8
* Fixed parsing issue of the route when it contained the sitename
* Fixed sorting of press articles by published on date
* Fixed navigation items that got wrapped to a new line on IE8 and lower
* Fixed missing city names in French
* Fixed missing streets in traffic results

### Refactoring

* Streets database refactor, from multiple tables to one `streets_relations` table

### Development

* Added BrowserSync to Grunt
* Refactored to Libsass for faster compilation

### Sites

Release of:

* [Federale Politie](http://www.politie.be/fed/nl)
* [Police Hesbaye-Ouest](http://www.policelocale.be/5293)
* [Police Famenne-Ardenne](http://www.policelocale.be/5300)
* [Police Des Trieux](http://www.policelocale.be/5336)
* [Politie Ukkel/WB/Oudergem](http://www.lokalepolitie.be/5342)
* [Politie Balen-Dessel-Mol](http://www.lokalepolitie.be/5368)
* [Politie Neteland](http://www.lokalepolitie.be/5369)
* [Politie West-Limburg](http://www.lokalepolitie.be/5374)
* [Politie Noordoost-Limburg](http://www.lokalepolitie.be/5385)
* [Politie HerKo](http://www.lokalepolitie.be/5393)
* [Politie Aalter-Knesselare](http://www.lokalepolitie.be/5423)
* [Politie Sint-Niklaas](http://www.lokalepolitie.be/5432)
* [Politie Blankenberge/Zuienkerke](http://www.lokalepolitie.be/5445)
* [Politie MIRA](http://www.lokalepolitie.be/5457)
* [Politie Waasland-Noord](http://www.lokalepolitie.be/5904)


## v2.8

### Site Enhancements

* Added ability to browse the Office Hours for the upcoming 14 days
* Added city in Traffic for multi-city zones
* Combined Districts & Neighbourhood Information Network
* Redesigned Attachments listing
* Decreased last breakpoint

### Administrator Enhancements

* Added one-off Office Hours
* Added Traffic results
* Added Districts list when browsing Streets
* Added Attachments support to Traffic
* Added simple Analytics dashboard
* Allow empty end-date in Traffic

### Bug Fixes

* Questions search included unpublished articles
* RSS feed is now valid
* Unset URL parameters on the homepage
* Fixed flexbox scroll issue on Firefox in the administrator
* Limit Districts & Contacts to one thumbnail

### Refactoring

* Improved Districts database schema
* Simplified domains for staging & development
* Refactored structured data in Contacts to JSON-LD

### Sites

Release of:

* [Police Condroz-Famenne](http://www.policelocale.be/5314)
* [Police Haute Senne](http://www.policelocale.be/5328)
* [Police Orneau-Mehaigne](http://www.policelocale.be/5304)
* [Police Seraing-Neupré](http://www.policelocale.be/5278)
* [Politie Meetjesland](http://www.lokalepolitie.be/5417)
* [Politie Ninove](http://www.lokalepolitie.be/5442)
* [Politie Sint-Truiden - Gingelom - Nieuwerkerken](http://www.lokalepolitie.be/5376)
* [Politie Ronse](http://www.lokalepolitie.be/5427)


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
