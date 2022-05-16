  <html>

        <div class="container-fluid" style="background-color: black">
           
                   
            <div class="row">
                <div class="col-md-12" style="background-color: black">
                    <h1 align="center" style="color:#FFF" >Prasanna Motors (Pvt) Ltd.</h1>
                    <h2 align="center" style="color:#FFF" ><em> Craft hands for Autocare </em></h2>
                    <h1>   </h1>
                </div >
            
            
                
            <div class="row" style="height: 200px">
                
                <div class="col-md-4 col-md-offset-7">
                    <div id="alertdiv"></div>    <!-- to display the alert message -->
                </div>
            </div>
          
                <div class="row">
                <div class="col-md-6">
                <img src="../images/w.jpeg" class="img-responsive" alt="Responsive image"  height="100px"> <!-- to display image, alt attribute specifies an alternate text for an image, if the image cannot be displayed-->
                </div>
                <div class="col-md-1" >
                   &nbsp;
                </div>
                    
                    
                    
                    
                 <div class="col-md-4">
                                       
                 <form action="../controller/login_controller.php?status=login" method="POST">
                     

                     
                        <div class="panel panel-default" style="height: 4 00px"> <!-- to display the panel -->
            <?php
            
            if(isset($_GET["msg"]))
            {
            ?>
            
             <div class="row">
                 <div class="col-md-12">
                     <div class="alert alert-danger">
                         <?php
                            echo base64_decode($_GET["msg"]);
                         ?>
                     </div>
                     
                 </div>
            </div>

      <div class="container-fluid" style="background-color: black">

                            <div class="panel-heading" style="background-color: #33220e">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 style="color:#FFF">Sign in to your account</h4>
                                    </div>
                                </div>
                             
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-user"></span>
                                            </span>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="username"/>
                                        </div>
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-lock"></span>
                                            </span>
                                            <input type="password" class="form-control" id="password" placeholder="password" name="password" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                          <div class="col-md-12"> 
                              
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>                  

                          </div>  
                                </div>
                                
                                  
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="submit" style="background-color: #33220e;color:#FFF;" class="btn  btn-block"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>  
                    
              
                        
                    </div>
                    <div class="col-md-1" >
                   &nbsp;
                    </div>
                  
                    
                </div>
        
            </div>
            <div class="row" style="height:100px">
                <div class="col-md-4">
                  
                </div>
            </div>
           



              <div class="row" style="height: 200px">

                  <div class="col-md-4 col-md-offset-7">
                      <div id="alertdiv"></div>
                  </div>
              </div>

              <div class="row">
                  <div class="col-md-6">
                      <img src="../images/w.jpeg" class="img-responsive" alt="Responsive image" height="100px">
                  </div>
                  <div class="col-md-1">
                      &nbsp;
                  </div>




                  <div class="col-md-4">

                      <form action="../controller/login_controller.php?status=login" method="POST">



                          <div class="panel panel-default" style="height: 4 00px">
                              <?php
                                echo "cdcddfdfdfd";
                                if (isset($_GET["msg"])) {
                                ?>

                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="alert alert-danger">
                                              <?php
                                                echo base64_decode($_GET["msg"]);
                                                ?>
                                          </div>

                                      </div>
                                  </div>


                              <?php
                                }
                                ?>

                              <div class="panel-heading" style="background-color: #33220e">
                                  <div class="row">
                                      <div class="col-md-12">
                                          <h4 style="color:#FFF">Sign in to your account</h4>
                                      </div>
                                  </div>

                              </div>
                              <div class="panel-body">
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="input-group">
                                              <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-user"></span>
                                              </span>
                                              <input type="text" class="form-control" id="username" name="username" placeholder="username" />
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-12">&nbsp;</div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="input-group">
                                              <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-lock"></span>
                                              </span>
                                              <input type="password" class="form-control" id="password" placeholder="password" name="password" />
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-12">

                                          <div class="row">
                                              <div class="col-md-12">&nbsp;</div>
                                          </div>

                                      </div>
                                  </div>


                                  <div class="row">
                                      <div class="col-md-12">
                                          <input type="submit" style="background-color: #33220e;color:#FFF;" class="btn  btn-block" />
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </form>



                  </div>
                  <div class="col-md-1">
                      &nbsp;
                  </div>


              </div>

          </div>
          <div class="row" style="height:100px">
              <div class="col-md-4">

              </div>
          </div>


      </div>




  </body>
  <!--   include jquery -->
  <script src="../js/jquery-1.12.4.js"></script>

  <script src="../js/loginvalidation.js"></script>
  <!-- include bootstrap js -->
  <script src="../bootstrap/js/bootstrap.min.js"></script>

  </html>