Getting Started with the CompSoc Site
=====================================

The CompSoc site should be easy to get started with developing; it should be as simple as editing a few configuration files and you'll be good to go!

Requirements
------------

A webserver, with a recent version of PHP5 installed, MySQL installed, and the php/MySQL driver installed. Installation varies between systems, but shouldn't be too hard to setup.

Step-by-Step
------------

1. First thing's first, you need to run the setup script (a shell script, called setup.sh; if you're on Windows, see below). This script copies barebones config files into the appropriate folders, which you then need to edit manually.

2. There is a wrapper around the database details in site/application/config/dbdetails.php for security reasons. All you have to do is fill in the username, password and database name for your local MySQL database. The site won't start correctly until you do.

3. The same kind of wrapper applies to site/application/config/encryptiondetails.php; you need to generate your own security key (which should be a long number) and place it in the file.

Windows Users
-------------

Under windows, you can either use some kind of shell emulator (e.g. cygwin, untested) to run the script, or else copy the files manually.

1. skeletons/dbdetails.php -> site/application/config
2. skeletons/encryptiondetails.php -> site/application/config

It Won't Work!
--------------

If you've followed this guide and it still doesn't work, please raise a GitHub Issue explaining what's going on for you and we'll try to get it fixed.

