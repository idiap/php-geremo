<!-- INDENTING (emacs/vi): -*- mode:html; tab-width:2; c-basic-offset:2; intent-tabs-mode:nil; -*- ex: set tabstop=2 expandtab: -->
<?php
/** PHP Generic Registration Module (PHP-GEREMO)
 *
 * @package    GEREMO
 * @subpackage Resources_FR
 */
$sView = $oGEREMO->getFormData( 'VIEW' );
?>
<H1>Authentification requise</H1>

<?php $sError = $oGEREMO->getFormData( 'ERROR' ); if( strlen( $sError ) > 0 ) { ?>
<DIV CLASS="error">
<H2>Erreur</H2>
<P STYLE="font-weight:bold;"><?php echo nl2br( htmlentities( $sError ) ); ?></P>
</DIV>
<?php } ?>

<?php if( $sView == 'default' ) { ?>
<H2>Enregistrement nécessaire</H2>
<P>Vous devez être enregistré pour accéder à cette resource.</P>
<H3>Déjà enregistré ?</H3>
<P>Poursuivez s'il-vous-plaît vers le <A HREF="<?php echo $oGEREMO->getLoginURL(); ?>">login</A>.</P>
<H3>Pas encore enregistré ?</H3>
<P>Veuillez s'il-vous-plaît vous <A HREF="?do=request">enregistrer</A>.</P>
<H3>Mot de passe oublié ?</H3>
<P>Veuillez s'il-vous-plaît vous <A HREF="?do=request">enregistrer</A>, en utilisant votre adresse e-mail déjà enregistrée (vous pourrez alors changer le mot de passe associé à votre compte).</P>
<H3>Changer de langue</H3>
<DIV CLASS="form">
<?php echo $oGEREMO->getFormHtml( 'locale' ); ?>
</DIV>

<?php } elseif( $sView == 'request' ) { ?>
<H2>Demande d'enregistrement</H2>
<P>Veuillez s'il-vous-plaît démarrer le processus d'enregistrement en fournissant votre adresse e-mail personnelle dans le formulaire ci-dessous. Vous recevrez alors un message contenant le code de vérification nécessaire pour poursuivre votre enregistrement.</P>
<DIV CLASS="form">
<P>( les champs avec un <SPAN CLASS="required">*</SPAN> sont obligatoires )</P>
<?php echo $oGEREMO->getFormHtml( 'request' ); ?>
</DIV>

<?php } elseif( $sView == 'register' ) { ?>
<H2>Enregistrement</H2>
<P>Un message vous a été envoyé par e-mail, contenant le code de vérification nécessaire pour finaliser votre enregistrement. Veuillez s'il-vous-plaît fournir ce code de vérification ainsi que le mot de passe que vous désirez associer à votre compte dans le formulaire ci-dessous.</P>
</P>
<DIV CLASS="form">
<P>( les champs avec un <SPAN CLASS="required">*</SPAN> sont obligatoires )</P>
<?php echo $oGEREMO->getFormHtml( 'register' ); ?>
</DIV>
<P><B>ATTENTION:</B><BR />
Le code de vérification qui vous a été envoyé n'est valide que pour votre session de navigation actuelle et maximum 24 heures. Veuillez s'il-vous-plaît finaliser votre enregistrement dès que possible, en utilisant votre session de navigation actuelle (ne fermez pas la fenêtre de votre navigateur entre-temps).<BR />
Veillez également a fournir un mot de passe suffisament long et complexe. La complexité du mot de passe augmente en fonction de l'utilisation de caractères appartenant aux types suivants: minuscules, majuscules, nombres, marques de ponctuation et autre caractères.</P>

<?php } elseif( $sView == 'confirm' ) { ?>
<H2>Enregistrement réussi</H2>
<P>Votre enregistrement a été finalisé avec succès. Veuillez s'il-vous-plaît poursuivre vers le <A HREF="<?php echo $oGEREMO->getLoginURL(); ?>">login</A>.</P>

<?php } elseif( $sView == 'error' ) { ?>
<H2>Erreur d'enregistrement</H2>
<P>Une erreur est survenue pendant le processus d'enregistrement. Essayez s'il-vous-plaît de vous <A HREF="<?php echo $oGEREMO->getResetURL(); ?>">enregistrer</A> à nouveau (et accepter nos excuses pour ce désagrément).</P>
<?php } ?>
