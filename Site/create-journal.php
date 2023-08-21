<?php 
$page = "Create Journal";
include_once "Frame/header.php"; 
?>

<div>
    <div id="journal-entry">
       <h2>Create A New Journal Entry</h3>
        </div>
        <div id ="edit-journal">
        <form action="Fetch/create-journal-entry.php" method="post">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" placeholder="Title" required>
            <label for="content">Content</label>
            <textarea id="content" name="content" placeholder="Write your journal entry here..." style="height:200px" required></textarea>
            <input type="submit" value="Submit">
        </form>


       
    </div>

    <script>
        var userId;
        window.onload = async function(){
             userId = getCookie('user_id');
            console.log("cookie " + userId);
        }

        function getCookie(name) {
     const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
         if (parts.length === 2) return parts.pop().split(';').shift();
     
}

    document.querySelector('form').addEventListener('submit', async function (e) {
        e.preventDefault();
        console.log('form submitted');
        //get the values from the form

        var title = document.getElementById('title').value;
        var content = document.getElementById('content').value;

        //create the url to send the request to
        var url = 'Fetch/create_journal_entry.php';

        var data = {
            title: title,
            content: content,
            userId: userId
        }

        console.log(data);

        var request = new XMLHttpRequest();
        request.open('POST', url);
        request.setRequestHeader('Content-Type', 'application/json');
        request.onload = function () {
            if (request.status == 200){
                alert ("Journal Entry Created");
                window.location.href = '/home.php';
            }else {
                alert ("Unable to create journal entry");
            
            } 
        };

        // Send the request with the JSON data
        request.send(JSON.stringify(data));
    });


        </script>


<?php include_once "Frame/footer.php"; ?>