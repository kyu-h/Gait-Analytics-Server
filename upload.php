<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--<link rel="stylesheet" href="main.css">-->
        <link rel="stylesheet" href="fakeLoader_.css">
        <script src="http://code.jquery.com/jquery-1.10.2.js"></script> <!-- jquery 사용하고 싶을 경우  import -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="fakeLoader_.js"></script>
    </head>
    <style>
        table, th, td {
            border: 1px solid black;
        }
        
        .btn {
            background-color: #46cc7e;
            border: none;
            color: white;
            padding: 7px 37px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 12px;
            font-family: 'Nanum Gothic';
        }
        
        #container {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .file_input_textbox {border-style: none; width:80px;}
        .file_input_div {position:relative; overflow:hidden;}
        .file_input_img_btn {padding:0 0 0 5px;}
        .file_input_hidden {font-size:180px; position:absolute; right:0px; top:0px; opacity:0; filter: alpha(opacity=0); -ms-filter: alpha(opacity=0); cursor:pointer;}
    </style>
<body>
    <form name="uploadForm" id="uploadForm_LSH" method="post" action="upload_process.php?algo=LSH" enctype="multipart/form-data" onsubmit="return formSubmit_LSH(this);">
        <br><br><br><br><br>
        <center>
            <h3>Upload a File!</h3>
            <div id='container'>
                <div class="file_input_div">
                    <img src="g_video.png" alt="open" width="250px" height="250px"/>
                    <input type="file" name="upfile" id='upfile' class="file_input_hidden" onchange="javascript: document.getElementById('file2').value = this.value"/>

                    <br>
                    <input type="text" name='file2' id="file2" class="file_input_textbox" readonly >
                    <br>
                    <input type="submit" value="Upload" onclick="click_btn()" class="btn"/>
                    <div class="fakeLoader"></div>
                </div>
            </div>
        </center>
    </form>
    
    <table style="display:none;">
      <tr>
        <td>
            <input type="radio" name="algo" value="LSH" checked=false> LSH<br>
            <input type="radio" name="algo" value="LEA"> LEA
        </td>
      </tr>
    </table>

    <script type="text/javascript">
        function formSubmit_LSH(f) {
            var extArray = new Array('zip','c', 'h', 'jpg', 'jpeg', 'png', 'mp4', 'txt');
            var path = document.getElementById("upfile").value;
            if(path == "") {
                alert("파일을 선택해 주세요.");
                return false;
            }

            var pos = path.indexOf(".");
            if(pos < 0) {
                alert("확장자가 없는파일 입니다.");
                return false;
            }

            var ext = path.slice(path.indexOf(".") + 1).toLowerCase();
            
            console.log(ext);
            
            var file = ext.split('.');
            
            var checkExt = false;
            for(var i = 0; i < extArray.length; i++) {
                if(file[0] == extArray[i]) {
                    checkExt = true;
                    break;
                }
            }

            if(checkExt == false) {
                alert("업로드 할 수 없는 파일 확장자 입니다.");
                return false;
            }
            
            return true;
        }

        function click_btn(){
            var AlgoradioVal = $(':radio[name="algo"]:checked').val();
            var send_cookie = AlgoradioVal + "/" + "NICE";
            console.log("tttaaabbbcccc");
            console.log(AlgoradioVal);
            console.log(send_cookie);
            //alert('영상 분석 중 입니다. 10초 정도 기다려주세요.');
                
            if(AlgoradioVal == "LSH/NICE"){
                <?php
                    /*$answer00 = '';
                    $answer01 = '';
                
                    putenv("PATH=C:\\Program Files (x86)\\mingw-w64\\i686-7.3.0-posix-dwarf-rt_v5-rev0\\mingw32\\bin");
                
                    $answer00 = shell_exec("aa.exe");
                    $answer01 = shell_exec("bb.exe");*/
                ?>

                document.cookie = AlgoradioVal;
                //location.reload(); 
            }
            
            fakeLoader();
        }

        function myFunction() {
            var x = document.getElementById("myFile");
            x.disabled = true;
        }
    </script>
</body>
</html>