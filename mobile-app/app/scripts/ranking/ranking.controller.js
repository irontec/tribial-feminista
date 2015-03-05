(function() {

  'use strict';

  angular
    .module('tribialfeminista.main')
    .controller('RankingCtrl', Ranking);

  Ranking.$inject = [
    '$state',
    '$scope',

    '$ionicLoading',

    '$cordovaNetwork',
    '$cordovaBackButton',

    'LangService',

    'UserMdl',
    'RankingMdl'
  ];

  function Ranking(
    $state,
    $scope,

    $ionicLoading,

    $cordovaNetwork,
    $cordovaBackButton,

    LangService,

    UserMdl,
    RankingMdl) {

    if(!UserMdl.isSaved()) {
      $state.go('login');
    }

    var vm = this;

    vm.locales = LangService.getStateTranslation();
    vm.locales.common = LangService.getCommonTranslation();

    vm.isOnline = false;
    vm.isLoaded = false;
    vm.isEmpty = function() {
      return vm.scores().length === 0;
    };

    $cordovaBackButton.clear();
    $cordovaBackButton.addListener('ranking', function(e) {
      e.preventDefault();
      vm.goTo('main');
    });

    init();

    function init(){
      if($cordovaNetwork.isOnline()) {
        vm.isOnline = true;
        $ionicLoading.show({
          template: '<i class="icon ion-loading-d" style="font-size: 32px"></i>',
          animation: 'fade-in',
          noBackdrop: false
        });
        getData();
      } else {
        vm.isOnline = false;
      }

    }


    function getData() {
      RankingMdl.getAllFromApi().then(function() {
        $ionicLoading.hide();
        $scope.$broadcast('scroll.refreshComplete');
        vm.isLoaded = true;
      }, function(err) {
        $ionicLoading.hide();
        $scope.$broadcast('scroll.refreshComplete');
        vm.isLoaded = true;
        console.log(err);
      });
    }

    vm.refresh = function() {
      getData();
    };


    vm.scores = function() {
      return RankingMdl.scores;
    };



    vm.goTo = function(path){
      $state.go(path);
    };
  }

})();
