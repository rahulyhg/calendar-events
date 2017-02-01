<?php
defined('BASEPATH') or exit('No direct script access allowed');
defined('USERKOTYPE') or exit('No direct script access allowed'); // can only be accessed from child of member_controller

$prefs['template'] = '
            {table_open}<table class="table-bordered caltable">{/table_open}

            {heading_row_start}<tr class="text-primary bg-primary">{/heading_row_start}

            {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
            {heading_title_cell}<th colspan="{colspan}" class="text-center text-md-left">{heading}</th>{/heading_title_cell}
            {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

            {heading_row_end}</tr>{/heading_row_end}

            {week_row_start}<tr class="text-info text-center">{/week_row_start}
            {week_day_cell}<td class="info">{week_day}</td>{/week_day_cell}
            {week_row_end}</tr>{/week_row_end}

            {cal_row_start}<tr>{/cal_row_start}
            {cal_cell_start}<td class="col-xs-0 square text-center">{/cal_cell_start}
            {cal_cell_start_today}<td class="active">{/cal_cell_start_today}
            {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

            {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
            {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

            {cal_cell_no_content}{day}{/cal_cell_no_content}
            {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

            {cal_cell_blank}&nbsp;{/cal_cell_blank}

            {cal_cell_other}{day}{/cal_cel_other}

            {cal_cell_end}</td>{/cal_cell_end}
            {cal_cell_end_today}</td>{/cal_cell_end_today}
            {cal_cell_end_other}</td>{/cal_cell_end_other}
            {cal_row_end}</tr>{/cal_row_end}

            {table_close}</table>{/table_close}
        ';

        $this->calendar_mdl->initialize($prefs);
        echo $this->calendar_mdl->np_generate(2073, 1);
?>
