(function() {

  'use strict';

  angular
    .module('tribialfeminista.ranking')
    .factory('RankingMdl', RankingMdl);

  RankingMdl.$inject = ['UserMdl', '$http', 'API'];

  function RankingMdl(UserMdl, $http, API) {

    function Ranking() {
      this.scores = [];
    }

    Ranking.prototype.getAllFromApi = function() {
      var self = this;

      return $http.get(API.ENDPOINT + 'scores')
      .then(function(result) {
        self.scores = result.data.content.collection;
        return result.data.content.collection;
      }, function (httpError) {
        // translate the error
        throw httpError.status + ' : ' + httpError.data;
      });

    };

    Ranking.prototype.setScore = function(points) {

      var postParams = {
        'userId': UserMdl.id,
        'score': points
      };

      return $http.post(API.ENDPOINT + 'scores', postParams)
      .then(function(result) {
        return result;
      }, function(err) {
        return err;
      });
    };

    return new Ranking();
  }

})();
