(function ($) {
    var timerScrollfront;

    Drupal.behaviors.IdeaLoadmorePagerFront = {
        attach: function (context, settings) {
            _InitAction();

            //////////

            var isWorking = false;
            $(window).on('scroll', function () {
                clearTimeout(timerScrollfront);

                timerScrollfront = setTimeout(function () {
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
                }, 500);
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
            $(".ajax-comment").colorbox({width: "340px", height: "400px"});
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

            //set fixed position
            $(window).on('scroll', function () {
                if ($(window).scrollTop() > 60) {
                    //front
                    $(".front .sidebar-second").addClass("top-right-fixed");
                    $(".front .sidebar-first").addClass("top-left-fixed");
                    $(".front .main.columns").addClass("top-center");
                    //taxonomy
                    $(".page-taxonomy .sidebar-second").addClass("top-right-fixed");
                    $(".page-taxonomy .sidebar-first").addClass("top-left-fixed");
                    $(".page-taxonomy .main.columns").addClass("top-center");
                }else{
                    //front
                    $(".front .sidebar-second").removeClass("top-right-fixed");
                    $(".front .sidebar-first").removeClass("top-left-fixed");
                    $(".front .main.columns").removeClass("top-center");
                    //taxonomy
                    $(".page-taxonomy .sidebar-second").removeClass("top-right-fixed");
                    $(".page-taxonomy .sidebar-first").removeClass("top-left-fixed");
                    $(".page-taxonomy .main.columns").removeClass("top-center");
                }
            });

        }
    };
})
(jQuery);