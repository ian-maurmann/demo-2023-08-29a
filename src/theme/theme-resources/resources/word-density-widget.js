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

    // Reload the URL list
    self.reloadUrlList();
}


// Listen
WordDensityWidget.listen = function(){
    let self = WordDensityWidget;

    // Click Events
    Ox.Event.delegate('[data-click-event="word-density-ui >>> add-url"]',          'click', self.handleOnClickAddNewUrlButton);
    Ox.Event.delegate('[data-click-event="word-density-ui >>> click-url-listing"]', 'click', self.handleOnToggleUrlListing);
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

                if (is_message_success && is_action_success) {
                    // Show success message
                    Swal.fire({
                        heightAuto: false,
                        html: 'Added new URL',
                        icon: 'success',
                    }).then((result) => {
                        // Reload the URL list
                        self.reloadUrlList();
                    });
                }
                else{
                    // Show failure message
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

// Reload URL List
WordDensityWidget.reloadUrlList = function(){
    let self     = WordDensityWidget;
    let section  = $('[data-section="word-density-testing"]');
    let url_list = section.find('#url-list').first();

    let loading_html = '' +
        '<div class="url-list-loading-container">' +
            '<div class="url-list-loading-container-alpha">' +
                '<div class="hoja" style="font-size:20pt;">Loading...</div>' +
            '</div>' +
        '</div>';

    // Show loading screen
    url_list.html(loading_html);

    loader_alpha_layer = url_list.find('.url-list-loading-container-alpha').first();
    loader_alpha_layer.animate({ opacity: 1.0},2000, function() {

        // Make an ajax request
        let jqxhr = $.post( "/ajax/get-urls", {}, function() {
            // Do nothing for now
        }).done(function(data) {
            let message_status = data.hasOwnProperty('message_status') ? data.message_status : 'error';
            let is_message_success = message_status === 'success';
            let action_status = data.hasOwnProperty('action_status') ? data.action_status : 'error';
            let is_action_success = action_status === 'success';
            let endpoint_data = data.hasOwnProperty('data') ? data.data : {};
            let url_results = endpoint_data.hasOwnProperty('urls') ? endpoint_data.urls : {};

            if (is_message_success && is_action_success) {
                loader_alpha_layer.animate({ opacity: 0.0},2000, function() {
                    self.populateUrlList(url_results);
                });
            }
            else{
                Swal.fire({
                    heightAuto: false,
                    html: 'Encountered a problem fetching URL list',
                    icon: 'error',
                });
            }
        });
    });

}


// Populate the URL List
WordDensityWidget.populateUrlList = function(url_results){
    let self     = WordDensityWidget;
    let section  = $('[data-section="word-density-testing"]');
    let url_list = section.find('#url-list').first();

    let url_list_html = '' +
        '<div class="url-list-main-container">' +
        '</div>';

    // Update URL list with new container
    url_list.html(url_list_html);

    // Get the main container
    let main_container = url_list.find('.url-list-main-container').first();

    $.each(url_results, function( result_index, result ) {

        let url_listing_html = '' +
            '<div class="url-listing" data-is-opened="no">' +
                '<div class="url-listing-row" data-click-event="word-density-ui >>> click-url-listing">' +
                    '<span class="url-listing-row-text-span"> <i class="fa-solid fa-globe"></i> ' + result.url + '</span>' +
                '</div>' +
                '<div class="url-listing-tray">' +
                    '<span>' + result.url + ' was added on ' + result.datetime_added + '</span>' +
                '</div>' +
            '</div>';

        main_container.append(url_listing_html);
    });
}



// Handle On Toggle Url Listing
WordDensityWidget.handleOnToggleUrlListing = function(element, event){
    let self        = WordDensityWidget;
    let listing_row = $(element);
    let listing     = listing_row.parent().closest('.url-listing');
    let is_open     = listing.attr('data-is-opened') === 'yes';

    // Toggle
    if(is_open){
        listing.attr('data-is-opened', 'no');
    }
    else{
        listing.attr('data-is-opened', 'yes');
    }

}


// Run Construct on page load
$(document).ready(function() {
    WordDensityWidget.construct();
});