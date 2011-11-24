<?php
/** PHP Generic Registration Module (PHP-GEREMO)
 *
 * @package    GEREMO
 * @subpackage Examples
 */

################################################################################
# GENERAL SETTINGS
################################################################################

# Server-side secret used to generate cryptographic material.
#$_CONFIG['secret'] = ''; // string

# Comman-separated list of supported locales, the first being the default.
#$_CONFIG['locales'] = 'en,fr'; // string

# Enforce encrypted channel (SSL) usage
#$_CONFIG['force_ssl'] = 1; // integer

# Resources (localized HTML snippets, e-mail templates, text lables/messages;
# fonts) directory.
# ATTENTION: This directory MUST be readable (but NOT writable) by PHP!
#$_CONFIG['resources_dir'] = dirname( __FILE__ ).'/data/GEREMO/resources'; // is_readable( path )

# Data (dynamic content) directory.
# ATTENTION: This directory MUST be writable (and readable) by PHP!
# CRITICAL: THIS DIRECTORY MUST NOT BE ACCESSIBLE FROM THE WEB!!!
#$_CONFIG['data_dir'] = dirname( __FILE__ ).'/data/GEREMO/data'; // is_writable( path )

# The URL to redirect users in order to proceed to authentication.
#$_CONFIG['login_url'] = ''; // string

# Captcha image's width, height and font size.
#$_CONFIG['captcha_width'] = 240; // integer
#$_CONFIG['captcha_height'] = 120; // integer
#$_CONFIG['captcha_font_size'] = 32; // integer

# E-mail address to send message from.
# ATTENTION: Make sure that you mail system is configured to allow this
#            parameter to be overriden!
#$_CONFIG['email_sender_address'] = ''; // string

# E-mail address(es) to send registration notices to.
#$_CONFIG['email_registration_notice_address'] = ''; // string

# Registration/Authentication backend. Supported backends are:
#  'htpasswd': Apache's 'htpasswd' file
#  'sql': SQL database (see 'sql_*' parameters below)
#$_CONFIG['backend'] = 'htpasswd'; // string


################################################################################
# DATA SETTINGS
################################################################################

# MANDATORY FIELDS SETTINGS

# Registering users e-mail address whitelist/blacklist, formatted as
# 'preg_match' patterns.
#$_CONFIG['data_email_whitelist'] = ''; // string
#$_CONFIG['data_email_blacklist'] = ''; // string

# Password lenght and complexity constraints.
#$_CONFIG['data_password_minlength'] = 10; // integer
#$_CONFIG['data_password_maxlength'] = 50; // integer
#$_CONFIG['data_password_complexity'] = 3; // integer

# Password encryption method (see 'mhash' PHP module for further information).
# ATTENTION: The chosen method MUST be compatible with the chosen Apache's
#            'mod_auth_*' module and match its configuration!
#$_CONFIG['data_password_hash'] = MHASH_SHA1; // integer (MHASH_*)

# OPTIONAL FIELDS SETTINGS
# Possible values for the 'data_include_*' parameter are:
#  0 - Do not include/use the given
#  1 - Include/use the given (but allow it to be empty)
#  2 - Include/use the given (and force it to be non-empty)
# ATTENTION: You MUST configure the chosen backend to handle the additional
#            extra fields accordingly!

# Registering user's title.
#$_CONFIG['data_include_title'] = 0;
#$_CONFIG['data_maxlength_title'] = 50;
$_CONFIG['data_include_title'] = 1;

# Registering user's firstname.
#$_CONFIG['data_include_firstname'] = 0;
#$_CONFIG['data_maxlength_firstname'] = 50;
$_CONFIG['data_include_firstname'] = 2;

# Registering user's lastname.
#$_CONFIG['data_include_lastname'] = 0;
#$_CONFIG['data_maxlength_lastname'] = 50;
$_CONFIG['data_include_lastname'] = 2;

# Registering user's company.
#$_CONFIG['data_include_company'] = 0;
#$_CONFIG['data_maxlength_company'] = 50;
$_CONFIG['data_include_company'] = 1;

# Registering user's job title.
#$_CONFIG['data_include_jobtitle'] = 0;
#$_CONFIG['data_maxlength_jobtitle'] = 50;
$_CONFIG['data_include_jobtitle'] = 1;

# Registering user's street.
#$_CONFIG['data_include_street'] = 0;
#$_CONFIG['data_maxlength_street'] = 50;
$_CONFIG['data_include_street'] = 2;

# Registering user's street (2nd line).
#$_CONFIG['data_include_street2'] = 0;
#$_CONFIG['data_maxlength_street2'] = 50;
$_CONFIG['data_include_street2'] = 1;

# Registering user's post-office box.
#$_CONFIG['data_include_pobox'] = 0;
#$_CONFIG['data_maxlength_pobox'] = 50;
$_CONFIG['data_include_pobox'] = 1;

# Registering user's city.
#$_CONFIG['data_include_city'] = 0;
#$_CONFIG['data_maxlength_city'] = 50;
$_CONFIG['data_include_city'] = 2;

# Registering user's zip code.
#$_CONFIG['data_include_zipcode'] = 0;
#$_CONFIG['data_maxlength_zipcode'] = 50;
$_CONFIG['data_include_zipcode'] = 2;

# Registering user's state.
#$_CONFIG['data_include_state'] = 0;
#$_CONFIG['data_maxlength_state'] = 50;
$_CONFIG['data_include_state'] = 1;

# Registering user's country.
#$_CONFIG['data_include_country'] = 0;
#$_CONFIG['data_maxlength_country'] = 50;
$_CONFIG['data_include_country'] = 2;

# Registering user's phone.
#$_CONFIG['data_include_phone'] = 0;
#$_CONFIG['data_maxlength_phone'] = 50;
$_CONFIG['data_include_phone'] = 2;

# Registering user's fax.
#$_CONFIG['data_include_fax'] = 0;
#$_CONFIG['data_maxlength_fax'] = 50;
$_CONFIG['data_include_fax'] = 1;

# Registering user's e-mail address.
#$_CONFIG['data_maxlength_email'] = 50;


################################################################################
# BACKEND SETTINGS
################################################################################

# SQL SETTINGS

# Database connection parameters (matching PHP Data Objects [PDO] stanza).
#$_CONFIG['sql_dsn'] = 'mysql:host=localhost;dbname=geremo'; // string
#$_CONFIG['sql_username'] = 'geremo'; // string
#$_CONFIG['sql_password'] = ''; // string
#$_CONFIG['sql_options'] = array(); // array (of scalar)

# Database function to use to perform the registration.
# See the '*.sql' files in the 'examples' directory for further details.
#$_CONFIG['sql_function'] = 'fn_GEREMO_Register'; // string
