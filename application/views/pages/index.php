<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <h3>Product</h3>
        </div>
        <div class="col-md-6 text-right">
            <a class="btn btn-outline-primary" href="<?= base_url('add-product') ?>">Add Product</a>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="mt-2">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Sr. No</th>
                            <th scope="col">Category</th>
                            <th scope="col">Sub Category</th>
                            <th scope="col">Product Title</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Payble Amount</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($productDetails)) {
                            $index = 1;
                            foreach ($productDetails as $productDetail) { ?>
                                <tr>
                                    <th scope="row"><?= $index++ ?></th>
                                    <td><?= $productDetail->categoryName ?></td>
                                    <td><?= $productDetail->subCategoryName ?></td>
                                    <td><?= $productDetail->productTitle ?></td>
                                    <td><?= $productDetail->productAmount ?></td>
                                    <td><?= $productDetail->roductPayableAmount ?></td>
                                    <td>
                                        <a class="btn btn-primary" href="<?= base_url('edit-product/') . $productDetail->id ?>"><i class="fa fa-pencil-alt"></i></a>
                                        <button class="btn btn-danger deleteBtn" data-product-id="<?= $productDetail->id ?>"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->

<script>
    $(document).ready(function() {
        $(document).on('click', '.deleteBtn', function() {
            let productId = $(this).data('product-id');
            if (confirm('Delete the record ???')) {
                $.ajax({
                    url: "<?= base_url('home/deleteProduct') ?>",
                    method: 'POST',
                    data: {
                        productId: productId
                    },
                    success: function(response) {
                        if (response == 'success') {
                            location.reload();
                        }
                    }
                });
            }
        });
    });
</script>