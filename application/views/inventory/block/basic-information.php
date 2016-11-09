<div class="row m-b-25">
    <div class="col-xs-3">
        <div class="bgm-blue brd-2 p-15">
            <div class="c-white m-b-5">Quantity on Hand</div>
            <h2 class="m-0 c-white f-300"><?=$inventory['stock'];?></h2>
        </div>
    </div>

    <div class="col-xs-3">
        <div class="bgm-orange brd-2 p-15">
            <div class="c-white m-b-5">In Quatation/Pending Order</div>
            <h2 class="m-0 c-white f-300">0 / 12</h2>
        </div>
    </div>

    <div class="col-xs-3">
        <div class="bgm-cyan brd-2 p-15">
            <div class="c-white m-b-5">Purchase Cost</div>
            <h2 class="m-0 c-white f-300"><?=money($inventory['cost']);?></h2>
        </div>
    </div>

    <div class="col-xs-3">
        <div class="bgm-green brd-2 p-15">
            <div class="c-white m-b-5">Sales Cost</div>
            <h2 class="m-0 c-white f-300"><?=money($inventory['sales']);?></h2>
        </div>
    </div>
</div>
<div class="row">
    <div class="card-header">
        <h2>Basic Information</h2>
    </div>
    <div class="contact-info-field">
        <div class="form-group m-b-20">
            <label class="col-sm-3 control-label textlabel">
                Name <span class="required-text">*</span>
            </label>
            <div class="col-sm-8">
                <div class="fg-line">
                    <input type="text" class="form-control" id="inventory-name" value="<?=$inventory['name']; ?>">
                </div>
            </div>
            <span class="col-sm-1"></span>
        </div>


        <div class="form-group m-b-20">
            <label class="col-sm-3 control-label textlabel">
                Code <span class="required-text">*</span>
            </label>
            <div class="col-sm-3">
                <div class="fg-line">
                    <input type="text" class="form-control" id="inventory-code" value="<?=$inventory['code']; ?>">
                </div>
            </div>
            <label class="col-sm-1 control-label textlabel">
                Type <span class="required-text">*</span>
            </label>
            <div class="col-sm-4">
                <div class="fg-line">
                    <select class="form-control" id="inventory-type">
                        <option value="item">Item</option>
                        <option value="service">Service</option>
                    </select>
                </div>
            </div>
            <span class="col-sm-1"></span>
        </div>

        <div class="form-group m-b-20">
            <label class="col-sm-3 control-label textlabel">
                Location
            </label>
            <div class="col-sm-3">
                <div class="fg-line">
                    <input type="text" class="form-control" id="inventory-code" 
                    value="<?=$inventory['location']; ?>">
                </div>
            </div>
            <label class="col-sm-1 control-label textlabel">
                Category
            </label>
            <div class="col-sm-4">
                <div class="fg-line">
                    <select class="form-control" id="inventory-category">
                        <option value="">None</option>
                    </select>
                </div>
            </div>
            <span class="col-sm-1"></span>
        </div>

        <div class="form-group m-b-20">
            <label class="col-sm-3 control-label textlabel">Description</label>
            <div class="col-sm-8">
                <div class="fg-line">
                    <textarea class="form-control" rows="5" id="inventory-description"><?=$inventory['description']; ?></textarea>
                </div>
            </div>
            <span class="col-sm-1"></span>
        </div>
    </div>
</div>
