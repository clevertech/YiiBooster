usage example
==========



~~~
[php]

<?php
/**
 * User: yiqing
 * Date: 12-2-1
 */
$this->widget('bootstrap.widgets.TbColorPicker', array(

));
?>

<div class="well">

    <div class="input-append color" data-color="rgb(255, 146, 180)" data-color-format="rgb">
        <input type="text" class="span2" value="" >
        <span class="add-on"><i style="background-color: rgb(255, 146, 180)"></i></span>
    </div>
</div>


    <script type="text/javascript">
        $(function(){
            $('.color').colorpicker().on('changeColor', function(ev){
                bodyStyle.backgroundColor = ev.color.toHex();
            });
        });

    </script>
~~~

for more options please refer [Colorpicker for Bootstrap](http://www.eyecon.ro/bootstrap-colorpicker/ "bootColorPicker")

====
>[Colorpicker for Bootstrap](http://www.eyecon.ro/bootstrap-colorpicker/ "bootColorPicker")

