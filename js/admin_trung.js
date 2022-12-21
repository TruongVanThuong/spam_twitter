(function($) {
    var user_id = 1;
    tagify = new Tagify(document.querySelector('textarea[name=tags]'), {
        duplicate: false
    });
    tagify = new Tagify(document.querySelector('textarea[name=links_retweet]'), {
        duplicate: false
    });
    tagify = new Tagify(document.querySelector('textarea[name=likes_profile]'), {
        duplicate: false
    });
    tagify = new Tagify(document.querySelector('textarea[name=following]'), {
        duplicate: false
    });

   
    async function async_data(cmd_func) {
        return follow_links;
    }
    $('.btn_update_group_profile').on('click', function() {
        var follow_links = [];
        var newdata = {};
        var cmd_func = ['following_links', 'spammer_links', 'load_likes', 'load_tags'];
        for (var i = 0; i <= cmd_func.length - 1; i++) {
            $('[name=' + cmd_func[i] + ']').each(function() {
                var group_id = ($(this).attr('id'));
                var dt = ($(this).val());
                if (dt != '' || dt.length != 0) {
                    dt_json = JSON.parse(dt);
                    console.log(dt_json);
                    $.each(dt_json, function(j, item) {
                        if (dt_json[j].value != '' || dt_json[j].value.length != 0) {
                            newdata = {
                                "value": dt_json[j].value, //your artist variable
                                "id": dt_json[j].id,
                                "group": group_id,
                                "cmd_func": cmd_func[i]
                            };
                            follow_links.push((newdata));
                            console.log(dt_json[j].value + " ----- " + cmd_func[i]);
                        }
                    });
                }
                // console.log(JSON.parse(following_links));
                // $.extend(true, JSON.parse(following_links), newdata);
            });
            // async_data(cmd_func[i]);
            // follow_links.push(dt_rt);
        }
        console.log(follow_links);
        /*    $("[name=spammer_links]").each(function(){
                var group_id = ($(this).attr('id'));
                var dt = ($(this).val());
                if (dt != '' || dt.length != 0) {
                    spammer_links = JSON.parse(dt);
                    $.each(spammer_links, function(i, item) {
                        if (spammer_links[i].value != '' || spammer_links[i].value.length != 0) {
                            newdata = {
                                "value": spammer_links[i].value, //your artist variable
                                "id": spammer_links[i].id,
                                "group":group_id
                            };
                            spammer_links.push((newdata));
                            console.log(spammer_links[i].value);
                        }
                    });
                }
                // console.log(JSON.parse(following_links));
                // $.extend(true, JSON.parse(following_links), newdata);
                
          
            });*/
        // $("[name=load_tags]").each(function(){var load_tags = $(this).val(); console.log(load_tags);});
        // $("[name=load_likes]").each(function(){var load_likes = $(this).val(); console.log(load_likes);});
        $.ajax({
            type: "POST",
            url: 'func/function.php',
            data: "function=update_profile_group&data=" + JSON.stringify(follow_links),
            dataType: "text",
            success: function(data) {
                console.log(data);
                toastr.success('Cập nhật thành công');
                setTimeout(function() {
    location.reload();
}, 3000);
            },
            error: function(e) {
                console.log(e.statusText);
            }
        });
    });

    $('.btn_crete_group_profile').on('click', function() {
        var dt= $('form#form_create_group').serialize();
        var links = $("[name=content_post]").val();
        var name_group = $("[name=name_group_profile]").val();
        if (name_group == null || name_group == '') {
            alert("Chưa nhập tên group kìa");
        } else {
            var links = $("[name=links]").val();
            var likes_profile = $("[name=likes_profile]").val();
            var links_retweet = $("[name=links_retweet]").val();
            var num_likes_profile = $("[name=num_likes_profile]").val();
            var num_retweet = $("[name=num_retweet]").val();
            var num_follow = $("[name=num_follow]").val();
            var num_unfollow = $("[name=num_unfollow]").val();

            
            var delay_time = $("[name=delay_time]").val();
            var tags = $("[name=tags]").val();
            var following = $("[name=following]").val();
            var data = "following=" + following + "&user_id=" + user_id + "&name_group=" + name_group + "&links=" + links + "&likes_profile=" + likes_profile + "&links_retweet=" + links_retweet + "&tags=" + tags;
            data += "&num_likes_profile=" + num_likes_profile + "&num_retweet=" + num_retweet + "&num_follow=" + num_follow +"&num_unfollow=" + num_unfollow + "&delay_time=" + delay_time;
            post_data("create_group_acc", dt);
            console.log(dt);
        }
    })
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 9000
    });
    // xử lý data link
    $('.btn_remove_link').on('click', function() {
        var id = "link_id=" + $(this).attr('id');
        post_data("remove_link", id);
    });
    $('.btn_remove_group').on('click', function() {
        var id = "group_id=" + $(this).attr('id');
        post_data("remove_profile", id);
    });
    $('.btn_new_links').on('click', function() {
        var gr_id = $('#new_link').val().split('\n');
        var group_id = $('#group_id').val();
        for (var i = 0; i < gr_id.length; i++) {
            var data = "link=" + gr_id[i] + "&group_id=" + group_id;
            post_data("create_links", data);
        }
    });
    // xử lý data account
    $('.new_acc_btn').on('click', function() {
        var lines = $('textarea#list_acc_new').val().split('\n');
        var name_group_acc = $('input[name=nam_group_acc]').val();
        if (name_group_acc == null || name_group_acc == '') {
            alert('Chưa điền tên group account');
        } else {
            for (var i = 0; i < lines.length; i++) {
                var dt = lines[i].split('|');
                console.log(dt[0] + "---" + dt[1]);
                if (dt[2] == 'undefined') {
                    dt[2] = '';
                }
                var data = "username=" + dt[0] + "&pass=" + dt[1] + "&facode=" + dt[2] + "&name_group=" + name_group_acc;
                post_data("import_account", data);
            }
        }
    })
    $('.btn_update_acc').on('click', function() {
        var lines = $('textarea#update_acc').val().split('\n');
        var group_id = $('#group_id').val();
        var name_machine = $('#name_machine').val();
        var logined = $('input[name="logined"]:checked').val();
        console.log(logined);
        if (group_id == null || group_id == '') {
            alert('Chưa điền tên group account');
        } else {
            for (var i = 0; i < lines.length; i++) {
                var dt = lines[i].split('|');
                console.log(dt[0] + "---" + dt[1]);
                var data = "name_machine="+name_machine+"&username=" + dt[0] + "&pass=" + dt[1] + "&facode=" + dt[2] + "&group_id=" + group_id + "&logined=" + logined;
                post_data("update_account_group", data);
            }
        }
    })
    $('.btn_remove_acc').on('click', function() {
        var id = "account_id=" + $(this).attr('id');
        post_data("remove_acc", id);
    });

    function post_data(func, values) {
        $.ajax({
            url: "func/function.php",
            type: "post",
            data: values + "&function=" + func,
            success: function(response) {
                console.log(response);
                toastr.success('Thao tác thành công.');
                /* window.setTimeout(function() {
                     window.location.reload();
                 }, 2000);*/
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }

    function load_link_groups() {
        $.ajax({
            type: "POST",
            url: 'func/function.php?function=load_links_group',
            data: ({
                user_id: 1
            }),
            dataType: "json",
            success: function(data) {
                // Run the code here that needs
                //    to access the data returned
                return data;
            },
            error: function() {
                alert('Error occured');
            }
        });
    }


})(jQuery)