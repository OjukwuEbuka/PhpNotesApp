$(function() {
    
let request;

// Bind to the submit event of register form
$("#registerForm").submit(function(event){
    
    event.preventDefault();

    // Abort any pending request
    if (request) {
        request.abort();
    }
    
    let $form = $(this);

    //Get the form inputs
    let $inputs = $form.find("input, select, button, textarea");

    // Serialize the data in the form
    let serializedData = $form.serialize();
    serializedData += "&mode=register";

    // let serializedDataArray = $form.serializeArray();

    // $inputs.prop("disabled", true);

    // serializedDataArray.mode = "register";

    // console.log(serializedData, dataArray)
    // Send the ajax request
    request = $.ajax({
        url: "routes/routes.php",
        type: "post",
        datatype: "json",
        data: serializedData
        // contentType: "application/json",
        // data: JSON.stringify({mode: "register", data: serializedDataArray}),
    });

    // Callback function that will be called on success
    request.done(function (response, textStatus, jqXHR){

        let data = JSON.parse(response)
        if(data.errors){

            console.log(data)

        }
        else if(data.success)
        {
            // Log a message to the console
            console.log("registered");
        }
    });

    // Callback function that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        
        console.error(
            "The following error occurred: "+
            textStatus, errorThrown
        );
    });

    //Callback function that will be called regardless if the request failed or succeeded
    request.always(function () {
        // Reenable the inputs
        $inputs.prop("disabled", false);
    });

});

// Bind to the submit event of our form
$("#loginForm").submit(function(event){
    
    event.preventDefault();

    // Abort any pending request
    if (request) {
        request.abort();
    }
    
    let $form = $(this);

    //Get the form inputs
    let $inputs = $form.find("input, select, button, textarea");

    // Serialize the data in the form
    let serializedData = $form.serialize();
    serializedData += "&mode=login";

    // $inputs.prop("disabled", true);
    // Send the ajax request
    request = $.ajax({
        url: 'routes/routes.php',
        type: "post",
        datatype: "json",
        data: serializedData
    });

    // Callback function that will be called on success
    request.done(function (response, textStatus, jqXHR){

        if(data.errors){

            console.log(data)

        }
        else if(data.success)
        {
            // Log a message to the console
            console.log("Logged in");
        }

    });

    // Callback function that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        console.error(
            "The following error occurred: "+
            textStatus, errorThrown
        );
    });

    // Callback function that will be called regardless if the request failed or succeeded
    // request.always(function () {
    //     // Reenable the inputs
    //     $inputs.prop("disabled", false);
    // });
   
});



})