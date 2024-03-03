@props(['user_requests_data','admin_replies_data','user','chatData'])

{{-- @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif --}}

@foreach ($chatData as $msg)
    <div class="owner_{{$msg->owner}} a{{$msg->status}}" id="{{$msg->id ? $msg->id : $msg->replies_to_request_id}}" >
        <div class="spanContainer">
            <span class="msg" id="msg_id">{{$msg->msg}}</span>
            <span class="dropReason"></span>
        </div>

        <div class="spacer"></div>
    </div>
@endforeach
<div class="msgMenu" id="msgMenu_div">
    <div class="responsesLoader" id="responsesLoader_div">
    </div>
    <div class="buttons">
        <button class="Cancelall" id="Cancelall_btn">Cancel All</button>
        <button class="sendBtn" id="send_btn"> Send</button>
    </div>

</div>

<style>
.spanContainer {
    display: flex; /* Align spans horizontally */
    /* justify-content: space-between; */
    /* background-color: violet; */
    flex-grow: 1;
}

.msg {
     /* Equal width for both spans */
    /* background-color: #f2f2f2; */
    /* padding: 10px; */
    width: 150px;
    border-radius: 5px;
}

.dropReason {
     /* Equal width for both spans */
    /* background-color: #f2f2f2; */
    /* padding: 10px; */
    border-radius: 5px;
    box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.1); /* Shadow in bottom and left */
}

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
    .buttons{
        display: flex;
        flex-direction: column;
    }
    .Cancelall{
        /* background-color: red; */
        text-align: center ;
        width: 100px ;
        border-radius: 11px;

        /* display:block; */
        /* display:none; */
    position: absolute;
    bottom: 0;
    right: 22%; /*Center horizontally*/
    bottom: 10%;
    /* transform: translateX(-50%); Center horizontally */
    background-color: rgb(29, 29, 29);
    color: aliceblue ;
    border: 1px solid black;
    padding: 10px;

    }
    .sendBtn{
        
        text-align: center ;
        width: 100px ;
        border-radius: 11px;

        /* display:block; */
        /* display:none; */
        position: absolute;
        bottom: 0;
        right: 22%; /*Center horizontally*/
        /* transform: translateX(-50%); Center horizontally */
        background-color: white;
        color: black;
        border: 1px solid black;
        padding: 10px;

    }
    .responsesLoader{
        background-color: red;
        border-radius: 8px;
        width: 600px;
        height: auto;
        overflow: hidden ;
        /* overflow: hidden; */
        /* display:block; */
        /* display:none; */
        display: flex ;
        flex-direction: column ;
    position: absolute;
    bottom: 0;
    left: 22%; /*Center horizontally*/
    /* transform: translateX(-50%); Center horizontally */
    background-color: white;
    border: 1px solid black;
    padding: 10px;
    }
    .responsesLoader:hover{
        overflow: auto;
    }
    .msgMenu{
        /* display: none; */
        background-color: yellowgreen;
    }
    .response_of_msgmenu{
        /* background-color: blue;
        display: flex;
        flex-direction: row ; */

        display: flex;
        justify-content: space-between; /* Align children at each end */
        align-items: center; /* Center children vertically */
        width: 100%; /* Full width of the parent */
        height: auto; 
        padding-top: 10px;
        padding-bottom: 10px;
        border-bottom: 1px solid black;
        background-color: rgb(255, 255, 255); /* Just for visualization */
    }
    .request_box , .status_box  ,.dropReason_box {
        flex: 1; /* Equal width for left divs */
    text-align: left; /* Align text to the left */
    }
    .dropReason_box{
        padding: 2px;
        background-color: white;
    }
    .cancelBtn_inMsgLoaderDiv{
        background-color: rgb(30, 29, 29);
        color: aliceblue;
        border-radius: 10px;
        border: 2px solid rgb(255, 255, 255);
        transition: background-color 0.2s;
        flex-shrink: 0; /* Prevent the div from shrinking */
        text-align: right; /* Align text to the right */
    }
    .cancelBtn_inMsgLoaderDiv:hover{
        background-color: wheat;
    }
    #confirmed_status_box{
        color: rgb(53, 222, 53);
    }
    #droped_status_box{
        color: rgb(229, 64, 64);
    }
    
