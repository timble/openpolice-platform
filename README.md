# README

## Police Internet Platform

The Police Internet Platform is an open-source platform specifically built for the internet websites of the Belgian Police.
It uses a component based architecture. Written in PHP 5.3, HTML, CSS and Javascript, and made by passionate open source technologists.

Developed by <a href="http://www.timble.net">Timble</a>.

![Screenshot](https://dl.dropboxusercontent.com/u/77404/timble/police/github/devices.jpg)

Check this website at [www.lokalepolitie.be/leuven](http://www.lokalepolitie.be/leuven).

## Installation

You can run the project easily with the supplied Vagrantfile - make sure you understand what [Vagrant](http://vagrantup.com/) is.

* Install [Composer](http://getcomposer.org/doc/00-intro.md)
* Install [VirtualBox](http://www.virtualbox.org/)
* Install [Vagrant](http://www.vagrantup.com/downloads.html)
* Clone this repository
    ```$ git clone https://github.com/belgianpolice/internet-platform.git```
* Go to the repository folder where this README is located and bootup the server
    ```$ vagrant up```
* Add the following line to your hosts file
    ```192.168.52.10 police.dev phpmyadmin.police.dev```
* You can now access the sample site at [police.dev/9999](http://police.dev/9999)!

Note: Linux users need to install NFS (Network File System) manually, see [help.ubuntu.com](http://help.ubuntu.com/community/SettingUpNFSHowTo) for more information.


## Vagrant command-line interface

You can use the following commands to manage the server:

* ```vagrant up``` to initially start the server
* ```vagrant ssh``` to SSH into the running Vagrant machine
* ```vagrant reload``` reboots the server
* ```vagrant halt``` powers the server down
* ```vagrant suspend``` & ```vagrant resume``` to make the server sleep/wake up
* ```vagrant destroy``` to stop and destroy all resources of the server

More information about the Vagrant command-line interface can be found at [docs.vagrantup.com](http://docs.vagrantup.com/v2/cli/index.html).


## Secure Shell

You can use the following commands to manage the platform:

* ```police reinstall``` to re-create the sample site.

First use the Vagrant command-line interface to access the Secure Shell, see above.

## Database migrations

Database migrations are being managed using [Phpmig](https://github.com/davedevelopment/phpmig). 

The vagrant box will setup everything for you. To make sure you have applied the latest database changes, browse to ```cd <repo>/scripts/phpmig``` and execute ```bin/phpmig migrate```.

To see a list of all migrations and their status, run ```bin/phpmig status```. Use the ```bin/phpmig up <migration ID>```and ```bin/phpmig down <migration ID>``` commands to apply or undo specific migrations.

For more information, please refer to the [Phpmig GitHub page](https://github.com/davedevelopment/phpmig).


## Access

* The example site application is available at [http://police.dev/9999](http://police.dev/9999).
* The example admin application is available at [http://police.dev/administrator/9999](http://police.dev/administrator/9999).

    ```
    email: admin@localhost.home
    password: admin
    ```
* MailCatcher is available at [http://police.dev:1080/](http://police.dev:1080/)

## Benefits

### Accessibility

* Conforms to [WCAG 2.0](http://www.w3.org/TR/WCAG20/) level AAA
* Leverages [WAI-ARIA](http://www.w3.org/TR/wai-aria/) & [HTML5](http://www.w3.org/TR/html5/) to further enhance accessibility

### Interoperability

* Support for HTML data ([Microformats.org](http://www.microformats.org/), [Schema.org](http://www.schema.org/))

### Mobile-First Responsive Web Design

* Following a Progressive Enhancement strategy
* Optimized for performance


## Built on Open Source software

The Police Internet Platform is built on open source software and wouldn't be as productive without these open source projects around.
We simply just want to say thank you to the following projects for helping us out:

* [Bootstrap](http://getbootstrap.com)
* [Capistrano](http://www.capistranorb.com)
* [Composer](http://getcomposer.org)
* [Git](http://git-scm.com)
* [Imagine](https://github.com/avalanche123/Imagine)
* [Joomla](http://www.joomla.org)
* [jQuery](http://jquery.com)
* [Linux](http://linux.org)
* [Magnific-Popup](https://github.com/dimsemenov/Magnific-Popup)
* [MailCatcher](https://github.com/sj26/mailcatcher)
* [MooTools](http://mootools.net)
* [nginx](http://nginx.org)
* [Nooku](http://www.nooku.org)
* [PageSpeed](http://developers.google.com/speed/pagespeed)
* [PHP](http://php.net)
* [PHP-JWT](http://github.com/firebase/php-jwt)
* [Phpmig](https://github.com/davedevelopment/phpmig)
* [Placeholders.js](https://github.com/jamesallardice/Placeholders.js/)
* [Sass](http://sass-lang.com)
* [Select2](http://ivaynberg.github.io/select2)
* [Susy](http://susy.oddbird.net/)
* [Vagrant](http://www.vagrantup.com)
* [VirtualBox](http://www.virtualbox.org)


## Open Data resources

The Police Internet Platform leverages open data resources and and wouldn't be as productive without these open data projects.
We simply just want to say thank you to the following projects for helping us out:

* [Flemish Geographical Information Agency](https://www.agiv.be/)


## How to contribute?

Check our [contributing](CONTRIBUTING.md) guide.


## License

The files in this archive are released under the GPLv3 license. You can find a copy of this license in [LICENSE](LICENSE.md).
