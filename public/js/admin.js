/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./admin/resources/js/article.js":
/*!***************************************!*\
  !*** ./admin/resources/js/article.js ***!
  \***************************************/
/***/ (() => {

(function () {
  jQuery(document).ready(function ($) {
    "use strict"; //table blogs 

    $("#tableblogs").DataTable({
      // processing: true,
      // serverSide: true,
      // searchPanes: {
      //     controls: false
      // },
      // searching: false,
      // info: false,
      ajax: {
        url: "../api/article/gettablearticle",
        dataType: 'json',
        type: 'get'
      },
      createdRow: function createdRow(row, data, dataIndex) {
        if (data.status === 0) {
          $(row).addClass('badge-light-danger');
        }
      },
      columns: [{
        "data": "id",
        render: function render(data, type, row) {
          return "<div class=\"text-center checklistArticle\"><input  class=\"form-check-input checklistArticle\" type=\"checkbox\" value=\"".concat(data, "\" name=\"flexCheckTableArticle[]\"></div>");
        }
      }, {
        "data": "status",
        render: function render(data, type, row) {
          if (data) {
            return "<p class=\"text-center icon-tablecategory\"><i class=\"fa-solid fa-circle-check icon-tablecategory\"></i></p>";
          }

          return "<p class=\"text-center icon-tablecategory\"><i class=\"fa-solid fa-circle-xmark icon-tablecategory\"></i></p>";
        }
      }, {
        "data": {
          "title": "title",
          "title_url": "title_url"
        },
        render: function render(data, type, row) {
          return "<a href=\"articleedit?".concat(data['title_url'], "\" class=\"link-dark\" target=\"_blank\"><p class=\"text-start overflow-hidden\"><b>").concat(data['title'], "</b></p></a>");
        }
      }, {
        "data": "kind",
        render: function render(data, type, row) {
          return "<p class=\"text-center overflow-hidden\">".concat(data, "</p>");
        }
      }, {
        "data": "time"
      }, {
        "data": null,
        render: function render(data, type, row) {
          return " <div class = \"text-center\" >\n                        <span id = \"remotearticle\" class = \"material-symbols-rounded\"style = \"color: #D61C4E\"> delete </span> \n                        </div>";
        }
      }],
      "order": [[1, 'asc']],
      // initComplete: function(settings, json) {
      //     InitLoadSuccess(settings, json);
      // }
      stateSave: true,
      responsive: true,
      aoColumnDefs: [{
        bSortable: false,
        aTargets: [0]
      }],
      orderCellsTop: true,
      fixedHeader: true,
      language: {
        url: "//cdn.datatables.net/plug-ins/1.12.1/i18n/vi.json",
        paginate: {
          next: '»',
          previous: '«'
        }
      }
    });

    function loadTableArticle() {
      var spinnertable = $('.spinnertable');
      var tableCategory = $('#tableblogs tbody');
      tableCategory.addClass('fade');
      spinnertable.removeClass('fade');
      setTimeout(function () {
        spinnertable.addClass('fade');
        tableCategory.removeClass('fade');
        $('#tableblogs').DataTable().ajax.reload();
      }, 300);
    }

    $('#publishedArticle').on('click', function (event) {
      event.preventDefault();
      var arr = [];
      arr = $.map($("input[name='flexCheckTableArticle[]']:checked"), function (e, i) {
        return +e.value;
      });

      if (arr.length > 0) {
        $.ajax({
          type: "POST",
          url: "../api/article/changestatusarticle",
          data: {
            id: arr,
            status: 1
          }
        }).done(function (data) {
          loadTableArticle();
        });
      }
    });
    $('#unPublishedArticle').on('click', function (event) {
      event.preventDefault();
      var arr = [];
      arr = $.map($("input[name='flexCheckTableArticle[]']:checked"), function (e, i) {
        return +e.value;
      });

      if (arr.length > 0) {
        $.ajax({
          type: "POST",
          url: "../api/article/changestatusarticle",
          data: {
            id: arr,
            status: 0
          }
        }).done(function (data) {
          loadTableArticle();
        });
      }
    });
    $('#deleteArticle').on('click', function (event) {
      event.preventDefault();
      var arr = [];
      arr = $.map($("input[name='flexCheckTableArticle[]']:checked"), function (e, i) {
        return +e.value;
      });

      if (arr.length > 0) {
        $.ajax({
          type: "POST",
          url: "../api/article/deleteArticle",
          data: {
            id: arr
          }
        }).done(function (data) {
          loadTableArticle();
        });
      }
    });
    $('#reloadTableArticle').on('click', function (event) {
      event.preventDefault();
      loadTableArticle();
    });
    $('#tableblogs tbody').on('click', '#remotearticle', function () {
      // alert(data[0] + "'s salary is: " + data[5]);
      var table = $("#tableblogs").DataTable();
      var data = table.row($(this).parents('tr')).data(); //truy vấn xóa trong db

      var arr = [];
      arr[0] = data['id'];
      $.ajax({
        type: "post",
        url: "../api/article/deleteArticle",
        data: {
          id: arr
        }
      }).done(function () {
        //không cần hiển thị thông báo
        loadTableArticle();
      });
    }); //article insert

    tinymce.init({
      selector: '#textareaArticle',
      plugins: 'image code',
      // toolbar: 'undo redo | link image | code',

      /* enable title field in the Image dialog*/
      image_title: true,

      /* enable automatic uploads of images represented by blob or data URIs*/
      automatic_uploads: false,
      height: "480",

      /*
        URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
        images_upload_url: 'postAcceptor.php',
        here we add custom filepicker only to Image dialog
      */
      file_picker_types: 'image',
      // images_upload_url: 'saveimg.php',
      // images_upload_base_path: '../public/images/blogpost',
      // images_upload_credentials: true,

      /* and here's our custom image picker*/
      file_picker_callback: function file_picker_callback(cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        /*
          Note: In modern browsers input[type="file"] is functional without
          even adding it to the DOM, but that might not be the case in some older
          or quirky browsers like IE, so you might want to add it to the DOM
          just in case, and visually hide it. And do not forget do remove it
          once you do not need it anymore.
        */

        input.onchange = function () {
          var file = this.files[0];
          var reader = new FileReader();

          reader.onload = function () {
            /*
              Note: Now we need to register the blob in TinyMCEs image blob
              registry. In the next release this part hopefully won't be
              necessary, as we are looking to handle it internally.
            */
            var id = 'BaiVietID' + new Date().getTime();
            var blobCache = tinymce.activeEditor.editorUpload.blobCache;
            var base64 = reader.result.split(',')[1];
            var blobInfo = blobCache.create(id, file, base64);
            blobCache.add(blobInfo);
            /* call the callback and populate the Title field with the file name */

            cb(blobInfo.blobUri(), {
              title: file.name
            }); // lưu tên hình vào db
          };

          reader.readAsDataURL(file);
        };

        input.click();
      },
      content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    }); //load select kind in post page

    function LoadSelectCategory() {
      $('#SelectKind').empty().append($('<option>', {
        selected: true,
        "class": "text-center fw-bold",
        value: "none",
        text: "-- Chọn chủ đề --"
      }));
      $.ajax({
        type: "POST",
        url: "../api/category/getallcategory",
        success: function success(data) {
          $(data).each(function (item, value) {
            $('#SelectKind').append($('<option>', {
              value: value['kindname'],
              text: value['kindname']
            }));
          });
        }
      });
    }

    LoadSelectCategory();
    $('#reloadSelectCategory').on('click', function (event) {
      event.preventDefault();
      LoadSelectCategory();
    }); //xoa dau tiếng việt - thay thế dấu cách thành gạch nối

    function xoa_dau(str) {
      str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
      str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
      str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
      str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
      str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
      str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
      str = str.replace(/đ/g, "d");
      str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
      str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
      str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
      str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
      str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
      str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
      str = str.replace(/Đ/g, "D");
      str = str.replace(/[/]/g, "_");
      str = str.replace(/['!@#$%^&*().`~\\?,:;"[{\}\]]/g, "_");
      str = str.replace(/ /g, "-");
      return str;
    }

    function ModalNotify(modal, message) {
      $("#modalPostStatus").modal(modal);
      $("#modalPostStatus h4").html(message);
    }

    function insertArticle() {
      var title = $("#titleArticle").val();
      var title_url = xoa_dau(title.toString()) + '-';
      var file_tmp_name = $('#imageArticle_small').val();
      var status = $('#status').val(); // console.log(file_tmp_name);

      var nameCatogory = $("#SelectKind").val();
      var data = tinyMCE.get('textareaArticle').getContent();

      if (title != "" && file_tmp_name !== "" && data != "" && nameCatogory !== "none") {
        var nameimage = $('#imageArticle_small')[0].files[0].name;
        $.ajax({
          type: "post",
          url: "../api/article/insertarticle",
          dataType: "text",
          data: {
            title: title,
            title_url: title_url,
            content: data,
            nameimage: nameimage,
            kind: nameCatogory,
            status: status
          },
          success: function success(data) {
            console.log(data, "status"); // ModalNotify("show", "Lưu bài viết thành công");
            // $("#titlepost").val("");
            // tinyMCE.get('mytextareapost').setContent("");
          }
        }); //imagepost

        var fd = new FormData();
        var files = $('#imageArticle_small')[0].files; // Check file selected or not

        if (files.length > 0) {
          fd.append('file', files[0]);
          $.ajax({
            url: '../api/article/uploadimagearticle',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function success(data) {
              return true;
            }
          });
          ModalNotify("show", "Thêm bài viết thành công");
          return true;
        } else {
          ModalNotify("show", "Vui lòng thêm hình bài viết.");
          return false;
        }
      } else {
        ModalNotify("show", "Vui lòng điền đầy đủ dữ liệu");
        return false;
      }
    } //submit save post


    tinyMCE.triggerSave();
    $("#saveArticle").on("click", function (event) {
      event.preventDefault();
      insertArticle();
    });
    $("#saveNewArticle").on("click", function (event) {
      event.preventDefault();
      insertArticle();
      $("#titleArticle").val("");
      tinyMCE.get('textareaArticle').setContent("");
      $('#imageArticle_small').val(null);
    });
    $("#saveCloseArticle").on("click", function (event) {
      if (!insertArticle()) event.preventDefault();
    });
  });
})();

/***/ }),

/***/ "./admin/resources/js/articleedit.js":
/*!*******************************************!*\
  !*** ./admin/resources/js/articleedit.js ***!
  \*******************************************/
/***/ (() => {

(function () {
  jQuery(document).ready(function ($) {
    //edit
    function strimURL() {
      var urlPage = [];

      if (window.location.href.split("?").length > 1) {
        urlPage.push(window.location.href.split("/"));
        return urlPage[0][urlPage[0].length - 1].split("?");
      }

      return false;
    }

    function setArticleEdit() {
      if (strimURL()) {
        var arrUrl = strimURL(); // console.log(arrUrl, 'arrUrl');

        if (arrUrl[0] == "articleedit") {
          var title = $("#titleArticle");
          var status = $('#status');
          var nameCatogory = $("#SelectKind");
          var title_url = arrUrl[1];
          var img = $('.form-image-up img');
          var id = $('#idArticle b');
          $.ajax({
            type: "POST",
            url: "../api/article/getarticle",
            data: {
              title_url: title_url
            },
            success: function success(data) {
              id.html(data['id']);
              title.val(data['title']);
              status.val(data['status']).change();
              nameCatogory.val(data['kind']).change();
              console.log(data['content']);
              tinyMCE.get('textareaArticle').setContent(data['content']); // img.attr('src', 'https://us.123rf.com/450wm/antonbrand/antonbrand1105/antonbrand110500035/9529928-illustration-of-a-instant-camera-isolated-on-white.jpg?ver=6')

              img.attr('src', "../public/images/blogpost/".concat(data['nameimage']));
              img.attr('alt', data['nameimage']);
            }
          });
        }
      }
    }

    setTimeout(function () {
      setArticleEdit();
    }, 1000); //xoa dau tiếng việt - thay thế dấu cách thành gạch nối

    function xoa_dau(str) {
      str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
      str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
      str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
      str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
      str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
      str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
      str = str.replace(/đ/g, "d");
      str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
      str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
      str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
      str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
      str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
      str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
      str = str.replace(/Đ/g, "D");
      str = str.replace(/[/]/g, "_");
      str = str.replace(/['!@#$%^&*().`~\\?,:;"[{\}\]]/g, "_"); // str = str.replace(/['.*+?^${}()|[\]\\]/g, "_");

      str = str.replace(/ /g, "-");
      return str;
    } // show or hide notification


    function ModalNotify(modal, message) {
      $("#modalPostStatus").modal(modal);
      $("#modalPostStatus h4").html(message);
    }

    function updateArticleEdit() {
      var id = $('#idArticle b').html();
      var title = $("#titleArticle").val();
      var title_url = xoa_dau(title.toString());
      var status = $('#status').val();
      var file_tmp_name = $('#imageArticle_small')[0].files[0] == null; // let kind = $('input[name="radioKind"]:checked').val();

      var nameCatogory = $("#SelectKind").val();
      var data = tinyMCE.get('textareaArticle').getContent();

      if (title != "" && data != "" && nameCatogory !== "none") {
        var nameimage = $('.form-image-up img').attr("alt"); // console.log(id);
        // console.log(title);
        // console.log(title_url);
        // console.log(nameCatogory);
        // console.log(nameimage);
        // console.log(status);
        // console.log(data);

        if (!file_tmp_name) {
          nameimage = $('#imageArticle_small')[0].files[0].name;
        }

        $.ajax({
          type: "post",
          url: "../api/article/uploadArticle",
          dataType: "text",
          data: {
            id: id,
            title: title,
            title_url: title_url,
            content: data,
            nameimage: nameimage,
            kind: nameCatogory,
            status: status
          },
          success: function success(data) {// ModalNotify("show", "Lưu bài viết thành công");
            // $("#titlepost").val("");
            // tinyMCE.get('mytextareapost').setContent("");
          }
        }); //imagepost

        if (!file_tmp_name) {
          var fd = new FormData();
          var files = $('#imageArticle_small')[0].files; // Check file selected or not

          if (files.length > 0) {
            fd.append('file', files[0]);
            $.ajax({
              url: '../api/article/uploadimagearticle',
              type: 'post',
              data: fd,
              contentType: false,
              processData: false,
              success: function success(data) {
                return true;
              }
            });
            return true;
          }
        }
      } else {
        ModalNotify("show", "Vui lòng nhập đầy đủ thông tin");
        return false;
      }
    }

    $("#saveArticleEdit").on("click", function (event) {
      event.preventDefault();
      updateArticleEdit();
      ModalNotify("show", "Đã cập nhật thông tin bài viết");
    });
    $("#saveNewArticleEdit").on("click", function (event) {
      updateArticleEdit();
    });
    $("#saveCloseArticleEdit").on("click", function (event) {
      updateArticleEdit();
    });
  });
})();

/***/ }),

/***/ "./admin/resources/js/category.js":
/*!****************************************!*\
  !*** ./admin/resources/js/category.js ***!
  \****************************************/
/***/ (() => {

function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }

(function () {
  jQuery(document).ready(function ($) {
    'use strict'; // SELECT *, (SELECT count(id) FROM `blogs` WHERE `kind` = kindpost.kindname AND `status` = 1) AS cobo,(SELECT count(id) FROM `blogs` WHERE `kind` = kindpost.kindname AND `status` = 0) AS an  FROM `kindpost`

    $("#tableCategory").DataTable({
      // processing: true,
      // serverSide: true,
      searchPanes: {
        controls: false
      },
      searching: false,
      info: false,
      ajax: {
        url: "../api/category/getcategory",
        dataType: 'json',
        type: 'get'
      },
      createdRow: function createdRow(row, data, dataIndex) {
        if (data.status === 0) {
          $(row).addClass('badge-light-danger');
        }
      },
      columns: [{
        "data": "id",
        render: function render(data, type, row) {
          return "<div class=\"text-center checklistcategory\"><input  class=\"form-check-input checklistcategory\" type=\"checkbox\" value=\"".concat(data, "\" name=\"flexCheckTableCategory[]\"></div>");
        }
      }, {
        "data": "status",
        render: function render(data, type, row) {
          if (data) {
            return "<p class=\"text-center icon-tablecategory\"><i class=\"fa-solid fa-circle-check icon-tablecategory\"></i></p>";
          }

          return "<p class=\"text-center icon-tablecategory\"><i class=\"fa-solid fa-circle-xmark icon-tablecategory\"></i></p>";
        }
      }, {
        "data": {
          "kindname": "kindname",
          "id_parent": "id_parent",
          "id": "id"
        },
        render: function render(data, type, row) {
          if (data['id_parent'] != 0) {
            return "<a href=\"categoryedit?".concat(data['id'], "\"><p class=\"text-start\"><b>").concat(data['kindname'], "</b></p></a><p><small>-- Danh m\u1EE5c cha: ").concat(data['id_parent'], "</small></p>");
          } else {
            return "<a href=\"categoryedit?".concat(data['id'], "\"><p class=\"text-start\"><b>").concat(data['kindname'], "</b></p></a>");
          }
        }
      }, {
        "data": null,
        render: function render(data, type, row) {
          return "<p class= \"text-center\" > 0</p> ";
        }
      }, {
        "data": null,
        render: function render(data, type, row) {
          return "<p class= \"text-center\" > 0</p> ";
        }
      }, {
        "data": null,
        render: function render(data, type, row) {
          return "<div class= \"text-center d-block\" >\n                                <span id=\"remoteCategory\" class=\"material-symbols-rounded\" style=\"color: #D61C4E\"> delete </span>\n                            </div> ";
        }
      }],
      "order": [[1, 'asc']],
      // initComplete: function(settings, json) {
      //     InitLoadSuccess(settings, json);
      // }
      stateSave: true,
      responsive: true,
      aoColumnDefs: [{
        bSortable: false,
        aTargets: [0]
      }],
      orderCellsTop: true,
      fixedHeader: true,
      language: {
        url: "//cdn.datatables.net/plug-ins/1.12.1/i18n/vi.json",
        paginate: {
          next: '»',
          previous: '«'
        }
      }
    });
    $('#publishedCategory').on('click', function (event) {
      event.preventDefault();
      var arr = [];
      arr = $.map($("input[name='flexCheckTableCategory[]']:checked"), function (e, i) {
        return +e.value;
      });

      if (arr.length > 0) {
        $.ajax({
          type: "POST",
          url: "../api/category/changestatuscategory",
          data: {
            id: arr,
            status: 1
          },
          dataType: 'json'
        }).done(function (data) {//none
        });
        $('#tableCategory').DataTable().ajax.reload();
      }
    });

    function loadTableCategory() {
      var spinnertable = $('.spinnertable');
      var tableCategory = $('#tableCategory tbody');
      tableCategory.addClass('fade');
      spinnertable.removeClass('fade');
      setTimeout(function () {
        spinnertable.addClass('fade');
        tableCategory.removeClass('fade');
        $('#tableCategory').DataTable().ajax.reload();
      }, 300);
    }

    $('#unPublishedCategory').on('click', function (event) {
      event.preventDefault();
      var arr = [];
      arr = $.map($("input[name='flexCheckTableCategory[]']:checked"), function (e, i) {
        return +e.value;
      });

      if (arr.length > 0) {
        console.log(_typeof(JSON.stringify(arr)));
        console.log(JSON.stringify(arr));
        $.ajax({
          type: "POST",
          url: "../api/category/changestatuscategory",
          data: {
            id: arr,
            status: 0
          }
        }).done(function (data) {//none
        });
        $('#tableCategory').DataTable().ajax.reload();
      }
    });
    $('#deleteCategory').on('click', function (event) {
      event.preventDefault();
      var arr = [];
      arr = $.map($("input[name='flexCheckTableCategory[]']:checked"), function (e, i) {
        return +e.value;
      });

      if (arr.length > 0) {
        $.ajax({
          type: "POST",
          url: "../api/category/deleteCategory",
          data: {
            id: arr
          }
        }).done(function (data) {
          loadTableCategory();
        });
      }
    });
    $('#reloadTableCategory').on('click', function (event) {
      event.preventDefault();
      loadTableCategory();
    });
    $('#tableCategory tbody').on('click', '#remoteCategory', function () {
      // alert(data[0] + "'s salary is: " + data[5]);
      var table = $("#tableCategory").DataTable();
      var data = table.row($(this).parents('tr')).data(); //truy vấn xóa trong db

      var arr = [];
      arr[0] = data['id'];
      console.log(arr);
      $.ajax({
        type: "post",
        url: "../api/category/deleteCategory",
        data: {
          id: arr
        } // cache: false,

      }).done(function () {
        alert("Đã xóa danh mục");
        $('#tableCategory').DataTable().ajax.reload();
      });
    });
  });
})();

/***/ }),

/***/ "./admin/resources/js/categoryedit.js":
/*!********************************************!*\
  !*** ./admin/resources/js/categoryedit.js ***!
  \********************************************/
/***/ (() => {

(function () {
  jQuery(document).ready(function ($) {
    "use strict";

    function LoadEditCategoryParent() {
      $('#parentEditCategory').empty().append($('<option>', {
        selected: true,
        "class": "fw-bold",
        value: "0",
        text: "Không có"
      }));
      $.ajax({
        type: "POST",
        url: "../api/category/getallcategory",
        success: function success(data) {
          $(data).each(function (item, value) {
            $('#parentEditCategory').append($('<option>', {
              value: value['kindname'],
              text: value['kindname']
            }));
          });
        }
      });
    }

    function checkInput() {
      var name = $('#litleEditCategory');

      if (name.val() == "") {
        alert('Vui lòng điền tên danh mục');
        return false;
      }

      return true;
    }

    function strimURLD() {
      var urlPage = [];

      if (window.location.href.split("?").length > 1) {
        urlPage.push(window.location.href.split("/"));
        return urlPage[0][urlPage[0].length - 1].split("?");
      }

      return false;
    }

    function updatecategory() {
      if (checkInput()) {
        var id = strimURLD()[1];
        var name = $('#titleEditCategory').val();
        var about = tinyMCE.get('aboutEditCategory').getContent();
        ;
        var status = $('#statusEditCategory').val();
        var position_show = $('#eidtPosition_show').val();
        var parentCategory = $('#parentEditCategory').val(); // console.log('id: ' + id)
        // console.log('name: ' + name)
        // console.log('about: ' + about)
        // console.log('status: ' + status)
        // console.log('parentCategory: ' + parentCategory)

        $.ajax({
          type: "post",
          url: "../api/category/updatecategory",
          dataType: 'text',
          data: {
            id: id,
            name: name,
            about: about,
            status: status,
            id_parent: parentCategory,
            position_show: position_show
          },
          success: function success(data) {
            console.log(data, 'updatecategory');
          }
        });
      }
    }

    function setEditCategory() {
      if (strimURLD()) {
        var id = strimURLD()[1];
        var titleCategory = $('#titleEditCategory');
        var statusCategory = $('#statusEditCategory');
        var parentCategory = $('#parentEditCategory');
        var position_show = $('#eidtPosition_show');
        $.ajax({
          type: "post",
          url: "../api/category/getcategorysinger",
          data: {
            id: id
          },
          success: function success(data) {
            // console.log(data, "data category");
            console.log(data['status'], 'statusCategory');
            titleCategory.val(data['kindname']);
            tinyMCE.get('aboutEditCategory').setContent(data['about']);
            statusCategory.val(data['status']).change();
            position_show.val(data['position_show']).change();
            if (data['id_parent'] !== data['kindname']) parentCategory.val(data['id_parent']).change();
            $("#parentEditCategory option[value='".concat(data['kindname'], "']")).remove();
          }
        });
      }
    }

    tinymce.init({
      selector: '#aboutEditCategory',
      plugins: 'image code',
      // toolbar: 'undo redo | link image | code',

      /* enable title field in the Image dialog*/
      image_title: true,

      /* enable automatic uploads of images represented by blob or data URIs*/
      automatic_uploads: false,
      height: "480",

      /*
        URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
        images_upload_url: 'postAcceptor.php',
        here we add custom filepicker only to Image dialog
      */
      file_picker_types: 'image',
      // images_upload_url: 'saveimg.php',
      // images_upload_base_path: '../public/images/blogpost',
      // images_upload_credentials: true,

      /* and here's our custom image picker*/
      content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });

    if (strimURLD()[0] === "categoryedit") {
      LoadEditCategoryParent();
      setEditCategory();
    }

    $("#saveEditCategory").on('click', function (event) {
      event.preventDefault();
      updatecategory();
      alert("Cập nhật Thành Công");
    });
    $("#saveEditNewCategory").on('click', function () {
      updatecategory();
      alert("Cập nhật thành công");
    });
    $("#saveEditCloseCategory").on('click', function () {
      updatecategory();
    });
  });
})();

/***/ }),

/***/ "./admin/resources/js/categorynew.js":
/*!*******************************************!*\
  !*** ./admin/resources/js/categorynew.js ***!
  \*******************************************/
/***/ (() => {

(function () {
  jQuery(document).ready(function ($) {
    "use strict";

    tinymce.init({
      selector: '#aboutCategory',
      plugins: 'image code',
      // toolbar: 'undo redo | link image | code',

      /* enable title field in the Image dialog*/
      image_title: true,

      /* enable automatic uploads of images represented by blob or data URIs*/
      automatic_uploads: false,
      height: "480",

      /*
        URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
        images_upload_url: 'postAcceptor.php',
        here we add custom filepicker only to Image dialog
      */
      file_picker_types: 'image',
      // images_upload_url: 'saveimg.php',
      // images_upload_base_path: '../public/images/blogpost',
      // images_upload_credentials: true,

      /* and here's our custom image picker*/
      content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });

    function LoadCategoryParent() {
      $('#parentCategory').empty().append($('<option>', {
        selected: true,
        "class": "fw-bold",
        value: "0",
        text: "Không có"
      }));
      $.ajax({
        type: "POST",
        url: "../api/category/getallcategory",
        success: function success(data) {
          $(data).each(function (item, value) {
            $('#parentCategory').append($('<option>', {
              value: value['kindname'],
              text: value['kindname']
            }));
          });
        }
      });
    }

    LoadCategoryParent();

    function checkInput() {
      var name = $('#titleCategory');

      if (name.val() == "") {
        alert('Vui lòng điền tên danh mục');
        return false;
      }

      return true;
    }

    function insertcategory() {
      if (checkInput()) {
        var name = $('#titleCategory').val();
        var about = tinyMCE.get('aboutCategory').getContent();
        var position_show = $('#position_show').val();
        var status = $('#statusCategory').val();
        var parentCategory = $('#parentCategory').val();
        $.ajax({
          type: "post",
          url: "../api/category/insertcategory",
          data: {
            name: name,
            about: about,
            status: status,
            id_parent: parentCategory,
            position_show: position_show
          }
        }).done(function (data) {
          alert('Thêm danh mục thành công');
        });
      }
    }

    $("#saveCategory").on('click', function (event) {
      event.preventDefault();
      insertcategory();
    });
    $("#saveNewCategory").on('click', function (event) {
      event.preventDefault();
      insertcategory();
      $('#titleCategory').val("");
      $('#aboutCategory').val("");
      $('#statusCategory option').eq(0).prop('selected', true);
      $('#parentCategory option').eq(0).prop('selected', true);
    });
    $("#saveCloseCategory").on('click', function (event) {
      insertcategory();
    });
  });
})();

/***/ }),

/***/ "./admin/resources/js/contact.js":
/*!***************************************!*\
  !*** ./admin/resources/js/contact.js ***!
  \***************************************/
/***/ (() => {

(function () {
  jQuery(document).ready(function ($) {
    "use strict";

    $("#contactstable").DataTable({
      // processing: true,
      // serverSide: true,
      ajax: {
        url: "../api/contact/getcontact",
        dataType: 'json',
        type: 'get'
      },
      createdRow: function createdRow(row, data, dataIndex) {
        if (data.status === 0) {
          $(row).addClass('badge-light-danger');
        }
      },
      columns: [{
        "data": "id",
        render: function render(data, type, row) {
          return "<p class='counternumber'>Number</p>";
        }
      }, {
        "data": "fullname"
      }, {
        "data": "email"
      }, {
        "data": "phone"
      }, {
        "data": "time"
      }, {
        "data": "status",
        render: function render(data, type, row) {
          if (data == 0) return "<p class='badge bg-danger text-center d-block'>Chưa xem</p>";else return "<p class='badge bg-success text-center d-block'>Đã xem</p>";
        }
      }, {
        "data": null,
        render: function render(data, type, row) {
          // return `<a href="?id=${data.id}" id="moreview">Xem thêm</a>`
          return "<div id=\"moreviewbutton\" class=\"text-center d-block\"><span  class=\"material-symbols-rounded\" style=\"color: #1C3879\">visibility</span></div>"; // return `<button id="moreviewbutton" class="btn btn-success m-1 p-1">Xem</button>`;
        }
      }],
      "order": [[1, 'asc']],
      dom: 'Bfrtip',
      buttons: ['pageLength', {
        extend: 'print',
        download: 'open',
        exportOptions: {
          columns: ':visible'
        },
        customize: function customize(win) {
          console.log($(win.document.body).find('table').eq(1)); // $(win.document.body)
          //     .css('font-size', '10pt')
          //     .prepend(
          //         '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:0; left:0;" />'
          //     );

          $(win.document.body).find('table').addClass('table-bordered').removeClass("table-type-1");
        },
        messageTop: "<span class=\"h5 pt-3 d-block\">Danh s\xE1ch li\xEAn h\u1EC7</span>"
      }, 'colvis'],
      // initComplete: function(settings, json) {
      //     InitLoadSuccess(settings, json);
      // },
      stateSave: true,
      responsive: true,
      aoColumnDefs: [{
        bSortable: false,
        aTargets: [0]
      }],
      orderCellsTop: true,
      fixedHeader: true,
      language: {
        url: "//cdn.datatables.net/plug-ins/1.12.1/i18n/vi.json",
        paginate: {
          next: '»',
          previous: '«'
        }
      }
    }); // count number in table 

    $("#contactstable").on("draw.dt", function () {
      var n = 0;
      $(".counternumber").each(function () {
        $(this).html(++n);
      });
    }); //Thao tác với bảng

    $('#contactstable tbody').on('click', 'tr', function () {
      var data = $("#contactstable").DataTable().row(this).data(); //hiện chổ đã chọn trên bảng

      var selectedcolor = 'selected';

      if ($(this).hasClass(selectedcolor)) {
        $(this).removeClass(selectedcolor);
      } else {
        $("#contactstable tr.selected").removeClass(selectedcolor);
        $(this).addClass(selectedcolor);
      } // alert(data['status']);
      //hiển thị thông tin


      $("#showfullname").html(data['fullname']);
      $("#showemail").html(data['email']);
      $("#showphone").html(data['phone']);
      $("#showcontent").html(data['content']);
      $("#contactModal").modal('show');

      if (data['status'] == 1) {
        $("#seencontact").hide();
        $("#deliveredcontact").show();
      } else {
        $("#seencontact").show();
        $("#deliveredcontact").hide();
      }

      $("#seencontact").on('click', function () {
        var id = data['id'];
        var status = data['status'];
        $.ajax({
          url: "../api/contact/updatestatuscontact",
          type: "post",
          dataType: "text",
          data: {
            id: id,
            status: status
          }
        });
        $("#contactstable").DataTable().ajax.reload();
        $("#contactModal").modal('hide');
      });
      $("#deliveredcontact").on('click', function () {
        var id = data['id'];
        var status = data['status'];
        $.ajax({
          url: "../api/contact/updatestatuscontact",
          type: "post",
          dataType: "text",
          data: {
            id: id,
            status: status
          }
        });
        $("#contactstable").DataTable().ajax.reload();
        $("#contactModal").modal('hide');
      });
    });
  });
})();

/***/ }),

/***/ "./admin/resources/js/main.js":
/*!************************************!*\
  !*** ./admin/resources/js/main.js ***!
  \************************************/
/***/ (() => {

(function () {
  $.noConflict(); // document.addEventListener('contextmenu', event => event.preventDefault());
  // jQuery(window).on('keyup',function (event) {
  // 	if ((event.keyCode === 73 || event.keyCode === 41)  && event.ctrlKey && event.shiftKey) {
  // 		event.preventDefault();
  // 		console.log(event)
  // 		return false;
  // 	}
  // 	console.log(event)
  // });

  jQuery(document).ready(function ($) {
    "use strict";

    $('.equal-height').matchHeight({
      property: 'max-height'
    }); // var chartsheight = $('.flotRealtime2').height();
    // $('.traffic-chart').css('height', chartsheight-122);
    // Counter Number

    $('.count').each(function () {
      $(this).prop('Counter', 0).animate({
        Counter: $(this).text()
      }, {
        duration: 3000,
        easing: 'swing',
        step: function step(now) {
          $(this).text(Math.ceil(now));
        }
      });
    }); // Menu Trigger

    $('#menuToggle').on('click', function (event) {
      var windowWidth = $(window).width();

      if (windowWidth < 1010) {
        $('body').removeClass('open');

        if (windowWidth < 760) {
          $('#left-panel').slideToggle();
        } else {
          $('#left-panel').toggleClass('open-menu');
        }
      } else {
        $('body').toggleClass('open');
        $('#left-panel').removeClass('open-menu');
      }
    });
    $(".menu-item-has-children.dropdown").each(function () {
      $(this).one('click', function () {
        // $(this).toggleClass("show");
        var $temp_text = $(this).children('.dropdown-toggle').html();
        $(this).children('.sub-menu').prepend('<li class="subtitle">' + $temp_text + '</li>');
      });
    }); // $("aside.left-panel .navbar .navbar-nav li.menu-item-has-children .dropdown-toggle").each(function () {
    // 	$(this).on('click', (e) => {
    // 		if ($(this).hasClass("show")) {
    // 			$(this).parent().siblings(".menu-item-has-children").removeClass("show")
    // 			$(this).parent().addClass("show")
    // 		}
    // 	})
    // });
    // Load Resize 

    $(window).on("load resize", function (event) {
      var windowWidth = $(window).width();

      if (windowWidth < 1010) {
        $('body').addClass('small-device');
      } else {
        $('body').removeClass('small-device');
      }
    }); // 
    // var urls = ['/url/one','/url/two'];

    $.ajax({
      type: "get",
      url: "../api/home/getnumberuserandtutorbymonth",
      data: {// numNotification, // lấy giá trị của thuộc tính subject-id
        // offset
      },
      cache: false,
      success: function success(group) {
        console.log(group);
        callbackDataTutorSuccess(group);
      },
      error: function error(xhr, status, _error) {
        console.error(xhr);
      }
    });

    function callbackDataTutorSuccess(group) {
      console.log(group, "callback"); // let month_tutor = group.groupByTutor.map(val =>{
      // 	return val.month
      // });

      var num_user = group.groupByUser.map(function (val) {
        return val.num;
      });
      var num_tutor = group.groupByTutor.map(function (val) {
        return val.num;
      });
      console.log(num_tutor, "group tutor");
      var labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
      var data = {
        labels: labels,
        datasets: [{
          label: 'Gia sư đăng ký',
          backgroundColor: 'rgba(255, 99, 132, 0.2)',
          borderColor: 'rgb(255, 99, 132)',
          data: num_user,
          borderWidth: 1
        }, {
          label: 'Người dùng đăng ký',
          backgroundColor: 'rgba(255, 159, 64, 0.2)',
          borderColor: 'rgb(255, 159, 64)',
          data: num_tutor,
          borderWidth: 1
        }]
      };
      var config = {
        type: 'bar',
        data: data
      };

      if (document.getElementById('tutors-chart')) {
        var myChart = new Chart(document.getElementById('tutors-chart'), config);
      } // if(!data){
      // 	responseNotification = false;
      // 	return;
      // }
      // $(".list-notification").last().append(data);  
      // document.querySelector('#end-notification').scrollIntoView({behavior : "smooth",  block: 'nearest', inline: 'start'})

    } // Đăng xuất


    function logout() {
      $(".logout").on('click', function (e) {
        e.preventDefault();
        console.log($(".logout").attr("href-action"), "$(\".logout\").attr(\"href\")");
        $.ajax({
          type: "post",
          url: "../inc/header",
          data: {
            action: $(".logout").attr("href-action")
          },
          cache: false,
          success: function success(data) {
            // if(data !== '0')
            window.location = "/tutor_webapp/pages/login";
            console.log(data, "data");
          },
          error: function error(xhr, status, _error2) {
            console.log(xhr, _error2, status, "Lỗi");
          }
        });
      });
    }

    logout();
  });
})();

/***/ }),

/***/ "./admin/resources/js/managersubjects.js":
/*!***********************************************!*\
  !*** ./admin/resources/js/managersubjects.js ***!
  \***********************************************/
/***/ (() => {

(function () {
  // data table
  "use-strict";

  jQuery(document).ready(function ($) {
    (function () {
      var subject_table = $('#subject-table').DataTable({
        // data: data,
        processing: true,
        serverSide: true,
        ajax: {
          url: '../api/subjects/getdatasubjects',
          dataType: 'json',
          type: 'get',
          complete: function complete(data) {
            // if (data.add === "success") {
            //     table.ajax.reload(null, false);
            // }
            InitLoadSuccess(); // console.log(data)
          },
          error: function error(xhr, status, _error) {
            console.error(xhr);
          }
        },
        drawCallBack: function drawCallBack(settings) {
          console.log(settings);
        },
        createdRow: function createdRow(row, data, dataIndex) {
          $(row).addClass('subject-row');
        },
        columns: [{
          data: null,
          className: "",
          render: function render(data, type, row) {
            return "<input class=\"form-check-input check-one\" type=\"checkbox\" value=\"".concat(data.Id, "\">");
          }
        }, {
          data: "Id"
        }, {
          data: "Tên môn học",
          render: function render(data, type, row) {
            return "<span class=\"subject-name\">".concat(data, "</span>\n                                                                <form class=\"edit-subject-form d-none\">\n                                                                    <input type=\"hidden\" class=\"form-control id-subject-input\" name=\"id-subject\" value=\"").concat(row.Id, "\">\n\n                                                                    <input type=\"text\" class=\"form-control edit-input\" name=\"subject\" value=\"").concat(data, " \" required>\n\n                                                                </form>");
          }
        }, {
          data: null,
          render: function render(data, type, row) {
            // Combine the first and last names into a single table field
            return "<div class=\"d-inline-flex cursor-pointer \">\n                                                                    <span class=\"badge badge-light-success m-l-10 edit-subject\">\n                                                                        <span class=\"material-symbols-rounded  m-auto\" style=\"color: #3F99EF;font-size: 20px !important;\">\n                                                                            edit_note\n                                                                        </span>\n                                                                    </span>\n                                                                    <span class=\"badge badge-light-danger m-l-10 delete-subject\">\n                                                                        <span class=\"material-symbols-rounded  m-auto\" data-value-id=\"".concat(data.Id, "\" style=\"color: #E73774;font-size: 20px !important; \">\n                                                                            delete\n                                                                        </span>\n                                                                    </span>\n\n                                                                </div>");
          } // defaultContent:,

        }],
        dom: 'Bfrtip',
        buttons: ['pageLength', {
          extend: 'print',
          download: 'open',
          exportOptions: {
            columns: ':visible'
          },
          customize: function customize(win) {
            console.log($(win.document.body).find('table').eq(1)); // $(win.document.body)
            //     .css('font-size', '10pt')
            //     .prepend(
            //         '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:0; left:0;" />'
            //     );

            $(win.document.body).find('table').addClass('table-bordered').removeClass("table-type-1");
          },
          messageTop: "<span class=\"h5 pt-3 d-block\">TH\xD4NG TIN M\xD4N H\u1ECCC</span>"
        }, 'colvis'],
        // initComplete: function(settings, json) {
        //     InitLoadSuccess(settings, json);
        // },
        stateSave: true,
        responsive: true,
        aoColumnDefs: [{
          bSortable: false,
          aTargets: [0]
        }],
        orderCellsTop: true,
        fixedHeader: true,
        language: {
          url: "//cdn.datatables.net/plug-ins/1.12.1/i18n/vi.json",
          paginate: {
            next: '»',
            previous: '«'
          }
        }
      }); // $('#subject-table').on('page.dt', (e) => {
      //     $("#select-all-subject").prop("checked", false);
      //     $("#select-all-subject").removeClass('allChecked');
      // })
      // hàm có tác dụng load dữ liệu bảng thành công mới thực thi hàm
      // mỗi lần chuyển trang là load dòng mới nên DOM cần phải load lại
      // nếu không load lại nó sẽ vô hiệu

      var idx = 0; // console.log(settings)
      // select all

      $('#select-all-subject').on('click', function (e) {
        // idx++
        // console.log("-------------------", idx, "allPage")
        var allPages = subject_table.rows().nodes();
        console.log(allPages);

        if ($(this).hasClass('allChecked')) {
          $('input[type="checkbox"]', allPages).prop('checked', false);
        } else {
          $('input[type="checkbox"]', allPages).prop('checked', true);
        }

        $(this).toggleClass('allChecked');
        return true;
      });

      function InitLoadSuccess() {
        var settings = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
        var json = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
        // xoá sự kiện của từng selector
        // vì bên trong hàm InitLoadSuccess sẽ lặp lại nhiều lần
        // và tạo ra nhiều sự kiện trùng nhau
        $(".edit-subject").off();
        $('.edit-subject-form').off();
        $(".delete-subject").off();
        $("#multiple-delete-subject").off(); // Edit subject
        // Toggle Class

        $(".edit-subject").on('click', function (e) {
          // get tr in table
          var row_subject = $(e.currentTarget).closest(".subject-row");
          var edit_form = row_subject.find("td > .edit-subject-form");
          var span_subject_name = row_subject.find("td > .subject-name"); // show edit form

          edit_form.toggleClass("d-none"); // hide span subject name

          span_subject_name.toggleClass("d-none");
          console.log(edit_form, span_subject_name);
          idx++;
          console.log(idx);
        }); // Edit

        $('.edit-subject-form').on("submit", function (event) {
          event.preventDefault();
          console.log($(event.target).serialize());
          $.ajax({
            type: "post",
            url: "../api/subjects/updatesubject",
            data: $(event.target).serialize(),
            cache: false,
            success: function success(data) {
              if (data.update === "success") {
                $(event.target).toggleClass("d-none");
                $(event.target).prev().toggleClass("d-none").text(data.subject); // 

                Toastify({
                  text: "Cập nhật thành công!",
                  duration: 5000,
                  close: true,
                  gravity: "top",
                  // `top` or `bottom`
                  position: "right",
                  // `left`, `center` or `right`
                  stopOnFocus: true,
                  // Prevents dismissing of toast on hover
                  style: {
                    background: "linear-gradient(to right, #56C596, #7BE495)"
                  },
                  onClick: function onClick() {} // Callback after click

                }).showToast();
              }

              console.log(data);
            },
            error: function error(xhr, status, _error2) {
              console.error(xhr);
            }
          });
        }); // Delete subject

        $(".delete-subject").on('click', function (e) {
          var id_subject = $(e.target).attr("data-value-id");
          console.log();
          $.ajax({
            type: "post",
            url: "../api/subjects/deletesubject",
            data: {
              id_subject: id_subject
            },
            cache: false,
            success: function success(data) {
              if (data["delete"] === "success") {
                subject_table.ajax.reload(null, false);
                Toastify({
                  text: "Xoá thành công!",
                  duration: 5000,
                  close: true,
                  gravity: "top",
                  // `top` or `bottom`
                  position: "right",
                  // `left`, `center` or `right`
                  stopOnFocus: true,
                  // Prevents dismissing of toast on hover
                  style: {
                    background: "linear-gradient(to right, #56C596, #7BE495)"
                  },
                  onClick: function onClick() {} // Callback after click

                }).showToast();
              }

              console.log(data);
            },
            error: function error(xhr, status, _error3) {
              console.error(xhr);
            }
          });
        }); // Delete multiple

        $("#multiple-delete-subject").on('click', function (e) {
          var subject_id_list = [];
          $('input[type="checkbox"]:not(#select-all-subject):checked').each(function (i, elm) {
            subject_id_list.push($(elm).val());
          });
          console.log(subject_id_list);
          $.ajax({
            type: "post",
            url: "../api/subjects/deletesubject",
            data: {
              id_subject: subject_id_list
            },
            cache: false,
            success: function success(data) {
              if (data["delete"] === "success") {
                subject_table.ajax.reload(null, false);
                Toastify({
                  text: "Xoá thành công!",
                  duration: 5000,
                  close: true,
                  gravity: "top",
                  // `top` or `bottom`
                  position: "right",
                  // `left`, `center` or `right`
                  stopOnFocus: true,
                  // Prevents dismissing of toast on hover
                  style: {
                    background: "linear-gradient(to right, #56C596, #7BE495)"
                  },
                  onClick: function onClick() {} // Callback after click

                }).showToast();
              } else if (data["delete"] === "fail") {}

              console.log(data);
            },
            error: function error(xhr, status, _error4) {
              console.error(xhr);
            }
          });
        });
      } // validation form


      var forms = document.querySelectorAll('.needs-validation');
      console.log(forms, "forms"); // Loop over them and prevent submission

      Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }

          form.classList.add('was-validated');
        }, false);
      }); // Add

      $('#add-subject-form').on("submit", function (event) {
        event.preventDefault();
        console.log($(event.target).serialize());

        if (confirm("Bạn chắc chắn muốn thêm những môn học này?") === true) {
          $.ajax({
            type: "post",
            url: "../api/subjects/addsubject",
            data: $(event.target).serialize(),
            cache: false,
            success: function success(data) {
              if (data.add === "success") {
                subject_table.ajax.reload(null, false);
                Toastify({
                  text: "Thêm thành công!",
                  duration: 5000,
                  close: true,
                  gravity: "top",
                  // `top` or `bottom`
                  position: "right",
                  // `left`, `center` or `right`
                  stopOnFocus: true,
                  // Prevents dismissing of toast on hover
                  style: {
                    background: "linear-gradient(to right, #56C596, #7BE495)"
                  },
                  onClick: function onClick() {} // Callback after click

                }).showToast();
              }

              console.log(data);
            },
            error: function error(xhr, status, _error5) {
              console.error(xhr);
            }
          });
        }
      }); // submit textarea (in modal add new)

      $("#control-input-subject").on('keydown', function (e) {
        if (e.which === 13 && !e.shiftKey) {
          e.preventDefault();
          $(e.target).closest("#add-subject-form").submit();
        }
      }); // submit button save-change-subject

      $("#save-change-subject").on('click', function (e) {
        console.log($(e.target).closest(".modal-content").find("#add-subject-form").submit());
      }); // The ctrl+shift N event keyboard was used to display the modal.

      /* var isPress = false;
       var myModal = new bootstrap.Modal(document.getElementById('modalAddSubject'), {
           keyboard: true
       });
       $(document).on("keydown", (event) => {
           // console.log(event)
             if (!isPress && event.ctrlKey && event.shiftKey) {
               isPress = true;
               console.log("ctrl+shift")
               isPress && $(this).on('keydown', (e) => {
                   if (isPress && e.keyCode === 78 || e.keyCode === 110) { // 'A' or 'a'
                       console.log("ctrl+shift N")
                         e.preventDefault() ? e.preventDefault : e.returnValue = false;
                       e.stopPropagation();
                         myModal.show();
                       isPress = false;
                       return false;
                   }
               })
           }
         });*/
    })();
  });
})(jQuery);

