<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>My Form</title>
</head>
<body>
  <form method="POST" action="/formpost" action="/formpost" action="/formpost" action="/formpost" action="/formpost" action="/formpost" action="/formpost" action="/formpost" action="/formpost">
    <input type="text" name="text" value="<?= (isset($previous)) ? htmlspecialchars($previous) : '' ?>"/>
    <input type="submit" value="Senden" />
  </form>
</body>

</html>
