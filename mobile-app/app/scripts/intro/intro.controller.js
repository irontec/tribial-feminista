(function() {

  'use strict';

  angular
    .module('tribialfeminista.intro')
    .controller('IntroCtrl', Intro);

  Intro.$inject = [
    '$state', 

    '$cordovaDevice',

    '$ionicSlideBoxDelegate', 

    'LangService', 

    'UserMdl'
  ];

  function Intro($state, $cordovaDevice, $ionicSlideBoxDelegate, LangService, UserMdl) {

    var vm = this;
    vm.platform = $cordovaDevice.getPlatform().toLowerCase();
    vm.locales = LangService.getStateTranslation();
    vm.locales.common = LangService.getCommonTranslation();

    vm.startApp = startApp;
    vm.next = next;
    vm.previous = previous;
    vm.slideChanged = slideChanged;

    function startApp() {
      if(UserMdl.isSaved()) {
        return $state.go('main');
      }
      $state.go('login');
    }

    function next() {
      $ionicSlideBoxDelegate.next();
    }

    function previous() {
      $ionicSlideBoxDelegate.previous();
    }

    // Called each time the slide changes
    function slideChanged(index) {
      vm.slideIndex = index;
    }
  }

})();
