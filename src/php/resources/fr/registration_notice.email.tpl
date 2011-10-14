#{SUBJECT}
Nouvel utilisateur enregistr�

#{TEXT}
Le nouvel(le) utilisateur(trice) suivant(e) a �t� enregistr�(e) avec succ�s:

  E-Mail:       @{email}
  Titre:        @{title}
  Pr�nom:       @{firstname}
  Nom:          @{lastname}
  Entreprise:   @{company}
  Fonction:     @{jobtitle}
  Rue:          @{street}
  Rue (+):      @{street2}
  Case postale: @{pobox}
  Ville:        @{city}
  Code postal:  @{zipcode}
  R�gion:       @{state}
  Pays:         @{country}
  T�l�phone:    @{phone}
  Fax:          @{fax}
  Langue:       @{locale}

#{HTML}
<HTML>
<HEAD>
<STYLE TYPE="text/css">
BODY { WIDTH:500px; FONT:normal 12px sans-serif; BACKGROUND:#FFFFFF; COLOR:#000000; }
TABLE.info { FONT:normal 12px sans-serif; }
TABLE.info TD.l { VERTICAL-ALIGN:top; PADDING-RIGHT:5px; FONT-WEIGHT:bold; }
</STYLE>
</HEAD>
<BODY>
<P><B>Le nouvel(le) utilisateur(trice) suivant(e) a �t� enregistr�(e) avec succ�s:</B></P>
<BLOCKQUOTE>
<TABLE CLASS="info" CELLSPACING="0">
<TR><TD CLASS="l">E-Mail:</TD><TD CLASS="v">@{email}</TD></TR>
<TR><TD CLASS="l">Titre:</TD><TD CLASS="v">@{title}</TD></TR>
<TR><TD CLASS="l">Pr�nom:</TD><TD CLASS="v">@{firstname}</TD></TR>
<TR><TD CLASS="l">Nom:</TD><TD CLASS="v">@{lastname}</TD></TR>
<TR><TD CLASS="l">Entreprise:</TD><TD CLASS="v">@{company}</TD></TR>
<TR><TD CLASS="l">Fonction:</TD><TD CLASS="v">@{jobtitle}</TD></TR>
<TR><TD CLASS="l">Rue:</TD><TD CLASS="v">@{street}</TD></TR>
<TR><TD CLASS="l">Rue (+):</TD><TD CLASS="v">@{street2}</TD></TR>
<TR><TD CLASS="l">Case postale:</TD><TD CLASS="v">@{pobox}</TD></TR>
<TR><TD CLASS="l">Ville:</TD><TD CLASS="v">@{city}</TD></TR>
<TR><TD CLASS="l">Code postal:</TD><TD CLASS="v">@{zipcode}</TD></TR>
<TR><TD CLASS="l">R�gion:</TD><TD CLASS="v">@{state}</TD></TR>
<TR><TD CLASS="l">Pays:</TD><TD CLASS="v">@{country}</TD></TR>
<TR><TD CLASS="l">T�l�phone:</TD><TD CLASS="v">@{phone}</TD></TR>
<TR><TD CLASS="l">Fax:</TD><TD CLASS="v">@{fax}</TD></TR>
<TR><TD CLASS="l">Langue:</TD><TD CLASS="v">@{locale}</TD></TR>
</TABLE>
</BLOCKQUOTE>
</BODY>
</HTML>
