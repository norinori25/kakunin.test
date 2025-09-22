<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お問い合わせ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body>
    <header class="site-header">
      <div class="header-container">
        <h1 class="header-logo"> お問い合わせ</h1>
      </div>
    </header>

    <main>
      <div class="inner-container">
        @yield('content')
      </div>
    </main>

</body>
</html>
