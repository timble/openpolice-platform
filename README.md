![Screenshot](screenshot.jpg)

# Open Police

Open Police is an **open source** web publishing platform for police forces. It makes creating an open, modern, affordable, website to better connect with citizens very easy.

It uses a component based architecture. Written in PHP, HTML, CSS and Javascript. Made by [passionate open source technologists](http://www.timble.net/about/) and built on a purely [free and open source software stack](https://www.timble.net/platform/open-police/stack/).

Check our [demo website](https://internet.openpolice.be/) or visit our [project's website](https://www.timble.net/platform/open-police/).

## Features

* Mobile-First responsive design
* Optimized for performance and security
* Features a component based architecture
* Dynamic and cascading HMVC
* Level 3 JSON REST API

[Discover all features](https://www.timble.net/platform/open-police/#all-features).

## Used by

Open Police v2 is being used by the **Belgian local and federal police**.

A few live websites (in dutch or french):

- [Federal police](http://www.politie.be/fed/nl)
- [Local police force of Ghent](http://www.lokalepolitie.be/5415)
- [Local police force of Louvain](http://www.lokalepolitie.be/5388)
- [Local police force of Namur](http://www.policelocale.be/5303)

## Installation

You can run the project easily with the supplied Vagrantfile - make sure you understand what [Vagrant](http://vagrantup.com/) is.

* Install [Composer](http://getcomposer.org/doc/00-intro.md)
* Install [VirtualBox](http://www.virtualbox.org/)
* Install [Vagrant](http://www.vagrantup.com/downloads.html)
* Clone this repository
* Go to the repository folder and bootup the server
    ```
    $ vagrant up
    ```
* Add the following line to your hosts file
    ```
    192.168.52.10 police.dev phpmyadmin.police.dev
    ```
* You can now access the sample site at [police.dev](http://police.dev/)

### Access

* The example site application is available at [http://police.dev](http://police.dev/).
* The example admin application is available at [http://police.dev/administrator](http://police.dev/administrator/).
    ```
    email: demo@example.com
    password: police
    ```
* MailCatcher is available at [http://police.dev:1080/](http://police.dev:1080/)

### Theme development

We are using [Grunt](http://gruntjs.com/) to automate repetitive tasks like [Sass](http://sass-lang.com/) compilation, synchronised browser testing, etc.

* Install [Bower](https://bower.io/)
* Install [Yarn](https://yarnpkg.com)
* Go to the repository folder and install the dependencies: 
    ```
    yarn install
    ```
* Finally run Grunt 
    ```
    grunt
    ```

### Vagrant command-line interface

You can use the following commands to manage the server:

* ```vagrant up``` to initially start the server
* ```vagrant ssh``` to SSH into the running Vagrant machine
* ```vagrant reload``` reboots the server
* ```vagrant halt``` powers the server down
* ```vagrant suspend``` & ```vagrant resume``` to make the server sleep/wake up
* ```vagrant destroy``` to stop and destroy all resources of the server

More information about the Vagrant command-line interface can be found at [docs.vagrantup.com](http://docs.vagrantup.com/v2/cli/index.html).

### Secure Shell

You can use the following commands to manage the platform:

* ```police reinstall``` to re-create the sample site.

First use the Vagrant command-line interface to access the Secure Shell: ```vagrant ssh```.

### Database migrations

Database migrations are being managed using [Phpmig](https://github.com/davedevelopment/phpmig).

The Vagrant box will setup everything for you. To make sure you have applied the latest database changes, browse to ```cd scripts/phpmig``` and execute ```bin/phpmig migrate```.

To see a list of all migrations and their status, run ```bin/phpmig status```. Use the ```bin/phpmig up <migration ID>```and ```bin/phpmig down <migration ID>``` commands to apply or undo specific migrations.

For more information, please refer to the [Phpmig GitHub page](https://github.com/davedevelopment/phpmig).

## How to contribute?

Check our [contributing](CONTRIBUTING.md) guide.

## License

The files in this archive are released under the AGPLv3 license. You can find a copy of this license in [LICENSE](LICENSE.md).
