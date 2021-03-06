<div class="row m-b-25">
    <div class="col-lg-6">
        <div class="bgm-cyan brd-2 p-15">
            <div class="c-white m-b-5">Purchase Cost</div>
            <h2 class="m-0 c-white f-300"><?=money($data['cost']);?></h2>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="bgm-green brd-2 p-15">
            <div class="c-white m-b-5">Sales Cost</div>
            <h2 class="m-0 c-white f-300"><?=money($data['sales']);?></h2>
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
                    <input type="text" class="form-control" id="inventory-name" value="<?=$data['name']; ?>">
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
                    <input type="text" class="form-control" id="inventory-code" value="<?=$data['code']; ?>">
                </div>
            </div>
            <label class="col-sm-1 control-label textlabel">
                Type <span class="required-text">*</span>
            </label>
            <div class="col-sm-4">
                <div class="fg-line">
                    <select class="form-control" id="inventory-type">
                        <?php foreach($type as $v): ?>
                            <?php if(isset($data['type']) && $data['type'] == $v) :?>
                                <option value="<?=$v;?>" selected="selected"><?=ucfirst($v);?></option>
                            <?php else :?>
                                <option value="<?=$v;?>"><?=ucfirst($v);?></option>
                            <?php endif;?>
                        <?php endforeach;?>
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
                    <input type="text" class="form-control" id="inventory-location" 
                    placeholder="Inventory Location" value="<?=$data['location']; ?>">
                </div>
            </div>
            <label class="col-sm-1 control-label textlabel">
                Category
            </label>
            <div class="col-sm-4">
                <div class="fg-line">
                    <select class="form-control" id="inventory-category">
                        <option value="">None</option>
                        <?php foreach($category as $v): ?>
                            <?php if(isset($data['category']['id']) && $data['category']['id'] == $v['_id']->{'$id'}) :?>
                                <option value="<?=$v['_id']->{'$id'};?>" selected="selected">
                                    <?=$v['name'];?>
                                </option>
                            <?php else :?>
                                <option value="<?=$v['_id']->{'$id'};?>"><?=$v['name'];?></option>
                            <?php endif;?>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <span class="col-sm-1"></span>
        </div>

        <div class="form-group m-b-20">
            <label class="col-sm-3 control-label textlabel">
                Unit 
            </label>
            <div class="col-sm-3">
                <div class="fg-line">
                    <input type="text" class="form-control" id="inventory-unit" value="<?=$data['unit']; ?>">
                </div>
            </div>
            <label class="col-sm-1 control-label textlabel">
                Brand 
            </label>
            <div class="col-sm-4">
                <div class="fg-line">
                    <input type="text" class="form-control" id="inventory-brand" value="<?=$data['brand']; ?>">
                </div>
            </div>
            <span class="col-sm-1"></span>
        </div>

        <div class="form-group m-b-20">
            <label class="col-sm-3 control-label textlabel">
                Model 
            </label>
            <div class="col-sm-3">
                <div class="fg-line">
                    <input type="text" class="form-control" id="inventory-model" value="<?=$data['model']; ?>">
                </div>
            </div>
            <label class="col-sm-1 control-label textlabel">
                Reference 
            </label>
            <div class="col-sm-4">
                <div class="fg-line">
                    <input type="text" class="form-control" id="inventory-ref" value="<?=$data['ref']; ?>">
                </div>
            </div>
            <span class="col-sm-1"></span>
        </div>

        <div class="form-group m-b-20">
            <label class="col-sm-3 control-label textlabel">Description/ Remarks</label>
            <div class="col-sm-8">
                <div class="fg-line">
                    <textarea class="form-control" rows="5" id="inventory-description" placeholder="Tell us more about this Item/Service"><?=$data['description']; ?></textarea>
                </div>
            </div>
            <span class="col-sm-1"></span>
        </div>

        <div class="form-group m-b-20">
            <div class="col-sm-3"></div>
            <div class="col-sm-8">
                <div class="alert alert-info alert-dismissible">
                    <p><b>Note on updateing Purchase/Sales Cost: </b></p>
                    <p>
                        Editing <b>Purchase Cost</b> and <b>Sales Cost</b> will not affect the inventory price that has been attached on purchase, sales and quotation. Only the new purchase, sales or quotation will be affected for the new purchase/sales cost updates.
                    </p>
                </div>
            </div>
        </div>

        <div class="form-group m-b-20">
            <label class="col-sm-3 control-label textlabel">
                Purchase Cost
            </label>
            <div class="col-sm-8">
                <div class="fg-line">
                    <input type="text" class="form-control numeric" id="inventory-purchase-cost" value="<?=$data['cost']; ?>">
                </div>
            </div>
        </div>

         <div class="form-group m-b-20">
            <label class="col-sm-3 control-label textlabel">
                Sales Cost
            </label>
            <div class="col-sm-8">
                <div class="fg-line">
                    <input type="text" class="form-control numeric" id="inventory-sales-cost" value="<?=$data['sales']; ?>">
                </div>
            </div>
        </div>

        <div class="form-group m-t-30">
            <span class="col-sm-3"></span>
            <div class="col-sm-8">
                <button class="btn btn-primary pull-right" id="inventory-update">Update Information</button>
            </div>
            <span class="col-sm-1"></span>
        </div>
    </div>
</div>
