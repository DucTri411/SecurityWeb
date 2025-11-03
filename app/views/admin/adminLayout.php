<?php
require_once 'app/utils/constants.php';
require_once 'app/utils/flashMessage.php';
$messages = getAllMessages();
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>LSOUL - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/png"
        href="<?php echo BASE_PATH . '/app/public/assets/images/icon/favicon.ico' ?>" />
    <link rel="stylesheet" href="<?php echo BASE_PATH . '/app/public/assets/css/bootstrap.min.css' ?>" />
    <link rel="stylesheet" href="<?php echo BASE_PATH . '/app/public/assets/css/font-awesome.min.css' ?>" />
    <link rel="stylesheet" href="<?php echo BASE_PATH . '/app/public/assets/css/themify-icons.css' ?>" />
    <link rel="stylesheet" href="<?php echo BASE_PATH . '/app/public/assets/css/metisMenu.css' ?>" />
    <link rel="stylesheet" href="<?php echo BASE_PATH . '/app/public/assets/css/owl.carousel.min.css' ?>" />
    <link rel="stylesheet" href="<?php echo BASE_PATH . '/app/public/assets/css/slicknav.min.css' ?>" />
    <link rel="stylesheet" href="<?php echo BASE_PATH . '/app/public/css/toast.css' ?>" />
    <!-- amcharts css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css"
        media="all" />
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css" />
    <!-- style css -->
    <link rel="stylesheet" href="<?php echo BASE_PATH . '/app/public/assets/css/typography.css' ?>" />
    <link rel="stylesheet" href="<?php echo BASE_PATH . '/app/public/assets/css/default-css.css' ?>" />
    <link rel="stylesheet" href="<?php echo BASE_PATH . '/app/public/assets/css/styles.css' ?>" />
    <link rel="stylesheet" href="<?php echo BASE_PATH . '/app/public/assets/css/responsive.css' ?>" />
    <!-- modernizr css -->
    <script src="<?php echo BASE_PATH . '/app/public/assets/js/vendor/modernizr-2.8.3.min.js' ?>"></script>
</head>

<body>
    <?php if (isset($disabledSidebar)): ?>
        <?php require_once $view; ?>
    <?php else: ?>
        <div class="page-container">
            <?php require_once 'app/views/admin/sidebar.php'; ?>
            <div class="main-content">
                <?php require_once 'app/views/common/adminHeader.php' ?>
                <?php require_once $view; ?>
            </div>
        </div>
    <?php endif; ?>


    <div id="toast" class="toast hidden">
        <span id="toast-message"></span>
    </div>

    <div id="deleteModal" class="modal hidden">
        <div class="modal-content">
            <h3 id="modal-title"></h3>
            <p>Hành động này không thể hoàn tác.</p>
            <div class="modal-actions">
                <a id="cancelButton" class="cancel-button">Hủy</a>
                <a id="confirmDeleteButton" class="confirm-button">Xóa</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            let toastTimeout;
            function showToast(message, type = "success") {
                const toast = document.getElementById("toast");

                //đóng toast nếu đang mở
                if (toastTimeout) {
                    clearTimeout(toastTimeout);
                    toast.className = `toast hidden ${type}`;

                    setTimeout(() => {
                        displayToast(message, type);
                    }, 300);
                } else {
                    displayToast(message, type);
                }
            }
            function displayToast(message, type) {
                const toast = document.getElementById("toast");
                const toastMessage = document.getElementById("toast-message");

                toastMessage.textContent = message || 'Thông báo';
                toast.className = `toast visible ${type}`;

                toastTimeout = setTimeout(() => {
                    toast.className = `toast hidden ${type}`;
                    toastTimeout = null;
                }, 2000);
            }

            function showDeleteModal(title, confirmHref) {
                const modal = document.getElementById('deleteModal');
                const modalTitle = document.getElementById('modal-title');
                const confirmButton = document.getElementById('confirmDeleteButton');
                const cancelButton = document.getElementById('cancelButton');

                modalTitle.textContent = title;
                confirmButton.setAttribute('href', confirmHref);
                modal.classList.remove('hidden');

                cancelButton.addEventListener('click', function () {
                    modal.classList.add('hidden');
                });
            }
        });
    </script>

    <script>
        function showDeleteModal(title, confirmHref) {
            const $modal = $('#deleteModal');
            const $modalTitle = $('#modal-title');
            const $confirmButton = $('#confirmDeleteButton');
            const $cancelButton = $('#cancelButton');

            $modalTitle.text(title); // Set the title
            $confirmButton.attr('href', confirmHref); // Set the href for the confirm button
            $modal.removeClass('hidden'); // Show the modal

            $cancelButton.off('click').on('click', function () {
                $modal.addClass('hidden'); // Hide the modal on cancel
            });
        }
    </script>

    <?php if (isset($messages['error'])): ?>
        <script>showToast('<?php echo $messages['error'] ?>', 'error')</script>
    <?php endif; ?>
    <?php if (isset($messages['success'])): ?>
        <script>showToast('<?php echo $messages['success'] ?>')</script>
    <?php endif; ?>

    <!-- jquery latest version -->
    <script src="<?php echo BASE_PATH . '/app/public/assets/js/vendor/jquery-2.2.4.min.js' ?>"></script>
    <!-- bootstrap 4 js -->
    <script src="<?php echo BASE_PATH . '/app/public/assets/js/popper.min.js' ?>"></script>
    <script src="<?php echo BASE_PATH . '/app/public/assets/js/bootstrap.min.js' ?>"></script>
    <script src="<?php echo BASE_PATH . '/app/public/assets/js/owl.carousel.min.js' ?>"></script>
    <script src="<?php echo BASE_PATH . '/app/public/assets/js/metisMenu.min.js' ?>"></script>
    <script src="<?php echo BASE_PATH . '/app/public/assets/js/jquery.slimscroll.min.js' ?>"></script>
    <script src="<?php echo BASE_PATH . '/app/public/assets/js/jquery.slicknav.min.js' ?>"></script>

    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <!-- others plugins -->
    <script src="<?php echo BASE_PATH . '/app/public/assets/js/plugins.js' ?>"></script>
    <script src="<?php echo BASE_PATH . '/app/public/assets/js/scripts.js' ?>"></script>
</body>

</html>