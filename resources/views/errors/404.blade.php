<!DOCTYPE html>
<html>
<head> <title>404</title>
<link href="https://fonts.googleapis.com/css?family=Lato:300" rel="stylesheet" type="text/css">

<style>
    html, body {
       height: 100%;
    }

    body {
       margin: 0;
       padding: 0;
       width: 100%;
       color: #666666;
       display: table;
       font-weight: 300;
       font-family: 'Lato';
    }

    .container {
       text-align: center;
       display: table-cell;
       vertical-align: middle;
    }

    .content {
       text-align: center;
       display: inline-block;
    }

    .title {
       font-size: 100px;
       margin-bottom: 40px;
    }

        /* Style buttons */
    .btn {
        background-color: #666666; /* Blue background */
        border: none; /* Remove borders */
        color: white; /* White text */
        padding: 12px 16px; /* Some padding */
        font-size: 16px; /* Set a font size */
        cursor: pointer; /* Mouse pointer on hover */
    }

    /* Darker background on mouse-over */
    .btn:hover {
        background-color: #0e0e0e;
    }
</style>
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
<script type="text/javascript">
  function goBack() {
      window.history.back();
  }
</script>
</head>
<body>
    <div class="container">
        <div class="content">
            <div class="title">Opss...Page Not Found!</div>
            <center><button class="btn" onclick="goBack()"><i class="fas fa-chevron-circle-left"></i></button></center>
        </div>
    </div>
</body>
</html>