/***/ }),

/***/ "./admin/resources/js/modules/image_viewer.js":
/*!****************************************************!*\
  !*** ./admin/resources/js/modules/image_viewer.js ***!
  \****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "image_viewer": () => (/* binding */ image_viewer),
/* harmony export */   "remove_eventListener": () => (/* binding */ remove_eventListener)
/* harmony export */ });
function image_viewer(images_class) {
  jQuery(images_class).on('click', function (e) {
    jQuery("#full-image").attr("src", e.target.src);
    jQuery('#image-viewer').show();
    console.log(e.target);
  });
  jQuery("#image-viewer .close").on('click', function (e) {
    jQuery('#image-viewer').hide();
  });
}
function remove_eventListener(_ref) {
  var event = _ref.event,
      selector = _ref.selector;
  jQuery(selector).off();
} // module.exports = { image_viewer }

/***/ }),

/***/ "./admin/resources/js/page_editpost.js":
/*!*********************************************!*\
  !*** ./admin/resources/js/page_editpost.js ***!
  \*********************************************/
/***/ (() => {

(function () {
  var MyEditor; // data table

  jQuery(document).ready(function ($) {
    document.querySelector('#editor') && ClassicEditor.create(document.querySelector('#editor'), {
      placeholder: 'Nhấn vào đây và hãy viết mô tả chi tiết!'
    }).then(function (editor) {
      var toolbarContainer = document.querySelector('#toolbar-container');
      toolbarContainer === null || toolbarContainer === void 0 ? void 0 : toolbarContainer.appendChild(editor.ui.view.toolbar.element);
      MyEditor = editor;
    })["catch"](function (error) {
      console.error(error);
    });
  }); // $.validator.addMethod("ck_editor", function() {
  //     var content_length = MyEditor.getData().trim().length;
  //     return content_length > 0;
  // }, "Please insert content for the page.");
})(jQuery);

/***/ }),

