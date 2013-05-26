<?php if (!$logged_in) {

    ?>
    <div class="row">

        <div class="span7 hero-unit" style="margin-left: 10px">
            <h1>不带便当，上神马班？</h1>

            <p>还在为午饭吃什么而苦恼？还在为地沟油而担心？</p>

            <p>
                <a href="/account/register" class="btn btn-primary btn-large">
                    <strong>加入我们</strong> 注册
                </a>
            </p>
        </div>

        <div class="span4">
            <form id="lzform" class="well" name="lzform" method="post" action="/account/login">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="email">帐号</label>

                        <div class="controls">
                            <input type="text" name="email" id="email" placeholder="邮箱">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="password">密码</label>

                        <div class="controls">
                            <input name="password" id="password" type="password">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="checkbox control-label">
                            <input id="remember_me" name="remember_me" type="checkbox"> 记住我
                        </label>

                        <div class="controls">
                            <input value="登录" type="submit" class="btn btn-primary ">
                        </div>
                    </div>
                </fieldset>
            </form>

        </div>
    </div>
<?php
}

?>