<!DOCTYPE html>
<html lang="en">

<?php 
$title = "Lịch dạy";
include "inc/head.php" 
?>

<body>

    <div class="container">
       <section>
        <form action="" id="filter-schedule">
            <div class="row">
                <div class="col-md-3 col-6">
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="select-DOW" class="form-label">Thứ</label>
                            <select class="form-select select-DOW" name="dayofweek" id="select-DOW">  
                                <option value="0">-- Tất cả --</option>                          
                                <option value="1">Thứ 2</option>
                                <option value="2">Thứ 3</option>
                                <option value="3">Thứ 4</option>
                                <option value="4">Thứ 5</option>
                                <option value="5">Thứ 6</option>
                                <option value="6">Thứ 7</option>
                                <option value="0">Chủ nhật</option>
                            </select>
                          </div>
                        
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="select-subject" class="form-label">Môn học</label>
                            <select class="form-select select-subject" name="subject" id="select-subject" >
                                <option value="0">-- Tất cả --</option>  
                                <option value="Toán">Toán</option>
                                <option value="Vật lý">Vật lý</option>
                                <option value="Hoá học">Hoá học</option>
                            </select>
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-3 col-6">
    
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="time-start" class="form-label">Thời gian bắt đầu</label>
                            <input class="form-control" type="datetime-local" name="time-start" id="time-start">
                        </div>
    
                        
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="form-group">
    
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="time-end" class="form-label">Thời gian kết thúc</label>
                                <input class="form-control" type="datetime-local" name="time-end" id="time-end">
                            </div>
        
                            
                        </div>
                    </div>
                </div>
            </div>
           </form>
       </section>

       <section>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <div class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <div class="d-flex align-items-start">
                        <img src="images/144185147_462103764917452_5125494602597852051_n.jpg"
                            class="rounded-circle avatar-sm img-thumbnail" alt="profile-image"
                            onclick="ShowImg(this.src);">
                        <div class="w-100 ms-3 align-self-end">
                            <h5 class="my-1">Nguyễn Minh Đăng</h5>
                            <p class="text-muted">@id: dangit</p>

                        </div>
                    </div>
                </button>
              </div>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="accordion-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">Thứ</th>
                                    <th scope="col">Thời gian</th>
                                    <th scope="col">Môn học</th>
                                   
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <th scope="row">Hai</th>
                                    <td>07:30 - 09:00</td>
                                    <td>Toán</td>
                                    
                                  </tr>
                                  <tr>
                                    <th scope="row">Ba</th>
                                    <td>13:30 - 15:00</td>
                                    <td>Lý</td>
                                   
                                  </tr>
                                  <tr>
                                    <th scope="row">Tư</th>
                                    <td >18:30 - 20:00</td>
                                    <td>Hoá</td>
                                  </tr>
                                </tbody>
                              </table>
                          </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <div class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <div class="d-flex align-items-start">
                        <img src="images/175337396_2917917531830460_8008229113997594091_n.jpg"
                            class="rounded-circle avatar-sm img-thumbnail" alt="profile-image"
                            onclick="ShowImg(this.src);">
                        <div class="w-100 ms-3 align-self-end">
                            <h5 class="my-1">Nguyễn Quốc Huy</h5>
                            <p class="text-muted">@id: huy2k1</p>

                        </div>
                    </div>
                </button>
              </div>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="table-responsive">
                        <table class="table ">
                            <thead>
                              <tr>
                                <th scope="col">Thứ</th>
                                <th scope="col">Thời gian</th>
                                <th scope="col">Môn học</th>
                               
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row">Hai</th>
                                <td>07:30 - 09:00</td>
                                <td>Toán</td>
                                
                              </tr>
                              <tr>
                                <th scope="row">Ba</th>
                                <td>13:30 - 15:00</td>
                                <td>Lý</td>
                               
                              </tr>
                              <tr>
                                <th scope="row">Tư</th>
                                <td >18:30 - 20:00</td>
                                <td>Hoá</td>
                              </tr>
                            </tbody>
                          </table>
                      </div>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <div class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <div class="d-flex align-items-start">
                        <img src="images/270571222_1426358357761639_675267433749402851_n.jpg"
                            class="rounded-circle avatar-sm img-thumbnail" alt="profile-image"
                            onclick="ShowImg(this.src);">
                        <div class="w-100 ms-3 align-self-end">
                            <h5 class="my-1">Nguyễn Khánh</h5>
                            <p class="text-muted">@id: khanhalone</p>

                        </div>
                    </div>
                </button>
              </div>
              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="accordion-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">Thứ</th>
                                    <th scope="col">Thời gian</th>
                                    <th scope="col">Môn học</th>
                                   
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <th scope="row">Hai</th>
                                    <td>07:30 - 09:00</td>
                                    <td>Toán</td>
                                    
                                  </tr>
                                  <tr>
                                    <th scope="row">Ba</th>
                                    <td>13:30 - 15:00</td>
                                    <td>Lý</td>
                                   
                                  </tr>
                                  <tr>
                                    <th scope="row">Tư</th>
                                    <td >18:30 - 20:00</td>
                                    <td>Hoá</td>
                                  </tr>
                                </tbody>
                              </table>
                          </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
       </section>
    </div>


    <?php include "inc/script.php" ?>

        <script>
            console.log(new FormData(document.getElementById("filter-schedule")).get("dayofweek"))
        </script>
</body>

</html>