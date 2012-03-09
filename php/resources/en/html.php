<!-- INDENTING (emacs/vi): -*- mode:html; tab-width:2; c-basic-offset:2; intent-tabs-mode:nil; -*- ex: set tabstop=2 expandtab: -->
<?php
/** PHP Generic Registration Module (PHP-GEREMO)
 *
 * @package    GEREMO
 * @subpackage Resources_EN
 */
$sView = $oGEREMO->getFormData( 'VIEW' );
?>
<H1>Authentication Required</H1>

<?php $sError = $oGEREMO->getFormData( 'ERROR' ); if( strlen( $sError ) > 0 ) { ?>
<DIV CLASS="error">
<H2>Error</H2>
<P STYLE="font-weight:bold;"><?php echo nl2br( htmlentities( $sError ) ); ?></P>
</DIV>
<?php } ?>

<?php if( $sView == 'default' ) { ?>
<H2>Registration Required</H2>
<P>You need to be registered to access this resource.</P>
<H3>Already Registered ?</H3>
<P>Please proceed to <A HREF="<?php echo $oGEREMO->getLoginURL(); ?>">login</A>.</P>
<H3>Not Yet Registered ?</H3>
<P>Please proceed to <A HREF="?do=request">register</A>.</P>
<H3>Password Forgotten ?</H3>
<P>Please proceed to <A HREF="?do=request">register</A>, using your already registered e-mail address (you will then be able to set a new password for your account).</P>
<H3>Switch Language</H3>
<DIV CLASS="form">
<?php echo $oGEREMO->getFormHtml( 'locale' ); ?>
</DIV>

<?php } elseif( $sView == 'request' ) { ?>
<H2>Registration Request</H2>
<P>Please start the registration process by providing your personal e-mail address in the form below. You will then receive an e-mail containing the verification code required to proceed with your registration.</P>
<DIV CLASS="form">
<P>( fields with an <SPAN CLASS="required">*</SPAN> are required )</P>
<?php echo $oGEREMO->getFormHtml( 'request' ); ?>
</DIV>

<?php } elseif( $sView == 'register' ) { ?>
<H2>Registration</H2>
<P>An e-mail has been sent to you with the verification code required to complete your registration. Please fill-in this verification code along with the password you wish to set for your account in the form below.</P>
</P>
<DIV CLASS="form">
<P>( fields with an <SPAN CLASS="required">*</SPAN> are required )</P>
<?php echo $oGEREMO->getFormHtml( 'register' ); ?>
</DIV>
<P><B>WARNING:</B><BR />
The verification code sent to you will be valid only for your current browser session and the next 24 hours. Please make sure to complete your registration as soon as possible, using your current browser session (do not close your browser window in-between).<BR />
Also, please supply a password long and complex enough. Password complexity increases as characters belonging to the following types are used: lowercase letters, uppercase letters, digits, punctuation marks and other characters.</P>

<?php } elseif( $sView == 'confirm' ) { ?>
<H2>Registration Successful</H2>
<P>Your registration has been successfully completed. Please now proceed to <A HREF="<?php echo $oGEREMO->getLoginURL(); ?>">login</A>.</P>

<?php } elseif( $sView == 'error' ) { ?>
<H2>Registration Error</H2>
<P>An error occured during the registration process. Please try to <A HREF="<?php echo $oGEREMO->getResetURL(); ?>">register</A> again.</P>
<?php } ?>
