<?php /* Smarty version Smarty-3.0.8, created on 2013-03-13 01:11:25
         compiled from "/Users/robert/Projects/madlab/phpCornerstone/pages/view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:687514699513fc42d6edc95-20098076%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '98078c435b4f63af38d56a9f1c311e0bfed97695' => 
    array (
      0 => '/Users/robert/Projects/madlab/phpCornerstone/pages/view.tpl',
      1 => 1363132222,
      2 => 'file',
    ),
    'a24733009ee6fa7562268c48238e05752bde2c3c' => 
    array (
      0 => '/Users/robert/Projects/madlab/phpCornerstone/pages/site.master.tpl',
      1 => 1363131556,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '687514699513fc42d6edc95-20098076',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include '/Users/robert/Projects/madlab/phpCornerstone/cornerstone/libraries/Smarty/plugins/modifier.date_format.php';
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>phpCornerstone</title>

    <!-- Le styles -->
    <style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 40px;
      }

      /* Custom container */
      .container-narrow {
        margin: 0 auto;
        max-width: 700px;
      }
      .container-narrow > hr {
        margin: 30px 0;
      }

      /* Main marketing message and sign up button */
      .jumbotron {
        margin: 60px 0;
        text-align: center;
      }
      .jumbotron h1 {
        font-size: 72px;
        line-height: 1;
      }
      .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
      }

      /* Supporting marketing content */
      .marketing {
        margin: 60px 0;
      }
      .marketing p + h4 {
        margin-top: 28px;
      }
    </style>
      <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.1/css/bootstrap-combined.min.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	


</head>
<body>
	
    <div class="container-narrow">

        <div class="masthead">
          <ul class="nav nav-pills pull-right">
            <li class="active"><a href="/">Home</a></li>
            <li><a href="https://github.com/MadLab/phpCornerstone/archive/master.zip" target="_blank">Download</a></li>
          </ul>
          <a href="/"><img src="http://www.phpcornerstone.com/img/logo.png"></a>
        </div>

        <hr>




  <div class="jumbotron">
    <h1>Hello World!</h1>
    <p class="lead">Edit me in /pages/view.tpl to get started!</p>
    <a class="btn btn-large btn-success" href="http://www.phpcornerstone.com/" target="_blank">Visit phpCornerstone.com</a>
  </div>

  <hr>

  <div class="row-fluid marketing">
    <div class="span6">
      <h4>Where is the Documentation?</h4>
      <p>All developers agree that documentation is good. They also all agree that it's a pain to write them, this is why there are no docs yet. Bother us if you want them sooner.</p>

      <h4>What templating system does it use?</h4>
      <p>Smarty, with some tooling to make things a bit easier to use with the phpCornerstone framework.</p>

      <h4>Where can I find out more information?</h4>
      <p>Right now it's really just from looking at the code. We haven't gotten around to anything else yet.</p>
    </div>

    <div class="span6">
      <h4>Is anything ready?</h4>
      <p>Well the code works, we've been using it for a while, but you have to realize you are asking me all these questions literally the minute I started putting up our site.</p>

      <h4>Who's behind this... thing?</h4>
      <p><a href="http://www.madlab.com/is/nickashley">Nick Ashley</a> is the lead programmer. <a href="http://www.madlab.com/is/robertgentel">Robert Gentel</a> contributes to the project.</p>

      <h4>I'm sold! How can I contribute?</h4>
      <p>We know we have a lot to do, if you want to help <a href="https://github.com/MadLab/phpCornerstone" target="_blank">head over to phpCornerstone on GitHub</a>.</p>
    </div>
  </div>




        <hr>

        <div class="footer">
          <p>&copy; <a href="http://www.madlab.com/">MadLab</a> <?php echo smarty_modifier_date_format(time(),'Y');?>
</p>
        </div>

      </div>

</body>
</html>
