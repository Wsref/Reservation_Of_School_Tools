@props(['user'])

{{-- <h5 class="user">hi it's {{$user['pname']}} general data </h5> --}}

<div class="bare">
    <div class="circle"><img src="" alt=""></div>
</div>
<div class="dataccc" >
    <div class="fullname"> {{$user['pname']}} {{$user['fname']}} </div>
    <div class="schoolInfo">
        <div class="title">School Info</div>
        <div class="schoolInfoData"> {{$user['branch']}} {{$user['year']}}  </div>
    </div>
</div>

<style>
    .fullname , .schoolInfo{
        /* background-color: black ; */
        color: rgb(255, 255, 255) ;
        
    }
    .dataccc{
        margin-left: 8px;
        margin-right: 8px;
        margin-top: 90px ; 
        border-radius: 7px;
        padding: 4px;
        /* display: flex ; */
        /* flex-direction: column ; */
        height: 150px;
        background-color: rgb(0, 0, 0)
        
    }
    .circle{
        width: 40px;
        height: 40px;
        border-radius:100px ;
        background-color: black ;
        padding: 10px;
        border-color:rgb(255, 255, 255) ;

    }
    .bare{
        height: 100px;
        width: 100% ;
        border-radius: 4px;
        background-color: rgb(228, 255, 251) ;
        border-bottom: 0.4px solid black;

    }
</style>

