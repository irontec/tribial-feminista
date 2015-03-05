(function () {

  'use strict';

  angular
  .module('tribialfeminista.about')
  .controller('AboutCtrl', About);

  About.$inject = ['$state', '$cordovaBackButton', '$cordovaAppVersion', 'APP_NAME', 'LangService'];

  function About($state, $cordovaBackButton, $cordovaAppVersion, APP_NAME, LangService) {

    var vm = this;

    vm.locales = LangService.getStateTranslation();
    vm.locales.common = LangService.getCommonTranslation();

    $cordovaBackButton.clear();
    $cordovaBackButton.addListener('ranking', function(e) {
      e.preventDefault();
      vm.goTo('main');
    });

    vm.goTo = function(path){
      $state.go(path);
    };

    vm.appName = APP_NAME;
    $cordovaAppVersion.getAppVersion().then(function (version) {
       vm.appVersion = version;
    });

  }

})();
