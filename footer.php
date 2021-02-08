<?php Confirm_Login(); ?>
<!--SIDE ARE START-->
<div class="col-sm-4 ">
    <div class="card mt-4">
        <div class="card-body">
            <img src="images/startblog.PNG" class="d-block img-fluid mb-3" alt="">
            <div class="text-center">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                It has survived not only five centuries, but also the leap into electronic typesetting,
                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like
                Aldus PageMaker including versions of Lorem Ipsum.
            </div>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header bg-dark text-light">
            <h2 class="lead">Sign Up</h2>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-success btn-block text-center text-white mb-4" name="button">Join the Forum</button>
            <button type="button" class="btn btn-danger btn-block text-center text-white" name="button"><a href="Login.php">Log In</a></button>
            <br>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="" placeholder="Enter your email" value="">
                <div class="input-group-append">
                    <button type="button" class="btn btn-primary btn-sm text-center text-white" name="button">Subscribe Now</button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header bg-primary text-light">
            <h2 class="lead">Categories</h2>
        </div>
        <div class="card-body">
            <?php
            global $ConnectingDB;
            $sql = "SELECT *FROM category ORDER BY id desc";
            $stmt = $ConnectingDB->query($sql);
            while ($DataRows = $stmt->fetch()){
                $categoryId = $DataRows["id"];
                $CategoryName=$DataRows["title"];
                ?>
                <a href="index.php?category=<?php echo $CategoryName; ?>"><span class="heading"><?php echo $CategoryName; ?></span></a><br>
            <?php }?>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header bg-info text-white">
            <h2 class="lead"> Recent Posts</h2>
        </div>
        <div class="card-body">
            <?php
            global $ConnectingDB;
            $sql= "SELECT * FROM posts ORDER BY id desc LIMIT 0,5";
            $stmt= $ConnectingDB->query($sql);
            while ($DataRows=$stmt->fetch()) {
                $Id     = $DataRows['id'];
                $Title  = $DataRows['title'];
                $DateTime = $DataRows['datetime'];
                $Image = $DataRows['image'];
                ?>
                <div class="media">
                    <img src="Uploads/<?php echo htmlentities($Image); ?>" class="d-block img-fluid align-self-start"  width="90" height="94" alt="">
                    <div class="media-body ml-2">
                        <a style="text-decoration:none;"href="FullPost.php?id=<?php echo htmlentities($Id) ; ?>" target="_blank">
                            <h6 class="lead heading"><?php echo htmlentities($Title); ?></h6>
                        </a>
                        <p class="small"><?php echo htmlentities($DateTime); ?></p>
                    </div>
                </div>
                <hr>
            <?php } ?>
        </div>
    </div>
</div>
</div>
</div>
<!--HEADER ENDS-->


<!--SIDE AREA ENDS-->
<!--FOOTER STARTS-->
<!--<div style="height: 5px; background: cornflowerblue"></div>
<footer class="bg-dark text-white">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="lead text-center">THINK HARD |  <span id="year"></span>&copy: -----All right reserved</p>
            </div>
        </div>
    </div>
</footer>
<div style="height: 5px; background: cornflowerblue"></div>-->

<!-- Footer  
          -CODED BY PRITI KUMARI-->
          <footer class="footer-distributed" id="contact">
 
 <div class="footer-left">

 <h3>MindSaga<span>-2k21</span></h3>

 <p class="footer-links">
 <a href="#">Dashboard</a>
·
 <a href="#">Posts</a>
·
 <a href="#">Categories</a>
·
 <a href="#">Manage Admins</a>
·
 <a href="#">Comments</a>
·
 <a href="#">GO Live</a>
 </p>

 <p class="footer-company-name">Made with 💕 by Webwiz</p>
 </div>

 <div class="footer-center">

 <div>
 <i class="fa fa-map-marker"></i>
 <p><span>Loremlaudantium assumenda</span> Odisha, India</p>
 </div>

 <div>
 <i class="fa fa-phone"></i>
 <p>random789</p>
 </div>

 <div>
 <i class="fa fa-envelope"></i>
 <p><a href="">webwiz.nitrkl@gmail.com</a></p>
 </div>

 </div>

 <div class="footer-right">

 <p class="footer-company-about">
 <span>About MindSaga</span>
 Lorem ipsum dolor sit amet consectetur, adipisicing elit. Magni expedita assumenda temporibus sapiente veritatis veniam 
 </p>

 

     <ul class="social">
         <li>
           <a href="#" class="tw" title="Tweet this page!">
             <i class="icon-twitter"></i>
           </a>
         </li>
         <li>
           <a href="#" class="fb" title="Share this page!">
             <i class="icon-facebook"></i>
           </a>
         </li>
         <li>
           <a href="#" class="gp" title="Share this page!">
             <i class="icon-google-plus"></i>
           </a>
         </li>
         <li>
           <a href="#" class="gh" title="Tweet this page!">
             <i class="icon-github"></i>
           </a>
         </li>
         <li>
           <a href="#" class="insta" title="Tweet this page!">
             <i class="icon-instagram"></i>
           </a>
         </li>
         <li>
           <a href="#" class="in" title="Tweet this page!">
             <i class="icon-linkedin"></i>
           </a>
         </li>
       </ul>
 

 </div>
 </footer>

 <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
 <script src='https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.js'></script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script>
    $('#year').text(new Date().getFullYear());
</script>
</body>
</html>
