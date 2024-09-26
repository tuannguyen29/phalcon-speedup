<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo Phalcon\Tag::getTitle(); ?></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="canonical" href="https://phalcon.io/en-us">

        <link rel="apple-touch-icon" sizes="180x180" href="{{ static_url('assets/images/favicons/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ static_url('assets/images/favicons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ static_url('assets/images/favicons/favicon-16x16.png') }}">
        <link rel="icon" type="image/svg+xml" href="{{ static_url('assets/images/favicons/favicon.svg') }}">
        <link rel="icon" type="image/png" href="{{ static_url('assets/images/favicons/favicon.png') }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ static_url('assets/images/favicons/favicon.ico') }}">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
        <link rel="stylesheet" href="{{ static_url('/css/style.css') }}">
    </head>
    <body>
        <div class="container">
            {{ partial('partials/navbar') }}
            <?php echo $this->getContent(); ?>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.23/dist/sweetalert2.all.min.js"></script>
        <script src="{{ url('js/core.js') }}"></script>

        {{ partial('partials/common') }}
    </body>
</html>
