//Wizard Init

$("#wizard").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "none",
    stepsOrientation: "vertical",
    titleTemplate: '<span class="number">#index#</span>',

});

$('.actions a[href="#finish"]').on('click', function(event) {

    event.preventDefault();

    var newhref = $('a.btn.wcmamtx_exit_setup.btn-danger').attr('href');

    window.location.href = newhref;

    return false;

});

//Form control