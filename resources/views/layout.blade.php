<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    
    <link rel="stylesheet" href="{{asset('css/styles.css') }}">
    
    <meta charset="UTF-8">
    <meta name="description" content="Our first page">
    <meta name="keywords" content="html tutorial template">
    
    <title>Babysit Pets</title>
</head>
<body>
    <header>
        <div class="topnav">
            <a class="active" href="#home">Home</a>
            <a href="#news">News</a>
            <a href="#contact">Contact</a>
            <a href="#about">About</a>
          </div>
    </header>    
    @yield('content')
</body>
</html>