<?php defined('BASEPATH') or exit('No direct script access allowed');
if(!isset($filter_table_name)){
    $filter_table_name = '.table-cf_expenses';
}
?>
<div class="_filters _hidden_inputs hidden">
   <?php 
   foreach($years as $year){
    echo form_hidden('year_'.$year['year'],$year['year']);
}
for ($m = 1; $m <= 12; $m++) {
   echo form_hidden('expenses_by_month_'.$m);
}
foreach($categories as $category){
 echo form_hidden('expenses_by_category_'.$category['id']);
}
echo form_hidden('expenses_by_operation_cashin');
echo form_hidden('expenses_by_operation_cashout');

?>
</div>
<div class="btn-group pull-right mleft4 btn-with-tooltip-group _filter_data" data-toggle="tooltip" data-title="<?php echo _l('filter_by'); ?>">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-filter" aria-hidden="true"></i>
    </button>

    <ul class="dropdown-menu dropdown-menu-right width300">
        <li>
            <a href="#" data-cview="all" onclick="dt_custom_view('','<?php echo ($filter_table_name); ?>',''); return false;">
                <?php echo _l('expenses_list_all'); ?>
            </a>
        </li>


        <div class="clearfix"></div>
        <li class="divider"></li>
        <li class="dropdown-submenu pull-left">
        <a href="#" tabindex="-1"><?php echo _l('expenses_filter_by_operation_type'); ?></a>
        <ul class="dropdown-menu dropdown-menu-left">
        <li>
            <a href="#" data-cview="expenses_by_operation_cashin" onclick="dt_custom_view('cash-in','<?php echo ($filter_table_name); ?>','expenses_by_operation_cashin'); return false;">
                <?php echo _l('cash_in'); ?>
            </a>
        </li>
        <li>
            <a href="#" data-cview="expenses_by_operation_cashout" onclick="dt_custom_view('cash-out','<?php echo ($filter_table_name); ?>','expenses_by_operation_cashout'); return false;">
                <?php echo _l('cash_out'); ?>
            </a>
        </li>
        </ul>
        <div class="clearfix"></div>
        <li class="divider"></li>
        <?php if(count($years) > 0){ ?>
            <li class="divider years-divider"></li>
            <?php foreach($years as $year){ ?>
                <li class="active expenses-filter-year">
                    <a href="#" data-cview="year_<?php echo ($year['year']); ?>" onclick="dt_custom_view(<?php echo ($year['year']); ?>,'<?php echo ($filter_table_name); ?>','year_<?php echo ($year['year']); ?>'); return false;"><?php echo ($year['year']); ?></a>
                </li>
                <?php } ?>
                <?php } ?>
                <?php if(count($categories) > 0){ ?>
                   <div class="clearfix"></div>
                   <li class="divider"></li>
                   <li class="dropdown-submenu pull-left">
                     <a href="#" tabindex="-1"><?php echo _l('expenses_filter_by_categories'); ?></a>
                     <ul class="dropdown-menu dropdown-menu-left">
                        <?php foreach($categories as $category){ ?>
                            <li>
                                <a href="#" data-cview="expenses_by_category_<?php echo ($category['id']); ?>" onclick="dt_custom_view(<?php echo ($category['id']); ?>,'<?php echo ($filter_table_name); ?>','expenses_by_category_<?php echo ($category['id']); ?>'); return false;"><?php echo ($category['name']); ?></a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php } ?>
                    <div class="clearfix"></div>
                    <li class="divider months-divider"></li>
                    <li class="dropdown-submenu pull-left expenses-filter-month-wrapper">
                      <a href="#" tabindex="-1"><?php echo _l('months'); ?></a>
                      <ul class="dropdown-menu dropdown-menu-left">
                        <?php for ($m = 1; $m <= 12; $m++) { ?>
                          <li class="expenses-filter-month"><a href="#" data-cview="expenses_by_month_<?php echo ($m); ?>" onclick="dt_custom_view(<?php echo ($m); ?>,'<?php echo ($filter_table_name); ?>','expenses_by_month_<?php echo ($m); ?>'); return false;"><?php echo _l(date('F', mktime(0, 0, 0, $m, 1))); ?></a></li>
                          <?php } ?>
                      </ul>
                  </li>
                <div class="clearfix"></div>
              </ul>
          </div>
