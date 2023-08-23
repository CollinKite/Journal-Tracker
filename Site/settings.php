<?php 
$page = "Website Settings";
include_once "Frame/header.php"; 


// change themes on this page.
?>



<select id="theme" name="Theme" onchange=setTheme()>
    <option value="" disabled selected>Please select a theme</option>
    <option value="lightmode.css">Light Mode</option>
    <option value="darkmode.css">Dark Mode</option>
    <option value="pink.css">Pink</option>
</select><br>


<script> 
        function setTheme(){
            let theme = document.getElementById('theme').value;
            console.log(theme)
            fetch('/Fetch/updateUserStyle.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ style: theme }),
            })
            .then(response => {
                if (response.ok) {
                    location.reload();
                }
            })
        }
</script>

<?php include_once "Frame/footer.php"; ?>