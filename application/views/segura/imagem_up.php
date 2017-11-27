<html>
<head>
<title>Formul&aacute;rio de Envio de Arquivo</title>
</head>
<body>
        <?php echo form_open_multipart('upload/do_upload'); ?>
        <input type="file" name="arquivo" id="arquivo" size="20" />
        <input type="submit" value="upload" />
        </form>
</body>
</html>