<?php // INDENTING (emacs/vi): -*- mode:php; tab-width:2; c-basic-offset:2; intent-tabs-mode:nil; -*- ex: set tabstop=2 expandtab:
/** PHP Generic Registration Module (PHP-GEREMO)
 *
 * <P><B>COPYRIGHT:</B></P>
 * <PRE>
 * PHP Generic Registration Module (PHP-GEREMO)
 * Copyright (C) 2011 Idiap Research Institute <http://www.idiap.ch>
 * Author(s): Cedric Dufour <cedric.dufour@idiap.ch>
 *
 * This file is part of the PHP Generic Registration Module (PHP-GEREMO).
 *
 * The PHP Generic Registration Module (PHP-GEREMO) is free software:
 * you can redistribute it and/or modify it under the terms of the GNU General
 * Public License as published by the Free Software Foundation, Version 3.
 *
 * The PHP Generic Registration Module (PHP-GEREMO) is distributed in the hope
 * that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License (LICENSE.TXT) for more details.
 * </PRE>
 *
 * @package    GEREMO
 * @subpackage Main
 * @copyright  2011 Idiap Research Institute <http://www.idiap.ch>
 * @author     Cedric Dufour <cedric.dufour@idiap.ch>
 * @license    http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License (GPL) Version 3
 * @version    @version@
 * @link       http://www.idiap.ch/software/php-geremo
 */

/** PHP Generic Registration Module
 *
 * @package    GEREMO
 * @subpackage Main
 */
class GEREMO
{

  /*
   * FIELDS
   ********************************************************************************/

  /** Configuration parameters
   * @var array|mixed */
  private $amCONFIG;

  /** Form data
   * @var array|mixed */
  private $amFORMDATA;


  /*
   * CONSTRUCTORS
   ********************************************************************************/

  /** Construct and inititalize a new GEREMO object
   *
   * @param string $sConfigurationPath Configuration file path
   */
  public function __construct( $sConfigurationPath )
  {
    // Fields
    $this->initConfig( $sConfigurationPath );
  }


  /*
   * METHODS: General
   ********************************************************************************/

  /** Initialize (default or user-overriden) configuration parameters for this object
   *
   * @param string $sConfigurationPath Configuration file path (see the sample <SAMP>config.php</SAMP> file for further details)
   * @return array|mixed View data
   */
  private function initConfig( $sConfigurationPath )
  {
    // Set defaults
    $_CONFIG = array();
    $_CONFIG['secret'] = '';
    $_CONFIG['locales'] = 'en,fr';
    $_CONFIG['force_ssl'] = 1;
    $_CONFIG['resources_dir'] = dirname( __FILE__ ).'/data/GEREMO/resources';
    $_CONFIG['data_dir'] = dirname( __FILE__ ).'/data/GEREMO/data';
    $_CONFIG['login_url'] = '';
    $_CONFIG['login_url_validation_preg'] = '';
    $_CONFIG['captcha_width'] = 240;
    $_CONFIG['captcha_height'] = 120;
    $_CONFIG['captcha_font_size'] = 32;
    $_CONFIG['email_sender_address'] = '';
    $_CONFIG['email_registration_notice_address'] = '';
    $_CONFIG['backend'] = 'htpasswd-noexec';
    $_CONFIG['data_email_whitelist'] = '';
    $_CONFIG['data_email_blacklist'] = '';
    $_CONFIG['data_password_minlength'] = 10;
    $_CONFIG['data_password_maxlength'] = 50;
    $_CONFIG['data_password_complexity'] = 3;
    $_CONFIG['data_password_hash'] = MHASH_SHA1;
    $_CONFIG['data_include_title'] = 0;
    $_CONFIG['data_include_firstname'] = 0;
    $_CONFIG['data_include_lastname'] = 0;
    $_CONFIG['data_include_company'] = 0;
    $_CONFIG['data_include_jobtitle'] = 0;
    $_CONFIG['data_include_street'] = 0;
    $_CONFIG['data_include_street2'] = 0;
    $_CONFIG['data_include_pobox'] = 0;
    $_CONFIG['data_include_city'] = 0;
    $_CONFIG['data_include_zipcode'] = 0;
    $_CONFIG['data_include_state'] = 0;
    $_CONFIG['data_include_country'] = 0;
    $_CONFIG['data_include_phone'] = 0;
    $_CONFIG['data_include_fax'] = 0;
    $_CONFIG['data_maxlength_title'] = 50;
    $_CONFIG['data_maxlength_firstname'] = 50;
    $_CONFIG['data_maxlength_lastname'] = 50;
    $_CONFIG['data_maxlength_company'] = 50;
    $_CONFIG['data_maxlength_jobtitle'] = 50;
    $_CONFIG['data_maxlength_street'] = 50;
    $_CONFIG['data_maxlength_street2'] = 50;
    $_CONFIG['data_maxlength_pobox'] = 50;
    $_CONFIG['data_maxlength_city'] = 50;
    $_CONFIG['data_maxlength_zipcode'] = 50;
    $_CONFIG['data_maxlength_state'] = 50;
    $_CONFIG['data_maxlength_country'] = 50;
    $_CONFIG['data_maxlength_phone'] = 50;
    $_CONFIG['data_maxlength_fax'] = 50;
    $_CONFIG['data_maxlength_email'] = 50;
    $_CONFIG['sql_dsn'] = 'mysql:host=localhost;dbname=geremo';
    $_CONFIG['sql_username'] = 'geremo';
    $_CONFIG['sql_password'] = '';
    $_CONFIG['sql_options'] = array();
    $_CONFIG['sql_prepare'] = '';
    $_CONFIG['sql_function'] = 'fn_GEREMO_Register';

    // Load user configuration
    if( ( include $sConfigurationPath ) === false )
    {
      trigger_error( '['.__METHOD__.'] Failed to load configuration', E_USER_WARNING );
      throw new Exception( $this->getText( 'error:internal_error' ) );
    }

    // Validation
    //echo nl2br( var_export( $_CONFIG, true ) ); // DEBUG
    // ... is integer
    foreach( array( 'force_ssl',
                    'captcha_width', 'captcha_height', 'captcha_font_size',
                    'data_password_minlength', 'data_password_maxlength', 'data_password_complexity', 'data_password_hash',
                    'data_include_title', 'data_include_firstname', 'data_include_lastname',
                    'data_include_company', 'data_include_jobtitle', 'data_include_street',
                    'data_include_street2', 'data_include_city', 'data_include_zipcode',
                    'data_include_state', 'data_include_country',
                    'data_include_phone', 'data_include_fax',
                    'data_maxlength_title', 'data_maxlength_firstname', 'data_maxlength_lastname',
                    'data_maxlength_company', 'data_maxlength_jobtitle', 'data_maxlength_street',
                    'data_maxlength_street2', 'data_maxlength_city', 'data_maxlength_zipcode',
                    'data_maxlength_state', 'data_maxlength_country',
                    'data_maxlength_phone', 'data_maxlength_fax', 'data_maxlength_email'
                    ) as $p )
      if( !is_int( $_CONFIG[$p] ) )
        trigger_error( '['.__METHOD__.'] Parameter must be an integer ('.$p.')', E_USER_ERROR );
    // ... is string
    foreach( array( 'secret', 'locales', 'login_url', 'login_url_validation_preg',
                    'email_sender_address', 'email_registration_notice_address',
                    'data_email_whitelist', 'data_email_blacklist',
                    'backend',
                    'sql_dsn', 'sql_username', 'sql_password', 'sql_prepare', 'sql_function' ) as $p )
      if( !is_string( $_CONFIG[$p] ) )
        trigger_error( '['.__METHOD__.'] Parameter must be a string ('.$p.')', E_USER_ERROR );
    // ... is array (of scalar)
    foreach( array( 'sql_options' ) as $p )
    {
      if( !is_array( $_CONFIG[$p] ) )
        trigger_error( '['.__METHOD__.'] Parameter must be an array ('.$p.')', E_USER_ERROR );
      foreach( $_CONFIG[$p] as $k => $v )
        if( !is_scalar( $v ) )
          trigger_error( '['.__METHOD__.'] Parameter must be a scalar ('.$p.':'.$k.')', E_USER_ERROR );
    }
    // ... is readable
    foreach( array( 'resources_dir' ) as $p )
      if( !is_readable( $_CONFIG[$p] ) )
        trigger_error( '['.__METHOD__.'] Parameter must be a readable path ('.$p.')', E_USER_ERROR );
    // ... is writeable
    foreach( array( 'data_dir' ) as $p )
      if( !is_writable( $_CONFIG[$p] ) )
        trigger_error( '['.__METHOD__.'] Parameter must be a writable path ('.$p.')', E_USER_ERROR );

    // Done
    $this->amCONFIG = $_CONFIG;
  }

