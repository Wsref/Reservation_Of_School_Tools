@props(['users'])

@foreach($users as $user)
    <div class="user" id="{{$user['id']}}" >
        <img src="" alt="">
         {{$user['fname']}} {{$user['pname']}} 
    </div>
@endforeach


<style>
    img{
        height: 20px;
        width: 20px;
    }
    .user{
        border-radius: 3px;
        height: fit-content;
        padding: 8px;
        background-color: hsl(0, 0%, 100%);
        transition: background-color 0.2s;
        /* border-bottom: 3px solid black; */

    }
    .user:hover{
        background-color: rgb(69, 69, 69);
        color: aliceblue;
    }
</style>


<script>
    
    var usediv = document.querySelectorAll(".user");

    // Loop through each div element
    usediv.forEach(function(div) {
    // Add event listener to each div
    div.addEventListener("click", function() {
        // Add your event handling code here

        let msgBoxcontainer = document.getElementById("messages")
        msgBoxcontainer.innerHTML=''
        let UserGendata = document.getElementById("userData")
        UserGendata.innerHTML=''
        // msgBoxcontainer.innerHTML= div.textContent + div.id;
        let id = div.id
        id = parseInt(id)





        // Handle button click for component 1
        //!might remove the click case and just put function
        getdata(id)

        function getdata(id) {   
            $.get(`/load-UsermsgBoxAJAX/${id}`, function(response) {
                $('#messages').html(response.component);
            });
            initializeUsermessagesBox();
        };



        fetch(`/load-UserData/${id}`)
        .then(response => response.text())
        .then(html => {
            // Handle the response data as needed
            document.getElementById("userData").innerHTML = html;
        })
        .catch(error => console.error('Error:', error));



    //     fetch('/get-borrows-html')
    //     .then(response => response.text()) // Parse the response as text
    //     .then(html => {
    //         let container = document.getElementById("container");
    //         container.innerHTML = html; // Set the HTML content to the container element
    //     })
    //     .catch(error => console.error('Error:', error));

    // };




        console.log("Div clicked: " + div.textContent);
    });
});

// let usediv = document.querySelector('.user')
// usediv.addEventListener("click",LoadMsgBox)

// function LoadMsgBox() {
//     console.log("hiiiiiiiiiiiiiiiiiiiii")
    
// }

</script>
{{-- 
<script>
    //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    //Uncaught DOMException: Failed to execute 'querySelector' on 'Document': '.user.-1' is not a valid selector.
       document.addEventListener("DOMContentLoaded", function() {
               // Your script code here
      
   
       let not_replied_requests = document.querySelectorAll('.owner_user.a-1')
       not_replied_requests.forEach(function(request) {
           let request_id = request.id
   
           let confirmBtn = document.createElement("button")
           confirmBtn.className = "confirmBtn" ;
           confirmBtn.textContent = "Confirm";
           confirmBtn.id = request_id ;
   
           let dropBtn = document.createElement("button")
           dropBtn.className = "dropBtn" ;
           dropBtn.textContent = "Drop"; 
           dropBtn.id = request_id ;
   
           request.appendChild(dropBtn);
           request.appendChild(confirmBtn);
   
           // Do something with each element
           // console.log(request);
       });
   
       let dropped_requests = document.querySelectorAll('.owner_user.a0')
       dropped_requests.forEach(function(request) {
           let request_id = request.id 
   
           let droped_label = document.createElement("label")
           droped_label.innerHTML = "Droped"
           droped_label.className = "dropedLabel"
   
           request.appendChild(droped_label);
   
           
       })
   
       let confirmed_requests = document.querySelectorAll('.owner_user.a1')
       confirmed_requests.forEach(function(request) {
           let request_id = request.id 
   
           let confirmed_label = document.createElement("label")
           confirmed_label.innerHTML = "Confirmed"
           confirmed_label.className = "confirmedLabel"
   
           request.appendChild(confirmed_label);
           
           
       })
   
       // //!/======================================
   
       let droped_replies = document.querySelectorAll('.owner_admin.a0')
       droped_replies.forEach(function(request) {
           let request_id = request.id 
   
           let droped_label = document.createElement("label")
           droped_label.innerHTML = "Droped"
           droped_label.className = "dropedLabel"
   
           request.appendChild(droped_label);
           
           
           
       })
   
       let confirmed_replies = document.querySelectorAll('.owner_admin.a1')
       confirmed_replies.forEach(function(request) {
           let request_id = request.id 
   
           let confirmed_label = document.createElement("label")
           confirmed_label.innerHTML = "Confirmed"
           confirmed_label.className = "confirmedLabel"
           
           request.appendChild(confirmed_label);
           
       })
       });
</script>
    --}}