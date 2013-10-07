java -jar ~/systems/saxon/saxon9he.jar \
	-s:ckeditor.xml \
	-xsl:userdoc.php.xsl \
	-o:ckeditor.php && sed -i 's/<?xml version="1.0" encoding="UTF-8"?>//' ckeditor.php
