<html>
<head>
	<meta charset="UTF-8">
	<title><?=$title ?></title>
</head>
<body>
	<!-- lebih keren -->
	<?php $hidden = ['username' => 'Ismet', 'member_id' => '123'] ?>
	<?=form_open('', '', $hidden) ?>
	

	<!-- form input -->

	<?php 
		$js = 'onClick="some_function()"';
		echo form_input('username', 'johndoe', $js);
	?>

	<!-- form dropdown/combobox -->
	<?php 
		$options = array(
			''				=> '--Choose--',
	        'small'         => 'Small Shirt',
	        'med'           => 'Medium Shirt',
	        'large'         => 'Large Shirt',
	        'xlarge'        => 'Extra Large Shirt',
		);
		// $shirts_on_sale = array('small', 'large');
		echo form_dropdown('shirts', $options);

		$attributes = array(
	        'id'    => 'address_info',
	        'class' => 'address_info'
		);

		// fieldset
		echo form_fieldset('Address Information', $attributes);
		echo "<p>fieldset content here</p>\n";
		echo form_fieldset_close();

		echo form_checkbox('newsletter', 'accept', TRUE);

		// with js
		$js = array('onClick' => 'some_function();');
		echo form_checkbox('newsletter', 'accept', TRUE, $js);
		echo form_radio('newsletter', '', TRUE);

		// form label
		echo form_label('What is your Name', 'username');
		// with array
		$attributes = array(
	        'class' => 'mycustomclass',
	        'style' => 'color: #000;'
		);
		echo form_label('What is your Name', 'username', $attributes);

		// form submit
		echo form_submit('mysubmit', 'Submit Post!');

	 ?>

	<?=form_close() ?>
</body>
</html>