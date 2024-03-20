<?php

session_start();

//echo $_SESSION['email'];      
?>
<html>

<head>

  <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
  <script src="assets/plugins/global/plugins.bundle.js"></script>


  <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="icon" type="image/png" href="path-to-your-favicon" />
  <link rel="icon" type="image/png" href="./img/rem.png" />
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->


  <link href="toastr.css" rel="stylesheet">
  <script src="toastr.js"></script>
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

  <link href="https://raw.githubusercontent.com/daneden/animate.css/master/animate.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
  <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  <!-- Latest compiled and minified CSS -->

  <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css" />

  <!-- Latest compiled and minified JavaScript -->

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/9147789c41.js" crossorigin="anonymous"></script>

  <!-- Linking the stylesheet -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./css/dashboard.css">

  <!-- Linking the Jquery script -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>


  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">




</head>
<style>
  body {
    text-align: center;
    padding: 40px 0;
    background: #EBF0F5;
  }

  h1 {
    color: #88B04B;
    font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
    font-weight: 900;
    font-size: 40px;
    margin-bottom: 10px;
  }

  p {
    color: #404F5E;
    font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
    font-size: 20px;
    margin: 0;
  }

  i {
    color: #9ABC66;
    font-size: 100px;
    line-height: 200px;
    margin-left: -15px;
  }

  .card {
    background: white;
    padding: 60px;
    border-radius: 4px;
    box-shadow: 0 2px 3px #C8D0D8;
    display: inline-block;
    margin: 0 auto;
  }

  /* CSS */
  .button-3 {
    appearance: none;
    background-color: #2ea44f;
    border: 1px solid rgba(27, 31, 35, .15);
    border-radius: 6px;
    box-shadow: rgba(27, 31, 35, .1) 0 1px 0;
    box-sizing: border-box;
    color: #fff;
    cursor: pointer;
    display: inline-block;
    font-family: -apple-system, system-ui, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji";
    font-size: 14px;
    font-weight: 600;
    line-height: 20px;
    padding: 6px 16px;
    position: relative;
    text-align: center;
    text-decoration: none;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    vertical-align: middle;
    white-space: nowrap;
  }

  .button-3:focus:not(:focus-visible):not(.focus-visible) {
    box-shadow: none;
    outline: none;
  }

  .button-3:hover {
    background-color: #2c974b;
  }

  .button-3:focus {
    box-shadow: rgba(46, 164, 79, .4) 0 0 0 3px;
    outline: none;
  }

  .button-3:disabled {
    background-color: #94d3a2;
    border-color: rgba(27, 31, 35, .1);
    color: rgba(255, 255, 255, .8);
    cursor: default;
  }

  .button-3:active {
    background-color: #298e46;
    box-shadow: rgba(20, 70, 32, .2) 0 1px 0 inset;
  }
</style>

<body>
  <div class="card">
    <img src="./img/7efs (1).gif" id="img1" height="auto" width="auto" style="margin-bottom: 50px;" loop="false" />
    <script>
      setTimeout(function() {
        setInterval(function() {
          $('#img1').attr('src', $('#img1').attr('src'))
        }, 1)
      }, 2000)
    </script>

    <h1>Done</h1>
    <p>Your payment was successfully recevied by SMP - Society Management Team<br /> we'll be in touch shortly!</p>
    <br><br><br>
    <table style="margin-left: 165px">
      <tr>
        <td>
          <form id="openWindowForm" action="./index.php" method="post" target="_blank">
            <button class="button-3" role="button" type="submit">
              <i class="fa fa-door-open" style="color: white; padding-left:10px;">&nbsp;&nbsp;</i>Open Your Portal
            </button>
          </form>

          <script>
            document.getElementById('openWindowForm').addEventListener('submit', function(event) {
              event.preventDefault(); // Prevent form submission

              // Open index.php in a new window with specific dimensions
              var width = 900; // Specify the width of the new window
              var height = 600; // Specify the height of the new window
              var left = (screen.width - width) / 2; // Calculate the left position
              var top = (screen.height - height) / 2; // Calculate the top position

              var newWindow = window.open(this.action, 'NewWindow', 'width=' + width + ',height=' + height + ',left=' + left + ',top=' + top + ',menubar=yes,toolbar=yes,location=yes,status=yes,resizable=yes');

              // Prompt user to create a desktop shortcut
              if (confirm('Would you like to create a desktop shortcut for this page?')) {
                // The below code is not supported in all browsers and may not work as expected
                if (newWindow && newWindow.navigator && newWindow.navigator.msSaveOrOpenBlob) {
                  // For Internet Explorer
                  newWindow.navigator.msSaveOrOpenBlob(newWindow.location.href, 'ShortcutName.url');
                } else {
                  // For other browsers, provide instructions
                  alert('To create a desktop shortcut, please use your browser\'s built-in functionality or follow the instructions provided by your operating system.');
                }
              }
            });
          </script>



        </td>
        <td>&emsp;</td>
        <td>
          <form action="./pdf.php" method="post">
            <button class="button-3" role="button" type="submit"><i class="fa fa-download" style="color: white; padding-left:10px;">&nbsp;&nbsp;</i>Download e-Receipt</button>
          </form>
        </td>
      </tr>
    </table>
  </div>
</body>

</html>