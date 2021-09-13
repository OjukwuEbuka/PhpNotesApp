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

    //Add mode for route identification
    serializedData += "&mode=register";


    $inputs.prop("disabled", true);
    
    // Send the ajax request
    request = $.ajax({
        url: "routes/routes.php",
        type: "post",
        datatype: "json",
        data: serializedData
    });

    // Callback function that will be called on success
    request.done(function (response, textStatus, jqXHR){

        let data = JSON.parse(response)

        if(data.errors){

            handleFormErrors($("#registerForm .errorDiv"), data)

        }
        else if(data.success)
        {
            $('#registerSuccess').removeClass("visually-hidden");
            document.querySelector('#registerForm').reset()

            setTimeout(() =>{

                let regModal = document.querySelector("#registerModal");
                let loginModal = new bootstrap.Modal("#loginModal");

                bootstrap.Modal.getInstance(regModal).hide()
                loginModal.show()

            }, 1500)

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

    $inputs.prop("disabled", true);

    // Send the ajax request
    request = $.ajax({
        url: 'routes/routes.php',
        type: "post",
        datatype: "json",
        data: serializedData
    });

    // Callback function that will be called on success
    request.done(function (response, textStatus, jqXHR){

        let data = JSON.parse(response)

        if(data.errors){

            handleFormErrors($("#loginForm .errorDiv"), data)

        }
        else if(data.success)
        {
            // Log a message to the console
            window.location.href = "home.php";
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
    request.always(function () {
        // Reenable the inputs
        $inputs.prop("disabled", false);
    });
   
});


function handleFormErrors(formErrorDiv, data) {

    let errorString = "<ul>";

    Object.values(data.errors).forEach(err => {
        errorString += `
            <li class="text-danger">${err}</li>
        `
    });

    errorString += '</ul>'

    console.log(formErrorDiv)

    formErrorDiv.html(errorString);

}


})