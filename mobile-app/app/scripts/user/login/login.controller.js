(function() {

  'use strict';

  angular
    .module('tribialfeminista.user')
    .controller('LoginCtrl', Login);

  Login.$inject = ['LangService', 'AuthFactory', 'UserMdl', '$state', '$cordovaNetwork', '$ionicPopup', '$cordovaBackButton', '$ionicLoading'];

  function Login(LangService, AuthFactory, UserMdl, $state, $cordovaNetwork, $ionicPopup, $cordovaBackButton, $ionicLoading) {

    if(UserMdl.isSaved()) {
      $state.go('main');
    }

    var vm = this;

    vm.locales = LangService.getStateTranslation();
    vm.locales.common = LangService.getCommonTranslation();

    vm.signUp = signUp;

    $cordovaBackButton.clear();
    $cordovaBackButton.addListener('login', function(e) {
      e.preventDefault();
      $state.go('intro');
    });

    function signUp(strategy){
      
      if($cordovaNetwork.isOnline()) {
        $ionicLoading.show({
          template: '<i class="icon ion-loading-d" style="font-size: 32px"></i>',
          animation: 'fade-in',
          noBackdrop: false
        });
        $cordovaBackButton.clear();
        AuthFactory.authenticate(strategy, function(err) {
          if(err) {
            console.log(JSON.stringify(err));
            $ionicPopup.alert({
              title: vm.locales['authentication_error']
            });
            $ionicLoading.hide();
          } else {
            UserMdl.postToServer().then(function(result) {
              UserMdl.updateData(result.data.content.item);
              UserMdl.saveToLocalStorage();
              $ionicLoading.hide();
              $state.go('main');
            }, function(err) {
              $ionicPopup.alert({
                title: vm.locales['authentication_error']
              });
              $ionicLoading.hide();
            });
          }
        });

      } else {
        $ionicPopup.alert({
          title: vm.locales.common['connection_error']
        });
      }
    }
  }

})();
