<main class="mt-5">

    <div class="container">

        <form class="row g-3" method="POST" action="<?=BASE_URL.'server'?>" id="updateservers">

            <div class="col-12">
                <label for="inputAddress" class="form-label">آدرس سرور</label>
                <input type="text" class="form-control ltr" name="address" id="inputAddress" placeholder="https://server.com" value="<?=$server['address'] ?? ''?>" required>
            </div>
            <div class="col-12">
                <label for="inputport" class="form-label">پورت</label>
                <input type="text" class="form-control ltr" name="port" id="inputport" placeholder="123" value="<?=$server['port'] ?? ''?>" required>
            </div>
            <div class="col-md-6">
                <label for="inputuser" class="form-label">نام کاربری</label>
                <input type="text" class="form-control ltr" name="user" id="inputuser" value="<?=$server['username'] ?? ''?>" required>
            </div>
            <div class="col-md-6">
                <label for="inputPassword" class="form-label">رمزعبور</label>
                <input type="password" class="form-control ltr" name="pass" id="inputPassword" value="<?=$server['password'] ?? ''?>" required>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary" onclick="document.getElementById('updateservers').submit()">بروزرسانی</button>
                <a href="<?=BASE_URL.'dashboard'?>" class="btn btn-secondary">انصراف</a>
            </div>
        </form>
    </div>
</main>

