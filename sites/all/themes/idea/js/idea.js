(function ($) {
    var timerScrollfront;

    Drupal.behaviors.IdeaLoadmorePagerFront = {
        attach: function (context, settings) {
            _InitAction();

            //////////

            var isWorking = false;
            $(window).on('scroll', function () {
                if (!$(".view-news-article").hasClass('my-post-ready')) {
                    clearTimeout(timerScrollfront);

                    timerScrollfront = setTimeout(function () {
                        //front
                        if ($(".front footer").length > 0) {
                            $(".idea-loading").show();
                            if (!isWorking) {
                                if ($(window).scrollTop() > $(".front footer").offset().top - 800) {
                                    isWorking = true;
                                    var number_li = $(".view-news-article div.article-ideas").length;
                                    var num = number_li / 5;
                                    // var data_ = $(".loading-view").attr('data');
                                    $.post('/frontpage/pager', {pager: num})
                                            .done(function (data) {
                                                if (data != 'ko') {
                                                    $(".idea-loading").hide();
                                                    $(".view-news-article").append(data);

                                                    _InitAction();

                                                } else {
                                                    $(".idea-loading").remove();
                                                }
                                                isWorking = false;
                                            })
                                            .fail(function () {
                                                //alert( "error" );
                                            });
                                }
                            }
                        }
                        //taxonomy
                        if ($(".page-taxonomy footer").length > 0) {
                            $(".idea-loading").show();
                            console.log('nhan');
                            if (!isWorking) {
                                if ($(window).scrollTop() > $(".page-taxonomy footer").offset().top - 800) {
                                    isWorking = true;
                                    var number_li = $(".view-news-article div.article-ideas").length;
                                    var num = number_li / 5;
                                    var tid = $("#sidebar-main").attr('data');
                                    console.log(tid);
                                    // var data_ = $(".loading-view").attr('data');
                                    $.post('/cate/pager', {pager: num, tid: tid})
                                            .done(function (data) {
                                                if (data != 'ko') {
                                                    $(".idea-loading").hide();
                                                    $(".view-news-article").append(data);

                                                    _InitAction();

                                                } else {
                                                    $(".idea-loading").remove();
                                                }
                                                isWorking = false;
                                            })
                                            .fail(function () {
                                                //alert( "error" );
                                            });
                                }
                            }
                        }
                    }, 500);
                }

            });

            //click show action user
            $("a.my-post").click(function () {
                $(".idea-loading").hide();
                $(".view-news-article").html('');
                $(".view-news-article").addClass('my-post-ready');
                $.post('/idea/user/post')
                        .done(function (data) {
                            if (data != 'ko') {
                                $(".idea-loading").hide();
                                $(".view-news-article").append(data);

                                _InitAction();
                                $('html, body').animate({
                                    scrollTop: $(".view-news-article").offset().top - 70
                                }, 1000);


                            } else {
                                $(".idea-loading").remove();
                            }
                            isWorking = false;
                        })
                        .fail(function () {
                            //alert( "error" );
                        });
            });

            //click show action user
            $("a.my-save-post").click(function () {
                $(".idea-loading").hide();
                $(".view-news-article").html('');
                $(".view-news-article").addClass('my-post-ready');
                $.post('/idea/user/save')
                        .done(function (data) {
                            if (data != 'ko') {
                                $(".idea-loading").hide();
                                $(".view-news-article").append(data);

                                _InitAction();
                                $('html, body').animate({
                                    scrollTop: $(".view-news-article").offset().top - 70
                                }, 1000);


                            } else {
                                $(".idea-loading").remove();
                            }
                            isWorking = false;
                        })
                        .fail(function () {
                            //alert( "error" );
                        });
            });

            //post comment
            $(".comment-post-form form").each(function () {
                var _nid = $(this).attr('data');

                $(this).submit(function () {
                    var _comment = $(".comment-text-" + _nid).val();
                    var _cid = $(".reply-comment-" + _nid).val();
                    var _uid = 0;
                    if (_comment == '') {
                        $(".comment-text-" + _nid).addClass('error');
                        return false;
                    } else {
                        $(".comment-text-" + _nid).removeClass('error');
                    }
                    //return false;
                    $.post("/idea/comment/post", {
                        nid: _nid,
                        pid: _uid,
                        cid: _cid,
                        comment: _comment
                    })
                            .done(function (data) {
                                if (data != 'Access denied') {
                                    $(".comment-text-" + _nid).val('');
                                    $(".comment-items-" + _nid).append(data);
                                    $(".comment-post-form-" + _nid + " .user-comment-name").html('');
                                    _InitAction();
                                }
                                return false;

                            })
                            .fail(function () {
                                //alert( "error" );
                            });
                    return false;
                });

            });

            $(".load-more-comment a").each(function () {
                var _nid = $(this).attr('data');
                $(this).click(function () {
                    $.post("/idea/comment/get", {
                        nid: _nid
                    })
                            .done(function (data) {
                                if (data != 'ko') {
                                    $(".comment-items-" + _nid).html(data);
                                    _InitAction();
                                }
                                $(".load-more-comment").hide();
                                return false;

                            })
                            .fail(function () {
                                //alert( "error" );
                            });
                    return false;

                });
            });

            function _InitAction() {
                //show reply
                $(".comment-item").each(function () {
                    var _cid = $(this).attr('data');
//                    $(this).hover(function(){
//                       $(".action-comment-reply-"+_cid).show();
//                    });
//                    $(this).mouseleave(function(){
//                        $(".action-comment-reply").hide();
//                    });

                    //click for mobile
                    $(this).click(function () {
                        $(".action-comment-reply-" + _cid).show();
                    });
                });
                //click reply
                $(".action-comment-reply a").each(function () {
                    var _nid = $(this).attr('data-nid');
                    var _cid = $(this).attr('data');
                    var _user = $(this).attr('data-user');
                    $(this).click(function () {
                        $(".comment-post-form-" + _nid).show();
                        $("input.reply-comment-" + _nid).val(_cid);
                        $(".comment-post-form-" + _nid + " .user-comment-name").html('<b>+' + _user + '</b>');
                        return false;
                    });


                });

                //show hide comment form
                $(".comment-post a").each(function () {
                    var _nid = $(this).attr('data');
                    $(this).click(function () {
                        $('.comment-post-form-' + _nid).show();
                        $(".view-news-article .comment-post-s-" + _nid).show();
                        return false;
                    });
                });
                //close comment
                $(".comment-cancel a").each(function () {
                    var _nid = $(this).attr('data');
                    $(this).click(function () {
                        $('.comment-post-form-' + _nid).hide();
                        return false;
                    });
                });
                //check height of comment

                //like post
                $(".like-post a").each(function () {
                    var _nid = $(this).attr('data');
                    $(this).click(function () {
                        $.post("/idea/like/post", {
                            nid: _nid
                        })
                                .done(function (data) {
                                    if (data != 'Access denied') {
                                        $(".like-post-" + _nid + " i.count").text(data);
                                    }
                                    // return false;

                                })
                                .fail(function () {
                                    //alert( "error" );
                                });
                        //  return false;
                    });
                });

                //like post
                $(".save-post a").each(function () {
                    var _nid = $(this).attr('data');
                    $(this).click(function () {
                        $.post("/idea/save/post", {
                            nid: _nid
                        })
                                .done(function (data) {
                                    if (data != 'Access denied') {
                                        $(".save-post-" + _nid + " i.count").text(data);
                                    }
                                    //  return false;

                                })
                                .fail(function () {
                                    //alert( "error" );
                                });
                        // return false;
                    });
                });


            }
        }
    };

    Drupal.behaviors.initNiceSelect = {
        attach: function (context, settings) {
            $("select#edit-sort-by").niceSelect();
        }
    };

    Drupal.behaviors.initAction = {
        attach: function (context, settings) {
            $(".ajax-share").colorbox({width: "340px", height: "400px"});
            $(".ajax-like").colorbox({width: "340px", height: "400px"});
            //$(".ajax-comment").colorbox({width: "340px", height: "400px"});
            $(".exchange").colorbox({width: "370px", height: "400px"});
            $(".ajax-save").colorbox({width: "340px", height: "400px"});
            $(".idea-post_ajax").colorbox({width: "460px", height: "600px"});
            $(".user_not_login").colorbox({width: "340px", height: "400px"});
            $('input').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue',
                increaseArea: '20%' // optional
            });


            //register, login

            $(".register-action a").click(function () {
                $(".block-user-login").hide();
                $(".block-idea-custom-idea-register-user").show();
                return false;
            });

            $(".login-action a").click(function () {
                $(".block-user-login").show();
                $(".block-idea-custom-idea-register-user").hide();
                return false;
            });
            //click login
            $(".post_bottom").click(function () {
                $(".post_bottom_login").click();
            });

            //close share dislog
            $("#share-buttons a").each(function () {
                $(this).click(function () {
                    $.fn.colorbox.close();
                });
            });
            //search
            $(".idea-search-icon a").click(function () {
                if ($("#search-idea").hasClass('hide')) {
                    $("#search-idea").removeClass('hide');
                } else {
                    $("#search-idea").addClass('hide');
                }
            });

            //show send to friend
            $("a.sendtofriend").click(function () {
                $("input.sendfriend").removeClass('hidden');
                $("input.sendfriend").select();
            });

            $("input.sendfriend").mouseleave(function () {
                setTimeout(function () {
                    $("input.sendfriend").addClass('hidden');
                }, 3000);
            });

            function getPos(el) {
                // yay readability
                for (var lx = 0, ly = 0;
                        el != null;
                        lx += el.offsetLeft, ly += el.offsetTop, el = el.offsetParent)
                    ;
                return {x: lx, y: ly};
            }

            //get show user ipad

            $(".user-menu-mobile a.show-user").click(function () {
                $(".user-mobile-info-wrapper").show();
            });
            $(".user-mobile-info-wrapper a.close").click(function () {
                $(".user-mobile-info-wrapper").hide();
            });
            $(".search-menu-mobile a").click(function () {
                $(".search-menu-mobile-wrapper").show();
                $("#search-idea").removeClass('hide');
            });
            $(".search-menu-mobile-wrapper a.close").click(function () {
                $(".search-menu-mobile-wrapper").hide();
                $("#search-idea").addClass('hide');
            });
            $(".menu-icon a.menu-show-hide").click(function () {
                if ($(".menu-mobile").hasClass('hide')) {
                    $(".menu-mobile").removeClass('hide');
                } else {
                    $(".menu-mobile").addClass('hide');
                }
            });

            $(".link-post").click(function () {
                $(".share-link").show();
                $(".share-link").select();
            });

            $(".link-post").mouseleave(function () {
                setTimeout(function () {
                    $(".share-link").hide();
                }, 3000);


            });

            //add left for image
            var sizeDivImg = $(".carousel-inner .item").width();


            $(".carousel-inner .item img").each(function () {
                var img = this;
                $(this).attr("src", $(img).attr("src")).load(function () {
                    pic_real_width = this.width;   // Note: $(this).width() will not
                   //check current width
                   var current = (sizeDivImg - pic_real_width) /2;
                   $(this).css('left',current+'px');
                   
                });
            });
            
            //add left for image
            var sizeDivImgHome = $(".article-item .art-img").width();


            $(".article-item .art-img img").each(function () {
                var img = this;
                $(this).attr("src", $(img).attr("src")).load(function () {
                    pic_real_width = this.width;   // Note: $(this).width() will not
                   //check current width
                   var current = (sizeDivImgHome - pic_real_width) /2;
                   $(this).css('left',current+'px');
                   
                });
            });
            
//            var body = $('body').width();
//            if(body < 756){
//                $(".block-idea-custom-idea-post-relate").clone().appendTo(".relate-post");
//              //  $(".block-idea-custom-idea-post-relate").remove();
//                $(".relate-post .block-idea-custom-idea-post-relate").show();
//            }

            function getOriginalWidthOfImg(img_element) {
                var t = new Image();
                t.src = (img_element.getAttribute ? img_element.getAttribute("src") : false) || img_element.src;
                return t.width;
            }


        }
    };
})
        (jQuery);