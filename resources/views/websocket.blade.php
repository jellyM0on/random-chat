<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<main class='d-flex align-center h-100vh'>

    <section id='section-login' class='d-flex flex-col justify-center align-center mx-auto card'> 
        <form id='form-login' class='d-flex flex-col' action="">
            <h2>Log in</h2>
            <input type="text" placeholder='email' id='input-email'>
            <input type="password" placeholder='password' id="input-password">
            <button type='submit'>Log in</button>
        </form>
    </section>

    <section id='section-chat' class='hide d-flex flex-col justify-between align-center card mx-auto h-80'>
        <nav id='nav-online' class='w-100 d-flex'>
            <h3 class=' pl-1'>Chat</h3>
            <div id='avatars'>
               {{-- <span class="avatar">AL</span>
               <span class="avatar">AB</span> --}}
            </div>
        </nav>

        <ul id='list-messages' class='px-1 d-flex flex-col'>
        
        </ul>

        <form id='form' action="" class='w-100 d-flex flex-col'>
            <span id='span-typing' class='pl-1'></span>
            <input id='input-message' 
            class='py-2 pl-1'
            type="text" 
            placeholder='message...'>
    
        </form>
    </section>
</main>
   
@vite(['resources/js/app.js', 'resources/css/ws.css'])
</body>
</html>