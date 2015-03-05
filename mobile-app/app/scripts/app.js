(function() {

  'use strict';
  // Ionic Starter App

  // angular.module is a global place for creating, registering and retrieving Angular modules
  angular.module('tribialfeminista', [
    /* Shared Modules */
    'tribialfeminista.core',
    'tribialfeminista.helpers',

    /* Feature Areas */
    'tribialfeminista.intro', // Tutorial Screen
    'tribialfeminista.user', // Login Screen and User Data
    'tribialfeminista.main', // Main Screen
    'tribialfeminista.game', // Game Screen
    'tribialfeminista.ranking', // Ranking Screen
    'tribialfeminista.settings', // Settings Screen
    'tribialfeminista.about' // About Screen
  ]);

  angular.module('tribialfeminista').config([
    '$httpProvider',
    '$stateProvider',
    '$urlRouterProvider',
    'LangServiceProvider',
    'LANG',
    prepareConfig
  ]);

  angular.module('tribialfeminista').run([
    '$ionicPlatform',
    'LangService',
    'BackButtonManager',
    preparePlatform
  ]);

  function preparePlatform($ionicPlatform, LangService, BackButtonManager) {

    BackButtonManager.attachToState('game', function(e) {
      e.preventDefault();
    });

    BackButtonManager.attachToState('login', function(e) {
      e.preventDefault();
    });

    BackButtonManager.attachToState('main', function(e) {
      e.preventDefault();
    });

    $ionicPlatform.ready(function () {
      // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
      // for form inputs)
      if (window.cordova && window.cordova.plugins.Keyboard) {
        cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
      }
	/*
      if (window.StatusBar) {
        // org.apache.cordova.statusbar required
        StatusBar.styleDefault();
      }
	*/
    });
    LangService.loadTranslation();
  }

  function prepareConfig($httpProvider, $stateProvider, $urlRouterProvider, LangServiceProvider, LANG) {

    $httpProvider.defaults.useXDomain = true;
    $httpProvider.defaults.withCredentials = false;
    delete $httpProvider.defaults.headers.common['X-Requested-With'];
    $httpProvider.defaults.headers.common['Accept'] = 'application/json';
    $httpProvider.defaults.headers.common['Content-Type'] = 'application/json';

    LangServiceProvider.init({
      lang: LANG
    });

    $stateProvider
      .state('intro', {
        url: '/intro',
        templateUrl: 'scripts/intro/intro.view.html',
        controller: 'IntroCtrl as vm'
      })
      .state('login', {
        url: '/login',
        templateUrl: 'scripts/user/login/login.view.html',
        controller: 'LoginCtrl as vm'
      })
      .state('main', {
        url: '/main',
        templateUrl: 'scripts/main/main.view.html',
        controller: 'MainCtrl as vm'
      })
      .state('game', {
        url: '/game',
        templateUrl: 'scripts/game/game.view.html',
        controller: 'GameCtrl as vm'
      })
      .state('ranking', {
        url: '/ranking',
        templateUrl: 'scripts/ranking/ranking.view.html',
        controller: 'RankingCtrl as vm'
      })
      .state('settings', {
        url: '/settings',
        templateUrl: 'scripts/settings/settings.view.html',
        controller: 'SettingsCtrl as vm'
      })
      .state('about', {
        url: '/about',
        templateUrl: 'scripts/about/about.view.html',
        controller: 'AboutCtrl as vm'
      });

    $urlRouterProvider.otherwise('/main');

  }

})();