/***/ "./admin/resources/js/topicmanager.js":
/*!********************************************!*\
  !*** ./admin/resources/js/topicmanager.js ***!
  \********************************************/
/***/ (() => {

(function () {
  // data table
  "use-strict";

  jQuery(document).ready(function ($) {
    // subject topics
    (function () {
      var subject_topic_table = $('#subject-topic-table').DataTable({
        // data: data,
        processing: true,
        serverSide: true,
        ajax: {
          url: '../api/subjecttopics/getdatasubjecttopics',
          dataType: 'json',
          type: 'get',
          complete: function complete(data) {
            // if (data.add === "success") {
            //     table.ajax.reload(null, false);
            // }
            InitLoadSuccess();
            console.log(data);
          },
          cache: false,
          error: function error(xhr, status, _error) {
            console.error(xhr);
          }
        },
        drawCallBack: function drawCallBack(settings) {
          console.log(settings);
        },
        createdRow: function createdRow(row, data, dataIndex) {
          $(row).addClass('subject-row');
        },
        columns: [{
          data: "id",
          className: "",
          render: function render(data, type, row) {
            if (type === "display") {
              return "<input class=\"form-check-input check-one\" type=\"checkbox\" value=\"".concat(data, "\">");
            }

            return data;
          }
        }, {
          data: "id",
          render: function render(data, type, row) {
            if (type === 'display') {
              return "<span class=\"topic-id\"> ".concat(data, "</span>");
            }

            return data;
          }
        }, {
          data: "subject",
          render: function render(data, type, row) {
            if (type === "display") {
              return "<span class=\"subject-name\">".concat(data, "</span>\n                                                                <form class=\"edit-subject-form d-none\">\n\n\n                                                                    <div class=\"form-group col-sm-8 flex-column d-flex mb-3\">\n\n                                                                        <select class=\"js-data-subjects-ajax-edit select2bs5\" name=\"subject-id\">\n\n\n                                                                        </select>\n\n                                                                    </div>\n\n                                                                </form>");
            }

            return data;
          }
        }, {
          data: "topicName",
          render: function render(data, type, row, meta) {
            // console.log(meta)
            if (type === "display") {
              return "<span class=\"topic-name\">".concat(data, "</span>\n                                                                <form class=\"edit-subject-topic-form d-none\">\n\n                                                                    <input type=\"text\" class=\"form-control edit-input\" name=\"subject-topic\" value=\"").concat(data, " \" required>\n\n                                                                </form>");
            }

            return data;
          }
        }, {
          data: "id",
          render: function render(data, type, row) {
            // Combine the first and last names into a single table field
            if (type === "display") {
              return "<div class=\"d-inline-flex cursor-pointer \">\n                                                                    <span class=\"badge badge-light-success m-l-10 edit-subject-topic\">\n                                                                        <span class=\"material-symbols-rounded  m-auto\" style=\"color: #3F99EF;font-size: 20px !important;\">\n                                                                            edit_note\n                                                                        </span>\n                                                                    </span>\n                                                                    <span class=\"badge badge-light-danger m-l-10 delete-subject-topic\">\n                                                                        <span class=\"material-symbols-rounded  m-auto\" data-value-id=\"".concat(data, "\" style=\"color: #E73774;font-size: 20px !important; \">\n                                                                            delete\n                                                                        </span>\n                                                                    </span>\n\n                                                                </div>");
            }

            return null;
          } // defaultContent:,

        }],
        initComplete: function initComplete(settings, json) {
          // InitLoadSuccess(settings, json);
          console.log(settings);
        },
        dom: 'Bfrtip',
        buttons: ['pageLength', {
          extend: 'print',
          download: 'open',
          exportOptions: {
            columns: ':visible'
          },
          customize: function customize(win) {
            console.log($(win.document.body).find('table').eq(1)); // $(win.document.body)
            //     .css('font-size', '10pt')
            //     .prepend(
            //         '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:0; left:0;" />'
            //     );

            $(win.document.body).find('table').addClass('table-bordered').removeClass("table-type-1");
          },
          messageTop: "<span class=\"h5 pt-3 d-block\">TH\xD4NG TIN CH\u1EE6 \u0110\u1EC0 M\xD4N H\u1ECCC</span>"
        }, 'colvis'],
        // stateSave: true,
        responsive: true,
        aoColumnDefs: [{
          bSortable: false,
          aTargets: [0]
        }],
        orderCellsTop: true,
        fixedHeader: true,
        language: {
          url: "//cdn.datatables.net/plug-ins/1.12.1/i18n/vi.json",
          paginate: {
            next: '»',
            previous: '«'
          }
        }
      });
      select2_ajax('.js-data-subjects-ajax', null, '../api/subjects/getsubjectjointopicbyquery', function (params) {
        var query = {
          q: params.term,
          num: !params.term && 'all'
        }; // Query parameters will be ?search=[term]&type=public

        return query;
      }, function (data, params) {
        // Transforms the top-level key of the response object from 'items' to 'results'
        return {
          results: data
        };
      });
      $('.js-data-subjects-ajax').on('change', function (e) {
        subject_topic_table.columns(2).search($(this).select2('data')[0].text).draw();
        console.log($(this).select2('data')[0].text);
      }); // $('#subject-table').on('page.dt', (e) => {
      //     $("#select-all-subject").prop("checked", false);
      //     $("#select-all-subject").removeClass('allChecked');
      // })
      // var idx = 0;
      // // console.log(settings)
      // select all

      $('#subject-topic-table #select-all').on('click', function (e) {
        // idx++
        // console.log("-------------------", idx, "allPage")
        var allPages = subject_topic_table.rows().nodes();
        console.log(allPages);

        if ($(this).hasClass('allChecked')) {
          $('input[type="checkbox"]', allPages).prop('checked', false);
        } else {
          $('input[type="checkbox"]', allPages).prop('checked', true);
        }

        $(this).toggleClass('allChecked');
        return true;
      });

      function select2_ajax(selector, dropdownParent, urlAjax, dataAjax, processResultsAjax) {
        var select2 = $(selector).select2({
          theme: 'bootstrap-5',
          language: "vi",
          dropdownParent: dropdownParent,
          ajax: {
            url: urlAjax,
            type: "post",
            dataType: 'json',
            delay: 250,
            data: dataAjax,
            processResults: processResultsAjax,
            cache: true
          },
          placeholder: 'Gõ chữ bất kì để tìm chủ đề',
          minimumInputLength: 0 // templateResult: formatRepo,
          // templateSelection: formatRepoSelection

        }).on("select2:close", function (e) {// validation select2
          // $(this).valid();
        });
        return select2;
      }

      select2_ajax('.js-data-subject-topic-ajax', $("#modalAddSubjectTopic"), '../api/subjects/getsubjectbyquery', function (params) {
        var query = {
          q: params.term,
          num: !params.term && 'all'
        }; // Query parameters will be ?search=[term]&type=public

        return query;
      }, function (data, params) {
        console.log(data); // Transforms the top-level key of the response object from 'items' to 'results'

        return {
          results: data
        };
      }); // call select2 (subject in modal)
      // // hàm có tác dụng load dữ liệu bảng thành công mới thực thi hàm
      // // mỗi lần chuyển trang là load dòng mới nên DOM cần phải load lại
      // // nếu không load lại nó sẽ vô hiệu

      function InitLoadSuccess() {
        var settings = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
        var json = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
        //     // xoá sự kiện của từng selector
        //     // vì bên trong hàm InitLoadSuccess sẽ lặp lại nhiều lần
        //     // và tạo ra nhiều sự kiện trùng nhau
        $(".edit-subject-topic").off();
        $('.edit-topic-form').off();
        $(".delete-subject-topic").off();
        $("#subject-topic #multiple-delete").off(); // $('.js-data-subject-topic-ajax').select2('destroy');
        // Edit subject topic
        // gọi hàm này khi bấm vào nút edit
        // Toggle Class

        $(".edit-subject-topic").on('click', function (e) {
          // get tr in table
          var row_subject = $(e.currentTarget).closest(".subject-row");
          var edit_subject_form = row_subject.find("td > .edit-subject-form");
          var edit_topic_form = row_subject.find("td > .edit-subject-topic-form");
          var span_subject_name = row_subject.find("td > .subject-name");
          var span_topic_name = row_subject.find("td > .topic-name"); // show edit form

          var select_subject_edit = $(e.target).closest("tr").find(".js-data-subjects-ajax-edit");
          select2_ajax(select_subject_edit, null, '../api/subjects/getsubjectbyquery', function (params) {
            var query = {
              q: params.term,
              num: !params.term && 'all'
            }; // Query parameters will be ?search=[term]&type=public

            return query;
          }, function (data, params) {
            console.log(data); // Transforms the top-level key of the response object from 'items' to 'results'

            return {
              results: data
            };
          });
          console.log(select_subject_edit, $(span_subject_name).text());
          $.ajax({
            type: 'post',
            url: '../api/subjects/getsubjectbyquery',
            data: {
              q: $(span_subject_name).text(),
              num: "all"
            }
          }).then(function (data) {
            // create the option and append to Select2
            console.log(data[0].text, "đỉnh thật");
            var option = new Option(data[0].text, data[0].id, true, true);
            select_subject_edit.append(option).trigger('change'); // manually trigger the `select2:select` event

            select_subject_edit.trigger({
              type: 'select2:select',
              params: {
                data: data
              }
            });
          });
          console.log("sos"); // $(form).on("submit", (event) => {
          //     event.preventDefault();

          edit_subject_form.toggleClass("d-none");
          edit_topic_form.toggleClass("d-none"); //     console.log($(event.target).serialize())

          $(edit_topic_form).off().on('submit', function (e) {
            e.preventDefault();
            var topic_id = $(row_subject).find(".topic-id").text();
            var subject_id = $(edit_subject_form).find("select").val();
            var topic_name = $(edit_topic_form).find("input").val();
            console.log(subject_id, topic_name, topic_id, "di");
            $.ajax({
              type: "post",
              url: "../api/subjecttopics/updatesubjecttopic",
              data: {
                topic_id: topic_id,
                subject_id: subject_id,
                topic_name: topic_name
              },
              cache: false,
              success: function success(data) {
                if (data.update === "success") {
                  subject_topic_table.ajax.reload(null, false);
                  Toastify({
                    text: "Cập nhật thành công!",
                    duration: 5000,
                    close: true,
                    gravity: "top",
                    // `top` or `bottom`
                    position: "right",
                    // `left`, `center` or `right`
                    stopOnFocus: true,
                    // Prevents dismissing of toast on hover
                    style: {
                      background: "linear-gradient(to right, #56C596, #7BE495)"
                    },
                    onClick: function onClick() {} // Callback after click

                  }).showToast();
                  $(select_subject_edit).select2('destroy');
                  edit_subject_form.toggleClass("d-none");
                  edit_topic_form.toggleClass("d-none");
                }

                console.log(data);
              },
              error: function error(xhr, status, _error2) {
                console.error(xhr);
              }
            });
          }); // });
          // console.log(form)
          // hide span subject name

          span_subject_name.toggleClass("d-none");
          span_topic_name.toggleClass("d-none");
          console.log(edit_subject_form, span_subject_name); // idx++;
          // console.log(idx)
        }); // Edit
        //     // Delete subject

        $(".delete-subject-topic").on('click', function (e) {
          var id_subject_topic = $(e.target).attr("data-value-id");
          console.log();
          $.ajax({
            type: "post",
            url: "../api/subjecttopics/deletesubjecttopics",
            data: {
              id_subject_topic: id_subject_topic
            },
            cache: false,
            success: function success(data) {
              if (data["delete"] === "success") {
                subject_topic_table.ajax.reload(null, false);
                Toastify({
                  text: "Xoá thành công!",
                  duration: 5000,
                  close: true,
                  gravity: "top",
                  // `top` or `bottom`
                  position: "right",
                  // `left`, `center` or `right`
                  stopOnFocus: true,
                  // Prevents dismissing of toast on hover
                  style: {
                    background: "linear-gradient(to right, #56C596, #7BE495)"
                  },
                  onClick: function onClick() {} // Callback after click

                }).showToast();
              }

              console.log(data);
            },
            error: function error(xhr, status, _error3) {
              console.error(xhr);
            }
          });
        }); // Delete multiple

        $("#multiple-delete").on('click', function (e) {
          var subject_topic_id_list = [];
          $('input[type="checkbox"]:not(#subject-topic-table #select-all):checked').each(function (i, elm) {
            subject_topic_id_list.push($(elm).val());
          });
          console.log(subject_topic_id_list, "subject_topic_id_list");
          $.ajax({
            type: "post",
            url: "../api/subjecttopics/deletesubjecttopics",
            data: {
              id_subject_topic: subject_topic_id_list
            },
            cache: false,
            success: function success(data) {
              if (data["delete"] === "success") {
                Toastify({
                  text: "Xoá thành công!",
                  duration: 5000,
                  close: true,
                  gravity: "top",
                  // `top` or `bottom`
                  position: "right",
                  // `left`, `center` or `right`
                  stopOnFocus: true,
                  // Prevents dismissing of toast on hover
                  style: {
                    background: "linear-gradient(to right, #56C596, #7BE495)"
                  },
                  onClick: function onClick() {} // Callback after click

                }).showToast();
                subject_topic_table.ajax.reload(null, false);
              } else if (data["delete"] === "fail") {}

              console.log(data);
            },
            error: function error(xhr, status, _error4) {
              console.error(xhr);
            }
          });
        }); // }
        // // validation form
        // var forms = document.querySelectorAll('.needs-validation')
        // console.log(forms, "forms");
        // // Loop over them and prevent submission
        // Array.prototype.slice.call(forms)
        //     .forEach(function(form) {
        //         form.addEventListener('submit', function(event) {
        //             if (!form.checkValidity()) {
        //                 event.preventDefault()
        //                 event.stopPropagation()
        //             }
        //             form.classList.add('was-validated')
        //         }, false)
        //     });
        // // Add
      } // end init


      $('#add-subject-topic-form').on("submit", function (event) {
        event.preventDefault();
        console.log($(event.target).serialize());

        if (confirm("Bạn chắc chắn muốn thêm những chủ đề môn học này?") === true) {
          $.ajax({
            type: "post",
            url: "../api/subjecttopics/addsubjecttopics",
            data: $(event.target).serialize(),
            cache: false,
            success: function success(data) {
              if (data.add === "success") {
                subject_topic_table.ajax.reload(null, false);
                Toastify({
                  text: "Thêm thành công!",
                  duration: 5000,
                  close: true,
                  gravity: "top",
                  // `top` or `bottom`
                  position: "right",
                  // `left`, `center` or `right`
                  stopOnFocus: true,
                  // Prevents dismissing of toast on hover
                  style: {
                    background: "linear-gradient(to right, #56C596, #7BE495)"
                  },
                  onClick: function onClick() {} // Callback after click

                }).showToast();
              }

              console.log(data);
            },
            error: function error(xhr, status, _error5) {
              console.error(xhr);
            }
          });
        }
      }); // submit textarea (in modal add new)

      $("#control-input-subject-topic").on('keydown', function (e) {
        if (e.which === 13 && !e.shiftKey) {
          e.preventDefault();
          $(e.target).closest("#add-subject-topic-form").submit();
        }
      }); // submit button save-change-subject

      $("#save-change-subject-topic").on('click', function (e) {
        console.log($(e.target).closest(".modal-content").find("#add-subject-topic-form").submit());
      }); // The ctrl+shift N event keyboard was used to display the modal.
    })();
  });
})(jQuery);

/***/ }),

