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
              <input  type="radio" name="gender" id="male" value="male"><label for="male">Male</label>
              <br>
              <input  type="radio" name="gender" id="female" value="female"><label for="female">Female</label>
            </div>
          </div>

          <div class="option">
            <button class="toggle-btn">Year</button>
            <div class="items">
              {{-- <a href="#">Option 1</a>
              <a href="#">Option 2</a> --}}
              <input  type="radio" name="year" id="year1" value="year1"><label for="year1">1</label>
              <br>
              <input  type="radio" name="year" id="year2" value="year2"><label for="year2">2</label>
            </div>
          </div>

          <div class="option">
            <button class="toggle-btn">Branch</button>
            <div class="items">
              {{-- <a href="#">Option 1</a>
              <a href="#">Option 2</a> --}}
              <input  type="radio" name="branch" id="GI" value="GI"><label for="GI">GI</label>
              <br>
              <input  type="radio" name="branch" id="GE" value="GE"><label for="GE">Female</label>
              <br>
              <input  type="radio" name="branch" id="TCC" value="TCC"><label for="TCC">Female</label>

            </div>
          </div>

          <div class="option">
            <button class="toggle-btn">Borrowing</button>
            <div class="items">
              {{-- <a href="#">Option 1</a>
              <a href="#">Option 2</a> --}}
              <input  type="radio" name="borrowing" id="football" value="football"><label for="football">Football</label>
              <br>
              <input  type="radio" name="borrowing" id="basketball" value="basketball"><label for="basketball">basketball</label>
              <br>
              <input  type="radio" name="borrowing" id="pingpong" value="pingpong"><label for="pingpong">Ping-Pong</label>
              <br>
              <input  type="radio" name="borrowing" id="none" value="none"><label for="none">None</label>
            </div>
          </div>

    </div>

    <div class="users">
        {{-- <div class="user">
            <table>
                <tr>
                  <th>Family name</th>
                  <th>Personal name</th>
                  <th>Year</th>
                  <th>Branch</th>
                  <th>Now Borrowing</th>
                </tr>
              </table>
        </div> --}}
        <div class="table-container">
            <div class="table-row table-header">
              <div class="table-cell">Family name</div>
              <div class="table-cell">Personal name</div>
              <div class="table-cell">Year</div>
              <div class="table-cell">Branch</div>
              <div class="table-cell">Now Borrowing</div>
            </div>

            @foreach ($users as $user)
            {{-- <a href="/users/{{$user['id']}}">
                <div class="table-row">
                    <div class="table-cell">{{$user['fname']}}</div>
                    <div class="table-cell">{{$user['pname']}}</div>
                    <div class="table-cell">{{$user['year']}}</div>
                    <div class="table-cell">{{$user['branch']}}</div>
                    <div class="table-cell">none</div>
                </div>
            </a> --}}
            <x-user :user="$user" />

            @endforeach

            {{-- <div class="table-row">
                <div class="table-cell">Family name</div>
                <div class="table-cell">Personal name</div>
                <div class="table-cell">Year</div>
                <div class="table-cell">Branch</div>
                <div class="table-cell">Now Borrowing</div>
              </div>
              <div class="table-row">
                <div class="table-cell">Family name</div>
                <div class="table-cell">Personal name</div>
                <div class="table-cell">Year</div>
                <div class="table-cell">Branch</div>
                <div class="table-cell">Now Borrowing</div>
              </div> --}}

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
    border-bottom: 1px solid black
  }
  .table-row:hover{
    background-color: rgb(59, 59, 59);
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

@endsection