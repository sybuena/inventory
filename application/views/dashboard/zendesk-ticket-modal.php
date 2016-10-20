<div class="modal fade in" id="zendesk-ticket-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Reply to Ticket</h4>
            </div>

            <div class="modal-body">
                
                <div class="row top-15">
                    
                    <div class="col-sm-12">
                        <div class="form-group">    
                            <label>Comment *</label>
                            <textarea rows="6" class="form-control fg-input" id="zendesk-ticket-reply-comment" placeholder="Write something about this ticket..."></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn bgm-gray waves-effect" data-dismiss="modal">Cancel</button>
                <div class="btn-group">
                    <div class="btn-group">
                        <button type="button" id="zendesk-ticket-reply-save-as" class="btn bgm-amber dropdown-toggle" data-toggle="dropdown">
                            Save As <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="#" class="zendesk-ticket-reply-save" save-as="open">
                                    Open
                                </a>
                            </li>
                            <li>
                                <a href="#" class="zendesk-ticket-reply-save" save-as="pending">
                                    Pending
                                </a>
                            </li>
                            <li>
                                <a href="#" class="zendesk-ticket-reply-save" save-as="solved">
                                    Solved
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
