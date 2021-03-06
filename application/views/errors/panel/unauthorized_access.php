<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>401 Unauthorized Access</title>
  <style type="text/css">
    h4 {
      color: #253858;
      margin-bottom: .8rem;
      position: relative;
      font-family: 'Raleway', sans-serif;
      font-size: 1.5rem;
    }

    p {
      margin-top: 0;
      margin-bottom: 1rem;
      display: block;
      margin-block-start: 1em;
      margin-block-end: 1em;
      margin-inline-start: 0px;
      margin-inline-end: 0px;
      color: rgb(113, 120, 126);
      font-family: 'Lato', sans-serif;
    }

    .btn-primary:hover {
      color: #fff;
      background-color: #0069d9;
      border-color: #0062cc;
    }

    .btn-primary {
      color: #fff;
      background-color: #0069d9;
      border-color: #0062cc;
    }

    .btn-round {
      border-radius: 30px !important;
      text-decoration: none;
    }

    .btn {
      font-size: 15px;
      font-weight: 600;
      padding: 9px 25px;
      border-width: 2px;
      box-shadow: 0 3px 8px 0 rgba(41, 49, 89, .15), inset 0 0 0 1px hsla(0, 0%, 100%, .1);
    }

    .btn {
      display: inline-block;
      font-weight: 400;
      text-align: center;
      white-space: nowrap;
      vertical-align: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
      border: 1px solid transparent;
      padding: .375rem .75rem;
      font-size: 1rem;
      line-height: 1.5;
      border-radius: .25rem;
      transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .btn:not(:disabled):not(.disabled) {
      cursor: pointer;
    }

    /*[404 error page]
--------------------------*/
    .error-content {
      padding: 0 0 70px;
    }

    .error-text {
      text-align: center;
    }

    .error {
      font-size: 180px;
      font-weight: 100;
    }

    @keyframes bob {
      0% {
        top: 0;
      }

      50% {
        top: 0.2em;
      }
    }
  </style>
</head>

<body>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->


  <div class="error-content">
    <div class="container">
      <div class="row">
        <div class="col-md-12 ">
          <div class="error-text">
            <h1 class="error">401</h1>

            <h4>Oops! Anda tidak memiliki akses untuk modul ini!</h4>
            <br>
            <br>
            <br>
            <a onclick="history.back()" class="btn btn-success btn-round" style="color:white">Kembali ke halaman awal</a>
            <br>
            <br>
            <br>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>