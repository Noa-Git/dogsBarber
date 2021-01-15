</head>
 <body>

<main id="mainWrraper">

<h1>Login</h1>

<div id="info"><?php if ($error!=null){echo "Can not login.  error: ".$error['error'];}?></div>
<?php echo form_open('Customers/auth'); ?>

    <label>Email</label>
    <input type="text" name="email" required /><br>
    <label>Password</label>
    <input type="password" name="password"  required/><br>
    
    <input class="createForm" type="submit" name="submit" value="Login"/>
    <input id="register" class="createForm" type="button" name="submit" value="Register" />
<?php echo form_close(); ?>

</main>
<script>
            document.getElementById("register").onclick=function()
            {
                window.location.href="<?php echo site_url('customers/register');?>";   
            };
 </script>

</body>
</html>