function adjustMediaHeight() {
  // Adjusts the height of media elements based on the height of the associated text content
  var textHeight = jQuery('.wp-block-media-text__content').outerHeight();
  jQuery('.media-text-centered-box .wp-block-media-text__media').css('height', textHeight + 'px');
  jQuery('.media-text-overlap-box .wp-block-media-text__media').css('height', (textHeight + 110) + 'px');
}

function changeMenuClass() {
  var menu = jQuery('#menu-primary-nav');
  if (window.innerWidth <= 1100) {
    menu.addClass('mobile-menu-primary-nav');
    menu.removeClass('primary-menu');
  } else {
    menu.addClass('primary-menu');
    menu.removeClass('mobile-menu-primary-nav');
  }
}

jQuery(document).ready(function ($) {
  // Executes when the document is fully loaded and ready to be manipulated
  changeMenuClass(); // Changes menu class to disable all hover states on the menu
  adjustMediaHeight(); // Calls the adjustMediaHeight function to initially adjust the media height

  // Adds an additional option in the contact form 7 contact us form select box
  var selectBox = $('#extraField');
  selectBox.prepend('<option value="" selected disabled>Please select an item</option>');
  selectBox.val('');

  selectBox.on('change', function() {
    // Adds a class to the select box when its value is changed
    selectBox.addClass('interacted');
  });

  $("#search-form-container").click(function(event) {
    if (event.target.id === "search-form-container") {
      $(this).toggle();
    }
  });

  // Allows the contact form 7 form to have a visual button that triggers the file input element
  $('.custom-upload-wrapper label').on('click', function() {
    // Triggers a click event on the hidden file input element when the label is clicked
    $('#uploadImage').trigger('click');
  });

  $(".hamburger").click(function () {
    // Toggles the "is-active" class on the header-bottom-container element and the "is-hidden" class on the html and body elements when the hamburger element is clicked
    $(".header-bottom-container").toggleClass("is-active");
    $("html, body").toggleClass("is-hidden");
  });
  $(".sub-menu-link").click(function () {
    // Toggles the "is-active" class on the clicked sub-menu-link element and the "is-active" class on its next sibling element when the sub-menu-link is clicked
    $(this).toggleClass("is-active");
    $(this).next().toggleClass("is-active");
  });

  $('.play-btn').click(function() {
    // Toggles the "hidden" class on the play-btn and video-poster elements when the play-btn element is clicked
    $(".play-btn").toggleClass("hidden");
    $(".video-poster").toggleClass("hidden");
  });

  $('#search-icon').click(function(e) {
    // Prevents the default click behavior and toggles the visibility of the search-form-container element when the search-icon element is clicked
    e.preventDefault();
    $('#search-form-container').toggle();
  });

  $(".play-btn-container").click(function() {
    $(".video-popup").toggle();
  });

  $(".video-popup .close-btn").click(function() {
    $(".video-popup").hide();
  });

  $(".submenu-open").click(function() {
    $(this).siblings(".sub-menu").css("left", "0%");
  });
});

jQuery(window).resize(function($) {
  // Executes when the window is resized
  changeMenuClass(); // Changes menu class to disable all hover states on the menu
  adjustMediaHeight(); // Calls the adjustMediaHeight function to readjust the media height
});