PHP Generic Registration Module (PHP-GEREMO)
============================================

This directory contains usage and configuration examples for the PHP Generic
Registration Module.

The 'config.php' file contains all the configuration directives that are
used to setup the PHP Generic Registration Module and modify its behavior
according to your requirements.
You should copy this file to some configuration path (e.g. /etc/GEREMO/.).
The path to your actual configuration file MUST then be saved in Apache's
'PHP_GEREMO_CONFIG' environment variable (using a 'setenv' directive).
CRITICAL: THIS FILE MUST NOT BE ACCESSIBLE BY HTTP CLIENTS!!!
In other words, it must be accessible by PHP by NOT through any Apache's
URL location.

The 'index.php' file contains the PHP/HTML code necessary to make the PHP
Generic Registration Module accessible via an Apache's URL location.
You should copy this file into your web application's path and then modify
its HTML content to match your needs (but try not to modify its PHP code,
unless you know what you're doing).

The '<backend>.htaccess' files are Apache's 'htaccess' examples which details the
configuration directives required to enable Apache's authentication and
authorization using the desired backend.
Note that it is possible to use multiple backends (e.g. htpasswd + mysql + ldap).
How to achieve this is beyond the purpose of this document, though.

The '<backend>.sql' files contain the SQL source code required to setup a
database which can be used by the PHP Generic Registration Module and Apache
to achieve your registration -> authentication -> auhtorization purpose.
