<?php

namespace Views;

use Classes\AppUser, Library\Session, Helpers\Util, Helpers\UploadFile;
use Helpers\Format;

require_once(__DIR__ . "../../vendor/autoload.php");

// include_once "../classes/appusers.php";
// include_once "../lib/session.php";
// include_once "../helpers/format.php";
Session::init();
Session::set('rdrurl', $_SERVER['REQUEST_URI']);


$_user = new AppUser();

// upload avatar user
$upload_image = UploadFile::upload("file", "../public/images/");
// 0 => 'images', 1 => image file name
$explode_path = explode("/",  Session::get("imagepath"));
if ($upload_image && $upload_image["uploaded"] == 1) {
    // update lại đường dẫn
    $update_new_image = $_user->update_image_user(Session::get("userId"), "images/" . $upload_image["fileName"]);
    if ($update_new_image) {
        // đường dẫn hình ảnh củ
        $path_del = __DIR__ . "../../public/images/$explode_path[1]";
        if (file_exists($path_del)) {
            // xoá hình củ
            unlink(__DIR__ . "../../public/images/$explode_path[1]");
            // set session lại hình mới upload
            Session::set("imagepath", "images/" . $upload_image["fileName"]);
        }
    }
}


$title = "Danh sách gia sư";
$nav_tutor_active = "active";
include "../inc/header.php";
?>
<div id="main" class="container pb-3">
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>

    </svg>
    <!-- <form action="profile" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="file" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form> -->



    <form method="POST" action class="mt-3">

        <div class="row">
            <?php
            $message = "";
            //   print_r($_POST);
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                if (isset($_POST) && !empty($_POST) && isset($_POST["update-profile"])) {

                    // print_r($_POST); 

                    $email = (isset($_POST["email"]) && !empty($_POST["email"])) ? Format::validation($_POST["email"]) : NULL;
                    $last_name = (isset($_POST["lastname"]) && !empty($_POST["lastname"])) ? Format::validation($_POST["lastname"]) : NULL;
                    $first_name = (isset($_POST["firstname"]) && !empty($_POST["firstname"])) ? Format::validation($_POST["firstname"]) : NULL;
                    $sex = (isset($_POST["gioitinh"]) && is_numeric($_POST["gioitinh"])) ? Format::validation($_POST["gioitinh"]) : NULL;
                    $phonenumber = (isset($_POST["phonenumber"]) && !empty($_POST["phonenumber"])) ? Format::validation($_POST["phonenumber"]) : NULL;
                    $date_of_birth = (isset($_POST["dateofbirth"]) && !empty($_POST["dateofbirth"])) ? Format::validation($_POST["dateofbirth"]) : NULL;
                    $address = (isset($_POST["address"]) && !empty($_POST["address"])) ? Format::validation($_POST["address"]) : NULL;
                    $job = (isset($_POST["job"]) && !empty($_POST["job"])) ? Format::validation($_POST["job"]) : NULL;


                    $get_info_user = $_user->update_user(Session::get("userId"), $email, $last_name, $first_name,  $sex, $phonenumber, $date_of_birth, $address, $job);

                    if ($get_info_user) {
                        $message = ' <div class="col-12"> 
                                            <div class="alert alert-success  d-flex align-items-center text-start" role="alert">
                                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                            <div>Cập nhật dữ liệu thành công.</div>
                        </div></div>';
                    }
                }
            }


            $get_info_user = $_user->getInfoByUserId(Session::get("userId"));
            if ($get_info_user) :

                while ($person = $get_info_user->fetch_assoc()) :
                    // print_r($person);

            ?>
                    <div class="col-12 col-sm-3 mb-3 mb-sm-0 text-center">

                        <div class="card h-100">
                            <div class="card-body">
                                <div class="position-absolute end-5 bottom-0 translate-middle-y">

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-tutor-detail" data-bs-toggle="modal" data-bs-target="#change-picture">
                                        Thay đổi ảnh
                                    </button>
                                </div>


                                <img src="<?= isset($person["imagepath"]) ? Util::getCurrentURL(1) . "public/" . $person["imagepath"] : "https://www.bootdey.com/img/Content/avatar/avatar5.png"; ?>" class="rounded-circle avatar-lg avatar" alt="hình đại diện" value="<?php echo $person['imagepath'] ?>" id="my-image">
                                <div class="mt-3 h-50 d-flex flex-column pb-5">

                                    <h4 class="fw-bold mb-1"><?php echo $person['lastname'] . " " . $person['firstname'] ?></h4>
                                    <h6 class="text-muted"><?php echo "<b> ID: </b>" . $person['username'] ?></h6>
                                    <input type="hidden" name="" value="<?= Session::get('tutorId') ?>" id="tuid">

                                    <button type="button" class="d-block m-auto pt-3" data-bs-toggle="modal" data-bs-target="#QRModal">
                                        <div class="card w-fit-content bg-gray-600" style="cursor:pointer;" id="my-qr-code">
                                            <div class="card-body p-2">
                                                <span class="material-symbols-rounded font-64 text-white d-flex m-auto">
                                                    qr_code_2
                                                </span>
                                            </div>
                                        </div>
                                    </button>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-9">
                        <div class="card">
                            <div class="card-body">

                                <div class="row">
                                    <?= isset($message) ? $message : "" ?>
                                    <input type="hidden" name="update-profile">
                                    <div class="col-6 col-sm-4 mb-3">
                                        <label for="username" class="form-label">Họ </label>
                                        <input type="text" class="text-muted form-control" name="lastname" id="lastname" placeholder="Họ" value="<?php echo $person['lastname']  ?>">
                                    </div>
                                    <div class="col-6 col-sm-4 mb-3">
                                        <label for="username" class="form-label">Tên</label>
                                        <input type="text" class="text-muted form-control" name="firstname" id="firstname" placeholder="Tên" value="<?php echo $person['firstname'] ?>">
                                    </div>
                                    <div class="col-6 col-sm-4 mb-3">
                                        <label for="phone" class="form-label">Số điện thoại</label>
                                        <input type="text" class="text-muted form-control" name="phonenumber" id="phonenumber" placeholder="số điện thoại" value="<?php echo $person['phonenumber'] ?>">
                                    </div>
                                    <div class="col-6 col-sm-5 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="text-muted form-control" id="email" name="email" placeholder="Email" value="<?php echo $person['email'] ?>">
                                    </div>

                                    <div class="col-6 col-sm-4 mb-3">
                                        <label for="dateofbirth" class="form-label">Ngày sinh</label>
                                        <input type="date" class="text-muted form-control" id="dateofbirth" name="dateofbirth" placeholder="dateofbirth" value="<?= isset($person['dateofbirth']) ? $person['dateofbirth'] : ""; ?>">
                                    </div>
                                    <div class="col-6 col-sm-3 mb-3">
                                        <!-- <div class="form-group flex-column d-flex"> -->
                                        <label class="form-control-label">Nghề nghiệp</span></label>
                                        <select class="form-select" name="job" id="job">
                                            <?php
                                            $option = array("-- Không xác định --", "Sinh viên", "Giáo viên", "Chuyên gia", "Người đi làm", "Người nước ngoài");
                                            foreach ($option as $value) :
                                            ?>
                                                <option value="<?= $value ?>" <?= $person['job'] == $value ? "selected" : "" ?>><?= $value ?></option>
                                            <?php endforeach; ?>

                                        </select>
                                        <!-- </div> -->

                                    </div>



                                    <div class="col-12 col-sm-10 mb-3">
                                        <label for="address" class="form-label">Địa chỉ</label>
                                        <input type="text" class="text-muted form-control" id="address" name="address" placeholder="Hãy cập nhật địa chỉ." value="<?= isset($person['address']) ? $person['address'] : ""; ?>">
                                    </div>
                                    <div class="col-6 col-sm-2 mb-3">
                                        <div class="input-group">
                                            <label class="form-check-label" for="radio-nam">Giới tính</label>
                                        </div>
                                        <div class=" d-flex flex-column">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gioitinh" id="radio-nam" value="1" <?php if ($person['sex'] == 1) {
                                                                                                                                            echo 'checked';
                                                                                                                                        } ?>>
                                                <label class="form-check-label" for="radio-nam">
                                                    Nam
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input " type="radio" name="gioitinh" id="radio-nu" value="0" <?php if ($person['sex'] == 0) {
                                                                                                                                            echo 'checked';
                                                                                                                                        } ?>>
                                                <label class="form-check-label" for="radio-nu">Nữ</label>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- <div class="row">
                                        <div class="col-12 ">

                                            <textarea id="textarea" placeholder="Giới thiệu bản thân" name="introduction" id="introduction" <?php echo $Content ?>></textarea>
                                        </div>
                                    </div> -->


                                    <div class="col-12 text-end mt-3">

                                        <!-- link tại trang mặt định lấy giá trị $_GET  -->
                                        <button type="submit" class="btn btn-tutor-detail" name="submit">Cập nhật</button>
                                        <!-- link qua trang đăng kí làm gia sư -->
                                        <!-- <a href="http://localhost/Tutor_WebApp/pages/tutor_registration_form" class="btn btn-primary " name="dangki">Đăng kí làm gia sư</a> -->
                                    </div>

                                </div>
                            </div>

                        </div>

                <?php endwhile;
            endif; ?>
                    </div>


        </div>
    </form>



    <!-- Modal QR -->
    <div class="modal fade" id="QRModal" tabindex="-1" aria-labelledby="QRModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="QRModalLabel">QR code của tôi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body d-flex justify-content-center">
                            <div id="canvas"></div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                    <button type="button" class="btn btn-primary" id="download">Tải về</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal update image -->
    <div class="modal fade" id="change-picture" tabindex="-1" aria-labelledby="change-pictureLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="change-pictureLabel">Thay đổi ảnh đại diện</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="profile" class="dropzone" id="profile" enctype="multipart/form-data"></form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ bỏ</button>
                    <button type="button" class="btn btn-primary" id="save-change-picture">Lưu</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php


