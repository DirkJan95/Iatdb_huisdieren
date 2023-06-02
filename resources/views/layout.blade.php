<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>    
    <link rel="stylesheet" href="{{asset('css/styles.css') }}">
    
    <meta charset="UTF-8">
    <meta name="description" content="Our first page">
    <meta name="keywords" content="html tutorial template">
    
    <title>PassenOpJeDier</title>
</head>
<body>
    <header>
        <div class="topnav">
            <a class="{{ request()->is('/') ? 'active' : '' }}" href="/">Pets!</a>
            <a class="{{ request()->is('jouwDieren') ? 'active' : '' }}" href="/jouwDieren">Jouw dieren</a>      
            <a class="{{ request()->is('profiel') ? 'active' : '' }}" href="/profiel">Profiel</a>            
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
             </form>                       
          </div>              
    </header>    

    <div class="content-wrap">
        @yield('content')
    </div>

    <footer>
        <p>Door Dirk Jan Remmerswaal</p>
        <p><a href="mailto:hege@example.com">dirkjan@example.com</a></p>
    </footer>
</body>
</html>