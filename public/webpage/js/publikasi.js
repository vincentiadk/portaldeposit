$(document).ready(function() {
	publicationsList()
});

function publicationsList(){
    $.ajax({
        type : "GET",       
        url : config.apiurl + "/publication/getByPage",
        dataType : "json"
    }).done(function(response) {
        var html = ''
        for (var i = 0; i < response.length; i++) {
            if(i  % 3 == 0)
            {

            }

            html += '<div class="row row-60">'    
            html += '<div class="col-md-6 col-xl-4">'
            html += '<article class="post-slider post-minimal">'
            html += '<div class="owl-carousel carousel-post-gallery carousel-slider-blog-post" data-autoplay="true" data-items="1" data-stage-padding="0" data-loop="false" data-margin="10px" data-mouse-drag="false" data-nav="true" data-dots="true" data-lightgallery="group">'
            html += '<div class="item"><a class="img-thumbnail-variant-1" href="'+config.baseurl+'webpage/images/project-category-1-original-1200x800.jpg" data-lightgallery="item">'
            html += '<figure><img src="'+config.baseurl+'webpage/images/project-category-1-original-1200x800.jpg" alt="" width="1200" height="800"/>'
            html += '</figure>'
            html += '<div class="caption"><span class="icon icon-lg linear-icon-magnifier"></span></div></a>'
            html += '</div>'
            html += '<div class="item"><a class="img-thumbnail-variant-1" href="'+config.baseurl+'webpage/images/project-category-1-original-1200x800.jpg" data-lightgallery="item">'
            html += '<figure><img src="'+config.baseurl+'webpage/images/project-category-1-original-1200x800.jpg" alt="" width="1200" height="800"/>'
            html += '</figure>'
            html += '<div class="caption"><span class="icon icon-lg linear-icon-magnifier"></span></div></a>'
            html += '</div>'
            html += '<div class="item"><a class="img-thumbnail-variant-1" href="'+config.baseurl+'webpage/images/project-category-1-original-1200x800.jpg" data-lightgallery="item">'
            html += '<figure><img src="'+config.baseurl+'webpage/images/project-category-1-original-1200x800.jpg" alt="" width="1200" height="800"/>'
            html += '</figure>'
            html += '<div class="caption"><span class="icon icon-lg linear-icon-magnifier"></span></div></a>'
            html += '</div>'
            html += '</div>'
            html += '<div class="post-classic-title">'
            html += '<h6><a href="gallery-post.html">'+response[i].title+'</a></h6>' 
            html += '</div>'
            html += '<div class="post-meta">'
            html += '<div class="group"><a href="gallery-post.html">'
            html += '<time datetime="2017">'+response[i].created_at+'</time></a><a class="meta-author" href="standard-post.html">Hamdan</a>'
            html += '</div>'
            html += '</div>' 
            html += '<div class="post-classic-body">'
            html += '<p>'+response[i].description.replace(/<(?:.|\n)*?>/gm, '').substr(0,100)+'</p>'
            html += '</div>'   
            html += '</article>'
            html += '</div>'
            
            html += '</div>'

        }

        $('#listPublications').html(html)
    }).error(function(data) {
    	alert(3)
    });
}


$(document).ready(function() {
	searchList()
});

function searchList(){
    // $.ajax({
    //     type : "GET",       
    //     url : config.apiurl + "/publication/getByPage?search=",
    //     dataType : "json"
    // }).done(function(response) {
        
    // })

    $('#rd-search-form-input').keyup(function(){
        alert(this.value);
    })
    
}