<div class="listview lv-bordered lv-lg">
    <div class="lv-header-alt clearfix m-b-5">
        <h2 class="lvh-label hidden-xs" id="inventory-quantity-table-count">0 Record(s)</h2>
        <ul class="lv-actions actions">
           
            <li>
                <a id="inventory-quantity-table-refresh" 
                 data-toggle="tooltip" 
                 data-placement="top" 
                 data-original-title="Refresh Table" >
                    <i class="zmdi zmdi-refresh-sync"></i>
                </a>
            </li>
            <li class="dropdown">
                <a href="" data-toggle="dropdown" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                
                <ul class="dropdown-menu dropdown-menu-right" id="inventory-quantity-table-page">
                    <li class="active">
                        <a href="" page="10">10 per page</a>
                    </li>
                    <li>
                        <a href="" page="25">25 per page</a>
                    </li>
                    <li>
                        <a href="" page="50">50 per page</a>
                    </li>
                    <li>
                        <a href="" page="100">100 per page</a>
                    </li>
                    <li>
                        <a href="" page="-1">All</a>
                    </li>
                </ul>
            </li>
            
        </ul>
    </div>

    <div class="table-responsive">
        <table id="inventory-quantity-table" class="table-condensed table-hover">
            <thead>
                <tr>
                    <th data-column-id="id" data-visible="false" data-identifier="true">ID</th>
                    <th data-column-id="date"  data-sortable="false">Date</th>
                    <th data-column-id="type"  data-sortable="false">Type</th>
                    <th data-column-id="number" data-sortable="false">Number</th>
                    <th data-column-id="customer"  data-sortable="false" data-width="500">Customer</th>
                    <th data-column-id="description" data-sortable="false" data-width="500">Description</th>
                    <th data-column-id="add" data-sortable="false">+</th>
                    <th data-column-id="minus" data-sortable="false">-</th>
                    <th data-column-id="prev" data-sortable="false" data-align="right">Previous</th>
                    <th data-column-id="current" data-sortable="false" data-align="right">Current</th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
        
    </div>
</div>