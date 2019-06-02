<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>teste</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="token.css" />
    <script type="text/javascript">
      var api = "https://api.instagram.com/v1/users/self/media/recent/?access_token=";
      var token = window.location.href;
      token = token.split("=")[1];
      var api_token = api + token;
      //document.write(myDate.toGMTString()+"<br>"+myDate.toLocaleString());
      function showImages(item, index){
        let imagem = item.images.standard_resolution.url;
        console.log(item);
        let id = item.id;
        let date = new Date(item.created_time*1000);
        date = date.toLocaleString();
        date = date.split(" ")[0];
        date = '<div class="photo-icon"><span class="icon-text">'+date+'</span>';
        date +=  ' <img src="./icon/date.png"/ class="icon" />';
        date +=  '</div>';

        let likes = item.likes.count;
        likes = '<div class="photo-icon"><span class="icon-text">'+likes+'</span>';
        likes +=  ' <img src="./icon/likes.png"/ class="icon" />';
        likes +=  '</div>';

        let comments = item.comments.count;
        comments = '<div class="photo-icon"><span class="icon-text">'+comments+'</span>';
        comments +=  ' <img src="./icon/comments.png"/ class="icon" />';
        comments +=  '</div>';

        let location = item.location;
        if(location == undefined || location == null){
          location = "unknow";
        } else {
        location = item.location.name;       
        }

        location = '<div class="photo-icon"><span class="icon-text">'+location+'</span>';
        location +=  ' <img src="./icon/location.png"/ class="icon" />';
        location +=  '</div>';

        let userPhotos = "<div class='user-photos' data-id='"+id+"'>";
        userPhotos += "<div class='photo-hover'>";
        userPhotos += "<div class='photo-data'>";
        userPhotos += likes;
        userPhotos += comments;
        userPhotos += date;
        userPhotos += location;
        userPhotos += "</div>";
        userPhotos += "</div>";
        userPhotos += "<img class='photo' src='"+imagem+"' style='width:100%' />";
        userPhotos += "</div>";
        $(".content").append(userPhotos);
        $(".photo-hover:eq("+index+")").width($(".photo:eq("+index+")").width());
        $(".photo-hover:eq("+index+")").height($(".photo:eq("+index+")").height());
        $(".user-photos:eq("+index+")").height($(".photo:eq("+index+")").height());
      }
      $.ajax({
        url: api_token,
        method: "GET",
        success: function(v){
          v.data.forEach(showImages);
          $(".content").height($(".content").height()+150);
          $(".user-photos").on("click", function(){
            let photoId = $(this).attr('data-id');
            $.ajax({
              url: "https://api.instagram.com/v1/media/"+photoId+"/comments?access_token="+token,
              method: "GET",
              success: function(v){
                console.log(v);
              }
            });
          });
        },
        error: function(v){
          console.log(v);
        }
      });
    </script>
  </head>
  <body>
    <div class="header"><h1>Choose a photo</h1></div>

    <div class="content">
      <!-- <div class='user-photos' data-id='1'>
        <div class="photo-hover">
          <div class="photo-data">
            <div class="photo-icon">
              <span class="icon-text">7</span>
              <img src='./icon/likes.png'/ class="icon">
            </div>
            <div class="photo-icon">
              <span class="icon-text">17</span>
              <img src='./icon/comments.png'/ class="icon">
            </div>
            <div class="photo-icon">
              <span class="icon-text">22/01/102</span>
              <img src='./icon/data.png'/ class="icon">
            </div>
            <div class="photo-icon">
              <span class="icon-text">7</span>
              <img src='./icon/location.png'/ class="icon">
            </div>
          </div>
        </div>
        <img class='photo' src='https://instagram.fcaw2-1.fna.fbcdn.net/vp/71d2ae03f77a2e4701431530906fb0b0/5CC0EAFE/t51.2885-15/sh0.08/e35/p750x750/47474116_2205046376482451_6469007777267713697_n.jpg?_nc_ht=instagram.fcaw2-1.fna.fbcdn.net' style='width:100%' />
      </div> -->
    </div>
  </body>
  <script type="text/javascript">
  // $(".photo-hover").width($(".photo").width());
  // $(".photo-hover").height($(".photo").height());
  // $(".user-photos").height($(".photo").height());
  </script>
</html>
