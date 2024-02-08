@props(['msgdata','user'])

{{-- <h1 class="user">hi it's {{$user['pname']}} mesg box </h1> --}}

@foreach ($msgdata as $msg)
    <div class="{{$msg->the_sender}}msg" >  
        {{$msg->msg}}
        <div class="statusBtns">
            {{-- <button></button> --}}
        </div>
        <label for=""> {{$msg->msg_time}} </label> 
    </div>
@endforeach


<style>
    .usermsg , .adminmsg{
        padding: 5px;
        background-color:rgb(178, 179, 181);
        border-radius: 5px;
        border-bottom: 0.6px solid black;

    }
    .usermsg{
        background-color: rgb(72, 72, 72);
        color: white;
        margin-right: 30px;

    }
    .adminmsg{
        background-color: rgb(230, 210, 210) ;
        margin-left: 30px;
    }
    label{
        font-size: 10px;
        /* font: small; */
        color: red;
    }
</style>

<script>

</script>