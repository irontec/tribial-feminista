(function() {

  // Compiled from https://gist.githubusercontent.com/kyletns/93a510465e433c1981e1/raw/dab96e79b60f3cb1c88774f49c76cc81e63cdbd0/back_button_manager.coffee

  'use strict';

  angular
  .module('tribialfeminista.helpers')
  .service('BackButtonManager', BackButtonManager);

  BackButtonManager.$inject = ['$rootScope', '$ionicPlatform'];

  function BackButtonManager($rootScope, $ionicPlatform) {

    var managedStates;
    managedStates = [];

    $rootScope.$on('$stateChangeSuccess', function(event, next) {
      var state, _i, _j, _len, _len1, _results;
      for (_i = 0, _len = managedStates.length; _i < _len; _i++) {
        state = managedStates[_i];
        if (state.enabled) {
          state.unregisterCallback();
          state.enabled = false;
        }
      }
      _results = [];
      for (_j = 0, _len1 = managedStates.length; _j < _len1; _j++) {
        state = managedStates[_j];
        if (next.name === state.name && !state.enabled) {
          state.unregisterCallback = $ionicPlatform.registerBackButtonAction(state.callback, 100);
          state.enabled = true;
          break;
        } else {
          _results.push(void 0);
        }
      }
      return _results;
    });

    return {
      attachToState: function(state, callback) {
        managedStates = _.reject(managedStates, function(s) {
          return s.name === state;
        });
        return managedStates.push({
          name: state,
          callback: callback,
          enabled: false
        });
      }
    };
  }

})();
