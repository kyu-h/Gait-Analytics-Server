<!DOCTYPE html>
<html lang="ko">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>걸음걸이 분석 결과</title>
   <link rel="stylesheet" type="text/css" href="css/resultPage.css">
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>
    <?php
        $db_conn = mysqli_connect("localhost", "root", "123123", "file");
        $algo = $_GET['algo'];
        $exe_split = 0;
        if($algo == "LSH"){
            if(isset($_FILES['upfile']) && $_FILES['upfile']['name'] != "") {
                $file = $_FILES['upfile'];
                //$upload_directory = 'file_save/';
                $upload_directory = '';
                $ext_str = "zip,c,h,jpg,jpeg,png,mp4,txt";
                $allowed_extensions = explode(',', $ext_str);
                $max_file_size = 52428800;
                $ext = substr($file['name'], strrpos($file['name'], '.') + 1);
                
                // 확장자 체크
                if(!in_array($ext, $allowed_extensions)) {
                    echo "업로드할 수 없는 확장자 입니다.";
                }
                // 파일 크기 체크
                if($file['size'] >= $max_file_size) {
                    echo "50MB 까지만 업로드 가능합니다.";
                }
                $path = $file['name'];
                
                if(move_uploaded_file($file['tmp_name'], $upload_directory.$path)) {
                    $query = "INSERT INTO upload_file (file_id, name_orig, name_save, reg_time) VALUES(?,?,?,now())";
                    $file_id = $file['name'];
                    $name_orig = $file['name'];
                    $name_save = $path;
                    $stmt = mysqli_prepare($db_conn, $query);
                    $bind = mysqli_stmt_bind_param($stmt, "sss", $name_orig, $name_orig, $name_save);
                    $exec = mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                }
            } else {
                echo "<br><h3>파일이 업로드 되지 않았습니다.</h3>";
                echo '<a href="javascript:history.go(-1);">이전 페이지</a>';
            }
        }
    
        $answer00 = '';
        $answer02 = '';
        $answer04 = '';
        putenv("PATH=C:\\Program Files (x86)\\mingw-w64\\i686-7.3.0-posix-dwarf-rt_v5-rev0\\mingw32\\bin");
        $answer00 = shell_exec("main.exe"); //shell script 실행
        
        $fp = fopen("./Video/result.txt", "r");
        $doc_data = fgets($fp);

        $doc_data_arr = explode(',', $doc_data);
    
        $st_0 = iconv("EUC-KR", "UTF-8", $doc_data_arr[0]);
        $st_1 = (double)$doc_data_arr[1];
        $st_2 = iconv("EUC-KR", "UTF-8", $doc_data_arr[2]);
        $st_3 = (double)$doc_data_arr[3];
        $st_4 = iconv("EUC-KR", "UTF-8", $doc_data_arr[4]);
        $st_5 = (double)$doc_data_arr[5];
        
        $msg = '자세 교정이 필요합니다.';
        
        if($st_1 >= $st_3 && $st_1 >= $st_5){
            $msg = '정상입니다.';
        }else if($st_3 >= $st_1 && $st_3 >= $st_5){
            $msg = '자세에 주의가 필요합니다.';
        }else if($st_5 >= $st_1 && $st_5 >= $st_3){
            $msg = '자세가 위험군에 속합니다.';
        }
    
        fclose($fp);
    
        mysqli_close($db_conn);
    ?>
    
    <script>
        google.charts.load('current', {
            'packages' : [ 'corechart' ]
        });
        google.charts.setOnLoadCallback(drawPieChart);

        //***********************************
        //
        //걸음걸이에 대한 분석 결과를 piechart로 뿌려주는 기능
        //
        //***********************************
        
        function drawPieChart() {
            //alert(data);
            var data_arr = [['결과', 'percent']];

            var tmp0 = ['정상', <?php echo $st_1?>];
            var tmp1 = ['구부정한 자세', <?php echo $st_3?>];
            var tmp2 = ['즉시 치료 요망', <?php echo $st_5?>];

            data_arr.push(tmp0);
            data_arr.push(tmp1);
            data_arr.push(tmp2);

            var data = google.visualization.arrayToDataTable(data_arr);
            
            var options = {
                pieStartAngle : 135,
                slices : {
                    0 : {
                        color : 'green'
                    },
                    1 : {
                        color : 'orange'
                    },
                    2 : {
                        color : 'red'
                    }
                }
            };
            
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>
    
    <div id="box">
		<video id="resultVideo" width="300px" height="300px" controls="controls">
			<!-- source 동영상 경로 필요! -->
			<source id="resultVideoSource">
		</video>
		<div id="resultDiv">
			<!-- 분석 결과 받아와야 함! -->
			<fieldset>
				<legend>분석 결과</legend>
				<p id="resultTxt"><?php echo $msg?></p>
				<div id="piechart"></div>
			</fieldset>
		</div>
        <!-- 정상 아닐때 Youtube solution -->
        <div id="videoDiv">
			<!-- 분석 결과 받아와야 함! -->
			<fieldset>
				<legend>관련 영상 보기!</legend>
                <div>
                    <p id="symptomTxt"><a href="https://www.youtube.com/channel/UCdtRAcd3L_UpV4tMXCw63NQ">피지컬갤러리 Youtube</a><br><br></p>
                </div>
                <div class="pop_area pop_video">
                    <div class="pop_wrap" style="top:100px">
                        <div class="video_wrapper">
                            <iframe type="text/html" width="100%" height="250px" src="https://www.youtube.com/embed/HnxNvk1p5bQ" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
			</fieldset>
		</div>
	</div>
    
    <script>
        var file_name = '<?= $file['name'] ?>';
        //var root = 'http://192.168.0.25/upload/application/sk/';
        //var all_root = root + file_name; //file 명 동적으로 할당
        var all_root = 'http://192.168.0.25/upload/application/sk_demo/Video/a_result.mp4';
        document.getElementById("resultVideoSource").setAttribute("src", all_root); //javascript 변수 -> html 속성 설정
        
        console.log(all_root);
    </script>
</body>
</html>