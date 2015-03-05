(function() {

  'use strict';

  angular
    .module('tribialfeminista.game')
    .factory('GameMdl', GameMdl);

  GameMdl.$inject = [
    'underscore',

    '$cordovaDevice',

    'APP_LINKS',

    'safeApply',
    'LangService',

    'GameQuestionsMngr',


    'RankingMdl',
    'UserMdl'
  ];

  function GameMdl(
    underscore,

    $cordovaDevice,

    APP_LINKS,

    safeApply,
    LangService,

    GameQuestionsMngr,

    RankingMdl,
    UserMdl
  ) {

    var QUESTIONS_FOR_STAR = 1;
    var POINTS_BY_QUESTION = 1000;
    var POINTS_BY_SECOND = 50;
    var CATEGORY_NUMBER = 6;
    var LIFE_BY_ERROR = 1;
    var MAX_LIFE = 5;
    var USER_SHARE_BONUS_LIFE = 1;

    var platform = $cordovaDevice.getPlatform().toLowerCase();

    var translations = LangService.getStateTranslation('game');

    function Game() {

      this.answeredQuestions = [];
      this.successQuestions = {
        'e': 0,
        'h': 0,
        'd': 0,
        'g': 0,
        'a': 0,
        'c': 0
      };
      this.categoryStars = {
        'e': false,
        'h': false,
        'd': false,
        'g': false,
        'a': false,
        'c': false
      };

      this.points = 0;
      this.answerPoints = 0;
      this.countDown = POINTS_BY_QUESTION/POINTS_BY_SECOND;

      this.maxLife = MAX_LIFE;

      if (UserMdl.hasShareBonus) {
        this.maxLife = this.maxLife + USER_SHARE_BONUS_LIFE;
        UserMdl.hasShareBonus = false;
      }
      this.life = this.maxLife;

      this.time = 1;

    }

    Game.prototype.init = function(callback) {
      var self = this;
      GameQuestionsMngr.init(function() {
        self.currentQuestion =  GameQuestionsMngr.getNewQuestion(self.answeredQuestions);
        safeApply();
        self.counter = setTimeout(function() {
          self._tick();
        }, 1000);

        callback();
      });



    };

    Game.prototype._tick = function() {
      var self = this;
      self.time++;
      if(self.countDown > 0) {
        self.countDown--;
      }
      safeApply();
      self.counter = setTimeout(function() {
        self._tick();
      }, 1000);
    };

    Game.prototype.answer = function(answerId) {
      var questionId = this.currentQuestion.id;
      this.answeredQuestions.push(questionId);
      var isCorrect = GameQuestionsMngr.checkAnswer(questionId, answerId);

      var result = {
        'isCorrect': isCorrect,
        'isGameCompleted': false,
        'isGameEnded': false,
        'popUpContent': {
          'popUpTitle': '',
          'popUpMessage': ''
        }
      };

      if(isCorrect) {

        var category = GameQuestionsMngr.getQuestionCategory(questionId);
        this._answerSuccess(category);

        if(this._isGameCompleted()) {
          result.isGameCompleted = true;
          result.popUpContent = this._getPopUpContent('game_completed');
          result.shareContent = this._getShareContent();
        } else {
            if (this._checkAnsweredOnTime())
            {
                if(this._checkStarAdquired(category)) {
                  result.popUpContent = this._getPopUpContent('star_adquired', category);
                } else {
                  result.popUpContent = this._getPopUpContent('answer_true');
                }
            } else {
                result.popUpContent = this._getPopUpContent('answer_true_points_zero');
            }

        }

      } else {

        this._answerError();

        if(this._isGameEnded()) {
          result.isGameEnded = true;
          result.popUpContent = this._getPopUpContent('game_ended');
        } else {
          result.popUpContent = this._getPopUpContent('answer_false');
        }

      }

      return result;
    };

    Game.prototype._answerSuccess = function(category) {
      this.successQuestions[category]++;
      this._addPoints();
    };

    Game.prototype._answerError = function(){
      this.life = this.life - LIFE_BY_ERROR;
    };

    Game.prototype.loadNewQuestion = function() {
      this.currentQuestion = GameQuestionsMngr.getNewQuestion(this.answeredQuestions);
      this.currentQuestion.answers = _.shuffle(this.currentQuestion.answers);
      this._restartCounter();
    };

    Game.prototype._addPoints = function() {
      var pointsToRest = POINTS_BY_SECOND*this.time;
      if(pointsToRest <= POINTS_BY_QUESTION) {
        this.answerPoints = POINTS_BY_QUESTION - pointsToRest;
        this.points = this.points + this.answerPoints;
      } else {
        this.answerPoints = 0;
      }
    };

    Game.prototype._isGameEnded = function() {
      return this.life <= 0;
    };

    Game.prototype._isGameCompleted = function() {
      var starsNumber = 0;
      underscore.forEach(this.successQuestions, function(successNumber) {
        if(successNumber >= QUESTIONS_FOR_STAR) {
          starsNumber++;
        }
      });
      return starsNumber === CATEGORY_NUMBER;
    };

    Game.prototype._checkAnsweredOnTime = function() {
        return (this.countDown > 0);
    };

    Game.prototype._checkStarAdquired = function(category) {
      if(this.successQuestions[category] === QUESTIONS_FOR_STAR) {
        this.categoryStars[category] = true;
        return this.categoryStars[category];
      }
      return false;
    };

    Game.prototype._restartCounter = function() {
      var self = this;
      clearTimeout(self.counter);
      this.time = 1;
      this.countDown = POINTS_BY_QUESTION/POINTS_BY_SECOND;
      self.counter = setTimeout(function() {
        self._tick();
      }, 1000);
    };

    Game.prototype._getPopUpContent = function(popUpType, popUpParam) {

      if(popUpType === 'game_completed') {
        return {
          'popUpTitle': translations[popUpType],
          'popUpMessage': '<i class="congrats-icon ion-trophy"></i><p class="congrats-share">'+translations['share_on_end']
        };
      }

      if(popUpType === 'game_ended') {
        return {
          'popUpTitle': translations[popUpType],
          'popUpMessage': ''
        };
      }

      if(popUpType === 'star_adquired') {
        return {
          'popUpTitle': translations['answer_true'],
          'popUpMessage': '<i class="congrats-icon ion-female star-'+popUpParam+' active"></i><p class="congrats-text"><strong1;//>' +
                            translations['category_names'][popUpParam] + '</strong> ' +
                            translations['and'] + ' <strong>' + this.answerPoints + '</strong> ' + translations['points_obtained'] + '</p>'
        };
      }

      if(popUpType === 'answer_true') {
        return {
          'popUpTitle': translations[popUpType],
          'popUpMessage': '<i class="congrats-icon ion-happy-outline"></i><p class="congrats-share">'+
                          '<strong>' + this.answerPoints + '</strong> ' + translations['points_obtained']
        };
      }

      if(popUpType === 'answer_true_points_zero') {
        return {
          'popUpTitle': translations[popUpType],
          'popUpMessage': '<i class="congrats-icon ion-thumbsup"></i><p class="congrats-share">'+
                            translations['answered_out_of_time'] + '</p>'
        };
      }

      if(popUpType === 'answer_false') {
        return {
          'popUpTitle': translations[popUpType],
          'popUpMessage': '<i class="congrats-icon ion-sad-outline"></i><p class="congrats-share">'+translations['fail']
        };
      }
    };

    Game.prototype._getShareContent = function() {
      return {
        'title': translations['shared_message']['title'],
        'msg': translations['shared_message']['message'][0] + ' ' +
               this.points + ' ' +
               translations['shared_message']['message'][1],
        'url': APP_LINKS[platform]
      };
    };

    Game.prototype.isSaved = function() {
      return JSON.parse(localStorage.getItem('game.isSaved')) === true;
    };

    Game.prototype.saveToLocalStorage = function() {
      localStorage.setItem('game.successQuestions', JSON.stringify(this.successQuestions));
      localStorage.setItem('game.categoryStars', JSON.stringify(this.categoryStars));
      localStorage.setItem('game.answeredQuestions', JSON.stringify(this.answeredQuestions));
      localStorage.setItem('game.points', JSON.stringify(this.points));
      localStorage.setItem('game.life', JSON.stringify(this.life));
      localStorage.setItem('game.maxLife', JSON.stringify(this.maxLife));
      localStorage.setItem('game.currentQuestion', JSON.stringify(this.currentQuestion));
      localStorage.setItem('game.time', JSON.stringify(this.time));
      localStorage.setItem('game.isSaved', JSON.stringify(true));
    };

    Game.prototype.loadFromLocalStorage = function() {
      this.successQuestions = JSON.parse(localStorage.getItem('game.successQuestions'));
      this.categoryStars = JSON.parse(localStorage.getItem('game.categoryStars'));
      this.answeredQuestions = JSON.parse(localStorage.getItem('game.answeredQuestions'));
      this.points = JSON.parse(localStorage.getItem('game.points'));
      this.life = JSON.parse(localStorage.getItem('game.life'));
      this.maxLife = JSON.parse(localStorage.getItem('game.maxLife'));
      this.currentQuestion = JSON.parse(localStorage.getItem('game.currentQuestion'));
      this.time = JSON.parse(localStorage.getItem('game.time'));
    };

    Game.prototype.clearLocalStorage = function() {
      localStorage.removeItem('game.successQuestions');
      localStorage.removeItem('game.categoryStars');
      localStorage.removeItem('game.answeredQuestions');
      localStorage.removeItem('game.points');
      localStorage.removeItem('game.life');
      localStorage.removeItem('game.maxLife');
      localStorage.removeItem('game.currentQuestion');
      localStorage.removeItem('game.time');
      localStorage.removeItem('game.isSaved');
    };

    Game.prototype.pauseCountDown = function() {
        clearTimeout(this.counter);

    };

    Game.prototype.resumeCountDown = function() {
        var self = this;
        this.counter = setTimeout(function() {
          self._tick();
        }, 1000);
    }

    return Game;

  }

})();
