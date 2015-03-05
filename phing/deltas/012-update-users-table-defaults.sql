ALTER TABLE `Users`
  CHANGE
    `loginType` `loginType`
    ENUM('twitter', 'facebook', 'unknown') NOT NULL
    COMMENT '[enum:twitter|facebook|unknown]'
    DEFAULT 'unknown',
  CHANGE
    `deviceType` `deviceType`
    ENUM('ios', 'android', 'unknown') NOT NULL
    COMMENT '[enum:ios|android|unknown]'
    DEFAULT 'unknown';
