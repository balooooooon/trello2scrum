<h1><?=$_POST['heading']?></h1>
<h2>Sprint backlog</h2>
<?parse_file('sprint')?>
<pagebreak />
<h2>Product backlog</h2>
<?parse_file('product')?>
<?$imagesize = getimagesize($_FILES['burndown']['tmp_name']);?>
<pagebreak sheet-size="<?=$imagesize[1]?>px <?=$imagesize[0]?>px" />
<img src="data:'<?=mime_content_type($_FILES['burndown']['tmp_name'])?>';base64,'<?=base64_encode(file_get_contents($_FILES['burndown']['tmp_name']))?>">