
<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta name="viewport" content="width=device-width" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Flickr Gallery</title>
    <link rel="stylesheet" href="style.css" />
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
</head>

<body>
<div id="all">
    <a href="javascript:void(0)" class="btn_more_images"><i class="fas fa-plus-circle"></i></a>
</div>

<script>
    $(function(){
        var pagina = 0;
        var imageList = [];

        function scroolToBotton(){
            var top = $('.item').last().offset().top;
            $('#all').animate({
                scrollTop: top
            }, 500);
        }

        function getImages(){
            $.ajax({
                url: 'config.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    pagina: pagina
                },
                async: true,
                beforeSend: function(){
                    console.log('carregando');
                }
            })
                .done(function(data){
                    if(data.length != 0 ){
                        imageList = data;
                        pagina++;
                    }else{
                        imageList = [];
                        $('.btn_more_images').hide();
                    }
                })
                .fail(function (e) {
                    console.log(e.responseText);
                })
                .always(function(){
                    $.each(imageList, function(i, photo_row){
                        var row = '<div class="row" >\n';
                        $.each(photo_row, function(j, photo){
                            row += '<div class="item" >\n'+
                                '<a href="'+photo.link+'" style="background-image: url('+ photo.media.m +')" target="_blank">\n' +
                                '<p>'+photo.title+' by '+photo.author+'</p>\n' +
                                '<div>&nbsp;</div>\n' +
                                '</a>\n' +
                                '</div>\n';
                        });
                        row += '</div>';
                        $('#all').append(row);
                    });
                    scroolToBotton();
                });
        }

        $('.btn_more_images').on('click', function(){
            getImages();
            return false;
        });

        getImages();

    });


</script>
</body>
</html>