<div class="modal fade in" id="workflow" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bgm-blue">
                <h4 class="modal-title">Job Order Status Workflow</h4>
            </div>

            <div class="modal-body" style="background-color: #ddd;">
                <ul class="timeline">
                    <li>
                        <div class="timeline-badge bgm-cyan"></div>
                        <div class="timeline-panel white-bg">
                            <div class="timeline-heading">
                                <h4 class="timeline-title f-500">Draft Job Order</h4>
                            </div>
                        <div class="timeline-body">
                            <p> - Job Order is still in review process.</p>
                        </div>
                      </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-badge bgm-orange"></div>
                        <div class="timeline-panel white-bg">
                            <div class="timeline-heading">
                                <h4 class="timeline-title f-500">Sent Job Order</h4>
                            </div>
                            <div class="timeline-body">
                                <p>
                                    Marked Job Order as Sent are the job order that has been sent to the customer and quotes might still change depending on the customer needs
                                </p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-badge bgm-blue"></div>
                        <div class="timeline-panel white-bg">
                            <div class="timeline-heading">
                                <h4 class="timeline-title f-500">Accepted Job Order</h4>
                            </div>
                        <div class="timeline-body">
                            <p>Both parties agreed on the proposed job order and any further changes is not allowed at this point of process</p>
                        </div>
                      </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-badge bgm-lightgreen"></div>
                        <div class="timeline-panel white-bg">
                            <div class="timeline-heading">
                                <h4 class="timeline-title f-500">Invoiced Job Order</h4>
                            </div>
                            <div class="timeline-body">
                                <p>
                                    These are the list of job order that has been converted to invoice and are in payment process.
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button class="btn bgm-gray waves-effect" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