/***/ "./admin/resources/js/tutormanagers.js":
/*!*********************************************!*\
  !*** ./admin/resources/js/tutormanagers.js ***!
  \*********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _modules_image_viewer_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./modules/image_viewer.js */ "./admin/resources/js/modules/image_viewer.js");


(function () {
  // data table
  "use-strict";

  jQuery(document).ready(function ($) {
    (function () {
      var tutor_table = $('#tutor-table').DataTable({
        // data: data,
        processing: true,
        serverSide: true,
        ajax: {
          url: '../api/tutors/getdatasubjecttopics',
          dataType: 'json',
          type: 'get',
          complete: function complete(data) {
            // if (data.add === "success") {
            //     table.ajax.reload(null, false);
            // }
            InitLoadSuccess();
            console.log(data);
          },
          error: function error(xhr, status, _error) {
            console.error(xhr);
          }
        },
        drawCallBack: function drawCallBack(settings) {
          console.log(settings);
        },
        createdRow: function createdRow(row, data, dataIndex) {
          $(row).addClass('subject-row');
        },
        columns: [{
          data: "id",
          className: "",
          render: function render(data, type, row) {
            return "<input class=\"form-check-input check-one\" type=\"checkbox\" value=\"".concat(data, "\">");
          }
        }, {
          data: null,
          render: function render(data, type, row) {
            if (type === "display") {
              return "<div class=\"round-img\">\n                                            <a href=\"#\"><img class=\"rounded\" src=\"".concat(row.image ? "../../public/" + row.image : "https://www.bootdey.com/img/Content/avatar/avatar5.png", "\" alt=\"\"></a>\n                                        </div>");
            }

            return data;
          }
        }, {
          data: "last_name",
          render: function render(data, type, row) {
            if (type === "display") {
              return "<span class=\"text-dark d-block\">".concat(data, "</span>");
            }

            return data;
          }
        }, {
          data: "first_name",
          render: function render(data, type, row) {
            if (type === "display") {
              return "<span class=\"text-dark d-block\">".concat(data, "</span>");
            }

            return data;
          }
        }, {
          data: "current_job",
          render: function render(data, type, row) {
            console.log(row, "row");

            if (type === "display") {
              return "<span class=\"text-dark d-block\">".concat(data, "</span>");
            }

            return data;
          }
        }, {
          data: "current_place",
          render: function render(data, type, row) {
            console.log(row, "row");

            if (type === "display") {
              return "<span class=\"text-dark d-block\">".concat(data, "</span>");
            }

            return data;
          }
        }, {
          data: "teaching_area",
          render: function render(data, type, row) {
            console.log(row, "row");

            if (type === "display") {
              return "<span class=\"text-dark d-block\">".concat(data, "</span>");
            }

            return data;
          }
        }, {
          data: "teaching_form",
          render: function render(data, type, row) {
            // Combine the first and last names into a single table field
            if (type === "display") {
              var teaching_form = "";
              var array_teaching_form = data.replace(/\s/g, '').split(",");
              array_teaching_form.map(function (val) {
                if (val === '0') teaching_form += "Trực tiếp" + ', ';
                if (val === '1') teaching_form += "Trực tuyến" + ', ';
              }); // console.log(array_teaching_form)

              return "<span class=\"text-muted fs-6 limit-text p-t-012\">\n                                            ".concat(teaching_form, "                        \n                                        </span>");
            }

            return data;
          }
        }, {
          data: null,
          render: function render(data, type, row) {
            // Combine the first and last names into a single table field
            return "<span class=\"badge ".concat(data.tutor_status === 1 ? "badge-light-success" : "badge-light-danger", " approval d-block mx-2\" data-value-id=").concat(row.id, " data-bs-toggle=\"modal\" data-bs-target=\"#modal-tutor-detail\">").concat(data.tutor_status === 1 ? "Đã duyệt" : "Chưa duyệt", "</span>");
          } // defaultContent:,

        }],
        // initComplete: function(settings, json) {
        //     InitLoadSuccess(settings, json);
        // },,
        dom: 'Bfrtip',
        buttons: ['pageLength', {
          extend: 'print',
          download: 'open',
          exportOptions: {
            columns: ':visible'
          },
          customize: function customize(win) {
            console.log($(win.document.body).find('table').eq(1)); // $(win.document.body)
            //     .css('font-size', '10pt')
            //     .prepend(
            //         '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:0; left:0;" />'
            //     );

            $(win.document.body).find('table').addClass('table-bordered').removeClass("table-type-1");
          },
          messageTop: "<span class=\"h5 pt-3 d-block\">TH\xD4NG TIN GIA S\u01AF</span>"
        }, 'colvis'],
        stateSave: true,
        responsive: true,
        aoColumnDefs: [{
          bSortable: false,
          aTargets: [0]
        }],
        orderCellsTop: true,
        fixedHeader: true,
        language: {
          url: "//cdn.datatables.net/plug-ins/1.12.1/i18n/vi.json",
          paginate: {
            next: '»',
            previous: '«'
          }
        }
      }); // $('#tutor-table').on('page.dt', (e) => {
      //     $("#select-all-tutor").prop("checked", false);
      //     $("#select-all-tutor").removeClass('allChecked');
      // })
      // hàm có tác dụng load dữ liệu bảng thành công mới thực thi hàm
      // mỗi lần chuyển trang là load dòng mới nên DOM cần phải load lại
      // nếu không load lại nó sẽ vô hiệu
      // var idx = 0;
      // console.log(settings)
      // select all

      $('#select-all-tutor').on('click', function (e) {
        // idx++
        // console.log("-------------------", idx, "allPage")
        var allPages = tutor_table.rows().nodes();
        console.log($(this).hasClass('allChecked'));

        if ($(this).hasClass('allChecked')) {
          $('input[type="checkbox"]', allPages).prop('checked', false);
        } else {
          $('input[type="checkbox"]', allPages).prop('checked', true);
        }

        $(this).toggleClass('allChecked');
        return true;
      });
      console.log($('#select-all-tutor'), "$('#select-all-tutor')");

      function InitLoadSuccess() {
        var settings = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
        var json = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
        $("#update-approval-tutor").off();
        $(".approval").on('click', function (e) {
          var id = $(e.target).attr("data-value-id");
          $.ajax({
            type: "post",
            url: "../api/tutors/gettutordetailsforadmin",
            data: {
              id: id
            },
            cache: false,
            success: function success(data) {
              // if (data.delete === "success") {
              //     subject_topic_table.ajax.reload(null, false);
              // }
              $("#modal-tutor-detail .modal-body").html(data);
              $("#update-approval-tutor").attr("data-id", id);
              (0,_modules_image_viewer_js__WEBPACK_IMPORTED_MODULE_0__.image_viewer)(".image-certificate");
              console.log(data);
            },
            error: function error(xhr, status, _error2) {
              console.error(xhr);
            }
          });
        }); // update approval tutor

        $("#update-approval-tutor").on('click', function (e) {
          var id = $(e.target).attr("data-id");
          $.ajax({
            type: "post",
            url: "../api/tutors/updateapprovaltutor",
            data: {
              id: id
            },
            cache: false,
            success: function success(data) {
              if (data.update === "success") {
                tutor_table.ajax.reload(null, false); // 

                Toastify({
                  text: data.message,
                  duration: 3000,
                  close: true,
                  gravity: "top",
                  // `top` or `bottom`
                  position: "right",
                  // `left`, `center` or `right`
                  stopOnFocus: true,
                  // Prevents dismissing of toast on hover
                  style: {
                    background: "linear-gradient(to right, #56C596, #7BE495)"
                  },
                  onClick: function onClick() {} // Callback after click

                }).showToast();
              }

              console.log(data);
            },
            error: function error(xhr, status, _error3) {
              console.error(xhr);
            }
          });
        });
      }

      var review_modal = document.getElementById('modal-tutor-detail');
      review_modal === null || review_modal === void 0 ? void 0 : review_modal.addEventListener('hidden.bs.modal', function (event) {
        (0,_modules_image_viewer_js__WEBPACK_IMPORTED_MODULE_0__.remove_eventListener)({
          event: 'click',
          selector: '#image-viewer .close'
        });
        (0,_modules_image_viewer_js__WEBPACK_IMPORTED_MODULE_0__.remove_eventListener)({
          event: 'click',
          selector: '.image-certificate'
        });
      });
      /*
                                        // validation form
                                      var forms = document.querySelectorAll('.needs-validation')
                                      console.log(forms, "forms");
                                      // Loop over them and prevent submission
                                      Array.prototype.slice.call(forms)
                                          .forEach(function(form) {
                                              form.addEventListener('submit', function(event) {
                                                  if (!form.checkValidity()) {
                                                      event.preventDefault()
                                                      event.stopPropagation()
                                                  }
                                                    form.classList.add('was-validated')
                                              }, false)
                                          });
                                        // Add
                                        $('#add-subject-form').on("submit", (event) => {
                                          event.preventDefault();
                                              console.log($(event.target).serialize())
                                          if (confirm("Bạn chắc chắn muốn thêm những môn học này?") === true) {
                                              $.ajax({
                                                  type: "post",
                                                  url: "../api/subjects/addsubject",
                                                  data: $(event.target).serialize(),
                                                  cache: false,
                                                  success: function(data) {
                                                        if (data.add === "success") {
                                                          subject_table.ajax.reload(null, false);
                                                        }
                                                        console.log(data)
                                                  },
                                                  error: function(xhr, status, error) {
                                                      console.error(xhr);
                                                  }
                                              });
                                          }
                                        });
                                        // submit textarea (in modal add new)
                                      $("#control-input-subject").on('keydown', (e) => {
                                          if (e.which === 13 && !e.shiftKey) {
                                              e.preventDefault();
                                              $(e.target).closest("#add-subject-form").submit();
                                          }
                                      });
                                      // submit button save-change-subject
                                        $("#save-change-subject").on('click', (e) => {
                                          console.log($(e.target).closest(".modal-content").find("#add-subject-form").submit());
                                      });*/
      // The ctrl+shift N event keyboard was used to display the modal.

      /* var isPress = false;
       var myModal = new bootstrap.Modal(document.getElementById('modalAddSubject'), {
           keyboard: true
       });
       $(document).on("keydown", (event) => {
           // console.log(event)
             if (!isPress && event.ctrlKey && event.shiftKey) {
               isPress = true;
               console.log("ctrl+shift")
               isPress && $(this).on('keydown', (e) => {
                   if (isPress && e.keyCode === 78 || e.keyCode === 110) { // 'A' or 'a'
                       console.log("ctrl+shift N")
                         e.preventDefault() ? e.preventDefault : e.returnValue = false;
                       e.stopPropagation();
                         myModal.show();
                       isPress = false;
                       return false;
                   }
               })
           }
         });*/
    })();
  });
})(jQuery);

