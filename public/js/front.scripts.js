jQuery(document).ready(function(a) {
    'false' == dtGonza.mobile && a(window).load(function() {
        a('.scrolling').mCustomScrollbar({
            theme: 'minimal-dark',
            scrollButtons: {
                enable: !0
            },
            callbacks: {
                onTotalScrollOffset: 100,
                alwaysTriggerOffsets: !1
            }
        })
    })
});

jQuery(document).ready(function($) {
    $("#top-page").click(function() {
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });

    $('#discoverclic').click(function() {
        $(this).addClass('hidde');
        $('#closediscoverclic').removeClass('hidde')
        $('#discover').addClass("show");
        $('#requests').addClass("hidde");
        $('.requests_menu').addClass("hidde");
        $('.requests_menu_filter').removeClass("hidde")
    });

    $('#closediscoverclic').click(function() {
        $(this).addClass('hidde');
        $('#discoverclic').removeClass('hidde')
        $('#discover').removeClass("show");
        $('#requests').removeClass("hidde");
        $('.requests_menu_filter').addClass("hidde")
        $('.requests_menu').removeClass("hidde")
    });

    $('.filtermenu a').click(function() {
        var type = $(this).attr('data-type')
        $('.filtermenu a').removeClass('active')
        $(this).addClass('active')
        $('#type').val(type)
        return false;
    });

    // Requests Menu tabs
    $('.rmenu a').click(function() {
        var tab_id = $(this).attr('data-tab')
        $('.rmenu a').removeClass('active')
        $('.tabox').removeClass('current')
        $(this).addClass('active')
        $('#' + tab_id).addClass('current')
        return false;
    });
    //доработать вкладки в карточке фильма
    /*	$('.smenu li a').click(function () {
    		var tabId = $(this).attr('data-tab'),
    			tabPrev = $(this).prev().attr('data-tab');
    		//$('.smenu li a').removeClass('active')
    		//$('.tabox').removeClass('current')
    		//$(this).addClass('active');
    		$('#' + tabId).addClass('active');
    		return false;
    	});*/
    $('.tab-title li').not('.active').click(function() {
        var index = $(this).index();
        var content = $('.tab-content li.sbox').eq(index);
        $(this).addClass('active').siblings().removeClass('active');
        $('.tab-content li.sbox').css('display', 'none').eq(index).css('display', 'block');
    })

    $('.tab-title li:first').addClass('active');
    $('.tab-content li:first').css('display', 'block');

    // Clic login
    $(document).on('click', '.clicklogin', function() {
        $(".login_box ").show();
    });

    // Clic clogin
    $(document).on('click', '#c_loginbox', function() {
        $(".login_box ").hide();
    });

    // Keup
    $(document).keyup(function(e) {
        if (e.keyCode == 27) {
            $(".login_box").hide(100);
            $("#result_edit_link").hide(100);
            $("#report-video").removeClass("report-video-active");
        }
        if (e.keyCode == 76) {
            $('.process_list').trigger('click')
        }
        if (e.keyCode == 86) {
            $('.process_views').trigger('click')
        }
        if (e.keyCode == 107) {
            $("#add_row").trigger('click')
        }
    });

    // Count items
    for (var a = 0, b = $(".items .item"),
            c = 0; c <= b.length; c++) a > 3 ? ($(".items .item:nth-child(" + c + ") .dtinfo")
        .addClass("right"), 5 > a ? a++ : (a--, a--, a--, a--)) : (
        $(".items .item:nth-child(" + c + ") .dtinfo").addClass("left"), a++
    )

    // Hides
    $(".nav-resp").click(function() {
        $("#arch-menu").toggleClass("sidblock"),
            $(".nav-resp").toggleClass("active")
    })

    $(".nav-advc").click(function() {
        $("#advc-menu").toggleClass("advcblock"),
            $(".nav-advc").toggleClass("dactive")
    })

    $(".report-video").click(function() {
        $("#report-video").toggleClass("report-video-active"),
            $(".report-video").toggleClass("report-video-dactive")
    })

    $(".adduser").click(function() {
        $("#register_form").toggleClass("advcblock"),
            $(".form_fondo").toggleClass("advcblock"),
            $(".adduser").toggleClass("dellink")
    })

    $(".search-resp").click(function() {
        $("#form-search-resp").toggleClass("formblock"),
            $(".search-resp").toggleClass("active")
    })
    $(".wide").click(function() {
        $("#playex").toggleClass("fullplayer")
        $(".sidebar").toggleClass("fullsidebar")
        $(".icons-enlarge2").toggleClass("icons-shrink2")
    })
    $(".sources").click(function() {
        $(".sourceslist").toggleClass("sourcesfix")
        $(".listsormenu").toggleClass("icon-close2")
    })

    $(".content").ready(function() {
        $("#tvload").css("display", "none")
    })

    $(".content").load(function() {
        $("#tvload").css("display", "none")
    })

    $(".content").ready(function() {
        $("#movload").css("display", "none")
    })

    $(".content").ready(function() {
        $("#featload").css("display", "none")
    })

    $(".content").load(function() {
        $("#movload").css("display", "none")
    })

    $(".content").ready(function() {
        $("#epiload").css("display", "none")
    })

    $(".content").load(function() {
        $("#epiload").css("display", "none")
    })

    $(".content").ready(function() {
        $("#seaload").css("display", "none")
    })

    $(".content").load(function() {
        $("#seaload").css("display", "none")
    })

    $(".content").ready(function() {
        $("#slallload").css("display", "none")
    })

    $(".content").load(function() {
        $("#slallload").css("display", "none")
    })

    $(".content").ready(function() {
            $("#sltvload").css("display", "none")
        }),

        $(".content").load(function() {
            $("#sltvload").css("display", "none")
        })

    $(".content").ready(function() {
        $("#slmovload").css("display", "none")
    })

    $(".content").load(function() {
        $("#slmovload").css("display", "none")
    })

    $(".content").ready(function() {
        $(".genreload").css("display", "none")
    })

    $(".content").load(function() {
        $(".genreload").css("display", "none")
    })

    $('#featured-titles').owlCarousel({
        autoPlay: false,
        items: 4,
        stopOnHover: true,
        pagination: false,
        itemsDesktop: [1199, 4],
        itemsDesktopSmall: [980, 4],
        itemsTablet: [768, 3],
        itemsTabletSmall: false,
        itemsMobile: [479, 2]
    });
    $('.nextf').click(function() {
        $('#featured-titles').trigger('owl.next')
    });
    $('.prevf').click(function() {
        $('#featured-titles').trigger('owl.prev')
    });
    $('#slider-movies-tvshows').owlCarousel({
        autoPlay: false,
        items: 2,
        stopOnHover: true,
        pagination: true,
        itemsDesktop: [1199, 2],
        itemsDesktopSmall: [980, 2],
        itemsTablet: [768, 2],
        itemsTabletSmall: [600, 1],
        itemsMobile: [479, 1]
    });

    $('#dt-boeviki').owlCarousel({
        autoPlay: false,
        items: 5,
        stopOnHover: true,
        pagination: false,
        itemsDesktop: [1199, 5],
        itemsDesktopSmall: [980, 5],
        itemsTablet: [768, 4],
        itemsTabletSmall: false,
        itemsMobile: [479, 3]
    });

    $('.dt-boeviki .next3').click(function() {
        $('#dt-boeviki').trigger('owl.next')
    });
    $('.dt-boeviki .prev3').click(function() {
        $('#dt-boeviki').trigger('owl.prev')
    });

    $('#slider-movies').owlCarousel({
        autoPlay: false,
        items: 2,
        stopOnHover: true,
        pagination: true,
        itemsDesktop: [1199, 2],
        itemsDesktopSmall: [980, 2],
        itemsTablet: [768, 2],
        itemsTabletSmall: [600, 1],
        itemsMobile: [479, 1]
    });
    $('#slider-tvshows').owlCarousel({
        autoPlay: false,
        items: 2,
        stopOnHover: true,
        pagination: true,
        itemsDesktop: [1199, 2],
        itemsDesktopSmall: [980, 2],
        itemsTablet: [768, 2],
        itemsTabletSmall: [600, 1],
        itemsMobile: [479, 1]
    });
    $('.reset').click(function(event) {
        if (!confirm(dtGonza.reset_all)) {
            event.preventDefault()
        }
    });
    $('.addcontent').click(function(event) {
        if (!confirm(dtGonza.manually_content)) {
            event.preventDefault()
        }
    });
});

