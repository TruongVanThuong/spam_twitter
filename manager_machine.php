<?php include ('header.php');

?>
<link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet">
<title>QUẢN LÝ MÁY</title>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button">
            <i class="fas fa-bars"></i>
          </a>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->
    <?php include ('sidebar.php'); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>QUẢN LÝ MÁY</h1>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="card card-warning">
                <div class="card-header">
                  <h3 class="card-title"> TẠO MỚI NHÓM </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <form>
                    <div class="row">


                      <form id="form_create_group">
                        <div class="col-sm-3">
                          <label> Vui lòng tên nhóm</label>

                          <input class="form-control" name="name_machine" type="text"
                            placeholder="Vui lòng nhập tên nhóm"></div>
                        <div class="col-sm-3">


                        </div>






              
                        <div class="col-sm-4">
                          <button type="button" class="btn_crete_group_profile btn btn-block bg-gradient-primary btn-lg"
                            style="FONT-SIZE: 16px;margin-bottom: 20px;">TẠO MỚI MÁY </button>
                        
                    </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
          <!--/. container-fluid -->
        </div>
    </div>
    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">DANH SÁCH NHÓM</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-sm-8"></div>
          <div class="col-sm-4"> <button type="button"
              class="btn_update_group_profile btn btn-block bg-gradient-danger">Update</button> </div>
        </div>

        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th style="width: 14%;text-align: center;justify-content: center;">TÊN NHÓM</th>
              <th style="width: 20%;">TRẠNG THÁI</th>
              <th style="width: 16%;">NHÓM TÀI KHOẢN</th>
              <th>THAO TÁC</th>
            </tr>
          </thead>
          <tbody>
            <?php
$c = show_group_profile(1);
$likes_arr = array();
while ($row = mysqli_fetch_array($c))
{
    $follow_arr = array();

    echo "<tr>";
    echo "<td>" . $row['group_id'] . " --- " . $row['name_group'] . "<button id='" . $row['group_id'] . "' style='width: 118px; font-size: 15px;' type='button' class='btn_remove_group btn btn-block bg-gradient-danger btn-sm'>Xoá cấu hình</button></td>";
    // $cmd = load_command_group_profile($row['group_id']);
    // while ($r = mysqli_fetch_array($cmd)){
    // // var_dump($r);
    //    switch ($r['command']) {
    //      case 'follow':
    //     $follow_arr[] = array("value" => $r['url_link'], "id" => $r['command_id']);
    //        break;
    //      case "likes":
    //     $likes_arr[] = array("value" => $r['url_link'], "id" => $r['command_id']);
    //      break;
    //       case "retweet":
    //      break;
    //      default:
    //        # code...
    //        break;
    //   }
    // }
    echo "<td>";
    echo "<textarea name='following_links'  id='" . $row['group_id'] . "'></textarea>";
    echo "</td>";
    echo "<td>";
    echo "<textarea name='spammer_links' id='" . $row['group_id'] . "'></textarea>";
    echo "</td>";
    echo "<td>";
    echo "<textarea name='load_tags' id='" . $row['group_id'] . "'></textarea>";
    echo "</td>";
    echo "<td>";
    echo "<textarea name='load_likes' id='" . $row['group_id'] . "'></textarea>";
    echo "</td>";
    // $t = load_tags($row['group_id']);
    // echo "</td>";
    //       echo "<td>". (!empty($follow_arr))? (json_encode($follow_arr)): 'Không có'."</td>";
    // echo "</tr>";
    
}
?>
          </tbody>
          <tfoot>
            <tr>
              <th style="width: 14%;text-align: center;justify-content: center;">Tên cấu hình</th>
              <th style="width: 20%;">Following</th>
              <th style="width: 16%;">Link spam</th>
              <th> Tags </th>
              <th>Like</th>

            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include ('footer.php'); ?>
  <!--    <script type="text/javascript">
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2().multiselect({
    enableFiltering: true,
    includeSelectAllOption: true,
    // Re-validate the multiselect field when it is changed
    onChange: function(element, checked) {
      $('.select2').formValidation('revalidateField', 'browsers');
      adjustByScrollHeight();
    },
    onDropdownShown: function(e) {
      adjustByScrollHeight();
    },
    onDropdownHidden: function(e) {
      adjustByHeight();
    }
  })
  .end();
        });

