<main class="mt-5">
    <div class="container">
        <div class="row p-2">
            <div class="col-12 border-primary border rounded p-2">
                <form class="row g-3" method="POST" action="<?= BASE_URL . 'config/set-config' ?>"
                      id="updateservers">
                    <div class="row mt-4">
                        <div class="col-lg-9 mb-3">
                            <label for="configTextarea" class="form-label">کانفیگ شما</label>
                            <textarea class="form-control ltr " style="font-size: small;" oninput="this.value=decodeURIComponent(this.value);"
                                      name="config" id="configTextarea" rows="3"><?= $config ?></textarea>
                        </div>

                        <div class="col-lg-3  text-muted">
                            <div class="row small">
                                <p>مواد جایگزین</p>
                                <div class="col-6">
                                    آیدی (UID) :
                                    <br><code class="ltr">[/uid]</code><br>
                                    دامنه یا IP : <br><code class="ltr">[/ip]</code><br>
                                    عنوان : <br><code class="ltr">[/title]</code><br>
                                </div>
                                <div class="col-6">
                                    پورت : <br><code class="ltr">[/port]</code><br>
                                    پروتکل[vl,vm] : <br><code class="ltr">[/protocol]</code>
                                </div>
                            </div>


                        </div>
                    </div>


                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">ذخیره</button>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="row row-cols-1 row-cols-lg-2 ">
            <div class="col border-end">
                <h3>افزودن دسته</h3>
                <hr>
                <form class="row g-3" method="POST" action="<?= BASE_URL . 'config/create-category' ?>"
                      id="updateservers">

                    <div class="col-12">
                        <label for="inputcategory" class="form-label">نام دسته (EN)</label>
                        <input type="text" class="form-control ltr" name="title" id="inputcategory"
                                placeholder="MCI"
                               required>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">افزودن</button>
                    </div>
                </form>
                <hr>
                <div class="table-responsive">
                    <table class="table text-center table-primary table-hover caption-top">
                        <caption>لیست دسته ها</caption>
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">نام دسته</th>
                            <th scope="col">حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $number = 1;
                        foreach ($category as $title => $user) {
                            ?>
                            <tr>
                                <th scope="row"><?= $number ?></th>
                                <td><?= $title ?></td>
                                <td><a class="bi bi-trash bg-danger text-white rounded px-2 py-1"
                                       href="<?= BASE_URL . 'config/delete-category?id=' . $title ?>"
                                       onclick="return confirm('دسته و همه دامنه یا IP های این دسته حذف شود ؟');"></a>
                                </td>
                            </tr>
                            <?php
                            $number++;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <hr>
            </div>
            <div class="col">
                <h3>افزودن دامنه یا IP</h3>
                <hr>
                <form class="row g-3" method="POST" action="<?= BASE_URL . 'config/add-ip' ?>"
                      id="updateservers">

                    <div class="col-12">
                        <label for="inputscategory" class="form-label">انتخاب دسته</label>
                        <select class="form-select" id="inputscategory" name="category"
                                aria-label="Default select example" required>
                            <?php
                            foreach ($category as $title => $ips) {
                                ?>
                                <option value="<?= $title ?>"><?= $title ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-12">
                        <label for="inputAddress" class="form-label">آدرس دامنه یا IP</label>
                        <input type="text" class="form-control ltr" name="ip" id="inputAddress"

                               placeholder="127.0.0.1,exp.com" required>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">افزودن</button>
                    </div>
                </form>
                <hr>

                <div class="table-responsive">
                    <table class="table text-center table-primary table-hover caption-top">
                        <caption>لیست دامنه یا IP ها <span
                                    class="bg-secondary text-white rounded px-2 py-1 testall-ping ltr"
                                    style="cursor: pointer;">اسکن همه</span></caption>
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">دامنه یا IP</th>
                            <th scope="col">دسته</th>
                            <th scope="col">حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $number = 1;
                        foreach ($category as $title => $ips) {
                            foreach ($ips as $id => $ip) {
                                ?>
                                <tr>
                                    <th scope="row"><?= $number ?></th>
                                    <td><?= $ip ?></td>
                                    <td><?= $title ?></td>
                                    <td>
                                        <a class="bi bi-reception-4 bg-info text-white rounded px-2 py-1 ping-test ltr"
                                           data-ip="<?= $ip ?>" id="ping-test<?= $number ?>"
                                           style="cursor: pointer;"></a>

                                        <a class="bi bi-trash bg-warning text-white rounded px-2 py-1"
                                           href="<?= BASE_URL . 'config/delete-ip?category=' . $title . '&id=' . $id ?>"
                                           onclick="return confirm('دامنه یا IP حذف شود؟');"></a></td>
                                </tr>
                                <?php
                                $number++;
                            }

                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</main>


<script>
    function sleep(milliseconds) {
        var start = new Date().getTime();
        for (var i = 0; i < 1e7; i++) {
            if ((new Date().getTime() - start) > milliseconds) {
                break;
            }
        }
    }


    $('.testall-ping').on('click', function (evt) {
        $('.ping-test').each(function (i, obj) {
            let ip = $(this).data('ip');
            let idd = $(this).attr('id');

            testIPs(ip, '#' + idd);
            $(this).removeClass('bi');
            $(this).removeClass('bi-reception-4');

        });
    });


    $('.ping-test').on('click', function (evt) {
        let ip = $(this).data('ip');
        let idd = $(this).attr('id');

        testIPs(ip, '#' + idd);
        $(this).removeClass('bi');
        $(this).removeClass('bi-reception-4');
    });


    async function testIPs(ip, idd) {


        const timeout = 2500;
        let testResult = 0;
        const url = `https://${ip}/__down`;
        const startTime = performance.now();
        const controller = new AbortController();

        for (const ch of ['1', '2', '3', '4', '5']) {
            const timeoutId = setTimeout(() => {
                controller.abort();
            }, timeout);
            if (ch) {
                $(idd).text(ch);
            } else {
                //document.getElementById('searching').innerHTML = `<p dir="ltr" style="color: red">Test : ${ip}</p>`;
            }
            try {
                const response = await fetch(url, {
                    signal: controller.signal,
                });

                testResult++;
            } catch (error) {
                if (error.name === "AbortError") {
                    //
                } else {
                    testResult++;
                }
            }
            clearTimeout(timeoutId);
        }

        const duration = performance.now() - startTime;

        if (testResult === 5) {
            $(idd).text(Math.floor(duration / 5) + "ms");
            $(idd).removeClass('bg-info');
            $(idd).removeClass('bg-danger');
            $(idd).addClass('bg-success');
        } else {
            $(idd).text("Down");
            $(idd).removeClass('bg-info');
            $(idd).addClass('bg-danger');
        }
    }

</script>