  /** Retrieve keys (slots)
   *
   * <P><B>SYNOPSIS:</B> This function returns an array associating each hour (numbered from 0 to 23) with
   * a different key, which is renewed every 24 hours. This allows to enforce 24-hour timeout of verification
   * codes and prevent brute-forcing.</P>
   *
   * @return array|mixed Keys
   */
  private function getKeys()
  {
    // Build/retrieve keys
    $sKeysFile = $this->amCONFIG['data_dir'].'/.htkeys';
    $iNow = time(); // in seconds
    $iKeySlot = date( 'G', $iNow ); // hour-slot
    $iNow = (integer)( $iNow / 3600 ); // in hours
    $amKeys = unserialize( @file_get_contents( $sKeysFile ) );
    if( !is_array( $amKeys ) ) // No existing/valid keys
    {
      // Build new keys
      $amKeys = array();
      for( $i=0; $i<=23; $i++ )
      {
        $amKeys[$i] = mhash_keygen_s2k ( MHASH_SHA1 , $this->amCONFIG['secret'], mcrypt_create_iv( 256, MCRYPT_DEV_URANDOM ), 256 );
      }
      $amKeys[24] = $iNow; // This is used to know when we need to renew keys

      // Save to disk
      umask( 077 );
      if( file_put_contents( $sKeysFile, serialize( $amKeys ) ) === false )
      {
        trigger_error( '['.__METHOD__.'] Failed to save cryptographic keys (create)', E_USER_WARNING );
        throw new Exception( $this->getText( 'error:internal_error' ) );
      }
    }
    elseif( $amKeys[24] != $iNow ) // Keys need to be renewed
    {
      // Renew keys for outdated key slots
      $iDeltaHours = $iNow - $amKeys[24];
      for( $i=0; $i<$iDeltaHours and $i<24; $i++ )
      {
        $amKeys[($iKeySlot+$i)%24] = mhash_keygen_s2k ( MHASH_SHA1 , $this->amCONFIG['secret'], mcrypt_create_iv( 256, MCRYPT_DEV_URANDOM ), 256 );
      }
      $amKeys[24] = $iNow;

      // Save to disk
      umask( 077 );
      if( file_put_contents( $sKeysFile, serialize( $amKeys ) ) === false )
      {
        trigger_error( '['.__METHOD__.'] Failed to save cryptographic keys (update)', E_USER_WARNING );
        throw new Exception( $this->getText( 'error:internal_error' ) );
      }
    }

    // Done
    return $amKeys;
  }

  /** Retrieve the supported locales
   *
   * @return array|string Array of locale IDs
   */
  public function getSupportedLocales()
  {
    return explode( ',', $this->amCONFIG['locales'] );
  }

  /** Retrieve the default locale
   *
   * @return string Locale ID
   */
  public function getDefaultLocale()
  {
    static $sLocale;
    if( is_null( $sLocale ) )
    {
      $sLocale = strstr( $this->amCONFIG['locales'], ',', true );
      if( $sLocale === false ) $sLocale = $this->amCONFIG['locales'];
    }
    return $sLocale;
  }

  /** Retrieve the current locale
   *
   * @return string Locale ID
   */
  public function getCurrentLocale()
  {
    static $sLocale;
    if( is_null( $sLocale ) )
    {
      if( isset( $_SESSION['GEREMO_Locale'] ) )
      {
        $sLocale = $_SESSION['GEREMO_Locale'];
      }
      else
      {
        $sLocale = $this->getDefaultLocale();
      }
    }
    return $sLocale;
  }

  /** Retrieve the resources directory path
   *
   * @return string Directory path
   */
  public function getResourcesDir()
  {
    return $this->amCONFIG['resources_dir'];
  }

  /** Check if dynamic login URL assignement is configured/allowed
   *
   * @return boolean
   */
  public function isDynamicLoginURLAllowed()
  {
    return !empty( $this->amCONFIG['login_url_validation_preg'] );
  }

  /** Retrieve the login URL
   *
   * @return string Login URL
   */
  public function getLoginURL()
  {
    static $sLoginURL;
    if( is_null( $sLoginURL ) )
    {
      if( $this->isDynamicLoginURLAllowed() and isset( $_SESSION['GEREMO_LoginURL'] ) )
      {
        $sLoginURL = $_SESSION['GEREMO_LoginURL'];
      }
      else
      {
        $sLoginURL = $this->amCONFIG['login_url'];
      }
    }
    return $sLoginURL;
  }

  /** Retrieve the reset URL (in case of internal error)
   *
   * @return string Reset URL
   */
  public function getResetURL()
  {
    if( $this->isDynamicLoginURLAllowed() and isset( $_SESSION['GEREMO_LoginURL'] ) )
      return '?login='.urlencode( $_SESSION['GEREMO_LoginURL'] );
    return '?';
  }

