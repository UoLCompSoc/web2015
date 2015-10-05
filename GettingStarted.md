Getting Started with the CompSoc Site
=====================================

The CompSoc site should be easy to get started with developing; it should be as simple as editing a few configuration files and you'll be good to go!

Requirements
------------

A webserver, with the following installed:
- a recent version of PHP5
- MySQL
- The PHP/MySQL driver, curl and the PHP/curl driver.
- Apache2 with mod_rewrite

Note that apache2 is the only supported webserver; another could very well be used but a URL rewrite is required as detailed in `site/public/.htaccess`.

The site currently expects to be able to find the `site/application/` and `site/system/` folders in /var/www/. If you want to put them in a different location (or you're on another OS) you'll need to change the 2 obvious variable in `site/public/index.php` on your local machine. Please don't commit these changes.

Step-by-Step
------------

1. First thing's first, you need to run the setup script (a shell script, called setup.sh; if you're on Windows, see below). This script copies barebones config files into the appropriate folders, which you then need to edit manually.

2. There is a wrapper around the database details in `site/application/config/dbdetails.php` for security reasons. All you have to do is fill in the username, password and database name for your local MySQL database. The site won't start correctly until you do.

3. The same kind of wrapper applies to `site/application/config/encryptiondetails.php`; you need to generate your own security key (which should be a long number written like '1231245123552' - don't actually use that) and place it in the file.

4. `site/application/config/githubdetails.php` holds a GitHub API key for pulling the CompSoc projects directly from GitHub. Fill it in with appropriate details which you can generate on GitHub. If you don't bother, the site will mostly work but the projects page likely won't.

5. All of the files in `site/public/` need to be copied to your webroot; for an example Ubuntu installation this would be in `/var/www/html`.

6. Without a database, you won't be able to run the site. We have a script, `sql/compsoc.sql` which will generate a database for you; just log into mysql from the sql directory and run `CREATE DATABASE compsoc; SOURCE compsoc.sql;` And you'll be good to go.

7. If it worked you should be able to visit http://localhost and see the site alongside a developer message. If you've setup `githubdetails.php` correctly, you should now be able to go to http://localhost/webhook/update to correctly set up the projects page.

8. You'll need to register an account using the tools provided in the site. To make the first admin account you'll need to change your database manually; if you set a user's permissions to the value for USER_ADMIN found in [https://github.com/UoLCompSoc/web2015/blob/master/site/application/helpers/permissions_helper.php](the Permissions helper file) the account (after relogging) will be able to give itself and others permissions.

Windows Users
-------------

Under windows, you can either use some kind of shell emulator (e.g. cygwin, untested) to run the script, or else copy the files manually.

1. skeletons/dbdetails.php -> site/application/config/
2. skeletons/encryptiondetails.php -> site/application/config/
3. skeletons/githubdetails.php -> site/application/config/

It Won't Work!
--------------

If you've followed this guide and it still doesn't work, please raise a GitHub Issue explaining what's going on for you and we'll try to get it fixed.
