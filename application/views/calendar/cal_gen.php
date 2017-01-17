<?php
defined('BASEPATH') or exit('No direct script access allowed');
$cells = array(
    array(
        '',
        '',
        '',
        '',
        '',
        '',
        ''
    )
);
for ($count = 1, $i = $start; $count <= $days; $i ++, $count ++) {
    if ($i > 35) {
        $i %= 35;
    }
    $cells[$i < 35 ? $i / 7 : $i % 35][$i % 7] = $count;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title><?php echo $title; ?></title>
</head>
<body>
	<table>
		<thead>
				<?php /*echo $this->gregDate [0] / $this->gregDate [1];*/ ?>
				<tr>
				<th>Sun</th>
				<th>Mon</th>
				<th>Tue</th>
				<th>Wed</th>
				<th>Thu</th>
				<th>Fri</th>
				<th>Sat</th>
			</tr>
		</thead>
		<tbody>
				<?php foreach ($cells as $row): ?>
					<tr>
					<?php foreach ($row as $cell): ?>
						<td style="border: 1px solid black; width: 30px; height: 30px"><?php echo $cell; ?></td>
					<?php endforeach; ?>
					</tr>
				<?php endforeach;?>
			</tbody>
	</table>
</body>
</html>
