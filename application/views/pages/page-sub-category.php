<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h3>Sub Categry</h3>
        </div>
        <div class="col-md-6 text-right">
            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal">Add Sub Category</button>
        </div>
    </div>

    <div class="container mt-2">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Sr. No</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Sub Category Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($subcategory)) {
                    $index = 1
                ?>
                    <?php foreach ($subcategory as $category) { ?>
                        <tr>
                            <th scope="row"><?= $index++ ?></th>
                            <td class="categoryName" data-category-id="<?= $category->category_IdFk ?>"><?= $category->categoryName ?></td>
                            <td class="subCategoryName"><?= $category->subCategoryName ?></td>
                            <td>
                                <button class="btn btn-primary editBtn" data-subcategory-id="<?= $category->id ?>" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-pencil-alt"></i></button>
                                <button class="btn btn-danger deleteBtn" data-subcategory-id="<?= $category->id ?>"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sub Category</h5>
            </div>
            <div class="modal-body">
                <form method="post" action="" id="subcategryForm" autocomplete="off">
                    <div class="defaultAlert"></div>
                    <div class="form-group">
                        <label class="col-form-label">Select Category:</label>
                        <select class="form-control" name="category_IdFk"></select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Sub Category:</label>
                        <input type="hidden" name="subcategoryID">
                        <input type="text" class="form-control" name="subCategoryName">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary closeBtn" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $.ajax({
            url: "<?= base_url('home/getAllCategory') ?>",
            type: 'GET',
            dataType: 'JSON',
            data: {},
            success: function(response) {
                let option = '<option value="" disabled selected>Select Category</option>';
                response.forEach(function(category) {
                    option += '<option value="' + category['id'] + '">' + category['categoryName'] + '</option>'
                });
                $('select[name="category_IdFk"]').append(option);
            }
        });

        $(document).on('click', 'button.editBtn', function() {
            let category_IdFk = $(this).closest('tr').find('.categoryName').data('category-id');
            let subCategoryId = $(this).data('subcategory-id');
            let subCategoryName = $(this).closest('tr').find('.subCategoryName').html();

            $('select[name="category_IdFk"] option[value="' + category_IdFk + '"]').prop("selected", true);
            $('input[name="subCategoryName"]').val(subCategoryName);
            $('input[name="subcategoryID"]').val(subCategoryId);
        });

        $(document).on('click', 'button.closeBtn', function() {
            $('form')[0].reset();
        });

        $('form#subcategryForm').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "<?= base_url('home/submitSubCategory') ?>",
                type: 'POST',
                data: $('#subcategryForm').serialize(),
                cache: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    if (response == 'success') {
                        $('.defaultAlert').html('');
                        $('.defaultAlert').css('display', 'none');
                        location.reload();
                    } else {
                        $('.defaultAlert').html(response);
                        $('.defaultAlert').css('display', 'block');
                    }
                }
            });
        });

        $(document).on('click', 'button.deleteBtn', function() {
            let subcat = $(this).data('subcategory-id');
            if (confirm('Delete this record ???')) {
                $.ajax({
                    url: "<?= base_url('home/deleteSubCategory') ?>",
                    type: 'POST',
                    data: {
                        subcat: subcat,
                    },
                    success: function(response) {
                        if (response == 'success') {
                            $('.defaultAlert').html('');
                            $('.defaultAlert').css('display', 'none');
                            location.reload();
                        } else {
                            $('.defaultAlert').html(response);
                            $('.defaultAlert').css('display', 'block');
                        }
                    }
                });
            }
        });
    });
</script>