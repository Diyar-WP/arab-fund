jQuery(document).ready(function ($) {
    var imgURL = "/arabfund/wp-content/uploads/2024/09/Language.svg";
    var $img = $("<img />");
    $img.attr("src", imgURL);
    $(".lang-item a").prepend($img);

    $('.elementor-swiper-button').prepend('<img src="/wp-content/themes/hello-elementor-child/assets/images/more_arrow.svg" alt="arrow">')
});



function maxParaHeight() {
    jQuery.fn.extend({
        maxParaHeight: function () {
            var maxHeight = 0;
            jQuery(this).each(function () {
                if (jQuery(this).height() > maxHeight) {
                    maxHeight = jQuery(this).height();
                }
            });
            jQuery(this).height(maxHeight);
        }
    });
    jQuery(".publication-section .publication-grid-wrapper .publication-inner .content-block p").maxParaHeight();
}
function third_level_submenu() {
    jQuery('.site-header li.mega-menu-item.mega-menu-megamenu ul.mega-sub-menu ul.mega-sub-menu ul.menu>li.menu-item-has-children').each(function () {
        jQuery(this).append('<span class="children-item-arrow"></span>')
    });
}
function get_album_data(publish_date, page) {
    jQuery('.site-loader').show();
    jQuery.ajax({
        type: "post",
        dataType: "json",
        url: ajaxObject.ajaxurl,
        data: {
            action: "get_album_data",
            page: page,
            publish_date: publish_date,
        },
        success: function (response) {
            console.log(response);
            jQuery('.album_section').html(response.content);
            jQuery('.site-loader').hide();
        }
    });
}
function get_video_data(publish_date, page) {
    jQuery('.site-loader').show();
    jQuery.ajax({
        type: "post",
        dataType: "json",
        url: ajaxObject.ajaxurl,
        data: {
            action: "get_video_data",
            page: page,
            publish_date: publish_date,
        },
        success: function (response) {
            console.log(response);
            jQuery('.video-section').html(response.content);
            jQuery('.site-loader').hide();
        }
    });
}

function reloadpage() {
    window.location.href = window.location.href;
}
function innerpageNavResponsive() {
    if (jQuery('.inner-page-navigation').length) {
        jQuery('.inner-page-navigation').each(function () {
            var wrapperWidth = jQuery(".inner-page-navigation .elementor-widget-heading").width();
            var tabLinkWidth = 30;
            jQuery(this).find('.elementor-nav-menu>li').each(function () {
                tabLinkWidth += jQuery(this).outerWidth(true);
            });
            if (wrapperWidth < tabLinkWidth) {
                jQuery(this).addClass('mobile-view');
            } else {
                jQuery(this).removeClass('mobile-view');
            }
        });
    }
}
function equalHeight() {
    jQuery.fn.extend({
        equalHeight: function () {
            var top = 0;
            var row = [];
            var classname = ('equalHeight' + Math.random()).replace('.', '');
            jQuery(this).each(function () {
                var thistop = jQuery(this).offset().top;
                if (thistop > top) {
                    jQuery('.' + classname).removeClass(classname);
                    top = thistop;
                }
                jQuery(this).addClass(classname);
                jQuery(this).height('auto');
                var h = (Math.max.apply(null, jQuery('.' + classname).map(function () {
                    return jQuery(this).outerHeight();
                }).get()));
                jQuery('.' + classname).height(h);
            }).removeClass(classname);
        }
    });

    jQuery('.contact-grid-wrapper .contact_box .res_head .loc-info').equalHeight();
    jQuery('.contact-grid-wrapper .contact-card-title').equalHeight();
    jQuery('.publication-section.tender-resource-wrapper .publication-grid-wrapper .publication-inner .content-block h3').equalHeight();
    jQuery('.leader-team .team-wrap a .team_head p').equalHeight();
    jQuery('.highlights-block-wrapper .highlights-block-grid .grid-item-wrapper .grid-content-wrapper h3').equalHeight();
    jQuery('.team_container .team_box .team_box_wrap .team_inner h3 ').equalHeight();
    setTimeout(function () {
        jQuery('.team_container .team_box .team_box_wrap .team_inner h4 ').equalHeight();
    }, 300);

}
var flag = true;
function tab_to_accordian() {
    if (jQuery(window).width() < 768) {
        if (flag) {
            jQuery(".tab-heading-block li .tab-link").each(function () {
                var cur_link = jQuery(this).attr("data-tab");
                jQuery(".tab-content-inner[data-id='" + cur_link + "']").detach().appendTo(jQuery(this).closest("li"));
            });
            jQuery('.tab-heading-block li.active .tab-content-inner').slideDown();
            jQuery('.tab-heading-block li.active').siblings().find(".tab-content-inner").slideUp();
            jQuery('.tab-content-block').remove();
            flag = false;
        }
    }
    else {
        if (!flag) {
            var _this = jQuery(".tab-heading-block li.active .tab-link").attr("data-tab");

            jQuery(".tabbing-outer-wrapper").append("<div class='tab-content-block'></div>");
            jQuery(".tab-heading-block li").each(function () {
                jQuery(".tab-content-inner").detach().appendTo(".tab-content-block");
            });
            setTimeout(function () {
                if (_this == undefined) {
                    jQuery(".tab-content-inner:first-child").fadeIn();
                    jQuery('.tab-heading-block li:first-child').addClass('active');
                }
                else {
                    jQuery(".tab-content-inner[data-id='" + _this + "']").siblings().fadeOut(0);
                    jQuery(".tab-content-inner[data-id='" + _this + "']").fadeIn();
                }

            }, 100);
            flag = true;
        }
    }
}

