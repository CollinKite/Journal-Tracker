<?php 
$page = "Website Settings";
include_once "Frame/header.php"; 


// change themes on this page.
?>



<select id="theme" name="Theme" onchange=setTheme()></select><br>


<script> 
        function setTheme(){
            let theme = document.getElementById('theme').value;
            fetch('/Fetch/updateStyle.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: theme }),
            })
            .then(response => {
                if (response.ok) {
                    // response.text().then(data => console.log(data));
                    //refresh page
                    location.reload();
                } else {
                    alert('Error creating sub category');
                }
            })
        }
</script>

<?php include_once "Frame/footer.php"; ?>