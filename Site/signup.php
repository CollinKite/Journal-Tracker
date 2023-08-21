<?php
$page = "Signup";
include_once "Frame/header.php";
?>

<form id="signupForm">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <input type="submit" value="Signup">
    <p id="outputSignup"></p>
</form>
<br>

<script>
    document.getElementById('signupForm').addEventListener('submit', function(e) {
        e.preventDefault();

        let email = document.getElementById('email').value;
        let password = document.getElementById('password').value;
        let name = document.getElementById('name').value;

        fetch('/Fetch/signup.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                email: email,
                password: password,
                name: name
            }),
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('outputSignup').innerHTML = data;
        })
        .catch((error) => {
            console.error('Error:', error);
            document.getElementById('outputSignup').innerHTML = "An error occurred during signup";
        });
    });
</script>

<?php include_once "Frame/footer.php"; ?>
