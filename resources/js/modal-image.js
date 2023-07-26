$(function () {
    $("img").attr("loading", "lazy");
    // Image Preview Modal
    $("img").click(function (e) {
        e.preventDefault();
        $("#modal").removeClass("hidden");
        $("#modal-image").attr("src", $(this).attr("src"));
        $("#modal-caption").text($(this).attr("alt"));

        $("#modal").click(function () {
            $(this).addClass("hidden");
        });
    });

    // disable right click in iframe
    // $("iframe")
    //     .contents()
    //     .find("body")
    //     .on("contextmenu", function (e) {
    //         e.preventDefault();
    //     });

    // disable right click on website
    $(document).on("contextmenu", function (e) {
        e.preventDefault();
    });
});
