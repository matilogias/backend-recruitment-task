<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- no cache -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Backend/Full-stack recruitment task</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <main>
        <?php require_once $view; ?>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="assets/js/script.js<?= '?' . time() ?>"></script>
</body>

</html>