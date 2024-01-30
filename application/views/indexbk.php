<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
    .ajax-loader {
        /* position: fixed; */
        z-index: 10000 !important;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        opacity: 1;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .ajax-loader .img {
        position: relative;
        width: 50px;
    }
</style>

<body>

    <div class="container">
        <?php
        $url =  base_url() . 'blog/load_more/';
        $filter = '';

        if (isset($_GET['slug'])) {


            $offset = $this->uri->segment(3);
            $filter = $_GET['slug'];

            $url = base_url() . 'blog/load_more/';
        }



        foreach ($tags as $tag) {
        ?>
            <a href="javascript:void(0)" data-url="<?= base_url() . '0?slug=' . $tag['tag'] ?>" class="mx-2 my-5 btn btn-sm btn-primary filter_tag" data-tag=""><?= $tag['tag'] ?></a>
        <?php } ?>
        <div class="row" id="blog-container">

        </div>
        <!-- The loaded blog posts will be displayed here -->
    </div>

    <div id="load-more-container" class="d-flex justify-content-center align-items-center">
        <div class="ajax-loader" style="display: none;">
            <div id="loader-container" class="img">
            </div>
        </div><br>
        <button id="load-more-btn" data-filter="<?= $filter ?>" class="btn btn-primary btn-sm" data-offset="0">Load More</button>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="<?php echo asset_url() . 'js/lottie.min.js'; ?>"></script>
    <script>
        var animData = {
            wrapper: document.getElementById('loader-container'),
            animType: 'svg',
            loop: true,
            prerender: true,
            autoplay: true,
            path: '<?php echo asset_url() . "json/loading.json"; ?>'

        };
        var anim = bodymovin.loadAnimation(animData);
        $(document).ready(function() {
            // Load more posts on button click


            $(".filter_tag").click(function() {
                let url = $(this).data('url');
                window.location.href = url;
            })




            var offset = 0;
            var filter = $('#load-more-btn').data('filter');
            // Initial load
            loadMorePosts(offset, filter);



            $('#load-more-btn').on('click', function() {
                var offset = $(this).data('offset');
                var filter = $(this).data('filter');
                loadMorePosts(offset, filter);
            });




            function loadMorePosts(offset, filter) {

                if (filter != '') {
                    var url = '<?php echo $url; ?>' + offset + '?slug=' + filter;
                } else {
                    var url = '<?php echo $url; ?>' + offset;
                }



                $.ajax({
                    url: url,
                    type: 'GET',
                    beforeSend: function() {
                        $('#load-more-btn').hide();
                        $('.ajax-loader').show();
                    },
                    success: function(response) {
                        // Append the loaded posts to the blog container
                        setTimeout(function() {

                            $('.ajax-loader').hide();
                            $('#blog-container').append(response);
                        }, 600);
                        // Update the offset for the next request
                        // alert(response.trim().length);
                        var newOffset = offset + 3; // Adjust based on your limit
                        if (response.trim().length == 0) {

                            $('#load-more-btn').hide();
                        } else {

                            $('#load-more-btn').data('offset', newOffset);
                            $('#load-more-btn').show();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    </script>

</body>

</html>