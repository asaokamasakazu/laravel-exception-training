<html lang="ja">
<head>
    <title>Calculator</title>
</head>
<body>
<h1>割り算マシン</h1>
<p>
    Number1 を Number2 で除算した結果を表示します。<br>
    半角数字以外や空欄状態で Calculate を行うと、例外が発生します。
</p>

<form method="post" action="/calculate">
    @csrf
    <label for="number1">Number1：</label>
    <input name="number1" id="number1"><br>

    <label for="number2">Number2：</label>
    <input name="number2" id="number2"><br><br>

    <button type="submit">　Calculate　</button>
</form><br>

@if (session('message'))
    <p>
        エラー発生：{{ session('message') }}<br>
        発生した例外：{{ session('exception') }}<br>
    </p>
@endif

@if(isset($result))
    <p>Result：{{ $result }}</p>
@endif
</body>
</html>
