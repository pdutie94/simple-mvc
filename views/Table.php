<?php 
if( ! Login::isLoggedIn() ) {
    header( 'Location: ' . BASEURL );
}

if ( isset( $_REQUEST['submit'] ) ) {
    if ( isset( $_POST['table_data'] ) && $_POST['table_data'] !== '' ) {
        $content = $_POST['table_data'];
        $table = TableController::getTable();
        if( $table ) {
            TableController::updateTable($table['id'], $content);
        } else {
            TableController::addTable($content);
        }
    }
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

    <title>Trang chủ</title>
</head>
<body>
    <?php include 'layout/header.php'; ?>
    <main class="site-content wrapper" style="margin-top: 50px;">
        <div class="container">
            <div class="row">
                <div class="column">
                <form method="post" action="" id="">
                    <fieldset>
                        <?php 
                        $table = TableController::getTable();
                        $table_data = array();
                        if ($table ) {
                            $table_data = json_decode($table['content'], true);
                        }
                        $cols = $table_data['head'];
                        $number_checkbox = 5;
                        ?>
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
                                    <?php for( $ci = 0; $ci < $number_checkbox; $ci++ ) { ?>
                                        <td width="5%"><?php echo $ci+1; ?></td>
                                    <?php } ?>
                                    </tr>
                                </thead>
                                    <?php foreach($table_data['content'] as $sections) { ?>
                                        
                                <tbody>
                                        <?php foreach( $sections['content'] as $sKey => $row) { ?>

                                            <tr>
                                                <?php if( $sKey == 0) { ?>
                                                    <td contenteditable="true" data-save="true" data-key="section" rowspan="<?php echo count($sections['content']); ?>"><?php echo $sections['section']; ?></td>
                                                <?php } else { ?>
                                                    <td style="display: none"></td>
                                                <?php } ?>
                                                <td contenteditable="true" data-save="true" data-key="val-level">
                                                    <?php echo $row['level']; ?>
                                                </td>
                                                <td contenteditable="true" data-key="val-content" data-save="true"><?php echo $row['content']; ?></td>
                                                <?php for( $ci = 0; $ci < $number_checkbox; $ci++ ) { ?>
                                                    <td class="checkbox">
                                                        <?php if ( $row['level'] !== '0' ) { ?>
                                                            <input type="checkbox">
                                                        <?php } ?>
                                                    </td>
                                                <?php } ?>
                                            </tr>

                                        <?php } ?>

                                        </tbody>
                                    <?php } ?>
                            </table>
                        </div>
                        <input type="hidden" value="" name="questions">
                        <input type="hidden" value="" name="table_data">
                        <input name="submit" type="submit" style="display: none">
                        <input class="button-primary save-btn" type="button" value="Lưu">
                    </fieldset>
                </form>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        (function($) {
            $(document).ready(function() {
                var save_btn = $('.save-btn');
                var form_json_val = {};
                var table = $('table.table-data');
                var table_head = table.find('thead');
                var questions = {};
                
                save_btn.on('click', function(e) {
                    e.preventDefault();
                
                    form_json_val['head'] = [];
                    form_json_val['content'] = [];

                    // Generate table columns.
                    var thead_col = table_head.find('tr td[data-save="true"]');
                    thead_col.each(function(){
                        var val = $(this).text();
                        form_json_val['head'].push($(this).text());
                    });

                    // Generate table sections.
                    var table_sections = table.find('tbody');
                    table_sections.each( function() {
                        var section = $(this);
                        var section_data = {};
                        section_data['content'] = [];
                        var tbody_rows = section.find('tr');
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
                    $('input[type="submit"]').click();
                })
            });
        }) (jQuery);
    </script>
</body>
</html>