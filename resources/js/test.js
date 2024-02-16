let overviewBtn= document.getElementById("overview")
overviewBtn.addEventListener("click",showOverview)

let activitiesBtn = document.getElementById("activities")
activitiesBtn.addEventListener("click",showActivities)

function showOverview() {

    
}

function showActivities() {


    activitiesBtn.className = "OAbtnChosen"

    fetch('get-data')
    .then(response => response.json())
    .then(data=> {console.log(data);
        // let borrowtitles = document.createElement("div")
        let container = document.getElementById("container")
        let borrow = document.createElement('x-userBorrow')
        borrow.borrows=data;

        container.append(borrow)
        
    }).catch(er=>console.log(er));

    let v="5"
    let msg = document.querySelector(".user")
    pop_up_div.style.left = request.offsetLeft + 'px';
//     msg.off
// // msg.appendChild
let responses_saver = []
var innerHTML = parentDiv.querySelector("span").innerHTML;
m
//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
function filter_request() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/reLoad_filtered_Users');
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Request successful
                var htmlResponse = xhr.responseText; // HTML content returned from the server
                // Manipulate the HTML or insert it into the DOM
                users_data_div.innerHTML = htmlResponse;
            } else {
                console.error('Error:', xhr.status);
                // Handle error, if needed
            }
        }
    };
    //get checkings 
    xhr.send(JSON.stringify(
        { 
            genders: arr[2] ,
            years:arr[3] ,
            branches:arr[1] ,
            borrowings:arr[0],
        }));
    
}

let male_checker = document.getElementById("male")
let users_data_div = document.getElementById("users_data_div")
male_checker.addEventListener("change" , function(){
    if (this.checked) {
        users_data_div.innerHTML = ""

        // fetch('/get-borrows-html')
        // .then(response => response.text()) // Parse the response as text
        // .then(html => {
        //     // let container = document.getElementById("container");
        //     users_data_div.innerHTML = html; // Set the HTML content to the container element
        // })
        // .catch(error => console.error('Error:', error));

        filter_request()


        
    } else {
        
    }
})
let arr=[];
let checkbox_set = document.querySelectorAll(".CheckBox."+checkbox_set_classer)
checkbox_set.forEach(checkbox => {
    if (checkbox.checked) {
        arr.push(Number.isFinite(parseInt(checkbox.value)) ? parseInt(checkbox.value) : checkbox.value)
    }
})
//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// responses_saver.push()


//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

    let not_replied_requests = document.querySelectorAll(".user.-1")
    // not_replied_requests.forEach
    not_replied_requests.forEach(function(request) {
        let request_id = request.id
        // let requester_id = {!! json_encode($user_requests_data->requester_id) !!};
parseInt
consol.log("requester_id   :::::::: "+requester_id)

        $.ajax({
            url: '{{ route("get_requester_id") }}',
            method: 'GET',
            success: function(response) {
                console.log(response);
                // Handle the response data
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });

        let pop_up_textfield = document.createElement("textarea")
        pop_up_textfield.placeholder = "put drop reason here"
        pop_up_textfield.className = "pop_up_textfield"

        let OKbtn = document.createElement("button")
        OKbtn.textContent="OK!"
        

        let pop_up_div = document.createElement("div")
        pop_up_div.className="pop_up_div"
        pop_up_div.append(pop_up_textfield)
        pop_up_div.append(OKbtn)

        // parentDiv.insertBefore(newDiv, existingDiv.nextSibling);
        request.insertBefore(pop_up_div , dropBtn.nextSibling)




        let confirmBtn = document.createElement("button")
        confirmBtn.className = "confirmBtn" ;
        confirmBtn.id = request_id ;

        confirmBtn.addEventListener("click",function(){
            request.removeChild(dropBtn)
            alert('')
            console.log("confirm button of id :"+confirmBtn.id+" was clicked")
        })

        let dropBtn = document.createElement("button")
        dropBtn.className = "dropBtn" ;
        dropBtn.id = request_id ;

        dropBtn.addEventListener("click",function(){
            console.log("drop button of id :"+dropBtn.id+" was clicked")
        })

        request.appendChild(dropBtn);
        request.appendChild(confirmBtn);

        // Do something with each element
        // console.log(request);
    });

    let dropped_requests = document.querySelector(".user.0")
    dropped_requests.forEach(function(request) {
        let request_id = request.id 

        let droped_label = document.createElement("label")
        droped_label.innerHTML = "Droped"

        
    })

    let confirmed_requests = document.querySelector(".user.1")
    confirmed_requests.forEach(function(request) {
        let request_id = request.id 

        let confirmed_label = document.createElement("label")
        confirmed_label.innerHTML = "Confirmed"
        
        
    })

    // //!/======================================

    let droped_replies = document.querySelector(".admin.0")
    droped_replies.forEach(function(request) {
        let request_id = request.id 

        let droped_label = document.createElement("label")
        droped_label.innerHTML = "Droped"
        
        
    })

    let confirmed_replies = document.querySelector(".admin.1")
    confirmed_replies.forEach(function(request) {
        let request_id = request.id 

        let confirmed_label = document.createElement("label")
        confirmed_label.innerHTML = "Confirmed"
        
        
    })



    
    
}

let usediv = document.querySelector('.user')
usediv.addEventListener("click",LoadMsgBox)
document.getElementsByClassName