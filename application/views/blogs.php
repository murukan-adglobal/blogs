<?php  foreach ($blogs as $blog) {
  $date= $blog['datecreated']; 
?>
<div class="col-md-4">
   <div class="item">
    <div class="feature-details proj-details blog-card-main">
                <div class="feature-project-img blog-card">
                  <img src="<?= base_url() . 'uploads/blogs/' . $blog['images'] ?>" width="100px" class="img-fluid blog-img" alt="<?= $blog['images'] ?>" class="img img-responsive">
                </div>
                <div class="blog-sub">
              
                 
                  <h5><?php echo date('F j, Y', $date/1000); ?></h5>
                  <h4><a href="<?php echo base_url().'title/'.$blog['slug']?>"><?php echo $blog['title']; ?></a></h4>
                 <div class="content_div"><?php echo substr(strip_tags($blog['content']),0,110) . "..."; ?></div>
                </div>
              </div>
            </div>
          </div>
<?php } ?>