@extends('layouts.master')

@section('content')
<div class="user_container">
    <div class="general_info">
        <div class="data">
            <h2 class="fullname"> {{$user['fname']}} {{$user['pname']}} </h2>
            <h6 class="branch">Branch: {{$user['branch']}} </h6>
            <h6 class="year">Year: {{$user['year']}} </h6>
        </div>
        <div class="chat">
            <div class="chatbtn">
                <a href="/users/{{$user['id']}}/chat">Chat</a>
            </div>
            
        </div>

    </div>
    <div class="borrowdata">
        <div class="account">
            <h4>Account</h4>
            <h4 class="account"> {{$user['email']}} </h4>
        </div>
        <div class="overview_activity">
            <div class="titles">
                {{-- <input type="radio" valu><label for=""></label> --}}
                <button class="OAbtnnNotChosen" id="overview">Overview</button>
                <button class="OAbtnChosen" id="activities">Activities</button>
                {{-- to add curently --}}
            </div>
            <div class="content" id="container">
                {{-- <x-userborrowcharts :borrows="$user" /> --}}
            </div>
        </div>
    </div>


</div>

{{-- <script src="../js/test.js"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script> --}}



<script>
    
    let overviewBtn= document.getElementById("overview")
    overviewBtn.addEventListener("click",showOverview)
    
    let activitiesBtn = document.getElementById("activities")
    activitiesBtn.addEventListener("click",showActivities)

    let userComponent = document.querySelector('x-userborrowcharts');

    function showOverview() 
    {
        activitiesBtn.className = "OAbtnnNotChosen"
        overviewBtn.className = "OAbtnChosen"

        // userComponent.style.display = "block";

        let container = document.getElementById("container");
        container.innerHTML = ""

        fetch('/get-borrows-chart-html')
        .then(response => response.text()) // Parse the response as text
        .then(html => {
            // let container = document.getElementById("container");
            container.innerHTML = html; // Set the HTML content to the container element
        })
        .catch(error => console.error('Error:', error));
        initializechart();

        

//         let ctx = document.getElementById("myChart").getContext('2d');
// // Create the chart
// let myChart = new Chart(ctx, {
//     type: 'bar',
//     data: {
//         labels: ['January', 'February', 'March', 'April', 'May'],
//         datasets: [{
//             label: 'Sales',
//             data: [10, 20, 30, 40, 50],
//             backgroundColor: 'rgba(255, 99, 132, 0.2)', // Bar color
//             borderColor: 'rgba(255, 99, 132, 1)', // Border color
//             borderWidth: 1
//         },
//     {
//         label: 'loss',
//             data: [60, 2, 31, 40, 50],
//             backgroundColor: 'rgba(25, 99, 132, 0.2)', // Bar color
//             borderColor: 'rgba(255, 99, 132, 1)', // Border color
//             borderWidth: 1
//     }]
//     },
//     options: {
//         scales: {
//             yAxes: [{
//                 ticks: {
//                     beginAtZero: true
//                 }
//             }]
//         }
//     }
// });

    };
        
        
    
    
    function showActivities() {
    //     fetch('/get-borrows')
    // .then(response => response.json())
    // .then(data=> {console.log(data);
    //     // let borrowtitles = document.createElement("div")
    //     let container = document.getElementById("container")
    //     let borrow = document.createElement('x-userBorrow')
    //     borrow.borrows=data;

    //     container.append(borrow)
        
    // }).catch(er=>console.log(er));

    activitiesBtn.className = "OAbtnChosen"
    overviewBtn.className = "OAbtnnNotChosen"

    // userComponent.style.display = "none";

    fetch('/get-borrows-html')
        .then(response => response.text()) // Parse the response as text
        .then(html => {
            let container = document.getElementById("container");
            container.innerHTML = html; // Set the HTML content to the container element
        })
        .catch(error => console.error('Error:', error));

    };


</script>


{{-- <h2>{{$user->'pname'}}</h2> --}}
    
@endsection

<style>
    .content{
        height: 500px;
        width:100%;
    }

    .OAbtnnNotChosen{
        color: rgb(255, 255, 255);
        background-color:rgb(49, 49, 49);
        border-radius: 5px;
        /* border: none; */
        
    }
    .OAbtnChosen{
        /* background-color: rgb(235, 235, 255); */
        border-radius: 5px;
        /* border: none; */

    }
    #activities , #overview{ 
        /* height: 25px; */
        margin-top: 15px;
        border: none;

    }
    #activities{
        margin-left: 15px;
    }

    .titles button:active {
    border: none; /* Removes the border when button is clicked */
 }

    .titles{
        /* color:  */
        height: 50px;
        display: flex;
        align-content: space-between;
        border-radius: 6px;
        /* text-align:; */
        background-color: rgb(49, 49, 49);
        
        
        
    }

    .overview_activity{
        /* height:auto; */
        /* background-color: tomato; */
    }
    .borrowdata{
        padding: 10px;
        /* background-color: yellow; */
    }
    .chatbtn a{
        background-color: rgb(114, 169, 217);
        border-radius: 10px;
        padding: 10px;
        text-decoration: none;
        color: black;

    }
    .chatbtn a:hover{
        text-decoration: none;
    }
    
    .data{
        flex-grow: 1;
    }
    .chat{
        display: flex;
    flex-direction: column;
    justify-content: flex-end;
    }
    .general_info{
        display: flex;
        background-color: rgb(235, 235, 255);
        border-radius: 8px;
        padding: 10px; 
        padding-right: 15px;
        width:100%;
        /* border-radius */

    }
        .user_container{
        margin-top: 100px;
        display: grid;
        
        /* padding: 10px; */
        /* padding-right: 15px; */
        /* width:100%; */
        
    }
</style>