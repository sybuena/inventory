<style>
#main-record-call-modal .modal-header {
    background-color: #ffc107;
}
#main-record-call-modal .modal-title {
    color: white
}

#main-record-call-timer {
    height: 70px;
    padding: 10px 16px;
    font-size: 50px;
    line-height: 1.3333333;
    border-radius: 0px;
    background-color: #ff5722;
    border-bottom: none;
    color:white !important;
    text-align: center;
}
.color-go {
    background-color: #4CAF50 !important;
}

.color-stop {
    background-color: #ff5722 !important;
}
#main-record-call-timer::-webkit-input-placeholder { /* Chrome/Opera/Safari */
  color: white;
}
#main-record-call-timer::-moz-placeholder { /* Firefox 19+ */
  color: white;
}
#main-record-call-timer:-ms-input-placeholder { /* IE 10+ */
  color: white;
}
#main-record-call-timer:-moz-placeholder { /* Firefox 18- */
  color: white;
}
/*.btn-block + .btn-block {
    margin-top: 0px;
}*/
</style>
<div class="modal fade in" id="main-record-call-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Record Call</h4>
            </div>

            <div class="modal-body">
                <div class="row">

                    <!-- <div role="form">
                        <div class="col-xs-12">
                            <div class="form-group" style="margin-left: -15px;">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="zmdi zmdi-search"></i>
                                    </span>
                                    <div class="fg-line">
                                        <input type="text" class="form-control" placeholder="Search Customer Name or Account Number...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div role="form">
                        <div class="col-xs-6">
                            <div class="form-group fg-line">
                                <label for="exampleInputEmail1">Account Number</label>
                                <input type="email" class="form-control input-sm" id="exampleInputEmail1" placeholder="Customer Account Number" disabled="disabled">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group fg-line">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="email" class="form-control input-sm" id="exampleInputEmail1" placeholder="Customer Full Name" disabled="disabled">
                            </div>
                        </div>
                    </div>

                    
                   
                    <div class="col-md-12">
                        <input type="text" id="main-record-call-timer" class="form-control" placeholder="00:00:00" disabled="disabled">
                    </div>


                </div>
            </div>
            <div class="modal-footer">
                
                <button class="btn btn-default waves-effect btn-block" id="main-record-call-start">
                    <i class="fa fa-play"></i> Start Call
                </button>
                <button class="btn btn-default waves-effect btn-block hidden" id="main-record-call-resume">
                    <i class="fa fa-play"></i> Resume Call
                </button>
                <button class="btn btn-default waves-effect btn-block hidden" id="main-record-call-pause">
                    <i class="fa fa-pause"></i> Pause Call
                </button>
            
                <button class="btn bgm-amber waves-effect btn-block" id="main-record-call-save" disabled="disabled">
                    <i class="fa fa-plus"></i>  Save Time
                </button>
            
                <button class="btn bgm-black waves-effect btn-block" data-dismiss="modal">
                    Cancel
                </button>

                
            </div>
        </div>
    </div>
</div>
