<Span>
    <Span class="menu-button">Home</Span>
    <Span class="menu-button">Create Journal</Span>
    <Span class="menu-button">Search Journal</Span>
    <div id="dropdownProfileContainer" class="dropdown-profile-container">
        <a href="profile.php">My Profile</a>
        <ul>
            <li><a href="account.php">Account</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</Span>

<style>
    .dropdown-profile-container {
        position: relative;
        display: inline-block;
    }

    .dropdown-profile-container > a {
        display: block;
        padding: 10px;
        text-decoration: none;
        color: #333;
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


</style>