<div id="weekdays flex flex-column justify-content-between" >

    <% loop $getBikes %>
        <div class="w-50 h-100  m-3 p-1 d-lg-inline-flex flex-row    border border-primary rounded ">
            <span class=" font-weight-bold m-2">$name</span>
            <span class="m-2"> Price per Hour $ : $hourCharge</span>
            <span class="m-2"> Avail Qty : $qty</span>
            <button class=" m-2 btn btn-success btn-sm" >Book</button>
        </div>

    <% end_loop %>
</div>


