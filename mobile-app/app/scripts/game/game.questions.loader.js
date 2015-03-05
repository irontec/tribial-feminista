(function() {

  'use strict';

  angular
    .module('tribialfeminista.game')
    .factory('GameQuestionsLdr', GameQuestionsLdr);

  GameQuestionsLdr.$inject = ['$http', '$q', 'underscore', 'API', 'RESOURCES', 'GameQuestionsMdl'];

  function GameQuestionsLdr($http, $q, underscore,  API, RESOURCES,  GameQuestionsMdl) {

    function QuestionsLoader() {
      this._collection = [];
      this._loadedPackages = [];
    }

    QuestionsLoader.prototype.init = function(callback) {
      this.loadInitialQuestions(function() {
        callback();
      });
    };

    QuestionsLoader.prototype.addToCollection = function(packageQuestions) {

      var newQuestions = {};

      underscore.each(packageQuestions, function(question, index) {
        if(question.checked) {
          newQuestions[index] = new GameQuestionsMdl(question);
        }
      });

      if(this._collection.length > 0) {
        this._collection = underscore.union(this._collection, newQuestions);
      } else {
        this._collection = newQuestions;
      }
    };

    // Loads the initial questions from JSON FILE or LOCAL STORAGE
    QuestionsLoader.prototype.loadInitialQuestions = function(callback) {
      var self = this;
      if(this.isSaved()) {
        this.loadFromLocalStorage();
        callback();
      } else {
        this.loadLocalPackage().then(function(result) {

          self.addToCollection(result.data);
          self._loadedPackages.push('0');
          self.saveToLocalStorage();
          callback();
        }, function(err) {
          console.log(err);
          callback();
        });
      }
    };

    QuestionsLoader.prototype.checkMissingPackages = function() {

      var self = this;

      self.loadFromLocalStorage(); // Ensure we have loaded the local data

      return $http
        .get(API.ENDPOINT + 'packages')
        .then(function(result) {

          var allPackages = result.data.content.collection;
          var missingPackages = [];

          underscore.each(allPackages, function(packageItem) {
            if(packageItem.code !== 'default') {
              if(!underscore.contains(self._loadedPackages, packageItem.id)) {
                missingPackages.push(packageItem.id);
              }
            }
          });
          return missingPackages;
        }, function(err) {
          return err;
        });
    };

    QuestionsLoader.prototype.getPackages = function(packagesList) {
        console.log(JSON.stringify(packagesList));

      var self = this;

      var deferred = $q.defer();

      var asyncMethods = [];

      underscore.each(packagesList, function(packageId) {
        asyncMethods.push(self.getPackageFromServer(packageId));
      });

      $q.all(asyncMethods)
      .then(
        function(results) {
            console.log(JSON.stringify(results));
          underscore.each(results, function(packageQuestions) {
            self.addToCollection(packageQuestions);
          });
          deferred.resolve(results);
        },
        function(errors) {
          deferred.reject(errors);
        }
      );
      return deferred.promise;
    };

    // Loads package from the REST API
    QuestionsLoader.prototype.getPackageFromServer = function(packageId) {

      return $http.get(API.ENDPOINT + 'packages/' + packageId)
        .then(function(result) {
          var packageQuestions = result.data.content.collection;
          return packageQuestions;
        }, function (httpError) {
          // translate the error
          throw httpError.status + ' : ' + httpError.data;
        });

      //this._collection.push[data];
      //this.loadedPackages.push('default');
    };

    // Loads package from JSON File
    QuestionsLoader.prototype.loadLocalPackage = function() {
      return $http.get(RESOURCES.PACKAGE)
        .then(function(result) {
          return result;
        }, function (httpError) {
          // translate the error
          throw httpError.status + ' : ' + httpError.data;
        });
    };

    QuestionsLoader.prototype.isSaved = function() {
      return JSON.parse(localStorage.getItem('questions.isSaved')) === true;
    };

    // Loads package from LocalStorage
    QuestionsLoader.prototype.loadFromLocalStorage = function() {

      this._collection = JSON.parse(localStorage.getItem('questions.collection'));
      if(this._collection === null) {
        this._collection = [];
      }
      this._loadedPackages = JSON.parse(localStorage.getItem('questions.loadedPackages'));
      if(this._loadedPackages === null) {
        this._loadedPackages = [];
      }
    };

    QuestionsLoader.prototype.saveToLocalStorage = function() {
      localStorage.setItem('questions.collection',JSON.stringify(this._collection));
      localStorage.setItem('questions.loadedPackages', JSON.stringify(this._loadedPackages));

      localStorage.setItem('questions.isSaved', JSON.stringify(true));
    };

    QuestionsLoader.prototype.clearFromLocalStorage = function() {
      localStorage.removeItem('questions.collection');
      localStorage.removeItem('questions.loadedPackages');

      localStorage.removeItem('questions.isSaved');
    };


    return new QuestionsLoader();



  }

})();
