<!DOCTYPE html>
<html lang="en">
<head>
@include('includes.head') 
</head>
<body>

<header>
@yield("navbar")
</header>
<main>
   @yield("content")
</main>


    @include('includes.script') 


</body>
</html>


