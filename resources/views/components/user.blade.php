@props(['users','borrows','Mat_reservs'])

@foreach ($users as $user)
<a href="/users/{{$user['id']}}">
    <div class="table-row">
        <div class="table-cell">{{$user['fname']}}</div>
        <div class="table-cell">{{$user['pname']}}</div>
        <div class="table-cell">{{$user['year']}}</div>
        <div class="table-cell">{{$user['branch']}}</div>
        <div class="table-cell"> 
            <?php
            // dd($Mat_reservs);
                
            $borrowed = false;
            foreach ($Mat_reservs as $reserve) {
                // echo $reserve->user_id." ".$reserve->materiels->name."<br>" ;
            if ( $reserve->user_id == $user['id'] && $reserve->date_reserve == '2024-03-02') {
                $borrowed= true ;
                echo $reserve->materiels->name."  x".$reserve->quantite;
            }
            }
            if (!$borrowed) {
                echo "none";
            } ?> </div>
    </div>
</a>
@endforeach

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
</style>