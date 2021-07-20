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

    <title>Home Page</title>
</head>
<body>
    <main class="site-content wrapper" style="margin-top: 50px;">
        <div class="container">
            <div class="row">
                <div class="column">
                <form method="post" action="" id="">
                    <fieldset>
                        <div class="form-group">
                            <label for="fullname">Nhập họ và tên của bạn *</label>
                            <input type="text" placeholder="Nguyễn Văn A" id="fullname" name="fullname" required>
                        </div>
                        <?php 
                        $cols = array(
                            'Tiêu chí đánh giá',
                            'Cấp độ',
                            'Khái niệm',
                        );
                        $number_checkbox = 5;
                        $sample_data = array(
                            array(
                                'section' => 'Khả năng thích ứng',
                                'content' => array(
                                    array(
                                        'level' => '0',
                                        'content' => 'Etiam feugiat lorem non metus',
                                    ),
                                    array(
                                        'level' => '1',
                                        'content' => 'Etiam feugiat lorem non metus',
                                    ),
                                    array(
                                        'level' => '2',
                                        'content' => 'Etiam feugiat lorem non metus',
                                    ),
                                    array(
                                        'level' => '3',
                                        'content' => 'Etiam feugiat lorem non metus',
                                    ),
                                ),
                            ),
                            array(
                                'section' => 'TEAMWORK  / Xây dựng mối quan hệ tích cực làm việc (làm việc theo nhóm / hợp tác)',
                                'content' => array(
                                    array(
                                        'level' => '0',
                                        'content' => 'Etiam feugiat lorem non metus',
                                    ),
                                    array(
                                        'level' => '1',
                                        'content' => 'Etiam feugiat lorem non metus',
                                    ),
                                ),
                            ),
                            array(
                                'section' => 'Khả năng thích ứng 3',
                                'content' => array(
                                    array(
                                        'level' => '0',
                                        'content' => 'Etiam feugiat lorem non metus',
                                    ),
                                ),
                            ),
                        );
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
                                    <?php foreach($sample_data as $sections) { ?>
                                        
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
                                                            <input type="checkbox">
                                                        <?php } ?>
                                                    </td>
                                                <?php } ?>
                                            </tr>

                                        <?php } ?>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <input class="button-primary" type="submit" value="Gửi">
                    </fieldset>
                </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>