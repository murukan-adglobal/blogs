<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>VGN Blogs</title>

  <meta name="title" content="">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  

  <meta name="google-site-verification" content="sECFO__o3gFBOp5WrIZnWyaB2Cz4i7PEKKzOaLSA3KI" />


<meta property="og:type" content="website" />
<meta property="og:title" content="" />
<meta property="og:description" content="" />
<meta property="og:url" content="https://www.vgn.in/projects/kensington-towers-guindy-chennai" />
<meta property="og:image" content="<?php echo asset_url().'img/logo.png'; ?>" />
<meta property="og:site_name" content="VGN" />



 <link rel="canonical" href="https://www.vgn.in/projects/kensington-towers-guindy-chennai" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset_url().'css/bootstrap.css';?>">
    <link rel="stylesheet" href="<?php echo asset_url() . 'css/rte_theme_default.css'; ?>" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bree+Serif&family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <!-- FAVICONS -->
  <link rel="shortcut icon" href="<?php echo asset_url().'img/favicon/favicon.png';?>" type="image/png">
  <link rel="icon" href="<?php echo asset_url().'img/favicon/favicon.png';?>" type="image/png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css">
    <style>
        .ajax-loader {
            /* position: fixed; */
            z-index: 10000 !important;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ajax-loader .img {
            position: relative;
            width: 50px;
        }

        .copyrights {
		background-color:#EEEEEE;
		padding: 20px 0px;
	}
 
    </style>



</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light  copyrights">
  <div class="container">
  <div class="header-logo">
      <a href="<?=base_url()?>"><img src="<?php echo asset_url().'img/logo.png';?>" class="img-fluid" alt="logo" /></a>                
  </div>

  </div>
</nav>
    <div class="container">
      
    <h4 class="my-5" style="margin-top: 600px;">Create a New Blog Post <a href="<?=base_url().'admin/signout'?>" class="btn btn-primary float-right btn-sm">Logout</a><br><a href="<?=base_url().'admin/dashboard'?>" class="btn btn-primary  btn-sm my-3">All Blogs</a><br></h4>
<div class="row">

   
   

    <div class="card">
  <div class="card-body">
  <form method="post" action="" enctype="multipart/form-data" id="blog_form">
            <!-- Title Input -->
            
           
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" <?php if(!empty($blog_details)){ ?> value="<?=$blog_details['title']?>" <?php }?> name="title" required>
            </div>

            <!-- Content Textarea -->
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="" id="content" name="content" required>
                <?php if(!empty($blog_details)){ ?><?=$blog_details['content']?><?php } ?>
                </textarea>


            </div>

            <!-- Excerpt Textarea -->


            <!-- Category Dropdown -->
    

            <!-- Tags Input -->
            <div class="mb-3">
                <label for="tags" class="form-label">Tags</label>
                <input type="text" class="form-control" id="tags" <?php if(!empty($blog_details)){ ?> value="<?=$blog_details['tags']?>" <?php }?> name="tags" placeholder="Enter tags separated by commas">
                <small class="form-text text-muted">Separate tags with commas, e.g., programming, web development, design</small>
            </div>

            <!-- Featured Image Input -->
            <div class="mb-3">
                <label for="featuredImage" class="form-label">Featured Image</label>
                <input type="file" required  class="form-control" id="featuredImage" name="featuredImages[]">
            </div>

            <!-- Post Status Radio Buttons -->
            <div class="mb-3">
                <label class="form-label">Post Status</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="poststatus" id="published" value="active" checked>
                    <label class="form-check-label" for="published">Acive</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="poststatus" id="draft" value="inactive">
                    <label class="form-check-label" for="inactive">Inactive</label>
                </div>
            </div>

            <div class="ajax-loader" style="display: none;">
                <div id="loader-container" class="img">
                </div>
            </div>
            <!-- Submit Button -->
            <button type="submit" id="blog_btn" class="btn btn-primary">Create Post</button>
        </form>
  </div>
</div>

    
</div>
        
    </div><br>
    <footer> 
     <div class="footer-section" style="display: none;">
        <div class="container">
          <div class="footer-top-wrap">
          <div class="col-md-12">
          <div class="footer-logo">
          <a href="/"><img src="/asset/img/icons/footer-logo.png" class="img-fluid" alt="footer-logo" /></a>
          </div>
          <div class="footer-top-content">
          <p>Established in the year 1942, VGN has Successfully carved a niche for itself in the ever-dynamic real industry over the last 83 years. An ISO 9001-2008 certified Company, VGN is Known as much for its beautiful, world-class homes as it is for following best practices in the industry, being an Integrated Management System (IMS) certified company by Lloyd’s Register.</p>
          </div>
          </div>
          <div class="row">
          <div class="col-md-8">
            <div class="footer-address-list">
                <h2>VGN Projects Estates Pvt. Ltd.</h2>
                <ul class="list-unstyled">
                  <li>Y - 222, VGN Kimberly Towers,</li>
                  <li>2nd Avenue, Anna Nagar,</li>
                    <li>Chennai - 600040</li>
                    <li>
                      <a href="tel:04443439999"><i class="fa fa-phone" aria-hidden="true"></i> 044 4343 9999</a>                     
                    </li>
                </ul>
            </div>
          </div>
          <div class="col-md-4">
          <div class="social-icons">
          <h3>Follow Us</h3>
          <ul class="list-unstyled d-flex d-inline-flex">
          <li><a href="https://www.facebook.com/VGNProjectsEstates" target="_blank"><i class="fa fa-facebook"></i></a></li>
          <li><a href="https://twitter.com/VGNProjects" target="_blank"><i class="fa fa-twitter"></i></a></li>
          <li><a href="https://www.youtube.com/user/vgndevelopers" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
          <li><a href="https://www.instagram.com/vgn_projects_estates/" target="_blank"><i class="fa fa-instagram"></i></a></li>
          <li><a href="https://www.pinterest.ru/vgnprojectsestatespvtltd/" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>
          <li><a href="https://www.linkedin.com/company/27106479" target="_blank"><i class="fa fa-linkedin-square"></i></a></li>
          </ul>
          </div>
          </div>
          </div>
          </div>
         <div class="footer-wrap">
            <div class="row">
              <div class="col-xs-5ths">
                <div class="footer-contact">
                  <h3>Flats in Chennai</h3>
                  <ul class="list-unstyled">
                    <li class="location"><a href="/">2 BHK Flats in Chennai</a></li>
                    <li class="phone"><a href="/">3 BHK Flats in Chennai</a></li>
                    <li class="mail"><a href="/">4 BHK Flats in Chennai</a></li>
                    <!-- <li class="mail"><a href="#">2 BHK Flats in Chennai</a></li> -->
                  </ul>
                </div>
              </div>
              <div class="col-xs-5ths">
                <div class="footer-menu">
                  <h3>Projects</h3>
                  <ul class="list-unstyled">
                    <li><a href="/projects/fairmont-guindy-chennai">Ongoing Projects </a></li>
                    <li><a href="/projects/notting-hill-nungambakkam-chennai">Ready to Move in Projects</a></li>
                    <li><a href="/completed-projects">Completed Projects</a></li>
                     <li><a href="/projects/kensington-towers-guindy-chennai">Upcoming Projects</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-xs-5ths">
                <div class="footer-menu">
                  <h3>Locations</h3>
                  <ul class="list-unstyled">
                    <li><a href="/projects/fairmont-guindy-chennai">Apartments in Guindy - VGN Fairmont</a></li>

                    <li><a href="/projects/kensington-towers-guindy-chennai">Apartments in Guindy - VGN Kensington Towers</a></li>

                    <li><a href="/projects/notting-hill-nungambakkam-chennai">Apartments in Nungambakkam</a></li>
                    <li><a href="/projects/brixton-Irungattukottai-chennai">Apartments in Irungattukottai</a></li>
                    <li><a href="/projects/marble-arch-tambaram-chennai">Apartments in Tambaram</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-xs-5ths">
                <div class="footer-menu">
                  <h3>Login</h3>
                  <ul class="list-unstyled">
                    <li><a href="https://www.vgn.in/customerzone/customerlogin">Customer Login</a></li>
                    <li><a href="https://www.vgn.in/employeezone/employeelogin">Employee Login</a></li>
                    <li><a href="https://www.vgn.in/vendorzone/vendorlogin">Vendor Login</a></li>
                    <li><a href="https://www.vgn.in/vendorzone/registration">Vendor Registration</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-xs-5ths">
                <div class="footer-menu">
                  <h3>Quick Links</h3>
                  <ul class="list-unstyled">
                    <li><a href="/">Home</a></li>
                    <li><a href="/about-us">About us</a></li>
                    <li><a href="https://www.vgn.in/landownersform">For Land Owners</a></li>
                    <li><a href="https://interiorsone.vgn.in/" target="_blank">VGN Interiors</a></li>
                    <li><a href="https://homebuilding.vgn.in/" target="_blank">VGN Home Building</a></li>
                    <li><a href="/investors">Investors</a></li>
                    <li><a href="http://blog.vgn.in/">Blogs</a></li>
                    <li><a href="/careers">Careers</a></li>
                    <li><a href="https://docs.google.com/forms/d/e/1FAIpQLSeO06aGnRgc6FzNYAfOYlQvsG6C4TR7K_PfBHzWc70NgiimWw/viewform?usp=sharing">Referrals</a></li>
                  </ul>
                </div>
              </div>
             
            </div>
          </div>
        </div>
      </div>

      <div class="copyrights text-center">
        <p>Copyright &copy; 2023 VGN Projects Estates Pvt Ltd. All Rights Reserved. Site Map | <a href="#" class="footer-privacy" data-toggle="modal" data-target="#privacypolicy" >Privacy Policy </a>|<a href="https://www.vgn.in/disclaimer" class="footer-privacy"> Disclaimer</a> |<a href="https://www.vgn.in/terms_and_conditions" class="footer-privacy"> Terms and Conditions</a></p>
      </div>
    </footer>

    <div class="modal fade" id="popupform">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <!-- <h4 class="modal-title text-primary">AUDITION</h4> -->
          
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body mx-auto w-100">
          <div class="">
            <div id="popupmainform" class="form_box">
              <form  id="popupsubmitForm" method="post" action="/kensington-towers-lead" class="full-form-container main-form" >
                @csrf
                <div>
                  <h3>Request a Callback</h3>
                </div>
              
                  <div class="col-md-12">
                  <div class="form-group">
                    <input id="popupname"  name="Name" type="text" class="form-control form-text user-icon" placeholder="Name">
                  </div>
                  </div>
                 <div class="col-md-12">
                   <div class="form-group">
                   <input type="tel" id="popupphone"  name="Mobile" class="form-control form-text phone-icon" placeholder="Mobile">
                   </div>
                 </div>
                  <div class="col-md-12">
                  <div class="form-group">
                    <input type="email"  id="popupemail" name="Email" class="form-control form-text email-icon" placeholder="Email">
                  </div>
                  </div>
                    <input type="hidden" name="project" value="VGN KENSINGTON TOWERS">
                    <input type="hidden" name="sourceId" value="12">
                    <input type="hidden" name="redirect" value="/projects/kensington-towers-guindy-chennai-thank-you">
                  <div class="col-md-12">
                  <div class="form-group">
                    <input class="btn form-control form-text submitBtn" type="submit" value="SUBMIT" id="popupsubmitbtn"/>
                  </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="privacypolicy">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <!-- <h4 class="modal-title text-primary">AUDITION</h4> -->
          
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body mx-auto w-100">
          <div class="">
            <p class="privacy-text">Privacy Policy: Your personal information (Name, Email, Phone, Message) submitted will not be sold, shared or rented to others. We use this information to send updates about our project and contact you if requested or find it necessary.</p>
          </div>
        </div>
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="<?php echo asset_url() . 'js/lottie.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo asset_url() . 'js/rte.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo asset_url() . 'js/all_plugins.js'; ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>

    <script>
        $(function() {
            var editor1 = new RichTextEditor("#content");
            'use strict'
            $(document).on('submit', "#blog_form", function(e) {
              
                e.preventDefault();
                $.ajax({
                    url: "<?php echo base_url(); ?>blog/save_blog",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                         $('#blog_btn').hide();
                         $('.ajax-loader').show();
                    },
                    success: function(data) {
                        // $('.ajax-loader').css("visibility", "hidden");
                        data = JSON.parse(data);
                    
                        if (data.status == 'success') {

                            toastr.success(data.msg);
                            $("#blog_form")[0].reset();
                            $('#blog_btn').show();
                            $('.ajax-loader').hide();
                            setTimeout(function() {
                                 window.location.href = "<?php echo base_url(); ?>admin/dashboard";
                            }, 1000);
                        } else {
                            toastr.error(data.message);
                            $('#blog_btn').show();
                           $('.ajax-loader').hide();
                        }
                    }
                });
            });

            getLocation();
            var x = '';

            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition, showError);
                } else {
                    x = "Geolocation is not supported by this browser.";
                }
            }

            function showPosition(position) {
                var hidlat = document.getElementById("hid_lat");
                var hidlong = document.getElementById("hid_long");
                hidlat.value = position.coords.latitude;
                hidlong.value = position.coords.longitude;
                x = "Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude;
            }

            function showError(error) {
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        x = "User denied the request for Geolocation."
                        break;
                    case error.POSITION_UNAVAILABLE:
                        x = "Location information is unavailable."
                        break;
                    case error.TIMEOUT:
                        x = "The request to get user location timed out."
                        break;
                    case error.UNKNOWN_ERROR:
                        x = "An unknown error occurred."
                        break;
                }
            }
        });
    </script>
</body>

</html>