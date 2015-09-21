<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $error;?>

<?php echo form_open_multipart('http://104.215.198.240/rentnroam/host/do_upload');?>
<?php echo "hello....";?>
<input type="file" name="userfile" size="20" />

<br /><br />
<input type="submit" value="upload" />
<input type="text" name="caption" size="30" />
<input type="text" name="property_id" size="30" />
<h1>file upload</h1>
</form>

</body>
</html>