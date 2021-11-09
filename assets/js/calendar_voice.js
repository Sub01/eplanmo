var SpeechRecognition = window.webkitSpeechRecognition;
  
var recognition = new SpeechRecognition();

var Textbox = $('.title');

var Content = '';

recognition.continuous = true;

recognition.onresult = function(event) {

  var current = event.resultIndex;

  var transcript = event.results[current][0].transcript;
    Content += transcript;
    Textbox.val(Content);
  
};

recognition.onstart = function() { 
}

recognition.onspeechend = function() {
}


$('.btn-start').on('click', function(e) {
  if (Content.length) {
    Content += ' ';
  }
  recognition.start();
});
$('.btn-stop').on('click', function(e) {
  if (Content.length) {
    Content += ' ';
  }
  recognition.stop();
});

Textbox.on('input', function() {
  Content = $(this).val();
})