  /** Retrieve (localized) text
   *
   * @param string $sTextID Text ID
   * @return string Text
   */
  public function getText( $sTextID )
  {
    static $_TEXT;
    
    // Initialize message array
    if( is_null( $_TEXT ) )
    {
      // Default (English messages)
      $_TEXT = array();
      $_TEXT['title:authentication_required'] = 'Authentication Required';
      $_TEXT['label:language'] = 'Language';
      $_TEXT['label:captcha'] = 'Captcha';
      $_TEXT['label:verification_code'] = 'Verification Code';
      $_TEXT['label:email'] = 'E-Mail';
      $_TEXT['label:username'] = 'Username';
      $_TEXT['label:password'] = 'Password';
      $_TEXT['label:password_confirmation'] = '(confirm)';
      $_TEXT['label:title'] = 'Title';
      $_TEXT['label:firstname'] = 'First Name';
      $_TEXT['label:lastname'] = 'Last Name';
      $_TEXT['label:company'] = 'Company';
      $_TEXT['label:jobtitle'] = 'Job Title';
      $_TEXT['label:street'] = 'Street';
      $_TEXT['label:street2'] = 'Street (+)';
      $_TEXT['label:pobox'] = 'P.O.Box';
      $_TEXT['label:city'] = 'City';
      $_TEXT['label:zipcode'] = 'Zip Code';
      $_TEXT['label:state'] = 'State';
      $_TEXT['label:country'] = 'Country';
      $_TEXT['label:phone'] = 'Phone';
      $_TEXT['label:fax'] = 'Fax';
      $_TEXT['label:submit'] = 'Submit';
      $_TEXT['error:internal_error'] = 'Internal error. Please contact the system administrator.';
      $_TEXT['error:invalid_login_url'] = 'Invalid login URL. Please contact the system administrator.';
      $_TEXT['error:invalid_form_data'] = 'Invalid form data. Please contact the system administrator.';
      $_TEXT['error:unsecure_channel'] = 'Unsecure channel. Please use an encrypted channel (SSL).';
      $_TEXT['error:invalid_session_state'] = 'Invalid session.';
      $_TEXT['error:invalid_email'] = 'Invalid e-mail address.';
      $_TEXT['error:invalid_email_whitelist'] = 'Your e-mail address has not been whitelisted.';
      $_TEXT['error:invalid_email_blacklist'] = 'Your e-mail address has been blacklisted.';
      $_TEXT['error:invalid_captcha'] = 'Invalid captcha.';
      $_TEXT['error:invalid_verification_code'] = 'Invalid (or expired) verification code.';
      $_TEXT['error:password_mismatch'] = 'Password confirmation mismatch.';
      $_TEXT['error:password_minlength'] = 'Password too short. Please choose a longer password.';
      $_TEXT['error:password_maxlength'] = 'Password too long. Please choose a shorter password.';
      $_TEXT['error:password_complexity'] = 'Weak password. Please choose a stronger password.';
      $_TEXT['error:missing_required_field'] = 'Please fill-in the missing required field.';

      // Include localized messages
      $sLocale = $this->getCurrentLocale();
      if( $sLocale != 'en' )
        include_once $this->amCONFIG['resources_dir'].'/'.$sLocale.'/text.php';
    }

    // Done
    return $_TEXT[$sTextID];
  }

  /** Compute the complexity of the given password
   *
   * @param string $sPassword Password
   * @return int Complexity
   */
  private static function getPasswordComplexity( $sPassword )
  {
    $iComplexity = 0;
    $sPassword = preg_replace( '/[a-z]/', '', $sPassword, -1, $iCount ); if( $iCount > 0 ) $iComplexity++;
    $sPassword = preg_replace( '/[A-Z]/', '', $sPassword, -1, $iCount ); if( $iCount > 0 ) $iComplexity++;
    $sPassword = preg_replace( '/[0-9]/', '', $sPassword, -1, $iCount ); if( $iCount > 0 ) $iComplexity++;
    $sPassword = preg_replace( '/[-_.,:;!?]/', '', $sPassword, -1, $iCount ); if( $iCount > 0 ) $iComplexity++;
    if( strlen( $sPassword ) > 0 ) $iComplexity++;
    return $iComplexity;
  }


  /*
   * METHODS: HTML
   ********************************************************************************/

