<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo ucfirst($page); ?></title>
<meta name="viewport" content="width=device-width, initialscale=1.0">
	<!-- Bootstrap -->
	<?php echo link_tag('bootstrap/css/bootstrap.min.css'); ?>
	<style type="text/css">
		@media screen and (max-width: 600px) {
		    table, tr, td, th {
		    	font-size: 1.1em;
		    }
		}

		@media screen and (max-width: 400px) {
		    table, tr, td, th, .navbar-brand, .navpage {
		    	font-size: 1em;
		    }
		}

	    @media screen and (max-width: 250px) {
		    table, tr, td, th, .navbar-brand, .navpage {
		    	font-size: 0.9em;
		    }
		}

	    @media screen and (max-width: 150px) {
		    table, tr, td, th, .navbar-brand, .navpage {
		    	font-size: 0.7em;
		    }
		}

	    @media screen and (min-width: 601px) {
		    table, tr, td, th {
		    	font-size: 1.3em;
		    }
		}
		.caltable {
			width:100%;
			border-collapse: collapse;
		}
		.square {
		    padding-bottom: 8%; /* = width for a 1:1 aspect ratio */
		    margin:0;
		    overflow:hidden;
		}
	</style>
</head>

<body>

