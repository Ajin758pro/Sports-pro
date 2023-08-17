<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    body{
      background-image: url('img/component1.png');
      background-repeat: no-repeat;
      background-size:auto;
      background-attachment: fixed;
      background-position-x: center;
    }
    
  </style>
</head>
<body >

<p id="demo">Iam Ajin Jayan</p>
<button onclick='func()' >Click</button>
<script>
 function func()
 {
  document.getElementById("demo").innerHTML="Ajin Jayan is always healthy";
 }

</script>
  
</body>
</html>