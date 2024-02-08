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
    
    
}

let usediv = document.querySelector('.user')
usediv.addEventListener("click",LoadMsgBox)
document.getElementsByClassName