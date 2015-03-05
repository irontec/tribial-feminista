(function() {

  'use strict';

  angular
    .module('tribialfeminista.helpers')
    .provider('LangService', LangService);

  function LangService() {

    var _lang = '';
    var _url = '/i18n/languages.json';
    var _translationObject = null;

    this.init = function (config) {
      _lang = config.lang;
      if(config.url) {
        _url = config.url;
      }

    };

    this.$get = ['$state', 'TRANSLATIONS', Service];

    function Service($state, TRANSLATIONS) {

      return {
        'loadTranslation': loadTranslation,
        'getStateTranslation': getStateTranslation,
        'getCommonTranslation': getCommonTranslation,
        'setLang': setLang,
        'getLang': getLang,
        'checkStatus': checkStatus
      };

      function loadTranslation() {
        _translationObject = TRANSLATIONS;
      }

      function getStateTranslation(stateName) {
        if(stateName) {
          return _translationObject[_lang][stateName];
        }
        return _translationObject[_lang][$state.current.name];
      }

      function getCommonTranslation() {
        return _translationObject[_lang]._common;
      }

      function setLang(newLang) {
        _lang = newLang;
      }

      function getLang() {
        return _lang;
      }

      function checkStatus() {
        return _translationObject === null;
      }

    }

  }

})();
