(function() {

  'use strict';

  var TRANSLATIONS = {
    'es-ES': {
      '_common': {
        'connection_error': 'No hay conexión a Internet',
        'lang': 'Castellano',
        'back': 'Volver',
        'next': 'Siguiente',
        'previous': 'Anterior',
        'start': 'Comenzar',
        'confirm': 'Confirmar',
        'yes': 'Si',
        'no': 'No',
        'loading': 'Cargando...',
      },
      'intro': {
        'text1': '¡Responde a las preguntas!',
        'text2': 'Gana estrellas de Categoría',
        'text3': 'Comparte tu puntuación y hazte un hueco en el top 20!',
        'skip_intro': 'Saltar Tutorial'
      },
      'login': {
        'title': 'Acceder',
        'twitter_btn': 'Conéctate con Twitter',
        'fb_btn': 'Conéctate con Facebook',
        'authentication_error': 'Error iniciando sesión, por favor inténtelo de nuevo.'
      },
      'main':{
        'title': 'Tribial Feminista',
        'play': 'Jugar',
        'ranking': 'Ranking',
        'settings': 'Ajustes',
        'tutorial': 'Tutorial',
        'about': 'Acerca de'
      },
      'ranking': {
        'title': 'Ranking',
        'refresh': 'Pull para refrescar',
        'ranking_empty': 'Aún no hay puntuaciones'
      },
      'game': {
        'title': 'Tribial Feminista',
        'score': 'Puntuación:',
        'saved_found': 'Tienes una partida guardada',
        'load_saved_question': '¿Quieres continuarla?',
        'if_start_when_saved': 'Si comienzas una nueva partida perderás tu partida guardada',
        'answer_true': '¡Respuesta Correcta!',
        'answer_true_points_zero': '¡Fuera de tiempo!',
        'answer_false': '¡Respuesta Incorrecta!',
        'star_adquired': '',
        'game_completed': '¡Has completado el juego!',
        'game_ended': '¡Has perdido!',
        'fail': 'A ver si aciertas la siguiente',
        'points_obtained': 'Has obtenido ',
        'answered_out_of_time': 'Has contestado bien, pero fuera de tiempo. No pierdes ninguna vida, ni ganas puntos.',
        'points': 'puntos',
        'and': 'y',
        'share_on_end': '¿Quieres compartir tu puntuación? Cada vez que compartas tu puntuación, ganarás una vida extra.',
        'share_dialog': 'Compartir con...',
        'share_error': 'Aplicación no instalada',
        'help': 'Ayuda',
        'achieved': 'Conseguido',
        'not_achieved': 'No conseguido',
        'live': 'Vida',
        'live_empty': 'Vida perdida',
        'live_extra': 'Vida extra',
        'wedges': 'Piezas',
        'categories': 'Categorias',
        'lives': 'Vidas',
        'no_time': '¡Tiempo agotado!',

        'category_names': {
          'e': 'Espectáculos',
          'h': 'Historia',
          'd': 'Deportes',
          'g': 'Geografía',
          'a': 'Arte y Literatura',
          'c': 'Ciencia'
        },
        'back_message': {
          'template': 'Podrás continuar más tarde',
          'title': 'Salir',
          'subtitle': '¿Guardar tu partida actual?'
        },
        'shared_message': {
          'title': 'Prueba la app',
          'message': [
            'He obtenido',
            'ptos jugando a Tribial Feminista'
          ]
        }
      },
      'settings': {
        'title': 'Ajustes',
        'close_session': 'Cerrar Sesión',
        'checkForUpdates': 'Actualizar Preguntas',
        'packagesUpdated': 'Preguntas Actualizadas'
      },
      'about': {
        'title': 'Acerca De'
	  }
    },
 	'eu-EU': {
      '_common': {
        'connection_error': 'Ez dago Internetik',
        'lang': 'Euskera',
        'back': 'Atzera',
        'next': 'Aurrera',
        'previous': 'Aurrekoa',
        'start': 'Hasi',
        'confirm': 'Jarraitu',
        'yes': 'Bai',
        'no': 'Ez',
        'loading': 'Kargatzen...'
      },
      'intro': {
        'text1': 'Erantzun Galderak!',
        'text2': 'Irabazi kategoria izarrak',
        'text3': 'Partekatu zure puntuazioa eta top 20 hutsak bihurtu!',
        'skip_intro': 'Laguntza saltatu'
      },
      'login': {
        'title': 'Sartu',
        'twitter_btn': 'Twitter bidez konektatu',
        'fb_btn': 'Facebook bidez konektatu',
        'authentication_error': 'Errorea gertatu da, saiatu berriz.'
      },
      'main':{
        'title': 'Tribial Feminista',
        'play': 'Jolastu',
        'ranking': 'Rankinga',
        'settings': 'Konfigurazioa',
        'tutorial': 'Laguntza',
        'about': 'Honi buruz'
      },
      'ranking': {
        'title': 'Rankinga',
        'refresh': 'Pull eguneratzeko',
        'ranking_empty': 'Oraindik ez dago puntuaketarik'
      },
      'game': {
        'title': 'Tribial Feminista',
        'score': 'Puntuazioa:',
        'saved_found': 'Joko bat gordeta daukazu',
        'load_saved_question': 'Jarraitu nahi duzu?',
        'if_start_when_saved': 'Gordeta daukazun jokoa galduko duzu joko berri bat hasten baduzu',
        'answer_true': 'Oso ondo!',
        'answer_true_points_zero': 'Denbora agortuta dago!',
        'answer_false': 'Huts egin duzu!',
        'star_adquired': '',
        'game_completed': 'Jokua amaitu duzu!',
        'game_ended': 'Galdu duzu!',
        'fail': 'Ea hurrengoa asmatzen duzun!',
        'points_obtained': ' puntu irabazi dituzu.',
        'answered_out_of_time': 'Ongi erantzun duzu, baina denboraz kanpo. Ez duzu punturik irabazi, ezta bizirik galdu ere.',
        'points': 'puntu',
        'and': 'eta',
        'share_on_end': 'Puntuaketa banatu nahi duzu? Banatzen duzun bakoitzean bihotz gehigarri bat lortuko duzu.',
        'share_dialog': 'Banatu',
        'share_error': 'Aplikazioa instalatu barik',
        'help': 'Laguntza',
        'achieved': 'Lortuta',
        'not_achieved': 'Faltan',
        'live': 'Bizia',
        'live_empty': 'Galdutako bizia',
        'live_extra': 'Bizi gehigarria',
        'wedges': 'Piezak',
        'categories': 'Kategoriak',
        'lives': 'Biziak',
        'no_time': 'Denbora agortuta!',

        'category_names': {
          'e': 'Ikuskizunak',
          'h': 'Historia',
          'd': 'Kirolak',
          'g': 'Geografia',
          'a': 'Arte eta Literatura',
          'c': 'Zientzia'
        },
        'back_message': {
          'template': 'Aurrerago jarraitu ahal duzu',
          'title': 'Irten',
          'subtitle': 'Jokoa gorde?'
        },
        'shared_message': {
          'title': 'Aplikazioa frogatu',
          'message': [
            'Tribial feminista: ',
            'puntu lortu ditut jolasten'
          ]
        }
      },
      'settings': {
        'title': 'Konfigurazioa',
        'close_session': 'Saioa itxi',
        'checkForUpdates': 'Galderak eguneratu',
        'packagesUpdated': 'Galderak eguneratu dira'
      },
      'about': {
        'title': 'Honi buruz'
      }
    }
  };

  angular
    .module('tribialfeminista.core')
    .constant('TRANSLATIONS', TRANSLATIONS);

})();