function home_navigation() {
    if (jQuery('#home-banner .scroll-to-div-wrap ul').length) {
        var nav_top = jQuery('#home-banner .scroll-to-div-wrap ul').offset().top + jQuery('#home-banner .scroll-to-div-wrap ul').innerHeight();
        var footer_top = jQuery('.elementor-location-footer').offset().top;
        if (nav_top > footer_top) {
            jQuery("#home-banner .scroll-to-div-wrap").fadeOut();
        }
        else {
            jQuery("#home-banner .scroll-to-div-wrap").fadeIn();
        }
    }
}

jQuery(document).ready(function () {
    setTimeout(function () {
        equalHeight();
        tab_to_accordian();
        maxParaHeight();
        home_navigation();
    }, 300)
    if (jQuery('.select2-dropdown-wrapper .select2-dropdown').length) {
        jQuery('.select2-dropdown-wrapper .select2-dropdown').select2({
            minimumResultsForSearch: -1,
            selectOnClose: true,
            placeholder: 'sortby',
        });
    }
    jQuery('.hamburger-menu').click(function () {
        jQuery('html,body').toggleClass('mobile-menu-open');
        jQuery('.site-header .top-header-menu ul li').removeClass('open');
        jQuery('.site-header li.mega-menu-item.mega-menu-megamenu ul.mega-sub-menu ul.mega-sub-menu ul.menu>li.menu-item-has-children').removeClass('submenu-open');
        jQuery('.site-header li.mega-menu-item.mega-menu-megamenu ul.mega-sub-menu ul.mega-sub-menu ul.menu>li.menu-item-has-children ul').slideUp();
    });
    jQuery("body").delegate(".site-header .top-header-menu ul li a.has-submenu .sub-arrow", "click", function (e) {
        if (jQuery(window).width() <= 1199) {
            e.stopImmediatePropagation();
            e.preventDefault();
            jQuery(this).closest('.menu-item').toggleClass('open');
        }
    });

    jQuery('.scroll-to-div-wrap ul li').click(function () {
        jQuery(this).addClass('active');
        jQuery(this).siblings().removeClass('active');
        var _this_id = jQuery(this).attr('data-id');
        jQuery('html, body').stop().animate({
            'scrollTop': jQuery("section[id='" + _this_id + "']").offset().top
        }, 1200);
    });
    jQuery('.popup-link').click(function (e) {
        e.preventDefault();
        var _this_id = jQuery(this).attr('data-popup');
        jQuery('body').addClass('overflow-hidden')
        jQuery('.custom-popup[data-modal="' + _this_id + '"]').addClass('popup-open');
    });

    jQuery('.custom-popup .popup-dialog-wrapper,.custom-popup .close-popup').click(function () {
        jQuery('body,html').removeClass('overflow-hidden');
        jQuery('.custom-popup').removeClass('popup-open');
    });

    jQuery('.custom-popup .popup-dialog .popup-content').click(function (e) {
        e.stopPropagation();
    });

    jQuery('.bdt-search .bdt-search-icon').click(function () {
        jQuery('form.bdt-search').submit();
    });


    jQuery('.bdt-search .bdt-search-icon').click(function () {
        jQuery('form.bdt-search').submit();
    });

    /* Custom jquery code to reset date picker field on change of dropdowns */
    jQuery('#taxonomy_dropdown').on('change', function () {
        if (jQuery(this).val() !== '') {
            jQuery('#from').val('').datepicker("option", "minDate", null);
            jQuery('#to').val('').datepicker("option", "minDate", null);
        }
    });

    var dateFormat = "dd/mm/yy";
    function getDate(element) {
        var date;
        try {
            date = jQuery.datepicker.parseDate(dateFormat, element.value);
        } catch (error) {
            date = null;
        }
        return date;
    }
    jQuery('#from').datepicker({
        dateFormat: dateFormat,
    })
        .on("change", function () {
            jQuery('#taxonomy_dropdown').val('').trigger('change');
            jQuery('#to').datepicker("option", "minDate", getDate(this));
        }),
        jQuery('#to').datepicker({
            dateFormat: dateFormat,
        })
            .on("change", function () {
                jQuery('#from').datepicker("option", "maxDate", getDate(this));
                jQuery('#taxonomy_dropdown').val('').trigger('change');
            });

    jQuery('.from-date-icon').click(function () {
        jQuery("#from").focus();
    });
    jQuery('.to-date-icon').click(function () {
        jQuery("#to").focus();
    });
    jQuery('#publication_cat').multiselect({
        placeholder: 'Publication Category',
        selectedOptions: false,
    });
    ///////////////////////////////////////////////
    ///////////////////////////////////////////////////////
    if (jQuery('.inner-page-navigation').length) {
        jQuery('.inner-page-navigation .elementor-widget-heading .elementor-widget-container').append('<div class="three-dot-menu-link"></div>');
        if (jQuery('.inner-page-navigation ul li.menu-item-has-children').length) {
            jQuery('.inner-page-navigation ul li.menu-item-has-children').append('<div class="three-dot-sub-menu-link"></div>')
        }
    }
    jQuery("body").delegate(".inner-page-navigation .elementor-widget-heading .three-dot-menu-link", "click", function (e) {
        jQuery(this).closest('.inner-page-navigation').toggleClass('nav-open');
    });
    jQuery("body").delegate(".inner-page-navigation ul li.menu-item-has-children .three-dot-sub-menu-link", "click", function (e) {
        jQuery(this).closest('.menu-item-has-children ').toggleClass('nav-submenu-open');
    });
    // tabbing
    jQuery(".tab-heading-block li .tab-link").click(function (e) {
        e.preventDefault();
        if (jQuery(window).width() < 768) {
            var _this_id = jQuery(this).attr("data-tab");
            var _this = jQuery(this);
            jQuery(".tab-content-inner[data-id='" + _this_id + "']").stop(true, true).slideToggle();
            jQuery(".tab-content-inner[data-id='" + _this_id + "']").closest("li").siblings().find(".tab-content-inner").stop(true, true).slideUp();
            jQuery(this).closest("li").siblings().removeClass("active");
            jQuery(this).closest("li").toggleClass("active");
            setTimeout(function () {
                jQuery('html,body').animate({
                    scrollTop: _this.closest('li').offset().top
                }, 1000);
            }, 500);
        }
        else {
            var _this_id = jQuery(this).attr("data-tab");
            jQuery(".tab-content-inner[data-id='" + _this_id + "']").siblings().fadeOut(0);
            jQuery(".tab-content-inner[data-id='" + _this_id + "']").fadeIn(300);
            jQuery(this).closest("li").addClass("active");
            jQuery(this).closest("li").siblings().removeClass("active");
        }
    });
    jQuery(".accordian-outer .accordian-title").click(function () {
        jQuery(this).closest(".accordian-outer").find(".accordian-content").stop(true, true).slideToggle();
        jQuery(this).closest(".accordian-outer").siblings().find(".accordian-content").stop(true, true).slideUp();
        jQuery(this).closest(".accordian-outer").toggleClass("active");
        jQuery(this).closest(".accordian-outer").siblings().removeClass("active");
    });
    jQuery(".filter-conferences").click(function () {
        let from_date = jQuery("#from").val();
        let to_date = jQuery("#to").val();
        let taxonomy_dropdown = jQuery("#taxonomy_dropdown").val();
        jQuery.ajax({
            type: "POST",
            url: ArabFundsPublic.ajaxurl,
            data: {
                action: "conference_events_filters",
                from_date: from_date,
                to_date: to_date,
                taxonomy_id: taxonomy_dropdown,

            },
            success: function (response) {
                console.log(response)
                if (response.html != "") {
                    console.log("in if")

                    jQuery(".conferences_container").html(response.html);
                }
            }
        });
    });
    jQuery(".refresh-events").click(function (e) {
        jQuery('#from').val('').datepicker("option", "minDate", null);
        jQuery('#to').val('').datepicker("option", "minDate", null);
        jQuery('#taxonomy_dropdown').val('').trigger('change');
        jQuery.ajax({
            type: "POST",
            url: ArabFundsPublic.ajaxurl,
            data: {
                action: "conference_events_filters",
                from_date: '',
                to_date: '',
                taxonomy_id: '',
            },
            success: function (response) {
                console.log(response)
                if (response.html != "") {
                    jQuery(".conferences_container").html(response.html);
                }
            }
        });
    });
    jQuery('.search_top a.elementor-item').magnificPopup({
        type: 'inline',
        midClick: true, // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
        mainClass: 'mfp-fullscreen' // Adds a class to the root element that allows us to style child element for fullscreen
    });
});


