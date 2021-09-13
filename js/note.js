document.addEventListener("DOMContentLoaded", function() {

    let newNoteBtn = document.querySelector("#newNoteBtn");
    let allNoteItems = document.querySelectorAll(".noteItem");


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

    
})