  /** HTML page controller (Model/View Controller)
   *
   * <P><B>SYNOPSIS:</B> This function invokes the controller implementing the logic
   * for the registration process and returns the HTML view that must displayed as
   * result. See the sample <SAMP>index.php</SAMP> file for usage example.</P>
   *
   * @return string View ID (to display)
   */
  public function controlPage()
  {
    // Controller
    $sError = null;
    $sView = 'error';
    $amFormData = array();
    $bSessionBailOut = true;
    $sAction = isset( $_POST['do'] ) ? $_POST['do'] : ( isset( $_GET['do'] ) ? $_GET['do'] : null );
    try
    {
      // Check encryption
      if( $this->amCONFIG['force_ssl'] and !isset( $_SERVER['HTTPS'] ) )
      {
        throw new Exception( $this->getText( 'error:unsecure_channel' ) );
      }

      // State tracker
      // We check the correct flow of the registration process in order to prevent
      // any unforeseen effects/vulnerabilities based on its violation.
      switch( $sAction )
      {
      case 'request':
      case 'email':
        // View (default)
        $sView = 'request';

        // Check state
        if( !isset( $_SESSION['GEREMO_State'] ) or $_SESSION['GEREMO_State'] != 'request' ) // Invalid state
        {
          trigger_error( '['.__METHOD__.'] Invalid session state; IP='.( isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'unknown' ), E_USER_WARNING );
          throw new Exception( $this->getText( 'error:invalid_session_state' ) );
        }
        break;

      case 'verify':
      case 'register':
        // View (default)
        $sView = 'register';

        // Check state
        if( !isset( $_SESSION['GEREMO_State'] ) or $_SESSION['GEREMO_State'] != 'register' ) // Invalid state
        {
          trigger_error( '['.__METHOD__.'] Invalid session state; IP='.( isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'unknown' ), E_USER_WARNING );
          throw new Exception( $this->getText( 'error:invalid_session_state' ) );
        }
        break;

      case 'confirm':
        // View (default)
        $sView = 'confirm';

        // Check state
        if( !isset( $_SESSION['GEREMO_State'] ) or $_SESSION['GEREMO_State'] != 'confirm' ) // Invalid state
        {
          trigger_error( '['.__METHOD__.'] Invalid session state; IP='.( isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'unknown' ), E_USER_WARNING );
          throw new Exception( $this->getText( 'error:invalid_session_state' ) );
        }
        break;

      default:
        // Check state
        if( !isset( $_SESSION['GEREMO_State'] ) or $_SESSION['GEREMO_State'] != 'request' ) // Unexpected state
        {
          if( !isset( $_SESSION['GEREMO_State'] ) or $_SESSION['GEREMO_State'] == 'confirm' ) // Valid state transition
          {
            $_SESSION['GEREMO_State'] = 'request';
          }
          else // Invalid state
          {
            // Weird... but OK, let's allow it and re-initialize the state tracker
            $this->resetSession();
          }
        }
        $_SESSION['GEREMO_State'] = 'request';

        // View
        $sView = 'default';
      }

      // Get keys
      $amKeys = $this->getKeys();
      $iKeySlot = date( 'G' );

      // Form submission handling
      switch( $sAction )
      {

      case 'locale':
        // Retrieve form variables
        if( !isset( $_POST['locale'] ) or !is_scalar( $_POST['locale'] ) )
        {
          trigger_error( '['.__METHOD__.'] Invalid form data (locale); IP='.( isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'unknown' ), E_USER_WARNING );
          throw new Exception( $this->getText( 'error:invalid_form_data' ) );
        }
        $sLocale = trim( $_POST['locale'] );

        // Check and set locale
        if( !in_array( $sLocale, $this->getSupportedLocales() ) )
        {
          trigger_error( '['.__METHOD__.'] Invalid locale; IP='.( isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'unknown' ), E_USER_WARNING );
          throw new Exception( $this->getText( 'error:invalid_form_data' ) );
        }
        $_SESSION['GEREMO_Locale'] = $sLocale;
        break;
        
      case 'email':
        // Retrieve arguments
        if( !isset( $_POST['email'], $_POST['captcha'] )
            or !is_scalar( $_POST['email'] ) or !is_scalar( $_POST['captcha'] )
            or strlen( $_POST['email'] ) > $this->amCONFIG['data_maxlength_email'] )
        {
          trigger_error( '['.__METHOD__.'] Invalid form data (email); IP='.( isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'unknown' ), E_USER_WARNING );
          throw new Exception( $this->getText( 'error:invalid_form_data' ) );
        }
        $amFormData['email'] = strtolower( trim( $_POST['email'] ) );
        $sCaptcha = trim( $_POST['captcha'] );

        // Check e-mail address
        if( !preg_match( '/^(\w+[-_.])*\w+@(\w+[-_.])*\w+\.\w+$/AD', $amFormData['email'] ) )
        {
          $bSessionBailOut = false;
          throw new Exception( $this->getText( 'error:invalid_email' )."\n[".$this->getText( 'label:email' ).']' );
        }
        if( !empty( $this->amCONFIG['data_email_whitelist'] ) and !preg_match( $this->amCONFIG['data_email_whitelist'], $amFormData['email'] ) )
        {
          $bSessionBailOut = false;
          throw new Exception( $this->getText( 'error:invalid_email_whitelist' )."\n[".$this->getText( 'label:email' ).']' );
        }
        if( !empty( $this->amCONFIG['data_email_blacklist'] ) and preg_match( $this->amCONFIG['data_email_blacklist'], $amFormData['email'] ) )
        {
          $bSessionBailOut = false;
          throw new Exception( $this->getText( 'error:invalid_email_blacklist' )."\n[".$this->getText( 'label:email' ).']' );
        }

        // Check captcha
        if( strlen( $sCaptcha ) == 0 )
        {
          $bSessionBailOut = false;
          throw new Exception();
        }
        if( !isset( $_SESSION['GEREMO_Captcha'] ) or
            strlen( $sCaptcha ) <= 0 or strlen( $_SESSION['GEREMO_Captcha'] ) <= 0 or
            $sCaptcha != $_SESSION['GEREMO_Captcha'] )
        {
          $bSessionBailOut = false;
          throw new Exception( $this->getText( 'error:invalid_captcha' )."\n[".$this->getText( 'label:captcha' ).']' );
        }
        unset( $_SESSION['GEREMO_Captcha'] );

        // Build verification code
        $sVerificationCode = substr( base64_encode( mhash( MHASH_SHA1, session_id().':'.$amFormData['email'], $amKeys[$iKeySlot] ) ), 0, 20 );
        $amFormData['verification_slot'] = $iKeySlot;

        // Send registration e-mail
        $sTemplate = file_get_contents( $this->amCONFIG['resources_dir'].'/'.$this->getCurrentLocale().'/verification_code.email.tpl' );
        if( $sTemplate === false )
        {
          trigger_error( '['.__METHOD__.'] Failed to load e-mail template', E_USER_WARNING );
          throw new Exception( $this->getText( 'error:internal_error' ) );
        }
        $this->sendMail( $sTemplate, $this->amCONFIG['email_sender_address'], $amFormData['email'], array( 'verification_code' => $sVerificationCode ) );
        unset( $sVerificationCode );

        // Update state
        $_SESSION['GEREMO_State'] = 'register';

        // View
        $sView = 'register';
        break;

      case 'register':
        // Retrieve arguments
        if( !isset( $_POST['verification_slot'], $_POST['verification_code'], $_POST['email'], $_POST['password'], $_POST['password_confirm'] )
            or !is_scalar( $_POST['verification_slot'] ) or !is_scalar( $_POST['verification_code'] )
            or !is_scalar( $_POST['email'] ) or !is_scalar( $_POST['password'] ) or !is_scalar( $_POST['password_confirm'] )
            or strlen( $_POST['email'] ) > $this->amCONFIG['data_maxlength_email']
            or strlen( $_POST['password'] ) > 1000 or strlen( $_POST['password_confirm'] ) > 1000 )
        {
          trigger_error( '['.__METHOD__.'] Invalid form data (register:arguments); IP='.( isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'unknown' ), E_USER_WARNING );
          throw new Exception( $this->getText( 'error:invalid_form_data' ) );
        }
        $amFormData['verification_code'] = trim( $_POST['verification_code'] );
        $amFormData['verification_slot'] = (integer)$_POST['verification_slot'];
        $amFormData['email'] = trim( $_POST['email'] );
        $sPassword = $_POST['password'];
        $sPassword_confirm = $_POST['password_confirm'];

        // Retrieve optional fields
        foreach( array( 'title', 'firstname', 'lastname', 'company', 'jobtitle', 'street', 'street2', 'pobox', 'city', 'zipcode', 'state', 'country', 'phone', 'fax' ) as $sID )
        {
          if( $this->amCONFIG['data_include_'.$sID] )
          {
            if( !isset( $_POST[$sID] )
                or !is_scalar( $_POST[$sID] )
                or strlen( $_POST[$sID] ) > $this->amCONFIG['data_maxlength_'.$sID] )
            {
              trigger_error( '['.__METHOD__.'] Invalid form data (register:fields); IP='.( isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'unknown' ), E_USER_WARNING );
              throw new Exception( $this->getText( 'error:invalid_form_data' ) );
            }
            $amFormData[$sID] = trim( $_POST[$sID] );
          }
        }

        // Check verification code
        if( $amFormData['verification_code'] != substr( base64_encode( mhash( MHASH_SHA1, session_id().':'.$amFormData['email'], $amKeys[$amFormData['verification_slot']] ) ), 0, 20 ) )
        {
          $bSessionBailOut = false;
          throw new Exception( $this->getText( 'error:invalid_verification_code' )."\n[".$this->getText( 'label:email' ).']' );
        }

        // Check required fields
        foreach( array( 'title', 'firstname', 'lastname', 'company', 'jobtitle', 'street', 'street2', 'pobox', 'city', 'zipcode', 'state', 'country', 'phone', 'fax' ) as $sID )
        {
          if( $this->amCONFIG['data_include_'.$sID] > 1 and empty( $amFormData[$sID] ) )
          {
            $bSessionBailOut = false;
            throw new Exception( $this->getText( 'error:missing_required_field' )."\n[".$this->getText( 'label:'.$sID ).']' );
          }
        }
        $amFormData = array_merge( array_fill_keys( array( 'title', 'firstname', 'lastname', 'company', 'jobtitle', 'street', 'street2', 'pobox', 'city', 'zipcode', 'state', 'country', 'phone', 'fax' ), 'n/a' ), $amFormData );

        // Check password
        if( $sPassword != $sPassword_confirm )
        {
          $bSessionBailOut = false;
          throw new Exception( $this->getText( 'error:password_mismatch' )."\n[".$this->getText( 'label:password' ).']' );
        }
        if( strlen( $sPassword ) < $this->amCONFIG['data_password_minlength'] )
        {
          $bSessionBailOut = false;
          throw new Exception( $this->getText( 'error:password_minlength' )."\n[".$this->getText( 'label:password' ).', L>='.$this->amCONFIG['data_password_minlength'].']' );
        }
        if( strlen( $sPassword ) > $this->amCONFIG['data_password_maxlength'] )
        {
          $bSessionBailOut = false;
          throw new Exception( $this->getText( 'error:password_maxlength' )."\n[".$this->getText( 'label:password' ).', L<='.$this->amCONFIG['data_password_maxlength'].']' );
        }
        if( self::getPasswordComplexity( $sPassword ) < $this->amCONFIG['data_password_complexity'] )
        {
          $bSessionBailOut = false;
          throw new Exception( $this->getText( 'error:password_complexity' )."\n[".$this->getText( 'label:password' ).', C>='.$this->amCONFIG['data_password_complexity'].']' );
        }

        // Create/update account
        switch( $this->amCONFIG['backend'] )
        {
        case 'htpasswd-noexec':
          $this->registerHtpasswdNoExec( $amFormData['email'], $sPassword );
          break;
        case 'htpasswd':
          $this->registerHtpasswd( $amFormData['email'], $sPassword );
          break;
        case 'sql':
          $this->registerSql( $amFormData['email'], $sPassword, $amFormData );
          break;
        default:
          trigger_error( '['.__METHOD__.'] Unsupported authentication backend', E_USER_WARNING );
          throw new Exception( $this->getText( 'error:internal_error' ) );
        }

        // Send registration notice e-mail
        if( !empty( $this->amCONFIG['email_registration_notice_address'] ) )
        {
          $sTemplate = file_get_contents( $this->amCONFIG['resources_dir'].'/'.$this->getDefaultLocale().'/registration_notice.email.tpl' );
          if( $sTemplate === false )
          {
            trigger_error( '['.__METHOD__.'] Failed to load e-mail template', E_USER_WARNING );
            throw new Exception( $this->getText( 'error:internal_error' ) );
          }
          $this->sendMail( $sTemplate, $this->amCONFIG['email_sender_address'], $this->amCONFIG['email_registration_notice_address'], array_merge( $amFormData, array( 'locale' => $this->getCurrentLocale() ) ) );
        }

        // Clear session (prevent replay of current session)
        session_regenerate_id( true );

        // Update state
        $_SESSION['GEREMO_State'] = 'confirm';

        // View
        $sView = 'confirm';
        break;

      default:
        // Login URL
        if( $this->isDynamicLoginURLAllowed() )
        {
          if( isset( $_GET['login'] ) )
          {
            $sLoginURL = trim( $_GET['login'] );
            if( !empty( $sLoginURL ) )
            {
              if( !preg_match( '/^https?:\/\/(\w+[-_.])*\w+\.\w+/AD', $sLoginURL ) or !preg_match( '/'.$this->amCONFIG['login_url_validation_preg'].'/AD', $sLoginURL ) )
              {
                trigger_error( '['.__METHOD__.'] Invalid login URL (validation); IP='.( isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'unknown' ), E_USER_WARNING );
                throw new Exception( $this->getText( 'error:invalid_login_url' ) );
              }
              $_SESSION['GEREMO_LoginURL'] = $sLoginURL;
            }
            else
              unset( $_SESSION['GEREMO_LoginURL'] );
          }
        }
        else
        {
          unset( $_SESSION['GEREMO_LoginURL'] );
          if( isset( $_GET['login'] ) )
          {
            trigger_error( '['.__METHOD__.'] Invalid login URL (dynamic assignement is not allowed); IP='.( isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'unknown' ), E_USER_WARNING );
            throw new Exception( $this->getText( 'error:internal_error' ) );
          }
        }


      }

    }
    catch( Exception $e )
    {
      // Save the error message
      $sError = $e->getMessage();

      // Session clean-up
      if( $bSessionBailOut ) // Critical error
      {
        // Reset session
        $this->resetSession();

        // View
        $sView = 'error';
      }
      else // Recoverable error
      {
        // Just clean-up lingering variables
        unset( $_SESSION['GEREMO_Captcha'] );
      }
    }

    // Save form data
    $this->amFORMDATA = array_merge( array( 'VIEW' => $sView, 'ERROR' => $sError ), $amFormData );

    // Done
    return $this->amFORMDATA['VIEW'];
  }

