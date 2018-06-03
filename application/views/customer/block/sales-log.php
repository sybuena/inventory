<div class="listview lv-bordered lv-lg">
    <div class="lv-header-alt clearfix m-b-5">
        <h2 class="lvh-label hidden-xs" id="customer-sales-table-count">0 Record(s)</h2>
        
        <div class="lvh-search">
            <input type="text" placeholder="Start typing..." class="lvhs-input" id="customer-sales-table-search">
            <i class="lvh-search-close">×</i>
        </div>
        
        <ul class="lv-actions actions">
            
            <li>
                <a href="" class="lvh-search-trigger" 
                 data-toggle="tooltip" 
                 data-placement="top" 
                 data-original-title="Search Table">
                    <i class="zmdi zmdi-search"></i>
                </a>
            </li>
            <li>
                <a id="customer-sales-table-refresh" 
                 data-toggle="tooltip" 
                 data-placement="top" 
                 data-original-title="Refresh Table" >
                    <i class="zmdi zmdi-refresh-sync"></i>
                </a>
            </li>
            <li class="dropdown">
                <a href="" data-toggle="dropdown" >
                    <i class="zmdi zmdi-sort-amount-desc"></i>
                </a>
                
                <ul class="dropdown-menu dropdown-menu-right" id="customer-sales-table-status">
                    <li class="active">
                        <a href="" status="0">All Status</a>
                    </li>
                    <li>
                        <a href="" status="1">Pending Status</a>
                    </li>
                    <li>
                        <a href="" status="2">Draft Status</a>
                    </li>
                    <li>
                        <a href="" status="3">Approved Status</a>
                    </li>
                    <li>
                        <a href="" status="4">Declined Status</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="" data-toggle="dropdown" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                
                <ul class="dropdown-menu dropdown-menu-right" id="customer-sales-table-page">
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
        <table id="customer-sales-table" class="table-condensed table-hover">
            <thead>
                <tr>
                    <th data-column-id="id" data-visible="false" data-identifier="true">ID</th>
                    <th data-column-id="invoice_number" data-order="asc">Invoice #</th>
                    <th data-column-id="reference_number" data-order="asc">Reference #</th>
                    <th data-column-id="date" data-sortable="false">Date</th>
                    <th data-column-id="due_date" data-sortable="false">Due Date</th>
                    <th data-column-id="total_amount" data-sortable="false" data-align="right">Amount</th>
                    <th data-column-id="status_text" data-formatter="status_text" data-sortable="false">Status</th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
        
    </div>
</div>