$(document).ready(() => {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    if(urlParams.has('count')){
        $("#subMenu").css("display", "block");
        $("#productAboutToRun").addClass("active current-page");
    }

    $("#catalogMenu").click(() => {
        // $(this).hasClass("active") ? $(this).removeClass("active") : $(this).addClass("active");
        if ($("#catalogMenu").hasClass("active")) {
            console.log("has class");
        }
    });
    $("#productAboutToRun").click(() => {
        // console.log("productAboutToRun");
        if ($("#catalogMenu").hasClass("active")) {
            console.log("has class when clicked productAboutToRun");
            $("#subMenu").css("display", "block");
        }
        if (!$("#catalogMenu").hasClass("active")) {
            console.log("not has class when clicked productAboutToRun");
            $("#subMenu").css("display", "none");
        }
    });

    //configure tooltip
    $(() => {
        $('[data-toggle="tooltip"]').tooltip();
    });
});
