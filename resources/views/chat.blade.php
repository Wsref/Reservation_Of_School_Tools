@extends('layouts.master')

@section('content')


<div class="container">
    <div class="usersSideBar">
        <x-userSideBarchat :users="$users" />
    </div>
    <div class="messages" id="messages">
        <x-UsermessagesBox  :msgdata="$msgdata" :user="$user" />
    </div>
    <div class="userData" id="userData">
        <x-UserGeneralData   :user="$user" />
    </div>
</div>


@endsection

<style>
    .container{
        margin-top: 50px;
        display: flex;
        height: 100%;
    }

    .usersSideBar , .userData , .messages {
        background-color: rgb(242, 242, 242);
        border: 1px solid black;
        height: 100%;
    }
    .usersSideBar , .userData {
        flex: 0 0 20%;
    }
    .messages{
        flex: 0 0 60%;
    }
    .usersSideBar{
        display: flex;
    flex-direction: column; 
    }






    
</style>