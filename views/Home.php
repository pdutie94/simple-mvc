<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">

    <!-- CSS Reset -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">

    <!-- Milligram CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">

    <title>Trang chủ</title>
</head>
<body>
    <?php include 'layout/header.php'; ?>
    <main class="site-content wrapper" style="margin-top: 50px;">
        <div class="container">
            <div class="row">
                <div class="column">
                <?php 
                    if ( isset( $_REQUEST['submit'] ) && $_REQUEST['form_token'] == $_SESSION['report_form_token'] ) {
                        $check = true;
                        if ( isset( $_POST['fullname'] ) && $_POST['fullname'] !== '' && isset( $_POST['answer'] ) && !empty($_POST['answer']) ) {
                            $fullName = htmlentities($_POST['fullname']);
                            $answers = json_encode($_POST['answer']);
                            
                            $check = HomeController::addData($fullName, $answers);

                            if($check) {
                                echo '<div class="message success">Đã lưu!</div>';
                            } else {
                                echo '<div class="message error">Đã có lỗi xảy ra! Hãy thử lại.</div>';
                            }
                        } else {
                            if (!isset( $_POST['fullname'] ) || $_POST['fullname'] === '') {
                                echo '<div class="message error">Hãy nhập tên của bạn!</div>';
                            }
                            if (!isset( $_POST['answer'] ) && empty($_POST['answer'])) {
                                echo '<div class="message error">Hãy chọn câu trả lời!</div>';
                            }
                        }
                    }
                    ?>
                <form method="post" action="" id="">
                    <fieldset>
                        <div class="form-group">
                            <label for="fullname">Nhập họ và tên của bạn *</label>
                            <input type="text" placeholder="Nguyễn Văn A" id="fullname" name="fullname" required>
                        </div>
                        <?php 
                        $time = microtime();
                        $_SESSION['report_form_token'] = $time;
                        $table = HomeController::getTable();
                        $table_data = array();
                        $cols = array(
                            'Tiêu chí đánh giá',
                            'Cấp độ',
                            'Khái niệm',
                        );
                        if ($table ) {
                            $table_data = json_decode($table['content'], true);
                            $cols = $table_data['head'];
                        }
                        $number_checkbox = 5;
                        ?>
                        <div class="table-wrapper" style="overflow-x: auto">
                            <table>
                                <thead>
                                    <tr>
                                    <?php 
                                    foreach( $cols as $colKey => $col ) { 
                                        $width = 'auto';
                                        if ( $colKey == 0 ) {
                                            $width = '15%';
                                        }
                                        if ( $colKey == 1 ) {
                                            $width = '10%';
                                        }
                                        ?>
                                        <td width="<?php echo $width; ?>"><?php echo $col; ?></td>
                                    <?php } ?>
                                    <?php for( $ci = 0; $ci < $number_checkbox; $ci++ ) { ?>
                                        <td width="5%"><?php echo $ci+1; ?></td>
                                    <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    <?php if( !empty($table_data) ) { foreach($table_data['content'] as $sections) { ?>
                                        
                                        <?php foreach( $sections['content'] as $sKey => $row) { ?>

                                            <tr>
                                                <?php if( $sKey == 0) { ?>
                                                    <td rowspan="<?php echo count($sections['content']); ?>"><?php echo $sections['section']; ?></td>
                                                <?php } else { ?>
                                                    <td style="display: none"></td>
                                                <?php } ?>
                                                <td>
                                                    <?php 
                                                    if($row['level'] !== '0') {
                                                        echo $row['level'];
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo $row['content']; ?></td>
                                                <?php for( $ci = 0; $ci < $number_checkbox; $ci++ ) { ?>
                                                    <td class="checkbox">
                                                        <?php if ( $row['level'] !== '0' ) { ?>
                                                            <input type="radio" name="answer[<?php echo $i; ?>]" value="<?php echo $ci+1; ?>" required>
                                                        <?php } ?>
                                                    </td>
                                                <?php } ?>
                                            </tr>

                                        <?php $i++; } ?>

                                    <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                        <input type="hidden" name="form_token" id="form_token" value="<?php echo $time; ?>" />
                        <input class="button-primary" type="submit" name="submit" value="Gửi">
                    </fieldset>
                </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>