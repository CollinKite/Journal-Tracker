<?php 
$page = "Homepage";
include_once "Frame/header.php"; 
?>
<!--All journals by date-->

<div>
    <h3>Your Journal Entries</h3>
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
            //grab cookie user_id
            var userId = getCookie('user_id');
            console.log("cookie " + userId);
            await fetchJournals(userId);
        }

        function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
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
        dateElement.className = 'entry-date'; // Assign the class here
        dateElement.innerHTML = data[i].date_created;
        li.appendChild(dateElement);

        // Display the journal title
        var titleElement = document.createElement('h4');
        titleElement.className = 'entry-title'; // Assign the class here
        titleElement.innerHTML = data[i].title;
        li.appendChild(titleElement);

        // Display the journal content
        var contentElement = document.createElement('p');
        contentElement.className = 'entry-content'; // Assign the class here
        contentElement.innerHTML = data[i].content;
        li.appendChild(contentElement);

        // Create the "Edit" button
        var editButton = document.createElement('button');
        editButton.className = 'edit-button'; // Assign the class here
        editButton.innerHTML = 'Edit';
        editButton.value = data[i].entry_id;

        // Attach click event to the "Edit" button
        editButton.onclick = function() {
            // Redirect to edit-journal.php with the entryId as a query parameter
            window.location.href = 'edit-journal.php?entryId=' + this.value;
        };
        li.appendChild(editButton);
        ul.appendChild(li);
    }

    journalEntries.appendChild(journalEntriesList);
}



        

    </script>

<?php include_once "Frame/footer.php"; ?>