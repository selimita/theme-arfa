;(function($){
    $(document).ready(function(){
        // Feather Popup
        $(".popup").each(function(){
            var image = $(this).find("img").attr("src");
            $(this).attr("href",image);
        });

        // Tiny Slider [Slider]
        var slider = tns({
            container: '.slider', // Div [ id OR class ]
            speed: 300,
            items: 1, // 3
            slideBy: 'page',
            autoplay: true,
            autoplayTimeout: 3000,
            autoHeight: true,
            controls: false,
            nav:false,
            autoplayButtonOutput:false
        });
    });
})(jQuery);