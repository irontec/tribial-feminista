(function() {

  'use strict';

  angular
    .module('tribialfeminista.game')
    .controller('GameCtrl', Game);


  Game.$inject = [
  '$scope',
  '$state',

  '$ionicLoading',
  '$ionicPopup',
  '$ionicModal',

  '$cordovaBackButton',
  '$cordovaMedia',
  '$cordovaDevice',

  'RESOURCES',

  'LangService',
  'shareHelper',

  'GameMdl',
  'UserMdl',
  'RankingMdl'
  ];

  function Game(

    $scope,
    $state,

    $ionicLoading,
    $ionicPopup,
    $ionicModal,

    $cordovaBackButton,
    $cordovaMedia,
    $cordovaDevice,

    RESOURCES,

    LangService,
    shareHelper,

    GameMdl,
    UserMdl,
    RankingMdl) {

    if(!UserMdl.isSaved()) {
      $state.go('login');
    }

    var vm = this;

    vm.platform = $cordovaDevice.getPlatform().toLowerCase();
    vm.locales = LangService.getStateTranslation();
    vm.locales.common = LangService.getCommonTranslation();

    var lang = LangService.getLang();

    var backButtonEnabled = false;

    vm.QuestionPropertyLabel = 'question_' + lang.substring(0,2);
    vm.AnswerPropertyLabel = 'answer_' + lang.substring(0,2);
    var game = new GameMdl();

    $ionicModal.fromTemplateUrl('modal.html', {
        scope: $scope,
        animation: 'slide-in-up',
        focusFirstInput: true
    }).then(function(modal) {
        $scope.modal = modal;
        $scope.hideWithResume = function() {
            modal.hide();
            game.resumeCountDown();
        }
        //$scope.modal.show();
    });


    if(game.isSaved()) {

      $ionicPopup.show({
        template: vm.locales['if_start_when_saved'],
        title: vm.locales['saved_found'],
        subTitle: vm.locales['load_saved_question'],
        scope: $scope,
        buttons: [
          {
            text: '<b>' + vm.locales.common['no'] + '</b>',
            type: 'button-negative',
            onTap: function() {
              return false;
            }
          },
          {
            text: '<b>' + vm.locales.common['yes'] + '</b>',
            type: 'button-positive',
            onTap: function() {
              return true;
            }
          }
        ]
      }).then(function(res) {
        if(res) {
          game.loadFromLocalStorage();
        }
        game.clearLocalStorage();
        init();
      });

    } else {
      init();
    }

    function init() {
      $ionicLoading.show({
        template: '<i class="icon ion-loading-d" style="font-size: 32px"></i>',
        animation: 'fade-in',
        noBackdrop: false
      });
      setTimeout(_init, 1000);
    }

    function _init() {
      game.init(function() {
        attachToVM();
        addBackButton();
        $ionicLoading.hide();
      });
    }

    function attachToVM() {
      vm.selectedAnswer = null;
      vm.getCountDown = function() {
        return game.countDown;
      };

      vm.getCountDownClass = function() {
          if (game.countDown > 16)
          {
              return 'timer-5';
          }

          if (game.countDown > 12)
          {
              return 'timer-4';
          }

          if (game.countDown > 8)
          {
              return 'timer-3';
          }

          if (game.countDown > 4)
          {
              return 'timer-2';
          }

          return 'timer-1';
      };

      vm.question = function() {
        return game.currentQuestion;
      };

      vm.questionCategory = function() {
        return game.currentQuestion.category;
      };

      vm.life = function() {
        return game.life;
      };

      vm.points = function() {
        return Math.floor(game.points);
      };

      vm.maxLife = game.maxLife;

      vm.answers = function() {
        return game.currentQuestion.answers;
      };

      vm.categoryStars = function() {
        return game.categoryStars;
      };

      vm.confirm = confirm;

      vm.gameBackButton = gameBackButton;

      vm.showHelpPopUp = showHelpPopUp;

      vm.isLoaded = true;
    }


    function addBackButton() {

      $cordovaBackButton.clear();
      $cordovaBackButton.addListener('game', function(e) {
        e.preventDefault();
        gameBackButton();
      });
      backButtonEnabled = true;
    }

    function gameBackButton() {
      if(backButtonEnabled) {
        backButtonEnabled = false;
        if($state.is('game')) {
          backDialog();
        }
      }
    }

    function backDialog() {
      game.pauseCountDown();
      $ionicPopup.show({
        template: vm.locales.back_message.template,
        title: vm.locales.back_message.title + '',
        subTitle: vm.locales.back_message.subtitle + '',
        scope: $scope,
        buttons: [
          {
            text: '<b>' + vm.locales.common['no'] + '</b>',
            type: 'button-negative',
            onTap: function() {
              return false;
            }
          },
          {
            text: '<b>' + vm.locales.common['yes'] + '</b>',
            type: 'button-positive',
            onTap: function() {
              return true;
            }
          }
        ]
      }).then(function(res) {
        if(res) {
            game.saveToLocalStorage();
        }
        UserMdl.saveToLocalStorage();
        backButtonEnabled = false;
        $state.go('main');
      });

    }

    function confirm() {
      if(vm.selectedAnswer !== null) {
        game.pauseCountDown();
        backButtonEnabled = false;
        $ionicLoading.show({
          template: '<i class="icon ion-loading-d" style="font-size: 32px"></i>',
          animation: 'fade-in',
          noBackdrop: false
        });
        setTimeout(checkAnswer, 1000);
      }
    }

    function endGame() {
      backButtonEnabled = false;
      game.clearLocalStorage();
      UserMdl.saveToLocalStorage();
      $state.go('main');
    }

    function checkAnswer() {
      var result = game.answer(vm.selectedAnswer);

      vm.selectedAnswer = null;

      var buttonType;
      var popUpButtons;

      if(result.isCorrect) {
        buttonType = 'button-positive';
      } else {
        buttonType = 'button-negative';
      }

      if(result.isGameCompleted) {

        popUpButtons = [{
          text: '<b>' + vm.locales.common['no'] + '</b>',
          type: 'button-negative',
          onTap: function() {
            return false;
          }
        }, {
          text: '<b>' + vm.locales.common['yes'] + '</b>',
          type: 'button-positive',
          onTap: function() {
            return true;
          }
        }];

        playSound(result);

        RankingMdl.setScore(game.points).then(function() {
          $ionicLoading.hide();
          showAnswerPopUp(result, popUpButtons);
        }, function() {
          $ionicLoading.hide();
          showAnswerPopUp(result, popUpButtons);
        });

      } else {
        $ionicLoading.hide();
        popUpButtons = [{
          text: vm.locales.common.confirm,
          type: buttonType
        }];

        playSound(result);
        showAnswerPopUp(result, popUpButtons);
      }

    }

    function playSound(result) {
      var soundPath;

      if(vm.platform === 'android') {
        soundPath = window.location.pathname.replace('index.html', '');


      	if(result.isGameCompleted) {
        	soundPath = soundPath + RESOURCES.SOUNDS.COMPLETED;
      	} else if (result.isGameEnded) {
        	soundPath = soundPath + RESOURCES.SOUNDS.OVER;
      	} else if (result.isCorrect) {
        	soundPath = soundPath + RESOURCES.SOUNDS.SUCCESS;
      	} else {
        	soundPath = soundPath + RESOURCES.SOUNDS.ERROR;
      	}
        
      	$cordovaMedia.newMedia(soundPath).play();

      }
    }

    function showAnswerPopUp(answerResult, popUpButtons) {

      $ionicPopup.alert({
        title: answerResult.popUpContent.popUpTitle,
        template: answerResult.popUpContent.popUpMessage,
        buttons: popUpButtons
      }).then(function(res) {
        if(!answerResult.isGameEnded && !answerResult.isGameCompleted) {
          if(!backButtonEnabled) {
            backButtonEnabled = true;
          }
          game.loadNewQuestion();

        } else {

          if(answerResult.isGameCompleted) {
            if(res) {
              showSharePopUp(answerResult.shareContent);
            } else {
              endGame();
            }
          } else {
            endGame();
          }
        }
      });

    }

    function showHelpPopUp() {
        game.pauseCountDown();
        console.log("Show Pop up");
        $scope.modal.show();
    }

    function showSharePopUp(shareContent) {
      $ionicPopup.alert({
        title: vm.locales['share_dialog'],
        buttons: [{
          text: '<i class="ion-social-twitter"></i>',
          type: 'button-tw',
          onTap: function() {
            return 'twitter';
          }
        }, {
          text: '<i class="ion-social-facebook"></i>',
          type: 'button-fb',
          onTap: function() {
            return 'facebook';
          }
        }, {
          text: '<i class="ion-android-close"></i>',
          type: 'button-negative',
          onTap: function() {
            return false;
          }
        }]
      }).then(function(res) {
        console.log(res);
        console.log(shareContent);
        if(res) {
          shareHelper.socialShare(shareContent, res, onShareSuccess, onShareError);
        } else {
          endGame();
        }
      });
    }

    function onShareSuccess() {
      if(!backButtonEnabled) {
        backButtonEnabled = true;
      }
      UserMdl.hasShareBonus = true;
      endGame();
    }

    function onShareError(shareError) {
      $ionicPopup.alert({
        title: vm.locales['share_error']
      });
      if(!backButtonEnabled) {
        backButtonEnabled = true;
      }
      console.log(shareError);
      UserMdl.hasShareBonus = true;
      console.log("Miksefrawerel: " + UserMdl.hasShareBonus);
      endGame();
    }
  }

})();
