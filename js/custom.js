//menu_toggle
$(document).ready(function () {
    $("#nav ul.sub").hide();
    $("#nav ul.menu li").click(function () {
        $("ul", this).slideToggle("fast");
    });
});

//scroll_trigger
window.counter = function () {
    // this refers to the html element with the data-scroll-showCallback tag
    var span = this.querySelector('span');
    var current = parseInt(span.textContent);

    span.textContent = current + 1;
};

document.addEventListener('DOMContentLoaded', function () {
    var trigger = new ScrollTrigger({
        addHeight: true
    });
});