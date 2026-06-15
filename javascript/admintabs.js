$(function () {

    var nav_links = $("#admin-tabs .nav-link");
    var tabs = $('.tab-content');
    var starting_tab = 2;

    selectTab(starting_tab);
    nav_links.eq(starting_tab).addClass('active');

    nav_links.click(function () {
        nav_links.removeClass('active');
        $(this).addClass('active');

        var tab_index = nav_links.index($(this));
        selectTab(tab_index);
    });

    function selectTab(tab_index) {
        tabs.children().hide();
        tabs.eq(tab_index).children().show();
    }

    $('.btn-outline-danger').on('click', function () {
        return confirm('Are you sure?');
    });


    

});

