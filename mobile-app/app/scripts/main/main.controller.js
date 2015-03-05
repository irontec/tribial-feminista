(function() {

  'use strict';

  angular
    .module('tribialfeminista.main')
    .controller('MainCtrl', Main);

  Main.$inject = ['$state', 'LangService', 'UserMdl', '$cordovaBackButton'];

  function Main($state, LangService, UserMdl, $cordovaBackButton) {

    if(!UserMdl.isSaved()) {
      return $state.go('intro');
    }

    UserMdl.loadFromLocalStorage();


    var vm = this;

    vm.locales = LangService.getStateTranslation();
    vm.locales.common = LangService.getCommonTranslation();

    vm.goTo = function(path){
      $state.go(path);
    };

    $cordovaBackButton.clear();
    $cordovaBackButton.addListener('main', function(e) {
      e.preventDefault();
      navigator.app.exitApp();
    });
  }

})();
