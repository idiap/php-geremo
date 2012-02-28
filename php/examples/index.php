<?php // INDENTING (emacs/vi): -*- mode:html; tab-width:2; c-basic-offset:2; intent-tabs-mode:nil; -*- ex: set tabstop=2 expandtab:
/** PHP Generic Registration Module (PHP-GEREMO)
 *
 * @package    GEREMO
 * @subpackage Examples
 */

// Check configuration path
if( !isset( $_SERVER['PHP_GEREMO_CONFIG'] ) )
{
  trigger_error( 'Missing configuration path. Please set the PHP_GEREMO_CONFIG environment variable.', E_USER_ERROR );
}

// Disable error display (to prevent session data or captcha image corruption)
// WARNING: Allowing errors to be displayed is a security risk!
//          Do not display errors on a production site!
ini_set( 'display_errors', 0 );

// Start session (required)
session_start();

/** Load and instantiate GEREMO resources
 */
require_once 'GEREMO.php';
$oGEREMO = new GEREMO( $_SERVER['PHP_GEREMO_CONFIG'] );

// Captcha (?)
if( isset( $_GET['do'] ) and $_GET['do'] == 'captcha' )
{
  $oGEREMO->rawCaptcha();
  session_write_close();
  exit;
}

// Controller / View
$oGEREMO->controlPage(); // We MUST do this before anything is sent to the browser (cf. HTTP headers)
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=ISO-8859-1" />
<TITLE><?php echo htmlentities( $oGEREMO->getText( 'title:authentication_required' ) ); ?></TITLE>
<STYLE TYPE="text/css">
DIV.GEREMO { WIDTH:500px; MARGIN:auto; FONT:12px sans-serif; BACKGROUND:#FFFFFF; }
DIV.GEREMO DIV.error { WIDTH:400px; MARGIN:auto; PADDING:5px 10px; BORDER:solid 2px #A00000; BACKGROUND:#FFE0E0; COLOR:#800000; }
DIV.GEREMO DIV.error H2 { MARGIN:0px; BACKGROUND:transparent; COLOR:#800000; TEXT-ALIGN:center; }
DIV.GEREMO DIV.error P { MARGIN:0px; BACKGROUND:transparent; COLOR:#800000; TEXT-ALIGN:center; }
DIV.GEREMO DIV.form { WIDTH:400px; MARGIN:auto; TEXT-ALIGN:center; }
DIV.GEREMO DIV.form TABLE { FONT:12px sans-serif; }
DIV.GEREMO DIV.form TD.label { WIDTH:140px; FONT-WEIGHT:bold; }
DIV.GEREMO DIV.form TD.input { WIDTH:240px; TEXT-ALIGN:center; }
DIV.GEREMO DIV.form TD.note { WIDTH:20px; TEXT-ALIGN:center; }
DIV.GEREMO DIV.form TD.button { PADDING-TOP:20px; TEXT-ALIGN:right; }
DIV.GEREMO DIV.form INPUT { WIDTH:240px; BACKGROUND:#FCFCFC; BORDER:solid 1px #A0A0A0; }
DIV.GEREMO DIV.form SPAN.readonly { COLOR:#404040; }
DIV.GEREMO DIV.form SPAN.readonly INPUT { BACKGROUND:#DCDCDC; BORDER:solid 1px #A0A0A0; }
DIV.GEREMO DIV.form SPAN.required { COLOR:#C00000; }
DIV.GEREMO DIV.form SPAN.required INPUT { BACKGROUND:#FFFFF0; BORDER:solid 1px #A08000; }
DIV.GEREMO DIV.form SELECT { WIDTH:240px; }
DIV.GEREMO DIV.form IMG { BORDER:none; }
DIV.GEREMO A { TEXT-DECORATION:none; COLOR:#0086FF; }
DIV.GEREMO A:hover { TEXT-DECORATION:underline; }
</STYLE>
</HEAD>
<BODY>
<DIV CLASS="GEREMO">
<?php
/** Include localized HTML body
 */
require_once$oGEREMO->getResourcesDir().'/'.$oGEREMO->getCurrentLocale().'/html.php';
?>
</DIV>
</BODY>
</HTML>
<?php
// Close session
session_write_close();
