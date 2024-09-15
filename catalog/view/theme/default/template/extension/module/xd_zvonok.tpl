<div class="modal-dialog">
    <div class="modal-content">
        <form id="xd_zvonok_form" role="form">
            <fieldset>
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">×</button>
                    <h2 class="modal-title"><?php echo $xd_zvonok_modal_title; ?></h2>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div id="source" style="display:none">
                            <input id="sb_first_typ" class="hidden" type="text" name="sb_first_typ" value="">
                            <input id="sb_first_src" class="hidden" type="text" name="sb_first_src" value="">
                            <input id="sb_first_mdm" class="hidden" type="text" name="sb_first_mdm" value="">
                            <input id="sb_first_cmp" class="hidden" type="text" name="sb_first_cmp" value="">
                            <input id="sb_first_cnt" class="hidden" type="text" name="sb_first_cnt" value="">
                            <input id="sb_first_trm" class="hidden" type="text" name="sb_first_trm" value="">

                            <input id="sb_current_typ" class="hidden" type="text" name="sb_current_typ" value="">
                            <input id="sb_current_src" class="hidden" type="text" name="sb_current_src" value="">
                            <input id="sb_current_mdm" class="hidden" type="text" name="sb_current_mdm" value="">
                            <input id="sb_current_cmp" class="hidden" type="text" name="sb_current_cmp" value="">
                            <input id="sb_current_cnt" class="hidden" type="text" name="sb_current_cnt" value="">
                            <input id="sb_current_trm" class="hidden" type="text" name="sb_current_trm" value="">

                            <input id="sb_first_add_fd" class="hidden" type="text" name="sb_first_add_fd" value="">
                            <input id="sb_first_add_ep" class="hidden" type="text" name="sb_first_add_ep" value="">
                            <input id="sb_first_add_rf" class="hidden" type="text" name="sb_first_add_rf" value="">

                            <input id="sb_current_add_fd" class="hidden" type="text" name="sb_current_add_fd" value="">
                            <input id="sb_current_add_ep" class="hidden" type="text" name="sb_current_add_ep" value="">
                            <input id="sb_current_add_rf" class="hidden" type="text" name="sb_current_add_rf" value="">

                            <input id="sb_session_pgs" class="hidden" type="text" name="sb_session_pgs" value="">
                            <input id="sb_session_cpg" class="hidden" type="text" name="sb_session_cpg" value="">

                            <input id="sb_udata_vst" class="hidden" type="text" name="sb_udata_vst" value="">
                            <input id="sb_udata_uip" class="hidden" type="text" name="sb_udata_uip" value="">
                            <input id="sb_udata_uag" class="hidden" type="text" name="sb_udata_uag" value="">
                            <input id="sb_promo_code" class="hidden" type="text" name="sb_promo_code" value="">
                        </div>
                        <?php if ($xd_zvonok_field1_status) { ?>
                            <div class="input_wrapper">
                                <div class="input-group<?php echo ($xd_zvonok_field1_required) ? ' has-warning' : ''; ?>">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-user" aria-hidden="true"></i></span>
                                    <input id="xd_zvonok_name" class="form-control xd_zvonok_input<?php echo ($xd_zvonok_field1_required) ? ' required' : ''; ?>" type="text" name="xd_zvonok_name" placeholder="<?php echo $xd_zvonok_field1_title; ?>">
                                </div>
                                <p id="xd_zvonok_name_error" class="text-error hidden"></p>
                            </div>
                        <?php } ?>
                        <?php if ($xd_zvonok_field2_status) { ?>
                            <div class="input_wrapper">
                                <div class="input-group<?php echo ($xd_zvonok_field2_required) ? ' has-warning' : ''; ?>">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-phone-square" aria-hidden="true"></i></span>
                                    <input id="xd_zvonok_phone" class="form-control xd_zvonok_input<?php echo ($xd_zvonok_field2_required) ? ' required' : ''; ?>" type="tel" name="xd_zvonok_phone" placeholder="<?php echo $xd_zvonok_field2_title; ?>">
                                </div>
                                <p id="xd_zvonok_phone_error" class="text-error hidden"></p>
                            </div>
                        <?php } ?>
                        <?php if ($xd_zvonok_field3_status) { ?>
                            <div class="input_wrapper">
                                <label for="xd_zvonok_message" class="hidden"><?php echo $xd_zvonok_field3_title; ?></label>
                                <div class="form-group<?php echo ($xd_zvonok_field3_required) ? ' has-warning' : ''; ?>">
                                    <textarea id="xd_zvonok_message" class="form-control xd_zvonok_input<?php echo ($xd_zvonok_field3_required)  ? ' required' : ''; ?>" name="xd_zvonok_message" rows="3" placeholder="<?php echo $xd_zvonok_field3_title; ?>"></textarea>
                                </div>
                                <p id="xd_zvonok_message_error" class="text-error hidden"></p>
                            </div>
                        <?php } ?>
                        <?php if ($captcha !== '') { ?>
                            <div class="input_wrapper">
                                <div class="form-group">
                                    <?php echo $captcha; ?>
                                </div>
                                <p id="xd_zvonok_captcha_error" class="text-error hidden"></p>
                            </div>
                        <?php } ?>
                    </div>
                    <div class=" clearfix">
                    </div>
                    <?php if ($xd_zvonok_agree_status) { ?>
                        <div class="col-sm-12">
                            <p><?php echo $xd_zvonok_text_agree; ?></p>
                        </div>
                        <div class="clearfix"></div>
                    <?php } ?>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-2 hidden-xs">
                    </div>
                    <div class="col-sm-8 col-xs-12">
                        <button type="submit" class="btn btn-lg btn-block btn-default"><?php echo $xd_zvonok_submit_button; ?></button>
                    </div>
                    <div class="col-sm-2 hidden-xs">
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>