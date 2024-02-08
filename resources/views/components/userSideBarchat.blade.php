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
        height: fit-content;
        padding: 5px;
        background-color: rgb(215, 215, 215);
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


        fetch(`/load-UsermsgBox/${id}`)
        .then(response => response.text())
        .then(html => {
            // Handle the response data as needed
            document.getElementById("messages").innerHTML = html;
        })
        .catch(error => console.error('Error:', error));


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