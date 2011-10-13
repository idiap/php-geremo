PHP Generic Registration Module (PHP-GEREMO)
============================================


Synopsis
--------

The PHP Generic Registration Module is a PHP class which allows to implement
"double opt-in" users registration as an independent and foolproof add-on to
any existing application.

Upon completion of the registration process and once their credentials (and
optional details) stored in the configurable backend, users can be authenti-
cated and authorized using the web server's ad-hoc mechanisms - e.g. Apache's
 mod_auth_file or mod_auth_mysql - and gain access to the underlying appli-
cation.

The idea behind this module is to:
 - use the web server authentication and authorization capacities to control
   access to the underlying application (be it in PHP, ASP, Java, Perl, Python,
   etc.) and thus prevent potential application-level vulnerabilities to be
   exploited by unauthenticated agents;
 - provide developers a way to quickly add a registration process to any exis-
   ting application;
 - do so as an independent and foolproof add-on, which focus on the quality and
   the security of the registration process.


Dependencies
------------

 - [REQUIRED] PHP 5.3 or later (it may work on earlier PHP 5 versions; this is untested though)
 - [REQUIRED] PHP mhash extension
 - [REQUIRED] PHP mcrypt extension
 - [REQUIRED] PHP PEAR::Text_CAPTCHA extension (and dependencies)
 - [REQUIRED] PHP PEAR::Mail and PEAR::Mail_Mime extensions (and dependencies)
 - [OPTIONAL] PHP PEAR::MDB2 extension (and dependencies); required only when using a SQL backend


Features
--------

 - captcha-protected registration request
 - code-protected registration confirmation ("double opt-in"); code is sent by e-mail
 - required user's data: email, password
 - optional (configurable) user's data: title, firstname, lastname, company, jobtitle, street, street2, pobox, city, zipcode, state, country, phone, fax
 - registering user's e-mail whitelist/blacklist
 - password encryption (to match the web server's authentication requirements)
 - dynamic 24h-rotated code keys (prevent brute-force attacks)
 - registration process state tracking (prevent replay attacks)
 - registration backends: htpasswd and sql (compatible with Apache's mod_auth_file, mod_auth_mysql and mod_auth_pgsql)
 - localized and customizable HTML, e-mail templates and text messages

