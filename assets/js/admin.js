;(function ($) {
    $(document).ready(function () {
        $("#post-format-select .post-format").on("click", function () {
            if ($(this).attr("id") == "post-format-image") {
                $("#_arfa_image_information").show();
            } else {
                $("#_arfa_image_information").hide();
            }
        });

        if (arfa_pf.format != "image") {
            $("#_arfa_image_information").hide();
        }
    });
})(jQuery);