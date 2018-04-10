<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Document</title>
</head>
<body>

<div id="app">
    <ul id="messages">
        <li>Missatge 1</li>
        <li>Missatge 2</li>
        <li>Missatge 3</li>
        <li>Missatge 4</li>
    </ul>
</div>
{{--<script src="{{mix('js/app.js')}}"></script>--}}
<script src="/js/app.js"></script>

<script>

  Echo.channel('new-message')
    .listen('ChatMessage', (event) => {
      console.log('He rebut un nou event de broadcast');
      console.log(event);

      var li = document.createElement('li');
      var textNode = document.createTextNode(event.message);
      var list = document.getElementById('messages');

      //afegim un li amb el text.
      li.appendChild(textNode);

      //afegim el li a la llista de missatges.
      list.appendChild(li);
    });


</script>
</body>
</html>