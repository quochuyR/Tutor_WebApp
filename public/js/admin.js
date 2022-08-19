/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./admin/resources/js/carousel.js":
/*!****************************************!*\
  !*** ./admin/resources/js/carousel.js ***!
  \****************************************/
/***/ (() => {

// (function() {
//     let MyEditor;
//     // data table
//     jQuery(document).ready(function($) {
//         ClassicEditor
//             .create(document.querySelector('#editor'), {
//                 placeholder: 'Nhấn vào đây và hãy viết mô tả chi tiết!',
//             })
//             .then(editor => {
//                 const toolbarContainer = document.querySelector('#toolbar-container');
//                 toolbarContainer.appendChild(editor.ui.view.toolbar.element);
//                 MyEditor = editor;
//             })
//             .catch(error => {
//                 console.error(error);
//             });
//     });
//     // $.validator.addMethod("ck_editor", function() {
//     //     var content_length = MyEditor.getData().trim().length;
//     //     return content_length > 0;
//     // }, "Please insert content for the page.");       
// })(jQuery)

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
      columns: [{
        "data": "id"
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
          if (data == 0) return "Chưa xem";else return "Đã xem";
        }
      }, {
        "data": null,
        render: function render(data, type, row) {
          return "<a href=\"#id=".concat(data.id, "\">Xem th\xEAm</a>");
        }
      }]
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
/******/ 	__webpack_require__("./admin/resources/js/carousel.js");
/******/ 	__webpack_require__("./admin/resources/js/managersubjects.js");
/******/ 	__webpack_require__("./admin/resources/js/page_editpost.js");
/******/ 	__webpack_require__("./admin/resources/js/topicmanager.js");
/******/ 	__webpack_require__("./admin/resources/js/tutormanagers.js");
/******/ 	__webpack_require__("./admin/resources/js/usermanager.js");
/******/ 	var __webpack_exports__ = __webpack_require__("./admin/resources/js/contact.js");
/******/ 	
/******/ })()
;