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
            <li><a href='https://twitter.com/insto_'><img src='/img/twitter_logo.png' /></a></li>
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
		<!--<script type="text/javascript">stLight.options({publisher: "ca3afe8e-fef8-4dfd-8c34-5b62dd456eb4", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
		<script>
		var options={ "publisher": "ca3afe8e-fef8-4dfd-8c34-5b62dd456eb4", "position": "left", "ad": { "visible": false, "openDelay": 5, "closeDelay": 0}, "chicklets": { "items": ["facebook", "twitter", "linkedin", "googleplus", "sharethis"]}};
		var st_hover_widget = new sharethis.widgets.hoverbuttons(options);
		</script>-->
    
  </body>
</html>
