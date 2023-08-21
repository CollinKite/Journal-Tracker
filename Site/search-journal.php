<?php
session_start();
$page = "Search for a Journal";
include_once "Frame/header.php";

// Include any necessary files or define your database connection here
include_once "Database/dbconnect.php"; // Replace with the path to your db_connect.php file

// Initialize an empty array for results
$results = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the search form submission
    $searchTerm = $_POST['searchTerm'];

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $dbConn = Connect();

        // Prepare and execute the query
        $stmt = $dbConn->prepare("SELECT * FROM journal_entries WHERE title LIKE ? AND user_id = ?");
        $searchPattern = "%" . $searchTerm . "%";
        $stmt->bind_param("si", $searchPattern, $user_id);
        $stmt->execute();

        // Get the results
        $result = $stmt->get_result();
        $results = $result->fetch_all(MYSQLI_ASSOC);

        // Close the statement and connection
        $stmt->close();
        $dbConn->close();
    }
}
?>

<form action="" method="post" id="searchForm">
    <label for="searchTerm">Search Term</label>
    <input type="text" id="searchTerm" name="searchTerm" required>

    <button type="submit">Search</button>
</form>

<div id="journal-entries">
    <div id="journal-entries-list">
        <ul id="searchResults"> <!-- Added ID to the ul element -->
            <!-- Results will be added dynamically here -->
        </ul>
    </div>
</div>

<script>
    document.getElementById("searchForm").addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent the form from submitting normally

        const searchTerm = document.getElementById("searchTerm").value;

        fetch(`Fetch/get-journal-entries-by-userid-like.php?searchTerm=${searchTerm}`)
            .then(response => response.json())
            .then(data => {
                const searchResults = document.getElementById("searchResults");
                searchResults.innerHTML = ""; // Clear previous results

                if (data.length === 0) {
                    searchResults.innerHTML = "<p>No matching journals found.</p>";
                } else {
                    data.forEach(entry => {
                        var li = document.createElement('li');

                        // Display the journal date
                        var dateElement = document.createElement('span');
                        dateElement.className = 'entry-date'; // Assign the class here
                        dateElement.innerHTML = entry.date_created;
                        li.appendChild(dateElement);

                        // Display the journal title
                        var titleElement = document.createElement('h4');
                        titleElement.className = 'entry-title'; // Assign the class here
                        titleElement.innerHTML = entry.title;
                        li.appendChild(titleElement);

                        // Display the journal content
                        var contentElement = document.createElement('p');
                        contentElement.className = 'entry-content'; // Assign the class here
                        contentElement.innerHTML = entry.content;
                        li.appendChild(contentElement);

                        // Create the "Edit" button
                        var editButton = document.createElement('button');
                        editButton.className = 'edit-button'; // Assign the class here
                        editButton.innerHTML = 'Edit';
                        editButton.value = entry.entry_id;

                        // Attach click event to the "Edit" button
                        editButton.onclick = function () {
                            // Redirect to edit-journal.php with the entryId as a query parameter
                            window.location.href = 'edit-journal.php?entryId=' + this.value;
                        };
                        li.appendChild(editButton);
                        searchResults.appendChild(li); // Append the li to searchResults
                    });
                }
            });
    });
</script>

<?php include_once "Frame/footer.php"; ?>
