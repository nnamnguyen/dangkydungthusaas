<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trang quản trị khách hàng</title>
  <script src="../vendor//js//jquery-3.5.1.min.js"></script>
  <script src="leads.js"></script>
  <link rel="stylesheet" href="../vendor/css/bootstrap.css">
  <link rel="stylesheet" href="style2.css">
  <script src="../vendor/js/bootstrap.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
  <link href="https://fonts.google.com/share?selection.family=Raleway:ital,wght@0,300;0,400;1,300;1,400" rel="stylesheet">
</head>

<body>
  <?php
  $idNewLead = $_GET["id"];
  $servername = "localhost";
  $username = "root";
  $password = "";
  $db = "infosytemdb";
  // Create connect
  $conn = new mysqli($servername, $username, $password, $db);
  $conn->set_charset("utf8");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  //Nhận giá trị từ pageadmin
  $sql = "SELECT name, email, company, phone, start_date, end_date, domain FROM leads WHERE id_lead='" . $idNewLead . "'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $name_lead = $row["name"];
      $company = $row["company"];
      $email = $row["email"];
      $phone = $row["phone"];
      $domain = $row["domain"];
      $start_date = $row["start_date"];
      $end_date = $row["end_date"];
    }
  } else {
    $name_lead = '(undefined)';
    $company = '(undefined)';
    $email = '(undefined)';
    $phone = '(undefined)';
    $domain = '';
    $start_date = '(undefined)';
    $end_date = '(undefined)';
    // echo "(undefined)";
  }
  ?>
  <div class="khachhang">
    <div class="thongtinkhachhang">
      <div class="row labelclient">
        <button class="btnrollback"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
        <h2>Thông tin khách hàng</h2>
      </div>
      <div class="row clientinfo">
        <div class="col-md-12 sideleft">
          <div class="row infosideleft">
            <div class="col-md-6 fieldclient">
              <div class="row">
                <div class="col-md-4">
                  <p class="text-right labelinfo">Họ tên:</p>
                </div>
                <div class="col-md-8">
                  <p><?php echo $name_lead; ?></p>
                </div>
              </div>
            </div>
            <div class="col-md-6 fieldclient">
              <div class="row">
                <div class="col-md-4">
                  <p class="text-right labelinfo">Công ty:</p>
                </div>
                <div class="col-md-8">
                  <p><?php echo $company; ?></p>
                </div>
              </div>
            </div>
            <div class="col-md-6 fieldclient">
              <div class="row">
                <div class="col-md-4">
                  <p class="text-right labelinfo">Email:</p>
                </div>
                <div class="col-md-8">
                  <p><?php echo $email; ?></p>
                </div>
              </div>
            </div>
            <div class="col-md-6 fieldclient">
              <div class="row">
                <div class="col-md-4">
                  <p class="text-right labelinfo">Điện thoại:</p>
                </div>
                <div class="col-md-8">
                  <p><?php echo $phone; ?></p>
                </div>
              </div>
            </div>
            <div class="col-md-12 fieldclient tenmien">
              <div class="row">
                <div class="col-md-2">
                  <p class="text-right labelinfo">Tên miền:</p>
                </div>
                <div class="col-md-10">
                <!-- < echo $domain; ?> -->
                  <a id="linktomysite" style="word-wrap: break-word;" href='' target="_blank">af5367ac869954430b1b34156833c526-1079029891.ap-southeast-1.elb.amazonaws.com</a>
                </div>
              </div>
            </div>
            <div class="col-md-6 fieldclient">
              <div class="row">
                <div class="col-md-4">
                  <p class="text-right labelinfo">Ngày bắt đầu:</p>
                </div>
                <div class="col-md-8">
                  <p id="start_datetime" style="display: none;"><?php echo $start_date; ?></p>
                  <p id="start_date">
                    <?php
                    echo date('d-m-Y', strtotime($start_date));
                    ?>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-6 fieldclient">
              <div class="row">
                <div class="col-md-4">
                  <p class="text-right labelinfo">Ngày hết hạn:</p>
                </div>
                <div class="col-md-8">
                  <p id="end_datetime" style="display: none;"><?php echo $end_date; ?></p>
                  <p id="end_date">
                    <?php
                    echo date('d-m-Y', strtotime($end_date));
                    ?>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--end thong tin trai-->
        <div class="col-md-12 sideright">
          <div class="row thoigianconlai">
            <div class="col-md-12">
              <div class="row row1">
                <h2>Thời gian dùng thử</h2>
              </div>
              <div class="row row2">
                <div class="demnguoc">
                  <p id="days"></p><small>:</small>
                  <p id="hours"></p><small>:</small>
                  <p id="minutes"></p><small>:</small>
                  <p id="seconds"></p>
                </div>
                <div class="timename">
                  <span id="ngay">Ngày</span>
                  <span id="gio">Giờ</span>
                  <span id="phut">Phút</span>
                  <span id="giay">Giây</span>
                </div>
              </div>
              <div class="row row3">
                <button type="button" class="btn btn-success giahan" data-id='<?php echo $idNewLead; ?>'>Gia hạn</button>
                <button type="button" class="btn btn-danger ngungsudung" data-id='<?php echo $idNewLead; ?>'>Ngừng sử dụng</button>
              </div>
            </div>
          </div>
        </div>
        <!--end countdown phai-->
      </div>
    </div>
  </div>
</body>

</html>