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
    let self = WordDensityWidget;

    Swal.fire({
        heightAuto: false,
        html:  'You clicked the Add URL button',
        icon: 'success'
    });
}


// Run Construct on page load
$( document ).ready(function() {
    WordDensityWidget.construct();
});