include "../inc/script.php"
?>
<script type="text/javascript">
    (function() {
        $(document).ready(function() {
            var src_img = $("#my-image").prop("src");
            let tuid = $("#tuid").val();
            var data = new URL(`./tutor_details?id=${tuid}`, window.location.href);

            // When the avatar changes, reattach the src_img. variable.
            $("#my-image").on('load', (e) => {
                // console.log(e.target.src)
                src_img = e.target.src;
            })
            console.log(data);
            //
            var option = {
                    "width": 360,
                    "height": 360,
                    "data": data.href,
                    "image": src_img,
                    "margin": 20,
                    "qrOptions": {
                        "typeNumber": "0",
                        "mode": "Byte",
                        "errorCorrectionLevel": "M"
                    },
                    "imageOptions": {
                        "hideBackgroundDots": true,
                        "imageSize": 0.6,
                        "margin": 10
                    },
                    "dotsOptions": {
                        "type": "classy",
                        "color": "#45b8ac"
                    },
                    "backgroundOptions": {
                        "color": "#ffffff"
                    },
                    "dotsOptionsHelper": {
                        "colorType": {
                            "single": true,
                            "gradient": false
                        }
                    },
                    "cornersSquareOptions": {
                        "type": "extra-rounded",
                        "color": "#038f7e"
                    },
                    "cornersSquareOptionsHelper": {
                        "colorType": {
                            "single": true,
                            "gradient": false
                        }
                    },
                    "cornersDotOptions": {

                        "color": "#038f81",
                        "gradient": null
                    },
                    "cornersDotOptionsHelper": {
                        "colorType": {
                            "single": true,
                            "gradient": false
                        }
                    },
                    "backgroundOptionsHelper": {
                        "colorType": {
                            "single": true,
                            "gradient": false
                        },

                    }
                }
            var QRModalEl = document.getElementById('QRModal')
            QRModalEl.addEventListener('shown.bs.modal', function(event) {
                option.image = src_img;
                qrCode.update(option);
            })

            let qrCode = new QRCodeStyling(option);

            qrCode.append(document.getElementById("canvas"));
            $("#download").on('click', (e) => {
                qrCode.download({
                    name: "qr-tutor",
                    extension: "png"
                });
            });

            // Dropzone



        });

        // dropzone
        Dropzone.options.profile = {
            // Configuration options go here
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 2, // MB
            maxFiles: 1,
            acceptedFiles: ".png,.jpg,.jpeg",
            autoProcessQueue: false,
            addRemoveLinks: true,
            // Dịch sang tiếng Việt
            dictDefaultMessage: "Kéo và thả file (có thể click) vào đây để upload",
            dictFallbackMessage: "Trình duyệt của bạn không hỗ trợ kéo và thả upload file.",
            dictFallbackText: "Vui lòng sử dụng biểu mẫu dự phòng bên dưới để tải lên các file của bạn như ngày xưa.",
            dictFileTooBig: "File quá lớn ({{filesize}}MiB). Tối đa filesize: {{maxFilesize}}MiB.",
            dictInvalidFileType: "Bạn không thể tải lên các file thuộc loại này (chú ý đến đuôi file).",
            dictResponseError: "Máy chủ đã phản hồi với {{statusCode}} code.",
            dictCancelUpload: "Huỷ bỏ upload",
            dictUploadCanceled: "Upload đã huỷ bỏ.",
            dictCancelUploadConfirmation: "Bạn có chắc chắn muốn hủy upload này không?",
            dictRemoveFile: "Xoá file",
            dictRemoveFileConfirmation: null,
            dictMaxFilesExceeded: "Bạn không thể tải lên bất kỳ tệp nào nữa.",
            init: function() {
                let upload = this;
                // Restrict to 1 file uploaded
                upload.on("addedfile", function() {
                    if (upload.files[1] != null) {
                        upload.removeFile(upload.files[0]);
                    }
                });
                // If validation passes, process queue and add insurance
                $("#save-change-picture").on("click", function(e) {
                    e.preventDefault();
                    upload.processQueue();
                    console.log(upload.files[0].dataURL, "upload")
                    $("img.avatar").each((i, img) => {
                        img.src = upload.files[0].dataURL;
                    })

                });
            },
        };


    })();
</script>
<?php include '../inc/footer.php' ?>