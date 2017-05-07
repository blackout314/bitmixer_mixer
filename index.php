<?php
include 'function.php';
// -- configuration --
$TITLE    = 'Crypto Coins Mixer';
$myaddr   = '1MGxh6mnfkgPgCKgTTS4cEzC8vbhgqg2EW';
$feePerc  = 1;
$bitmixerFee = '0.6523';
$customerTime = 8;
$myTime   = 10;
// # -- configuration --
$perc     = 100-$feePerc;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $TITLE ?></title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><?php echo $TITLE ?></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="https://github.com/blackout314">About</a></li>
            <!-- <li><a href="#contact">Contact</a></li> -->
          </ul>
        </div>
      </div>
    </nav>

    <div class="container" style="margin-top:100px;">
      <div class="starter-template row">
        <div class="col-md-offset-3 col-md-6">
          <form class="form-signin" method="get">
            <label for="address" class="sr-only">Address</label>
            <input name="address" type="text" id="address" class="form-control" placeholder="Address" required="" autofocus="">
            <br/>
            <button class="btn btn-sm btn-success btn-block" type="submit">Mix my coins</button>
            <br/>
            <small>based on bitmixer.io api</small>
            <br/>
          </form>
        </div>
        <div class="col-md-offset-3 col-md-6" style="margin-top:100px;">
        <?php 
          $address  = $_GET['address'];
          if($address) {
            $url    = "https://bitmixer.io/order.php?addr1=".$address."&pr1=".$perc."&time1=".$customerTime
                    ."&addr2=".$myaddr."&pr2=".$feePerc."&time2=".$myTime
                    ."&fee=".$bitmixerFee;
            $var    = fetch($url, array('cookiefile' => './.cookie/'.$address.'.txt' ));
            $data   = getData($var);
            if($data['error']) {
              echo '<div class="alert alert-danger" role="alert">'.$data['error'].'</div>';
            } else {
              $letter = getLetter($data['addr'], $address);
              echo '<div class="form-group">For this address: '.$address.'</div>';
              echo '<div class="form-group">Send to this address: '.$data['addr'].'</div>';
              echo '<div class="form-group"><label>Letter of Guarantee</label>';
              echo '<textarea class="form-control" rows="3">'.$letter."</textarea></div>";
            }
          }
        ?>
        </div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </body>
</html>
<?php
