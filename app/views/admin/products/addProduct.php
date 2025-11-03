<div class="main-content-inner">
    <div class="row">
        <div class="col-lg-6 col-ml-12">
            <div class="row justify-content-center">
                <div class="col-8 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title"><?php echo $action === 'add' ? 'Thêm' : 'Cập nhật' ?> sản phẩm
                            </h4>
                            <form action="" method="POST" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="productName" class="col-form-label">Tên Sản phẩm</label>
                                    <input class="form-control" type="text"
                                        value="<?php echo $product['productName'] ?? '' ?>" id="productName"
                                        name="productName" required />
                                </div>

                                <div class="form-group">
                                    <label for="mo-ta-san-phan" class="col-form-label">Mô tả sản phẩm
                                    </label>
                                    <textarea class="form-control" aria-label="With textarea" id="mo-ta-san-phan"
                                        name="productDesc"
                                        required><?php echo $product['productDesc'] ?? '' ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="price" class="col-form-label">Giá</label>
                                    <input class="form-control" type="text"
                                        value="<?php echo $product['price'] ?? '0' ?>" id="price" name="price"
                                        required />
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Danh mục sản phẩm</label>
                                    <select required name="categoryId" class="form-control">
                                        <?php foreach ($categories as $cate): ?>
                                            <option value="<?php echo $cate['categoryId'] ?>" <?php if ($action === 'update' && $product['categoryId'] === $cate['categoryId'])
                                                   echo 'selected' ?>><?php echo $cate['categoryName'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="stock" class="col-form-label">Số lượng trong kho</label>
                                    <input class="form-control" type="number"
                                        value="<?php echo $product['stock'] ?? '0' ?>" id="stock" name="stock"
                                        required />
                                </div>

                                <div class="form-group mb-3">
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="images" id="images-label">Ảnh sản
                                            phẩm</label>
                                        <input type="file" name="images[]" class="custom-file-input" id="images"
                                            multiple />
                                    </div>
                                </div>

                                <?php if ($action === 'update' && isset($product['images'])): ?>
                                    <div class="row row-cols-2 row-cols-lg-3 mb-3 justify-content-center"
                                        id="current-image">
                                        <?php foreach ($product['images'] as $image): ?>

                                            <div
                                                class="update-img-product m-1 p-0 col-3 border border-1 position-relative image-container">
                                                <img src="<?php echo BASE_PATH . '/' . $image['link']; ?>" alt="" />

                                                <div class="delete-btn">
                                                    <button style="background: none; border:none;padding: 0;" type="button"
                                                        class="delete-image" data-image-id="<?php echo $image['imageId']; ?>"><i
                                                            class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-rounded btn-success mb-3">
                                        <?php echo $action === 'add' ? 'Thêm' : 'Cập nhật' ?>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-image');
        const deletedImagesInput = document.createElement('input');
        deletedImagesInput.type = 'hidden';
        deletedImagesInput.name = 'deletedImages';
        deletedImagesInput.value = '';
        document.querySelector('form').appendChild(deletedImagesInput);

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const imageId = this.getAttribute('data-image-id');
                const imageContainer = this.closest('.image-container');

                if (imageContainer) {
                    imageContainer.remove();

                    const deletedImages = deletedImagesInput.value ? deletedImagesInput.value.split(',') : [];
                    if (!deletedImages.includes(imageId)) {
                        deletedImages.push(imageId);
                    }
                    deletedImagesInput.value = deletedImages.join(',');
                }
            });
        });

        //display image file
        const fileInput = document.getElementById('images');
        const fileLabel = document.getElementById('images-label');

        fileInput.addEventListener('change', function () {
            const files = Array.from(fileInput.files);
            if (files.length > 0) {
                fileLabel.textContent = `Ảnh sản phẩm (${files.length})`; // Update the label text
            } else {
                fileLabel.textContent = 'Ảnh sản phẩm'; // Reset to default label
            }
        });
    });
</script>