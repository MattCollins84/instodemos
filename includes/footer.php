  <footer>
    <div class='container'>  
      <div class='row'>
        <div class='span4'>
          <ul class='unstyled'>
            <li><a href='/contact'>Contact</a></li>
          </ul>
        </div>
        
        <div class='span4'>
          <ul class='unstyled'>
            <li><a href='#'><img src='/img/fb_logo.png' /></a> <a href='#'><img src='/img/twitter_logo.png' /></a></li>
          </ul>
        </div>
        
        <div class='span4'>
          <ul class='unstyled'>
            <li>&copy; Matt Collins 2012</li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
    
    <script src="/js/jquery.mousewheel-3.0.4.pack.js"></script>
    <script src="/js/jquery.gmap.js"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script src="/js/iso-custom.js"></script>
    <script src="/js/jquery.isotope.min.js"></script> 
    <script src="/js/bootstrap-scrollspy.js"></script>
    <script src="/js/anchor.js" type="text/javascript"></script>
    <script src="/js/bootstrap.js"></script>



       <!-- MAP -->

     <script type="text/javascript">
			$(document).ready(function(){
				$("#map").gMap({ controls: false,
													scrollwheel: false,
															draggable: true,
													markers: [{ latitude: 44.47698,
																			longitude: 1006.8,
																			icon: { image: "img/pin.png",
																							iconsize: [32, 47],
																							iconanchor: [32,47],
																							infowindowanchor: [12, 0] } }
																		],
													icon: { image: "img/pin.png", 
																	iconsize: [26, 46],
																	iconanchor: [12, 46],
																	infowindowanchor: [12, 0] },
													latitude: 44.47698,
													longitude: 1006.8,
													zoom: 15, });
			});
		</script>
    
  </body>
</html>