  /** Retrieve data (variable value) from the controller
   *
   * @param string $sID Data (variable) ID
   * @return mixed Data (variable) value
   */
  public function getFormData( $sID )
  {
    return $this->amFORMDATA[ $sID ];
  }

  /** Retrieve the form's HTML code from the controller (for the given view)
   *
   * @param string $sID Form ID
   * @return string Form's HTML code
   */
  public function getFormHtml( $sID )
  {
    // Build form
    $sHTML = '';
    switch( $sID )
    {

    case 'locale':
      $sCurrentLocale = $this->getCurrentLocale();
      $sHTML .= '<FORM METHOD="post" ACTION="'.$_SERVER['SCRIPT_NAME'].'">';
      $sHTML .= '<INPUT TYPE="hidden" NAME="do" VALUE="locale" />';
      $sHTML .= '<TABLE CELLSPACING="0"><TR>';
      $sHTML .= '<TD CLASS="label">'.htmlentities( $this->getText( 'label:language' ) ).':</TD>';
      $sHTML .= '<TD CLASS="input"><SELECT NAME="locale" ONCHANGE="javascript:submit();">';
      foreach( $this->getSupportedLocales() as $sLocale )
      {
        $sHTML .= '<OPTION VALUE="'.$sLocale.'"'.( $sLocale == $sCurrentLocale ? ' SELECTED' : null ).'>'.$sLocale.'</OPTION>';
      }
      $sHTML .= '</SELECT></TD>';
      $sHTML .= '</TR></TABLE>';
      $sHTML .= '</FORM>';
      break;

    case 'request':
      $sHTML .= '<FORM METHOD="post" ACTION="'.$_SERVER['SCRIPT_NAME'].'">';
      $sHTML .= '<INPUT TYPE="hidden" NAME="do" VALUE="email" />';
      $sHTML .= '<TABLE CELLSPACING="0">';
      $sHTML .= '<TR><TD CLASS="label">'.htmlentities( $this->getText( 'label:email' ) ).':</TD><TD CLASS="input"><SPAN CLASS="required"><INPUT TYPE="text" NAME="email" VALUE="'.htmlentities( $this->getFormData( 'email' ) ).'" MAXLENGTH="'.$this->amCONFIG['data_maxlength_email'].'" TABINDEX="1" /></SPAN></TD><TD CLASS="note"><SPAN CLASS="required">*</SPAN></TD></TR>';
      $sHTML .= '<TR><TD CLASS="label">'.htmlentities( $this->getText( 'label:captcha' ) ).':</TD><TD CLASS="input"><SPAN CLASS="required"><INPUT TYPE="text" NAME="captcha" TABINDEX="2" /></SPAN></TD><TD CLASS="note"><SPAN CLASS="required">*</SPAN></TD></TR>';
      $sHTML .= '<TR><TD CLASS="label">&nbsp;</TD><TD CLASS="input"><IMG ALT="Captcha" SRC="?do=captcha" WIDTH="'.$this->amCONFIG['captcha_width'].'" HEIGHT="'.$this->amCONFIG['captcha_height'].'" /></TD><TD CLASS="note">&nbsp;</TD></TR>';
      $sHTML .= '<TR><TD CLASS="button" COLSPAN="3"><BUTTON TYPE="submit" TABINDEX="3" >'.htmlentities( $this->getText( 'label:submit' ) ).'</BUTTON></TD></TR>';
      $sHTML .= '</TABLE>';
      $sHTML .= '</FORM>';
      break;

    case 'register':
      $sHTML .= '<FORM METHOD="post" ACTION="'.$_SERVER['SCRIPT_NAME'].'">';
      $sHTML .= '<INPUT TYPE="hidden" NAME="do" VALUE="register" />';
      $sHTML .= '<INPUT TYPE="hidden" NAME="verification_slot" VALUE="'.htmlentities( $this->getFormData( 'verification_slot' ) ).'" />';
      $sHTML .= '<TABLE CELLSPACING="0">';
      $sHTML .= '<TR><TD CLASS="label">'.htmlentities( $this->getText( 'label:email' ) ).' ('.htmlentities( $this->getText( 'label:username' ) ).'):</TD><TD CLASS="input"><SPAN CLASS="readonly"><INPUT TYPE="text" NAME="email" VALUE="'.htmlentities( $this->getFormData( 'email' ) ).'" READONLY="1" /></SPAN></TD><TD CLASS="note">&nbsp;</TD></TR>';
      $sHTML .= '<TR><TD CLASS="label">'.htmlentities( $this->getText( 'label:verification_code' ) ).':</TD><TD CLASS="input"><SPAN CLASS="required"><INPUT TYPE="text" NAME="verification_code" VALUE="'.htmlentities( $this->getFormData( 'verification_code' ) ).'" MAXLENGTH="20" TABINDEX="1" /></SPAN></TD><TD CLASS="note"><SPAN CLASS="required">*</SPAN></TD></TR>';
      $iTabIndex = 2;
      foreach( array( 'title', 'firstname', 'lastname', 'company', 'jobtitle', 'street', 'street2', 'pobox', 'city', 'zipcode', 'state', 'country', 'phone', 'fax' ) as $sID )
      {
        if( $this->amCONFIG['data_include_'.$sID] )
        {
          $bRequired = ( $this->amCONFIG['data_include_'.$sID] > 1 );
          $sHTML .= '<TR><TD CLASS="label">'.htmlentities( $this->getText( 'label:'.$sID ) ).':</TD><TD CLASS="input">'.( $bRequired ? '<SPAN CLASS="required">' : null ).'<INPUT TYPE="text" NAME="'.$sID.'" VALUE="'.htmlentities( $this->getFormData( $sID ) ).'" MAXLENGTH="'.$this->amCONFIG['data_maxlength_'.$sID].'" TABINDEX="'.$iTabIndex++.'" />'.( $bRequired ? '</SPAN>' : null ).'</TD><TD CLASS="note">'.( $bRequired ? '<SPAN CLASS="required">*</SPAN>' : '&nbsp;' ).'</TD></TR>';
        }
      }
      // Note: we do not enforce password maximum length during input,
      // for it would be confusing given the obfuscated data.
      $sHTML .= '<TR><TD CLASS="label">'.htmlentities( $this->getText( 'label:password' ) ).':</TD><TD CLASS="input"><SPAN CLASS="required"><INPUT TYPE="password" NAME="password" TABINDEX="'.$iTabIndex++.'" /></SPAN></TD><TD CLASS="note"><SPAN CLASS="required">*</SPAN></TD></TR>';
      $sHTML .= '<TR><TD CLASS="label">'.htmlentities( $this->getText( 'label:password_confirmation' ) ).':</TD><TD CLASS="input"><SPAN CLASS="required"><INPUT TYPE="password" NAME="password_confirm" TABINDEX="'.$iTabIndex++.'" /></SPAN></TD><TD CLASS="note"><SPAN CLASS="required">*</SPAN></TD></TR>';
      $sHTML .= '<TR><TD CLASS="button" COLSPAN="3"><BUTTON TYPE="submit" TABINDEX="'.$iTabIndex.'">'.htmlentities( $this->getText( 'label:submit' ) ).'</BUTTON></TD></TR>';
      $sHTML .= '</TABLE>';
      $sHTML .= '</FORM>';
      break;

    }

    // Done
    return $sHTML;
  }

