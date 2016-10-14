<link rel="stylesheet" href="css/yeti-bootstrap.css">
<script src="js/jquery-2.2.3.js"></script>
<script src="js/bootstrap.js"></script>
<?php
echo '
<script type="text/javascript">
  $(function(){
        $(\'.modal\').on(\'hidden.bs.modal\', function(){ 
            $(this).removeData();
        }) ;
    });
</script>';

?>