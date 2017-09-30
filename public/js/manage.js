$(document).ready( function() {
    $('.add-form').focus( function() {
        $('#add-message').text('');
    });

    $('#promo-form').focus( function() {
        $('#promo-message').text('');
    });
});