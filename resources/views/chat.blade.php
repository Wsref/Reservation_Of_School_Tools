@extends('layouts.master')
 
@section('content')


<div class="container123"  style="margin-left=0;margin-right=0;">
    <div class="usersSideBar">
        <x-userSideBarchat :users="$users" :user="$user"/>
    </div>
    <div class="messages" id="messages">
        <x-UsermessagesBox  :user_requests_data="$user_requests_data" :admin_replies_data="$admin_replies_data"  :user="$user" :chatData="$chatData"  />
    </div>
    <div class="userData" id="userData">
        <x-UserGeneralData   :user="$user" />
    </div>
</div>




<style>

    
    .container123{
        margin-top: 50px;
        display: flex;
        height: 100%;
    }

    .usersSideBar , .userData , .messages {
        background-color: rgb(242, 242, 242);
        /* border: 1px solid black; */
        height: 100%;
        /* border-bottom: 5px solid rgb(0, 59, 161) ; */
    }
    .usersSideBar , .userData {
        flex: 0 0 20%;
    }



    .messages {
    background-color: rgb(243, 237, 237);
    height: 600px;
    overflow-y: hidden; /* Hide vertical scrollbar initially */
    overflow-x: hidden; /* Hide horizontal scrollbar */
    flex: 0 0 60%;
    
}
.messages:hover{
        overflow: auto;
    }

/* Style the scrollbar */
.messages::-webkit-scrollbar {
    width: 8px; /* Width of the scrollbar */
}

/* Style the scrollbar thumb */
.messages::-webkit-scrollbar-thumb {
    background-color: #888; /* Color of the scrollbar thumb */
    border-radius: 4px; /* Border radius of the scrollbar thumb */
}

/* Style the scrollbar track */
.messages::-webkit-scrollbar-track {
    background-color: #f1f1f1; /* Color of the scrollbar track */
}

/* Adjust scrollbar appearance when hovering */
.messages:hover::-webkit-scrollbar-thumb {
    background-color: #555; /* Color of the scrollbar thumb on hover */
}




    .usersSideBar {
    margin-right: 5px;
    background-color: rgb(255, 255, 255);
    height: 600px;
    overflow-y: scroll; /* Enable vertical scrollbar */
    overflow-x: hidden; /* Hide horizontal scrollbar */
    display: flex;
    flex-direction: column;
}

/* Style the scrollbar */
.usersSideBar::-webkit-scrollbar {
    width: 8px; /* Width of the scrollbar */
}

/* Style the scrollbar thumb */
.usersSideBar::-webkit-scrollbar-thumb {
    background-color: #888; /* Color of the scrollbar thumb */
    border-radius: 4px; /* Border radius of the scrollbar thumb */
}

/* Style the scrollbar track */
.usersSideBar::-webkit-scrollbar-track {
    background-color: #f1f1f1; /* Color of the scrollbar track */
}

/* Adjust scrollbar appearance when hovering */
.usersSideBar:hover::-webkit-scrollbar-thumb {
    background-color: #555; /* Color of the scrollbar thumb on hover */
}





    .usersSideBar:hover{
        overflow:auto;
    }
    .userData{
        background-color: rgb(255, 255, 255);
        height:600px; 
        /* overflow: auto; Make the div scrollable */
        /* border: 1px solid black;  */
        display: flex;
    flex-direction: column; 

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
</script>
    --}}


@endsection