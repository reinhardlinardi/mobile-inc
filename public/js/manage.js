$(document).ready( function() {
    console.log('ready');

    $('#add-form').focus( function() {
        $('#add-message').text('');
    });
});