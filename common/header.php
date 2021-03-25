<?php
    $client = isset($_SESSION['client']) ? $_SESSION['client'] : '' ;
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <meta http-equiv="pragma" content="no-cache">
        <meta http-equiv="cache-control" content="max-age=604800">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title></title>

        <link href="images/am_logo.jpg" rel="shortcut icon" type="image/x-icon">
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="css/ui.css" rel="stylesheet" type="text/css">
        <link href="css/responsive.css" rel="stylesheet" media="only screen and (max-width: 1200px)">
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <link href="css/cart.css" rel="stylesheet" type="text/css">

        <script src="https://kit.fontawesome.com/eeae5646a1.js" crossorigin="anonymous"></script>

    </head>
    <header class="section-header">
        <section class="header-main border-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-4">
                        <a href="#" class="brand-wrap">
                            <img class="logo" src="images/am_logo.jpg">
                        </a>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="input-group w-100">
                            <input type="text" class="form-control search-item" placeholder="Tape product name">
                            <div class="input-group-append" data-toggle="tooltip" data-placement="right" title="Search">
                                <button class="btn btn-outline-light search" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-outline-light reset" data-toggle="tooltip" data-placement="right" title="Show all" style="height: 40px;">
                                    <i class="fa fa-list"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="widgets-wrap float-md-right">
                            <div class="widget-header mr-3" type="button" data-toggle="modal" data-target="#modal1" class="btn btn-warning" id="showCart">
                                <a href="#" class="icon icon-sm rounded-circle border" type="button" data-toggle="modal" data-target="#modal1" class="btn btn-warning" id="showCart">
                                <i class="fa fa-shopping-cart"></i></a>
                                <span class="badge badge-pill badge-danger notify" id="cart_badge">0</span>
                            </div>
                            <div class="widget-header icontext">
                                <a href="#" class="icon icon-sm rounded-circle border"><i class="fa fa-user"></i></a>
                                <div class="user-div">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </header>
</style>
</html>