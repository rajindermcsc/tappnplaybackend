function previewpic(input) {
   if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(event) {
         $(input).parents('.form-group').find('.preview').attr('src', event.target.result);
      }
      reader.readAsDataURL(input.files[0]);
   }
}