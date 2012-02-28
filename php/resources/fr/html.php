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
<H2>Enregistrement n�cessaire</H2>
<P>Vous devez �tre enregistr� pour acc�der � cette resource.</P>
<H3>D�j� enregistr� ?</H3>
<P>Poursuivez s'il-vous-pla�t vers le <A HREF="<?php echo $oGEREMO->getLoginURL(); ?>">login</A>.</P>
<H3>Pas encore enregistr� ?</H3>
<P>Veuillez s'il-vous-pla�t vous <A HREF="?do=request">enregistrer</A>.</P>
<H3>Mot de passe oubli� ?</H3>
<P>Veuillez s'il-vous-pla�t vous <A HREF="?do=request">enregistrer</A>, en utilisant votre adresse e-mail d�j� enregistr�e (vous pourrez alors changer le mot de passe associ� � votre compte).</P>
<H3>Changer de langue</H3>
<DIV CLASS="form">
<?php echo $oGEREMO->getFormHtml( 'locale' ); ?>
</DIV>

<?php } elseif( $sView == 'request' ) { ?>
<H2>Demande d'enregistrement</H2>
<P>Veuillez s'il-vous-pla�t d�marrer le processus d'enregistrement en fournissant votre adresse e-mail personnelle dans le formulaire ci-dessous. Vous recevrez alors un message contenant le code de v�rification n�cessaire pour poursuivre votre enregistrement.</P>
<DIV CLASS="form">
<P>( les champs avec un <SPAN CLASS="required">*</SPAN> sont obligatoires )</P>
<?php echo $oGEREMO->getFormHtml( 'request' ); ?>
</DIV>

<?php } elseif( $sView == 'register' ) { ?>
<H2>Enregistrement</H2>
<P>Un message vous a �t� envoy� par e-mail, contenant le code de v�rification n�cessaire pour finaliser votre enregistrement. Veuillez s'il-vous-pla�t fournir ce code de v�rification ainsi que le mot de passe que vous d�sirez associer � votre compte dans le formulaire ci-dessous.</P>
</P>
<DIV CLASS="form">
<P>( les champs avec un <SPAN CLASS="required">*</SPAN> sont obligatoires )</P>
<?php echo $oGEREMO->getFormHtml( 'register' ); ?>
</DIV>
<P><B>ATTENTION:</B><BR />
Le code de v�rification qui vous a �t� envoy� n'est valide que pour votre session de navigation actuelle et maximum 24 heures. Veuillez s'il-vous-pla�t finaliser votre enregistrement d�s que possible, en utilisant votre session de navigation actuelle (ne fermez pas la fen�tre de votre navigateur entre-temps).<BR />
Veillez �galement a fournir un mot de passe suffisament long et complexe. La complexit� du mot de passe augmente en fonction de l'utilisation de caract�res appartenant aux types suivants: minuscules, majuscules, nombres, marques de ponctuation et autre caract�res.</P>

<?php } elseif( $sView == 'confirm' ) { ?>
<H2>Enregistrement r�ussi</H2>
<P>Votre enregistrement a �t� finalis� avec succ�s. Veuillez s'il-vous-pla�t poursuivre vers le <A HREF="<?php echo $oGEREMO->getLoginURL(); ?>">login</A>.</P>

<?php } elseif( $sView == 'error' ) { ?>
<H2>Erreur d'enregistrement</H2>
<P>Une erreur est survenue pendant le processus d'enregistrement. Essayez s'il-vous-pla�t de vous <A HREF="<?php echo $oGEREMO->getResetURL(); ?>">enregistrer</A> � nouveau (et accepter nos excuses pour ce d�sagr�ment).</P>
<?php } ?>
