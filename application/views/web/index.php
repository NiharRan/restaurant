<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Restaurant-Kit</title>
  <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
  <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Satisfy|Bree+Serif|Candal|PT+Sans">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/web/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/web/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/web/css/style.css">
  <style>
    .has-error {
      border-color: red !important;
    }
    .message {
      float: right;
      color: #059251;
      font-weight: bold;
    }
    .hide {
      visibility: hidden;
    }
    
  </style>
</head>

<body>
  <!--banner-->
  <section id="banner">
    <div class="bg-color">
      <header id="header">
        <div class="container">
          <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="#home">Home</a>
            <a href="#contact">Book a table</a>
            <a href="<?php echo base_url(); ?>auth/login">Sign In</a>
          </div>
          <!-- Use any element to open the sidenav -->
          <span onclick="openNav()" class="pull-right menu-icon">☰</span>
        </div>
      </header>
      <section id="home">
        <div class="container">
          <div class="row">
            <div class="inner text-center">
              <h1 class="logo-name">Restaurant-Kit</h1>
              <h2>Food To fit your lifestyle & health.</h2>
              <h3><?php echo date('h:i A', strtotime($restaurant['daily_open_at'])); ?> ~ <?php echo date('h:i A', strtotime($restaurant['daily_close_at'])); ?></h3>
              <p>Specialized in Indian Cuisine!!</p>
            </div>
          </div>
        </div>
      </section>
    </div>
  </section>
  <!-- / banner -->
  <section class="best-receipe-area">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="section-heading">
            <h3>The best Receipies</h3>
          </div>
        </div>
      </div>
      <div class="row">
        <?php if (count($products) > 0) {
          foreach ($products as $product) {
            ?>
            <div class="col-12 col-sm-6 col-lg-4">
              <div class="single-best-receipe-area mb-30">
                <div class="image-box">
                  <img src="<?php echo base_url(); ?><?php echo $product["image"]; ?>" alt="">
                </div>
                <div class="receipe-content">
                  <a href="receipe-post.html">
                    <h5><?php echo $product['name']; ?></h5>

                  </a>
                </div>
              </div>
            </div>
        <?php }
        }
        ?>
      </div>
    </div>
  </section>
  <!-- contact -->
  <section id="contact" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <h1 class="header-h">Book Your table</h1>
          <p class="header-p"><?php echo $restaurant["message"]; ?>. </p>
        </div>
      </div>
      <div class="row msg-row">
        <div class="col-md-4 col-sm-4 mr-15">
          <div class="media-2">
            <div class="media-left">
              <div class="contact-phone bg-1 text-center"><span class="phone-in-talk fa fa-phone"></span></div>
            </div>
            <div class="media-body">
              <h4 class="dark-blue regular">Phone Numbers</h4>
              <p class="light-blue regular alt-p">+88<?php echo $restaurant["phone"]; ?> - <span class="contacts-sp">Phone Booking</span></p>
            </div>
          </div>
          <!-- <div class="media-2">
            <div class="media-left">
              <div class="contact-email bg-14 text-center"><span class="hour-icon fa fa-clock-o"></span></div>
            </div>
            <div class="media-body">
              <h4 class="dark-blue regular">Opening Hours</h4>
              <p class="light-blue regular alt-p"> Monday to Friday 09.00 - 24:00</p>
              <p class="light-blue regular alt-p">
                Friday and Sunday 08:00 - 03.00
              </p>
            </div>
          </div> -->
        </div>
        <div class="col-md-8 col-sm-8">
          <?php 
          $close_at = $restaurant['close_at'];
          $open_at = $restaurant['open_at'];
          function datetostring($date) {
            return date('j', strtotime($date)).'<sup>'.date('S', strtotime($date)).'</sup> '.date('F', strtotime($date)).' '.date('Y', strtotime($date));
          }
          if (strtotime(date('H:i:s')) < strtotime($restaurant['daily_open_at']) 
            || strtotime(date('H:i:s')) > strtotime($restaurant['daily_close_at'])) { ?>
            <div class="banner">
              <div class="banner-wrapper">
                <div class="banner-center">
                  <p class="headline">Please be informed our Restaurant is <span class="colored">closed.</span></p>
                  <p class="headline">Will be open at <span class="colored"><?php echo date('h:i A', strtotime($restaurant['daily_open_at'])); ?></span></p>
                </div>
              </div>
            </div>
          <?php }else {
            if($close_at != '' && $open_at != '' && date('Y-m-d') >= $close_at
            && date('Y-m-d') <= $open_at) {?>
            <div class="banner">
              <div class="banner-wrapper">
                <div class="banner-center">
                  <?php if($close_at == $open_at) {?>
                  <p class="headline">Please be informed our Restaurant is <span class="colored">closed on <?php echo datetostring($open_at); ?></span> from <span class="colored"><?php echo date('h:i A', strtotime($restaurant['daily_open_at'])); ?> until <?php echo date('h:i A', strtotime($restaurant['daily_close_at'])); ?></span></p>
                  <?php } else {?>
                    <p class="headline">Please be informed our Restaurant is <span class="colored">closed</span> from <span class="colored"><?php echo datetostring($close_at); ?></span> to <span class="colored"><?php echo datetostring($open_at); ?></span></p>
                  <?php } ?>
                </div>
              </div>
            </div>
              <?php } else {?>
            <form action="" method="post" role="form" class="contactForm">
              <div id="sendmessage">Your booking request has been sent. Thank you!</div>
              <div id="errormessage"></div>
              <div class="col-md-6 col-sm-6 contact-form pad-form">
                <div class="form-group label-floating is-empty">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validation"></div>
                </div>

              </div>
              <div class="col-md-6 col-sm-6 contact-form">
                <div class="form-group">
                  <input type="date" class="form-control label-floating is-empty" name="date" id="date" placeholder="Date" data-rule="required" data-msg="This field is required" />
                  <div class="validation"></div>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 contact-form pad-form">
                <div class="form-group">
                  <input type="email" class="form-control label-floating is-empty" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validation"></div>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 contact-form">
                <div class="form-group">
                  <input type="time" class="form-control label-floating is-empty" name="time" id="time" placeholder="Time" data-rule="required" data-msg="This field is required" />
                  <div class="validation"></div>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 contact-form">
                <div class="form-group">
                  <input type="text" class="form-control label-floating is-empty" name="phone" id="phone" placeholder="Phone" data-rule="required" data-msg="This field is required" />
                  <div class="validation"></div>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 contact-form">
                <div class="form-group">
                  <input type="text" class="form-control label-floating is-empty" name="people" id="people" placeholder="Number Of People" data-rule="required" data-msg="This field is required" />
                  <div class="validation"></div>
                </div>
              </div>
              <div class="col-md-12 contact-form">
                <div class="form-group label-floating is-empty">
                  <textarea class="form-control" name="message" rows="5" rows="3" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                  <div class="validation"></div>
                </div>

              </div>
              <div class="col-md-12 btnpad">
                <div class="contacts-btn-pad">
                  <button type="submit" class="contacts-btn">Book Table</button>
                  <span id="msg" class="message hide"></span>
                </div>
              </div>
          </form>
          <?php } 
          }
          ?>
        </div>
      </div>
    </div>
  </section>
  <!-- / contact -->
  <!-- footer -->
  <footer class="footer text-center">
    <div class="footer-top">
      <div class="row">
        <div class="col-md-offset-3 col-md-6 text-center">
          <div class="widget">
            <h4 class="widget-title">Reataurant-Kit</h4>
            <address><?php echo $restaurant["address"]; ?><br><?php echo $restaurant["country"]; ?></address>
            <div class="social-list">
              <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
              <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            </div>
            <p class="copyright clear-float">
              © Reataurant-Kit
              <div class="credits">
                Designed by <a href="#">Kangkhita & Mubin</a>
              </div>
            </p>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- / footer -->

  <script src="<?php echo base_url(); ?>assets/web/js/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/web/js/jquery.easing.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/web/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/web/js/custom.js"></script>
  <script>
    $(function () {
      $('.contactForm').submit(function (e) {
        e.preventDefault();
        $(this).find('.text-danger').remove();
        var data = $(this).serialize();
        $.ajax({
          url: '<?php echo base_url(); ?>web/booking_a_table',
          type: 'POST',
          data: data,
          dataType: 'JSON',
          success: function (response) {
            if (response.check) {
              if (response.success) {
                $("#msg").removeClass('hide').text("Message Send Successfully!");
                setTimeout(function () {
                  location.reload();
                }, 1000);
              }
            } else {
              $.each(response.errors, function (key, value) {
                var el = $(".form-group #"+key);
                el.addClass(value.length > 0 ? 'has-error' : '');
                el.closest(".form-group")
                  .find('.text-danger').remove();
                el.after(value);
              })
            }
          }
        });
      })
    })
  </script>
</body>

</html>
