# README

## Police Internet Platform

The Police Internet Platform is an open-source platform specifically built for the internet websites of the Belgian Police.
It uses a component based architecture. Written in PHP 5.3, HTML5, CSS3 and Javascript, and made by passionate open source technologists.

Developed by <a href="http://www.timble.net">Timble</a>.

## Installation

* Install [VirtualBox](http://www.virtualbox.org/)
* Install [Vagrant](http://downloads.vagrantup.com/)
* Clone this repository
    ```$ git clone https://github.com/belgianpolice/internet-platform.git```
* Download the 'Police Box' from [https://docs.google.com/file/d/0B8ge8rYDyzFhSy1WMjdmSXRkSTQ/edit?usp=sharing](https://docs.google.com/file/d/0B8ge8rYDyzFhSy1WMjdmSXRkSTQ/edit?usp=sharing)
* Setup the server
    ```vagrant box add police local-path-to-police.box```
* Go to the repository folder and bootup the server
    ```vagrant up```
* Add the following line to your hosts file
    ```192.168.52.10 police.dev phpmyadmin.police.dev```

Note: Linux users need to install NFS (Network File System) manually, see [help.ubuntu.com](http://help.ubuntu.com/community/SettingUpNFSHowTo) for more information.


## Vagrant command-line interface

You can use the following commands to manage the server:

* ```vangrant up``` to initially start the server
* ```vagrant reload``` reboots the server
* ```vagrant halt``` powers the server down
* ```vagrant suspend``` & ```vagrant resume``` to make the server sleep/wake up
* ```vangrant destroy``` to stop and destroy all resources of the server

More information about the Vagrant command-line interface can be found at [docs.vagrantup.com](http://docs.vagrantup.com/v2/cli/index.html).


## Access

* The site application is available at [http://police.dev/5388](http://police.dev/5388).
* The admin application is available at [http://police.dev/administrator/5388](http://police.dev/administrator/5388).

    ```
    email: admin@localhost.home
    password: admin
    ```

## How to contribute?

Check our [contributing](CONTRIBUTING.md) guide.


## License

The files in this archive are released under the GPLv3 license. You can find a copy of this license in [LICENSE](LICENSE.md).


[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/belgianpolice/internet-platform/trend.png)](https://bitdeli.com/free "Bitdeli Badge")

