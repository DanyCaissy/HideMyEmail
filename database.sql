SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

DROP TABLE IF EXISTS settings;
DROP TABLE IF EXISTS visits_per_ip;
DROP TABLE IF EXISTS claims;
DROP TABLE IF EXISTS emails;
DROP TABLE IF EXISTS sessions;
DROP TABLE IF EXISTS restricted_aliases;

CREATE TABLE IF NOT EXISTS claims (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  email_id int(10) unsigned NOT NULL,
  session_id int(10) unsigned NOT NULL,
  PRIMARY KEY (id),
  KEY email_id (email_id),
  KEY session_id (session_id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;


CREATE TABLE IF NOT EXISTS emails (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  session_id int(10) unsigned NOT NULL,
  address char(255) NOT NULL,
  alias char(32) NOT NULL,
  admin_hash char(32) NOT NULL,
  captcha tinyint(1) NOT NULL,
  views int(11) NOT NULL DEFAULT '0',
  disabled tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (id),
  UNIQUE KEY admin_hash (admin_hash),
  UNIQUE KEY address (address),
  UNIQUE KEY alias (alias),
  KEY session_id (session_id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;


CREATE TABLE IF NOT EXISTS restricted_aliases (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  alias char(32) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;


CREATE TABLE IF NOT EXISTS sessions (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  full_path char(64) DEFAULT NULL,
  ip_address int(10) unsigned DEFAULT NULL,
  computer_name char(64) DEFAULT NULL,
  user_agent text,
  referrer char(100) DEFAULT NULL,
  reference char(32) DEFAULT '',
  is_bot tinyint(1) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;


CREATE TABLE IF NOT EXISTS settings (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  alias_length tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;


CREATE TABLE IF NOT EXISTS visits_per_ip (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  email_id int(10) unsigned NOT NULL,
  ip_address int(10) unsigned NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY email_id (email_id,ip_address),
  KEY email_id_2 (email_id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;


ALTER TABLE claims
  ADD CONSTRAINT claims_email_id FOREIGN KEY (email_id) REFERENCES emails (id) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT claims_session_id FOREIGN KEY (session_id) REFERENCES `sessions` (id);

ALTER TABLE emails
  ADD CONSTRAINT email_session_id FOREIGN KEY (session_id) REFERENCES `sessions` (id);

ALTER TABLE visits_per_ip
  ADD CONSTRAINT visits_email_id FOREIGN KEY (email_id) REFERENCES emails (id) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
