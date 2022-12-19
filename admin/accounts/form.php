<form class="auto" data-id="<?php echo $dbhelper->encrypt("account_list") ?>">
    <div class="details">
        <div class="row">
            <div class="col">
                <div class="input-wrapper">
                    <div><span>Student</span></div>
                    <?php if (is_null($account)): ?>
                    <select name="student_id">
                        <?php foreach ($students as $student): ?>
                        <option value="<?php echo $student->id ?>">
                            <?php echo $student->name ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <?php else: ?>
                    <div class="static nobg">
                        <?php echo $account->name ?>
                    </div>
                    <?php endif ?>
                </div>
            </div>
            <div class="col">
                <div class="input-wrapper">
                    <div><span>Room</span></div>
                    <select name="room_id">
                        <?php foreach ($rooms as $room): ?>
                        <option <?php echo ($room->id ?? "")==($account->room_id ?? "") ? 'selected' : "" ?> value="
                            <?php echo $room->id ?>">
                            <?php echo $room->name ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="input-wrapper">
                    <div><span>Monthly Rate</span></div>
                    <div class="static rate">PHP
                        <?php echo $rooms[0]->price ?>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="input-wrapper">
                    <div><span>Active</span></div>
                    <select name="status">
                        <option <?php echo ($account->status ?? "")=="1" ? "selected" : "" ?> value="1">Active</option>
                        <option <?php echo ($account->status ?? "")=="0" ? "selected" : "" ?> value="0">Inactive</option>
                    </select>
                </div>
            </div>
        </div>
        <?php if (!is_null($account)): ?>
        <input type="hidden" name="id" value="<?php echo $account->id ?? null ?>" />
        <?php endif ?>
    </div>
    <div class="justify-content m-t">
        <button class="btn btn-default m-r" type="submit">Save</button>
        <a class="btn btn-secondary" href="<?php echo $SITE_NAME ?>/admin/account.php">Cancel</a>
    </div>
</form>

<script>

    $(document).ready(() => {
        $('select[name="room_id"]').on('select2:select', function (e) {
            var id = e.params.data.id;
            $.ajax({
                url: `/api/account.php?rate=${id}`,
                type: "get",
                dataType: "json",
            }).done((data) => {
                $('.input-wrapper .rate').html(`PHP ${data.price}`)
            });
        });
        $('form.auto').on('success', function (data) {
            window.location = '/admin/account.php'
        })
    })

</script>