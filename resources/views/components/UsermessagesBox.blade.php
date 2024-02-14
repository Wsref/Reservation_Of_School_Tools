@props(['user_requests_data','admin_replies_data','user','chatData'])

{{-- @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif --}}

@foreach ($chatData as $msg)
    <div class="owner_{{$msg->owner}} a{{$msg->status}}" id="{{$msg->request_id ? $msg->request_id : $msg->replies_to_request_id}}" >
    {{$msg->msg}}
    <div class="spacer"></div>
    </div>
@endforeach

{{-- <h1 class="user">hi it's {{$user['pname']}} mesg box </h1> --}}

{{-- @foreach ($msgdata as $msg)
    <div class="{{$msg->the_sender}}msg" >  
        {{$msg->msg}}
        <div class="statusBtns">
            {{-- <button></button> --}}
        {{-- </div>
        <label for=""> {{$msg->msg_time}} </label> 
    </div>
@endforeach  --}} 




{{-- <style>
    .usermsg , .adminmsg{
        padding: 5px;
        background-color:rgb(178, 179, 181);
        border-radius: 5px;
        border-bottom: 0.6px solid black;

    }
    .usermsg{
        background-color: rgb(72, 72, 72);
        color: white;
        margin-right: 30px;

    }
    .adminmsg{
        background-color: rgb(230, 210, 210) ;
        margin-left: 30px;
    }
    label{
        font-size: 10px;
        /* font: small; */
        color: red;
    }
</style> --}}

<style>
    .spacer {
    flex-grow: 1; /* This will push the buttons (or labels) to the rightmost part */
 }
    .owner_user{
        background-color: rgb(54, 54, 54);
            color: white;
            margin-right: 30px;
        
    }
    .owner_admin{
        font-size: 15px;
        /* margin-bottom: 10px; */

        background-color: rgb(255, 255, 255) ;
        color: black;
        margin-left: 30px;
    }
    .owner_user , .owner_admin{
            padding: 5px;
            /* background-color:rgb(178, 179, 181); */
            border-radius: 8px;
            border-bottom: 0.5px solid black;
            /* flex-direction:row; */
            /* align-content: center; */

            display: flex;
            align-items: center; /* Center-align child elements vertically */
            justify-content: space-between;
            position: relative;


        }
    .confirmBtn ,.dropBtn , .cancelBtn{
        text-align: center;
        border-radius: 2px;
        width: 100px;
        padding: 10px;
        /* background-color: rgb(255, 255, 255) ; */
        /* color: black; */
    }
    .dropBtn{
        background-color: red;
        color: black;

    }
    .confirmBtn{
        background-color: greenyellow;
        color: black;

    }
    .cancelBtn{
        background-color: rgb(30, 29, 29);
        color: aliceblue;
        border-radius: 10px;
        border: 2px solid rgb(255, 255, 255);
        transition: background-color 0.2s;

    }
    .cancelBtn:hover{
        background-color: rgb(82, 81, 81);
    }
    .confirmedLabel ,.dropedLabel {
        text-align: center;
        border-radius: 2px;
        width: 100px;
        padding: 10px;
        background-color: rgb(255, 255, 255) ;
        /* border-right:5px solid rgb(255, 10, 10): */
        color: black;
        border: 0.1px solid rgb(0, 0, 0);
    }

    .dropedLabel{
        border-right:5px solid rgb(255, 10, 10);

    }
    .confirmedLabel{
        border-right:5px solid rgb(10, 255, 23); 
        
    }
    .dropedLabel ,.confirmedLabel ,.dropBtn ,.confirmBtn , .cancelBtn {
        margin-left: 4px;
    }

    .pop_up_textfield{
        height: 100px;
        width: 400px;
        border: none;
    }
    .pop_up_textfield:focus{
        /* border: none; */
        outline: none;

    }
    .pop_up_div{
        height: auto;
        width:auto;
        display: flex;
        flex-direction: column;


        /* display: none; */
        position: absolute;
        background-color: white;
        border: 0.4px solid black;
        border-radius: 6px;
        padding: 5px;
    }
    .Okbtn{
        border-radius: 5px;
        width: 50px;
        /* padding: 10px; */
        text-align: center ;
        background-color: rgb(11, 34, 54);
        color: aliceblue;
        transition: background-color 0.2s;
        transition: width 0.5s;
        /* transition: padding-right 0.6s; */

        
    }
    .Okbtn:hover{
        /* padding-left: 5px;
        padding-right: 5px; */
        width: 60px;
        background-color: rgb(58, 58, 93);
    }
    .responses_hoster_div{
        /* display: none; */
    position: absolute;
    bottom: 0;
    left: 50%; /* Center horizontally */
    /* transform: translateX(-50%); Center horizontally */
    background-color: white;
    border: 1px solid black;
    padding: 10px;
    }
</style>

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
</script> --}}

{{-- @if ($user_requests_data && $user_requests_data->requester_id) --}}


 <script >    
    function initializeUsermessagesBox() {
        let messagesdiv0 = document.getElementById("messages")
        let responses_hoster_div = document.createElement("div")
        responses_hoster_div.className = "responses_hoster_div"
        responses_hoster_div.id = "unpoped"



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
           
           confirmBtn.addEventListener("click",function()
            {
                // if (responses_hoster_div.id === "unpoped") {
                //     messagesdiv0.appendChild(responses_hoster_div)
                //     responses_hoster_div.id = "poped"
                    
                // }
                // responses_hoster_div.innerHTML= request.innerHTML + "||| Confirmed  ||| <br>"
                // popup.innerHTML = '<input type="text" placeholder="Enter text"><button>Submit</button>';
                request.removeChild(dropBtn)

                let id = request_id; 
                let confirmedupdate = 1 ;
                let request_msg = request.innerHTML ;
                let requester_id;


                async function getRequesterId(id) {
                    try 
                    {
                        // Make the AJAX request and wait for the response
                        const response = await $.ajax({
                            url: '{{ route("get_requester_id", ["request_id" => ":parameter"]) }}'.replace(':parameter', id),
                            method: 'GET'

                        });

                        console.log(response);

                        
                        const requesterId = parseInt(response[0].requester_id);
                        console.log("requester_id 1: " + requesterId);

                        // Return the requester_id to the caller
                        requester_id = requesterId
                  

                        var xhr = new XMLHttpRequest();
                        xhr.open('PUT', '/update/' + id);
                        xhr.setRequestHeader('Content-Type', 'application/json');
                        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                if (xhr.status === 200) {
                                    console.log('Update successful');
                                    alert('confirm request id' + id +' successful')
                                    // Handle success, if needed
                                } else {
                                    console.error('Error:', xhr.status);
                                    alert('confirm request id' + id +' UNsuccesful')
                                    // Handle error, if needed
                                }
                            }
                        };
                        let emptystring = null
                        console.log("requester_id 2  :::::::: "+requester_id)
                        xhr.send(JSON.stringify(
                            { 
                                updateValue: confirmedupdate ,
                                request_msg:request_msg ,
                                requester_id:requester_id ,
                                request_id:id,
                                reply_msg : emptystring
                            }));
                        console.log("confirm button of id :"+confirmBtn.id+" was clicked")



                        
                    } catch (error) 
                    {
                        // Handle any errors
                        console.error(error);
                        throw error; // Rethrow the error to the caller
                    }
                }
                getRequesterId(id)

            }
        )

   




            dropBtn.addEventListener("click",function()
            {
                // if (responses_hoster_div.id === "unpoped") {
                //     messagesdiv0.appendChild(responses_hoster_div)
                //     responses_hoster_div.id = "poped"
                    
                // }
                // responses_hoster_div.innerHTML= request.innerHTML + "||| Droped  <br>|||"
                request.removeChild(confirmBtn)

                let id = request_id; 
                let dropedupdate = 0 ; 
                let request_msg = request.innerHTML ;
                let requester_id;

                async function getRequesterIddrop(id) 
		        {   
                    try {

                        const response = await $.ajax({
                            url: '{{ route("get_requester_id", ["request_id" => ":parameter"]) }}'.replace(':parameter', id),
                            method: 'GET'

                        });

                        console.log(response);

                        const requesterId = parseInt(response[0].requester_id);
                        console.log("requester_id 1: " + requesterId);

                        requester_id = requesterId


                    let cancelBtn = document.createElement("button")
                    cancelBtn.innerHTML = "Cancel"
                    cancelBtn.className = "cancelBtn"
                    request.appendChild(cancelBtn)

                    let pop_up_textfield = document.createElement("textarea")
                    pop_up_textfield.placeholder = "put drop reason here"
                    pop_up_textfield.className = "pop_up_textfield"

                    let OKbtn = document.createElement("button")
                    OKbtn.className = "Okbtn"
                    OKbtn.textContent="OK!"
                    

                    let pop_up_div = document.createElement("div")
                    pop_up_div.className="pop_up_div"
                    pop_up_div.append(pop_up_textfield)
                    pop_up_div.append(OKbtn)
                    let messagesdiv = document.getElementById("messages")

                    // messagesdiv.insertBefore(pop_up_div , request.nextSibling)
                    messagesdiv.appendChild(pop_up_div)
                    // pop_up_div.style.left = request.offsetLeft + 'px';
                    // pop_up_div.style.top = request.offsetTop + request.offsetHeight + 'px';
                    var popupWidth = pop_up_div.offsetWidth;
                    var parentWidth = messagesdiv.offsetWidth;
                    pop_up_div.style.left = (request.offsetLeft + request.offsetWidth - popupWidth) + 'px';
                    pop_up_div.style.top = request.offsetTop + request.offsetHeight + 'px';

                    console.log(pop_up_textfield.innerHTML)


                    cancelBtn.addEventListener("click",function(){
                        messagesdiv.removeChild(pop_up_div)
                        request.removeChild(cancelBtn)
                        request.appendChild(confirmBtn)
                    })
                    

                    OKbtn.addEventListener("click",function()
                    {
                        messagesdiv.removeChild(pop_up_div)


                        var xhr = new XMLHttpRequest();
                        xhr.open('PUT', '/update/' + id);
                        xhr.setRequestHeader('Content-Type', 'application/json');
                        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                if (xhr.status === 200) {
                                    console.log('Update successful');
                                    alert('drop request id' + id +' successful')
                                    // Handle success, if needed
                                } else {
                                    console.error('Error:', xhr.status);
                                    alert('drop request id' + id +' UNsuccesful')
                                    // Handle error, if needed
                                }
                            }
                        };
                        console.log(pop_up_textfield.innerHTML)

                        xhr.send(JSON.stringify(
                            { 
                                updateValue : dropedupdate ,
                                request_msg : request_msg ,
                                requester_id : requester_id ,
                                request_id : id,
                                reply_msg : pop_up_textfield.innerHTML
                            }));

                        

                    }
                    )



                        console.log("drop button of id :"+confirmBtn.id+" was clicked")



                        
                    } catch (error) {
                        console.error(error);
                        throw error; // Rethrow the error to the caller
                    }
                }
                getRequesterIddrop(id)


            }
        )

   
           
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
   
           async function getRequest(id) 
            {
                try {
                        const response = await $.ajax({
                            url: '{{ route("get_requester_id", ["request_id" => ":parameter"]) }}'.replace(':parameter', request_id),
                            method: 'GET'

                        });

                        console.log(response);

                        // Extract the requester_id from the response
                        // const requesterId = parseInt(response[0].requester_id);
                        // console.log("requester_id 1: " + requesterId);

                        // requester_id = requesterId
                        request.innerHTML = response[0].request_msg ;
                        request.appendChild(droped_label)
                        
                    } catch (error) {
                        // Handle any errors
                        console.error(error);
                        throw error; // Rethrow the error to the caller
                    }
            }
                getRequest(request_id)

        // request.appendChild(droped_label);
           
           
           
       })
   
       let confirmed_replies = document.querySelectorAll('.owner_admin.a1')
       confirmed_replies.forEach(function(request) {
           let request_id = request.id 

           
   
           let confirmed_label = document.createElement("label")
           confirmed_label.innerHTML = "Confirmed"
           confirmed_label.className = "confirmedLabel"
           
        //    request.appendChild(confirmed_label);




           async function getRequest(id) 
            {
                try {
                        const response = await $.ajax({
                            url: '{{ route("get_requester_id", ["request_id" => ":parameter"]) }}'.replace(':parameter', request_id),
                            method: 'GET'

                        });

                        // console.log(response);

                        // Extract the requester_id from the response
                        // const requesterId = parseInt(response[0].requester_id);
                        // console.log("requester_id 1: " + requesterId);

                        // requester_id = requesterId
                        request.innerHTML = response[0].request_msg ;
                        request.appendChild(confirmed_label)
                        
                    } catch (error) {
                        // Handle any errors
                        console.error(error);
                        throw error; // Rethrow the error to the caller
                    }
            }
                getRequest(request_id)








           
       })
      //  });
    }
    initializeUsermessagesBox();
   
</script>
{{-- @endif --}}
