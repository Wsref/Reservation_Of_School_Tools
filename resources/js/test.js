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