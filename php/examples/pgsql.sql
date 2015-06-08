-- INDENTING (emacs/vi): -*- mode:sql; tab-width:2; c-basic-offset:2; intent-tabs-mode:nil; -*- ex: set tabstop=2 expandtab:


/*
 * TABLE
 */

CREATE TABLE tb_GEREMO_Account (
  username varchar(50) NOT NULL CONSTRAINT uq_GEREMO_Account UNIQUE,
  password varchar(50),
  title varchar(50),
  firstname varchar(50),
  lastname varchar(50),
  company varchar(50),
  jobtitle varchar(50),
  street varchar(50),
  street2 varchar(50),
  pobox varchar(50),
  city varchar(50),
  zipcode varchar(50),
  state varchar(50),
  country varchar(50),
  phone varchar(50),
  fax varchar(50),
  created timestamp NOT NULL DEFAULT( CURRENT_TIMESTAMP ), -- forced via trigger
  updated timestamp NOT NULL DEFAULT( CURRENT_TIMESTAMP ), -- forced via trigger
  accessed timestamp
  blocked timestamp
);

--GRANT SELECT ON tb_GEREMO_Account TO "geremo-auth";

CREATE TABLE tb_GEREMO_Log (
  username varchar(50) NOT NULL,
  accessed timestamp NOT NULL,
  uri varchar(500),
  ip varchar(50)
);
-- ... indexes
CREATE INDEX ON tb_GEREMO_Log(username);
CREATE INDEX ON tb_GEREMO_Log(accessed);

--GRANT INSERT ON tb_GEREMO_Log TO "geremo-auth";


/*
 * TRIGGERS
 */

CREATE OR REPLACE FUNCTION tf__tb_GEREMO_Account__b() RETURNS TRIGGER AS '
BEGIN
  IF TG_OP=''INSERT'' THEN
    new.created := CURRENT_TIMESTAMP;
    new.updated := CURRENT_TIMESTAMP;
  ELSIF TG_OP=''UPDATE'' THEN
    new.created := old.created; -- creation timestamp MUST NOT be modified
    new.updated := CURRENT_TIMESTAMP;
  ELSIF TG_OP=''DELETE'' THEN
    RETURN old;
  END IF;
  RETURN new;
END
' LANGUAGE 'plpgsql' VOLATILE SECURITY DEFINER;

CREATE TRIGGER tg__tb_GEREMO_Account__b BEFORE INSERT OR UPDATE OR DELETE ON tb_GEREMO_Account
FOR EACH ROW EXECUTE PROCEDURE tf__tb_GEREMO_Account__b ();

CREATE OR REPLACE FUNCTION tf__tb_GEREMO_Log__a() RETURNS TRIGGER AS '
BEGIN
  IF TG_OP=''INSERT'' THEN
    UPDATE tb_GEREMO_Account SET accessed=NEW.accessed WHERE username=NEW.username;
  ELSIF TG_OP=''DELETE'' THEN
    RETURN old;
  END IF;
  RETURN new;
END
' LANGUAGE 'plpgsql' VOLATILE SECURITY DEFINER;

CREATE TRIGGER tg__tb_GEREMO_Log__a BEFORE INSERT OR UPDATE OR DELETE ON tb_GEREMO_Log
FOR EACH ROW EXECUTE PROCEDURE tf__tb_GEREMO_Log__a ();


/*
 * FUNCTION
 */

CREATE OR REPLACE FUNCTION fn_GEREMO_Register(
  text, text, text, text, text, text, text, text, text, text, text, text, text, text, text, text
) RETURNS boolean AS '
DECLARE
-- ARGUMENTS
  _username ALIAS FOR $1;
  _password ALIAS FOR $2;
  _title ALIAS FOR $3;
  _firstname ALIAS FOR $4;
  _lastname ALIAS FOR $5;
  _company ALIAS FOR $6;
  _jobtitle ALIAS FOR $7;
  _street ALIAS FOR $8;
  _street2 ALIAS FOR $9;
  _pobox ALIAS FOR $10;
  _city ALIAS FOR $11;
  _zipcode ALIAS FOR $12;
  _state ALIAS FOR $13;
  _country ALIAS FOR $14;
  _phone ALIAS FOR $15;
  _fax ALIAS FOR $16;
-- VARIABLES
  __exists boolean;
BEGIN
  __exists := ( SELECT TRUE FROM tb_GEREMO_Account WHERE username = _username );

  IF __exists THEN

    UPDATE tb_GEREMO_Account SET
      username = _username, password = _password,
      title = _title, firstname = _firstname, lastname = _lastname,
      company = _company, jobtitle = _jobtitle,
      street = _street, street2 = _street2, pobox = _pobox,
      city = _city, zipcode = _zipcode, state = _state, country = _country,
      phone = _phone, fax = _fax
    WHERE username = _username AND blocked IS NULL;

  ELSE

    INSERT INTO tb_GEREMO_Account (
      username, password,
      title, firstname, lastname,
      company, jobtitle,
      street, street2, pobox,
      city, zipcode, state, country,
      phone, fax
    ) VALUES (
      _username, _password,
      _title, _firstname, _lastname,
      _company, _jobtitle,
      _street, _street2, _pobox,
      _city, _zipcode, _state, _country,
      _phone, _fax
    );

  END IF;

  RETURN FOUND;
END
' LANGUAGE 'plpgsql' VOLATILE SECURITY DEFINER;

--GRANT EXECUTE ON FUNCTION fn_GEREMO_Register(text, text, text, text, text, text, text, text, text, text, text, text, text, text, text, text) TO "geremo-register";

CREATE OR REPLACE FUNCTION fn_GEREMO_Block(
  text
) RETURNS boolean AS '
DECLARE
-- ARGUMENTS
  _username ALIAS FOR $1;
BEGIN

  UPDATE tb_GEREMO_Account SET
    password = MD5( RANDOM()::text ),
    blocked = CURRENT_TIMESTAMP
  WHERE username = _username;

  RETURN FOUND;
END
' LANGUAGE 'plpgsql' VOLATILE SECURITY DEFINER;

CREATE OR REPLACE FUNCTION fn_GEREMO_Unblock(
  text
) RETURNS boolean AS '
DECLARE
-- ARGUMENTS
  _username ALIAS FOR $1;
BEGIN

  UPDATE tb_GEREMO_Account SET
    blocked = NULL
  WHERE username = _username;

  RETURN FOUND;
END
' LANGUAGE 'plpgsql' VOLATILE SECURITY DEFINER;