function fixed_header() {
    if (jQuery(window).scrollTop() > 0) {
        jQuery('.site-header').addClass('fixed');
    }
    else {
        jQuery('.site-header').removeClass('fixed');
    }
}

jQuery(document).ready(function () {
    var items = jQuery(".video-section .video-block");

    var numItems = items.length;
    var perPage = 6;

    items.slice(perPage).hide();

    jQuery('.video-pagination-container').pagination({
        items: numItems,
        itemsOnPage: perPage,
        prevText: "&laquo;",
        nextText: "&raquo;",
        onPageClick: function (pageNumber) {
            var showFrom = perPage * (pageNumber - 1);
            var showTo = showFrom + perPage;
            items.hide().slice(showFrom, showTo).show();
            var reportsWrapElement = document.querySelector('.reports-wrap');
            if (reportsWrapElement) {
                reportsWrapElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        },
        onInit: function () {
            if (numItems <= perPage) {
                jQuery(".video-pagination-container").hide(); // Hide pagination container if there's only one page
            }
        },
    });
});


jQuery(document).ready(function () {
    var items = jQuery(".jae_report_container .jae_report_box, .meeting-container .meeting-box, .events_container .event_box");
    var numItems = items.length;
    var perPage = 12;

    items.slice(perPage).hide();

    jQuery('.pagination-container').pagination({
        items: numItems,
        itemsOnPage: perPage,
        prevText: "&laquo;",
        nextText: "&raquo;",
        onPageClick: function (pageNumber, event) {
            // Prevent default behavior   
            var showFrom = perPage * (pageNumber - 1);
            var showTo = showFrom + perPage;
            items.hide().slice(showFrom, showTo).show();

            var reportsWrapElement = document.querySelector('.reports-wrap');
            if (reportsWrapElement) {
                reportsWrapElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }

        },
        onInit: function () {
            if (numItems <= perPage) {
                jQuery(".pagination-container").hide(); // Hide pagination container if there's only one page
            }
        },
    });
});

jQuery(document).ready(function () {
    var items = jQuery(".report_container .report_box");
    var numItems = items.length;
    var perPage = 15;


    items.slice(perPage).hide();

    jQuery('.annual-pagination-container').pagination({
        items: numItems,
        itemsOnPage: perPage,
        prevText: "&laquo;",
        nextText: "&raquo;",
        onPageClick: function (pageNumber, event) {
            // Prevent default behavior   
            var showFrom = perPage * (pageNumber - 1);
            var showTo = showFrom + perPage;
            items.hide().slice(showFrom, showTo).show();
            console.log(showFrom);
            console.log(showTo);
            var reportsWrapElement = document.querySelector('.reports-wrap');
            if (reportsWrapElement) {
                reportsWrapElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }

        },
        onInit: function () {
            if (numItems <= perPage) {
                jQuery(".annual-pagination-container").hide(); // Hide pagination container if there's only one page
            }
        },
    });
});


jQuery(window).load(function () {
    setTimeout(function () {
        third_level_submenu();
        innerpageNavResponsive();
    }, 500);
    setTimeout(function () {
        jQuery('.pre-issue-sec .publication-inner-wrapper .heading-form-strip').css({
            opacity: 1,
            height: 'auto'
        });
    }, 100);
    AOS.init();
});
jQuery(window).resize(function () {
    setTimeout(function () {
        innerpageNavResponsive();
        equalHeight();
        tab_to_accordian();
        maxParaHeight();
        fixed_header();
    }, 500)
});
jQuery(window).scroll(function () {
    home_navigation();
    fixed_header();
})


jQuery(document).ready(function ($) {
    insert = function insert(main_string, ins_string, pos) {
        if (typeof (pos) == "undefined") {
            pos = 0;
        }
        if (typeof (ins_string) == "undefined") {
            ins_string = '';
        }
        return main_string.slice(0, pos) + ins_string + main_string.slice(pos);
    }

});

jQuery(document).ready(function ($) {
    $('ul.tabs li').click(function () {
        var tab_id = $(this).attr('data-tab');

        $('ul.tabs li').removeClass('current');
        $('.tab-content').removeClass('current');

        $(this).addClass('current');
        $("#" + tab_id).addClass('current');
    })
});

jQuery(document).ready(function ($) {
    // Select all elements with IDs containing spaces
    $('.event_type_list [id*=" "]').each(function () {
        // Get the current ID
        var currentId = $(this).attr('id');

        // Remove spaces from the ID
        var newId = currentId.replace(/\s+/g, '');

        // Set the new ID
        $(this).attr('id', newId);

        // Log the updated ID to the console (optional)
        console.log('Updated ID:', newId);
    });
});


jQuery(document).ready(function ($) {
    var sum = 0;

    // Iterate through each row in the tbody News and Activities
    $('#loan_table tbody tr').each(function () {
        // Find the cell with the header "Loan Amount" and extract its text
        var loanAmountText = $(this).find('td[data-th="Loan"], td[data-th="Amount (in thousands U.S Dollars)"]').text().trim();

        // Convert the text to a number and add it to the sum
        var loanAmountValue = parseFloat(loanAmountText);
        if (!isNaN(loanAmountValue)) {
            sum += loanAmountValue;
        }
    });
    var valElement = document.getElementById("val");
    if (valElement) {
        valElement.innerHTML = sum;
    }
    // Output the sum
    //console.log('Sum of Loan Amount: ' + sum);

});

jQuery(document).ready(function ($) {
    $('.show_btn').click(function () {
        $('#award_display,.award_ap').show(200);
        $('.show_btn').hide(0);
        $('.hide_btn').show(0);
    });
    $('.hide_btn').click(function () {
        $('#award_display, .award_ap').hide(500);
        $('.show_btn').show(0);
        $('.hide_btn').hide(0);
    });
});

jQuery(document).ready(function ($) {
    const d = new Date();
    let year = d.getFullYear();
    if (document.getElementById("year")) {
        document.getElementById("year").innerHTML = year;
    }
});

jQuery(document).ready(function ($) {
    $('.mfp-close').click(function () {
        alert("mfp-close has been clicked")
        $('.country-card').toggleClass('fadeOut');
    });
    $('.countries_close').click(function () {
        alert(".countries_close has been clicked");
        $('.country-card').toggleClass('fadeOut');
    });
});


document.addEventListener('DOMContentLoaded', function () {
    document.body.addEventListener('scroll', function () {
        fixed_header_mobile();
    });
});


function fixed_header_mobile() {
    if (jQuery(window).width() == 768) {
        if (jQuery('body').scrollTop() > 0) {
            jQuery('.site-header').addClass('fixed');
        } else {
            jQuery('.site-header').removeClass('fixed');
        }
    }
}

jQuery(document).ready(function () {

    jQuery('.popup-youtube, .popup-vimeo').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });
});