/***/ }),

/***/ "./admin/resources/js/usermanager.js":
/*!*******************************************!*\
  !*** ./admin/resources/js/usermanager.js ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _modules_image_viewer_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./modules/image_viewer.js */ "./admin/resources/js/modules/image_viewer.js");


(function () {
  // data table
  "use-strict";

  jQuery(document).ready(function ($) {
    (function () {
      var tutor_table = $('#user-table').DataTable({
        // data: data,
        processing: true,
        serverSide: true,
        ajax: {
          url: '../api/users/getdatausers',
          dataType: 'json',
          type: 'get',
          complete: function complete(data) {
            // if (data.add === "success") {
            //     table.ajax.reload(null, false);
            // }
            InitLoadSuccess();
            console.log(data);
          },
          error: function error(xhr, status, _error) {
            console.error(xhr);
          }
        },
        drawCallBack: function drawCallBack(settings) {
          console.log(settings);
        },
        createdRow: function createdRow(row, data, dataIndex) {
          if (data.status === 0) {
            $(row).addClass('badge-light-danger');
          }

          $(row).addClass('subject-row');
        },
        columns: [{
          data: "Id",
          className: "",
          render: function render(data, type, row) {
            return "<input class=\"form-check-input check-one\" type=\"checkbox\" value=\"".concat(data, "\">");
          }
        }, {
          data: null,
          render: function render(data, type, row) {
            if (type === "display") {
              return "<div class=\"round-img\">\n                                            <a href=\"#\"><img class=\"rounded\" src=\"".concat(row.image ? "../../public/" + row.image : "https://www.bootdey.com/img/Content/avatar/avatar5.png", "\" alt=\"\"></a>\n                                        </div>");
            }

            return data;
          }
        }, {
          data: "last_name",
          render: function render(data, type, row) {
            if (type === "display") {
              return "<span class=\"text-dark d-block\">".concat(data, "</span>");
            }

            return data;
          }
        }, {
          data: "first_name",
          render: function render(data, type, row) {
            if (type === "display") {
              return "<span class=\"text-dark d-block\">".concat(data, "</span>");
            }

            return data;
          }
        }, {
          data: "username",
          render: function render(data, type, row) {
            console.log(row, "row");

            if (type === "display") {
              return "<span class=\"text-dark d-block\">".concat(data, "</span>");
            }

            return data;
          }
        }, {
          data: "sex",
          render: function render(data, type, row) {
            console.log(row, "row");

            if (type === "display") {
              return "<span class=\"text-dark d-block\">".concat(data === 1 ? "Nam" : "Nữ", "</span>");
            }

            return data;
          }
        }, {
          data: "account_roles",
          render: function render(data, type, row) {
            console.log(row, "row");

            if (type === "display") {
              return "<span class=\"text-dark d-block\">".concat(data, "</span>");
            }

            return data;
          }
        }, {
          data: null,
          className: "",
          render: function render(data, type, row) {
            // Combine the first and last names into a single table field
            return "<div class=\"form-check form-switch d-flex justify-content-center\">\n                                        <input class=\"form-check-input users-active\" type=\"checkbox\" role=\"switch\" id=\"flexSwitchCheckActiveUser".concat(data.Id.substring(9, 13), "\" ").concat(data.status === 1 ? "checked" : "", " data-id=\"").concat(data.Id, "\">\n                                        <label class=\"form-check-label\" for=\"flexSwitchCheckActiveUser").concat(data.Id.substring(9, 13), "\"></label>\n                                    </div>");
          } // defaultContent:,

        }],
        // initComplete: function(settings, json) {
        //     InitLoadSuccess(settings, json);
        // },,
        dom: 'Bfrtip',
        buttons: ['pageLength', {
          extend: 'print',
          download: 'open',
          exportOptions: {
            columns: ':visible'
          },
          customize: function customize(win) {
            console.log($(win.document.body).find('table').eq(1)); // $(win.document.body)
            //     .css('font-size', '10pt')
            //     .prepend(
            //         '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:0; left:0;" />'
            //     );

            $(win.document.body).find('table').addClass('table-bordered').removeClass("table-type-1");
          },
          messageTop: "<span class=\"h5 pt-3 d-block\">TH\xD4NG TIN T\xC0I KHO\u1EA2N NG\u01AF\u1EDCI D\xD9NG</span>"
        }, 'colvis'],
        stateSave: true,
        responsive: true,
        aoColumnDefs: [{
          bSortable: false,
          aTargets: [0]
        }],
        orderCellsTop: true,
        fixedHeader: true,
        language: {
          url: "//cdn.datatables.net/plug-ins/1.12.1/i18n/vi.json",
          paginate: {
            next: '»',
            previous: '«'
          }
        }
      }); // $('#user-table').on('page.dt', (e) => {
      //     $("#select-all-user").prop("checked", false);
      //     $("#select-all-user").removeClass('allChecked');
      // })
      // hàm có tác dụng load dữ liệu bảng thành công mới thực thi hàm
      // mỗi lần chuyển trang là load dòng mới nên DOM cần phải load lại
      // nếu không load lại nó sẽ vô hiệu
      // var idx = 0;
      // console.log(settings)
      // select all

      $('#select-all-user').on('click', function (e) {
        // idx++
        // console.log("-------------------", idx, "allPage")
        var allPages = tutor_table.rows().nodes();
        console.log(allPages);

        if ($(this).hasClass('allChecked')) {
          $('input[type="checkbox"]', allPages).prop('checked', false);
        } else {
          $('input[type="checkbox"]', allPages).prop('checked', true);
        }

        $(this).toggleClass('allChecked');
        return true;
      });

      function InitLoadSuccess() {
        var settings = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
        var json = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
        // $(".approval").on('click', (e) => {
        //     let id = $(e.target).attr("data-value-id");
        //     $.ajax({
        //         type: "post",
        //         url: "../api/tutors/gettutordetailsforadmin",
        //         data: {
        //             id
        //         },
        //         cache: false,
        //         success: function(data) {
        //             // if (data.delete === "success") {
        //             //     subject_topic_table.ajax.reload(null, false);
        //             // }
        //             $("#modal-user-detail .modal-body").html(data);
        //             $("#users-active").attr("data-id", id);
        //             image_viewer(".image-certificate");
        //             console.log(data)
        //         },
        //         error: function(xhr, status, error) {
        //             console.error(xhr);
        //         }
        //     });
        // });
        // update approval tutor
        $(".users-active").off();
        $(".users-active").on('click', function (e) {
          var id = $(e.target).attr("data-id");
          var isActive = $(e.target).prop("checked") ? 1 : 0;
          console.log(id, isActive, "ID");
          $.ajax({
            type: "post",
            url: "../api/users/updateactiveuser",
            data: {
              id: id,
              isActive: isActive
            },
            cache: false,
            success: function success(data) {
              if (data.update === "success") {
                tutor_table.ajax.reload(null, false); // 

                Toastify({
                  text: data.message,
                  duration: 3000,
                  close: true,
                  gravity: "top",
                  // `top` or `bottom`
                  position: "right",
                  // `left`, `center` or `right`
                  stopOnFocus: true,
                  // Prevents dismissing of toast on hover
                  style: {
                    background: "linear-gradient(to right, #56C596, #7BE495)"
                  },
                  onClick: function onClick() {} // Callback after click

                }).showToast();
              }

              console.log(data);
            },
            error: function error(xhr, status, _error2) {
              console.error(xhr);
            }
          });
        });
      } // var review_modal = document.getElementById('modal-user-detail');
      // review_modal?.addEventListener('hidden.bs.modal', function(event) {
      //     remove_eventListener({
      //        event: 'click',
      //        selector: '#image-viewer .close'
      //     });
      //     remove_eventListener({
      //        event: 'click',
      //        selector: '.image-certificate'
      //     })
      // });

      /*
                                        // validation form
                                      var forms = document.querySelectorAll('.needs-validation')
                                      console.log(forms, "forms");
                                      // Loop over them and prevent submission
                                      Array.prototype.slice.call(forms)
                                          .forEach(function(form) {
                                              form.addEventListener('submit', function(event) {
                                                  if (!form.checkValidity()) {
                                                      event.preventDefault()
                                                      event.stopPropagation()
                                                  }
                                                    form.classList.add('was-validated')
                                              }, false)
                                          });
                                        // Add
                                        $('#add-subject-form').on("submit", (event) => {
                                          event.preventDefault();
                                              console.log($(event.target).serialize())
                                          if (confirm("Bạn chắc chắn muốn thêm những môn học này?") === true) {
                                              $.ajax({
                                                  type: "post",
                                                  url: "../api/subjects/addsubject",
                                                  data: $(event.target).serialize(),
                                                  cache: false,
                                                  success: function(data) {
                                                        if (data.add === "success") {
                                                          subject_table.ajax.reload(null, false);
                                                        }
                                                        console.log(data)
                                                  },
                                                  error: function(xhr, status, error) {
                                                      console.error(xhr);
                                                  }
                                              });
                                          }
                                        });
                                        // submit textarea (in modal add new)
                                      $("#control-input-subject").on('keydown', (e) => {
                                          if (e.which === 13 && !e.shiftKey) {
                                              e.preventDefault();
                                              $(e.target).closest("#add-subject-form").submit();
                                          }
                                      });
                                      // submit button save-change-subject
                                        $("#save-change-subject").on('click', (e) => {
                                          console.log($(e.target).closest(".modal-content").find("#add-subject-form").submit());
                                      });*/
      // The ctrl+shift N event keyboard was used to display the modal.

      /* var isPress = false;
       var myModal = new bootstrap.Modal(document.getElementById('modalAddSubject'), {
           keyboard: true
       });
       $(document).on("keydown", (event) => {
           // console.log(event)
             if (!isPress && event.ctrlKey && event.shiftKey) {
               isPress = true;
               console.log("ctrl+shift")
               isPress && $(this).on('keydown', (e) => {
                   if (isPress && e.keyCode === 78 || e.keyCode === 110) { // 'A' or 'a'
                       console.log("ctrl+shift N")
                         e.preventDefault() ? e.preventDefault : e.returnValue = false;
                       e.stopPropagation();
                         myModal.show();
                       isPress = false;
                       return false;
                   }
               })
           }
         });*/

    })();
  });
})(jQuery);