</script> -->
  <script type="text/javascript">
    function onRemoveTag(e) {
      console.log("onRemoveTag:", e.detail, "tagify instance value:", tagify.value)
    }
    var input = document.querySelector('textarea[name=links]'),
      tagify = new Tagify(input, {
        pattern: /^.{0,20}$/, // Validate typed tag(s) by Regex. Here maximum chars length is defined as "20"
        delimiters: ",| ", // add new tags when a comma or a space character is entered
        // keepInvalidTags: false,         // do not remove invalid tags (but keep them marked as invalid)
        editTags: true, // single click to edit a tag
        maxTags: 20,
        editable: true,
        backspace: "edit",
        placeholder: "Type something",
        // dropdown : {
        //     enabled: 1,            // show suggestion after 1 typed character
        //     fuzzySearch: true,    // match only suggestions that starts with the typed characters
        //     position: 'text',      // position suggestions list next to typed text
        //     caseSensitive: true,   // allow adding duplicate items if their case is different
        // },
        // templates: {
        //     dropdownItemNoMatch: function(data) {
        //         return `
        // <div class='${this.settings.classNames.dropdownItem}' tabindex="0" role="option">
        //             Không tìm thấy từ khoá đề xuất: 
        // <strong>${data.value}</strong>
        //         
        // </div>`
        //     }
        // },
        callbacks: {
          add: console.log, // callback when adding a tag
          remove: console.log // callback when removing a tag
        },

      });

    // generate a random color (in HSL format, which I like to use)
    function getRandomColor() {
      function rand(min, max) {
        return min + Math.random() * (max - min);
      }

      var h = rand(1, 360) | 0,
        s = rand(40, 70) | 0,
        l = rand(65, 72) | 0;

      return 'hsl(' + h + ',' + s + '%,' + l + '%)';
    }

    function transformTag(tagData) {
      tagData.style = "--tag-bg:" + getRandomColor();

      if (tagData.value.toLowerCase() == 'shit')
        tagData.value = 's✲✲t'
    }

    tagify.on('add', function (e) {
      console.log(tagify.value)
    })



    $('[name="following_links"]').each(function () {
      console.log($(this).attr('id'));
      load_following($(this).attr('id'));

    });
    $('[name="spammer_links"]').each(function () {
      load_links_spam($(this).attr('id'));

    });
    $('[name="load_tags"]').each(function () {
      load_tags($(this).attr('id'));

    });

    function load_links_spam(group_id) {
      $.ajax({
        type: "POST",
        url: 'func/function.php',
        data: "function=load_spammer_link&group_id=" + group_id,
        dataType: "text",
        success: function (data) {
          console.log(data);
          // tagify.addTags((data));

          create_tagify_field("spammer_links", group_id, (JSON.parse(data)));

        },
        error: function (e) {
          console.log(e);
        }
      });

    }

    function load_tags(group_id) {
      //    var tagify = $('textarea[name="load_tags"][id="'+group_id+'"]').tagify({
      // editTags: true,            // single click to edit a tag
      //        maxTags: 20,
      //        editable:true,
      //        backspace: "edit",
      //        placeholder: "Nhập tags",
      //        callbacks: {
      //            add: console.log,  // callback when adding a tag
      //            remove: console.log   // callback when removing a tag
      //        },    
      //   });
      $.ajax({
        type: "POST",
        url: 'func/function.php',
        data: "function=load_tags&group_id=" + group_id,
        dataType: "text",
        success: function (data) {


          if (data) {
            console.log(data);
            // tagify.addTags((data));
            create_tagify_field("load_tags", group_id, JSON.parse(data));

          }
        },
        error: function (e) {
          console.log(e);
        }
      });

    }

    function load_likes(group_id) {
      /*   var tagify = $('textarea[name="load_likes"][id="'+group_id+'"]').tagify({
 editTags: true,            // single click to edit a tag
        maxTags: 20,
        editable:true,
        backspace: "edit",
        placeholder: "Nhập likes",
        callbacks: {
            add: console.log,  // callback when adding a tag
            remove: console.log   // callback when removing a tag
        },    
   });*/

      $.ajax({
        type: "POST",
        url: 'func/function.php',
        data: "function=load_command_group_profile&group_id=" + group_id,
        dataType: "text",
        success: function (data) {


          if (data) {
            console.log(data);
            // tagify.addTags((data));


            var tags = tagify.data('tagify');

            tags.addTags(JSON.parse(data));

          }
        },
        error: function (e, tagData) {
          console.log(e.details.value);
        }
      });

    }

    function load_following(group_id) {
      // var input = document.querySelector('[id="'+group_id+'"]'),
      //   tagify = new Tagify(input, {
      //       editTags: true,            // single click to edit a tag
      //       maxTags: 20,
      //       editable:false,
      //       backspace: "edit",
      //       placeholder: "Nhập links follower",
      //       callbacks: {
      //           add: console.log,  // callback when adding a tag
      //           remove: console.log   // callback when removing a tag
      //       },

      //   });
      // var tagify = $('textarea[name="following_links"][id="'+group_id+'"]').tagify({
      //       editTags: true,            // single click to edit a tag
      //         maxTags: 20,
      //         editable:true,
      //         backspace: "edit",
      //         placeholder: "Nhập links follower",
      //         callbacks: {
      //             add: console.log,  // callback when adding a tag
      //             remove: console.log   // callback when removing a tag
      //         },    
      //    });




      // var tagify = $('textarea[name="load_likes"][id="'+group_id+'"]').tagify({
      //       editTags: true,            // single click to edit a tag
      //         maxTags: 20,
      //         editable:true,
      //         backspace: "edit",
      //         placeholder: "Nhập links likes",
      //         callbacks: {
      //             add: console.log,  // callback when adding a tag
      //             remove: onRemoveTag   // callback when removing a tag
      //         },    
      //    });


      $.ajax({
        type: "POST",
        url: 'func/function.php',
        data: "function=load_command_group_profile&group_id=" + group_id,
        dataType: "text",
        success: function (data) {

          $.each(JSON.parse(data), function (key, val) {
            console.log(key);
            jsonObj = [];
            if (key == "follow") {
              var name_textrea = "following_links";
            } else if (key == "likes") {
              var name_textrea = "load_likes";
            }
            //   var input = document.querySelector('[name="'+name_textrea+'"][id="'+group_id+'"]');
            // // init Tagify script on the above inputs
            // tagify4 = new Tagify(input, {
            //  mixTagsInterpolator: ["{{", "}}"],
            //     pattern: /@|#/,  // <--  Text starting with @ or # (if single, String can be used here)
            //     tagTextProp: 'text',  // <-- the default property (from whitelist item) for the text to be rendered in a tag element.
            //     // Array for initial interpolation, which allows only these tags to be used
            //     callbacks: {
            //         add: console.log,  // callback when adding a tag
            //         remove: console.log   // callback when removing a tag
            //     }
            // })

            $.each((val), function (k, v) {
              console.log((v.id));
              item = {}
              item["value"] = v.value;
              item["id"] = v.id;

              jsonObj.push(item);

            });
            create_tagify_field(name_textrea, group_id, (jsonObj));

            //            tagify4.addTags(JSON.parse(JSON.stringify(jsonObj)));

            // tagify4.on('remove', function(e){  console.log(e);})
            // $('textarea[name="'+name_textrea+'"][id="'+group_id+'"]').data('tagify').addTags((jsonObj));
          });
          console.log(data);
          //       if (data)
          //       {           
          //         var tags = tagify.data('tagify');
          //         tags.addTags(JSON.parse(data));
          //           // $('[id="'+group_id+'"]').data('tagify').addTags(JSON.parse(data));
          // //           $('[id="'+group_id+'"]').tagify()
          // // .on('add', function(e, tagData){
          // //     console.log('added', tagData)  // data, index, and DOM node
          // // });

          //       }
        },
        error: function (e) {
          console.log(e);
        }
      });


    }

    function create_tagify_field(name_textrea, group_id, data) {
      console.log(name_textrea + "====" + group_id);

      // var input = document.querySelector('[name="'+name_textrea+'"][id="'+group_id+'"]');
      var tagify4 = $('textarea[name="' + name_textrea + '"][id="' + group_id + '"]').tagify({
        editTags: true, // single click to edit a tag
        maxTags: 20,
        editable: true,
        backspace: true,
        callbacks: {
          add: console.log, // callback when adding a tag
          // remove: onRemoveTag()   // callback when removing a tag
        },
      });

      $('textarea[name="' + name_textrea + '"][id="' + group_id + '"]').data('tagify').addTags(JSON.parse(JSON
        .stringify(data)));


      $('textarea[name="' + name_textrea + '"][id="' + group_id + '"]').on('removeTag', function (e, tagData) {
        console.log(tagData.data.id + name_textrea);
        if (typeof tagData.data.id === "undefined") {

          console.log("OK");

        } else {
          $.ajax({
            type: "POST",
            url: 'func/function.php',
            data: "function=remove_att&att_id=" + tagData.data.id + "&name_textrea=" + name_textrea,
            dataType: "text",
            success: function (data) {
              if (data) {
                console.log(data);
              }
            },
            error: function (e, tagData) {
              console.log(e.details.value);
            }
          });
        }



      })
    }

  </script>
  <style type="text/css">
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
      background: #04040fc7 !important;
    }

    tags.tagify.tagify__tag.tagify--noTags.tagify--empty {
      display: none;
    }

    .tagify__tag {
      margin: 3px 0 3px 3px !important;
    }

    span.tagify__tag-text {
      font-size: 13px;
      vertical-align: baseline !important;
    }

    span.tagify__input {
      font-size: 15px;
    }

  </style>
