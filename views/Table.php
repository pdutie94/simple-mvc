<?php 
if( ! Login::isLoggedIn() ) {
    header( 'Location: ' . BASEURL );
}
?>
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

    <title>Sửa bảng</title>
    <style>
        
        table tbody tr td:first-child {
            display: none;
        }
        table tbody tr:first-child td:first-child {
            display: table-cell;
        }
        .button.add-section-btn {
            margin-bottom: 1rem;
        }
        p {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <?php include 'layout/header.php'; ?>
    <main class="site-content wrapper" style="margin-top: 50px;">
        <div class="container">
            <div class="row">
                <div class="column">
                    <h3>SỬA BẢNG</h3>
                    <?php 
                    if ( isset( $_REQUEST['submit'] ) && $_REQUEST['form_token'] == $_SESSION['form_token'] ) {
                        if ( isset( $_POST['table_data'] ) && $_POST['table_data'] !== '' ) {
                            $content = $_POST['table_data'];
                            $table = TableController::getTable();
                            $check = false;
                            if( $table ) {
                                $check = TableController::updateTable($table['id'], $content);
                            } else {
                                $check = TableController::addTable($content);
                            }
                            if($check) {
                                echo '<div class="message success">Đã lưu!</div>';
                            } else {
                                echo '<div class="message error">Đã có lỗi xảy ra! Hãy thử lại.</div>';
                            }
                        }
                    }
                    ?>
                <form method="post" action="" id="">
                    <fieldset>
                        <?php 
                        $time = microtime();
                        $_SESSION['form_token'] = $time;
                        $table = TableController::getTable();
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
                        <a href="javascript:;" class="add-section-btn button button-outline">Thêm tiêu chí</a>
                        <p>* Để cấp độ = 0 sẽ không hiện checkbox.</p>
                        <div class="table-wrapper" style="overflow-x: auto">
                            <table class="table-data">
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
                                        <td contenteditable="true" data-save="true" data-key="col" width="<?php echo $width; ?>"><?php echo $col; ?></td>
                                    <?php } ?>
                                    <td width="5%"></td>
                                    </tr>
                                </thead>
                                    <?php if( !empty($table_data['content']) ) { foreach($table_data['content'] as $sections) { ?>
                                        
                                <tbody>
                                        <?php if( !empty($sections['content']) ) { foreach( $sections['content'] as $sKey => $row) { ?>
                                            <tr>
                                                <td contenteditable="true" data-save="true" data-key="section" rowspan="<?php echo count($sections['content']) + 1; ?>"><?php echo $sections['section']; ?></td>
                                                <td contenteditable="true" data-save="true" data-key="val-level">
                                                    <?php echo $row['level']; ?>
                                                </td>
                                                <td contenteditable="true" data-key="val-content" data-save="true"><?php echo $row['content']; ?></td>
                                                <td><a href="javascript:;" class="button button-small r-del-btn">Xoá</a></td>
                                            </tr>

                                        <?php } } ?>

                                        </tbody>
                                    <?php } } ?>
                            </table>
                        </div>
                        <input type="hidden" value="" name="table_data">
                        <input type="hidden" name="form_token" id="form_token" value="<?php echo $time; ?>" />
                        <input name="submit" type="submit" style="display: none">
                        <input class="button-primary save-btn" type="button" value="Lưu">
                    </fieldset>
                </form>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        (function($) {
            $(document).ready(function() {
                var save_btn = $('.save-btn');
                var form_json_val = {};
                var table = $('table.table-data');
                var table_head = table.find('thead');
                var questions = {};

                // table.sortable({
                //     items: 'tbody',
                //     cancel: '[contenteditable]'
                // });
                // table.disableSelection();

                // table.find('tbody').sortable({
                //     items: 'tr',
                //     cancel: '[contenteditable]'
                // });
                // table.find('tbody').disableSelection();

                function addButtons() {
                    var table_sections = table.find('tbody');
                    table_sections.find('tr.action-btns').remove();
                    table_sections.each( function() {
                        var table_section = $(this);
                        if( table_section.find('tr:not(.action-btns)').length < 1 ) {
                            return true;
                        }
                        var act_btns = '<tr class="action-btns">' +
                            '<td rowspan="2"></td>' +
                            '<td></td>' +
                            '<td><a href="javascript:;" class="button button-small r-add-btn">Thêm khái niệm</a></td>' +
                            '<td></td>' +
                        '</tr>'
                        table_section.append(act_btns);
                    });
                }

                addButtons();

                // Xoá khái niệm
                $(document).on('click', '.r-del-btn', function() {
                    $(this).closest('tr').remove();
                })

                // Thêm khái niệm
                $(document).on('click', '.r-add-btn', function() {
                    var curr_section = $(this).closest('tbody');
                    var curr_row = $(this).closest('tr');
                    var row_clone = curr_section.find('tr:not(.action-btns)').first().clone();
                    if(row_clone.length < 1) {
                            row_clone = '<tr>' + 
                        '<td contenteditable="true" data-save="true" data-key="section" rowspan="2" class="">Tiêu chí</td>' +
                        '<td contenteditable="true" data-save="true" data-key="val-level" class="">0</td>'+
                        '<td contenteditable="true" data-key="val-content" data-save="true" class="">Nội dung</td>'+
                        '<td><a href="javascript:;" class="button button-small r-del-btn">Xoá</a></td>'+
                        '</tr>';
                        curr_section.prepend(row_clone);
                    } else {
                        var curr_rowspan = row_clone.find('td:nth-child(1)').attr('rowspan');
                        row_clone.find('td:nth-child(2)').text(0);
                        row_clone.find('td:nth-child(3)').text('Nội dung');
                        curr_section.find('td[data-key="section"]').attr('rowspan', parseInt(curr_rowspan) + 1)
                        row_clone.insertBefore(curr_row);
                    }
                })

                // Thêm tiêu chí
                $('.add-section-btn').on('click', function() {
                    var section_tpl = '<tbody><tr>' + 
                    '<td contenteditable="true" data-save="true" data-key="section" rowspan="2" class="">Tiêu chí</td>' +
                    '<td contenteditable="true" data-save="true" data-key="val-level" class="">0</td>'+
                    '<td contenteditable="true" data-key="val-content" data-save="true" class="">Nội dung</td>'+
                    '<td><a href="javascript:;" class="button button-small r-del-btn">Xoá</a></td>'+
                    '</tr></tbody>';
                    table.append(section_tpl);
                    addButtons();
                })
                
                save_btn.on('click', function(e) {
                    e.preventDefault();
                    var table_sections = table.find('tbody');
                
                    form_json_val['head'] = [];
                    form_json_val['content'] = [];

                    // Generate table columns.
                    var thead_col = table_head.find('tr td[data-save="true"]');
                    thead_col.each(function(){
                        var val = $(this).text();
                        form_json_val['head'].push($(this).text());
                    });
                    
                    table_sections.each( function() {
                        var section = $(this);
                        if( section.find('tr:not(.action-btns)').length < 1 ) {
                            return true;
                        }
                        var section_data = {};
                        section_data['content'] = [];
                        var tbody_rows = section.find('tr:not(.action-btns)');
                        tbody_rows.each(function(ri, robj){
                            var fields = $(robj).find('td[data-save="true"]');
                            var row_val = {};
                            fields.each(function(fi, fobj){
                                var fkey = $(fobj).data('key');
                                var fval = $(fobj).text();
                                if(fkey === 'section') {
                                    section_data['section'] = fval;
                                    return true;
                                }
                                if(fkey === 'val-level') {
                                    row_val['level'] = fval.trim();
                                } else {
                                    row_val['content'] = fval.trim();
                                }
                            });
                            section_data['content'].push(row_val);
                        });
                        form_json_val['content'].push(section_data);
                    });
                    $('input[name="table_data"]').val(JSON.stringify(form_json_val));
                    console.log(form_json_val);
                    $('input[type="submit"]').click();
                })
            });
        }) (jQuery);
    </script>
</body>
</html>