  /** Reset session
   *
   *  Clear the current session and regenerate a new session ID.
   *  This invalidates any verification code that might have been
   *  given in the previous session.
   */
  private function resetSession()
  {
    // Save session locale and login URL
    $sLocale = $this->getCurrentLocale();
    $sLoginURL = ( $this->isDynamicLoginURLAllowed() and isset( $_SESSION['GEREMO_LoginURL'] ) ) ? $_SESSION['GEREMO_LoginURL'] : null;

    // Clear session and start a new one.
    session_regenerate_id( true );

    // Restore session locale and login URL
    $_SESSION['GEREMO_Locale'] = $sLocale;
    if( !is_null( $sLoginURL ) )
      $_SESSION['GEREMO_LoginURL'] = $sLoginURL;
  }


  /*
   * METHODS: Captcha
   ********************************************************************************/

  /** Generate a random color code (in <SAMP>#FFFFFF</SAMP> format)
   */
  private static function getRandomColor()
  {
    $sOutput='#';
    for( $i=1; $i<=6; $i++) $sOutput .= dechex( rand( 0, 15 ) );
    return $sOutput;
  }

  /** Generate and display a Captcha image
   *
   * <P><B>SYNOPSIS:</B> This function generates a Captcha image, in PNG format
   * and sends its raw content as output (cf. <SAMP>readfile</SAMP>. See the
   * sample <SAMP>index.php</SAMP> file for usage example.</P>
   */
  public function rawCaptcha()
  {
    // Load PEAR::Text_CAPTCHA extension
    require_once 'Text/CAPTCHA.php';

    try
    {
      // Create CAPTCHA
      // ... create Captcha object
      $oCaptcha = Text_CAPTCHA::factory( 'Image' );
      $sFontFile = $this->getResourcesDir().'/captcha.ttf';
      $oReturn = $oCaptcha->init( array(
                                        'width' => $this->amCONFIG['captcha_width'], 'height' => $this->amCONFIG['captcha_height'], 'output' => 'png',
                                        'imageOptions' => array(
                                                                'font_size' => $this->amCONFIG['captcha_font_size'],
                                                                'font_path' => dirname( $sFontFile ),
                                                                'font_file' => basename( $sFontFile ),
                                                                'text_color' => self::getRandomColor(),
                                                                'lines_color' => self::getRandomColor(),
                                                                'background_color' => self::getRandomColor()
                                                                )
                                        ) );
      if( PEAR::isError( $oReturn ) )
      {
        trigger_error( '['.__METHOD__.'] Failed to instantiate captcha object; '.$oReturn->getMessage(), E_USER_WARNING );
        throw new Exception( $this->getText( 'error:internal_error' ) );
      }
      // ... save the Captcha secret phrase
      $_SESSION['GEREMO_Captcha'] = $oCaptcha->getPhrase();

      // Send Captcha image (as PNG)
      // ... create image object
      $oImage = $oCaptcha->getCAPTCHAAsPNG();
      if( PEAR::isError( $oImage ) )
      {
        trigger_error( '['.__METHOD__.'] Failed to generate captcha image; '.$oImage->getMessage(), E_USER_WARNING );
        throw new Exception( $this->getText( 'error:internal_error' ) );
      }
      // ... save image to (temporary) file (Note: only way to send the image in a binary-safe way)
      $sImagePath = $this->amCONFIG['data_dir'].'/captcha.'.session_id().'.png';
      file_put_contents( $sImagePath, $oImage );
      // ... send HTTP headers and content
      header( 'Content-Type: image/png' );
      header( 'Content-Length: '.filesize( $sImagePath ) );
      header( 'Expires: 0' );
      header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
      header( 'Pragma: public' );
      readfile( $sImagePath );
      // ... delete the image file
      unlink( $sImagePath );
    }
    catch( Exception $e )
    {
      echo $e->getMessage();
    }
  }


  /*
   * METHODS: E-Mail
   ********************************************************************************/

