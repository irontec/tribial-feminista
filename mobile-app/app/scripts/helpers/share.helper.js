(function() {

  'use strict';

  angular
    .module('tribialfeminista.helpers')
    .factory('shareHelper', shareHelper);

  shareHelper.$inject = ['underscore'];

  function shareHelper(underscore) {

    return {
      'share': function(title, url, msg) {
        if(this._hasSharing) {
          window.plugins.socialsharing.share(msg, title, null, url);
        }
      },
      'socialShare': function(content, socialProvider, successCallback, errorCallback) {
        if(this._hasSharing) {
          if(socialProvider === 'twitter') {
            window.plugins.socialsharing.shareViaTwitter(content.msg, null, content.url, successCallback, errorCallback);
          }
          if(socialProvider === 'facebook') {
            window.plugins.socialsharing.shareViaFacebookWithPasteMessageHint(content.msg, null,  content.url /* url */, 'Long press on input and paste the message', successCallback, errorCallback);
            //window.plugins.socialsharing.shareViaFacebook(content.msg, null, content.url, successCallback, errorCallback);
          }
        }
      },
      '_hasSharing': function() {
        return (underscore.has(window, 'plugins') && underscore.has(window.plugins, 'socialsharing'));
      }
    };

  }

})();
