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
                console.log("Data Recieved" + data);
                populateJournals(data);

            } catch (error) {
                console.error('Error fetching data:', error);

            }
        }

        function populateJournals(data) {
            //display all journal entries save the id in value of the buttons , there will be button for delete , and edit
            //each entry should have two buttons delete and edit
            var journalEntriesList = document.getElementById('journal-entries-list');
            var journalEntries = document.getElementById('journal-entries');
            var ul = document.createElement('ul');
            journalEntriesList.appendChild(ul);
            for (var i = 0; i < data.length; i++) {
                var li = document.createElement('li');
                var a = document.createElement('a');
                a.href = "journal-entry.php?entryId=" + data[i].id;
                a.innerHTML = data[i].title;
                li.appendChild(a);
                ul.appendChild(li);
                var deleteButton = document.createElement('button');
                deleteButton.innerHTML = "Delete";
                deleteButton.value = data[i].id;
                deleteButton.onclick = function() {
                    deleteJournal(this.value);
                };
                li.appendChild(deleteButton);
                var editButton = document.createElement('button');
                editButton.innerHTML = "Edit";
                editButton.value = data[i].id;
                editButton.onclick = function() {
                    editJournal(this.value);
                };
                li.appendChild(editButton);
            }
            journalEntries.appendChild(journalEntriesList);

            

        }
        

        </script>

<?php include_once "Frame/footer.php"; ?>