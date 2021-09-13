document.addEventListener("DOMContentLoaded", function() {

    let newNoteBtn = document.querySelector("#newNoteBtn");
    let request;

    //Fetch all notes for display
    getAllNotes();

    newNoteBtn && newNoteBtn.addEventListener('click', function(e){
        e.preventDefault();

        let noteForm = document.querySelector("#noteForm");
        noteForm.reset();

        $("#noteId").val("")
        $("#noteForm .errorDiv").html("")
        $('#noteSuccess').addClass("visually-hidden");

        let openNoteModal = new bootstrap.Modal('#noteModal');
        openNoteModal.show()

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
        let noteId = $("#noteId").val()
        
        if(noteId !== ""){
            serializedData += `&noteId=${noteId}&mode=updateNote`;
        }
        else
        {
            serializedData += "&mode=createNote";
        }



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

                }, 1000)

                getAllNotes()

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
    

    // Bind to the delete note form
    $("#deleteNoteForm").submit(function(event){
        
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
        serializedData += "&mode=deleteNote";


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

                handleFormErrors($("#deleteNoteForm .errorDiv"), data)

            }
            else if(data.success)
            {
                setTimeout(() =>{

                    let deleteNoteModal = document.querySelector("#deleteNoteModal");

                    bootstrap.Modal.getInstance(deleteNoteModal).hide()

                }, 500)

                getAllNotes()

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


    //Function to get all the users Notes
    function getAllNotes(){

        // Abort any pending request
        if (request) {
            request.abort();
        }

        let userId = $("#loggedInUserId").val();

        // Send the ajax request
        request = $.ajax({
            url: "routes/routes.php",
            type: "post",
            datatype: "json",
            data: `userId=${userId}&mode=getAllNotes`
        });

        // Callback function that will be called on success
        request.done(function (response, textStatus, jqXHR){

            let data = JSON.parse(response)

            if(data.errors){

                handleFormErrors($("#noteForm .errorDiv"), data)

            }
            else if(data.data)
            {
                
                let notesList = document.querySelector("#notesList")
                let notesListBody = '';

                //Iterate over returned notes and create cards from them
                Object.values(data.data).forEach(note => {

                    notesListBody += `
                        <div class="col" >
                            <div class="card navbarBg">
                                <div class="card-body noteItem" data-noteid=${note.id}>
                                    <h5 class="card-title noteTitle">${note.title}</h5>
                                    <div class="card-text noteBody" style="max-height: 120px; width: 250px; overflow: hidden;">${note.body}</div>
                                    <button href="#" class="btn btn-primary noteEditBtn">
                                        <i class="bi bi-pen"></i>
                                        Edit
                                    </button>
                                    <button href="#" class="btn btn-danger noteDeleteBtn">
                                        <i class="bi bi-trash-fill"></i>
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    `
                })

                notesList.innerHTML = notesListBody;
                
                activateNotes()

            }

        });

        // Callback function that will be called on failure
        request.fail(function (jqXHR, textStatus, errorThrown){
            
            console.error(
                "The following error occurred: "+
                textStatus, errorThrown
            );
        });

    }

    
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

    function activateNotes(){

        let allNoteItems = document.querySelectorAll(".noteItem");


        allNoteItems && allNoteItems.forEach(note => {
        
            let noteTitle = note.querySelector(".noteTitle").textContent;
            let noteBody = note.querySelector(".noteBody").textContent;
            let noteId = note.dataset.noteid;
            let noteEditBtn = note.querySelector(".noteEditBtn");
            let noteDeleteBtn = note.querySelector(".noteDeleteBtn");
    
            noteEditBtn.addEventListener("click", function(e){
                e.preventDefault();
    
                let noteModal = document.querySelector('#noteModal');
                noteModal.querySelector('#noteTitle').value = noteTitle;
                noteModal.querySelector('#noteBody').value = noteBody;
                noteModal.querySelector('#noteId').value = noteId;

                $('#noteSuccess').addClass("visually-hidden");
                $("#noteForm .errorDiv").html("")
    
                let openNoteModal = new bootstrap.Modal('#noteModal');
                openNoteModal.show()

            })
    
            noteDeleteBtn.addEventListener("click", function(e){
                e.preventDefault();
    
                let deleteNoteModal = document.querySelector('#deleteNoteModal');
                deleteNoteModal.querySelector('#deleteNoteId').value = noteId;
    
                let openDeleteNoteModal = new bootstrap.Modal('#deleteNoteModal');
                openDeleteNoteModal.show()
            })
    
        })

    }
})