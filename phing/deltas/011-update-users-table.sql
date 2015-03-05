ALTER TABLE `Users`
  DROP COLUMN `username`,
  DROP COLUMN `loginType`,
  
  ADD COLUMN `deviceId`
    varchar(100) UNIQUE,
  ADD COLUMN `deviceType`
    ENUM('ios', 'android', 'unknown') NOT NULL
    COMMENT '[enum:ios|android|unknown]',

  ADD COLUMN `loginType`
    ENUM('twitter', 'facebook') NOT NULL
    COMMENT '[enum:twitter|facebook|unknown]',

  ADD COLUMN `fbId`
    bigint UNSIGNED DEFAULT NULL,
  ADD COLUMN `twId`
    bigint UNSIGNED DEFAULT NULL,
  ADD COLUMN `fbPicUrl`
    varchar(255) DEFAULT NULL,
  ADD COLUMN `twPicUrl`
    varchar(255) DEFAULT NULL;