  /** Parses and returns the components of the supplied e-mail template
   *
   * <P><B>SYNOPSIS:</B> This function takes an e-mail template as argument, similar
   * to example below (extra white-spaces are automatically stripped off):</P>
   * <PRE>
   * #{SUBJECT}
   * Subject line (including variable: name => @{name})
   *
   * #{TEXT}
   * Text-formatted message body (including variable: name => @{name})
   *
   * #{HTML}
   * <P>HTML-formatted message body (including variable: name => @{name})</P>
   * </PRE>
   * <P><B>RETURNS:</B> An array associating:</P>
   * <UL>
   * <LI><SAMP>subject</SAMP> => subject line (<SAMP>null</SAMP> if none), including variables substitutions</LI>
   * <LI><SAMP>text</SAMP> => text-formatted message body (<SAMP>null</SAMP> if none), including variables substitutions</LI>
   * <LI><SAMP>html</SAMP> => HTML-formatted message body (<SAMP>null</SAMP> if none), including variables substitutions</LI>
   * </UL>
   *
   * @param string $sTemplate E-mail template
   * @param array|string $asVariables Substitution variables (associating <SAMP>name</SAMP> => <SAMP>value</SAMP>)
   * @return array|string
   */
  private static function parseMailTemplate( $sTemplate, $asVariables = null )
  {
    // Sanitize input
    if( !is_array( $asVariables ) )
      $asVariables = array();

    // Output
    $asOutput = array( 'subject' => null, 'text' => null, 'html' => null );
    
    // ... search patterns
    $asSearch = array_keys( $asVariables );
    foreach( $asSearch as &$roSearch ) $roSearch = '@{'.$roSearch.'}';

    // ... split content
    $iPosition_subject = stripos( $sTemplate, '#{subject}' );
    $iPosition_text = stripos( $sTemplate, '#{text}' );
    $iPosition_html = stripos( $sTemplate, '#{html}' );

    // ... subject
    if( $iPosition_subject !== false )
    {
      $iPosition_subject += 10;
      $iPosition_end = strlen( $sTemplate );
      if( $iPosition_text !== false and $iPosition_text > $iPosition_subject and $iPosition_text < $iPosition_end )
        $iPosition_end = $iPosition_text;
      if( $iPosition_html !== false and $iPosition_html > $iPosition_subject and $iPosition_html < $iPosition_end )
        $iPosition_end = $iPosition_html;
      $asOutput['subject'] = str_ireplace( $asSearch, $asVariables, trim( substr( $sTemplate, $iPosition_subject, $iPosition_end - $iPosition_subject ) ) );
      
    }

    // ... body
    if( $iPosition_text !== false )
    {
      $iPosition_text += 7;
      $iPosition_end = strlen( $sTemplate );
      if( $iPosition_text !== false and $iPosition_text > $iPosition_text and $iPosition_text < $iPosition_end )
        $iPosition_end = $iPosition_text;
      if( $iPosition_html !== false and $iPosition_html > $iPosition_text and $iPosition_html < $iPosition_end )
        $iPosition_end = $iPosition_html;
      $asOutput['text'] = str_ireplace( $asSearch, $asVariables, trim( substr( $sTemplate, $iPosition_text, $iPosition_end - $iPosition_text ) ) );
    }

    // ... body (HTML)
    if( $iPosition_html !== false )
    {
      $iPosition_html += 7;
      $iPosition_end = strlen( $sTemplate );
      if( $iPosition_subject !== false and $iPosition_subject > $iPosition_html and $iPosition_subject < $iPosition_end )
        $iPosition_end = $iPosition_subject;
      if( $iPosition_text !== false and $iPosition_text > $iPosition_html and $iPosition_text < $iPosition_end )
        $iPosition_end = $iPosition_text;
      $asOutput['html'] = str_ireplace( $asSearch, array_map( 'htmlentities', $asVariables ), trim( substr( $sTemplate, $iPosition_html, $iPosition_end - $iPosition_html ) ) );
    }

    // End
    return $asOutput;

  }

  /** Send e-mail message
   *
   * @param string $sTemplate E-mail template (see the <SAMP>parseMailTemplate</SAMP> function for further details)
   * @param string $sSender Sender's e-mail address (WARNING: make sure <SAMP>sendmail</SAMP> allows it to be overriden)
   * @param string $sRecipients Recipient(s) e-mail addresses (whitespace, comma, semi-colon or colon separated)
   * @param array|string $asVariables Substitution variables (associating <SAMP>name</SAMP> => <SAMP>value</SAMP>)
   * @param array|string $asHeaders Additional MIME headers (associating <SAMP>name</SAMP> => <SAMP>value</SAMP>)
   */
  private function sendMail( $sTemplate, $sSender, $sRecipients, $asVariables = null, $asHeaders = null )
  {
    // Load PEAR::Mail and PEAR::Mail_Mime extensions
    require_once 'Mail.php';
    require_once 'Mail/mime.php';

    // Instantiate e-mail object
    $oMIME = new Mail_mime( "\n" );
    if( PEAR::isError( $oMIME ) )
    {
      trigger_error( '['.__METHOD__.'] Failed to instantiate MIME object; '.$oMIME->getMessage(), E_USER_WARNING );
      throw new Exception( $this->getText( 'error:internal_error' ) );
    }

    // Parse e-mail template
    $sSubject = null;
    $asMailParts = self::parseMailTemplate( $sTemplate, $asVariables );
    if( isset( $asMailParts['subject'] ) )
      $sSubject = $asMailParts['subject'];
    if( isset( $asMailParts['text'] ) )
      $oMIME->setTXTBody( $asMailParts['text'] );
    if( isset( $asMailParts['html'] ) )
      $oMIME->setHTMLBody( $asMailParts['html'] );
    unset( $asMailParts );

    // Mail components
    // ... body
    $sBody = $oMIME->get();
    // ... headers
    if( !is_array( $asHeaders ) ) $asHeaders = array();
    if( !empty( $sSender ) ) $asHeaders['From'] = $sSender;
    if( !empty( $sSubject ) ) $asHeaders['Subject'] = $sSubject;
    if( empty( $asHeaders ) ) $asHeaders = null;
    $sHeaders = $oMIME->headers( $asHeaders );

    // Send
    $oMail = Mail::factory( 'mail' );
    if( PEAR::isError( $oMail ) )
    {
      trigger_error( '['.__METHOD__.'] Failed to instantiate mail object; '.$oMail->getMessage(), E_USER_WARNING );
      throw new Exception( $this->getText( 'error:internal_error' ) );
    }
    if( is_array( $sRecipients ) ) $sRecipients = implode( ';', $sRecipients ); // make sure we have a string
    foreach( array_unique( preg_split( '/[ ,;:]+/', $sRecipients ) ) as $sRecipient )
    {
      if( empty( $sRecipient ) ) continue;
      //trigger_error( '['.__METHOD__.'] Sending mail; Recipient: '.$sRecipient, E_USER_NOTICE ); // DEBUG
      $oMail->send( $sRecipient, $sHeaders, $sBody );
    }
  }


  /*
   * METHODS: Registration
   ********************************************************************************/