// Funcion Header
var js = {};
! function(a) {
    a.fn.exists = function() {
        return a(this).length > 0
    }, js.model = {
        events: {},
        extend: function(b) {
            var c = a.extend({}, this, b);
            return a.each(c.events, function(a, b) {
                c._add_event(a, b)
            }), c
        },
        _add_event: function(b, c) {
            var d = this,
                e = b,
                f = "",
                g = document;
            b.indexOf(" ") > 0 && (e = b.substr(0, b.indexOf(" ")), f = b.substr(b.indexOf(" ") + 1)), "resize" != e && "scroll" != e || (g = window), a(g).on(e, f, function(b) {
                b.$el = a(this), "function" == typeof d.event && (b = d.event(b)), d[c].apply(d, [b])
            })
        }
    }, js.header = js.model.extend({
        $header: null,
        $sub_header: null,
        active: 0,
        hover: 0,
        show: 0,
        y: 0,
        opacity: 1,
        direction: "down",
        events: {
            ready: "ready",
            scroll: "scroll",
            "mouseenter #header": "mouseenter",
            "mouseleave #header": "mouseleave"
        },
        ready: function() {
            this.$header = a("#header"), this.$sub_header = a("#sub-header"), this.active = 1
        },
        mouseenter: function() {
            var b = a(window).scrollTop();
            this.hover = 1, this.opacity = 1, this.show = b, this.$header.stop().animate({
                opacity: 1
            }, 250)
        },
        mouseleave: function() {
            this.hover = 0
        },
        scroll: function() {
            if (this.active) {
                var b = a(window).scrollTop(),
                    c = b >= this.y ? "down" : "up",
                    d = c !== this.direction,
                    f = (b - this.y, this.$sub_header.outerHeight());
                clearTimeout(this.t), 70 > b && this.$header.removeClass("-white"), d && (0 == this.opacity && "up" == c ? (this.show = b, f > b ? this.show = 0 : this.show -= 70) : 1 == this.opacity && "down" == c && (this.show = b), this.show = Math.max(0, this.show)), this.$header.hasClass("-open") && (this.show = b), this.hover && (this.show = b);
                var g = b - this.show;
                g = Math.max(0, g), g = Math.min(g, 70);
                var h = (70 - g) / 70;
                this.$header.css("opacity", h), b > f ? this.$header.addClass("-white") : 0 == h && this.$header.removeClass("-white"), this.y = b, this.direction = c, this.opacity = h
            }
        }
    })
}(jQuery);