(function() {

  'use strict';

  angular
    .module('tribialfeminista.game')
    .factory('GameQuestionsMngr', GameQuestionsMngr);

  GameQuestionsMngr.$inject = ['underscore', 'GameQuestionsLdr'];

  function GameQuestionsMngr(underscore, GameQuestionsLdr) {

    function QuestionsManager() {
      this.questions = [];
    }

    QuestionsManager.prototype.init = function(callback) {
      var self = this;
      GameQuestionsLdr.init(function() {
        self.questions = GameQuestionsLdr._collection;
        callback();
      });
    };

    QuestionsManager.prototype.getNewQuestion = function(doneQuestions) {
      var randomQuestion = this._getRandomQuestion();
      if(doneQuestions.length < this.questions.length) {
        if(underscore.contains(doneQuestions, randomQuestion.id)) {
          return this.getNewQuestion(doneQuestions);
        }
      }

      return randomQuestion;
    };

    QuestionsManager.prototype._getRandomQuestion = function() {
      var result, count = 0;
      underscore.each(this.questions, function(question) {
        if (Math.random() < 1/++count) {
          result = question;
        }
      });
      return result;
    };

    QuestionsManager.prototype.getQuestionCategory = function(questionId) {
      var question = underscore.find(this.questions, function(question) {
        return question.id === questionId;
      });
      return question.category;
    };

    QuestionsManager.prototype.checkAnswer = function(questionId, answerId) {
      var question = underscore.find(this.questions, function(question) {
        return question.id === questionId;
      });
      return question.trueAnswer === answerId;
    };

    QuestionsManager.prototype.checkUpdates = function(callback) {

      GameQuestionsLdr.checkMissingPackages().then(function(missingPackages) {

        GameQuestionsLdr.getPackages(missingPackages).then(function(result) {
          _.each(missingPackages, function(packageItem) {
            GameQuestionsLdr._loadedPackages.push(packageItem);
            GameQuestionsLdr.saveToLocalStorage();
          });
          callback(null, result);
        }, function(err) {
          console.log(JSON.stringify(err));
          callback(err, null);
        });

      }, function(err) {
        console.log(JSON.stringify(err));
        callback(err, null);
      });
    };

    return new QuestionsManager();

  }

})();
