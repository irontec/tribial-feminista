(function() {

  'use strict';

  angular
  .module('tribialfeminista.game')
  .factory('GameQuestionsMdl', GameQuestionsMdl);

  function GameQuestionsMdl() {


    function Question(item) {
      this.id = item.id;
      this.packageId = item.packageId;
      this.category = item.category;
      this.question_es = item.question_es;
      this.question_eu = item.question_eu;

      this.answers = [
        {
          answerId: 0,
          answer_es: item.answer_es,
          answer_eu: item.answer_eu
        },
        {
          answerId: 1,
          answer_es: item.falseAnswer1_es,
          answer_eu: item.falseAnswer1_eu
        },
        {
          answerId: 2,
          answer_es: item.falseAnswer2_es,
          answer_eu: item.falseAnswer2_eu
        },
        {
          answerId: 3,
          answer_es: item.falseAnswer3_es,
          answer_eu: item.falseAnswer3_eu
        }
      ];

      this.trueAnswer = 0;
    }

    return Question;

  }

})();
