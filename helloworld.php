<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' integrity='sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7' crossorigin='anonymous'>
<link rel='stylesheet' type='text/css' href='index.css'>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' integrity='sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7' crossorigin='anonymous'>
<link rel='stylesheet' type='text/css' href='index.css'>
<link rel='stylesheet' href='//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css'>
<script src='//code.jquery.com/jquery-1.10.2.js'></script>
<script src='//code.jquery.com/ui/1.11.4/jquery-ui.js'></script>
<script>
    $(function() {
      $( "#datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true
      });
    });
    </script>
<?php
use google\appengine\api\users\User;
use google\appengine\api\users\UserService;

$user = UserService::getCurrentUser();

if (isset($user)) {
  ?>
  <div class='container-fluid'>
   <div class='well'>
    <div class='row'>
      <div class='col-xs-12 col-md-11'>
        <?php 
          echo sprintf('Welcome, %s! ',
               $user->getNickname()); 
        ?>
      </div>
      <div class="col-xs-6 col-md-1">
        <?php 
          echo sprintf('<a href="%s">Sign Out</a>',UserService::createLogoutUrl('/')); 
        ?>
      </div>
    </div>
   </div>
  </div>
  <?php 
  if (!empty($_POST)){ ?>
    <div class='container-fluid'>
      <div class='well'>
       <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
         <h2>Hello <?php $user->getNickname()?>, <br>Since your Birthday is on <?php echo htmlspecialchars($_POST['birthday']); ?>,</h2>
    <?php 
    $memcache = new Memcache;
    $key = htmlspecialchars($_POST['birthday']);
    $cachedDate = $memcache->get($key);
    if($cachedDate === false){
            $d = intval(preg_replace('/[^0-9]+/','',$_POST['birthday']),10);
            $sum = 0;
            do
            {
                    $sum += $d % 10;
            }
            while($d = (int) $d / 10);
            $memcache->set($key,$sum);
    }else{
            $sum = $cachedDate;
    }
    echo "<h2>It looks like your lucky number is ", $sum, "</h2>";
    ?>
         </div>
        </div>
       </div>
    </div>
    <?php 
  }
  else { ?>
    <div class="container-fluid">
     <div class="well">
      <div class="row">
       <div class="col-md-6 col-md-offset-3">
        <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
         <h2>Date of Birth</h2>
         <input class="form-control" type="text" id="datepicker" name="birthday" placeholder="Enter your date of birth."><br>
         <button type="submit" class="btn btn-primary" name="submit">Find my Lucky Number!</button>
        </form>
       </div>
      </div>
     </div>
    </div>
    <?php 
  }
} 
else { ?>
  <div class='container-fluid'>
    <div class='well'>
      <div class='row'>
        <div class="col-md-6 col-md-offset-4">
          <h1>
            Find your lucky number!!<br>
         <?php
           echo sprintf('<a href="%s">Sign in or register</a> ',
                UserService::createLoginUrl('/'));
         ?> 
         </h1>      
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>