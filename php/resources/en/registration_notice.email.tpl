#{SUBJECT}
New User Registration

#{TEXT}
The following user has been successfully registered:

  E-Mail:     @{email}
  Title:      @{title}
  First Name: @{firstname}
  Last Name:  @{lastname}
  Company:    @{company}
  Job Title:  @{jobtitle}
  Street:     @{street}
  Street (+): @{street2}
  P.O.Box:    @{pobox}
  City:       @{city}
  Zip Code:   @{zipcode}
  State:      @{state}
  Country:    @{country}
  Phone:      @{phone}
  Fax:        @{fax}
  Language:   @{locale}

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
<P><B>The following new user has been successfully registered:</B></P>
<BLOCKQUOTE>
<TABLE CLASS="info" CELLSPACING="0">
<TR><TD CLASS="l">E-Mail:</TD><TD CLASS="v">@{email}</TD></TR>
<TR><TD CLASS="l">Title:</TD><TD CLASS="v">@{title}</TD></TR>
<TR><TD CLASS="l">First Name:</TD><TD CLASS="v">@{firstname}</TD></TR>
<TR><TD CLASS="l">Last Name:</TD><TD CLASS="v">@{lastname}</TD></TR>
<TR><TD CLASS="l">Company:</TD><TD CLASS="v">@{company}</TD></TR>
<TR><TD CLASS="l">Job Title:</TD><TD CLASS="v">@{jobtitle}</TD></TR>
<TR><TD CLASS="l">Street:</TD><TD CLASS="v">@{street}</TD></TR>
<TR><TD CLASS="l">Street (+):</TD><TD CLASS="v">@{street2}</TD></TR>
<TR><TD CLASS="l">P.O.Box:</TD><TD CLASS="v">@{pobox}</TD></TR>
<TR><TD CLASS="l">City:</TD><TD CLASS="v">@{city}</TD></TR>
<TR><TD CLASS="l">Zip Code:</TD><TD CLASS="v">@{zipcode}</TD></TR>
<TR><TD CLASS="l">State:</TD><TD CLASS="v">@{state}</TD></TR>
<TR><TD CLASS="l">Country:</TD><TD CLASS="v">@{country}</TD></TR>
<TR><TD CLASS="l">Phone:</TD><TD CLASS="v">@{phone}</TD></TR>
<TR><TD CLASS="l">Fax:</TD><TD CLASS="v">@{fax}</TD></TR>
<TR><TD CLASS="l">Language:</TD><TD CLASS="v">@{locale}</TD></TR>
</TABLE>
</BLOCKQUOTE>
</BODY>
</HTML>
