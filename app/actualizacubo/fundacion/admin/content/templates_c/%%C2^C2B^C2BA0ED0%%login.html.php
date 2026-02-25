<?php /* Smarty version 2.6.18, created on 2014-04-02 23:50:50
         compiled from C:%5CAppServ%5Cwww%5Cappmartesdemarcas%5Cadmin/content/templates/login.html */ ?>
<div class="login">
	<h2 class="logintext">Acceso</h2>
	<div class="contentLogin rounded15">
        <form method="post" action="" autocomplete="off" id="login">
            <div class="inputdiv">
                <label for="usuario">Usuario</label><br />
                <input id="usuario" name="usuario" type="text" value="" />
            </div>
            <div class="inputdiv">
                <label for="password">Password</label><br />
                <input id="password" name="password" type="password" value="" />
            </div>
            <div class="right">
                <input type="submit" id="btnlogin" value="Login" />
            </div>
        </form>
    </div>
    <h3 id="errorField"></h3>
</div>