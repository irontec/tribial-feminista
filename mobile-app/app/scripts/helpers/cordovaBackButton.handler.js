(function() {

  'use strict';

  angular
  .module('tribialfeminista.helpers')
  .factory('$cordovaBackButton', CordovaBackButton);

  CordovaBackButton.$inject = ['underscore'];

  function CordovaBackButton(underscore) {

    function BackButtonHandler() {
      this._collection = {};
    }

    BackButtonHandler.prototype.addListener = function(tag, handler) {
      this.removeListener(tag);
      this._collection[tag] = handler;
      document.addEventListener('backbutton', this._collection[tag], false);
    };

    BackButtonHandler.prototype.removeAll = function() {

      var self = this;

      var tags = [];

      underscore.each(self._collection, function(value, tag) {
        tags.push(tag);
      });

      underscore.each(tags, function(tag) {
        self.removeListener(tag);
      });

    };

    BackButtonHandler.prototype.clear = BackButtonHandler.prototype.removeAll;

    BackButtonHandler.prototype.removeListener = function(tag) {
      if(this.exists(tag)) {
        document.removeEventListener('backbutton', this._collection[tag], false);
        delete this._collection[tag];
      }
    };

    BackButtonHandler.prototype.exists = function(tag) {
      var method = underscore.find(this._collection, function(method, iden){
        return iden === tag;
      });

      if(underscore.isUndefined(method)) {
        return false;
      }

      return true;
    };

    return new BackButtonHandler();


  }

})();
