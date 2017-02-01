<?php
defined('BASEPATH') or exit('No direct script access allowed');
defined('USERKOTYPE') or exit('No direct script access allowed'); // can only be accessed from child of member_controller

$prefs['show_other_days'] = TRUE;
$prefs['show_next_prev']  = TRUE;
$prefs['next_prev_url']   = base_url('users/home');

$prefs['template'] = array(
		'table_open' => '<table class="table-bordered caltable">',

		'heading_row_start' => '<tr class="text-primary bg-primary">',

		'heading_previous_cell' => '<th class="text-primary"><a href="{previous_url}" style="color: white;"><span class="glyphicon glyphicon-chevron-left pull-right"></span></a></th>',
        'heading_title_cell' => '<th colspan="{colspan}" class="text-center text-md-left">{heading}</th>',
        'heading_next_cell' => '<th class="text-primary"><a href="{next_url}" style="color: white;"><span class="glyphicon glyphicon-chevron-right pull-left"></span></a></th>',

        'heading_row_end' => '</tr>',

        'week_row_start' => '<tr class="text-info text-right">',
        'week_day_cell' => '<td class="info">{week_day}</td>',
        'week_row_end' => '</tr>',

        // <tr> start for cells
        'cal_row_start' => '<tr>',
        'cal_cell_start' => '<td class="col-xs-0 square text-right">',
        'cal_cell_start_today' => '<td class="col-xs-0 square text-right bg-success text-success" data-toggle="tooltip" title="Today">',
        'cal_cell_start_other' => '<td class="col-xs-0 other-month square text-right text-muted">',

        // cell with contents
        'cal_cell_content' => '{day}<a href="{content}" data-toggle="tooltip" title="Event here"><span alt="{content}" class="glyphicon glyphicon-tasks pull-right"></span></a>',
        'cal_cell_content_today' => '<a href="{content}" style="color:red;">{day}</a>',

        // cell with no contents
        'cal_cell_no_content' => '{day}',
        'cal_cell_no_content_today' => '<div>{day}</div>',

        // blank cells
        'cal_cell_blank' => '&nbsp;',

        // other cells
        'cal_cell_other' => '{day}',

        // closing tags
        'cal_cell_end' => '</td>',
        'cal_cell_end_today' => '</td>',
        'cal_cell_end_other' => '</td>',
        'cal_row_end' => '</tr>',
        'table_close' => '</table>'
);

$this->calendar_mdl->initialize($prefs);
echo $this->calendar_mdl->np_generate(2073, 10, $events);
