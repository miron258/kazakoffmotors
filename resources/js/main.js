$(document).ready(function () {

    // $.pixlayout({
    //     clip: true,
    //     src: "/img/page_mobile_our_work.png",
    //     opacity: 0.3,
    //     center: true,
    //     fixed: false,
    //     left: 0,
    //     right: 0,
    //     top: 0
    // });

    if (window.innerWidth < 600) {


        window.setMobileTable = function (selector) {

            if (selector !== '') {

                const tableEl = document.querySelector(selector);

                if (tableEl !== null) {
                    const thEls = tableEl.querySelectorAll('thead th');
                    const tdLabels = Array.from(thEls).map(el => el.innerText);

                    tableEl.querySelectorAll('tbody tr').forEach(tr => {
                        Array.from(tr.children).forEach(
                            (td, ndx) => td.setAttribute('label', tdLabels[ndx])
                        );
                    });
                }
            }
        }

        window.setMobileTable('.table-washing');
        window.setMobileTable('.table-repair');
        window.setMobileTable('.table-storage');
    }

    //////////////// DROPDOWN MENU
    const $dropdown = $(".dropdown");
    const $dropdownToggle = $(".dropdown-toggle");
    const $dropdownMenu = $(".dropdown-menu");
    const showClass = "show";



    $(window).on("load resize", function () {
        if (this.matchMedia("(min-width: 768px)").matches) {
            $dropdown.hover(
                function () {
                    const $this = $(this);
                    $this.addClass(showClass);
                    $this.find($dropdownToggle).attr("aria-expanded", "true");
                    $this.find($dropdownMenu).addClass(showClass);
                },
                function () {
                    const $this = $(this);
                    $this.removeClass(showClass);
                    $this.find($dropdownToggle).attr("aria-expanded", "false");
                    $this.find($dropdownMenu).removeClass(showClass);
                }
            );
        } else {
            $dropdown.off("mouseenter mouseleave");
        }
    });
    //////////////// END DROPDOWN MENU





    let elementClick = $('.header .header-leftblock .block-left-menu-navigation .left-menu-nav .item-left-menu-nav .link-item-left-menu-nav, .header .header-rightblock .block-right-menu-navigation .right-menu-nav .item-right-menu-nav .link-item-right-menu-nav');

    elementClick.click(
        function (event) {
            let hash = $(this).attr('href').split('#')[1];
            let destination = $("#" + hash).offset().top;
            $('body,html').animate({scrollTop: destination}, 1000);
            return false;
        });

    $('.bt-menu-catalog').on('click', function () {
        $('.animated-icon').toggleClass('open');
        // $('.text-menu-catalog').toggleClass('open-menu');
    });


    $('.arrow-chevron').on('click', function (e) {
        e.preventDefault();
        var target = $(this).attr('data-block'),
            destination = $(target).offset().top;

        $('body,html').animate({scrollTop: destination}, 1000);
    });



});
