<?php 

$settings = $this->get_settings();

$work_info = $this->get_settings('work_info');

$part_format = '<dl>
                <dt>%1$s</dt>
                <dd>%2$s</dd>
              </dl>';
$work_array = array();              

foreach ($work_info as $value) {
  array_push($work_array, sprintf( $part_format, $value['items_title'], $value['work_hours'] ));
}

$renderHtml = '<h4>%2$s</h4><div class="work-info">
                <div>
                  %1$s
                </div>
              </div>';

printf( $renderHtml, join($work_array), $settings['title_block'] );
