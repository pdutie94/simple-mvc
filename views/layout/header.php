<header>
        <div class="container">
            <div class="navbar">
                <ul>
                    <?php if ( Login::isLoggedIn() ) { ?>
                        <li>
                            <a href="<?php echo BASEURL; ?>">Trang chủ</a>
                        </li>
                        <li>
                            <a href="<?php echo BASEURL . 'edit-table'; ?>">Sửa bảng</a>
                        </li>
                        <li>
                            <a href="<?php echo BASEURL . 'report'; ?>">Báo cáo</a>
                        </li>
                    <?php } else { ?>
                        <li>
                            <a href="<?php echo BASEURL . 'login'; ?>">Đăng nhập</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </header>