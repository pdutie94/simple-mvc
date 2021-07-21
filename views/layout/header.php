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
<style>
	header {
		background: #f5f5f5;
	}
	.navbar ul {
		list-style: none;
		display: flex;
		align-items: center;
	}
	.navbar ul li {
		margin: 0;
	}
	.navbar ul li a {
		padding: 10px 20px;
		display: block;
	}
	.message {
        padding: 10px 15px;
        margin-bottom: 1em;
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
        border-radius: .4rem;
    }
    .message.error {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }
    .button {
        margin: 0;
    }
    .button-small {
        font-size: 1rem;
        height: 2.8rem;
        line-height: 2.8rem;
        padding: 0 1.5rem;
    }
</style>