</style>


 <script >    
    function initializeUsermessagesBox() {
        let messagesdiv = document.getElementById("messages")
        let responses_hoster_div = document.createElement("div")
        responses_hoster_div.className = "responses_hoster_div"
        responses_hoster_div.id = "unpoped"


        let msgMenu_div = document.getElementById("msgMenu_div")
        msgMenu_div.style.display = "none"
        
                let responsesLoader_div = document.getElementById("responsesLoader_div")
                let Cancelall_btn = document.getElementById("Cancelall_btn")
                let send_btn = document.getElementById("send_btn")

        let responses_saver = []

       let not_replied_requests = document.querySelectorAll('.owner_user.a-1')
       not_replied_requests.forEach(function(request) 
        {
           
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
                request.removeChild(dropBtn)

                let id = request_id; 
                let confirmedupdate = 1 ;
                
                let request_msg =  request.querySelector(".msg").innerHTML;
                let requester_id;

                let confirmed_label = document.createElement("label")
                confirmed_label.innerHTML = "Confirmed"
                confirmed_label.className = "confirmedLabel"
        
                request.removeChild(confirmBtn)
                request.appendChild(confirmed_label);





                if (msgMenu_div.style.display === "none") 
                {
                    msgMenu_div.style.display = "block";
                }
                // let response_of_msgmenu = document.createElement("div")
                // response_of_msgmenu.className = "response_of_msgmenu"



                async function getRequesterId(id) {
                    try 
                    {
                        // Make the AJAX request and wait for the response
                        const response = await $.ajax({
                            url: '{{ route("get_requester_id2", ["request_id" => ":parameter"]) }}'.replace(':parameter', id),
                            method: 'GET'

                        });

                        

                        console.log(response);

                        
                        const requesterId = parseInt(response['user_id']);
                        console.log("requester_id 1: " + requesterId);

                        // Return the requester_id to the caller
                        requester_id = requesterId
                  

                        let emptystring = null

                        let data_arr = [request_id , requester_id , confirmedupdate , request_msg , emptystring ]
                            responses_saver.push(data_arr)

                            let response_of_msgmenu = document.createElement("div")
                            response_of_msgmenu.className = "response_of_msgmenu"
                            // response_of_msgmenu.id =

                                let request_box = document.createElement("div")
                                request_box.className = "request_box" 
                                request_box.innerHTML = request_msg

                                let status_box = document.createElement("div")
                                status_box.className = "status_box"
                                status_box.id = "confirmed_status_box"
                                status_box.innerHTML = "Confirmed"

                                let dropReason_box = document.createElement("div")
                                dropReason_box.className = "dropReason_box" 
                                dropReason_box.innerHTML = ""

                                let cancelBtn_inMsgLoaderDiv = document.createElement("button")
                                cancelBtn_inMsgLoaderDiv.innerHTML = "Cancel"
                                cancelBtn_inMsgLoaderDiv.className = "cancelBtn_inMsgLoaderDiv"

                            response_of_msgmenu.appendChild(request_box)
                            response_of_msgmenu.appendChild(status_box)
                            response_of_msgmenu.appendChild(dropReason_box)
                            response_of_msgmenu.appendChild(cancelBtn_inMsgLoaderDiv)
                            

                            responsesLoader_div.appendChild(response_of_msgmenu)

                            cancelBtn_inMsgLoaderDiv.addEventListener("click",function()
                            {
                                responses_saver = responses_saver.filter(function(array) {
                                        // Return true for arrays that are not equal to the array to remove
                                        return !array.every((value, index) => value === data_arr[index]);
                                    });
                                    console.log("responses_saver array after cancel ",responses_saver)
                                responsesLoader_div.removeChild(response_of_msgmenu)
                                request.removeChild(confirmed_label)
                                request.appendChild(dropBtn)
                                request.appendChild(confirmBtn)

                                let childDivs = responsesLoader_div.getElementsByTagName("div");
                                let numChildDivs = childDivs.length;

                                // Perform an action if there are no child div elements
                                if (numChildDivs === 0) {
                                    console.log("No div elements found inside the parent div.");
                                    msgMenu_div.style.display = "none"

                                }
                            })

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
                let request_msg = request.querySelector(".msg").innerHTML ;
                let requester_id;

                let droped_label = document.createElement("label")
                droped_label.innerHTML = "Droped"
                droped_label.className = "dropedLabel"
        
                request.removeChild(dropBtn)
                request.appendChild(droped_label);

                if (msgMenu_div.style.display === "none") 
                {
                    msgMenu_div.style.display = "block";
                }

                async function getRequesterIddrop(id) 
		        {   
                    try {

                        const response = await $.ajax({
                            url: '{{ route("get_requester_id2", ["request_id" => ":parameter"]) }}'.replace(':parameter', id),
                            method: 'GET'

                        });

                        console.log(response);

                        const requesterId = parseInt(response['user_id']);
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

                    

                    var popupWidth = pop_up_div.offsetWidth;
                    var parentWidth = messagesdiv.offsetWidth;


                    var viewportOffset = request.getBoundingClientRect();

                    var leftOffset = viewportOffset.left + window.pageXOffset + 50;
                    var topOffset = viewportOffset.bottom + window.pageYOffset +5 + 70;


                    // var viewportOffset = request.getBoundingClientRect();
                    // var leftOffset = viewportOffset.left + window.pageXOffset + request.offsetWidth - popupWidth;
                    // var topOffset = viewportOffset.top + window.pageYOffset + request.offsetHeight;

                    leftOffset -= messagesdiv.scrollLeft;

                    pop_up_div.style.left = leftOffset + 'px';
                    pop_up_div.style.top = topOffset  + 'px';

                    messagesdiv.appendChild(pop_up_div)
                    // document.body.appendChild(pop_up_div);

                    
                    console.log(pop_up_textfield.value)
                    // console.log("hola")


                    cancelBtn.addEventListener("click",function(){
                        request.removeChild(droped_label)
                        messagesdiv.removeChild(pop_up_div)
                        request.removeChild(cancelBtn)

                        request.appendChild(dropBtn)
                        request.appendChild(confirmBtn)

                        let childDivs = responsesLoader_div.getElementsByTagName("div");
                                let numChildDivs = childDivs.length;

                                // Perform an action if there are no child div elements
                                if (numChildDivs === 0) {
                                    console.log("No div elements found inside the parent div.");
                                    msgMenu_div.style.display = "none"

                                }
                    })
                    

                    OKbtn.addEventListener("click",function()
                    {
                        messagesdiv.removeChild(pop_up_div)
                        request.removeChild(cancelBtn)
                        


                        // responses_saver.push([request_id , requester_id , dropedupdate , request_msg , pop_up_textfield.innerHTML ])

                        let data_arr = [request_id , requester_id , dropedupdate , request_msg , pop_up_textfield.value ]
                            responses_saver.push(data_arr)

                            let response_of_msgmenu = document.createElement("div")
                            response_of_msgmenu.className = "response_of_msgmenu"
                            // response_of_msgmenu.id =

                                let request_box = document.createElement("div")
                                request_box.className = "request_box" 
                                request_box.innerHTML = request_msg

                                let status_box = document.createElement("div")
                                status_box.className = "status_box"
                                status_box.id = "droped_status_box"
                                status_box.innerHTML = "Droped"

                                let dropReason_box = document.createElement("div")
                                dropReason_box.className = "dropReason_box" 
                                dropReason_box.innerHTML = pop_up_textfield.value

                                let cancelBtn_inMsgLoaderDiv = document.createElement("button")
                                cancelBtn_inMsgLoaderDiv.innerHTML = "Cancel"
                                cancelBtn_inMsgLoaderDiv.className = "cancelBtn_inMsgLoaderDiv"

                            response_of_msgmenu.appendChild(request_box)
                            response_of_msgmenu.appendChild(status_box)
                            response_of_msgmenu.appendChild(dropReason_box)
                            response_of_msgmenu.appendChild(cancelBtn_inMsgLoaderDiv)

                            responsesLoader_div.appendChild(response_of_msgmenu)

                            cancelBtn_inMsgLoaderDiv.addEventListener("click",function()
                            {
                                responses_saver = responses_saver.filter(function(array) {
                                        // Return true for arrays that are not equal to the array to remove
                                        return !array.every((value, index) => value === data_arr[index]);
                                    });
                                    console.log("responses_saver array after cancel ",responses_saver)
                                responsesLoader_div.removeChild(response_of_msgmenu)
                                request.removeChild(droped_label)
                                request.appendChild(dropBtn)
                                request.appendChild(confirmBtn)

                                let childDivs = responsesLoader_div.getElementsByTagName("div");
                                let numChildDivs = childDivs.length;

                                // Perform an action if there are no child div elements
                                if (numChildDivs === 0) {
                                    console.log("No div elements found inside the parent div.");
                                    msgMenu_div.style.display = "none"

                                }
                            })
                        
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


        send_btn.addEventListener("click",function(){
            responses_saver.forEach(arr => 
            {
                // let data_arr = [request_id , requester_id , confirmedupdate , request_msg , emptystring ]
                console.log("request id ",arr[0])
                console.log("requester_id ",arr[1])
                console.log("update value ",arr[2])
                console.log("request_msg ",arr[3])
                console.log("drop reason if exist ",arr[4])
                console.log("")

                        var xhr = new XMLHttpRequest();
                        xhr.open('PUT', '/update/' + arr[0]);
                        xhr.setRequestHeader('Content-Type', 'application/json');
                        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                if (xhr.status === 200) {
                                    console.log('Update successful');
                                    alert('confirm request id  ' + arr[0] +' successful')
                                    // Handle success, if needed
                                } else {
                                    console.error('Error:', xhr.status);
                                    alert('confirm request id ' + arr[0] +' UNsuccesful')
                                    // Handle error, if needed
                                }
                            }
                        };
                        // let emptystring = null
                        console.log("requester_id 2  :::::::: "+arr[1])
                        xhr.send(JSON.stringify(
                            { 
                                updateValue: arr[2] ,
                                request_msg:arr[3] ,
                                requester_id:arr[1] ,
                                request_id:arr[0],
                                reply_msg : arr[4]
                            }));

                            responsesLoader_div.innerHTML= ""
                            msgMenu_div.style.display = "none"
                
            })
        })
   
       
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
   
       

       async function getRequest() 
            {
                try {
                        const response = await $.ajax({
                            url:  '{{ route("get_requester_id") }}',
                            method: 'GET'

                        });
                        return response; // Return the response variable
                    } catch (error) {
                        console.error('Error:', error);
                        // Handle error if needed
                        return null; // Return null or handle error accordingly
                    }
                }
                getRequest()
                .then(response => { 
                    console.log('Response:', response);

                    let droped_replies = document.querySelectorAll('.owner_admin.a0')
                    droped_replies.forEach(function(request) 
                    {
                    let request_id = request.id 
            
                    let droped_label = document.createElement("label")
                    droped_label.innerHTML = "Droped"
                    droped_label.className = "dropedLabel"
                    request.appendChild(droped_label)
   

                        let request_msg ="not yet";
                        // console.log(request_id);
                        // console.log(response);

                        // console.log(response.request_msg)
                        response.forEach(row_dict =>{
                            // console.log(row_dict)
                            // console.log("************************** "+row_dict['id'])
                            // console.log(request_id)
                            if (row_dict['id'] == request_id) {
                                request_msg = row_dict['request_msg'];
                                // console.log("************************** "+row_dict['request_msg'])
                            }
                        } )
                        // console.log(request_msg)

                        // Extract the requester_id from the response
                        // const requesterId = parseInt(response[0].requester_id);
                        // console.log("requester_id 1: " + requesterId);

                        // requester_id = requesterId
                        let reply = request.querySelector('.msg').innerHTML  
                        request.querySelector('.msg').innerHTML = request_msg ;
                        request.querySelector('.dropReason').innerHTML =  reply;

                        // request.appendChild(droped_label)
                        
                        
                    })
                        //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                        //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                        //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

                        let confirmed_replies = document.querySelectorAll('.owner_admin.a1')
                        confirmed_replies.forEach(function(request) 
                        {
                        let request_id = request.id 
                        console.log("owner_admin.a1  => "+request)

           
   
                        let confirmed_label = document.createElement("label")
                        confirmed_label.innerHTML = "Confirmed"
                        confirmed_label.className = "confirmedLabel"
                        
                        
                        request.appendChild(confirmed_label)


                        // console.log(response);

                        // Extract the requester_id from the response
                        // const requesterId = parseInt(response[0].requester_id);
                        // console.log("requester_id 1: " + requesterId);
                        let request_msg ="not yet";
                        // console.log(request_id);
                        // console.log(response);

                        // console.log(response.request_msg)
                        response.forEach(row_dict =>{
                            // console.log(row_dict)
                            // console.log("************************** "+row_dict['id'])
                            // console.log(request_id)
                            if (row_dict['id'] == request_id) {
                                request_msg = row_dict['request_msg'];
                                // console.log("************************** "+row_dict['request_msg'])
                            }
                        } )
                        // console.log(request_msg)

                        // requester_id = requesterId
                        let reply = request.querySelector('.msg').innerHTML  
                        request.querySelector('.msg').innerHTML = request_msg ;
                        request.querySelector('.dropReason').innerHTML =  reply;
                        
                    
           
                    })
           
           
           
                


                    
                })
                .catch(error => {
                    console.error('Error:', error);
                    
                });

   
      //  });
    }
    initializeUsermessagesBox();
   
</script>
{{-- @endif --}}
