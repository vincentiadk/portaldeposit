$(document).ready(function() {
	//newsList()
});

function newsList(){
	//alert(1)
    $.ajax({
        type : "GET",       
        url : config.apiurl + "/news/getByPage",
        dataType : "json",
        async: false
    }).done(function(response) {
    	$('#listNews').html('')
    	var html = ''
    	for (var i = 0; i < response.length; i++) {
    		html += '<div class="col-md-6 col-xl-9">'
    			html += '<article class="post-slider post-minimal">'
		    		html += '<div class="owl-carousel carousel-post-gallery carousel-slider-blog-post" data-autoplay="true" data-items="1" data-stage-padding="0" data-loop="false" data-margin="10px" data-mouse-drag="false" data-nav="true" data-dots="true" data-lightgallery="group">' 
		    			html += '<div class="item"><a class="img-thumbnail-variant-1" href="'+config.baseurl+'/webpage/images/project-category-1-original-1200x800.jpg" data-lightgallery="item">'
		    				html += '<figure><img id="tes" alt="" width="1200" height="800"/>'
		            		html += '</figure>'
		            		html += '<div class="caption"><span class="icon icon-lg linear-icon-magnifier"></span></div></a>'                                    
		           		html += '</div>'
		            	html += '<div class="item"><a class="img-thumbnail-variant-1" href="'+config.baseurl+'/webpage/images/project-category-1-original-1200x800.jpg" data-lightgallery="item">'
		            		html += '<figure><img src="'+config.baseurl+'/webpage/images/project-category-1-original-1200x800.jpg" alt="" width="1200" height="800"/>'
		            		html += '</figure>'
		           			html += '<div class="caption"><span class="icon icon-lg linear-icon-magnifier"></span></div></a>'
		            	html += '</div>'
		            	html += '<div class="item"><a class="img-thumbnail-variant-1" href="'+config.baseurl+'/webpage/images/project-category-1-original-1200x800.jpg" data-lightgallery="item">'
		            		html += '<figure><img src="'+config.baseurl+'/webpage/images/project-category-1-original-1200x800.jpg" alt="" width="1200" height="800"/>'
		            		html += '</figure>' 
		            		html += '<div class="caption"><span class="icon icon-lg linear-icon-magnifier"></span></div></a>'
		            	html += '</div>'
		    		html += '</div>'

		    		html += '<div class="post-classic-title">'
		            	html += '<h6><a href="gallery-post.html">'+response[i].title+'</a></h6>'                                
		           	 html += '</div>'
		            html += '<div class="post-classic-body">'
		            	html += '<p>'+response[i].description.replace(/<\/?[^>]+(>|$)/g, "").substr(0, 300)+' ... <a href = "#">Baca Selengkapnya</a></p>'
		            html += '</div>'           
		            html += '<div class="post-meta">'
		            	html += '<div class="group"><a href="#">'
		            		html += '<time datetime="2017">'+response[i].datetime+'</time></a><a class="meta-author" href="#">by Brian Williamson</a><a href="standard-post.html">'+response[i].is_comment +' comment(s)</a>'
		            	html += '</div>'
		            html += '</div>'                      

    			html += '</article>'
    		html += '</div><br><br>'
    		$('#listNews').append(html)
    		var html = ''
    	}

    	

    	

    }).error(function(data) {
    	alert(3)
    });
}