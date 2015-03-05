(function() {

  'use strict';

  angular
    .module('tribialfeminista.user')
    .factory('AuthFactory', AuthFactory);

  AuthFactory.$inject = ['$http', '$q', '$cordovaOauth', 'API', 'UserMdl'];

  function AuthFactory($http, $q, $cordovaOauth, API, UserMdl) {

    return {
      'authenticate': function(strategy, callback) {

        var self = this;
        self.callback = callback;

        if(strategy === 'facebook') {
          this._authenticateWithFB(function(result, error) {
            if(error) {
              self.callback(error);
            } else {
              UserMdl.setAuthData(strategy, result);
              self._getFBUserData().then(function(result) {
                var data = _.extend(result[0], result[1]);
                UserMdl.setUserData(data);
                self.callback();
              }, function(err) {
                self.callback(err);
              });

            }
          });
        }

        if(strategy === 'twitter') {
          this._authenticateWithTW(function(result, error) {
            console.log(JSON.stringify(result));
            if(error) {
              self.callback(error);
            } else {
              UserMdl.setAuthData(strategy, result);
              UserMdl.setUserData(result);
              self.callback();
            }
          });
        }


      },
      '_authenticateWithFB': function(callback) {
        $cordovaOauth.facebook(API.FACEBOOK.CLIENT_ID, API.FACEBOOK.SCOPE).then(function(result) {
          callback(result);
        }, function(error) {
          callback(null, error);
        });
      },
      '_authenticateWithTW': function(callback) {
        $cordovaOauth.twitter(API.TWITTER.CONSUMER_KEY, API.TWITTER.CONSUMER_SECRET_KEY).then(function(result) {
          callback(result);
        }, function(error) {
          callback(null, error);
        });
      },
      '_getFBUserData': function() {

        var deferred = $q.defer();

        var asyncMethods = [this._getFBUserProfile(), this._getFBUserPicture()];

        $q.all(asyncMethods)
        .then(
          function(results) {
            deferred.resolve(results);
          },
          function(errors) {
            deferred.reject(errors);
          }
        );
        return deferred.promise;
      },
      '_getFBUserProfile': function() {
        return $http.get(
          API.FACEBOOK.ENDPOINT + 'me',
          {
            params: {
              'access_token': UserMdl.accessToken,
              'fields': 'name, email, id',
              'format': 'json'
            }
          }
        ).then(function(result) {
            return {
              'id': result.data.id,
              'username': result.data.name,
              'email': result.data.email
            };
          }, function (httpError) {
            // translate the error
            throw httpError.status + ' : ' + httpError.data;
          }
        );
      },
      '_getFBUserPicture': function() {
        return $http.get(
          API.FACEBOOK.ENDPOINT + 'me/picture',
          {
            params: {
              'access_token': UserMdl.accessToken,
              'redirect': false,
              'type': 'square',
              'height': 200,
              'width': 200,
              'format': 'json'
            }
          }
        ).then(function(result) {
            return {
              'picUrl': result.data.data.url
            };
          }, function (httpError) {
            // translate the error
            throw httpError.status + ' : ' + httpError.data;
          });
      }
    };

  }

})();
