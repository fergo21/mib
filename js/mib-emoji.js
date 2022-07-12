$(document).ready(function(){
  // // Initializes and creates emoji set from sprite sheet
  // window.emojiPicker = new EmojiPicker({
  //   emojiable_selector: '[data-emojiable=true]',
  //   assetsPath: 'http://onesignal.github.io/emoji-picker/lib/img/',
  //   popupButtonClasses: 'fa fa-smile-o'
  // });
  // // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
  // // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
  // // It can be called as many times as necessary; previously converted input fields will not be converted again
  // window.emojiPicker.discover();
  let emoji = "";
  let inputEmoj = $("[data-emoji='emoji']").parent();
  inputEmoj.addClass("inputEmoji");
  inputEmoj.append('<i class="material-icons">sentiment_satisfied</i>');
  $.getJSON(homeUrl + "/json/emoji.json", function(json){
    emoji += `<div id="emojis">`;
    for (var clave in json){
      // Controlando que json realmente tenga esa propiedad
      if (json.hasOwnProperty(clave)) {
        // Mostrando en pantalla la clave junto a su valor
        // console.log("La clave es " + clave+ " y el valor es " + json[clave].code_decimal);
        emoji += `<span data-name="${clave}">${json[clave].code_decimal}</span>`;
      }
    }
    emoji += `</div>`;
    inputEmoj.after(emoji);
    $("#emojis").on('click', 'span', function() {
      let emojiSelected = $(this).text();
      $("[data-emoji='emoji']").val(function(){
        return this.value + emojiSelected;
      });
    });
  });

  $(".inputEmoji").on('click', 'i', function(){
      if($("#emojis:hidden").length > 0){
        $("#emojis").css("display","flex");
      }else{
        $("#emojis").css("display","none");
      }
  });


});