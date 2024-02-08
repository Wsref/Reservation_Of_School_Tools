@props(['borrows'])


<a href="">
    <div class="table-row" id="title">
        <div class="table-cell">Date</div>
        <div class="table-cell">Borrow</div>
        <div class="table-cell">Time</div>
    </div>
</a>


@foreach($borrows as $borrow)
    <a href="">
        <div class="table-row">
            <div class="table-cell">{{$borrow['dateBorrow']}}</div>
            <div class="table-cell">{{$borrow['material']}}</div>
            <div class="table-cell">{{$borrow['timeBorrow']}}</div>
        </div>
    </a>
@endforeach



<style>
    #title{
        color: 3px solid black;
        font-weight: bold;
    }

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
        border-bottom: 3px solid black;
    }
</style>