import './bootstrap';
import axios from 'axios'; 


const form = document.getElementById('form');
const inputMessage = document.getElementById('input-message');
const listMessage = document.getElementById('list-messages'); 
const inputEmail = document.getElementById('input-email'); 
const inputPassword = document.getElementById('input-password'); 
const avatars = document.getElementById('avatars'); 
const spanTyping = document.getElementById('span-typing'); 

form.addEventListener('submit', function (event){
    event.preventDefault(); 
    const userInput = inputMessage.value;

    axios.post('/chat-message', {
        message: userInput
    });  

    inputMessage.value = ""; 
})


function getCookie(name){
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`); 
    if(parts.length ===2 ){
        return parts.pop().split(';').shift(); 
    }
}

function request(url, options){
    const csrfToken = getCookie('XSRF-TOKEN'); 
    return fetch(url, {
        headers: {
            'content-type': 'application/json', 
            'accept': 'application/json', 
            'X-XSRF-TOKEN': decodeURIComponent(csrfToken),
        }, 
        credentials: 'include', 
        ...options, 
    })
}

function logout(){
    return request('/logout', {
        method: 'POST'
    }); 
}

function login(email, password){
    return fetch('/sanctum/csrf-cookie', {
        headers:{
            'content-type': 'application/json', 
            'accept': 'application/json'
        },
        credentials: 'include'
    }).then(() => logout())
    .then(() => {
        return request('/login', {
            method: 'POST', 
            body: JSON.stringify({
                email: email, 
                'password': password
            })
        })
    }).then(() => {
        document.getElementById('section-login').classList.add('hide');
        document.getElementById('section-chat').classList.remove('hide');
    })
}

let usersOnline = []; 

function userInitial(username){
    const names = username.split(' '); 
    return names.map((name) => name[0]).join("").toUpperCase(); 
}

function renderAvatars(){
    avatars.textContent = ''; 
    usersOnline.forEach((user) => {
        const span = document.createElement('span');
        span.textContent = userInitial(user.name);
        span.classList.add('avatar'); 
        avatars.append(span); 
    })
}

function addchatMessage(name, message, color="blue"){
    const li = document.createElement('li');
    li.classList.add('d-flex', 'flex-col'); 

    const span = document.createElement('span'); 
    span.classList.add('message-author'); 
    span.textContent = name; 

    const messageSpan = document.createElement('span'); 
    messageSpan.textContent = message; 
    messageSpan.style.color = color; 
    li.append(span, messageSpan); 
    listMessage.append(li); 
    
    spanTyping.textContent = ''
}

document.getElementById('form-login').addEventListener('submit', function(event){
    event.preventDefault(); 
    const email = inputEmail.value; 
    const password = inputPassword.value; 
    login(email, password)
    .then(() => {

        // updatePost(); 

        // const channel = Echo.join('presence.chat.1');
        
        // inputMessage.addEventListener('input', function(event){
        //     if(inputMessage.value.length === 0){
        //         channel.whisper('stop-typing'); 
        //     } else {
        //         channel.whisper('typing', {
        //             email: email
        //         })
        //     }
            
        // })
        // channel.here((users) => {
        //     usersOnline = [...users]; 
        //     renderAvatars(); 
        //     console.log({users});
        //     console.log('subscribed'); 
        // })
    
        // channel.joining((user) => {
        //     console.log({user}, 'joined');
        //     usersOnline.push(user); 
        //     renderAvatars(); 
        //     addchatMessage(user.name, "has joined the room!"); 
        // })
    
        // channel.leaving((user) => {
        //     console.log({user}, 'leaving')
        //     usersOnline = usersOnline.filter((userOnline) => userOnline.id !== user.id); 
        //     renderAvatars(); 
        //     addchatMessage(user.name, "has left the room.", 'grey'); 
        // })  
        
        
        // channel.listen('.chat-message', (event) => {
        //     console.log(event); 
        //     const message = event.message; 
            
        //     addchatMessage(event.user.name, message)
        // })

        // channel.listenForWhisper('typing', (event) => {
        //     spanTyping.textContent = event.email + ' is typing...'
        // })

        // channel.listenForWhisper('stop-typing', (event) => {
        //     spanTyping.textContent = '';
        // })
            
    })
})

updatePost(); 

function updatePost(){
    const socket = new WebSocket(`ws://${window.location.hostname}:6001/socket/update-post?appKey=${import.meta.env.VITE_PUSHER_APP_KEY}`);

    socket.addEventListener("error", (event) => {
        console.log("WebSocket error: ", event);
      });

    socket.onopen = function(){
        console.log('on open'); 

        socket.send(JSON.stringify({
            id: 1, 
            payload: {
                title: 'test'
            }
        }))
    }
}



 


