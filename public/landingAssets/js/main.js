// const previewImg = document.querySelector(".preview");

// previewImg.onclick = (e) => {
//   const image = e.target;
//   const video = image.nextElementSibling;

//   image.classList.add("videoPlay");
//   video.play();
// };

$(".preview").click(function(e) {
    $(this).addClass("videoPlay");
    e.target.nextElementSibling.play();
});

$(document).ready(function() {
    $("#nav-men").click(function() {
        $("#s-nav").addClass("nav-go");
        $("#sa").show();
    });

    $("#overlay , header .men-cl").click(function() {
        $("#s-nav").removeClass("nav-go");
    });

    $(".men-cl").on("click", function() {
        $("#s-nav").removeClass("nav-go");
        $(".nav-go").hide();
        $(".men-cl").hide();
    });

    var scrollButton = $("#scroll-top");
    $(window).scroll(function() {
        if ($(this).scrollTop() >= 200) {
            scrollButton.show();
        } else {
            scrollButton.hide();
        }
    });
    scrollButton.click(function() {
        $("html,body").animate({
                scrollTop: 0
            },
            600
        );
    });
});
