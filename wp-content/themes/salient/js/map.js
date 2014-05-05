Object.keys = Object.keys || function(o) { 
    var result = []; 
    for(var name in o) { 
        if (o.hasOwnProperty(name)) 
          result.push(name); 
    } 
    return result; 
};

jQuery(document).ready(function($){
	
	//map margin if page header
	if( $('#page-header-bg:not("[data-parallax=1]")').length > 0 ) { $('#contact-map').css('margin-top', 0);  $('.container-wrap').css('padding-top', 0);} 
	if( $('#page-header-bg[data-parallax=1]').length > 0 ) $('#contact-map').css('margin-top', '-30px');
	
    var zoomLevel = parseFloat($('.nectar-google-map').attr('data-zoom-level'));
    var centerlat = parseFloat($('.nectar-google-map').attr('data-center-lat'));
	var centerlng = parseFloat($('.nectar-google-map').attr('data-center-lng'));
	var markerImg = $('.nectar-google-map').attr('data-marker-img');
	var enableZoom = $('.nectar-google-map').attr('data-enable-zoom');
	var greyscale = $('.nectar-google-map').attr('data-greyscale');
	var extraColor = $('.nectar-google-map').attr('data-extra-color');
	var enableAnimation = $('.nectar-google-map').attr('data-enable-animation');
	var animationDelay = 0; 
	
	if( isNaN(zoomLevel) ) { zoomLevel = 12;}
	if( isNaN(centerlat) ) { centerlat = 51.47;}
	if( isNaN(centerlng) ) { centerlng = -0.268199;}
	if( typeof enableAnimation != 'undefined' && enableAnimation == 1 && $(window).width() > 690) { animationDelay = 180; enableAnimation = google.maps.Animation.BOUNCE } else { enableAnimation = null; }

    var latLng = new google.maps.LatLng(centerlat,centerlng);
    
    //color
    if(greyscale == '1' && extraColor.length > 0) {
	    styles = [
	    
	    {
			featureType: "poi",
			elementType: "labels",
			stylers: [{
				visibility: "off"
			}]
		}, 
		{ 
			featureType: "road.local", 
			elementType: "labels.icon", 
			stylers: [{ 
				"visibility": "off" 
			}] 
		},
		{ 
			featureType: "road.arterial", 
			elementType: "labels.icon", 
			stylers: [{ 
				"visibility": "off" 
			}] 
		},
		{
			featureType: "road",
			elementType: "geometry.stroke",
			stylers: [{
				visibility: "off"
			}]
		}, 
		{ 
			featureType: "transit", 
			elementType: "geometry.fill", 
			stylers: [
				{ hue: extraColor },
				{ visibility: "on" }, 
				{ lightness: 1 }, 
				{ saturation: 7 }
			]
		},
		{
			elementType: "labels",
			stylers: [{
			saturation: -100
			}]
		}, 
		{
			featureType: "poi",
			elementType: "geometry.fill",
			stylers: [
				{ hue: extraColor },
				{ visibility: "on" }, 
				{ lightness: 20 }, 
				{ saturation: 7 }
			]
		},
		{
			featureType: "landscape",
			stylers: [
				{ hue: extraColor },
				{ visibility: "on" }, 
				{ lightness: 20 }, 
				{ saturation: 20 }
			]
			
		}, 
		{
			featureType: "road",
			elementType: "geometry.fill",
			stylers: [
				{ hue: extraColor },
				{ visibility: "on" }, 
				{ lightness: 1 }, 
				{ saturation: 7 }
			]
		}, 
		{
			featureType: "water",
			elementType: "geometry",
			stylers: [
				{ hue: extraColor },
				{ visibility: "on" }, 
				{ lightness: 1 }, 
				{ saturation: 7 }
			]
		}];
		
	} 
	
	
	
	else if(greyscale == '1'){
		
		styles = [
	    
	    {
			featureType: "poi",
			elementType: "labels",
			stylers: [{
				visibility: "off"
			}]
		}, 
		{ 
			featureType: "road.local", 
			elementType: "labels.icon", 
			stylers: [{ 
				"visibility": "off" 
			}] 
		},
		{ 
			featureType: "road.arterial", 
			elementType: "labels.icon", 
			stylers: [{ 
				"visibility": "off" 
			}] 
		},
		{
			featureType: "road",
			elementType: "geometry.stroke",
			stylers: [{
				visibility: "off"
			}]
		}, 
		{
			elementType: "geometry",
			stylers: [{
				saturation: -100
			}]
		},
		{
			elementType: "labels",
			stylers: [{
			saturation: -100
			}]
		}, 
		{
			featureType: "poi",
			elementType: "geometry.fill",
			stylers: [{
				color: "#ffffff"
			}]
		},
		{
			featureType: "landscape",
			stylers: [{
				color: "#ffffff"
			}]
		}, 
		{
			featureType: "road",
			elementType: "geometry.fill",
			stylers: [ {
				color: "#eaeaea"
			}]
		}, 
		{
			featureType: "water",
			elementType: "geometry",
			stylers: [{
				color: "#b9e7f4"
			}]
		}];
			
		
	}
	
	
	else {
		 styles = [];
	} 
	
	var styledMap = new google.maps.StyledMapType(styles,
    {name: "Styled Map"});


    //options
	var mapOptions = {
      center: latLng,
      zoom: zoomLevel,
      mapTypeControlOptions: {
        mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
   	  },
      scrollwheel: false,
      panControl: false,
	  zoomControl: enableZoom,	  
	  zoomControlOptions: {
        style: google.maps.ZoomControlStyle.LARGE,
        position: google.maps.ControlPosition.LEFT_CENTER
   	  },
	  mapTypeControl: false,
	  scaleControl: false,
	  streetViewControl: false
	  
    };
	
	var map = new google.maps.Map(document.getElementById($('.nectar-google-map').attr('id')), mapOptions);
	
	//Associate the styled map with the MapTypeId and set it to display.
    map.mapTypes.set('map_style', styledMap);
    map.setMapTypeId('map_style');

	
	
	var infoWindows = [];
	
	google.maps.event.addListenerOnce(map, 'tilesloaded', function() {
		
		//don't start the animation until the marker image is loaded if there is one
		if(markerImg.length > 0) {
			var markerImgLoad = new Image();
			markerImgLoad.src = markerImg;
			
			$(markerImgLoad).load(function(){
				 setMarkers(map);
			});
		}
		else {
			setMarkers(map);
		}
    });
    
    
    function setMarkers(map) {
		for (var i = 1; i <= Object.keys(map_data).length; i++) {  
			
			(function(i) {
				setTimeout(function() {
				
			      var marker = new google.maps.Marker({
			      	position: new google.maps.LatLng(map_data[i].lat, map_data[i].lng),
			        map: map,
					infoWindowIndex : i - 1,
					animation: enableAnimation,
					icon: markerImg,
					optimized: false
			      });
				  
				  setTimeout(function(){marker.setAnimation(null);},200);
				  
			      //infowindows 
			      var infowindow = new google.maps.InfoWindow({
			   	    content: map_data[i].mapinfo,
			    	maxWidth: 300
				  });
				  
				  infoWindows.push(infowindow);
			      
			      google.maps.event.addListener(marker, 'click', (function(marker, i) {
			        return function() {
			        	infoWindows[this.infoWindowIndex].open(map, this);
			        }
			        
			      })(marker, i));
		     	
		         }, i * animationDelay);
		         
		         
		     }(i));
		     

		 }//end for loop
	}//setMarker
	
});
