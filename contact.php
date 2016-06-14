<?php 
 $page="contact.php";
 $pagename="Contact Us";
 include("_header.php"); ?>
<div id="content">
		
		<!-- /// CONTENT  /////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

			<div class="parallax" id="page-header" style="background-image:url(content/backgrounds/1920x800-12.jpg); margin-bottom:0;">
				
				<div class="container">
					<div class="row">
						<div class="span12">

                            <h3>Get in touch</h3>
                        
						</div><!-- end .span12 -->
					</div><!-- end .row -->
				</div><!-- end .container -->
				
			</div><!-- end #page-header -->
            
            <div class="map">
                <div class="google-map" 
                    data-zoom="15" 
                    data-address="Dallas, USA" 
                    data-caption="Office location"
                    data-maptype="ROADMAP"
                    data-popup="false"
                    data-mapheight="660">
                    <p>This will be replaced with the Google Map.</p>
                </div><!-- end .google-map -->
            </div><!-- end .map -->
                        
            <div class="container">    
                <div class="row">
                    <div class="span12">

						<div class="headline">
                        	
                            <h2>Contact</h2>
                         
                        </div><!-- end .headline -->
                    
                    </div><!-- end .span12 -->
                </div><!-- end .row -->
            </div><!-- end .container -->
            
            <div class="container">    
                <div class="row">
                    <div class="span4">
                    
                    <h4 class="text-uppercase"><strong>Call Us at</strong>   :                      
                        (469) 606-5232  </h4>
                        
 						                      
                                              
                        <div class="widget ewf_widget_contact_info"> 
                            <br>                   
                            <ul> 
                               <li> <strong> <i class="fa fa-user"></i> : Forrest Layton (Owner) </strong></li>                            
                               <li> <i class="fa fa-phone"></i> : ext-100  </li>
                               <li><i class="fa fa-envelope"></i> <a href="mailto:forrest@rmauthority.com"> :forrest@rmauthority.com</a> </li>
                            </ul>
                             <br>  <br>                  
                            <ul> 
                               <li> <strong> <i class="fa fa-user"></i> : Gary Gibbs (Sales Account Executive) </strong></li>                            
                               <li> <i class="fa fa-phone"></i> : ext-103  </li>
                               <li><i class="fa fa-envelope"></i> <a href="mailto:gary@rmauthority.com"> :gary@rmauthority.com</a> </li>
                            </ul>
                             <br>   <br>                 
                            <ul> 
                               <li> <strong> <i class="fa fa-user"></i> : David Altgelt (Sales Account Executive) </strong></li>                            
                               <li> <i class="fa fa-phone"></i> : ext-104  </li>
                               <li><i class="fa fa-envelope"></i> <a href="mailto:david@rmauthority.com"> :david@rmauthority.com</a> </li>
                            </ul>
                            
                        </div><!-- end .ewf_widget_contact_info -->
                        
                        <div class="widget ewf_widget_social_media"> 
                            
                            <div class="fixed">
                                
                                <a href="contact-1.html#" class="linkedin-icon social-icon">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                                
                                <a href="contact-1.html#" class="dribble-icon social-icon">
                                    <i class="fa fa-dribbble"></i>
                                </a>
                                
                                <a href="contact-1.html#" class="facebook-icon social-icon">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                
                                <a href="contact-1.html#" class="twitter-icon social-icon">
                                    <i class="fa fa-twitter"></i>
                                </a>
                                
                                <a href="contact-1.html#" class="instagram-icon social-icon">
                                    <i class="fa fa-instagram"></i>
                                </a>
                                
                            </div>
                            
                        </div><!-- end .ewf_widget_social_media -->
                    
                    </div><!-- end .span4 -->
                    <div class="span8">
                    	
                        <h4 class="text-uppercase"><strong>Leave a message</strong></h4>
                        
                        <form id="contact-form" name="contact-form" method="post" action="assets/php/send.php">  
                            <fieldset>
                                <div id="formstatus"></div>
                                <p>
                                    <input class="span12" type="text" id="name" name="name" value="" placeholder="Name">
                                </p>
                                <p>
                                   <input class="span12" type="text" id="email" name="email" value="" placeholder="Email"> 
                                </p>
                                <p>
                                    <input class="span12" type="text" id="subject" name="subject" value="" placeholder="Subject">
                                </p>                                        
                                <p>
                                    <textarea class="span12" id="message" name="message" rows="7" cols="25" placeholder="Message"></textarea>
                                </p>
                                <p class="last">
                                    <input class="btn" id="submit" type="submit" name="submit" value="Submit" >
                                </p>
                            </fieldset>
                        </form><!-- end #contact-form -->
                        
                    </div><!-- end .span8 -->
                </div><!-- end .row -->
            </div><!-- end .container -->                    
            
            <!-- end .fullwidth-section -->                        
		
		<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->    
		
		</div>

<?php include("_footer.php");?>