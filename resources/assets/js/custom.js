function getTokenValue() {
    return document.querySelector('#csrf-token').getAttribute('content');
}

$(window).on('load', function() { // makes sure the whole site is loaded
	$('#status').fadeOut(); // will first fade out the loading animation
	$('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website. 
	$('body').delay(350).css({'overflow':'visible'});
})

$('#add-image').on('click', function (e) {
  e.preventDefault();
  $('div#form-body-image').append("<hr><div class='form-group'><label>Name Photo</label><input type='text' name='name[]' required class='form-control'/><label>Image</label><input type='file' name='image[]' required class='form-control'/></div>");
});

