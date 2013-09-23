README
======

What is the Police Internet Platform
------------------------------------

The Police Internet Platform is an open-source platform specifically built for the internet websites of the Belgian Police.
It uses a component based architecture. Written in PHP 5.3, HTML5, CSS3 and Javascript, and made by passionate open source technologists.


Installation
------------

* Install [VirtualBox](http://www.virtualbox.org/)
* Install [Vagrant](http://downloads.vagrantup.com/)
* Clone this repository
    ```$ git clone https://github.com/belgianpolice/internet-platform.git```
* Setup the server
    ```vagrant box add police https://docs.google.com/file/d/0B8ge8rYDyzFhSy1WMjdmSXRkSTQ/edit?usp=sharing```
* Go to the repository folder and bootup the server
    ```vagrant up```
* Add the following line into /etc/hosts
    ```192.168.52.10 police.dev phpmyadmin.police.dev```

Note: Linux users need to install NFS (Network File System) manually, see [help.ubuntu.com](http://help.ubuntu.com/community/SettingUpNFSHowTo) for more information.


Vagrant command-line interface
------------------------------

You can use the following commands to manage the server:

* ```vangrant up``` to initially start the server
* ```vagrant reload``` reboots the server
* ```vagrant halt``` powers the server down
* ```vagrant suspend``` & ```vagrant suspend``` to make the server sleep/wake up
* ```vangrant destroy``` to stop and destroy all resources of the server

More information about the Vagrant command-line interface can be found at [docs.vagrantup.com](http://docs.vagrantup.com/v2/cli/index.html).


License
-------

The files in this archive are released under the GPLv3 license. You can find a copy of this license in [LICENSE](develop/LICENSE.md).
