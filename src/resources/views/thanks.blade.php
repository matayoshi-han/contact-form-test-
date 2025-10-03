<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
</head>

<body>
    <div class="background__text">
        <h1>Thank you</h1>
    </div>
    <form class="thanks-form" action="/contacts" method="post">
        @csrf
        <div class="thanks__content">
            <div class="thanks__heading">
                <h2>お問い合わせありがとうございました</h2>
            </div>
            <div class="form__button">
                <a href="{{ route('contact.index') }}">
                    <button class="form__button-submit" type="submit">HOME</button>
                </a>
            </div>
        </div>
    </form>
</body>

</html>