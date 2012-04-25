-- INDENTING (emacs/vi): -*- mode:sql; tab-width:2; c-basic-offset:2; intent-tabs-mode:nil; -*- ex: set tabstop=2 expandtab:


/*
 * TABLE
 */

CREATE TABLE tb_GEREMO_Account (
  username varchar(50) NOT NULL,
  password varchar(50) NOT NULL,
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
  created timestamp NOT NULL DEFAULT 0, -- set/forced via trigger
  updated timestamp NOT NULL DEFAULT 0, -- set/forced via trigger
  blocked timestamp NOT NULL DEFAULT 0
);
ALTER TABLE tb_GEREMO_Account ADD UNIQUE INDEX uq_GEREMO_Account ( username );


/*
 * TRIGGERS
 */

DROP TRIGGER IF EXISTS tg__tb_GEREMO_Account__bi;
DELIMITER $
CREATE DEFINER = CURRENT_USER TRIGGER tg__tb_GEREMO_Account__bi BEFORE INSERT ON tb_GEREMO_Account
FOR EACH ROW 
BEGIN
  SET NEW.created = CURRENT_TIMESTAMP();
  SET NEW.updated = CURRENT_TIMESTAMP();
END $
DELIMITER ;

DROP TRIGGER IF EXISTS tg__tb_GEREMO_Account__bu;
DELIMITER $
CREATE DEFINER = CURRENT_USER TRIGGER tg__tb_GEREMO_Account__bu BEFORE UPDATE ON tb_GEREMO_Account
FOR EACH ROW
BEGIN
  SET NEW.created = OLD.created; -- creation timestamp MUST NOT be modified
  SET NEW.updated = CURRENT_TIMESTAMP();
END $
DELIMITER ;


/*
 * FUNCTION
 */

DROP FUNCTION IF EXISTS fn_GEREMO_Register;
DELIMITER $
CREATE
DEFINER = CURRENT_USER
FUNCTION fn_GEREMO_Register(
  _username text,
  _password text,
  _title text,
  _firstname text,
  _lastname text,
  _company text,
  _jobtitle text,
  _street text,
  _street2 text,
  _pobox text,
  _city text,
  _zipcode text,
  _state text,
  _country text,
  _phone text,
  _fax text
) RETURNS boolean
LANGUAGE SQL
NOT DETERMINISTIC
MODIFIES SQL DATA
SQL SECURITY DEFINER
BEGIN
  DECLARE __exists boolean;
  SELECT TRUE FROM tb_GEREMO_Account WHERE username = _username INTO __exists;

  IF __exists THEN

    UPDATE tb_GEREMO_Account SET
      username = _username, password = _password,
      title = _title, firstname = _firstname, lastname = _lastname,
      company = _company, jobtitle = _jobtitle,
      street = _street, street2 = _street2, pobox = _pobox,
      city = _city, zipcode = _zipcode, state = _state, country = _country,
      phone = _phone, fax = _fax
    WHERE username = _username AND blocked = 0;

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

  RETURN ROW_COUNT() >= 1;

END $
DELIMITER ;

DROP FUNCTION IF EXISTS fn_GEREMO_Block;
DELIMITER $
CREATE
DEFINER = CURRENT_USER
FUNCTION fn_GEREMO_Block(
  _username text
) RETURNS boolean
LANGUAGE SQL
NOT DETERMINISTIC
MODIFIES SQL DATA
SQL SECURITY DEFINER
BEGIN

  UPDATE tb_GEREMO_Account SET
    password = MD5( RAND() ),
    blocked = CURRENT_TIMESTAMP()
  WHERE username = _username;

  RETURN ROW_COUNT() >= 1;

END $
DELIMITER ;

DROP FUNCTION IF EXISTS fn_GEREMO_Unblock;
DELIMITER $
CREATE
DEFINER = CURRENT_USER
FUNCTION fn_GEREMO_Unblock(
  _username text
) RETURNS boolean
LANGUAGE SQL
NOT DETERMINISTIC
MODIFIES SQL DATA
SQL SECURITY DEFINER
BEGIN

  UPDATE tb_GEREMO_Account SET
    blocked = 0
  WHERE username = _username;

  RETURN ROW_COUNT() >= 1;

END $
DELIMITER ;
