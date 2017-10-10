<?php
include 'OrderFixer.php';
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
</head>
<body>

<div class="container" style="margin-top:50px; margin-bottom:50px;">
  <div class="row">
    <div class="col col-lg-6">
      <h3>Input folder</h3><br>
      <?php 
        echo_info(); 
      ?>
    </div>
    <div class="col col-lg-6">
      <h3>Output folder</h3><br>
      <?php 
        echo_info('O'); 
      ?>
    </div>
  </div>
  <div class="col col-lg-12" style="margin-top:50px; margin-bottom:50px; text-align:center;">
    <form action="SaveSubtitles.php" method="post">
      <button type="submit" class="btn btn-primary">Fix Order</button>
    </form>
  </div>
</div>

</body>
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</html>