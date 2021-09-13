document.addEventListener("DOMContentLoaded", function() {

    let newNoteBtn = document.querySelector("#newNoteBtn");
    let allNoteItems = document.querySelectorAll(".noteItem");
    let request;


    newNoteBtn && newNoteBtn.addEventListener('click', function(e){
        e.preventDefault();

        let noteForm = document.querySelector("#noteForm");
        noteForm.reset();

        let openNoteModal = new bootstrap.Modal('#noteModal');
        openNoteModal.show()

    })


    allNoteItems && allNoteItems.forEach(note => {
        
        let noteTitle = note.querySelector(".noteTitle").textContent;
        let noteBody = note.querySelector(".noteBody").textContent;
        let noteEditBtn = note.querySelector(".noteEditBtn");

        noteEditBtn.addEventListener("click", function(e){
            e.preventDefault();

            let noteModal = document.querySelector('#noteModal');
            noteModal.querySelector('#noteTitle').value = noteTitle;
            noteModal.querySelector('#noteBody').value = noteBody;

            let openNoteModal = new bootstrap.Modal('#noteModal');
            openNoteModal.show()
        })

    })

        
    // Bind to the submit event of note form
    $("#noteForm").submit(function(event){
        
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
        serializedData += "&mode=createNote";


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

                handleFormErrors($("#noteForm .errorDiv"), data)

            }
            else if(data.success)
            {
                $('#noteSuccess').removeClass("visually-hidden");
                document.querySelector('#noteForm').reset()

                setTimeout(() =>{

                    let noteModal = document.querySelector("#noteModal");

                    bootstrap.Modal.getInstance(noteModal).hide()

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