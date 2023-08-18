<?php 
$page = "Homepage";
include_once "Frame/header.php"; 
?>
<!--All journals by date-->

<div>
    <h2>All Journals</h2>
    <div id="journal-entries">
        <div id="journal-entries-list">
            <ul>
                <!-- <li><a href="journal-entry.php?entryId=1">Journal Entry 1</a></li> -->
            </ul>
        </div>
    </div>


    <script>
        //javascript request to get all journals from endpoint 
        window.onload = async function() {
            await fetchJournals(1);
        }


        async function fetchJournals(userId) {
            try {
                const response = await fetch('Fetch/get-journal-entries-by-userid.php?userId=' + userId);  

                const data = await response.json();

                data.sort((a, b) => (a.date < b.date) ? 1 : -1);
                console.log("Data Recieved");
                //console log json must be stringified
                console.log(JSON.stringify(data));
                populateJournals(data);

            } catch (error) {
                console.error('Error fetching data:', error);

            }
        }

        function populateJournals(data) {
    var journalEntriesList = document.getElementById('journal-entries-list');
    var journalEntries = document.getElementById('journal-entries');
    var ul = document.createElement('ul');
    journalEntriesList.appendChild(ul);

    for (var i = 0; i < data.length; i++) {
        var li = document.createElement('li');

        // Display the journal date
        var dateElement = document.createElement('span');
        dateElement.innerHTML = data[i].date_created;
        li.appendChild(dateElement);

        // Add a space between date and title
        var spaceElement = document.createTextNode(' ');
        li.appendChild(spaceElement);

       

        // Display the journal title
        var titleElement = document.createElement('span');
        titleElement.innerHTML = data[i].title;
        li.appendChild(titleElement);

        var spaceElement = document.createTextNode(' ');
        li.appendChild(spaceElement);

         //p tag content 

         var contentElement = document.createElement('span');
        contentElement.innerHTML = data[i].content;
        li.appendChild(contentElement); 


        // Create the "Edit" button
        var editButton = document.createElement('button');
        editButton.innerHTML = "Edit";
        editButton.value = data[i].entry_id;

        // Attach click event to the "Edit" button
        editButton.onclick = function() {
            // Redirect to edit-journal.php with the entryId as a query parameter
            window.location.href = "edit-journal.php?entryId=" + this.value;
        };

        li.appendChild(editButton);
        ul.appendChild(li);
    }

    journalEntries.appendChild(journalEntriesList);
}



        

        </script>

<?php include_once "Frame/footer.php"; ?>