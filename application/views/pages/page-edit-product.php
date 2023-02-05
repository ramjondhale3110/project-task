<div class="container">
    <div class="mt-2">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="defaultAlert"></div>
                <form method="POST" autocomplete="off" action="" id="productForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Select Category</label>
                                <select class="form-control" name="categoryId">
                                    <option value="" disabled selected>Select Category</option>
                                    <?php foreach ($categories as $category) { ?>
                                        <option value="<?= $category->id ?>" <?php echo ($productDetail->cat_IdFk == $category->id) ? 'selected' : ''; ?>><?= $category->categoryName ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Select Sub Category</label>
                                <select class="form-control" name="subcategoryId">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Product Title</label>
                        <input type="text" class="form-control" name="productTitle" placeholder="Product Title" value="<?= $productDetail->productTitle ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Product Description</label>
                        <textarea class="form-control" name="productDescription" rows="3" placeholder="Product Description"><?= $productDetail->productDescription ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Product Amount</label>
                                <input type="number" class="form-control" name="productAmount" placeholder="Product Amount" value="<?= $productDetail->productAmount ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Select Product Discount Type :</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="productDiscType" value="flat" checked <?php if ($productDetail->productDiscType == 'flat') echo 'checked'; ?>>
                                        <label class="form-check-label" for="">Flat</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="productDiscType" value="perce" <?php if ($productDetail->productDiscType == 'perce') echo 'checked'; ?>>
                                        <label class="form-check-label" for="">Percentage</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Product Discount Amount</label>
                                <input type="number" class="form-control" name="productDiscAmount" placeholder="Product Discount Amount" value="<?= $productDetail->productDiscAmount ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Payable Discount Amount</label>
                                <input type="text" class="form-control" name="productPayableAmount" placeholder="Payable Discount Amount" readonly value="<?= $productDetail->roductPayableAmount ?>">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->

<script>
    $(document).ready(function() {
        $(document).on('change', 'select[name="categoryId"]', function() {
            let categoryId = $(this).val();
            $.ajax({
                url: "<?= base_url('home/getAllSubCategory') ?>",
                method: 'POST',
                data: {
                    categoryId: categoryId
                },
                dataType: 'JSON',
                success: function(response) {
                    let subCateId = "<?= $productDetail->subcat_IdFk ?>";
                    let option = '<option value="" disabled selected>Select Sub Category</option>';
                    response.forEach(function(category) {
                        if (category.id == subCateId) {
                            option += '<option value="' + category['id'] + '" selected>' + category['subCategoryName'] + '</option>'
                        } else {
                            option += '<option value="' + category['id'] + '">' + category['subCategoryName'] + '</option>'
                        }
                    });
                    $('select[name="subcategoryId"]').empty();
                    $('select[name="subcategoryId"]').append(option);
                }
            });
        });
        $('select[name="categoryId"]').trigger('change');

        $(document).on('keyup', 'input[name="productAmount"]', function() {
            showDiscountAmount();
        });

        $(document).on('change', 'input[name="productDiscType"]', function() {
            showDiscountAmount();
        });

        $(document).on('keyup', 'input[name="productDiscAmount"]', function() {
            showDiscountAmount();
        });
        // $('input[name="productDiscType"]').trigger('change');

        function showDiscountAmount() {
            let productDiscType = $('input[name="productDiscType"]:checked').val();
            let productAmount = $('input[name="productAmount"]').val();
            let productDiscAmount = $('input[name="productDiscAmount"]').val();
            if (productAmount == '') {
                return false;
            }
            if (productDiscAmount == '') {
                return false;
            }
            if (productDiscType == 'flat') {
                productPayableAmount = parseInt(productAmount) - parseInt(productDiscAmount);
                $('input[name="productPayableAmount"]').val(productPayableAmount);
            } else {
                productPayableAmount = (parseInt(productDiscAmount) / 100) * parseInt(productAmount);
                $('input[name="productPayableAmount"]').val(productPayableAmount);
            }
        }

        $(document).on('submit', 'form#productForm', function(event) {
            event.preventDefault();
            var formData = new FormData($('#productForm')[0]);
            $.ajax({
                url: "<?= base_url('home/submitProductDetail') ?>",
                data: formData,
                type: 'POST',
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response == 'success') {
                        $('.defaultAlert').css('display', 'none');
                        $('.defaultAlert').html('');
                        window.location.href = "<?= base_url('product') ?>";
                    } else {
                        $('.defaultAlert').css('display', 'block');
                        $('.defaultAlert').html(response);
                    }
                }
            });
        });
    });
</script>