(function () {

  'use strict';

  angular
    .module('tribialfeminista.settings')
    .controller('SettingsCtrl', Settings);

  Settings.$inject = [
    '$state',
    '$scope',

    '$ionicPopup',
    '$ionicLoading',

    '$cordovaNetwork',
    '$cordovaBackButton',

    'LangService',

    'GameQuestionsMngr',

    'UserMdl',
    'GameMdl'
  ];

  function Settings(
    $state,
    $scope,

    $ionicPopup,
    $ionicLoading,

    $cordovaNetwork,
    $cordovaBackButton,

    LangService,
    GameQuestionsMngr,

    UserMdl,
    GameMdl) {

    if(!UserMdl.isSaved()) {
      $state.go('login');
    }

    var vm = this;

    vm.locales = LangService.getStateTranslation();
    vm.locales.common = LangService.getCommonTranslation();

    $cordovaBackButton.clear();
    $cordovaBackButton.addListener('settings', function(e) {
      e.preventDefault();
      vm.goTo('main');
    });

    vm.goTo = function(path){
      $state.go(path);
    };

    vm.closeSession = function() {
      UserMdl.closeSession();
      var game = new GameMdl();
      game.clearLocalStorage();
      $state.go('login');
    };

    vm.updateQuestions = function() {

      if($cordovaNetwork.isOnline()) {

        $ionicLoading.show({
          template: '<i class="icon ion-loading-d" style="font-size: 32px"></i>',
          animation: 'fade-in',
          noBackdrop: false
        });

        GameQuestionsMngr.checkUpdates(function() {
          $ionicLoading.hide();
          $ionicPopup.alert({
            title: vm.locales['packagesUpdated']
          });
        });

      } else {
        $ionicPopup.alert({
          title: vm.locales.common.noInternet
        });
      }


    };

  }

})();
