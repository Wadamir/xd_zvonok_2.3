<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-xd_zvonok" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
            </div>
            <h1 style="display:block;"><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <?php if ($error_warning) { ?>
            <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-html" class="form-horizontal">
                    <div class="tab-pane">
                        <ul class="nav nav-tabs" id="language">
                            <?php foreach ($languages as $language) { ?>
                                <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                            <?php } ?>
                        </ul>
                        <div class="tab-content">
                            <?php foreach ($languages as $language) { ?>
                                <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="xd_zvonok_button_name_<?php echo $language['language_id']; ?>"><?php echo $entry_button_name; ?></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="xd_zvonok_button_name_<?php echo $language['language_id']; ?>" placeholder="<?php echo $entry_button_name; ?>" id="xd_zvonok_name_<?php echo $language['language_id']; ?>" value="<?php echo isset(${'xd_zvonok_button_name_' . $language['language_id']}) ? ${'xd_zvonok_button_name_' . $language['language_id']} : ''; ?>" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="xd_zvonok_success_field_<?php echo $language['language_id']; ?>"><?php echo $entry_success_field; ?></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="xd_zvonok_success_field_<?php echo $language['language_id']; ?>" placeholder="<?php echo $entry_success_field; ?>" id="xd_zvonok_success_field_<?php echo $language['language_id']; ?>" value="<?php echo isset(${'xd_zvonok_success_field_' . $language['language_id']}) ? ${'xd_zvonok_success_field_' . $language['language_id']} : ''; ?>" class="form-control" />
                                            <p><?php echo $success_field_tooltip; ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group" style="border-top: 1px solid #ccc;">
                        <label class="col-sm-3 control-label" for="input-field1_status"><?php echo $field1_title; ?></label>
                        <div class="col-sm-7">
                            <select name="xd_zvonok_field1_status" id="input-field1_status" class="form-control">
                                <?php if ($xd_zvonok_field1_status) { ?>
                                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                    <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                    <option value="1"><?php echo $text_enabled; ?></option>
                                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label class="control-label">
                                <input type="checkbox" name="xd_zvonok_field1_required" value="1" <?php echo isset($xd_zvonok_field1_required) ? 'checked="checked"' : ''; ?>> <?php echo $field_required; ?>
                            </label>
                        </div>
                    </div>
                    <div class="form-group" style="border:none;">
                        <label class="col-sm-3 control-label" for="input-field2_status"><?php echo $field2_title; ?></label>
                        <div class="col-sm-7">
                            <select name="xd_zvonok_field2_status" id="input-field2_status" class="form-control">
                                <?php if ($xd_zvonok_field2_status) { ?>
                                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                    <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                    <option value="1"><?php echo $text_enabled; ?></option>
                                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label class="control-label">
                                <input type="checkbox" name="xd_zvonok_field2_required" value="1" <?php echo isset($xd_zvonok_field2_required) ? 'checked="checked"' : ''; ?>> <?php echo $field_required; ?>
                            </label>
                        </div>
                    </div>
                    <div class="form-group" style="border:none;">
                        <label class="col-sm-3 control-label" for="input-field3_status"><?php echo $field3_title; ?></label>
                        <div class="col-sm-7">
                            <select name="xd_zvonok_field3_status" id="input-field3_status" class="form-control">
                                <?php if ($xd_zvonok_field3_status) { ?>
                                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                    <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                    <option value="1"><?php echo $text_enabled; ?></option>
                                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label class="control-label">
                                <input type="checkbox" name="xd_zvonok_field3_required" value="1" <?php echo isset($xd_zvonok_field3_required) ? 'checked="checked"' : ''; ?>> <?php echo $field_required; ?>
                            </label>
                        </div>
                    </div>
                    <div class="form-group" style="border:none;">
                        <label class="col-sm-3 control-label" for="input-agree_status"><?php echo $agree_title; ?></label>
                        <div class="col-sm-9">
                            <select name="xd_zvonok_agree_status" id="agree_status" class="form-control">
                                <option value="0"><?php echo $text_disabled; ?></option>
                                <?php foreach ($informations as $information) { ?>
                                    <?php if ($information['information_id'] == $xd_zvonok_agree_status) { ?>
                                        <option value="<?php echo $information['information_id']; ?>" selected="selected"><?php echo $information['title']; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $information['information_id']; ?>"><?php echo $information['title']; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="input-validation_type"><?php echo $entry_validation_type; ?></label>
                        <div class="col-sm-9">
                            <select name="xd_zvonok_validation_type" id="input-validation_type" class="form-control">
                                <?php if ($xd_zvonok_validation_type == $value_validation_type1) { ?>
                                    <option value="0"><?php echo $text_validation_type0; ?></option>
                                    <option value="<?php echo $value_validation_type1; ?>" selected="selected"><?php echo $text_validation_type1; ?></option>
                                    <option value="<?php echo $value_validation_type2; ?>"><?php echo $text_validation_type2; ?></option>
                                <?php } else if ($xd_zvonok_validation_type == $value_validation_type2) { ?>
                                    <option value="0"><?php echo $text_validation_type0; ?></option>
                                    <option value="<?php echo $value_validation_type1; ?>"><?php echo $text_validation_type1; ?></option>
                                    <option value="<?php echo $value_validation_type2; ?>" selected="selected"><?php echo $text_validation_type2; ?></option>
                                <?php } else { ?>
                                    <option value="0" selected="selected"><?php echo $text_validation_type0; ?></option>
                                    <option value="<?php echo $value_validation_type1; ?>"><?php echo $text_validation_type1; ?></option>
                                    <option value="<?php echo $value_validation_type2; ?>"><?php echo $text_validation_type2; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $entry_captcha; ?></label>
                        <div class="col-sm-9">
                            <select name="xd_zvonok_captcha" id="input-captcha" class="form-control">
                                <option value=""><?php echo $text_none; ?></option>
                                <?php foreach ($captchas as $captcha) { ?>
                                    <?php if ($captcha['value'] == $xd_zvonok_captcha) { ?>
                                        <option value="<?php echo $captcha['value']; ?>" selected="selected"><?php echo $captcha['text']; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $captcha['value']; ?>"><?php echo $captcha['text']; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="input-status"><?php echo $entry_status; ?></label>
                        <div class="col-sm-9">
                            <select name="xd_zvonok_status" id="input-status" class="form-control">
                                <?php if ($xd_zvonok_status) { ?>
                                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                    <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                    <option value="1"><?php echo $text_enabled; ?></option>
                                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script type="text/javascript">
            <!--
            $('#language a:first').tab('show');
            //
            -->
        </script>
    </div>
    <?php echo $footer; ?>