<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>maintenance</title>
   <link rel="stylesheet" href="{{ asset('backend/css/app.css') }}">
   <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

</head>
<style>
    #maintenance{
        width: 700px;
    height: 500px;
    
    
    position: absolute;
    top:0;
    bottom: 0;
    left: 0;
    right: 0;
    
    margin: auto;
    }
</style>
<body style="background-color: rgba(241, 239, 239, 0.801)">
    
<div class="" id="maintenance">
<div class="row">
    <div class="col-lg-12" style="text-align: center">
        <img src="{{ asset(settings()->maintenance_photo) }}" style="width:700px; border-radius: 60px"  alt="">
        <br><br>
        <h2> {{ settings()->maintenance_message }} <i style="color: red" class="fas fa-heart fa-lg"></i></h2>
    </div>
</div>

</body>
</html>
