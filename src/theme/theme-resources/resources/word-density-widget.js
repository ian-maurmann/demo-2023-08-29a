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
    Ox.Event.delegate('[data-click-event="word-density-ui >>> add-url"]',                'click', self.handleOnClickAddNewUrlButton);
    Ox.Event.delegate('[data-click-event="word-density-ui >>> click-url-listing"]',      'click', self.handleOnToggleUrlListing);
    Ox.Event.delegate('[data-click-event="word-density-ui >>> run-test"]',               'click', self.handleOnClickRunTestButton);
    Ox.Event.delegate('[data-click-event="word-density-ui >>> click-url-test-listing"]', 'click', self.handleOnToggleUrlTestListing);
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
    loader_alpha_layer.animate({ opacity: 1.0},1000, function() {

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
                loader_alpha_layer.animate({ opacity: 0.0},1000, function() {
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
            '<div class="url-listing" data-is-opened="no" data-url-id="' + result.url_id + '" data-url="' + result.url + '" data-did-already-load-tests="no">' +
                '<div class="url-listing-row" data-click-event="word-density-ui >>> click-url-listing">' +
                    '<span class="url-listing-row-text-span"> <i class="fa-solid fa-globe"></i> ' + result.url + '</span>' +
                '</div>' +
                '<div class="url-listing-tray">' +
                    '<div>' +
                        '<span>' + result.url + ' was added on <i class="fa-regular fa-calendar fa-lg"></i> ' + result.datetime_added + '</span>' +
                    '</div>' +
                    '<div class="url-test-list">' +
                        '<span>(Checking for any previous density tests already run...)</span>' +
                    '</div>' +
                    '<div>' +
                        '<div data-section-item-type="small-button-div" class="aero-gel aero-gel-blurred" tabindex="0" data-click-event="word-density-ui >>> run-test">Run Test</div>' +
                    '</div>' +
                '</div>' +
            '</div>';

        main_container.append(url_listing_html);
    });
}



// Handle On Toggle Url Listing
WordDensityWidget.handleOnToggleUrlListing = function(element, event){
    let self            = WordDensityWidget;
    let current_element = $(element);
    let listing         = current_element.parent().closest('.url-listing');
    let is_open         = listing.attr('data-is-opened') === 'yes';
    let are_test_loaded = listing.attr('data-did-already-load-tests') === 'yes';

    // Toggle
    if(is_open){
        listing.attr('data-is-opened', 'no');
    }
    else{
        listing.attr('data-is-opened', 'yes');
    }

    // Load tests
    if(!are_test_loaded){
        self.reloadTestsForUrlListing(listing);
    }
}


// Handle On Click "Run Test" Button
WordDensityWidget.handleOnClickRunTestButton = function(element, event){
    let self    = WordDensityWidget;
    let button  = $(element);
    let listing = button.parent().closest('.url-listing');
    let url_id  = listing.attr('data-url-id');
    let url     = listing.attr('data-url');

    Swal.fire({
        heightAuto: false,
        html:  'Run word-density test for URL "' + url + '"?',
        icon: '',
        showCancelButton: true,
    }).then((result) => {
        if (result.isConfirmed) {

            let fields = {
                url_id : url_id,
                url    : url
            }

            // Make an ajax request
            let jqxhr = $.post( "/ajax/run-word-density-test", fields, function() {
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
                        html: 'Ran the word-density test',
                        icon: 'success',
                    }).then((result) => {
                        // Refresh the list of tests for the current url
                        self.reloadTestsForUrlListing(listing);
                    });
                }
                else{
                    // Show failure popup
                    Swal.fire({
                        heightAuto: false,
                        html: 'Encountered a problem while running the word-density test',
                        icon: 'error',
                    });
                }
            });

        }
    });
}

// Reload Tests For URL Listing
WordDensityWidget.reloadTestsForUrlListing = function(listing){
    let self      = WordDensityWidget;
    let test_list = listing.find('.url-test-list').first();
    let url_id    = listing.attr('data-url-id');

    let fields = {
        url_id : url_id
    }

    // Make an ajax request
    let jqxhr = $.post( "/ajax/get-url-tests", fields, function() {
        // Do nothing for now
    }).done(function(data) {
        let message_status = data.hasOwnProperty('message_status') ? data.message_status : 'error';
        let is_message_success = message_status === 'success';
        let action_status = data.hasOwnProperty('action_status') ? data.action_status : 'error';
        let is_action_success = action_status === 'success';
        let endpoint_data = data.hasOwnProperty('data') ? data.data : {};
        let tests = endpoint_data.hasOwnProperty('tests') ? endpoint_data.tests : {};

        if (is_message_success && is_action_success) {
            test_list.html('(Loaded!)');

            self.populateUrlTestList(listing, test_list, tests);

            // Tell the URL listing that the test are already loaded
            listing.attr('data-did-already-load-tests', 'yes')
        }
        else{
            // Show failure message
            test_list.html('(Encountered a problem while loading tests)');
        }
    });
}

// Populate the URL Test List
WordDensityWidget.populateUrlTestList = function(listing, test_list_div, tests){
    let self     = WordDensityWidget;
    let section  = $('[data-section="word-density-testing"]');

    // Clear the div
    test_list_div.html('');

    // Loop through the tests
    let is_first  = true;
    let each_else = true;
    $.each(tests, function(test_index, test) {
        each_else = false;

        if(is_first){
            test_list_div.append('<b>Word-Density Tests:</b>');
        }

        let url_listing_test_list_html = '' +
            '<div class="url-test" data-is-opened="no" data-did-already-load-test-words="no" data-test-id="' + test.density_test_id + '">' +
                '<div class="url-test-heading-clickable" data-click-event="word-density-ui >>> click-url-test-listing"> <i class="fa-solid fa-layer-group"></i> Test #' + test.density_test_id + ' run on ' + test.datetime_ran_test + '</div>' +
                '<div class="url-test-tray">' +
                    '<div> Test ID: #' + test.density_test_id + '</div>' +
                    '<div> Test run on: ' + test.datetime_ran_test + '</div>' +
                    '<div class="url-test-word-list">' +
                        '<span>(Retrieving words that were saved during the test...)</span>' +
                    '</div>' +
                '</div>' +
            '</div>';

        test_list_div.append(url_listing_test_list_html);

        is_first = false;
    });
    if(each_else){
        test_list_div.append('<i>No tests have been run yet. Run a test.</i>');
    }
}


