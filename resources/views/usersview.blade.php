@extends('layouts.master')

@section('content')
<div class="users_container">
    {{-- <h1>hhhhhhhhhhhhhhhhhhhhhhh</h1> --}}
    <div class="options">
        <p class="suggested">Suggested</p>
        <div class="option">
            <button class="toggle-btn">Gender</button>
            <div class="items">
              {{-- <a href="#">Option 1</a>
              <a href="#">Option 2</a> --}}
              <input class="CheckBox gender"  type="checkbox" name="gender" id="male" value="male"><label for="male">Male</label>
              <br>
              <input class="CheckBox gender" type="checkbox" name="gender" id="female" value="female"><label for="female">Female</label>
            </div>
          </div>

          <div class="option">
            <button class="toggle-btn">Year</button>
            <div class="items">
              {{-- <a href="#">Option 1</a>
              <a href="#">Option 2</a> --}}
              <input class="CheckBox year" type="checkbox" name="year" id="year1" value="year1"><label for="year1">1</label>
              <br>
              <input class="CheckBox year" type="checkbox" name="year" id="year2" value="year2"><label for="year2">2</label>
            </div>
          </div>

          <div class="option">
            <button class="toggle-btn">Branch</button>
            <div class="items">
              {{-- <a href="#">Option 1</a>
              <a href="#">Option 2</a> --}}
              <input class="CheckBox branch" type="checkbox" name="branch" id="GI" value="GI"><label for="GI">GI</label>
              <br>
              <input class="CheckBox branch" type="checkbox" name="branch" id="GE" value="GE"><label for="GE">GE</label>
              <br>
              <input class="CheckBox branch" type="checkbox" name="branch" id="TCC" value="TCC"><label for="TCC">TCC</label>

            </div>
          </div>

          <div class="option">
            <button class="toggle-btn">Borrowing</button>
            <div class="items">
              {{-- <a href="#">Option 1</a>
              <a href="#">Option 2</a> --}}
              <input class="CheckBox Borrowing" type="checkbox" name="borrowing" id="football" value="football"><label for="football">Football</label>
              <br>
              <input class="CheckBox Borrowing" type="checkbox" name="borrowing" id="basketball" value="basketball"><label for="basketball">basketball</label>
              <br>
              <input class="CheckBox Borrowing" type="checkbox" name="borrowing" id="pingpong" value="pingpong"><label for="pingpong">Ping-Pong</label>
              <br>
              {{-- <input  type="checkbox" name="borrowing" id="none" value="none"><label for="none">None</label> --}}
            </div>
          </div>

    </div>

    <div class="users">

        <div class="table-container">
            <div class="table-row table-header">
              <div class="table-cell">Family name</div>
              <div class="table-cell">Personal name</div>
              <div class="table-cell">Year</div>
              <div class="table-cell">Branch</div>
              <div class="table-cell">Now Borrowing</div>
            </div>

            <div class="users_data" id="users_data_div">

              <x-user :users="$users" :borrows="$borrows"/>

            </div>

        </div>
    </div>

</div>

<style>
  a {
      color: inherit; /* Sets the color to inherit from the parent element */
      text-decoration: none; /* Removes the underline */
  }
  a:hover {
      text-decoration: none; /* Removes the underline when hovering */
  }


        .table-container {
      display: flex;
      flex-direction: column;
      /* border-bottom: 1px solid black; Add border at the bottom of the entire table */
    }

    .table-row {
      display: flex;
      border-bottom: 1px solid black;
      transition: background-color 0.5s;
    }
    .table-row:hover{
      background-color: rgb(162, 162, 162);
      color: white;
    }

    .table-cell {
      flex: 1;
      padding: 8px; /* Add padding for cell content */
      /* border-right: 1px solid black; Add border to the right of each cell */
    }

    /* Remove the border from the last cell in each row */
    .table-row .table-cell:last-child {
      border-right: none;
    }

    /* Optional: Style for the table header */
    .table-header {
      font-weight: bold;
      border-bottom: 3px solid black
    }
      .options{
          padding: 10px;
          /* border-width: 10px */
          border-radius: 10px;
          border: 1px solid black;
          border-color: black;
          display: flex;
          justify-content: space-between;

      }
      .option {
      position: relative;
      display: inline-block;
      /* background-color: yellowgreen */

    }
    .option button{
      /* background-color: yellowgreen */
      border-radius: 10px;
      padding: 10px;

    }

    .items {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
      z-index: 1;
      padding: 10px;
      border-radius: 10px;
      /* background-color: blue */
    }

    .items input {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      /* display: block; */
    }

    .items input:hover {
      background-color: #f1f1f1;
    }

    /* Show the dropdown menu when the button is clicked */
    .option:hover .items {
      display: block;
    }
      .users_container{
          margin-top: 50px;
          margin-left: 10px;
          margin-right: 10px;
      }

</style>

<script>


  // let male_checker = document.getElementById("male")
  let users_data_div = document.getElementById("users_data_div")

  var checkboxes = document.querySelectorAll(".CheckBox");

// Loop through each checkbox
checkboxes.forEach(function(checkbox) {

  checkbox.addEventListener("change" , function(){
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
        users_data_div.innerHTML = ""
        filter_request()
      }
  })
});

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
      let genders_check_status = get_checkboxSet_status("gender")
      let years_check_status = get_checkboxSet_status("year")
      let branches_check_status = get_checkboxSet_status("branch")
      let borrowings_check_status = get_checkboxSet_status("borrowing")

      xhr.send(JSON.stringify(
          { 
              // gender : genders_check_status ,
              year : years_check_status ,
              branch : branches_check_status ,
              // borrowing : borrowings_check_status,
          }));
      
  }
  function get_checkboxSet_status(checkbox_set_classer)
    {
      let arr=[];
      let checkbox_set = document.querySelectorAll(".CheckBox."+checkbox_set_classer)
      checkbox_set.forEach(checkbox => {
          if (checkbox.checked) {
              arr.push(Number.isFinite(parseInt(checkbox.value)) ? parseInt(checkbox.value) : checkbox.value)
          }
      })
      return arr ;


    }
</script>

@endsection