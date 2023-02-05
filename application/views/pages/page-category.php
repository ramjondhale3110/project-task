<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h3>Categry</h3>
        </div>
        <div class="col-md-6 text-right">
            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal">Add Category</button>
        </div>
    </div>

    <div class="mt-2">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Sr. No</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($category)) {
                    $index = 0;
                ?>
                    <?php foreach ($category as $cat) { ?>
                        <tr>
                            <th scope="row"><?= ++$index ?></th>
                            <td class="categoryName"><?= $cat->categoryName ?></td>
                            <td>
                                <button class="btn btn-primary editBtn" data-category-id="<?= $cat->id ?>" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-pencil-alt"></i></button>
                                <button class="btn btn-danger deleteBtn" data-category-id="<?= $cat->id ?>"><i class="fas fa-trash"></i></button>
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
                <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
            </div>
            <div class="modal-body">
                <form method="post" action="" id="categryForm" autocomplete="off">
                    <div class="defaultAlert"></div>
                    <div class="form-group">
                        <label class="col-form-label">Category:</label>
                        <input type="hidden" name="categoryID">
                        <input type="text" class="form-control" name="categoryName">
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
        $(document).on('click', 'button.editBtn', function() {
            let categoryName = $(this).closest('tr').find('.categoryName').html();
            $('input[name="categoryID"]').val($(this).attr('data-category-id'));
            $('input[name="categoryName"]').val(categoryName);
        });

        $(document).on('click', 'button.closeBtn', function() {
            $('input[name="categoryID"]').val('');
            $('input[name="categoryName"]').val('');
        });

        $('form#categryForm').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "<?= base_url('home/submitCategory') ?>",
                type: 'POST',
                data: $('#categryForm').serialize(),
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
            let categoryID = $(this).data('category-id');
            if (confirm("confirm this record delete ???")) {
                $.ajax({
                    url: "<?= base_url('home/deleteCategory') ?>",
                    type: "POST",
                    data: {
                        categoryID: categoryID
                    },
                    cache: false,
                    success: function(response) {
                        console.log(response);
                        if (response == 'success') {
                            location.reload();
                        }
                    }
                });
            }
        });
    });
</script>