(function() {

  'use strict';

  angular
    .module('tribialfeminista.user')
    .factory('UserMdl', UserMdl);

  UserMdl.$inject = [
    '$http',

    '$cordovaDevice',

    'underscore',

    'API'
  ];

  function UserMdl(
    $http,

    $cordovaDevice,

    underscore,

    API) {

    function User() {
      this.hasShareBonus = false;
    }

    User.prototype.isSaved = function() {
      return JSON.parse(localStorage.getItem('user.isSaved')) === true;
    };

    User.prototype.postToServer = function() {
      var self = this;

      var postParams = {};

      postParams.deviceId = $cordovaDevice.getUUID();
      postParams.deviceType = $cordovaDevice.getPlatform().toLowerCase();
      postParams.loginType = self.loginType;

      if(self.loginType  === 'facebook') {
        postParams.fbId = self.fbId;
        postParams.email = self.email;
        postParams.fbUsername = self.fbUsername;
        postParams.fbPicUrl = self.fbPicUrl;
      }

      if(self.loginType === 'twitter') {
        postParams.twId = self.twId;
        postParams.twUsername = self.twUsername;
        postParams.twPicUrl = self.twPicUrl;
      }

      return $http.post(
        API.ENDPOINT + 'users',
        postParams
      )
      .then(function(response) {
        return response;
      }, function(err) {
        throw err.status + ' : ' + err.data;
      });
    };

    User.prototype.setAuthData = function(strategy, authData) {
      this.loginType = strategy;

      if(this.loginType === 'facebook') {
        this.accessToken = authData.access_token;
        this.accessTokenSecret = null;
        this.expiresIn = authData.expires_in;
      }

      if(strategy === 'twitter') {
        this.accessToken = authData.oauth_token;
        this.accessTokenSecret = authData.oauth_token_secret;
        this.expiresIn = null;
      }

    };

    User.prototype.setUserData = function(userData) {
      if(this.loginType === 'facebook') {
        this.fbId = userData.id;
        this.email = userData.email;
        this.fbUsername = userData.username;
        this.fbPicUrl = userData.picUrl;
      }

      if(this.loginType === 'twitter') {
        this.twId = userData.user_id;
        this.twUsername = userData.screen_name;
        this.twPicUrl = 'http://avatars.io/twitter/' + userData.screen_name + '?=large';
      }
    };

    User.prototype.updateData = function(item) {

      var self = this;

      _.each(item, function(value, index) {
        self[index] = value;
      });
    };

    User.prototype.isSaved = function() {
      return JSON.parse(localStorage.getItem('user.isSaved')) === true;
    };

    User.prototype.saveToLocalStorage = function() {
      localStorage.setItem('user.id', JSON.stringify(this.id));
      localStorage.setItem('user.deviceId', JSON.stringify(this.deviceId));
      localStorage.setItem('user.email', JSON.stringify(this.email));
      localStorage.setItem('user.hasShareBonus', JSON.stringify(this.hasShareBonus));
      localStorage.setItem('user.loginType', JSON.stringify(this.loginType));
      localStorage.setItem('user.fbId', JSON.stringify(this.fbId));
      localStorage.setItem('user.twId', JSON.stringify(this.twId));
      localStorage.setItem('user.fbUsername', JSON.stringify(this.fbUsername));
      localStorage.setItem('user.twUsername', JSON.stringify(this.twUsername));
      localStorage.setItem('user.fbPicUrl', JSON.stringify(this.fbPicUrl));
      localStorage.setItem('user.twPicUrl', JSON.stringify(this.twPicUrl));
      localStorage.setItem('user.accessToken', JSON.stringify(this.accessToken));
      localStorage.setItem('user.accessTokenSecret', JSON.stringify(this.accessTokenSecret));
      localStorage.setItem('user.expiresIn', JSON.stringify(this.expiresIn));

      localStorage.setItem('user.isSaved', JSON.stringify(true));
    };

    User.prototype.loadFromLocalStorage = function() {
      this.id = JSON.parse(localStorage.getItem('user.id'));
      this.deviceId = JSON.parse(localStorage.getItem('user.deviceId'));
      this.email = JSON.parse(localStorage.getItem('user.email'));

      var hasShareBonus = localStorage.getItem('user.hasShareBonus');

      if (underscore.isUndefined(hasShareBonus) || hasShareBonus === null) {
        this.hasShareBonus = false;
      } else {
        this.hasShareBonus = (hasShareBonus === 'true');
      }
      this.loginType = JSON.parse(localStorage.getItem('user.loginType'));
      this.fbId = JSON.parse(localStorage.getItem('user.fbId'));
      this.twId = JSON.parse(localStorage.getItem('user.twId'));
      this.fbUsername = JSON.parse(localStorage.getItem('user.fbUsername'));
      this.twUsername = JSON.parse(localStorage.getItem('user.twUsername'));
      this.fbPicUrl = JSON.parse(localStorage.getItem('user.fbPicUrl'));
      this.twPicUrl = JSON.parse(localStorage.getItem('user.twPicUrl'));
      this.accessToken = JSON.parse(localStorage.getItem('user.accessToken'));
      this.accessTokenSecret = JSON.parse(localStorage.getItem('user.accessTokenSecret'));
      this.expiresIn = JSON.parse(localStorage.getItem('user.expiresIn'));
    };

    User.prototype.clearLocalStorage = function() {
      localStorage.removeItem('user.id');
      localStorage.removeItem('user.email');
      localStorage.removeItem('user.hasShareBonus');
      localStorage.removeItem('user.loginType');
      localStorage.removeItem('user.fbId');
      localStorage.removeItem('user.twId');
      localStorage.removeItem('user.fbUsername');
      localStorage.removeItem('user.twUsername');
      localStorage.removeItem('user.fbPicUrl');
      localStorage.removeItem('user.twPicUrl');
      localStorage.removeItem('user.accessToken');
      localStorage.removeItem('user.accessTokenSecret');
      localStorage.removeItem('user.expiresIn');

      localStorage.removeItem('user.isSaved');
    };

    User.prototype.reset = function() {

      this.hasShareBonus = false;

      delete this.id;
      delete this.email;
      delete this.hasShareBonus;
      delete this.loginType;

      delete this.loginType;
      delete this.fbId;
      delete this.twId;
      delete this.fbUsername;
      delete this.twUsername ;
      delete this.fbPicUrl;
      delete this.twPicUrl;

      delete this.accessToken;
      delete this.accessTokenSecret;
      delete this.expiresIn;

    };

    User.prototype.closeSession = function() {
      this.clearLocalStorage();
      this.reset();
    };

    return new User();
  }

})();