// Handle On Toggle Url Test Listing
WordDensityWidget.handleOnToggleUrlTestListing = function(element, event){
    let self                  = WordDensityWidget;
    let current_element       = $(element);
    let url_listing           = current_element.parent().closest('.url-listing');
    let test_listing          = current_element.parent().closest('.url-test');
    let is_open               = test_listing.attr('data-is-opened') === 'yes';
    let are_test_words_loaded = test_listing.attr('data-did-already-load-test-words') === 'yes';

    // Toggle
    if(is_open){
        test_listing.attr('data-is-opened', 'no');
    }
    else{
        test_listing.attr('data-is-opened', 'yes');
    }

    // Load test words
    if(!are_test_words_loaded){
        self.reloadTestWordsForTestListing(url_listing, test_listing);
    }
}



// Reload Tests For URL Listing
WordDensityWidget.reloadTestWordsForTestListing = function(url_listing, test_listing){
    let self           = WordDensityWidget;
    let url_id         = url_listing.attr('data-url-id');
    let test_word_list = test_listing.find('.url-test-word-list').first();
    let test_id        = test_listing.attr('data-test-id');

    let fields = {
        test_id : test_id
    }

    // Make an ajax request
    let jqxhr = $.post( "/ajax/get-url-test-words", fields, function() {
        // Do nothing for now
    }).done(function(data) {
        let message_status = data.hasOwnProperty('message_status') ? data.message_status : 'error';
        let is_message_success = message_status === 'success';
        let action_status = data.hasOwnProperty('action_status') ? data.action_status : 'error';
        let is_action_success = action_status === 'success';
        let endpoint_data = data.hasOwnProperty('data') ? data.data : {};
        let test_words = endpoint_data.hasOwnProperty('test_words') ? endpoint_data.test_words : {};

        if (is_message_success && is_action_success) {
            test_word_list.html('(Loaded!)');

            // Populate the Test Word list
            self.populateUrlTestWordList(url_listing, test_listing, test_word_list, test_words);

            // Tell the URL listing that the test are already loaded
            test_listing.attr('data-did-already-load-test-words', 'yes')
        }
        else{
            // Show failure message
            test_listing.html('(Encountered a problem while loading test words)');
        }
    });
}

// Populate the Test Word list
WordDensityWidget.populateUrlTestWordList = function(url_listing, test_listing, test_word_list_div, test_words){
    let self     = WordDensityWidget;
    let section  = $('[data-section="word-density-testing"]');

    // Clear the div
    test_word_list_div.html('');

    // Loop through the test words
    let is_first  = true;
    let each_else = true;
    let iteration = 0;
    $.each(test_words, function(test_word_row_index, test_word_row) {
        each_else = false;
        iteration ++;

        // Break after 20
        if(iteration > 20){
            return false; // break loop
        }

        // First Loop only
        if(is_first){
            test_word_list_div.append('<b>Words:</b>');
            test_word_list_div.append('<table class="url-test-words-table">');

        }

        let test_word_table = test_word_list_div.find('.url-test-words-table').first();

        // Get word
        let word_string = String(test_word_row.word);

        // Get rank
        let rank        = parseInt(test_word_row_index) + 1;
        let rank_string = String(rank) + '.';

        // Get density
        let density_per_10k_as_int    = parseInt(test_word_row.word_density);
        let density_percent_as_float  = density_per_10k_as_int / 100;
        let density_percent_as_string = String(density_percent_as_float) + '%';

        // Get occurrences / word_count
        let word_count = parseInt(test_word_row.word_count);
        let occurrences_string = '(Word appeared ' + String(word_count) + ' times)';

        // Get grade
        let grade = 'ok';
        if(density_per_10k_as_int > 300){
            grade = 'excellent';
        }
        else if(density_per_10k_as_int > 100){
            grade = 'very-good';
        }
        else if(density_per_10k_as_int > 75){
            grade = 'good';
        }

        // Get if word is over-common
        let is_common_syntax_word = parseInt(test_word_row.is_common_syntax_word) > 0;
        let commonality = is_common_syntax_word ? '(Too common for word-searching)' : '';

        if(is_common_syntax_word){
            // rank_string               = '(' + rank_string + ')';
            word_string               = '(' + word_string + ')';
            density_percent_as_string = '(' + density_percent_as_string + ')';
        }


        let tr = '' +
            '<tr>' +
                '<td>' + rank_string + '</td>' +
                '<td>' + word_string + '</td>' +
                '<td>' +
                    '<span class="test-word-result-density" data-grade="' + grade + '">' + density_percent_as_string + '</span>' +
                    ' ' +
                    '<span class="test-word-result-occurrences">' + occurrences_string + '</span>' +
                '</td>' +
                '<td>' + commonality + '</td>' +
            '</tr>';

        test_word_table.append(tr);

        is_first = false;
    });
    // Else
    if(each_else){
        test_word_list_div.append('<i>No words saved with test. Please run a new test.</i>');
    }
}

// Run Construct on page load
$(document).ready(function() {
    WordDensityWidget.construct();
});