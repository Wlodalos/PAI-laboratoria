<?php
/* Smarty version 4.5.3, created on 2026-03-20 14:44:19
  from 'C:\Users\barte\Desktop\xampp\htdocs\3.Smarty\templates\calc_view.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_69bd4f334473c9_33234866',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0a9eed82e9bce5aec4fced206e1a6096247f2b81' => 
    array (
      0 => 'C:\\Users\\barte\\Desktop\\xampp\\htdocs\\3.Smarty\\templates\\calc_view.tpl',
      1 => 1773908932,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69bd4f334473c9_33234866 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\Users\\barte\\Desktop\\xampp\\htdocs\\3.Smarty\\libs\\plugins\\modifier.number_format.php','function'=>'smarty_modifier_number_format',),));
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Kalkulator Kredytowy - PAI</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="assets/css/main.css" />
    </head>
    <body class="no-sidebar is-preload">
        <div id="page-wrapper">

            <section id="header" class="wrapper">

                    <div id="logo">
                            <h1><a href="index.php">Kalkulator Kredytowy</a></h1>
                            <p>Projektowanie Aplikacji Internetowych</p>
                        </div>

                    <nav id="nav">
                            <ul>
                                <li class="current"><a href="index.php">Strona główna</a></li>
                                <li><a href="#footer">O autorze</a></li>
                            </ul>
                        </nav>

                </section>

            <div id="main" class="wrapper style2">
                    <div class="title">Oblicz swoją ratę</div>
                    <div class="container">

                       <div id="content">
    <article class="box post">
        
        <form action="calc.php" method="post" style="max-width: 600px; margin: 0 auto; text-align: left;">
            <div class="row gtr-50">
                <div class="col-12">
                    <label for="kwota">Kwota kredytu (zł):</label>
                    <input type="text" name="kwota" id="kwota" placeholder="np. 200000" value="<?php echo (($tmp = $_smarty_tpl->tpl_vars['kwota']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" />
                </div>
                
                <div class="col-12">
                    <label for="lata">Liczba lat:</label>
                    <input type="text" name="lata" id="lata" placeholder="np. 15" value="<?php echo (($tmp = $_smarty_tpl->tpl_vars['lata']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" />
                </div>
                
                <div class="col-12">
                    <label for="oprocentowanie">Oprocentowanie roczne (%):</label>
                    <input type="text" name="oprocentowanie" id="oprocentowanie" placeholder="np. 7.5" value="<?php echo (($tmp = $_smarty_tpl->tpl_vars['oprocentowanie']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" />
                </div>
                
                <div class="col-12">
                    <ul class="actions" style="margin-top: 20px;">
                        <li><input type="submit" value="Oblicz ratę" class="button style1" /></li>
                    </ul>
                </div>
            </div>
        </form>

        <div style="max-width: 600px; margin: 30px auto 0 auto; text-align: left;">
            
            <?php if ((isset($_smarty_tpl->tpl_vars['messages']->value)) && count($_smarty_tpl->tpl_vars['messages']->value) > 0) {?>
                <div style="padding: 20px; background-color: #ffe6e6; border-left: 5px solid #ff4d4d; border-radius: 4px;">
                    <h3 style="color: #cc0000; margin-bottom: 10px;">Wystąpiły błędy:</h3>
                    <ul style="color: #cc0000; margin: 0; padding-left: 20px;">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['messages']->value, 'msg');
$_smarty_tpl->tpl_vars['msg']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['msg']->value) {
$_smarty_tpl->tpl_vars['msg']->do_else = false;
?>
                        <li><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</li>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </ul>
                </div>
            <?php }?>

            <?php if ((isset($_smarty_tpl->tpl_vars['result']->value))) {?>
                <div style="padding: 20px; background-color: #e6ffe6; border-left: 5px solid #33cc33; border-radius: 4px; text-align: center;">
                    <h3 style="color: #009900; margin: 0;">Miesięczna rata wynosi: <br><span style="font-size: 1.5em;"><?php echo smarty_modifier_number_format($_smarty_tpl->tpl_vars['result']->value,2,',',' ');?>
 zł</span></h3>
                </div>
            <?php }?>
            
        </div>

    </article>
</div>
</div>
                </div>

            <section id="footer" class="wrapper">
                    <div class="title">Kontakt</div>
                    <div class="container">
                        <div id="copyright">
                            <ul>
                                <li>&copy; Bartłomiej Chyra. Wszelkie prawa zastrzeżone.</li>
                                <li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
                            </ul>
                        </div>
                    </div>
                </section>

        </div>

        <?php echo '<script'; ?>
 src="assets/js/jquery.min.js"><?php echo '</script'; ?>
>
            <?php echo '<script'; ?>
 src="assets/js/jquery.dropotron.min.js"><?php echo '</script'; ?>
>
            <?php echo '<script'; ?>
 src="assets/js/browser.min.js"><?php echo '</script'; ?>
>
            <?php echo '<script'; ?>
 src="assets/js/breakpoints.min.js"><?php echo '</script'; ?>
>
            <?php echo '<script'; ?>
 src="assets/js/util.js"><?php echo '</script'; ?>
>
            <?php echo '<script'; ?>
 src="assets/js/main.js"><?php echo '</script'; ?>
>

    </body>
</html><?php }
}
