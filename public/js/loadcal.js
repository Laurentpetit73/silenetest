let tests = document.querySelectorAll('.free')

for (let test of tests) {
    test.addEventListener('click',function (e){
        test.style.backgroundColor = 'blue'
    })

}

let form = document.querySelector('.user-form')

form.addEventListener('submit',function (e) {
    e.preventDefault()

    let httpRequest = new XMLHttpRequest()
    httpRequest.onload = function () {
        let text = document.querySelector('.send-message')
        console.log(text)
        text.value=''
        console.log('test')
        getMessages()
    
        
    }
    httpRequest.open('POST','/app.php?sync=write',true)
    let data = new FormData(form)
    httpRequest.send(data)

    
})

getMessages = function(){
    let httpRequest = new XMLHttpRequest()
    httpRequest.onload = function () {
        messages = JSON.parse(httpRequest.responseText).reverse()
        divmessages = document.querySelector('.messages')
        divmessages.innerHTML=''
        
        for(let message of messages){
            let div = document.createElement('div')
            div.classList.add('message')
            div.innerHTML = '<span class="user">'+ message.username + ' : </span><span class="texte">'+message.text+'</span> <span class="date">'+message.created_at.substring(11)+'</span>'
            divmessages.appendChild(div)
        }

    
        
    }
    httpRequest.open('GET','/app.php',true)
    httpRequest.send()

}

function maj(){
    setInterval(function(){
        getMessages()
        
    }, 1000)
}
maj()
getMessages()
