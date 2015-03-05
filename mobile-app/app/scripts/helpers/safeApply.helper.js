(function() {

  'use strict';

  angular
    .module('tribialfeminista.helpers')
    .factory('safeApply', safeApply);

  safeApply.$inject = ['$rootScope'];

  function safeApply($rootScope) {

    function apply() {
      if(!$rootScope.$$phase) {
        $rootScope.$apply();
      }
    }

    return apply;
  }

})();
