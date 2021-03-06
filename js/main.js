/*
$( "td" ).on( "a.copytoclipboard", "click", function() {
  console.log(this);
});
*/

function copyTextToClipboard(text, el, ev) {
  ev.preventDefault();
  var textArea = document.createElement("textarea");
  textArea.style.position = 'fixed';
  textArea.style.top = 0;
  textArea.style.left = 0;
  textArea.style.width = '2em';
  textArea.style.height = '2em';
  textArea.style.padding = 0;
  textArea.style.border = 'none';
  textArea.style.outline = 'none';
  textArea.style.boxShadow = 'none';
  textArea.style.background = 'transparent';
  textArea.value = text;

  document.body.appendChild(textArea);
  textArea.focus();
  textArea.select();

  try {
    var successful = document.execCommand('copy');
    var msg = successful ? 'successful' : 'unsuccessful';
    console.log('Copying text command was ' + msg);
    el.classList.add("done");
  } catch (err) {
    alert("Die URL konnte nicht in die Zwischenablage kopiert werden.");
    console.log('Oops, unable to copy');
  }

  document.body.removeChild(textArea);
} 