
<?php ini_set('error_reporting','E_ALL ^ E_NOTICE'); ?>
<?php include "db.php"; ?> 
<?php include "dbopen.php"; ?>  
<?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $logout = $_GET['logout'];
        if($logout==true){
            session_unset();
            session_destroy();
        ?>
        <script>alert("로그아웃 되었습니다");</script>
        <?php
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $password = $_POST['password'];
         $sql = "select count(*) as cnt from ta_member where id='".$id."' and password = '".$password."'";
             $result = $Mydb->Query($sql);
             while ($row=$Mydb->NextRow()) {
                     $cnt= $row['cnt'];
            }
            // 로그인
            if($cnt >= 1){
                $_SESSION['id']=$id
?>
            <script>alert("logined!");</script>
            <?php
        }
    }
?>
                <div class="col-lg-4">
                    <!-- Search widget-->
                    <div class="card mb-4">
                        <div class="card-header">로그인</div>
                        <div class="card-body">
                            <?php
                                $id = $_SESSION["id"];
                                if(strlen($id) <= 0 ){
                            ?>
                            <form action="index.php" method="post">
                                <div class="input-group">
                                    <input name="id" class="form-control" type="text" placeholder="아이디를 입력해주세요." aria-label="Enter search term..." aria-describedby="button-search" />
                                </div>
                                <div class="input-group mt-3">
                                    <input name="password" class="form-control" type="password" placeholder="패스워드를 입력해주세요." aria-label="Enter search term..." aria-describedby="button-search" />
                                </div>
                                <div class="d-grid gap-2 d-md-block mt-3">
                                    <button class="btn btn-primary" type="submit">로그인</button>
                                    <a href="member.php"><button class="btn btn-primary" type="button">회원가입</button></a>
                                    <button class="btn btn-danger" type="submit">계정찾기</button>
                                </div>
                            </form>
                            <?php } else { ?>
                                <form action="index.php">
                                    <img src="face.jpg">
                                        <div class="d-grid gap-2 d-md-block mt-3">
                                            <input type="hidden" name="logout" value="ture">
                                            <button class="btn btn-danger" type="submit">로그아웃</button>
                                            <a href="member.php"><button class="btn btn-primary" type="button">회원가입</button></a>
                                        </div>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- Categories widget-->
                    <div class="card mb-4">
                        <div class="card-header">Categories</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="#!">Web Design</a></li>
                                        <li><a href="#!">HTML</a></li>
                                        <li><a href="#!">Freebies</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="#!">JavaScript</a></li>
                                        <li><a href="#!">CSS</a></li>
                                        <li><a href="#!">Tutorials</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Side widget-->
                    <div class="card mb-4">
                        <div class="card-header">Side Widget</div>
                        <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="aa.jpg" class="img-fluid rounded">
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            </div>
        </div>