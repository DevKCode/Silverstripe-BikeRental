<div class="content-container unit size3of4 lastUnit">


    <div id="weekdays" class="d-inline-flex ">

    </div>
    <div class="list-group ">
        <% loop $getBikes %>
            <div class="w-50 d-inline-flex m-3 p-1 align-items-center justify-content-between border border-primary rounded ">
                <span class="flex-grow-0 font-weight-bold">$Name</span>
                <span> Price per Hour $ : $PerHourCharge</span>
                <button class="btn btn-success btn-sm" >Book</button>
            </div>

        <% end_loop %>
    </div>
</div>
