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
        $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

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

<div id="searchResults">
    <!-- Display search results here using JavaScript -->
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
                    data.forEach(result => {
                        // Display journal entry details
                        const entryDiv = document.createElement("div");
                        entryDiv.innerHTML = `
                            <h4>${result.title}</h4>
                            <p>${result.content}</p>
                            <p>Date Created: ${result.date_created}</p>
                        `;
                        searchResults.appendChild(entryDiv);
                    });
                }
            })
            .catch(error => console.error(error));
    });
</script>

<?php include_once "Frame/footer.php"; ?>
