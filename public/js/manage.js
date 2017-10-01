$(document).ready( function() {
    $('.add-form').focus( function() {
        $('#add-message').text('');
    });

    $('#promo-form').focus( function() {
        $('#promo-message').text('');
    });

    $('#mark-form').focus( function() {
        $('#mark-message').text('');
    });

    $('#confirmation-btn').hover( function() {
        $('#confirmation-message').text('');
    });
});