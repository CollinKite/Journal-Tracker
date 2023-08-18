<?php 
$page = "Edit Journal";
include_once "Frame/header.php"; 
?>

<!--Display one entry with a delete button  and form to edit-->

<div>
    <div id="journal-entry">
       
        </div>
        <div id ="edit-journal">
        <form action="Fetch/update-journal-entry.php" method="post">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" placeholder="Title" required>
            <label for="content">Content</label>
            <textarea id="content" name="content" placeholder="Write your journal entry here..." style="height:200px" required></textarea>
            <input type="submit" value="Submit">
        </form>

        <!-- button for delete -->
        <button id="delete-button" onclick="deleteJournal()">Delete</button>
    </div>

   



<script>
window.onload = async function() {
    //get the entry id from the url
    var urlParams = new URLSearchParams(window.location.search);
    var entryId = urlParams.get('entryId');
    var journalEntryData;
    await fetchJournal(entryId);
}


async function fetchJournal(entryId) {
    try {
        const response = await fetch('Fetch/get-journal-entry-by-id.php?entryId=' + entryId);

        const data = await response.json();
        journalEntryData = data;
        populateJournal(data);


    } catch (error) {
        console.error('Error fetching data:', error);

    }
}

function populateJournal(data) {
//just display single journal entry in the journal-entry div 
 // Get references to the form input fields
 var titleInput = document.getElementById('title');
    var contentInput = document.getElementById('content');

    // Set the values of the input fields with the existing data
    titleInput.value = data.title;
    contentInput.value = data.content;
var journalEntry = document.getElementById('journal-entry');


//display the date title and content
var dateElement = document.createElement('span');
dateElement.innerHTML = data.date_created;
journalEntry.appendChild(dateElement);

// Add a space between date and title

var spaceElement = document.createTextNode(' ');
journalEntry.appendChild(spaceElement);

// Display the journal title

var titleElement = document.createElement('span');
titleElement.innerHTML = data.title;
journalEntry.appendChild(titleElement);


}
    </script>


<?php include_once "Frame/footer.php"; ?>