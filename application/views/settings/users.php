<div class="listview lv-bordered lv-lg">
    <div class="lv-header-alt clearfix m-b-5">
        <h2 class="lvh-label hidden-xs" id="settings-user-list-count">0 Record(s)</h2>
        
        <div class="lvh-search">
            <input type="text" placeholder="Start typing..." class="lvhs-input" id="settings-user-list-search">
            <i class="lvh-search-close">×</i>
        </div>
        
        <ul class="lv-actions actions">
            <li>
                <a data-toggle="modal" href="#modal-add-user"
                 class="rotate-image">
                    <i class="zmdi zmdi-plus"></i>
                </a>
            </li>
            <li>
                <a href="" class="lvh-search-trigger" 
                 data-toggle="tooltip" 
                 data-placement="top" 
                 data-original-title="Search Table">
                    <i class="zmdi zmdi-search"></i>
                </a>
            </li>
            <!-- <li>
                <a id="settings-user-list-delete"
                 data-toggle="tooltip" 
                 data-placement="top"
                 data-original-title="Delete Report"
                 >
                    <i class="zmdi zmdi-delete"></i>
                </a>
            </li> -->
            <li>
                <a id="settings-user-list-refresh" 
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
                
                <ul class="dropdown-menu dropdown-menu-right" id="settings-user-list-page">
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
        <table id="settings-user-list" class="table-condensed table-hover">
            <thead>
                <tr>
                    <th data-column-id="id" data-visible="false" data-sortable="false" data-identifier="true">
                        ID
                    </th>
                    <!-- <th data-column-id="image" data-sortable="false">image</th> -->
                    <th data-column-id="first_name" data-order="asc">Firstname</th>
                    <!-- <th data-column-id="name" data-order="asc">Name</th> -->
                    <th data-column-id="last_name" data-order="asc">Lastname</th>
                    <th data-column-id="username">Email</th>
                    <th data-column-id="active" data-formatter="active">Status</th>
                    <th data-column-id="role" data-sortable="false">Role</th>
                    <th data-column-id="last_login" data-formatter="last_login" data-sortable="true">Last Login</th>
                    
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
        
    </div>
</div>