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
            <!-- button for delete -->
        <button id="delete-button" onclick="deleteJournal()">Delete Entry</button>
        </form>

        <p id="output"></p>

        
    </div>

   



<script>
 var entryId;
window.onload = async function() {
    //get the entry id from the url
    var urlParams = new URLSearchParams(window.location.search);
     entryId = urlParams.get('entryId');
    console.log("entry id " + entryId);
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

async function deleteJournal() {
    try {
        const response = await fetch('Fetch/delete-journal-entry.php?entryId=' + entryId);
        console.log(entryId);
        
        //redirect the user to the home page
        //alert the user that the journal entry was deleted
        alert('Journal entry deleted successfully');
        window.location.href = '/home.php';

    } catch (error) {

        alert('Something went wrong with the delete. Please try again later.');
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
dateElement.className = 'entry-date'; // Assign the class here
dateElement.innerHTML = data.date_created;
journalEntry.appendChild(dateElement);

// add whole line inbetween date and title
var linebreak = document.createElement('br');
journalEntry.appendChild(linebreak);



// Display the journal title

var titleElement = document.createElement('span');
titleElement.className = 'entry-title'; // Assign the class here
titleElement.innerHTML = data.title;
journalEntry.appendChild(titleElement);


}


//handle form submission
document.querySelector('form').addEventListener('submit', async function(e) {
    e.preventDefault();
    console.log('form submitted');

    //get the values from the form
    var title = document.getElementById('title').value;
    var content = document.getElementById('content').value;

    //create the url to send the request to

    var url = 'Fetch/edit-journal-entry.php';

    var data = {
        title: title,
        content: content,
        entryId: entryId
    }

    console.log (JSON.stringify(data));

    var request = new XMLHttpRequest();
    request.open('POST', url);
    request.setRequestHeader('Content-Type', 'application/json');
    request.onload = function() {
        if (request.status == 200) {
            // If the request was successful, display a success message
           //use an alert
              alert('Journal entry updated successfully');
              //redirect the user to the home page
             window.location.href = '/home.php';
        } else {
            // Otherwise, display an error message
           alert('Something went wrong with the update. Please try again later.');

        }
    };

    // Send the request with the JSON data
    request.send(JSON.stringify(data)); 

    //console log the response
    console.log(request.responseText);
    });
    </script>


<?php include_once "Frame/footer.php"; ?>