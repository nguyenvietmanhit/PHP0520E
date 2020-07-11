<?php
$result = '';
$error = '';
echo "<pre>" . __LINE__ . ", " . __DIR__ . "<br />";
print_r($_POST);
echo "</pre>";
echo "<pre>" . __LINE__ . ", " . __DIR__ . "<br />";
print_r($_FILES);
echo "</pre>";
//die;
//die;
if(isset($_POST['submit'])){
    $upload_arr = $_FILES['upload'];
    $text = $_POST['text'];
    $text_area = $_POST['textarea'];
    if(empty($text) || !isset($select) || !isset($_POST['checkbox']) || !isset($_POST['radio']) || empty($text_area)){
        $error = "khong duoc de trong";
    }
    if(empty($error)){
        $result .= $text ;
        $result .= $text_area;
        $result .= "<br>";
            if(isset($_POST['checkboxs'])) {
                $checkboxs = $_POST['checkboxs'];
                foreach ($checkboxs AS $checkbox) {
                    switch ($checkbox) {
                        case 0:
                            $result .= "checkbox 1 <br>";
                            break;
                        case 1:
                            $result .= "checkbox 2 <br>";
                            break;
                        case 2:
                            $result .= "checkbox 3 <br>";
                    }
                }
            }
            if (isset($_POST['radio'])){
                $radio = $_POST['radio'];
                switch ($radio) {
                    case 0:
                        $result .= "yep <br>";
                        break;
                    case 1:
                        $result .= "nope <br>";
                        break;
                    case 3:
                        $result .= "none <br>";
                        break;
                }
            }
            if(isset($_POST['select'])) {
                switch ($select) {
                    case 0:
                        $result .= "option 1 <br>";
                        break;
                    case 1:
                        $result .= "option 2 <br>";
                        break;
                    case 2:
                        $result .= "none <br>";
                        break;
                }
            }
            if($upload_arr['error'] == 0) {
                $extention = pathinfo($upload_arr['name'],PATHINFO_EXTENSION);
                $extention_allow = ['png','jpg','jpeg','gif'];
                if(!in_array($extention,$extention_allow)) {
                    $error = "upload anh";
                }
                if($upload_arr['size'] / 1024 / 1024 > 2){
                    $error = "size vuot qua";
                }
                if($upload_arr['error'] == 0){
                    $path = 'upload';
                    if(!file_exists($path)) mkdir($path);
                    $file_name = time() . '-' . $upload_arr['name'];
                    move_uploaded_file($upload_arr['tmp_name'],$path . '/' . $file_name);
                    $result .= "text: $text";
                    $result .= "text area: $text_area";
                    $result .= "anh <img src='$path/$file_name'>";
                }
            }
        }
    }
    echo "<span style='color: red'>$error</span>";
    echo "<span style='color: green'>$result</span>";
?>
<form method="post" action="" >
    text
    <input type="text" name="text">
    <br>
    textarea
    <textarea cols="5" rows="5" name="textarea"></textarea>
    <br>
    <?php
    $checkbox1 = '';
    $checkbox2 = '';
    $checkbox3 = '';
        if(isset($_POST['checkboxs'])){
            $checkboxs = $_POST['checkboxs'];
            switch ($checkboxs){
                case 0: $checkbox1 = 'checked'; break;
                case 1: $checkbox2 = 'checked'; break;
                case 2: $checkbox3 = 'checked';break;
            }
        }
    ?>
    <input type="checkbox" name="checkboxs[]" value="0" <?php echo $checkbox1?> > checkbox 1
    <input type="checkbox" name="checkboxs[]" value="1" <?php echo $checkbox2?> > checkbox 2
    <input type="checkbox" name="checkboxs[]" value="2" <?php echo $checkbox3?> > checkbox 3
    <br>
    <?php
    $radio1 = '';
    $radio2 = '';
    $radio0 = '';
    if(isset($_POST['radio']))
    {
        $radio = $_POST['radio'];

        switch ($radio){
            case 0: $radio0 = 'checked'; break;
            case 1: $radio1 = 'checked';break;
            case 2: $rasio2 = 'checked';break;
        }
    }
    ?>
    <input type="radio" name="radio" value="0" <?php echo $radio0; ?> > yep
    <input type="radio" name="radio" value="1" <?php echo $radio1; ?> >  nope
    <input type="radio" name="radio" value="2" <?php echo $radio2; ?> > none
    <br>
    <?php
    $select1 = '';
    $select2 = '';
    $select3 = '';
    if(isset($_POST['select'])){

        $select = $_POST['select'];

        switch ($select){
            case 0: $select1 = 'selected'; break;
            case 1: $select2 = 'selected'; break;
            case 2: $select3 = 'selected';break;
         }
    }
    ?>
    <select name="select">
        <option value="0" <?php echo $select1?> >select 1</option>
        <option value="1" <?php echo $select2?> >select 2</option>
        <option value="2" <?php echo $select3?> >none</option>
    </select>
    <br>
    <input type="file" name="upload">
    <br>
    <input type="submit" name="submit" value="upload">
</form>
