
<div class="settings-container">
    <div class="lv-header-alt clearfix m-b-5" style="background: #fff; margin-top: -20px">
        <h2 class="lvh-label hidden-xs">19,453 Records</h2>
        
        <div class="lvh-search" style="display: none;">
            <input type="text" placeholder="Start typing..." class="lvhs-input">
            <i class="lvh-search-close">×</i>
        </div>
        
        <ul class="lv-actions actions">
            <li>
                <a href="" class="lvh-search-trigger">
                    <i class="zmdi zmdi-search"></i>
                </a>
            </li>
            <li>
                <a href="" id="settings-user-delete">
                    <i class="zmdi zmdi-delete"></i>
                </a>
            </li>
            <li class="dropdown">
                <a href="" data-toggle="dropdown" aria-expanded="true">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
    
                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        <a href="">10 per page</a>
                    </li>
                    <li>
                        <a href="">25 per page</a>
                    </li>
                    <li>
                        <a href="">50 per page</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>

    <button class="btn btn-float bgm-amber m-btn waves-effect waves-circle waves-float" id="settings-add-user-modal">
        <i class="zmdi zmdi-plus"></i>
    </button>

    <div class="row userRow">

        <div class="table-responsive tableUser">
            <table id="settings-user-list" class="table-condensed table-hover">
                <thead>
                    <tr>
                        <th data-column-id="id" data-visible="false" data-sortable="false" data-identifier="true">
                            ID
                        </th>
                        <!-- <th data-column-id="name" data-order="asc">Name</th> -->
                        <th data-column-id="first_name" data-order="asc">Firstname</th>
                        <th data-column-id="last_name" data-order="asc">Lastname</th>
                        <th data-column-id="username">Email</th>
                        <th data-column-id="active">Status</th>
                        <th data-column-id="role" data-sortable="false">Role</th>
                        <th data-column-id="last_login" data-sortable="true">Last Login</th>
                        <!-- <th data-column-id="commands" data-formatter="commands" data-sortable="false">Action</th> -->
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>
        </div>
    </div>
</div>