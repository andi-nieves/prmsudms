<?php 
$profile_avatar = $dbhelper->get_user_meta($id, 'profile_avatar')
?>
<form class="auto" data-id="<?php echo $dbhelper->encrypt("users") ?>" data-unique='<?php echo json_encode(array('username')) ?>'>
    <div class="details">
        <?php if($user->type !== "3"): ?>
        <div class="row">
            <div class="col">
                <div class="input-wrapper">
                    <div><span>First Name</span></div>
                    <input name="meta[first_name]" <?= $readonly ? 'readonly' : '' ?> type="text" value="<?= $dbhelper->get_user_meta($id, 'first_name') ?>" />
                </div>
            </div>
            <div class="col">
                <div class="input-wrapper">
                    <div><span>Middle Name</span></div>
                    <input name="meta[middle_name]" <?= $readonly ? 'readonly' : '' ?> type="text" value="<?= $dbhelper->get_user_meta($id, 'middle_name') ?? "" ?>" />
                </div>
            </div>
            <div class="col">
                <div class="input-wrapper">
                    <div><span>Last Name</span></div>
                    <input name="meta[last_name]" <?= $readonly ? 'readonly' : '' ?> type="text" value="<?= $dbhelper->get_user_meta($id, 'last_name') ?? "" ?>" />
                </div>
            </div>
        </div>
        <?php endif ?>

        <div class="row">
            <div class="col">
                <div class="input-wrapper">
                    <div><span>Username</span></div>
                    <input name="username" <?= $readonly ? 'readonly' : '' ?> type="text" value="<?= $user->username ?? "" ?>" />
                </div>
            </div>
            <?php if(!$readonly): ?>
            <div class="col">
                <div class="input-wrapper">
                    <div><span><?= (isset($user) && isset($_GET['edit'])) ? "Change " : "" ?>Password</span></div>
                    <input name="password" <?= $readonly ? 'readonly' : '' ?> type="password" value="" autocomplete="new-password"/>
                </div>
                
            </div>
            <?php endif; ?>
            <div class="col">
                <div class="input-wrapper">
                    <div><span>Type</span></div>
                    <?php if($readonly === true): ?>
                        <div class="static">Admin</div>
                    <?php else: ?>
                    <select name="type" <?= $readonly ? 'readonly' : '' ?>>
                        <option value="1" <?= ($user->type ?? "") === 1 ? "selected" : "" ?>>Administrator</option>
                        <option value="2" <?= ($user->type ?? "") === 2 ? "selected" : "" ?>>User</option>
                    </select>
                    <?php endif ?>
                </div>
            </div>
        </div>
        <?php if(isset($_GET['edit'])): ?>
            <input type="hidden" name="id" value="<?= $_GET['edit'] ?>" />
        <?php endif ?>
        <?php if(!$readonly): ?>
        <div class="row">
            <div class="col">
                <div class="input-wrapper">
                    <div><span>Avatar</span></div>
                    <div class="upload">
                        <!-- <div class="container"> -->
                        <span class="">Choose File</span>
                        <button type="button">Browse</button>
                        <!-- </div> -->
                        <input name="avatar" class="not-required" type="file" accept="image/png, image/jpeg" />
                    </div>

                </div>
            </div>
        </div>
        <?php endif; ?>
        <input type="hidden" name="profile_avatar" />
        <div class="row">
            <div class="col justify-content">
                <div class="preview">
                    <?php if($profile_avatar == ""): ?>
                    <div class="no-image">Image not available</div>
                    <?php endif; ?>
                    <img style="display: <?= $profile_avatar === "" ? 'none' : '' ?>;" src="/img/avatars/<?= $profile_avatar ?>"/>
                </div>
            </div>
        </div>
    </div>
    <?php if(!$readonly): ?>
    <div class="justify-content m-t">
        <button class="btn btn-default m-r" type="submit">Save</button>
        <a class="btn btn-secondary" href="/admin/user_list.php">Cancel</a>
    </div>
    <?php endif; ?>
</form>

<div class="modal" id="crop-modal" style="display: none;">
    <div class="modal-content" style="max-width: unset">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Room Details</h3>
            </div>
            <div class="card-body">
                <div class="content">
                    <img id="preview-image" style="max-width: 800px; max-height: 500px" />
                </div>

                <div class="action-button justify-content-end">
                    <button class="btn btn-default m-r" type="submit">Okay</button>
                    <button class="btn btn-secondary close">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function getRoundedCanvas(sourceCanvas) {
        var canvas = document.createElement('canvas');
        var context = canvas.getContext('2d');
        var width = sourceCanvas.width;
        var height = sourceCanvas.height;

        canvas.width = width;
        canvas.height = height;
        context.imageSmoothingEnabled = true;
        context.drawImage(sourceCanvas, 0, 0, width, height);
        context.globalCompositeOperation = 'destination-in';
        context.beginPath();
        context.arc(width / 2, height / 2, Math.min(width, height) / 2, 0, 2 * Math.PI, true);
        context.fill();
        return canvas;
    }
    $(".upload button").on('click', function () {
        $('input[type="file"]').trigger('click')
    })
    const image = $("#crop-modal img#preview-image");
    const input = $('input[type="file"]');
    $('input[type="file"]').on('change', function (e) {
        var files = e.target.files;
        var done = function (url) {
            input.val();
            image.prop('src', url);
            $("#crop-modal").show();
            $("#crop-modal").trigger("modal.shown")
        };
        var reader;
        var file;
        var url;
        if (files && files.length > 0) {
            file = files[0];
            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function (e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    })
    let cropper
    let croppable = false
    $("#crop-modal").on("modal.shown", function () {
        crop(image)
    })
    function crop(img) {
        croppable = false
        cropper = new Cropper(document.getElementById("preview-image"), {
            aspectRatio: 1,
            viewMode: 1,
            cropBoxResizable: false,
            minCropBoxWidth: 128,
            minCropBoxHeight: 128,
            ready: function () {
                croppable = true;
            },
        });
    }
    $('#crop-modal button[type="submit"]').on('click', function () {
        if (!croppable) return
        const croppedCanvas = cropper.getCroppedCanvas()
        const roundedCanvas = getRoundedCanvas(croppedCanvas)
        const img = roundedCanvas.toDataURL()
        $('.preview img').attr('src', img)
        $('form input[name="profile_avatar"]').val(img)
        $('.preview img').show();
        $('.preview .no-image').hide();
        $("#crop-modal").hide();
        cropper.destroy();
        cropper = null;
    })
    $("form").on('success', function () {
        window.location = '/admin/user_list.php';
    })
</script>