var SpeechRecognition = window.webkitSpeechRecognition;
  
var recognition2 = new SpeechRecognition();

var Textbox2 = $('.type');

var Content2 = '';

recognition2.continuous = true;

recognition2.onresult = function(event) {

  var current = event.resultIndex;

  var transcript = event.results[current][0].transcript;
    Content2 += transcript;
    Textbox2.val(Content2);
  
};

recognition2.onstart = function() { 
}

recognition2.onspeechend = function() {
}


$('.btn-start-2').on('click', function(e) {
  if (Content2.length) {
    Content2 += ' ';
  }
  recognition2.start();
});
$('.btn-stop-2').on('click', function(e) {
  if (Content2.length) {
    Content2 += ' ';
  }
  recognition2.stop();
});

Textbox2.on('input', function() {
  Content2 = $(this).val();
})