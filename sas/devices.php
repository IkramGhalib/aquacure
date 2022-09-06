<!DOCTYPE html>

<head>
    <title>Smart Environment | Devices</title>
    <?php include_once('links.php') ?>

    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />

</head>

<body>
    <div class="navbar navbar-inverse set-radius-zero">
    <a href="index.php">
            <img src="assets/img/banner.png" width="100%" height="90px" />
        </a>
        <div style="background-color:#428BCA"  class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>


            </div>

        </div>
    </div>
    <!-- LOGO HEADER END-->
    <section class="menu-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-left">

                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="log.php">Log</a></li>
                            <li><a href="devices.php" class="menu-top-active">Devices</a></li>
                            <li><a href="map.php">Map</a></li>
                            <li><a href="graph.php">Graph</a></li>

                        </ul>
                        <ul id="menu-top" class="nav navbar-nav navbar-right">

                            <li><a href="login.php">Log in</a></li>


                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- MENU SECTION END-->
    <div class="content-wrapper ">
        <div class="container ">

            <div class="row ">
                <div class="col-md-12 ">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <a href="#" class="btn btn-primary btn-sm add_btn">Add New Device</a>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Longitude</th>
                                            <th>Latitude</th>
                                            <th>Date & Time</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        date_default_timezone_set("Asia/Karachi");
                                        include("DBConnection.php");
                                        $con = new DBCon();

                                        if ($con->Open()) {

                                            $sql = " SELECT * FROM devices ";
                                            $result = $con->db->query($sql) or die("Query error");
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $str = $row["did"];
                                                    $did = explode("D", $str);
                                                    // echo $did[1];
                                                    echo '
                                        <tr class="odd gradeX ">
                                            <td>' . $row["did"] . '</td>
                                            <td>' . $row["name"] . '</td>
                                            <td>' . $row["description"] . '</td>
                                            <td>' . $row["longitude"] . '</td>
                                            <td>' . $row["latitude"] . '</td>
                                            <td>' . $row["datentime"] . '</td>
                                            <td > 
                                            <a href="#" class="btn btn-success btn-xs edit-btn">Edit</a> 
                                            <a href="#" class="btn btn-danger btn-xs dlt-btn">Delete</a>
                                            </td>
                                        </tr>
                                        ';
                                                }
                                            }
                                        }
                                        $con->db->close();
                                        ?>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <!--End Advanced Tables -->

                    </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!--End Advanced Tables -->
    </div>
    </div>

    </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <section class="footer-section ">
        <div class="container ">
            <div class="row ">
                <center>
                    Copyright &copy; 2018-2019 <a href=""><strong>CISNR</a>.</strong> All rights reserved.
                </center>
            </div>
        </div>
    </section>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js "></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js "></script>
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/dataTables/jquery.dataTables.js "></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js "></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js "></script>
</body>

</html>