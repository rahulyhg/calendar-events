<?php
defined('BASEPATH') or exit('No direct script access allowed');
defined('USERKOTYPE') or exit('No direct script access allowed'); // can only be accessed from child of member_controller

$this->calendar_mdl->initialize($prefs);
echo  $this->calendar_mdl->np_generate(2073, 10, $events);
