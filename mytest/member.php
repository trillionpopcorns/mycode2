<!DOCTYPE html>
<html lang="en">
    <?php include "header.php"; ?>
    <?php include "db.php"; ?>
    <?php include "dbopen.php"; ?>
    <?php ini_set('error_reporting','E_ALL ^ E_NOTICE'); ?>
  <div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
     <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Message</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body" id="message" onclick="modalclose()">
        <h5>Congratulations. You are now a member. Go to the login page</h5>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="modalclose()">Close</button>
      </div>
    </div>
  </div>
</div>
    <main>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                session_start();
                $id = $_SESSION['id'];
                if(strlen($id)>0){
                    $sql = "select password, name,mail, gender,description from ta_member where id='".$id."'";
                    $result = $Mydb->Query($sql);
                    while ($row=$Mydb->NextRow()) {
                        $password= $row['password'];
                        $name= $row['name'];
                        $mail= $row['mail'];
                        $gender= $row['gender'];
                        $description= $row['description'];
                        }
                }
            }
            // 저장버튼을 누르면
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                session_start();
	            $id = $_SESSION['id'];
	        if(strlen($id)>0){  // 수정
                echo "수정";
                $password = $_POST['password'];
                $name= $_POST['name'];
                $mail= $_POST['mail'];
                $gender= $_POST['gender'];
                $description= $_POST['description'];
                $sql = "update ta_member set name = '".$name."' where id = '".$id."'";
                $result = $Mydb->Query($sql);
	      	if($result==1){
                        	?>
 		    <script>
 		   	    var modal = document.getElementById('myModal');
			    modal.style.display = 'block';
            </script>
	        <?php
		    }
	      	echo $result ;
            }
            else{ //신규
                $id = $_POST['id'];
	      	    $password = $_POST['password'];
                $name= $_POST['name'];
	      	    $mail= $_POST['mail'];
	      	    $gender= $_POST['gender'];
	      	    $description= $_POST['description'];
                // 테이블에 저장하라
                $sql = "insert into ta_member values('".$id."','".$password."','".$name."','".$mail."','".$gender."','".$description."')";
                $result = $Mydb->Query($sql);
	      	if($result==1){
                        	?>
 		    <script>
 		   	    var modal = document.getElementById('myModal');
			    modal.style.display = 'block';
            </script>
	        <?php
		    }
	      	echo $result ;
        }
	}
            ?>
        <!-- Page content-->
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="my-4">Membership<small>Sign up</small>
                    </h1>
                    <h5>PSB Academy students register as a member on the SCS website. And you can share a lot of information or get information.</h5>
                    <div class="card mb-4">
                    <div class="card-body">
                        <form  name="frm" method="post" action="member.php" onsubmit="return validate()">
                            <div class="form-controll">
                                <label for="exampleInputPassword1">Member ID</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="id" name="id" value="<?php echo $id?>" placeholder="ID must be at least 8 characters long.">
                                        <button type="button" class="btn btn-success" onclick="openidcheck()">ID duplicate check</button>
                                        <input type="text" class="form-control" name="idcheck" value="">
                                    </div>

                            </div>
                            </br>
                            <div class="form-controll">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="password" value="<?php echo $password?>"  name="password" placeholder="Password must be at least 8 characters long.">
                            </div>	
                            </br>
                            <div class="form-controll">
                                <label for="exampleInputPassword1">Name</label>
                                <input type="text" class="form-control" id="name" value="<?php echo $name?>" placeholder="Your Name" name = "name" >
                            </div>	
                            </br>
                            <div class="form-controll">
                                <label for="exampleInputPassword1">Mail Address</label>
                                <input type="text" class="form-control" id="mail" value="<?php echo $mail?>" placeholder="Your mail address" name = "mail" >
                            </div>	
                            </br>				 
                            <div class="form-controll">
                                <label for="gender">Gender</label>
                                <select class="form-control" name="gender" >
                                <?php 
		                        if($gender==1) ?>
                                	<option value=1>Male</option>
		                        <?php 
		                        if($gender==2) ?>
                                	<option value=2>Female</option>
		                        <?php 
		                        if($gender=="") { ?>
			                        <option value=1>Male</option>
                                	<option value=2>Female</option>
		                        <?php } ?>
                                </select>
                            </div>
                            </br>	
                            <div class="form-controll">
                                <label for="exampleInputPassword1">Membership Greeting</label>
                                <textarea class="form-control" name="description"><?php echo $description?></textarea>
                            </div>	
                            </br>				 	
                            <button type="submit" class="btn btn-primary" name="button" value="new" >Save</button>
                            <a href="index.php"><button type="button" class="btn btn-danger" name="button" >Home</button></a>
                        </form>
                        <?php 
                        $id = $_SESSION['id'];
                        if(strlen($id)>0){
                            ?>
                            <script>frm.idcheck.value="1";</script>
                            <?php
                        }
                        ?>
                    </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
        <?php include 'modal.php'; ?>
        <script>
            var modal = document.getElementByID("exampleModal1");
            modal.style.display = 'none';
            function openidcheck(){
                id = frm.id.value;
                if(id.length < 1){
        	         frm.id.focus();
                      alert("ID가 비여 있어요");
                      return false;
                }
                var xhr = new XMLHttpRequest();
	            xhr.onreadystatechange = function() {
	                if (xhr.readyState == 4) {
	                    var data = xhr.responseText;
                        if(data==0){
                            alert("사용 가능한 ID입니다");
                            frm.idcheck.value="1";
                        }
	                }
	            }
	        xhr.open('GET', 'idcheck.php?idcheck='+id, true);
	        xhr.send(null);
            }
             function validate(){
                  // ID 검사여부 확인 
                if(frm.idcheck.value !="1"){
		            alert("ID 중복 검사를 하세요");
                    return false;
                }
                  // 입력값 확인 
                id = frm.id.value;
                if(id.length < 1){
        	         frm.id.focus();
                      alert("ID는 최소 8자 이상이어야 합니다.");
                      return false;
                }
    	        if( frm.id.value == "" ) {
        	         frm.id.focus();
                      alert("ID을 입력해 주십시오.");
                      return false;
                }
            }
	function modalclose() { 
		   var modal = document.getElementById('myModal');
		   modal.style.display = "none";
		   location.href="index.php";
	}
        </script>
        <!-- Footer-->
        <?php include 'footer.php'; ?>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>