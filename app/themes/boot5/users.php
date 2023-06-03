<main class="mt-5">
    <div class="container ">
        <div class="table-responsive">
            <table class="table text-center table-primary table-hover caption-top">
                <caption>لیست کاربران</caption>
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">لقب</th>
                    <th scope="col">حجم مصرفی</th>
                    <th scope="col">زمان سرویس</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $number = 1;
                foreach ($users as $id => $user) {
                    $totalGB = $user['totalGB'] == 0 ? 'نامحدود' : formatBytes($user['totalGB']) . ' / ' . formatBytes($user['down'] + $user['up'], 2);
                    $expiryTime = $user['expiryTime'];
                    if (!empty($expiryTime) && $expiryTime != 0) {
                        if (str_contains($user['expiryTime'], '-')) {
                            $expiryTime = (time() * 1000) + str_replace('-', '', $user['expiryTime']);
                        }
                        $expiryTime = date("Y-m-d h:i:s", substr($expiryTime, 0, -3));
                        $expiryTime = expire($expiryTime);

                    } else {
                        $expiryTime = 'نامحدود';
                    }
                    ?>
                    <tr>
                        <th scope="row"><?= $number ?></th>
                        <td><?= $user['enable'] ? '<i class="bi bi-patch-check-fill text-success"></i>' : '<i class="bi bi-patch-exclamation-fill text-danger"></i>'; ?> <?= $user['remark'] ?></td>
                        <td class="ltr"><?= $totalGB ?></td>
                        <td class="ltr"><?= $expiryTime ?></td>
                        <td>
                            <i onclick="copyToClipboard('<?= BASE_URL . 'sub/' . $id ?>')"
                               class="bi bi-clipboard2-check bg-primary text-white rounded px-2 py-1">
                            </i>
                        </td>
                    </tr>
                    <?php
                    $number++;
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</main>


<script>
    function copyToClipboard(data) {
        navigator.clipboard.writeText(data).then(() => {
            alert('کپی شد.');
        }).catch(() => {
            alert('مشکلی پیش آمده است!');
        });
    }
</script>