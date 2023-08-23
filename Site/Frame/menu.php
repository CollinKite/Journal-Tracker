<?php
if(isset($_SESSION['token'])): ?>
<Span>
    <Span class="menu-button"><a href="home.php">Home</a></Span>
    <Span class="menu-button"><a href="search-journal.php">Search Journal</a></Span>
    <Span class="menu-button"><a href="create-journal.php">Create Journal</a></Span>
    <div id="dropdownProfileContainer" class="dropdown-profile-container">
        <a href="profile.php">My Profile</a>
        <ul>
            <li><a href="account.php">Account</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="/Fetch/logout.php">Logout</a></li>
        </ul>
    </div>
</Span>
<br>
<?php
else: ?>
<!-- Login and signup -->
<Span>
    <Span class="menu-button"><a href="index.php">Login</a></Span>
    <Span class="menu-button"><a href="signup.php">Signup</a></Span>
</Span>
<?php endif; ?>
<style>
    
    a, a:visited, a:hover, a:active {
    color: inherit;
    text-decoration: none;
    }

    .menu-button {
        display: inline-block;
        padding: 10px;
    }



    body {
        font-family: Arial, sans-serif;
        text-align: center;
        margin: 0;
        padding: 0;
    }

    h1, h2 {
        margin: 0;
    }

    .menu-button {
        padding: 10px;
    }

    .dropdown-profile-container ul {
        position: absolute;
        top: 100%;
        left: 0;
        display: none;
        background-color: #f9f9f9;
        border: 1px solid #ccc;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .dropdown-profile-container:hover ul {
        display: block;
    }

    .dropdown-profile-container li {
        padding: 8px 15px;
    }

    .dropdown-profile-container li:hover {
        background-color: #e0e0e0;
    }

 

    label {
        display: block;
        margin-bottom: 10px;
    }

    input[type="email"],
    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    button[type="submit"] {
        padding: 10px 20px;
        background-color: #333;
        color: white;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #555;
    }

    textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            resize: vertical; /* Allow vertical resizing of the textarea */
    }

    #journal-entries {
        margin: 20px auto;
        max-width: 800px;
    }


    #journal-entry{
        display: inline-flex;
    padding: 20px;
    height: 20px;
    justify-content: space-evenly;
    }

    ul {
        list-style-type: none;
        padding: 0;
    }

    li {
        margin-bottom: 20px;
        padding: 20px;
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    button {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 3px;
        padding: 5px 10px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #0056b3;
    }
    .edit-button {
        background-color: white;
        color: #007bff;
        border: 1px solid #007bff;
        float: right;

    }

    .edit-button:hover {
        background-color: #007bff;
        color: white;
    }

    /* Style for the submit button */
    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 3px;
        padding: 10px 20px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    .entry-content {
        margin-top: 10px;
        word-wrap: break-word;
        color: #555;
    }

    .entry-date {
      
        padding: 5px 10px;
        font-weight: bold;
        color: #007bff;
        margin-bottom: 5px;
    }

    .entry-title {
        position: absolute;
    margin-top: 30px;
    font-size: 1.4em;
    margin-bottom: 10px;
    font-weight: bold;
    }

    #delete-button {
        background-color: #dc3545;
        color: #fff;
        border: none;
        border-radius: 3px;
        padding: 5px;
        cursor: pointer;
        float: right;
    
    
    }

    #delete-button:hover {
        background-color: #c82333;
    }

    h3 {

    font-size: 35px;
    border-radius: 5px;
    margin:auto;
    padding: 20px;
    width: fit-content;
    }
</style>