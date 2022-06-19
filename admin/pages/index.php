<?php

namespace Admin;

use Classes\Tutor, Classes\AppUser, Classes\TeachingSubject;
use Library\Session;
use Helpers\Util;

require_once(__DIR__ . "../../../vendor/autoload.php");

// require_once "../../lib/session.php";

if (!Session::checkRoles(["admin"])) {
    header("location: ../../pages/login");
}
//  Classes\Subject, Classes\SubjectTopic;


// include_once "../../classes/tutors.php";
// include_once "../../classes/appusers.php";
// include_once "../../classes/teachingsubjects.php";
// include_once "../../helpers/format.php";

$_tutor = new Tutor();
$_user = new AppUser();
$_teaching_subject = new TeachingSubject();

$title = "Trang chủ";
include_once "../inc/header.php" ?>
<section>

    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <?php include_once "../inc/sliderbar.php" ?>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">

        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-1">
                                        <img src="<?= htmlspecialchars("../assets/images/icons/teacher_96px.png") ?>" class="w-75" alt="" srcset="">

                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">

                                            <div class="stat-text"><span class="count"><?= $_tutor->countAll()->fetch_assoc()["count_tutors"] ?></span></div>
                                            <div class="stat-heading">Gia sư</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-2">
                                        <img src="<?= htmlspecialchars("../assets/images/icons/user_menu_female_96px.png") ?>" class="w-75" alt="" srcset="">

                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count"><?= $_user->countAll()->fetch_assoc()["num_user"] ?></span></div>
                                            <div class="stat-heading">Người dùng</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-3">
                                        <img src="<?= htmlspecialchars("../assets/images/icons/data_pending_96px.png") ?>" class="w-75" alt="" srcset="">
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count"><?= $_tutor->countPendingTutors()->fetch_assoc()["countPendingTutors"] ?></span></div>
                                            <div class="stat-heading">Gia sư chờ duyệt</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-4">
                                        <img src="<?= htmlspecialchars("../assets/images/icons/check_all_96px.png") ?>" class="w-75" alt="" srcset="">

                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count"><?= $_tutor->countApprovedTutors()->fetch_assoc()["countApprovedTutors"] ?></span></div>
                                            <div class="stat-heading">Gia sư đã duyệt</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Widgets -->
                <!--  Traffic  -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="box-title">Số lượng người dùng và gia sư đăng kí theo tháng </h4>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card-body">

                                        <canvas id="tutors-chart"></canvas>

                                    </div>
                                </div>
                                <!-- <div class="col-lg-4">
                                    <div class="card">


                                        <div class="card-body">
                                            <table id="tb_main_title" style="border-collapse: collapse;" name="tb_main_title" width="960" class="table-print-title text-center">
                                                <thead>
                                                    <tr>
                                                        <th colspan="2" style="vertical-align: center;" nowrap="1">
                                                            <span class="logo_left" nowrap="true">
                                                                <span style="font-weight:normal;">BỘ GIÁO DỤC VÀ ĐÀO TẠO</span><br>TRƯỜNG ĐẠI HỌC ĐỒNG THÁP
                                                                <hr class="c50">
                                                            </span>
                                                            <br>
                                                        </th>
                                                        <th colspan="4" style="vertical-align: center;" nowrap="1">
                                                            <span class="logo_right" style=" " nowrap="true">
                                                                CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM<br>Độc lập - Tự do - Hạnh phúc
                                                                <hr class="c51">
                                                            </span>
                                                            <br>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="6" style="vertical-align: center;" class="bold main_title">THÔNG TIN CHỦ ĐỀ MÔN HỌC</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div> -->
                            </div> <!-- /.row -->
                            <div class="card-body"></div>
                        </div>
                    </div><!-- /# column -->
                </div>
                <!--  /Traffic -->
                <div class="clearfix"></div>
                <!-- Orders -->
                <div class="orders">
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="box-title mb-3">Gia sư mới đăng ký </h4>

                                    <div class="table-stats order-table ov-h">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th scope="col" class="min-w-200">Gia sư</th>
                                                        <th scope="col" class="min-w-200">Nghề nghiệp</th>
                                                        <th scope="col" class="min-w-215">Nơi dạy</th>
                                                        <th scope="col" class="min-w-85">Trạng thái</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $getInfoTutor = $_tutor->getTutorInfoOnAdmin();
                                                    if ($getInfoTutor) :

                                                        while ($InfoTutor = $getInfoTutor->fetch_assoc()) :
                                                    ?>
                                                            <tr>

                                                                <td class="avatar ">
                                                                    <div class="d-flex">
                                                                        <div class="round-img">
                                                                            <a href="#"><img class="rounded" src=" <?= isset($InfoTutor["imagepath"]) ? "../../public/" . $InfoTutor["imagepath"]: Util::getCurrentURL(2) . "public/images/avatar5-default.jpg" ?>" alt=""></a>
                                                                        </div>
                                                                        <div class="d-flex flex-column">
                                                                            <span class="text-dark fw-bold d-block"><?= $InfoTutor["lastname"] . ' ' . $InfoTutor["firstname"] ?></span>
                                                                            <span class="text-muted fs-6  limit-text p-t-012"><?= $InfoTutor["currentplace"] ?></span>
                                                                        </div>
                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    <div class="d-flex flex-column">

                                                                        <span class="text-dark fw-bold d-block"><?= $InfoTutor["currentjob"] ?></span>
                                                                        <span class="text-muted fs-6 limit-text p-t-012">
                                                                            <?php
                                                                            $topicTutors = "";
                                                                            $topicList = $_teaching_subject->getTopicByTutorId($InfoTutor['id']);
                                                                            while ($resultSB = $topicList->fetch_assoc()) :
                                                                                $topicTutors .= $resultSB['topicName'] . ', ';
                                                                            endwhile;

                                                                            echo $topicTutors;
                                                                            ?>
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex flex-column">
                                                                        <span class="text-dark fw-bold limit-text"><?= $InfoTutor["teachingarea"] ?></span>
                                                                        <span class="text-muted fs-6  limit-text p-t-012">
                                                                            <?php
                                                                            foreach (explode(",", $InfoTutor["teachingform"]) as $teachingForm) :
                                                                                if ($teachingForm == 0)
                                                                                    echo 'Trực tiếp, ';
                                                                                else if ($teachingForm == 1)
                                                                                    echo 'Trực tuyến';
                                                                            endforeach;
                                                                            ?>
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td><span class="badge <?= $InfoTutor["tutor_status"] == 1 ? "badge-light-success" : "badge-light-danger" ?> d-block"><?= $InfoTutor["tutor_status"] == 1 ? "Đã duyệt" : "Chưa duyệt" ?></span></td>
                                                            </tr>

                                                    <?php
                                                        endwhile;
                                                    endif;
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div> <!-- /.table-stats -->
                                </div>

                            </div> <!-- /.card -->
                        </div> <!-- /.col-lg-8 -->

                        <div class="col-xl-4">
                            <div class="row">
                                <div class="col-lg-6 col-xl-12">
                                    <div class="card br-0">
                                        <div class="card-body">
                                            <div class="chart-container ov-h">
                                                <div id="flotPie1" class="float-chart"></div>
                                            </div>
                                        </div>
                                    </div><!-- /.card -->
                                </div>

                                <div class="col-lg-6 col-xl-12">
                                    <div class="card bg-flat-color-3  ">
                                        <div class="card-body">
                                            <h4 class="card-title m-0  white-color ">August 2018</h4>
                                        </div>
                                        <div class="card-body">
                                            <div id="flotLine5" class="flot-line"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /.col-md-4 -->
                    </div>
                </div>
                <!-- /.orders -->
                <!-- To Do and Live Chat -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title box-title">To Do List</h4>
                                <div class="card-content">
                                    <div class="todo-list">
                                        <div class="tdl-holder">
                                            <div class="tdl-content">
                                                <ul>
                                                    <li>
                                                        <label>
                                                            <input type="checkbox"><i class="check-box"></i><span>Conveniently fabricate interactive technology for ....</span>
                                                            <a href='#' class="fa fa-times"></a>
                                                            <a href='#' class="fa fa-pencil"></a>
                                                            <a href='#' class="fa fa-check"></a>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="checkbox"><i class="check-box"></i><span>Creating component page</span>
                                                            <a href='#' class="fa fa-times"></a>
                                                            <a href='#' class="fa fa-pencil"></a>
                                                            <a href='#' class="fa fa-check"></a>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="checkbox" checked><i class="check-box"></i><span>Follow back those who follow you</span>
                                                            <a href='#' class="fa fa-times"></a>
                                                            <a href='#' class="fa fa-pencil"></a>
                                                            <a href='#' class="fa fa-check"></a>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="checkbox" checked><i class="check-box"></i><span>Design One page theme</span>
                                                            <a href='#' class="fa fa-times"></a>
                                                            <a href='#' class="fa fa-pencil"></a>
                                                            <a href='#' class="fa fa-check"></a>
                                                        </label>
                                                    </li>

                                                    <li>
                                                        <label>
                                                            <input type="checkbox" checked><i class="check-box"></i><span>Creating component page</span>
                                                            <a href='#' class="fa fa-times"></a>
                                                            <a href='#' class="fa fa-pencil"></a>
                                                            <a href='#' class="fa fa-check"></a>
                                                        </label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div> <!-- /.todo-list -->
                                </div>
                            </div> <!-- /.card-body -->
                        </div><!-- /.card -->
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title box-title">Live Chat</h4>
                                <div class="card-content">
                                    <div class="messenger-box">
                                        <ul>
                                            <li>
                                                <div class="msg-received msg-container">
                                                    <div class="avatar">
                                                        <img src="images/avatar/64-1.jpg" alt="">
                                                        <div class="send-time">11.11 am</div>
                                                    </div>
                                                    <div class="msg-box">
                                                        <div class="inner-box">
                                                            <div class="name">
                                                                John Doe
                                                            </div>
                                                            <div class="meg">
                                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis sunt placeat velit ad reiciendis ipsam
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- /.msg-received -->
                                            </li>
                                            <li>
                                                <div class="msg-sent msg-container">
                                                    <div class="avatar">
                                                        <img src="images/avatar/64-2.jpg" alt="">
                                                        <div class="send-time">11.11 am</div>
                                                    </div>
                                                    <div class="msg-box">
                                                        <div class="inner-box">
                                                            <div class="name">
                                                                John Doe
                                                            </div>
                                                            <div class="meg">
                                                                Hay how are you doing?
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- /.msg-sent -->
                                            </li>
                                        </ul>
                                        <div class="send-mgs">
                                            <div class="yourmsg">
                                                <input class="form-control" type="text">
                                            </div>
                                            <button class="btn msg-send-btn">
                                                <i class="pe-7s-paper-plane"></i>
                                            </button>
                                        </div>
                                    </div><!-- /.messenger-box -->
                                </div>
                            </div> <!-- /.card-body -->
                        </div><!-- /.card -->
                    </div>
                </div>
                <!-- /To Do and Live Chat -->
                <!-- Calender Chart Weather  -->
                <div class="row">
                    <div class="col-md-12 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <!-- <h4 class="box-title">Chandler</h4> -->
                                <div class="calender-cont widget-calender">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div><!-- /.card -->
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card ov-h">
                            <div class="card-body bg-flat-color-2">
                                <div id="flotBarChart" class="float-chart ml-4 mr-4"></div>
                            </div>
                            <div id="cellPaiChart" class="float-chart"></div>
                        </div><!-- /.card -->
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card weather-box">
                            <h4 class="weather-title box-title">Weather</h4>
                            <div class="card-body">
                                <div class="weather-widget">
                                    <div id="weather-one" class="weather-one"></div>
                                </div>
                            </div>
                        </div><!-- /.card -->
                    </div>
                </div>
                <!-- /Calender Chart Weather -->
                <!-- Modal - Calendar - Add New Event -->
                <div class="modal fade none-border" id="event-modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title"><strong>Add New Event</strong></h4>
                            </div>
                            <div class="modal-body"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success save-event waves-effect waves-light">Create event</button>
                                <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /#event-modal -->
                <!-- Modal - Calendar - Add Category -->
                <div class="modal fade none-border" id="add-category">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title"><strong>Add a category </strong></h4>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label">Category Name</label>
                                            <input class="form-control form-white" placeholder="Enter name" type="text" name="category-name" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Choose Category Color</label>
                                            <select class="form-control form-white" data-placeholder="Choose a color..." name="category-color">
                                                <option value="success">Success</option>
                                                <option value="danger">Danger</option>
                                                <option value="info">Info</option>
                                                <option value="pink">Pink</option>
                                                <option value="primary">Primary</option>
                                                <option value="warning">Warning</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /#add-category -->
            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
        <!-- <div class="clearfix"></div> -->
        <!-- Footer -->
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->
</section>
<?php include_once "../inc/script.php" ?>
<?php include_once "../inc/footer.php" ?>