(function() {

  'use strict';

  var CONFIG = {

    APP_NAME: 'Tribial Feminista',
    PLATFORMS: ['ios', 'android'],
    LANG: 'eu-EU',
    RESOURCES: {
      SOUNDS: {
        SUCCESS: 'resources/sounds/success.mp3',
        COMPLETED: 'resources/sounds/completed.mp3',
        ERROR: 'resources/sounds/error.mp3',
        OVER: 'resources/sounds/over.mp3'
      },
      PACKAGE: 'resources/packages/default.json'
    },
    APP_LINKS: {
      'android': 'http://play.google.com/com.irontec.tribialfeminista',
      'ios': 'http://google.es'
    }
  };

  angular
    .module('tribialfeminista.core')
    .constant('APP_NAME', CONFIG.APP_NAME)
    .constant('PLATFORMS', CONFIG.PLATFORMS)
    .constant('LANG', CONFIG.LANG)
    .constant('RESOURCES', CONFIG.RESOURCES)
    .constant('APP_LINKS', CONFIG.APP_LINKS)
    .constant('underscore', _);

})();