  /** Register (save/update) user credentials in Apache's htpasswd file (without using 'exec()')
   *
   * @param string $sUsername User (login) name
   * @param string $sPassword Password
   */
  private function registerHtpasswdNoExec( $sUsername, $sPassword )
  {
    // Password hash
    switch( $this->amCONFIG['data_password_hash'] )
    {
    case MHASH_SHA1:
      // Plenty of SSHA htpasswd examples but they must be only for nginx...
      //$mSalt = mcrypt_create_iv( 16, MCRYPT_DEV_URANDOM );
      //$sHash = base64_encode( sha1( $sPassword.$mSalt, true ).$mSalt );
      //$sHash = '{SSHA}'.$sHash;
      $sHash = '{SHA}'.base64_encode( sha1( $sPassword, true ) );
      break;
    default:
      trigger_error( '['.__METHOD__.'] Unsupported password hash function', E_USER_WARNING );
      throw new Exception( $this->getText( 'error:internal_error' ) );
    }

    // Password file
    $sHtpasswdPath = $this->amCONFIG['data_dir'].'/.htpasswd';

    // Execute
    // ... load existing credentials
    $asCredentials = array();
    if( is_readable( $sHtpasswdPath ) )
    {
      $asHtpasswd = file( $sHtpasswdPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
      if( !is_array( $asHtpasswd ) )
      {
        trigger_error( '['.__METHOD__.'] Failed to read htpasswd file', E_USER_WARNING );
        throw new Exception( $this->getText( 'error:internal_error' ) );
      }
      array_walk( $asHtpasswd, function( $mValue, $mKey ) use ( &$asCredentials )
                  {
                    list( $sUsername, $sHash ) = explode( ':', $mValue, 2 );
                    $asCredentials[ $sUsername ] = $sHash;
                  }
                  );
    }
    // ... add/replace new credentials
    $asCredentials[$sUsername] = $sHash;
    // ... save credentials
    ignore_user_abort( true );
    $rHtpasswdFile = fopen( $sHtpasswdPath, 'w' );
    if( $rHtpasswdFile === false )
    {
      ignore_user_abort( false );
      trigger_error( '['.__METHOD__.'] Failed to open htpasswd file for writing', E_USER_WARNING );
      throw new Exception( $this->getText( 'error:internal_error' ) );
    }
    if( flock( $rHtpasswdFile, LOCK_EX ) )
    {
      foreach( $asCredentials as $sUsername => $sHash )
        fputs( $rHtpasswdFile, $sUsername.':'.$sHash."\n" );
      flock( $rHtpasswdFile, LOCK_UN );
    }
    else
    {
      fclose( $rHtpasswdFile );
      ignore_user_abort( false );
      trigger_error( '['.__METHOD__.'] Failed to lock htpasswd file for writing', E_USER_WARNING );
      throw new Exception( $this->getText( 'error:internal_error' ) );
    }
    fclose( $rHtpasswdFile );
    ignore_user_abort( false );
  }

  /** Register (save/update) user credentials in Apache's htpasswd file
   *
   * @param string $sUsername User (login) name
   * @param string $sPassword Password
   */
  private function registerHtpasswd( $sUsername, $sPassword )
  {
    // Use the Apache-provided 'htpasswd' command
    $sCommand = 'htpasswd -b';

    // Password hash function
    switch( $this->amCONFIG['data_password_hash'] )
    {
    case MHASH_MD5:
      $sCommand .= ' -m';
      break;
    case MHASH_SHA1:
      $sCommand .= ' -s';
      break;
    default:
      trigger_error( '['.__METHOD__.'] Unsupported password hash function', E_USER_WARNING );
      throw new Exception( $this->getText( 'error:internal_error' ) );
    }
    
    // Password file
    $sCommand .= ' '.escapeshellarg( $this->amCONFIG['data_dir'].'/.htpasswd' );

    // Username and password
    $sCommand .= ' '.escapeshellarg( $sUsername ).' '.escapeshellarg( $sPassword );

    // Execute
    $riExit = -1; exec( $sCommand, $rsOutput, $riExit );
    if( $riExit != 0 )
    {
      trigger_error( '['.__METHOD__.'] Failed to update htpasswd file; '.$rsOutput, E_USER_WARNING );
      throw new Exception( $this->getText( 'error:internal_error' ) );
    }
  }

  /** Register (save/update) user credentials in SQL database
   *
   * @param string $sUsername User (login) name
   * @param string $sPassword Password
   * @param array|string $asFields Optional fields
   */
  private function registerSql( $sUsername, $sPassword, $asFields )
  {
    // Password hash
    switch( $this->amCONFIG['data_password_hash'] )
    {
    case MHASH_MD5:
      $sPassword = bin2hex( mhash( MHASH_MD5, $sPassword ) );
      break;
    case MHASH_SHA1:
      $sPassword = bin2hex( mhash( MHASH_SHA1, $sPassword ) );
      break;
    default:
      trigger_error( '['.__METHOD__.'] Unsupported password hash function', E_USER_WARNING );
      throw new Exception( $this->getText( 'error:internal_error' ) );
    }

    // Connect
    try
    {
      $oPDO = new PDO( $this->amCONFIG['sql_dsn'], $this->amCONFIG['sql_username'], $this->amCONFIG['sql_password'], $this->amCONFIG['sql_options'] );
      $oPDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
      if( !empty( $this->amCONFIG['sql_prepare'] ) )
      {
        //echo nl2br( var_export( $this->amCONFIG['sql_prepare'], true ) ); // DEBUG
        $oPDO->exec( $this->amCONFIG['sql_prepare'] );
      }
    }
    catch( PDOException $e )
    {
      if( $oPDO instanceof PDO )
      {
        $amErrorInfo = $oPDO->errorInfo();
        trigger_error( '['.__METHOD__.'] Failed to connect to database; '.( is_array( $amErrorInfo ) ? $amErrorInfo[2] : 'no error code/info'), E_USER_WARNING );
      }
      else
      {
        trigger_error( '['.__METHOD__.'] Failed to connect to database; '.$e->getMessage(), E_USER_WARNING );
      }
      throw new Exception( $this->getText( 'error:internal_error' ) );
    }

    // SQL command
    $sSQL = 'SELECT ';
    // ... function
    $sSQL .= $this->amCONFIG['sql_function'].'(';
    // ... credentials
    $sSQL .= $oPDO->quote( $sUsername, PDO::PARAM_STR ).','.$oPDO->quote( $sPassword, PDO::PARAM_STR );
    // ... optional fields
    foreach( array( 'title', 'firstname', 'lastname', 'company', 'jobtitle', 'street', 'street2', 'pobox', 'city', 'zipcode', 'state', 'country', 'phone', 'fax' ) as $sID )
    {
      $sSQL .= ','.$oPDO->quote( $asFields[$sID], PDO::PARAM_STR );
    }
    // ... end
    $sSQL .= ')';
    //echo nl2br( var_export( $sSQL, true ) ); // DEBUG

    // Execute
    try
    {
      // Query
      try
      {
        $oQuery = $oPDO->query( $sSQL );
        $sResult = $oQuery->fetchColumn();
        //echo nl2br( var_export( $sResult, true ) ); // DEBUG
      }
      catch( PDOException $e )
      {
        if( $oQuery instanceof PDOStatement )
        {
          $amErrorInfo = $oQuery->errorInfo();
          trigger_error( '['.__METHOD__.'] Failed to query database; '.( is_array( $amErrorInfo ) ? $amErrorInfo[2] : 'no error code/info'), E_USER_WARNING );
        }
        else
        {
          trigger_error( '['.__METHOD__.'] Failed to query database', E_USER_WARNING );
        }
        throw new Exception( $this->getText( 'error:internal_error' ) );
      }
      $oQuery = null;

      // Check result
      if( (boolean)(integer)$sResult !== true )
      {
        trigger_error( '['.__METHOD__.'] Invalid result from database function', E_USER_WARNING );
        throw new Exception( $this->getText( 'error:internal_error' ) );
      }

    }
    catch( Exception $e )
    {
      $oQuery = null;
      $oPDO = null;
      throw $e;
    }

    // Disconnect
    $oPDO = null;
  }

}