/***/ }),

/***/ "./resources/js/post.js":
/*!******************************!*\
  !*** ./resources/js/post.js ***!
  \******************************/
/***/ (() => {

(function () {
  jQuery(document).ready(function ($) {
    $.extend({
      getUrlVars: function getUrlVars() {
        var vars = [],
            hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');

        for (var i = 0; i < hashes.length; i++) {
          hash = hashes[i].split('=');
          vars.push(hash[0]);
          vars[hash[0]] = hash[1];
        }

        return vars;
      },
      getUrlVar: function getUrlVar(name) {
        return $.getUrlVars()[name];
      }
    });

    function strimURL() {
      var urlPage = [];

      if (window.location.href.split("?").length > 1) {
        urlPage.push(window.location.href.split("/"));
        return urlPage[0][urlPage[0].length - 1].split("?");
      }

      return false;
    } // console.log('http://localhost/Tutor_WebApp/pages/post?namepost=TP.HCM:-Hoan-thanh-thu-tuc-dau-tu-du-an-nha-o-xa-hoi-trong-153-ngay&idpost=5');
    //kiểm tra nesu url này đang truy vấn đến bài viết thì kiểm thử nếu bài viết trả về tồn tại hoặc không tồn tại bài viết
    //tách nhau bởi dấu và và dấu bằng ở phần varurl
    // const urlPage = [];
    // const varPage = [];
    // if (window.location.href.split("?").length > 1) {
    //     urlPage.push(window.location.href.split("?")[0].split("/"));
    //     varPage.push(window.location.href.split("?")[window.location.href.split("?").length - 1].replace("&", "=").split("="));
    // } else {
    //     urlPage.push(window.location.href.split("/"));
    // }
    // console.log(urlPage, "url page")
    // console.log(varPage, "var page")
    // console.log($.inArray("post", urlPage[0]) != -1, "check post")
    // if (
    //     $.inArray("post", urlPage[0]) != -1
    // ) {
    //     // console.log($.inArray("idpost", varPage[0]), "idpost")
    //     // console.log($.inArray("namepost", varPage[0]), "namepost")
    //     if ($.inArray("idpost", varPage[0]) != -1 &&
    //         $.inArray("namepost", varPage[0]) != -1
    //     ) {
    //         if (
    //             $.getUrlVar("idpost") != null &&
    //             $.getUrlVar("namepost") != null
    //         ) {
    //             // decodeURIComponent giải mã url bị mã hóa 
    //             // let namepost = decodeURIComponent($.getUrlVar("namepost"));
    //             let idpost = $.getUrlVar("idpost");
    //             let namepost = $.getUrlVar("namepost");
    //             // console.log("namepost:" + namepost);
    //             // console.log("idpost:" + idpost);
    //             $.ajax({
    //                 url: "../api/news/getpost",
    //                 type: "post",
    //                 dataType: "text",
    //                 data: {
    //                     idpost,
    //                     namepost
    //                 },
    //                 success: function(data) {
    //                     // console.log(data, "data 2");
    //                     data = JSON.parse(data);
    //                     if (data == null) {
    //                         window.location = "../pages/errors/404";
    //                     } else {
    //                         $(document).attr("title", data.title);
    //                         $("#post-header h1").html(data.title);
    //                         $('#post-body-content').html(data.content);
    //                         $('#post-body-content img').addClass('img-fluid');
    //                         const timepost = new Date(data.time);
    //                         $('#post-body-author-time').html(timepost.getDate() + '/' + timepost.getMonth() + '/' + (timepost.getYear() + 1900));
    //                     }
    //                 }
    //             });
    //         }
    //     } else {
    //         window.location = "../pages/errors/404";
    //     }
    // }


    if (strimURL()) {
      var arrUrl = strimURL();

      if (arrUrl[0] == "post") {
        var title_url = arrUrl[1];

        if (title_url != "") {
          $.ajax({
            url: "../api/news/getpost",
            type: "post",
            data: {
              title_url: title_url
            },
            success: function success(data) {
              // console.log(data, "data 2");
              // data = JSON.parse(data);
              if (data == null) {
                window.location = "../pages/errors/404";
              } else {
                $(document).attr("title", data.title);
                $("#post-header h1").html(data.title);
                $('#post-body-content').html(data.content);
                $('#post-body-content img').addClass('img-fluid');
                var timepost = new Date(data.time);
                $('#post-body-author-time').html(timepost.getDate() + '/' + (timepost.getMonth() + 1) + '/' + (timepost.getYear() + 1900));
              }
            }
          });
        } else {
          // window.location = "../pages/errors/404";
          console.log('title_url: ', title_url);
        }
      }
    }
  });
})();

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module is referenced by other modules so it can't be inlined
/******/ 	__webpack_require__("./admin/resources/js/modules/image_viewer.js");
/******/ 	__webpack_require__("./admin/resources/js/main.js");
/******/ 	__webpack_require__("./admin/resources/js/managersubjects.js");
/******/ 	__webpack_require__("./admin/resources/js/page_editpost.js");
/******/ 	__webpack_require__("./admin/resources/js/topicmanager.js");
/******/ 	__webpack_require__("./admin/resources/js/tutormanagers.js");
/******/ 	__webpack_require__("./admin/resources/js/usermanager.js");
/******/ 	__webpack_require__("./admin/resources/js/contact.js");
/******/ 	__webpack_require__("./resources/js/post.js");
/******/ 	__webpack_require__("./admin/resources/js/category.js");
/******/ 	__webpack_require__("./admin/resources/js/categorynew.js");
/******/ 	__webpack_require__("./admin/resources/js/categoryedit.js");
/******/ 	__webpack_require__("./admin/resources/js/article.js");
/******/ 	var __webpack_exports__ = __webpack_require__("./admin/resources/js/articleedit.js");
/******/ 	
/******/ })()
;