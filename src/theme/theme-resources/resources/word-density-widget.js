// word-density-widget.js
// ---------------------------


// noinspection ES6ConvertVarToLetConst, UnnecessaryLocalVariableJS, UnnecessaryLocalVariableJS
if(typeof WordDensityWidget === 'undefined' || WordDensityWidget === null || WordDensityWidget === false){
    // noinspection JSUnusedAssignment,ES6ConvertVarToLetConst
    var WordDensityWidget = {};
}


// Construct
WordDensityWidget.construct = function(){
    let self = WordDensityWidget;

    // Listen for events
    self.listen();
}


// Listen
WordDensityWidget.listen = function(){
    let self = WordDensityWidget;

    // Events on button click
    Ox.Event.delegate('[data-click-event="word-density-ui >>> add-url"]', 'click', self.handleOnClickAddNewUrlButton);
}


// Handle On Click "Add New Url" Button
WordDensityWidget.handleOnClickAddNewUrlButton = function(element, event){
    let self    = WordDensityWidget;
    let new_url = '';

    Swal.fire({
        heightAuto: false,
        html:  'Type-in / Copy-paste URL',
        icon: '',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off'
        },
        preConfirm: (given_input) => {
            let is_url = self.isValidHttpUrl(given_input);

            if(is_url){
                new_url = given_input;
                return true;
            }
            else{
                Swal.showValidationMessage('Input must be a URL, with http:// or https://');
                return false;
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {

            let fields = {
                new_url : new_url
            }

            // Make an ajax request
            let jqxhr = $.post( "/ajax/add-new-url", fields, function() {
                // Do nothing for now
            }).done(function(data) {
                let message_status = data.hasOwnProperty('message_status') ? data.message_status : 'error';
                let is_message_success = message_status === 'success';
                let action_status = data.hasOwnProperty('action_status') ? data.action_status : 'error';
                let is_action_success = action_status === 'success';

                if (is_message_success) {
                    Swal.fire({
                        heightAuto: false,
                        html: 'Added new URL',
                        icon: 'success',
                    });
                }
                else{
                    Swal.fire({
                        heightAuto: false,
                        html: 'Encountered a problem adding the new URL',
                        icon: 'error',
                    });
                }
            });


        }
    });
}


WordDensityWidget.isValidHttpUrl = function(given_url_string){
    // Based on the answer by Pavlo on question:
    // https://stackoverflow.com/questions/5717093/check-if-a-javascript-string-is-a-url

    let url;

    try {
        url = new URL(given_url_string);
    } catch (_) {
        return false;
    }

    return url.protocol === "http:" || url.protocol === "https:";
}


// Run Construct on page load
$( document ).ready(function() {
    WordDensityWidget.construct();
});