<div class="main-content-inner">
    <div class="row">
        <div class="col-lg-6 col-ml-12">
            <div class="row justify-content-center">
                <div class="col-10 mt-5">
                    <div class="card">
                        <div class="user-profile-form d-flex">
                            <div class="card-body user-profile-form-left col-4 d-flex flex-column align-items-center">
                                <div class="user-profile-image">
                                    <img src="<?php echo BASE_PATH . '/' . $user['image'] ?>" alt=""
                                        class="user-profile-img" />
                                </div>
                                <div class="user-profile-name mt-3">
                                    <p class="user-profile-name"><?php echo $user['userName'] ?></p>
                                </div>
                                <div class="user-profile-role">
                                    <p><?php echo $user['isAdmin'] ? 'Admin' : 'Khách hàng' ?></p>
                                </div>
                                <div class="user-profile-update-icon mt-4">
                                    <a href="<?php echo "update-user?userId=" . $user['userId']; ?>"><i
                                            class="fa fa-pencil-square-o"></i></a>
                                </div>
                            </div>
                            <div class="card-body user-profile-form-right col-8">
                                <div class="user-profile-info">
                                    <div>
                                        <h6>Thông tin</h6>
                                        <hr />
                                    </div>
                                    <div>
                                        <div class="d-flex">
                                            <div class="col-8 p-0">
                                                <p class="user-profile-header">Email</p>
                                                <p><?php echo $user['email'] ?></p>
                                            </div>
                                            <div class="mr-5">
                                                <p class="user-profile-header">Số điện thoại</p>
                                                <p><?php echo $user['phone'] ?></p>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <p class="user-profile-header">Địa chỉ</p>
                                            <p><?php echo $user['street'] . ', ' . $user['ward'] . ', ' . $user['district'] . ', ' . $user['city'] ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="user-profile-orders mt-5">
                                    <div>
                                        <h6>Thông tin mua hàng</h6>
                                        <hr />
                                    </div>
                                    <div class="d-flex">
                                        <div class="col-8 p-0">
                                            <p class="user-profile-header">Đơn hàng</p>
                                            <p><?php echo $user['totalOrders'] ?></p>
                                        </div>
                                        <div class="mr-5">
                                            <p class="user-profile-header">Tổng chi tiêu</p>
                                            <p><?php echo formatCurrencyVND($user['totalSpent']); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>